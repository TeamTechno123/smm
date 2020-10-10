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
              <!-- <form class="input_form m-0" id="form_action" role="form" action="" method="post"> -->
                <div class="row p-4">
                  <?php
                  $client_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $project_info['client_id'], '', '', '', '', 'smm_reseller');
                  ?>
                  <div class="col-md-8">
                    <div class="card p-4">
                      <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>File Name</label>
                            <input type="text" class="form-control form-control-sm" name="task_file_name" id="task_file_name" value="<?php if(isset($task_file_info)){ echo $task_file_info['task_file_name']; } ?>" required>
                          </div>
                          <div class="form-group col-md-8 ">
                            <label>Select File</label>
                            <input type="file" class="form-control form-control-sm" name="task_file_image" id="task_file_image" required>
                          </div>


                          <div class="col-md-6 offset-md-6">
                            <!-- <a href="<?php echo base_url(); ?>Project/project_det_time_log" class="btn btn-sm btn-default px-4 mx-4">Cancel</a> -->
                            <?php if(isset($update)){
                              echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                            } else{
                              echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
                            } ?>
                          </div>
                        </div>
                      </form>
                      <hr>
                      <div class="mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th class="d-none">#</th>
                            <!-- <th class="wt_50">Action</th> -->
                            <th>Name</th>
                            <th class="wt_100">File</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php if(isset($task_file_list)){
                              $i=0; foreach ($task_file_list as $list) { $i++;
                            ?>
                              <tr>
                                <td class="d-none"><?php echo $i; ?></td>
                                <!-- <td>
                                  <div class="btn-group">
                                    <a href="<?php echo base_url() ?>Project/edit_task_file/<?php echo $list->task_file_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                                    <a href="<?php echo base_url() ?>Project/delete_task_file/<?php echo $list->task_file_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Task');"><i class="fa fa-trash text-danger"></i></a>
                                  </div>
                                </td> -->
                                <td><?php echo $list->task_file_name; ?></td>
                                <td>
                                  <a target="_blank" href="<?php echo base_url(); ?>assets/images/task/<?php echo $list->task_file_image; ?>">File Link</a>
                                </td>

                              </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <?php include('task_det_side_info.php'); ?>
                  </div>
                </div>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</body>
</html>
