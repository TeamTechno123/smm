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
            <h4>Payment Gateway</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?>">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Payment Gateway</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Company/payment_gateway" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-8 offset-md-2 ">
                      <label>Payment Gateway Name</label>
                      <input type="text" class="form-control form-control-sm" name="payment_gateway_name" id="payment_gateway_name" value="<?php if(isset($payment_gateway_info)){ echo $payment_gateway_info['payment_gateway_name']; } ?>" placeholder="Enter Payment Gateway Name" required>
                    </div>
                    <div class="form-group col-md-8 offset-md-2 ">
                      <label>Key Id</label>
                      <input type="text" class="form-control form-control-sm" name="payment_gateway_key_id" id="payment_gateway_key_id" value="<?php if(isset($payment_gateway_info)){ echo $payment_gateway_info['payment_gateway_key_id']; } ?>" placeholder="Enter Key Id" required>
                    </div>
                    <div class="form-group col-md-8 offset-md-2 ">
                      <label>Secret Key</label>
                      <input type="text" class="form-control form-control-sm" name="payment_gateway_secret_key" id="payment_gateway_secret_key" value="<?php if(isset($payment_gateway_info)){ echo $payment_gateway_info['payment_gateway_secret_key']; } ?>" placeholder="Enter Secret Key" required>
                    </div>
                    <div class="form-group col-md-4 offset-md-2 select_sm ">
                      <label>Type</label>
                      <select class="form-control select2 form-control-sm" name="payment_gateway_type" id="payment_gateway_type" data-placeholder="Select Coupon Type" required>
                        <option value="">Select Coupon Type</option>
                        <option value="1" <?php if(isset($payment_gateway_info) && $payment_gateway_info['payment_gateway_type'] == '1'){ echo 'selected'; } ?>>Test Mode</option>
                        <option value="2" <?php if(isset($payment_gateway_info) && $payment_gateway_info['payment_gateway_type'] == '2'){ echo 'selected'; } ?>>Live Mode</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4 ">
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="payment_gateway_status" id="payment_gateway_status" value="0" <?php if(isset($payment_gateway_info) && $payment_gateway_info['payment_gateway_status'] == 0){ echo 'checked'; } ?>>
                          <label for="payment_gateway_status" class="custom-control-label">Disable This Payment Gateway</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Company/payment_gateway" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                        <?php if(isset($update)){
                          echo '<button type="submit" class="btn btn-sm btn-primary float-right px-4">Update</button>';
                        } else{
                          echo '<button type="submit" class="btn btn-sm btn-success float-right px-4">Save</button>';
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
              <div class="card-header">
                <h3 class="card-title">List All Payment Gateway Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Payment Gateway Name</th>
                    <th class="wt_75">Type</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($payment_gateway_list)){
                     $i=0; foreach ($payment_gateway_list as $list) { $i++;
                       // $employee_info = $this->Master_Model->get_info_arr_fields3('user_name, user_lname', '', 'user_id', $list->payment_gateway_type, '', '', '', '', 'user');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-payment_gateway">
                          <a href="<?php echo base_url() ?>Company/edit_payment_gateway/<?php echo $list->payment_gateway_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Company/delete_payment_gateway/<?php echo $list->payment_gateway_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Payment Gateway');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <!-- <td><?php if($employee_info) { echo $employee_info[0]['user_name'].' '.$employee_info[0]['user_lname']; } ?></td> -->
                      <td><?php echo $list->payment_gateway_name; ?></td>
                      <td><?php if($list->payment_gateway_type == 1){ echo 'Test Mode'; }
                          else{ echo 'Live Mode'; } ?></td>
                      <td>
                        <?php if($list->payment_gateway_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
