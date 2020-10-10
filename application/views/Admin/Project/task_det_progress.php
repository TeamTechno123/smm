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
           <?php include('task_det_menu.php'); ?>
        </div>
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">OverView</h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body p-0" >
              <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                <div class="row p-4">
                  <?php
                  $client_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $project_info['client_id'], '', '', '', '', 'smm_reseller');
                  ?>
                  <div class="col-md-8">
                    <div class="card p-4">
                      <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                        <div class="p-2">
                          <div class="row">
                            <div class="col-sm-6">
                              <span class="f-12">Complete: <?php echo $task_info['task_progress']; ?>%</span>
                              <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $task_info['task_progress']; ?>%;" aria-valuenow="<?php echo $task_info['task_progress']; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $task_info['task_progress']; ?>%</div>
                              </div>
                            </div>

                            <div class="form-group col-md-6 select_sm" data-select2-id="14">
                              <label>Progress (%)</label>
                              <input  class="form-control form-control-sm"  type="number" min="0" max="100" step="1" name="task_progress" id="task_progress" value="<?php echo $task_info['task_progress']; ?>">
                              <label>Status</label>

                              <select class="form-control select2 form-control-sm" name="task_status" id="task_status" data-placeholder="Select Task Status" required>
                                <option value="">Select Task Status</option>
                                <?php if(isset($task_status_list)){ foreach ($task_status_list as $list) { ?>
                                <option value="<?php echo $list->task_status_id; ?>" <?php if(isset($task_info) && $task_info['task_status'] == $list->task_status_id){ echo 'selected'; } ?>><?php echo $list->task_status_name; ?></option>
                                <?php } } ?>
                              </select>
                               <label class="mt-2">Priority</label>
                               <select class="form-control select2" name="task_priority" id="task_priority" data-placeholder="Priority">
                                 <option value="">Priority</option>
                                 <option value="Low" <?php if(isset($task_info) && $task_info['task_priority'] == 'Low'){ echo 'selected'; } ?>>Low</option>
                                 <option value="Medium" <?php if(isset($task_info) && $task_info['task_priority'] == 'Medium'){ echo 'selected'; } ?>>Medium</option>
                                 <option value="High" <?php if(isset($task_info) && $task_info['task_priority'] == 'High'){ echo 'selected'; } ?>>High</option>
                                 <option value="Highest" <?php if(isset($task_info) && $task_info['task_priority'] == 'Highest'){ echo 'selected'; } ?>>Highest</option>
                               </select>
                              </div>
                              <div class="col-md-12">
                                <button class="btn btn-sm btn-success float-right px-4">Save</button>
                              </div>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <?php include('task_det_side_info.php'); ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</body>
</html>
