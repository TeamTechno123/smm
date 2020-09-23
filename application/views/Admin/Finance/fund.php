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
            <h4>Fund Information</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Fund</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Finance/fund" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-6 ">
                        <label>Fund Vch. No</label>
                        <input type="number" min="1" class="form-control form-control-sm" name="fund_no" id="fund_no" value="<?php if(isset($fund_info)){ echo $fund_info['fund_no']; } else{ echo $fund_no; } ?>" placeholder="Enter Fund Vch. No" required readonly>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Fund Vch. Date</label>
                        <input type="text" class="form-control form-control-sm" name="fund_date" value="<?php if(isset($fund_info)){ echo $fund_info['fund_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Fund Date" required>
                      </div>
                      <div class="form-group col-md-12 select_sm">
                        <label>Select Reseller</label>
                        <select class="form-control select2 form-control-sm" name="reseller_id" id="reseller_id" data-placeholder="Select Reseller" required>
                          <option value="">Select Reseller</option>
                          <?php if(isset($reseller_list)){ foreach ($reseller_list as $list) { ?>
                          <option value="<?php echo $list->reseller_id; ?>" <?php if(isset($fund_info) && $fund_info['reseller_id'] == $list->reseller_id){ echo 'selected'; } if($list->reseller_status == '0'){ echo 'disabled'; } ?>><?php echo $list->reseller_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <!-- <div class="form-group col-md-12 ">
                        <label>Fund Name</label>
                        <input type="text" class="form-control form-control-sm" name="fund_name" id="fund_name" value="<?php if(isset($fund_info)){ echo $fund_info['fund_name']; } ?>" placeholder="Enter Fund Name" required>
                      </div> -->
                      <div class="form-group col-md-12 ">
                        <label>Description</label>
                        <textarea class=" form-control form-control-sm" name="fund_descr" id="fund_descr" rows="8"><?php if(isset($fund_info)){ echo $fund_info['fund_descr']; } ?></textarea>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Amount</label>
                        <input type="number" min="0" class="form-control form-control-sm" name="fund_amount" id="fund_amount" value="<?php if(isset($fund_info)){ echo $fund_info['fund_amount']; } ?>" placeholder="Enter Amount" required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Ref. No.</label>
                        <input type="text" class="form-control form-control-sm" name="fund_ref_no" id="fund_ref_no" value="<?php if(isset($fund_info)){ echo $fund_info['fund_ref_no']; } ?>" placeholder="Enter Ref. No." required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Attachment</label>
                        <input type="file" class="form-control form-control-sm" name="fund_image" id="fund_image">
                        <label>.jpg/.png/.jpeg Image & size less than 500kb.</label>
                      </div>
                      <?php if(isset($fund_info) && $fund_info['fund_image']){ ?>
                        <div class="form-group col-md-4">
                          <input type="hidden" name="old_fund_image" value="<?php echo $fund_info['fund_image']; ?>">
                          <img width="150px" src="<?php echo base_url(); ?>assets/images/fund/<?php echo $fund_info['fund_image']; ?>" alt="">
                        </div>
                      <?php } ?>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="fund_status" id="fund_status" value="0" <?php if(isset($fund_info) && $fund_info['fund_status'] == 0){ echo 'checked'; } ?>>
                            <label for="fund_status" class="custom-control-label">Disable This Fund</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Finance/fund" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Fund Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th class="wt_75">Fund Vch. No.</th>
                    <th class="">Resaller</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_75">Amount</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($fund_list)){
                     $i=0; foreach ($fund_list as $list) { $i++;
                       $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->reseller_id, '', '', '', '', 'smm_reseller');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-fund">
                          <a href="<?php echo base_url() ?>Finance/edit_fund/<?php echo $list->fund_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Finance/delete_fund/<?php echo $list->fund_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Fund Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->fund_no; ?></td>
                      <td><?php if($reseller_info) { echo $reseller_info[0]['reseller_name']; } ?></td>
                      <td><?php echo $list->fund_date; ?></td>
                      <td><?php echo $list->fund_amount; ?></td>
                      <td>
                        <?php if($list->fund_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
