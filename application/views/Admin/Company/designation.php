<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Designation</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Designation</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Company/designation" type="button" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0 needs-validation" novalidate id="form_action" office_shift="form" action="" method="post">
                  <div class="row p-4">
                    <!-- <div class="form-group col-md-8 offset-md-2 select_sm">
                      <label>Designation Branch</label>
                      <select class="form-control select2" name="branch_id" id="branch_id" data-placeholder="Select Designation Branch" required>
                        <option value="">Select Designation Branch</option>
                        <?php if(isset($branch_list)){ foreach ($branch_list as $list) { ?>
                        <option value="<?php echo $list->branch_id; ?>" <?php if(isset($designation_info) && $designation_info['branch_id'] == $list->branch_id){ echo 'selected'; } ?>><?php echo $list->branch_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div> -->
                    <div class="form-group col-md-8 offset-md-2">
                      <label>Name of Designation</label>
                      <input type="text" class="form-control form-control-sm" name="designation_name" id="designation_name" value="<?php if(isset($designation_info)){ echo $designation_info['designation_name']; } ?>"  placeholder="Enter Name of Designation" required >
                    </div>
                    <div class="form-group col-md-8 offset-md-2">
                      <label>Description</label>
                      <textarea class="form-control form-control-sm" name="designation_descr" id="designation_descr" rows="3"><?php if(isset($designation_info)){ echo $designation_info['designation_descr']; } ?></textarea>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="designation_status" id="designation_status" value="0" <?php if(isset($designation_info) && $designation_info['designation_status'] == 0){ echo 'checked'; } ?>>
                          <label for="designation_status" class="custom-control-label">Disable This Designation</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Designation/designation" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Designation</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Designation Name</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($designation_list)){
                       $i=0; foreach ($designation_list as $list) { $i++;
                      // $user_details = $this->Master_Model->get_info_arr_fields('user_name','user_id', $list->user_id, 'user');
                      // $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Company/edit_designation/<?php echo $list->designation_id; ?>" type="button" class="btn btn-sm btn-default"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Company/delete_designation/<?php echo $list->designation_id; ?>" type="button" class="btn btn-sm btn-default red-tooltip"  data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Delete this Designation');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->designation_name; ?></td>
                        <!-- <td><?php if($user_details){ echo $user_details[0]['user_name']; } ?></td> -->

                        <td>
                          <?php if($list->designation_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
