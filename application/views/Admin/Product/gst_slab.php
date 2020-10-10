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
            <h4>GST Slab</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> GST Slab</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Product/gst_slab" type="button" class="btn btn-sm btn-outline-info" >Cancel Update</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body p-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-12 ">
                        <label>Title of GST Slab</label>
                        <input type="text" class="form-control form-control-sm" name="gst_slab_name" id="gst_slab_name" value="<?php if(isset($gst_slab_info)){ echo $gst_slab_info['gst_slab_name']; } ?>" placeholder="Enter Title of GST Slab" required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Tax Percentage(%)</label>
                        <input type="number" min="0" max="100" class="form-control form-control-sm" name="gst_slab_per" id="gst_slab_per" value="<?php if(isset($gst_slab_info)){ echo $gst_slab_info['gst_slab_per']; } ?>" placeholder="Enter Tax Percentage(%)" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Taxation Type</label>
                        <select class="form-control select2 form-control-sm" name="gst_slab_tax_type" id="gst_slab_tax_type" data-placeholder="Select Taxation Type" required>
                          <option value="">Select Taxation Type</option>
                          <option value="1" <?php if(isset($gst_slab_info) && $gst_slab_info['gst_slab_tax_type'] == '1'){ echo 'selected'; } ?>>GST</option>
                          <option value="2" <?php if(isset($gst_slab_info) && $gst_slab_info['gst_slab_tax_type'] == '2'){ echo 'selected'; } ?>>VAT</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Cess</label>
                        <input type="number" min="0" max="100" class="form-control form-control-sm" name="gst_slab_sess" id="gst_slab_sess" value="<?php if(isset($gst_slab_info)){ echo $gst_slab_info['gst_slab_sess']; } ?>" placeholder="Enter Cess" required>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="gst_slab_status" id="gst_slab_status" value="0" <?php if(isset($gst_slab_info) && $gst_slab_info['gst_slab_status'] == 0){ echo 'checked'; } ?>>
                            <label for="gst_slab_status" class="custom-control-label">Disable This GST Slab</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Product/gst_slab" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All GST Slab Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>GST Slab Name</th>
                    <th class="wt_50">Tax Percentage(%)</th>
                    <th class="wt_75">Taxation Type</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($gst_slab_list)){
                     $i=0; foreach ($gst_slab_list as $list) { $i++;
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-gst_slab">
                          <a href="<?php echo base_url() ?>Product/edit_gst_slab/<?php echo $list->gst_slab_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Product/delete_gst_slab/<?php echo $list->gst_slab_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this GST Slab Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->gst_slab_name; ?></td>
                      <td><?php echo $list->gst_slab_per; ?></td>
                      <td><?php if($list->gst_slab_tax_type == 1){ echo 'GST'; }
                      else{ echo 'VAT'; }  ?></td>
                      <td>
                        <?php if($list->gst_slab_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
