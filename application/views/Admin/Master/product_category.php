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
            <h4>Product / Service Category</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Product / Service Category</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Master/product_category" type="button" class="btn btn-sm btn-outline-info" >Cancel Update</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body p-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-6 select_sm">
                        <label>Select Type of Category</label>
                        <select class="form-control select2 form-control-sm" name="product_category_type" id="product_category_type" data-placeholder="Select Type of Category" required>
                          <option value="">Select Type of Category</option>
                          <option value="1" <?php if(isset($product_category_info) && $product_category_info['product_category_type'] == '1'){ echo 'selected'; } ?>>Product</option>
                          <option value="2" <?php if(isset($product_category_info) && $product_category_info['product_category_type'] == '2'){ echo 'selected'; } ?>>Service</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Enter Category Name</label>
                        <input type="text" class="form-control form-control-sm" name="product_category_name" id="product_category_name" value="<?php if(isset($product_category_info)){ echo $product_category_info['product_category_name']; } ?>" placeholder="Enter Product Category Name" required>
                      </div>
                      <!-- <div class="form-group col-md-12 ">
                        <label>Enter Product Category Description</label>
                        <textarea class="form-control form-control-sm" name="product_category_descr" id="product_category_descr"  rows="5" required><?php if(isset($product_category_info)){ echo $product_category_info['product_category_descr']; } ?></textarea>
                      </div> -->
                      <div class="form-group col-md-6">
                        <label>Category Image</label>
                        <input type="file" class="form-control form-control-sm" name="product_category_image" id="product_category_image" >
                      </div>
                      <div class="form-group col-md-6">
                        <?php if(isset($product_category_info) && $product_category_info['product_category_image']){ ?>
                          <label>Uploaded Category Image</label><br>
                          <img width="200px" src="<?php echo base_url() ?>assets/images/category/<?php echo $product_category_info['product_category_image'];  ?>" alt="Product Category Image">
                          <input type="hidden" name="old_product_category_img" value="<?php echo $product_category_info['product_category_image']; ?>">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="product_category_status" id="product_category_status" value="0" <?php if(isset($product_category_info) && $product_category_info['product_category_status'] == 0){ echo 'checked'; } ?>>
                            <label for="product_category_status" class="custom-control-label">Disable This Product Category</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Product/product_category" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Product / Service Category Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Product Category Name</th>
                    <th class="wt_75">Type</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($product_category_list)){
                     $i=0; foreach ($product_category_list as $list) { $i++;
                       // $cnt = $this->Master_Model->get_count('product_category_id ','','product_category_type',$list->product_category_id,'','','','','product_category');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Master/edit_product_category/<?php echo $list->product_category_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Master/delete_product_category/<?php echo $list->product_category_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Product Category Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->product_category_name; ?></td>
                      <td>
                        <?php if($list->product_category_type == 1){ echo '<span class="text-info">Product</span>'; }
                          else{ echo '<span class="text-primary">Service</span>'; } ?>
                      </td>
                      <td><img width="50px" src="<?php echo base_url() ?>assets/images/category/<?php echo $list->product_category_image;  ?>" alt="Product Category Image">
                      <td>
                        <?php if($list->product_category_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
