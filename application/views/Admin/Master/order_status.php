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
            <h4>Order Status</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?> card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Order Status</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                  <div class="row p-4">
                    <div class="form-group col-md-6 select_sm">
                      <label>Order Status Name</label>
                      <input type="text" class="form-control form-control-sm" name="order_status_name" id="order_status_name" value="<?php if(isset($order_status_info)){ echo $order_status_info['order_status_name']; } ?>"  placeholder="Enter Name of Order Status" required >
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="order_status_status" id="order_status_status" value="0" <?php if(isset($order_status_info) && $order_status_info['order_status_status'] == 0){ echo 'checked'; } ?>>
                          <label for="order_status_status" class="custom-control-label">Disable This Order Status</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Master/order_status" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Order Status</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Order Status Name</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($order_status_list)){
                    $i=0; foreach ($order_status_list as $list) { $i++; ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Master/edit_order_status/<?php echo $list->order_status_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Master/delete_order_status/<?php echo $list->order_status_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Order Status');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->order_status_name; ?></td>
                        <td>
                          <?php if($list->order_status_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                            else{ echo '<span class="text-success">Active</span>'; } ?>
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
