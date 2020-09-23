<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Review</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?>">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Review</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Master/review" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-6 ">
                        <label>Review No.</label>
                        <input type="text" class="form-control form-control-sm" name="review_no" id="review_no" value="<?php if(isset($review_info)){ echo $review_info['review_no']; } ?>" placeholder="Enter Review No." required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Review Date</label>
                        <input type="text" class="form-control form-control-sm" name="review_date" value="<?php if(isset($review_info)){ echo $review_info['review_date']; } ?>"  id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Review Date" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Project</label>
                        <select class="form-control select2 form-control-sm" name="project_id" id="project_id" data-placeholder="Select Project" required>
                          <option value="">Select Project</option>
                          <?php if(isset($project_list)){ foreach ($project_list as $list) { ?>
                          <option value="<?php echo $list->project_id; ?>" <?php if(isset($review_info) && $review_info['project_id'] == $list->project_id){ echo 'selected'; } if($list->project_status == '0'){ echo 'disabled'; } ?>><?php echo $list->project_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Client</label>
                        <select class="form-control select2 form-control-sm" name="client_id" id="client_id" data-placeholder="Select Client" required>
                          <option value="">Select Client</option>
                          <?php if(isset($client_list)){ foreach ($client_list as $list) { ?>
                          <option value="<?php echo $list->client_id; ?>" <?php if(isset($review_info) && $review_info['client_id'] == $list->client_id){ echo 'selected'; } if($list->client_status == '0'){ echo 'disabled'; } ?>><?php echo $list->client_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-12 ">
                        <label>Review Message</label>
                        <textarea class="form-control form-control-sm" name="review_descr" id="review_descr" rows="3" placeholder="Enter Review Message" required ><?php if(isset($review_info)){ echo $review_info['review_descr']; } ?></textarea>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Review Image</label>
                        <input type="file" class="form-control form-control-sm" name="review_image" id="review_image" >
                          <label>.jpg/.jpeg/.png file. Size less than 500kb.</label>
                      </div>
                      <div class="form-group col-md-4">
                        <?php if(isset($review_info) && $review_info['review_image']){ ?>
                          <img width="150px" src="<?php echo base_url() ?>assets/images/review/<?php echo $review_info['review_image'];  ?>" alt="Review Image">
                          <input type="hidden" name="old_review_img" value="<?php echo $review_info['review_image']; ?>">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="review_status" id="review_status" value="0" <?php if(isset($review_info) && $review_info['review_status'] == 0){ echo 'checked'; } ?>>
                            <label for="review_status" class="custom-control-label">Disable This Review</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Master/review" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                          <?php if(isset($update)){
                            echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                          } else{
                            echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
                          } ?>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List All Review Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th class="">Project</th>
                    <th class="wt_75">Review Date</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($review_list)){
                      $i=0; foreach ($review_list as $list) { $i++;
                        $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Master/edit_review/<?php echo $list->review_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Master/delete_review/<?php echo $list->review_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Review Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td>
                      <td><?php echo $list->review_date; ?></td>
                      <td class="text-center"><img width="50px" width="50px" src="<?php echo base_url() ?>assets/images/review/<?php echo $list->review_image;  ?>" alt="Review Image">
                      <td>
                        <?php if($list->review_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                          else{ echo '<span class="text-success">Active</span>'; } ?>
                      </td>
                    </tr>
                  <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
