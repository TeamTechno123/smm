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
            <h4>Attendence</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Attendence</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Timesheet/attendence" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-8 offset-md-2 select_sm">
                        <label>Select Employee</label>
                        <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee" required>
                          <option value="">Select Employee</option>
                          <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                          <option value="<?php echo $list->employee_id; ?>" <?php if(isset($attendence_info) && $attendence_info['employee_id'] == $list->employee_id){ echo 'selected'; } if($list->employee_status == '0'){ echo ' disabled'; } ?>><?php echo $list->employee_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-8 offset-md-2 ">
                        <label>Attendence Date</label>
                        <input type="text" class="form-control form-control-sm" name="attendence_date" value="<?php if(isset($attendence_info)){ echo $attendence_info['attendence_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Attendence Date" required>
                      </div>
                      <div class="form-group col-md-4 offset-md-2 ">
                        <label>Attendence In Time</label>
                        <input type="text" class="form-control form-control-sm" name="attendence_in_time" value="<?php if(isset($attendence_info)){ echo $attendence_info['attendence_in_time']; } ?>" id="time1" data-target="#time1" data-toggle="datetimepicker" placeholder="Enter Attendence In Time" required>
                      </div>
                      <div class="form-group col-md-4 ">
                        <label>Attendence Out Time</label>
                        <input type="text" class="form-control form-control-sm" name="attendence_out_time" value="<?php if(isset($attendence_info)){ echo $attendence_info['attendence_out_time']; } ?>" id="time2" data-target="#time2" data-toggle="datetimepicker" placeholder="Enter Attendence Out Time" required>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="attendence_status" id="attendence_status" value="0" <?php if(isset($attendence_info) && $attendence_info['attendence_status'] == 0){ echo 'checked'; } ?>>
                            <label for="attendence_status" class="custom-control-label">Disable This Attendence</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Timesheet/attendence" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Attendence Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee Name</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_50">In Time</th>
                    <th class="wt_50">Out Time</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($attendence_list)){
                     $i=0; foreach ($attendence_list as $list) { $i++;
                       $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name, employee_lname', '', 'employee_id', $list->employee_id, '', '', '', '', 'smm_employee');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Timesheet/edit_attendence/<?php echo $list->attendence_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Timesheet/delete_attendence/<?php echo $list->attendence_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Attendence Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($employee_info) { echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?></td>
                      <td><?php echo $list->attendence_date; ?></td>
                      <td><?php echo $list->attendence_in_time; ?></td>
                      <td><?php echo $list->attendence_out_time; ?></td>
                      <!-- <td>
                        <?php if($list->attendence_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
