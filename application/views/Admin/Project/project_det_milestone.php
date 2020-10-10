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
              <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                <div class="row p-4">
                  <?php
                  $client_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $project_info['client_id'], '', '', '', '', 'smm_reseller');
                  ?>
                  <div class="col-md-8">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th class="d-none">#</th>
                        <!-- <th class="wt_50">Action</th> -->
                        <th>Title</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th class="wt_50">Status</th>
                        <!-- <th class="wt_50">Status</th> -->
                      </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($project_del_phase_list)){
                          $i=0; foreach ($project_del_phase_list as $list) { $i++;
                            // $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                            // $project_del_phase_category_info = $this->Master_Model->get_info_arr_fields3('project_del_phase_category_name', '', 'project_del_phase_category_id', $list->project_del_phase_category_id, '', '', '', '', 'smm_project_del_phase_category');
                        ?>
                          <tr>
                            <td class="d-none"><?php echo $i; ?></td>
                            <!-- <td class="text-center">
                              <div class="btn-group">
                                <a href="<?php echo base_url() ?>Project/edit_project_del_phase/<?php echo $list->project_del_phase_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                                <a href="<?php echo base_url() ?>Project/delete_project_del_phase/<?php echo $list->project_del_phase_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Project Revision');"><i class="fa fa-trash text-danger"></i></a>
                              </div>
                            </td> -->
                            <td><?php echo $list->project_del_phase_descr; ?></td>
                            <td><?php $date = strtotime($list->project_del_phase_date);
                             echo date('d-m-Y', $date) ; ?></td>
                            <td><?php echo $list->project_del_phase_amount; ?></td>
                            <td><?php if($list->project_del_phase_status == 0){
                              echo '<span class="text-danger">Pending</span>';
                            } elseif($list->project_del_phase_status == 1){
                              echo '<span class="text-success">Complete</span>';
                            } ?></td>


                          </tr>
                        <?php } } ?>
                      </tbody>
                    </table>
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
