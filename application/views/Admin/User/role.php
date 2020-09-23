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
            <h4>Role</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Role</h3>
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
                    <div class="form-group col-md-6 ">
                      <label>Role Name</label>
                      <input type="text" class="form-control form-control-sm" name="role_name" id="role_name" value="<?php if(isset($role_info)){ echo $role_info['role_name']; } ?>"  placeholder="Enter Name of Role" required >
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Role Description</label>
                      <textarea class="form-control form-control-sm" name="role_descr" id="role_descr" rows="4"><?php if(isset($role_info)){ echo $role_info['role_descr']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <hr>
                      <label>Role Permissions</label>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      if(isset($role_info)){ $role_permission_arr = explode(',', $role_info['role_permission']); }
                        ?>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-bordered">
                            <tr>
                              <td><label> 1. Company Information </label></td>
                              <td><input type="checkbox" name="role_permission[]" id="company_read" value="company1" <?php if(isset($role_info) && in_array("company1", $role_permission_arr)){ echo 'checked'; } ?>> Read</td>
                              <td><input type="checkbox" name="role_permission[]" id="company_create" value="company2" disabled <?php if(isset($role_info) && in_array("company2", $role_permission_arr)){ echo 'checked'; } ?>> Create</td>
                              <td><input type="checkbox" name="role_permission[]" id="company_update" value="company3" <?php if(isset($role_info) && in_array("company3", $role_permission_arr)){ echo 'checked'; } ?>> Update</td>
                              <td><input type="checkbox" name="role_permission[]" id="company_delete" value="company4" disabled <?php if(isset($role_info) && in_array("company4", $role_permission_arr)){ echo 'checked'; } ?>> Delete</td>
                              <td><input type="checkbox" name="role_permission[]" id="company_print" value="company5" disabled <?php if(isset($role_info) && in_array("company5", $role_permission_arr)){ echo 'checked'; } ?>> Print</td>
                            </tr>
                            <tr>
                              <td><label> 1. User Info </label></td>
                              <td><input type="checkbox" name="role_permission[]" id="user_read" value="user1" <?php if(isset($role_info) && in_array("user1", $role_permission_arr)){ echo 'checked'; } ?>> Read</td>
                              <td><input type="checkbox" name="role_permission[]" id="user_create" value="user2" <?php if(isset($role_info) && in_array("user2", $role_permission_arr)){ echo 'checked'; } ?>> Create</td>
                              <td><input type="checkbox" name="role_permission[]" id="user_update" value="user3" <?php if(isset($role_info) && in_array("user3", $role_permission_arr)){ echo 'checked'; } ?>> Update</td>
                              <td><input type="checkbox" name="role_permission[]" id="user_delete" value="user4" <?php if(isset($role_info) && in_array("user4", $role_permission_arr)){ echo 'checked'; } ?>> Delete</td>
                              <td><input type="checkbox" name="role_permission[]" id="user_print" value="user5" disabled <?php if(isset($role_info) && in_array("user5", $role_permission_arr)){ echo 'checked'; } ?>> Print</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="role_status" id="role_status" value="0" <?php if(isset($role_info) && $role_info['role_status'] == 0){ echo 'checked'; } ?>>
                          <label for="role_status" class="custom-control-label">Disable This Role</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php base_url(); ?>User/role" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Role</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Role Name</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($role_list as $list) { $i++; ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <?php if($list->role_id != '1'){ ?>
                            <div class="btn-group">
                              <a href="<?php echo base_url() ?>User/edit_role/<?php echo $list->role_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                              <a href="<?php echo base_url() ?>User/delete_role/<?php echo $list->role_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Role');"><i class="fa fa-trash text-danger"></i></a>
                            </div>
                          <?php } ?>
                        </td>
                        <td><?php echo $list->role_name; ?></td>
                        <td>
                          <?php if($list->role_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                            else{ echo '<span class="text-success">Active</span>'; } ?>
                        </td>
                      </tr>
                    <?php } ?>
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
