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
            <h4>Overtime Request</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Overtime Request</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Timesheet/overtime_request" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
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
                            <label>Employee</label>
                            <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->employee_id; ?>" <?php if(isset($overtime_request_info) && $overtime_request_info['employee_id'] == $list->employee_id){ echo 'selected'; } if($list->employee_status == '0'){ echo ' disabled'; } ?>><?php echo $list->employee_name.' '.$list->employee_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-12 ">
                            <label> Date</label>
                            <input type="text" class="form-control form-control-sm" name="overtime_request_date" value="<?php if(isset($overtime_request_info)){ echo $overtime_request_info['overtime_request_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Date" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Project No</label>
                            <input type="text" class="form-control form-control-sm" name="overtime_request_pro_no" id="overtime_request_pro_no" value="<?php if(isset($overtime_request_info)){ echo $overtime_request_info['overtime_request_pro_no']; } ?>" placeholder="Enter Project No" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Phase No</label>
                            <input type="text" class="form-control form-control-sm" name="overtime_request_phase_no" id="overtime_request_phase_no" value="<?php if(isset($overtime_request_info)){ echo $overtime_request_info['overtime_request_phase_no']; } ?>" placeholder="Enter Phase No" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>In Time</label>
                            <div class="input-group time" id="time1" data-target-input="nearest">
                              <input type="text" class="form-control form-control-sm datetimepicker-input" name="overtime_request_in_time"  value="<?php if(isset($overtime_request_info)){ echo $overtime_request_info['overtime_request_in_time']; } ?>" data-target="#time1" data-toggle="datetimepicker" placeholder="Enter In Time" required>
                            </div>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Out Time</label>
                            <div class="input-group time" id="time2" data-target-input="nearest">
                              <input type="text" class="form-control form-control-sm datetimepicker-input" name="overtime_request_out_time"  value="<?php if(isset($overtime_request_info)){ echo $overtime_request_info['overtime_request_out_time']; } ?>" data-target="#time2" data-toggle="datetimepicker" placeholder="Enter Out Time" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Task</label>
                            <input type="text" class="form-control form-control-sm" name="overtime_request_task" id="overtime_request_task" value="<?php if(isset($overtime_request_info)){ echo $overtime_request_info['overtime_request_task']; } ?>" placeholder="Enter Task" required>
                          </div>
                          <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <textarea class=" form-control form-control-sm" name="overtime_request_descr" id="overtime_request_descr" rows="4"><?php if(isset($overtime_request_info)){ echo $overtime_request_info['overtime_request_descr']; } ?></textarea>
                          </div>
                          <div class="form-group col-md-12 select_sm">
                            <label>Request Status</label>
                            <select class="form-control select2 form-control-sm" name="overtime_request_status" id="overtime_request_status" data-placeholder="Select Request Status" required>
                              <option value="">Select Request Status</option>
                              <option value="0" <?php if(isset($overtime_request_info) && $overtime_request_info['overtime_request_status'] == '0'){ echo 'selected'; } ?>>Pending</option>
                              <option value="1" <?php if(isset($overtime_request_info) && $overtime_request_info['overtime_request_status'] == '1'){ echo 'selected'; } ?>>Approved</option>
                              <option value="2" <?php if(isset($overtime_request_info) && $overtime_request_info['overtime_request_status'] == '2'){ echo 'selected'; } ?>>Rejected</option>
                            </select>
                          </div>
                        </div>
                      </div>





                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="overtime_request_status" id="overtime_request_status" value="0" <?php if(isset($overtime_request_info) && $overtime_request_info['overtime_request_status'] == 0){ echo 'checked'; } ?>>
                            <label for="overtime_request_status" class="custom-control-label">Disable This Overtime Request</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Timesheet/overtime_request" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Overtime Request Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee</th>
                    <th class="wt_75">Project No</th>
                    <th class="wt_75">Phase No</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_75">In Time</th>
                    <th class="wt_75">Out Time</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($overtime_request_list)){
                     $i=0; foreach ($overtime_request_list as $list) { $i++;
                       $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name,employee_lname', '', 'employee_id', $list->employee_id, '', '', '', '', 'smm_employee');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Timesheet/edit_overtime_request/<?php echo $list->overtime_request_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Timesheet/delete_overtime_request/<?php echo $list->overtime_request_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Overtime Request Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($employee_info) { echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?></td>
                      <td><?php echo $list->overtime_request_pro_no; ?></td>
                      <td><?php echo $list->overtime_request_phase_no; ?></td>
                      <td><?php echo $list->overtime_request_date; ?></td>
                      <td><?php echo $list->overtime_request_in_time; ?></td>
                      <td><?php echo $list->overtime_request_out_time; ?></td>
                      <td>
                        <?php if($list->overtime_request_status == 0){ echo '<span class="text-info"><b>Pending</b></span>'; }
                          elseif($list->overtime_request_status == 1){ echo '<span class="text-success"><b>Approved</b></span>'; }
                          elseif($list->overtime_request_status == 2){ echo '<span class="text-danger"><b>Rejected</b></span>'; } ?>
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
