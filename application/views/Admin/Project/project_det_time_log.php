<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Overview</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
           <?php include('project_det_menu.php'); ?>
        </div>
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Time Log</h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body px-0 py-0" >

                <div class="row p-4">
                  <?php
                  $client_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $project_info['client_id'], '', '', '', '', 'smm_reseller');
                  ?>
                  <div class="col-md-8">
                    <div class="card p-4">
                    <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                      <div class="row">
                        <div class="form-group col-md-4 select_sm">
                          <label>Employee</label>
                          <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee">
                            <option value="">Select Employee</option>
                            <?php foreach ($employee_list as $list): ?>
                              <option value="<?php echo $list['employee_id']; ?>"><?php echo $list['employee_name'].' '.$list['employee_lname']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group col-md-2 ">
                          <label>Start Time</label>
                          <div class="input-group time" id="time1" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm datetimepicker-input" name="time_log_start_time"  value="<?php if(isset($time_log_info)){ echo $time_log_info['time_log_start_time']; } ?>" data-target="#time1" data-toggle="datetimepicker" placeholder="Start Time" required>
                          </div>
                        </div>
                        <div class="form-group col-md-2 ">
                          <label>End Time</label>
                          <div class="input-group time" id="time2" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm datetimepicker-input" name="time_log_end_time"  value="<?php if(isset($time_log_info)){ echo $time_log_info['time_log_end_time']; } ?>" data-target="#time2" data-toggle="datetimepicker" placeholder="End Time" required>
                          </div>
                        </div>
                        <div class="form-group col-md-2 ">
                          <label>Start Date</label>
                          <div class="input-group time" id="date1" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm datetimepicker-input" name="time_log_start_date"  value="<?php if(isset($time_log_info)){ echo $time_log_info['time_log_start_date']; } ?>" data-target="#date1" data-toggle="datetimepicker" placeholder="End Time" required>
                          </div>
                        </div>
                        <div class="form-group col-md-2 ">
                          <label>End Date</label>
                          <div class="input-group time" id="date2" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm datetimepicker-input" name="time_log_end_date"  value="<?php if(isset($time_log_info)){ echo $time_log_info['time_log_end_date']; } ?>" data-target="#date2" data-toggle="datetimepicker" placeholder="End Time" required>
                          </div>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Memo</label>
                          <textarea class=" form-control form-control-sm" name="time_log_memo" id="time_log_memo" rows="10"><?php if(isset($time_log_info)){ echo $time_log_info['time_log_memo']; } ?></textarea>
                        </div>
                        <div class="col-md-6 offset-md-6">
                          <a href="<?php echo base_url(); ?>Project/project_det_time_log" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                          <?php if(isset($update)){
                            echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                          } else{
                            echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
                          } ?>
                        </div>
                      </form>
                      </div>

                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">List All Time Log Information</h3>
                            </div>
                            <div class="card-body p-2">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th class="d-none">#</th>
                                  <!-- <th class="wt_50">Action</th> -->
                                  <!-- <th class="">Project</th> -->
                                  <th>Employee</th>
                                  <th class="wt_75">Start Date</th>
                                  <th class="wt_75">End Date</th>
                                  <th class="wt_75">Total Hours</th>
                                  <!-- <th class="">Memo</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(isset($time_log_list)){
                                   $i=0; foreach ($time_log_list as $list) { $i++;
                                     // $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                                     $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name,employee_lname', '', 'employee_id', $list->employee_id, '', '', '', '', 'smm_employee');
                                  ?>
                                  <tr>
                                    <td class="d-none"><?php echo $i; ?></td>
                                    <!-- <td class="text-center">
                                      <div class="btn-group">
                                        <a href="<?php echo base_url() ?>Project/edit_time_log/<?php echo $list->time_log_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                                        <a href="<?php echo base_url() ?>Project/delete_time_log/<?php echo $list->time_log_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Time Log Information');"><i class="fa fa-trash text-danger"></i></a>
                                      </div>
                                    </td> -->
                                    <!-- <td><?php if($project_info) { echo $project_info[0]['project_name']; } ?></td> -->
                                    <td><?php if($employee_info) { echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?></td>
                                    <td><?php echo $list->time_log_start_date; ?></td>
                                    <td><?php echo $list->time_log_end_date; ?></td>
                                    <td><?php //echo $list->time_log_date; ?></td>
                                    <!-- <td><?php echo $list->time_log_memo; ?></td> -->

                                  </tr>
                                <?php } } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>
                  <div class="col-md-4">
                    <?php
                    include('project_det_side_info.php');
                    ?>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</body>
</html>
