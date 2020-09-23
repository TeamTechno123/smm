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
            <h4>Bank Account</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Bank Account</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Finance/bank_account" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">

                      <div class="form-group col-md-6 ">
                        <label>Bank Account Name</label>
                        <input type="text" class="form-control form-control-sm" name="bank_account_name" id="bank_account_name" value="<?php if(isset($bank_account_info)){ echo $bank_account_info['bank_account_name']; } ?>" placeholder="Enter Bank Account Name" required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Account Number</label>
                        <input type="text" class="form-control form-control-sm" name="bank_account_number" id="bank_account_number" value="<?php if(isset($bank_account_info)){ echo $bank_account_info['bank_account_number']; } ?>" placeholder="Enter Account Number" required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Initial Balance</label>
                        <input type="number" min="1" class="form-control form-control-sm" name="bank_account_in_balance" id="bank_account_in_balance" value="<?php if(isset($bank_account_info)){ echo $bank_account_info['bank_account_in_balance']; } ?>" placeholder="Enter Initial Balance" required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Branch Code</label>
                        <input type="text" class="form-control form-control-sm" name="bank_account_branch_code" id="bank_account_branch_code" value="<?php if(isset($bank_account_info)){ echo $bank_account_info['bank_account_branch_code']; } ?>" placeholder="Enter Branch Code" >
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Bank Branch</label>
                        <textarea class=" form-control form-control-sm" name="bank_account_branch" id="bank_account_branch" rows="8"><?php if(isset($bank_account_info)){ echo $bank_account_info['bank_account_branch']; } ?></textarea>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="bank_account_status" id="bank_account_status" value="0" <?php if(isset($bank_account_info) && $bank_account_info['bank_account_status'] == 0){ echo 'checked'; } ?>>
                            <label for="bank_account_status" class="custom-control-label">Disable This Bank Account</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Finance/bank_account" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Bank Account Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Bank Account Name</th>
                    <th class="wt_75">Account No.</th>
                    <th class="wt_50">Branch Code</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($bank_account_list)){
                     $i=0; foreach ($bank_account_list as $list) { $i++;
                       // $bank_account_type_info = $this->Master_Model->get_info_arr_fields3('bank_account_type_name', '', 'bank_account_type_id', $list->bank_account_type_id, '', '', '', '', 'smm_bank_account_type');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Finance/edit_bank_account/<?php echo $list->bank_account_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Finance/delete_bank_account/<?php echo $list->bank_account_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Bank Account Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->bank_account_name; ?></td>
                      <td><?php echo $list->bank_account_number; ?></td>
                      <td><?php echo $list->bank_account_branch_code; ?></td>
                      <td>
                        <?php if($list->bank_account_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
