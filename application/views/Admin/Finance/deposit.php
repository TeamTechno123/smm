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
            <h4>Deposit</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Deposit</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Finance/deposit" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 select_sm">
                            <label>Select Account</label>
                            <select class="form-control select2 form-control-sm" name="bank_account_id" id="bank_account_id" data-placeholder="Select Account" required>
                              <option value="">Select Account</option>
                              <?php if(isset($bank_account_list)){ foreach ($bank_account_list as $list) { ?>
                              <option value="<?php echo $list->bank_account_id; ?>" <?php if(isset($deposit_info) && $deposit_info['bank_account_id'] == $list->bank_account_id){ echo 'selected'; } if($list->bank_account_status == '0'){ echo 'disabled'; } ?>><?php echo $list->bank_account_name; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Amount</label>
                            <input type="number" min="1" class="form-control form-control-sm" name="deposit_amount" id="deposit_amount" value="<?php if(isset($deposit_info)){ echo $deposit_info['deposit_amount']; } ?>" placeholder="Enter Amount" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Date</label>
                            <input type="text" class="form-control form-control-sm" name="deposit_date" value="<?php if(isset($deposit_info)){ echo $deposit_info['deposit_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Deposit Date" required>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Category</label>
                            <select class="form-control select2 form-control-sm" name="deposit_category" id="deposit_category" data-placeholder="Select Category" required>
                              <option value="">Select Category</option>
                              <option value="Demo1">Demo1</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Payer</label>
                            <select class="form-control select2 form-control-sm" name="deposit_payer" id="deposit_payer" data-placeholder="Select Payer">
                              <option value="">Select Payer</option>
                              <option value="Demo1">Demo1</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Payment Method</label>
                            <select class="form-control select2 form-control-sm" name="deposit_pay_method" id="deposit_pay_method" data-placeholder="Select Payment Method">
                              <option value="">Select Payment Method</option>
                              <option value="Cash">Cash</option>
                              <option value="Cheque">Cheque</option>
                              <option value="Online Transfer">Online Transfer</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Ref Number</label>
                            <input type="text" class="form-control form-control-sm" name="deposit_ref_no" id="deposit_ref_no" value="<?php if(isset($deposit_info)){ echo $deposit_info['deposit_ref_no']; } ?>" placeholder="Enter Ref Number" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group col-md-12 ">
                          <label>Description</label>
                          <textarea class=" form-control form-control-sm" name="deposit_descr" id="deposit_descr" rows="8"><?php if(isset($deposit_info)){ echo $deposit_info['deposit_descr']; } ?></textarea>
                        </div>
                        <div class="form-group col-md-8">
                          <label>Attach File</label>
                          <input type="file" class="form-control form-control-sm" name="deposit_image" id="deposit_image">
                          <label>.jpg/.png/.jpeg Image & size less than 500kb.</label>
                        </div>
                        <div class="form-group col-md-4">
                        <?php if(isset($deposit_info) && $deposit_info['deposit_image']){ ?>
                          <input type="hidden" name="old_deposit_image" value="<?php echo $deposit_info['deposit_image']; ?>">
                          <img width="150px" src="<?php echo base_url(); ?>assets/images/deposit/<?php echo $deposit_info['deposit_image']; ?>" alt="">
                        <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="deposit_status" id="deposit_status" value="0" <?php if(isset($deposit_info) && $deposit_info['deposit_status'] == 0){ echo 'checked'; } ?>>
                            <label for="deposit_status" class="custom-control-label">Disable This Deposit</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Finance/deposit" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
              <div class="card-header">
                <h3 class="card-title">List All Deposit Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Account</th>
                    <th class="wt_150">Payer</th>
                    <th class="wt_50">Amount</th>
                    <th class="wt_50">Category</th>
                    <th class="wt_50">Ref No.</th>
                    <th class="wt_50">Method</th>
                    <th class="wt_50">Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($deposit_list)){
                     $i=0; foreach ($deposit_list as $list) { $i++;
                       $bank_account_info = $this->Master_Model->get_info_arr_fields3('bank_account_name', '', 'bank_account_id', $list->bank_account_id, '', '', '', '', 'smm_bank_account');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-deposit">
                          <a href="<?php echo base_url() ?>Finance/edit_deposit/<?php echo $list->deposit_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Finance/delete_deposit/<?php echo $list->deposit_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Deposit Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($bank_account_info) { echo $bank_account_info[0]['bank_account_name']; } ?></td>
                      <td><?php echo $list->deposit_payer; ?></td>
                      <td><?php echo $list->deposit_amount; ?></td>
                      <td><?php echo $list->deposit_category; ?></td>
                      <td><?php echo $list->deposit_ref_no; ?></td>
                      <td><?php echo $list->deposit_pay_method; ?></td>
                      <td><?php echo $list->deposit_date; ?></td>
                      <!-- <td>
                        <?php if($list->deposit_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                          else{ echo '<span class="text-success">Active</span>'; } ?>
                      </td> -->
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
