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
              <h3 class="card-title">Progress</h3>
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
                      <div class="row">
                        <div class="col-sm-6">
                          <span class="f-12">Complete: <?php echo $project_info['project_progress']; ?>%</span>
                          <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $project_info['project_progress']; ?>%;" aria-valuenow="<?php echo $project_info['project_progress']; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $project_info['project_progress']; ?>%</div>
                          </div>
                        </div>

                        <div class="form-group col-md-6 select_sm" data-select2-id="14">
                          <label>Status</label>
                          <select class="form-control select2" name="project_status" id="project_status" data-placeholder="Select Status">
                            <option value="">Select Status</option>
                            <option value="0" <?php if(isset($project_info) && $project_info['project_status'] == '0'){ echo 'selected'; } ?>>Not Started</option>
                            <option value="1" <?php if(isset($project_info) && $project_info['project_status'] == '1'){ echo 'selected'; } ?>>In Progress</option>
                            <option value="2" <?php if(isset($project_info) && $project_info['project_status'] == '2'){ echo 'selected'; } ?>>Completed</option>
                            <option value="3" <?php if(isset($project_info) && $project_info['project_status'] == '3'){ echo 'selected'; } ?>>Cancelled</option>
                            <option value="4" <?php if(isset($project_info) && $project_info['project_status'] == '4'){ echo 'selected'; } ?>>Hold</option>
                          </select>
                           <label class="mt-2">Priority</label>
                           <select class="form-control select2" name="project_piority" id="project_piority" data-placeholder="Priority">
                             <option value="">Priority</option>
                             <option value="Low" <?php if(isset($project_info) && $project_info['project_piority'] == 'Low'){ echo 'selected'; } ?>>Low</option>
                             <option value="Medium" <?php if(isset($project_info) && $project_info['project_piority'] == 'Medium'){ echo 'selected'; } ?>>Medium</option>
                             <option value="High" <?php if(isset($project_info) && $project_info['project_piority'] == 'High'){ echo 'selected'; } ?>>High</option>
                             <option value="Highest" <?php if(isset($project_info) && $project_info['project_piority'] == 'Highest'){ echo 'selected'; } ?>>Highest</option>
                           </select>
                          </div>
                          <div class="col-md-12">
                            <button class="btn btn-sm btn-success float-right px-4">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <?php include('project_det_side_info.php'); ?>
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
