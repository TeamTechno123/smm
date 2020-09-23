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
            <h4>Sale Type</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Sale Type</h3>
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
                    <div class="form-group col-md-12">
                      <label>Sale Type Name</label>
                      <input type="text" class="form-control form-control-sm" name="sale_type_name" id="sale_type_name" value="<?php if(isset($sale_type_info)){ echo $sale_type_info['sale_type_name']; } ?>"  placeholder="Enter Name of Sale Type" required >
                    </div>
                    <div class="form-group col-md-12">
                      <label>Invoice Title (Heading Name)</label>
                      <input type="text" class="form-control form-control-sm" name="sale_type_inv_title" id="sale_type_inv_title" value="<?php if(isset($sale_type_info)){ echo $sale_type_info['sale_type_inv_title']; } ?>"  placeholder="Enter Title of Invoice" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Invoice Number Prefix</label>
                      <input type="text" class="form-control form-control-sm" name="sale_type_inv_prefix" id="sale_type_inv_prefix" value="<?php if(isset($sale_type_info)){ echo $sale_type_info['sale_type_inv_prefix']; } ?>"  placeholder="Enter Invoice Number Prefix" >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Invoice No Starting From</label>
                      <input type="number" min="1" start="1" class="form-control form-control-sm" name="sale_type_inv_start" id="sale_type_inv_start" value="<?php if(isset($sale_type_info)){ echo $sale_type_info['sale_type_inv_start']; } ?>"  placeholder="Enter Invoice No Starting From" >
                    </div>
                    <div class="form-group col-3">
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="sale_type_tax_excl" name="sale_type_tax_type" value="1" <?php if(isset($sale_type_info) && $sale_type_info['sale_type_tax_type'] == '1' ){ echo 'checked'; } elseif(!isset($sale_type_info)){ echo 'checked'; } ?>>
                        <label for="sale_type_tax_excl" class="custom-control-label">Tax Exclusive</label>
                      </div>
                    </div>
                    <div class="form-group col-3">
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="sale_type_tax_inc" name="sale_type_tax_type" value="2" <?php if(isset($sale_type_info) && $sale_type_info['sale_type_tax_type'] == '2' ){ echo 'checked'; } ?>>
                        <label for="sale_type_tax_inc" class="custom-control-label">Custom Inclusive</label>
                      </div>
                    </div>



                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="sale_type_status" id="sale_type_status" value="0" <?php if(isset($sale_type_info) && $sale_type_info['sale_type_status'] == 0){ echo 'checked'; } ?>>
                          <label for="sale_type_status" class="custom-control-label">Disable This Sale Type</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Master/sale_type" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Sale Type</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Sale Type Name</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($sale_type_list)){
                    $i=0; foreach ($sale_type_list as $list) { $i++; ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Master/edit_sale_type/<?php echo $list->sale_type_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Master/delete_sale_type/<?php echo $list->sale_type_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Sale Type');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->sale_type_name; ?></td>
                        <td>
                          <?php if($list->sale_type_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
