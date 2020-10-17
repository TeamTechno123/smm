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
            <h4>Leave</h4>
          </div>
          <?php include('timesheet_topbar.php'); ?>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?>">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Leave</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Emp_Panel/Emp_Master/leave" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
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
                            <label>Leave Type</label>
                            <select class="form-control select2 form-control-sm" name="leave_type_id" id="leave_type_id" data-placeholder="Select Leave Type" required>
                              <option value="">Select Leave Type</option>
                              <?php if(isset($leave_type_list)){ foreach ($leave_type_list as $list) { ?>
                              <option value="<?php echo $list->leave_type_id; ?>" <?php if(isset($leave_info) && $leave_info['leave_type_id'] == $list->leave_type_id){ echo 'selected'; } if($list->leave_type_status == '0'){ echo ' disabled'; } ?>><?php echo $list->leave_type_name; ?></option>
                              <?php } } ?>
                            </select>
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Start Date</label>
                            <input type="text" class="form-control form-control-sm" name="leave_start_date" value="<?php if(isset($leave_info)){ echo $leave_info['leave_start_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Start Date" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>End Date</label>
                            <input type="text" class="form-control form-control-sm" name="leave_end_date" value="<?php if(isset($leave_info)){ echo $leave_info['leave_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter End Date" required>
                          </div>
                          <div class="form-group col-md-12 ">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" name="leave_half_day" id="leave_half_day" value="1" <?php if(isset($leave_info) && $leave_info['leave_half_day'] == 1){ echo 'checked'; } ?>>
                              <label for="leave_half_day" class="custom-control-label">Half Day</label>
                            </div>
                          </div>

                          <div class="form-group col-md-8">
                            <label>Attach File</label>
                            <input type="file" class="form-control form-control-sm" name="leave_image" id="leave_image">
                            <label>.jpg/.png/.jpeg file & size less than 500kb.</label>
                          </div>
                          <div class="form-group col-md-4">
                          <?php if(isset($leave_info) && $leave_info['leave_image']){ ?>
                            <input type="hidden" name="old_leave_image" value="<?php echo $leave_info['leave_image']; ?>">
                            <img width="100px" src="<?php echo base_url(); ?>assets/images/leave/<?php echo $leave_info['leave_image']; ?>" alt="">
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Remark</label>
                            <textarea class=" form-control form-control-sm" name="leave_remark" id="leave_remark" rows="8"><?php if(isset($leave_info)){ echo $leave_info['leave_remark']; } ?></textarea>
                          </div>

                        </div>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Leave Reason</label>
                        <textarea class=" form-control form-control-sm" name="leave_reason" id="leave_reason" rows="4"><?php if(isset($leave_info)){ echo $leave_info['leave_reason']; } ?></textarea>
                      </div>


                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="leave_status" id="leave_status" value="0" <?php if(isset($leave_info) && $leave_info['leave_status'] == 0){ echo 'checked'; } ?>>
                            <label for="leave_status" class="custom-control-label">Disable This Leave</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/leave" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Leave Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th class="150">Employee</th>
                    <th>Leave Type</th>
                    <!-- <th class="wt_75">Department</th> -->
                    <th class="wt_75">Requested Duration</th>
                    <th class="wt_75">Applied Date</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($leave_list)){
                     $i=0; foreach ($leave_list as $list) { $i++;
                       $leave_type_info = $this->Master_Model->get_info_arr_fields3('leave_type_name', '', 'leave_type_id', $list->leave_type_id, '', '', '', '', 'smm_leave_type');
                       $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name,employee_lname', '', 'employee_id', $list->employee_id, '', '', '', '', 'smm_employee');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <?php if($list->leave_status == 0){ ?>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Master/edit_leave/<?php echo $list->leave_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Master/delete_leave/<?php echo $list->leave_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Leave Information');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        <?php } ?>
                      </td>
                      <td><?php if($employee_info) { echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?></td>
                      <td><?php if($leave_type_info) { echo $leave_type_info[0]['leave_type_name']; } ?></td>
                      <td><?php
                      if($list->leave_total_days == 0 && $list->leave_half_day == 1){ echo 'Half Day <br>'.$list->leave_start_date.' ';  }
                      else{ echo $list->leave_total_days.' Day <br>'.$list->leave_start_date.' to<br>'.$list->leave_end_date;  }
                      ?></td>
                      <td><?php echo date('d-m-Y', strtotime($list->leave_created_at)); ?></td>
                      <td>
                        <?php if($list->leave_status == 0){ echo '<span class="text-info"><b>Pending</b></span>'; }
                          elseif($list->leave_status == 1){ echo '<span class="text-success"><b>Approved</b></span>'; }
                          elseif($list->leave_status == 2){ echo '<span class="text-danger"><b>Rejected</b></span>'; } ?>
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
