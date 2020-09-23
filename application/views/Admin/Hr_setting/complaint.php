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
            <h4>Complaint</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Complaint</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Hr_setting/complaint" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 select_sm">
                            <label>Complaint From</label>
                            <select class="form-control select2 form-control-sm" name="complaint_from_id" id="complaint_from_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->user_id; ?>" <?php if(isset($complaint_info) && $complaint_info['complaint_from_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == '0'){ echo 'disabled'; } ?>><?php echo $list->user_name.' '.$list->user_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Complaint Title</label>
                            <input type="text" class="form-control form-control-sm" name="complaint_title" id="complaint_title" value="<?php if(isset($complaint_info)){ echo $complaint_info['complaint_title']; } ?>" placeholder="Enter Complaint Title" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Complaint Date</label>
                            <input type="text" class="form-control form-control-sm" name="complaint_date" value="<?php if(isset($complaint_info)){ echo $complaint_info['complaint_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Complaint Date" required>
                          </div>
                          <div class="form-group col-md-12 select_sm">
                            <label>Complaint Against</label>
                            <select class="form-control select2 form-control-sm" name="complaint_against_id" id="complaint_against_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->user_id; ?>" <?php if(isset($complaint_info) && $complaint_info['complaint_against_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == '0'){ echo 'disabled'; } ?>><?php echo $list->user_name.' '.$list->user_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-8">
                            <label>Attach File</label>
                            <input type="file" class="form-control form-control-sm" name="complaint_image" id="complaint_image">
                            <label>.jpg/.png/.jpeg file & size less than 500kb.</label>
                          </div>
                          <div class="form-group col-md-4">
                          <?php if(isset($complaint_info) && $complaint_info['complaint_image']){ ?>
                            <input type="hidden" name="old_complaint_image" value="<?php echo $complaint_info['complaint_image']; ?>">
                            <img width="100px" src="<?php echo base_url(); ?>assets/images/complaint/<?php echo $complaint_info['complaint_image']; ?>" alt="">
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <textarea class=" form-control form-control-sm" name="complaint_descr" id="complaint_descr" rows="8"><?php if(isset($complaint_info)){ echo $complaint_info['complaint_descr']; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="complaint_status" id="complaint_status" value="0" <?php if(isset($complaint_info) && $complaint_info['complaint_status'] == 0){ echo 'checked'; } ?>>
                            <label for="complaint_status" class="custom-control-label">Disable This Complaint</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Hr_setting/complaint" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Complaint Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Complaint From</th>
                    <th class="">Complaint Against</th>
                    <th class="">Complaint Title</th>
                    <th class="wt_75">Complaint Date</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($complaint_list)){
                     $i=0; foreach ($complaint_list as $list) { $i++;
                       // $complaint_type_info = $this->Master_Model->get_info_arr_fields3('complaint_type_name', '', 'complaint_type_id', $list->complaint_type_id, '', '', '', '', 'smm_complaint_type');
                       $user_info1 = $this->Master_Model->get_info_arr_fields3('user_name,user_lname', '', 'user_id', $list->complaint_from_id, '', '', '', '', 'user');
                       $user_info2 = $this->Master_Model->get_info_arr_fields3('user_name,user_lname', '', 'user_id', $list->complaint_against_id, '', '', '', '', 'user');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Hr_setting/edit_complaint/<?php echo $list->complaint_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Hr_setting/delete_complaint/<?php echo $list->complaint_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Complaint Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($user_info1) { echo $user_info1[0]['user_name'].' '.$user_info1[0]['user_lname']; } ?></td>
                      <td><?php if($user_info2) { echo $user_info2[0]['user_name'].' '.$user_info2[0]['user_lname']; } ?></td>
                      <td><?php echo $list->complaint_title; ?></td>
                      <td><?php echo $list->complaint_date; ?></td>
                      <!-- <td>
                        <?php if($list->complaint_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                          else{ echo '<span class="text-success">Active</span>'; } ?>
                      </td> -->
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
