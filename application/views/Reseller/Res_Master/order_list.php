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
            <h4>Order List</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Order</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Order Name</th>
                    <th class="wt_75">Client</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_75">Amount</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <!-- <tbody>
                    <?php if(isset($project_list)){
                    $i=0; foreach ($project_list as $list) { $i++;
                      $client_info = $this->Master_Model->get_info_arr_fields3('client_name', '', 'client_id', $list->client_id, '', '', '', '', 'smm_client');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Reseller/Res_Order/view_project/<?php echo $list->project_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-eye text-success"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->project_name; ?></td>
                        <td><?php if($client_info){ echo $client_info[0]['client_name']; } ?></td>
                        <td><?php echo $list->project_piority; ?></td>
                        <td><?php echo $list->project_start_date; ?></td>
                        <td><?php echo $list->project_end_date; ?></td>
                        <td>
                          <?php if($list->project_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                            else{ echo '<span class="text-success">Active</span>'; } ?>
                        </td>
                      </tr>
                    <?php } } ?>
                  </tbody> -->
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
