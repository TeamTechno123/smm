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
            <h4>Coupon</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Coupon</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Company/coupon" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-8 offset-md-2 select_sm">
                      <label>Select Coupon Type</label>
                      <select class="form-control select2 form-control-sm" name="coupon_type" id="coupon_type" data-placeholder="Select Coupon Type" required>
                        <option value="">Select Coupon Type</option>
                        <option value="1" <?php if(isset($coupon_info) && $coupon_info['coupon_type'] == '1'){ echo 'selected'; } ?>>Demo1</option>
                      </select>
                    </div>
                    <div class="form-group col-md-8 offset-md-2 ">
                      <label>Coupon Code</label>
                      <input type="text" class="form-control form-control-sm" name="coupon_code" id="coupon_code" value="<?php if(isset($coupon_info)){ echo $coupon_info['coupon_code']; } ?>" placeholder="Enter Coupon Code" required>
                    </div>
                    <div class="form-group col-md-4 offset-md-2 ">
                      <label>Rate</label>
                      <input type="number" min="0" step="1" class="form-control form-control-sm" name="coupon_rate" id="coupon_rate" value="<?php if(isset($coupon_info)){ echo $coupon_info['coupon_rate']; } ?>" placeholder="Enter Rate" required>
                    </div>
                    <div class="form-group col-md-4 ">
                      <label>Percentage</label>
                      <input type="number" min="0" max="100" class="form-control form-control-sm" name="coupon_percentage" id="coupon_percentage" value="<?php if(isset($coupon_info)){ echo $coupon_info['coupon_percentage']; } ?>" placeholder="Enter Percentage" required>
                    </div>
                    <div class="form-group col-md-4 offset-md-2 ">
                      <label>Number of Times Redeem Per User</label>
                      <input type="number" min="0" step="1" class="form-control form-control-sm" name="coupon_redeem_per_user" id="coupon_redeem_per_user" value="<?php if(isset($coupon_info)){ echo $coupon_info['coupon_redeem_per_user']; } ?>" placeholder="Enter Number of Times Redeem Per User" required>
                    </div>
                    <div class="form-group col-md-4 ">
                    </div>

                    <div class="form-group col-md-4 offset-md-2 ">
                      <label>Coupon Start Date</label>
                      <input type="text" class="form-control form-control-sm" name="coupon_start_date" value="<?php if(isset($coupon_info)){ echo $coupon_info['coupon_start_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Coupon Start Date" required>
                    </div>
                    <div class="form-group col-md-4 ">
                      <label>Coupon End Date</label>
                      <input type="text" class="form-control form-control-sm" name="coupon_end_date" value="<?php if(isset($coupon_info)){ echo $coupon_info['coupon_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Coupon End Date" required>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="coupon_status" id="coupon_status" value="0" <?php if(isset($coupon_info) && $coupon_info['coupon_status'] == 0){ echo 'checked'; } ?>>
                          <label for="coupon_status" class="custom-control-label">Disable This Coupon</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Company/coupon" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Coupon Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Coupon Code</th>
                    <th class="wt_50">Rate</th>
                    <th class="wt_50">Percentage</th>
                    <th class="wt_75">Start Date</th>
                    <th class="wt_75">End Date</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($coupon_list)){
                     $i=0; foreach ($coupon_list as $list) { $i++;
                       // $employee_info = $this->Master_Model->get_info_arr_fields3('user_name, user_lname', '', 'user_id', $list->coupon_type, '', '', '', '', 'user');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-coupon">
                          <a href="<?php echo base_url() ?>Company/edit_coupon/<?php echo $list->coupon_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Company/delete_coupon/<?php echo $list->coupon_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Coupon');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <!-- <td><?php if($employee_info) { echo $employee_info[0]['user_name'].' '.$employee_info[0]['user_lname']; } ?></td> -->
                      <td><?php echo $list->coupon_code; ?></td>
                      <td><?php echo $list->coupon_rate; ?></td>
                      <td><?php echo $list->coupon_percentage; ?></td>
                      <td><?php echo $list->coupon_start_date; ?></td>
                      <td><?php echo $list->coupon_end_date; ?></td>
                      <td>
                        <?php if($list->coupon_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
