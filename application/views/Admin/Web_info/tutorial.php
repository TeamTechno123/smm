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
            <h4>Tutorial</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Tutorial</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Web_info/tutorial" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-4 select_sm">
                        <label>Tutorial Category</label>
                        <select class="form-control select2" name="tutorial_category_id" id="tutorial_category_id" data-placeholder="Select Category" required >
                          <option value="">Select Category</option>
                          <?php if(isset($tutorial_category_list)){ foreach ($tutorial_category_list as $list) { ?>
                          <option value="<?php echo $list->tutorial_category_id; ?>" <?php if(isset($tutorial_info) && $tutorial_info['tutorial_category_id'] == $list->tutorial_category_id){ echo 'selected'; } if($list->tutorial_category_status == 0){ echo ' disabled'; } ?>><?php echo $list->tutorial_category_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4 ">
                        <label>Tutorial Date</label>
                        <input type="text" class="form-control form-control-sm" name="tutorial_date" value="<?php if(isset($tutorial_info)){ echo $tutorial_info['tutorial_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Tutorial Date" required>
                      </div>
                      <div class="form-group col-md-4 ">
                        <label>Tutorial Author</label>
                        <input type="text" class="form-control form-control-sm" name="tutorial_author" id="tutorial_author" value="<?php if(isset($tutorial_info)){ echo $tutorial_info['tutorial_author']; } ?>" placeholder="Enter Tutorial Author" required>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Tutorial Title</label>
                        <input type="text" class="form-control form-control-sm" name="tutorial_name" id="tutorial_name" value="<?php if(isset($tutorial_info)){ echo $tutorial_info['tutorial_name']; } ?>" placeholder="Enter Tutorial Title" required>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Tutorial Description</label>
                        <textarea class="textarea form-control form-control-sm" name="tutorial_descr" id="tutorial_descr" rows="3" placeholder="Enter Tutorial Description" required ><?php if(isset($tutorial_info)){ echo $tutorial_info['tutorial_descr']; } ?></textarea>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Tutorial Image</label>
                        <input type="file" class="form-control form-control-sm valid_image" name="tutorial_image" id="tutorial_image" <?php if(!isset($tutorial_info)){ echo 'required'; } ?>>
                          <label>.jpg/.jpeg/.png file. Size less than 500kb.</label>
                      </div>
                      <div class="form-group col-md-4">
                        <?php if(isset($tutorial_info) && $tutorial_info['tutorial_image']){ ?>
                          <img width="150px" src="<?php echo $tutorial_info['tutorial_image'];  ?>" alt="Tutorial Image">
                          <input type="hidden" name="old_tutorial_img" value="<?php echo $tutorial_info['tutorial_image']; ?>">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="tutorial_status" id="tutorial_status" value="0" <?php if(isset($tutorial_info) && $tutorial_info['tutorial_status'] == 0){ echo 'checked'; } ?>>
                            <label for="tutorial_status" class="custom-control-label">Disable This Tutorial</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Web_info/tutorial" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                          <?php if(isset($update)){
                            echo '<button type="submit" class="btn btn-sm btn-primary float-right px-4">Update</button>';
                          } else{
                            echo '<button type="submit" class="btn btn-sm btn-success float-right px-4">Save</button>';
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
                <h3 class="card-title">List All Tutorial Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Tutorial Title</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($tutorial_list)){
                      $i=0; foreach ($tutorial_list as $list) { $i++;
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Web_info/edit_tutorial/<?php echo $list->tutorial_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Web_info/delete_tutorial/<?php echo $list->tutorial_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Tutorial Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->tutorial_name; ?></td>
                      <td class="text-center"><img width="50px" width="50px" src="<?php echo $list->tutorial_image;  ?>" alt="Tutorial Image">
                      <td>
                        <?php if($list->tutorial_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
