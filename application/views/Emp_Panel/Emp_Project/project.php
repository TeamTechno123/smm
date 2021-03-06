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
            <h4>Project</h4>
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
                <h3 class="card-title">List All Project</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <!-- <th class="wt_50">Action</th> -->
                    <th>Project Name</th>
                    <th class="wt_75">Client</th>
                    <th class="wt_75">Priority</th>
                    <th class="wt_50">Start Date</th>
                    <th class="wt_50">End Date</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($project_list)){
                    $i=0; foreach ($project_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->client_id, '', '', '', '', 'smm_reseller');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <!-- <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Project/edit_project/<?php echo $list->project_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Project/delete_project/<?php echo $list->project_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Project');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td> -->
                        <td>
                          <a href="<?php echo base_url() ?>Emp_Panel/Emp_Project/set_project_session/<?php echo $list->project_id; ?>"><?php echo $list->project_name; ?></a>

                        </td>
                        <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td>
                        <td><?php echo $list->project_piority; ?></td>
                        <td><?php echo $list->project_start_date; ?></td>
                        <td><?php echo $list->project_end_date; ?></td>
                        <td>
                          <?php if($list->project_status == 0){ echo '<span class="text-warning"><b>Not Started</b></span>'; }
                            elseif($list->project_status == 1){ echo '<span class="text-primary"><b>In Progress</b></span>'; }
                            elseif($list->project_status == 2){ echo '<span class="text-success"><b>Completed</b></span>'; }
                            elseif($list->project_status == 3){ echo '<span class="text-danger"><b>Cancelled</b></span>'; }
                            elseif($list->project_status == 4){ echo '<span class="text-info"><b>Hold</b></span>'; } ?>
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
