<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Department</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Department</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="<?php base_url(); ?>Company/department" type="button" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0 needs-validation" novalidate id="form_action" office_shift="form" action="" method="post">
                  <div class="row p-4">
                    <!-- <div class="form-group col-md-8 offset-md-2 select_sm">
                      <label>Department Branch</label>
                      <select class="form-control select2" name="branch_id" id="branch_id" data-placeholder="Select Department Branch" required>
                        <option value="">Select Department Branch</option>
                        <?php if(isset($branch_list)){ foreach ($branch_list as $list) { ?>
                        <option value="<?php echo $list->branch_id; ?>" <?php if(isset($department_info) && $department_info['branch_id'] == $list->branch_id){ echo 'selected'; } ?>><?php echo $list->branch_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div> -->
                    <div class="form-group col-md-8 offset-md-2">
                      <label>Name of Department</label>
                      <input type="text" class="form-control form-control-sm" name="department_name" id="department_name" value="<?php if(isset($department_info)){ echo $department_info['department_name']; } ?>"  placeholder="Enter Name of Department" required >
                    </div>
                    <div class="form-group col-md-8 offset-md-2 select_sm">
                      <label>Department Head</label>
                      <select class="form-control select2" name="user_id" id="user_id" data-placeholder="Select Department Head" required>
                        <option value="">Select Department Head</option>
                        <?php if(isset($user_list)){ foreach ($user_list as $list) { ?>
                        <option value="<?php echo $list->user_id; ?>" <?php if(isset($department_info) && $department_info['user_id'] == $list->user_id){ echo 'selected'; } ?>><?php echo $list->user_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="department_status" id="department_status" value="0" <?php if(isset($department_info) && $department_info['department_status'] == 0){ echo 'checked'; } ?>>
                          <label for="department_status" class="custom-control-label">Disable This Department</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Department/department" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Department</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Department Name</th>
                    <th class="">Department Head</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($department_list)){
                       $i=0; foreach ($department_list as $list) { $i++;
                      $user_details = $this->Master_Model->get_info_arr_fields('user_name','user_id', $list->user_id, 'user');
                      // $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Company/edit_department/<?php echo $list->department_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Company/delete_department/<?php echo $list->department_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Department');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->department_name; ?></td>
                        <td><?php if($user_details){ echo $user_details[0]['user_name']; } ?></td>

                        <td>
                          <?php if($list->department_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
// Check Mobile Duplication..
  var department_mobile1 = $('#department_mobile').val();
  $('#department_mobile').on('change',function(){
    var department_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"department_mobile",
             "column_val":department_mobile,
             "table_name":"department"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#department_mobile').val(department_mobile1);
          toastr.error(department_mobile+' Mobile No Exist.');
        }
      }
    });
  });
</script>
