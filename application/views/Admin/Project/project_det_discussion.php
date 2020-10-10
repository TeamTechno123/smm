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
              <h3 class="card-title">Milestone</h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body p-0" >
                <div class="row p-4">
                  <?php
                  $client_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $project_info['client_id'], '', '', '', '', 'smm_reseller');
                  ?>
                  <div class="col-md-8">
                    <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                      <div class="row p-4">
                        <div class="form-group col-md-12 select_sm">
                          <label>Title</label>
                          <input type="text" class="form-control form-control-sm" name="project_discussion_title" id="project_discussion_title" value="<?php if(isset($project_discussion_info)){ echo $project_discussion_info['project_discussion_title']; } ?>"  placeholder="Enter Discussion Title" required >
                        </div>
                        <div class="form-group col-md-12 select_sm">
                          <label>Description</label>
                          <textarea class="textarea form-control form-control-sm" name="project_discussion_descr" id="project_discussion_descr" rows="8" required><?php if(isset($project_discussion_info)){ echo $project_discussion_info['project_discussion_descr']; } ?></textarea>
                        </div>
                      </div>
                      <div class="card-footer clearfix" style="display: block;">
                        <div class="row">
                          <div class="col-md-6 text-left">
                            <!-- <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" name="project_discussion_status" id="project_discussion_status" value="0" <?php if(isset($project_discussion_info) && $project_discussion_info['project_discussion_status'] == 0){ echo 'checked'; } ?>>
                              <label for="project_discussion_status" class="custom-control-label no_bold">Disable This Unit</label>
                            </div> -->
                          </div>
                          <div class="col-md-6 text-right">
                            <a href="<?php echo base_url(); ?>Project/project_det_discussion" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                            <?php if(isset($update)){
                              echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                            } else{
                              echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
                            } ?>
                          </div>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th class="d-none">#</th>
                        <th class="wt_50">Action</th>
                        <th class="">Title</th>
                        <th class="wt_50">Date</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($project_discussion_list)){
                        $i=0; foreach ($project_discussion_list as $list) { $i++;
                        ?>
                          <tr>
                            <td class="d-none"><?php echo $i; ?></td>
                            <td>
                              <div class="btn-group">
                                <a href="<?php echo base_url() ?>Project/edit_project_det_discussion/<?php echo $list->project_discussion_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                                <a href="<?php echo base_url() ?>Project/delete_project_det_discussion/<?php echo $list->project_discussion_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Discussion');"><i class="fa fa-trash text-danger"></i></a>
                              </div>
                            </td>
                            <td><?php echo $list->project_discussion_title; ?></td>
                            <td><?php echo $list->project_discussion_date; ?></td>
                          </tr>
                        <?php } } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-4">
                    <?php include('project_det_side_info.php'); ?>
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
