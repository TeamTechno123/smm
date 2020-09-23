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
            <h4>Product</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Product</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <!-- <div class="form-group col-md-6 select_sm">
                      <label>Select Type of Category</label>
                      <select class="form-control select2 form-control-sm" name="product_category_type" id="product_category_type" data-placeholder="Select Type of Category" required>
                        <option value="">Select Type of Category</option>
                        <option value="1" <?php if(isset($product_info) && $product_info['product_category_type'] == '1'){ echo 'selected'; } ?>>Product</option>
                        <option value="2" <?php if(isset($product_info) && $product_info['product_category_type'] == '2'){ echo 'selected'; } ?>>Service</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Select Category</label>
                      <select class="form-control select2" name="product_category_id" id="product_category_id" data-placeholder="Select Category" required>
                        <option value="">Select Category</option>
                        <?php if(isset($product_category_list)){ foreach ($product_category_list as $list) { ?>
                        <option value="<?php echo $list->product_category_id; ?>" <?php if(isset($product_info) && $product_info['product_category_id'] == $list->product_category_id){ echo 'selected'; } ?>><?php echo $list->product_category_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div> -->
                    <div class="form-group col-md-12">
                      <label>Product / Service Name</label>
                      <input type="text" class="form-control form-control-sm" name="product_name" id="product_name" value="<?php if(isset($product_info)){ echo $product_info['product_name']; } ?>"  placeholder="Enter Name of Product / Service" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Short Name</label>
                      <input type="text" class="form-control form-control-sm" name="product_short_name" id="product_short_name" value="<?php if(isset($product_info)){ echo $product_info['product_short_name']; } ?>"  placeholder="Enter Short Name" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>HSN / SAC Code</label>
                      <input type="text" class="form-control form-control-sm" name="product_hsn_code" id="product_hsn_code" value="<?php if(isset($product_info)){ echo $product_info['product_hsn_code']; } ?>"  placeholder="Enter HSN / SAC Code" required >
                    </div>


                    <div class="form-group col-md-6 select_sm">
                      <label>Item Company</label>
                      <select class="form-control select2" name="item_company_id" id="item_company_id" data-placeholder="Select Item Company" required>
                        <option value="">Select Item Company</option>
                        <?php if(isset($item_company_list)){ foreach ($item_company_list as $list) { ?>
                        <option value="<?php echo $list->item_company_id; ?>" <?php if(isset($product_info) && $product_info['item_company_id'] == $list->item_company_id){ echo 'selected'; } if($list->item_company_status == 0){ echo 'disabled'; } ?>><?php echo $list->item_company_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Item Group</label>
                      <select class="form-control select2" name="item_group_id" id="item_group_id" data-placeholder="Select Item Group" required>
                        <option value="">Select Item Group</option>
                        <?php if(isset($item_group_list)){ foreach ($item_group_list as $list) { ?>
                        <option value="<?php echo $list->item_group_id; ?>" <?php if(isset($product_info) && $product_info['item_group_id'] == $list->item_group_id){ echo 'selected'; } if($list->item_group_status == 0){ echo 'disabled'; } ?>><?php echo $list->item_group_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>


                    <div class="form-group col-md-6 select_sm">
                      <label>Select GST</label>
                      <select class="form-control select2" name="gst_slab_id" id="gst_slab_id" data-placeholder="Select GST" required>
                        <option value="">Select GST</option>
                        <?php if(isset($gst_slab_list)){ foreach ($gst_slab_list as $list) { ?>
                        <option value="<?php echo $list->gst_slab_id; ?>" <?php if(isset($product_info) && $product_info['gst_slab_id'] == $list->gst_slab_id){ echo 'selected'; } if($list->gst_slab_status == 0){ echo 'disabled'; } ?>><?php echo $list->gst_slab_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Select Unit</label>
                      <select class="form-control select2" name="unit_id" id="unit_id" data-placeholder="Select Unit" required>
                        <option value="">Select Unit</option>
                        <?php if(isset($unit_list)){ foreach ($unit_list as $list) { ?>
                        <option value="<?php echo $list->unit_id; ?>" <?php if(isset($product_info) && $product_info['unit_id'] == $list->unit_id){ echo 'selected'; } if($list->unit_status == 0){ echo 'disabled'; } ?>><?php echo $list->unit_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>

                    <div class="form-group col-md-12">
                      <label>Description</label>
                      <textarea class="form-control form-control-sm" rows="3" name="product_descr" id="product_descr" placeholder="Enter Product Description" required><?php if(isset($product_info)){ echo $product_info['product_descr']; } ?></textarea>
                    </div>
                    <!-- <div class="form-group col-md-6">
                      <label>Rate</label>
                      <input type="number" min="0" class="form-control form-control-sm" name="product_rate" id="product_rate" value="<?php if(isset($product_info)){ echo $product_info['product_rate']; } ?>"  placeholder="Enter Rate" required >
                    </div> -->
                    <!-- <div class="form-group col-md-6 select_sm">
                      <label>Select Duration</label>
                      <select class="form-control select2" name="product_duration" id="product_duration" data-placeholder="Select Duration" required>
                        <option value="">Select Duration</option>
                        <option value="30" <?php if(isset($product_info) && $product_info['product_duration'] == '30'){ echo 'selected'; } ?>>On Every 30 Days</option>
                      </select>
                    </div> -->
                    <div class="form-group col-md-4">
                      <label>Product Image</label>
                      <input type="file" class="form-control form-control-sm" name="product_image" id="product_image">
                      <label>.jpg/.jpeg/.png file. Size less than 500kb.</label>
                    </div>
                    <?php if(isset($product_info) && $product_info['product_image']){ ?>
                      <div class="form-group col-md-4">
                        <input type="hidden" name="old_product_image" value="<?php echo $product_info['product_image']; ?>">
                        <img width="150px" src="<?php echo base_url(); ?>assets/images/product/<?php echo $product_info['product_image']; ?>" alt="">
                      </div>
                    <?php } ?>



                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="product_status" id="product_status" value="0" <?php if(isset($product_info) && $product_info['product_status'] == 0){ echo 'checked'; } ?>>
                          <label for="product_status" class="custom-control-label">Disable This Product</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Product/product" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Product</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Product Name</th>
                    <th>Short Name</th>
                    <th class="">Group</th>
                    <th class="wt_50">Unit</th>
                    <th class="wt_50">GST</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($product_list)){
                      $i=0; foreach ($product_list as $list) { $i++;
                        $item_group_info = $this->Master_Model->get_info_arr_fields3('item_group_name', '', 'item_group_id', $list->item_group_id, '', '', '', '', 'smm_item_group');
                        $unit_info = $this->Master_Model->get_info_arr_fields3('unit_name', '', 'unit_id', $list->unit_id, '', '', '', '', 'smm_unit');
                        $gst_slab_info = $this->Master_Model->get_info_arr_fields3('gst_slab_name', '', 'gst_slab_id', $list->gst_slab_id, '', '', '', '', 'smm_gst_slab');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Product/edit_product/<?php echo $list->product_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Product/delete_product/<?php echo $list->product_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Product');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->product_name; ?></td>
                        <td><?php echo $list->product_short_name; ?></td>
                        <td><?php if($item_group_info){ echo $item_group_info[0]['item_group_name']; } ?></td>
                        <td><?php if($unit_info){ echo $unit_info[0]['unit_name']; } ?></td>
                        <td><?php if($gst_slab_info){ echo $gst_slab_info[0]['gst_slab_name']; } ?></td>
                        <td><img width="50px" src="<?php echo base_url() ?>assets/images/product/<?php echo $list->product_image;  ?>" alt="Product Image">
                        <td>
                          <?php if($list->product_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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

<script type="text/javascript">

  $("#product_category_type").on("change", function(){
    var product_category_type =  $('#product_category_type').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/category_by_type',
      type: 'POST',
      data: {"product_category_type":product_category_type},
      context: this,
      success: function(result){
        $('#product_category_id').html(result);
      }
    });
  });
</script>
