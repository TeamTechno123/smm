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
            <h4>Resignation</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Resignation</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Hr_setting/resignation" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
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
                            <label>Employee to Transfer</label>
                            <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->user_id; ?>" <?php if(isset($resignation_info) && $resignation_info['employee_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == '0'){ echo 'disabled'; } ?>><?php echo $list->user_name.' '.$list->user_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-12 ">
                            <label>Notice Date</label>
                            <input type="text" class="form-control form-control-sm" name="resignation_notice_date" value="<?php if(isset($resignation_info)){ echo $resignation_info['resignation_notice_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Notice Date" required>
                          </div>
                          <div class="form-group col-md-12 ">
                            <label>Resignation Date</label>
                            <input type="text" class="form-control form-control-sm" name="resignation_date" value="<?php if(isset($resignation_info)){ echo $resignation_info['resignation_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Resignation Date" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Resignation Reason</label>
                            <textarea class=" form-control form-control-sm" name="resignation_descr" id="resignation_descr" rows="8"><?php if(isset($resignation_info)){ echo $resignation_info['resignation_descr']; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="resignation_status" id="resignation_status" value="0" <?php if(isset($resignation_info) && $resignation_info['resignation_status'] == 0){ echo 'checked'; } ?>>
                            <label for="resignation_status" class="custom-control-label">Disable This Resignation</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Hr_setting/resignation" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Resignation Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee</th>
                    <th class="wt_75">Notice Date</th>
                    <th class="wt_75">Resignation Date</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($resignation_list)){
                     $i=0; foreach ($resignation_list as $list) { $i++;
                       // $department_info = $this->Master_Model->get_info_arr_fields3('department_name', '', 'department_id', $list->department_id, '', '', '', '', 'smm_department');
                       $user_info = $this->Master_Model->get_info_arr_fields3('user_name,user_lname', '', 'user_id', $list->employee_id, '', '', '', '', 'user');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-resignation">
                          <a href="<?php echo base_url() ?>Hr_setting/edit_resignation/<?php echo $list->resignation_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Hr_setting/delete_resignation/<?php echo $list->resignation_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Resignation Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($user_info) { echo $user_info[0]['user_name'].' '.$user_info[0]['user_lname']; } ?></td>
                      <td><?php echo $list->resignation_date; ?></td>
                      <td><?php echo $list->resignation_notice_date; ?></td>
                      <!-- <td>
                        <?php if($list->resignation_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
