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
            <h4>Task</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header ">
                <h3 class="card-title">List All Task</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <!-- <th class="wt_50">Action</th> -->
                    <th>Task Title</th>
                    <th class="wt_100">Assigned To</th>
                    <th>Project</th>
                    <th class="wt_75">Start Date</th>
                    <th class="wt_75">End Date</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($task_list)){
                      $i=0; foreach ($task_list as $list) { $i++;
                        $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                        $task_status_info = $this->Master_Model->get_info_arr_fields3('task_status_name', '', 'task_status_id', $list->task_status, '', '', '', '', 'smm_task_status');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <!-- <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Project/edit_task/<?php echo $list->task_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Project/delete_task/<?php echo $list->task_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Task');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td> -->
                        <td>
                          <a href="<?php echo base_url() ?>Emp_Panel/Emp_Project/set_task_session/<?php echo $list->task_id; ?>"><?php echo $list->task_title; ?></a>
                        </td>
                        <td class="wt_100">
                          <div class="row px-1">
                            <?php
                              $task_assign_to = $list->task_assign_to;
                              $task_assign_to = explode(',',$task_assign_to);
                              $i=0;
                              $employee_list = array();
                              foreach ($task_assign_to as $task_assign_to_id) {
                                $employee_info = $this->Master_Model->get_info_arr_fields('*', 'employee_id', $task_assign_to_id, 'smm_employee');
                            ?>
                            <div class="col-4 p-0">
                              <img style="border-radius:50%;" width="30px" src="<?php echo base_url(); ?>assets/images/employee/<?php echo $employee_info[0]['employee_image']; ?>" alt="">
                            </div>
                            <?php  } ?>
                          </div>
                        </td>
                        <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td>
                        <td><?php echo $list->task_start_date; ?></td>
                        <td><?php echo $list->task_end_date; ?></td>
                        <td><?php if($task_status_info){ echo $task_status_info[0]['task_status_name']; } ?></td>
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
