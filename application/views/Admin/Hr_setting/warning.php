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
            <h4>Warning</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Warning</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Hr_setting/warning" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
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
                            <label>Warning To</label>
                            <select class="form-control select2 form-control-sm" name="warning_to_id" id="warning_to_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->user_id; ?>" <?php if(isset($warning_info) && $warning_info['warning_to_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == '0'){ echo 'disabled'; } ?>><?php echo $list->user_name.' '.$list->user_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Warning Type</label>
                            <select class="form-control select2 form-control-sm" name="warning_type_id" id="warning_type_id" data-placeholder="Select Warning Type" required>
                              <option value="">Select Warning Type</option>
                              <?php if(isset($warning_type_list)){ foreach ($warning_type_list as $list) { ?>
                              <option value="<?php echo $list->warning_type_id; ?>" <?php if(isset($warning_info) && $warning_info['warning_type_id'] == $list->warning_type_id){ echo 'selected'; } if($list->warning_type_status == '0'){ echo 'disabled'; } ?>><?php echo $list->warning_type_name; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Warning Subject</label>
                            <input type="text" class="form-control form-control-sm" name="warning_subject" id="warning_subject" value="<?php if(isset($warning_info)){ echo $warning_info['warning_subject']; } ?>" placeholder="Enter Warning Subject" required>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Warning By</label>
                            <select class="form-control select2 form-control-sm" name="warning_by_id" id="warning_by_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->user_id; ?>" <?php if(isset($warning_info) && $warning_info['warning_by_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == '0'){ echo 'disabled'; } ?>><?php echo $list->user_name.' '.$list->user_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Warning Date</label>
                            <input type="text" class="form-control form-control-sm" name="warning_date" value="<?php if(isset($warning_info)){ echo $warning_info['warning_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Warning Date" required>
                          </div>

                          <div class="form-group col-md-8">
                            <label>Attach File</label>
                            <input type="file" class="form-control form-control-sm" name="warning_image" id="warning_image">
                            <label>.jpg/.png/.jpeg file & size less than 500kb.</label>
                          </div>
                          <div class="form-group col-md-4">
                          <?php if(isset($warning_info) && $warning_info['warning_image']){ ?>
                            <input type="hidden" name="old_warning_image" value="<?php echo $warning_info['warning_image']; ?>">
                            <img width="100px" src="<?php echo base_url(); ?>assets/images/warning/<?php echo $warning_info['warning_image']; ?>" alt="">
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <textarea class=" form-control form-control-sm" name="warning_descr" id="warning_descr" rows="8"><?php if(isset($warning_info)){ echo $warning_info['warning_descr']; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="warning_status" id="warning_status" value="0" <?php if(isset($warning_info) && $warning_info['warning_status'] == 0){ echo 'checked'; } ?>>
                            <label for="warning_status" class="custom-control-label">Disable This Warning</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Hr_setting/warning" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Warning Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee</th>
                    <th class="wt_75">Warning Date</th>
                    <th class="">Subject</th>
                    <th class="">Warning By</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($warning_list)){
                     $i=0; foreach ($warning_list as $list) { $i++;
                       // $warning_type_info = $this->Master_Model->get_info_arr_fields3('warning_type_name', '', 'warning_type_id', $list->warning_type_id, '', '', '', '', 'smm_warning_type');
                       $user_info1 = $this->Master_Model->get_info_arr_fields3('user_name,user_lname', '', 'user_id', $list->warning_to_id, '', '', '', '', 'user');
                       $user_info2 = $this->Master_Model->get_info_arr_fields3('user_name,user_lname', '', 'user_id', $list->warning_by_id, '', '', '', '', 'user');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Hr_setting/edit_warning/<?php echo $list->warning_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Hr_setting/delete_warning/<?php echo $list->warning_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Warning Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($user_info1) { echo $user_info1[0]['user_name'].' '.$user_info1[0]['user_lname']; } ?></td>
                      <!-- <td><?php if($warning_type_info) { echo $warning_type_info[0]['warning_type_name']; } ?></td> -->
                      <td><?php echo $list->warning_date; ?></td>
                      <td><?php echo $list->warning_subject; ?></td>
                      <td><?php if($user_info2) { echo $user_info2[0]['user_name'].' '.$user_info2[0]['user_lname']; } ?></td>
                      <!-- <td>
                        <?php if($list->warning_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
