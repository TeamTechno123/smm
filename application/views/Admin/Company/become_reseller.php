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
            <h4>Become Reseller</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Become Reseller</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Company/become_reseller" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-12 select_sm">
                        <label>Image Possition</label>
                        <select class="form-control select2 form-control-sm" name="become_reseller_possition" id="become_reseller_possition" data-placeholder="Select Image Possition">
                          <option value="">Select Image Possition</option>
                          <option value="1" <?php if(isset($become_reseller_info) && $become_reseller_info['become_reseller_possition'] == '1'){ echo 'selected'; } ?>>Banner Image</option>
                          <option value="2" <?php if(isset($become_reseller_info) && $become_reseller_info['become_reseller_possition'] == '2'){ echo 'selected'; } ?>>Step-1 Image</option>
                          <option value="3" <?php if(isset($become_reseller_info) && $become_reseller_info['become_reseller_possition'] == '3'){ echo 'selected'; } ?>>Step-2 Image</option>
                          <option value="4" <?php if(isset($become_reseller_info) && $become_reseller_info['become_reseller_possition'] == '4'){ echo 'selected'; } ?>>Step-3 Image</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Description</label>
                        <textarea class="form-control form-control-sm" name="become_reseller_descr" id="become_reseller_descr" rows="3" placeholder="Enter Become Reseller Description" required ><?php if(isset($become_reseller_info)){ echo $become_reseller_info['become_reseller_descr']; } ?></textarea>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Become Reseller Image</label>
                        <input type="file" class="form-control form-control-sm valid_image" name="become_reseller_image" id="become_reseller_image" >
                          <label>.jpg/.jpeg/.png file. Size less than 500kb.</label>
                      </div>
                      <div class="form-group col-md-4">
                        <?php if(isset($become_reseller_info) && $become_reseller_info['become_reseller_image']){ ?>
                          <img width="150px" src="<?php echo $become_reseller_info['become_reseller_image'];  ?>" alt="Become Reseller Image">
                          <input type="hidden" name="old_become_reseller_img" value="<?php echo $become_reseller_info['become_reseller_image']; ?>">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="become_reseller_status" id="become_reseller_status" value="0" <?php if(isset($become_reseller_info) && $become_reseller_info['become_reseller_status'] == 0){ echo 'checked'; } ?>>
                            <label for="become_reseller_status" class="custom-control-label">Disable This Become Reseller</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Company/become_reseller" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Become Reseller Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Possition</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($become_reseller_list)){
                      $i=0; foreach ($become_reseller_list as $list) { $i++;
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Company/edit_become_reseller/<?php echo $list->become_reseller_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Company/delete_become_reseller/<?php echo $list->become_reseller_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Become Reseller Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($list->become_reseller_possition == 1){ echo "Banner Image"; }
                        elseif($list->become_reseller_possition == 2){ echo "Step-1 Image"; }
                        elseif($list->become_reseller_possition == 3){ echo "Step-2 Image"; }
                        elseif($list->become_reseller_possition == 4){ echo "Step-3 Image"; }
                      ?></td>
                      <td class="text-center"><img width="50px" width="50px" src="<?php echo $list->become_reseller_image;  ?>" alt="Become Reseller Image">
                      <td>
                        <?php if($list->become_reseller_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
