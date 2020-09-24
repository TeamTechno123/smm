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
            <h4>Freelancer</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Freelancer</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-3">
                      <label>First Name</label>
                      <input type="text" class="form-control form-control-sm" name="freelancer_name" id="freelancer_name" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_name']; } ?>"  placeholder="Enter First Name" required >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Last Name</label>
                      <input type="text" class="form-control form-control-sm" name="freelancer_lname" id="freelancer_lname" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_lname']; } ?>"  placeholder="Enter Last Name" required >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Employee Id</label>
                      <input type="text" class="form-control form-control-sm" name="freelancer_emp_id" id="freelancer_emp_id" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_emp_id']; } ?>"  placeholder="Enter Employee Id" required >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Date of Joining</label>
                      <input type="text" class="form-control form-control-sm" name="freelancer_join_date" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_join_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Joining Date" required >
                    </div>

                    <!-- <div class="form-group col-md-4 select_sm">
                      <label>Branch</label>
                      <select class="form-control select2" name="branch_id" id="branch_id" data-placeholder="Select Branch" required>
                        <option value="">Select Branch</option>
                        <?php if(isset($branch_list)){ foreach ($branch_list as $list) { ?>
                        <option value="<?php echo $list->branch_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['branch_id'] == $list->branch_id){ echo 'selected'; } if($list->branch_status == 0){ echo 'disabled'; } ?>><?php echo $list->branch_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div> -->
                    <div class="form-group col-md-6 select_sm">
                      <label>Select Department</label>
                      <select class="form-control select2" name="department_id" id="department_id" data-placeholder="Select Department" required>
                        <option value="">Select Department</option>
                        <?php if(isset($department_list)){ foreach ($department_list as $list) { ?>
                        <option value="<?php echo $list->department_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['department_id'] == $list->department_id){ echo 'selected'; } if($list->department_status == 0){ echo 'disabled'; } ?> ><?php echo $list->department_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Select Designation</label>
                      <select class="form-control select2" name="designation_id" id="designation_id" data-placeholder="Select Designation" required>
                        <option value="">Select Designation</option>
                        <?php if(isset($designation_list)){ foreach ($designation_list as $list) { ?>
                        <option value="<?php echo $list->designation_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['designation_id'] == $list->designation_id){ echo 'selected'; } if($list->designation_status == 0){ echo 'disabled'; } ?> ><?php echo $list->designation_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Username</label>
                      <input type="text" class="form-control form-control-sm" name="freelancer_username" id="freelancer_username" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_username']; } ?>"  placeholder="Enter Username" required >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Email Id</label>
                      <input type="email" class="form-control form-control-sm email" name="freelancer_email" id="freelancer_email" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_email']; } ?>"  placeholder="Enter Email Id" required >
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Gender</label>
                      <select class="form-control select2" name="freelancer_gender" id="freelancer_gender" data-placeholder="Select Gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_gender'] = "Male"){ echo "selected"; } ?>>Male</option>
                        <option value="Female" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_gender'] = "Female"){ echo "selected"; } ?>>Female</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Select Office Shift</label>
                      <select class="form-control select2" name="office_shift_id" id="office_shift_id" data-placeholder="Select Office Shift">
                        <option value="">Select Office Shift</option>
                        <?php if(isset($office_shift_list)){ foreach ($office_shift_list as $list) { ?>
                        <option value="<?php echo $list->office_shift_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['office_shift_id'] == $list->office_shift_id){ echo 'selected'; } if($list->office_shift_status == 0){ echo 'disabled'; } ?> ><?php echo $list->office_shift_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Date of Birth</label>
                      <input type="text" class="form-control form-control-sm" name="freelancer_dob" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_dob']; } ?>"  id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Date of Birth" required >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Mobile No.</label>
                      <input type="number" min="5000000000" max="9999999999" step="1" class="form-control form-control-sm" name="freelancer_mobile" id="freelancer_mobile" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_mobile']; } ?>" placeholder="Enter Mobile No." required >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Password</label>
                      <input type="password" class="form-control form-control-sm" name="freelancer_password" id="freelancer_password" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_password']; } ?>"  placeholder="Enter Password" required >
                    </div>
                    <div class="form-group col-md-3">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control form-control-sm" id="freelancer_password" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_password']; } ?>"  placeholder="Confirm Password" required >
                    </div>

                    <div class="form-group col-md-3 select_sm">
                      <label>Select Role</label>
                      <select class="form-control select2" name="role_id" id="role_id" data-placeholder="Select Role" required>
                        <option value="">Select Role</option>
                        <?php if(isset($role_list)){ foreach ($role_list as $list) { ?>
                        <option value="<?php echo $list->role_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['role_id'] == $list->role_id){ echo 'selected'; } if($list->role_status == 0){ echo 'disabled'; } ?>><?php echo $list->role_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Report To</label>
                      <select class="form-control select2" name="freelancer_report_to_id" id="freelancer_report_to_id" data-placeholder="Report To" required>
                        <option value="">Report To</option>
                        <?php if(isset($freelancer_report_to_list)){ foreach ($freelancer_report_to_list as $list) { ?>
                        <option value="<?php echo $list->user_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_report_to_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == 0){ echo 'disabled'; } ?>><?php echo $list->user_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Rate</label>
                      <input type="number" min="0" class="form-control form-control-sm" name="freelancer_rate" id="freelancer_rate" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_rate']; } ?>"  placeholder="Enter Rate" required >
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Rate Type</label>
                      <select class="form-control select2" name="freelancer_rate_type" id="freelancer_rate_type" data-placeholder="Select Rate Type">
                        <option value="">Select Rate Type</option>
                        <option value="Hourly" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_rate_type'] == 'Hourly'){ echo 'selected'; } ?>>Hourly</option>
                        <option value="Daily" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_rate_type'] == 'Daily'){ echo 'selected'; } ?>>Daily</option>
                        <option value="Weekly" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_rate_type'] == 'Weekly'){ echo 'selected'; } ?>>Weekly</option>
                        <option value="Monthly" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_rate_type'] == 'Monthly'){ echo 'selected'; } ?>>Monthly</option>
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" name="freelancer_address" id="freelancer_address" rows="5" required><?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="row">
                        <div class="form-group col-md-6 select_sm">
                          <label>Select Country</label>
                          <select class="form-control select2" name="country_id" id="country_id" data-placeholder="Select Country" required>
                            <option value="">Select Country</option>
                            <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                            <option value="<?php echo $list->country_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6 select_sm">
                          <label>Select State</label>
                          <select class="form-control select2" name="state_id" id="state_id" data-placeholder="Select State" required>
                            <option value="">Select State</option>
                            <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
                            <option value="<?php echo $list->state_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6 select_sm">
                          <label>Select City</label>
                          <select class="form-control select2" name="city_id" id="city_id" data-placeholder="Select City" required>
                            <option value="">Select City</option>
                            <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
                            <option value="<?php echo $list->city_id; ?>" <?php if(isset($freelancer_info) && $freelancer_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Pin Code.</label>
                          <input type="number" min="100000" max="999999"  step="1" class="form-control form-control-sm" name="freelancer_pincode" id="freelancer_pincode" value="<?php if(isset($freelancer_info)){ echo $freelancer_info['freelancer_pincode']; } ?>" data-inputmask='"mask": "999999"' data-mask  placeholder="Enter Pin Code." required >
                        </div>
                      </div>
                    </div>

                    <div class="form-group col-md-4">
                      <label>User Image</label>
                      <input type="file" class="form-control form-control-sm" name="freelancer_image" id="freelancer_image" >
                      <label>.jpg, .png file. Image size less than 500 kb</label>
                    </div>
                    <div class="form-group col-md-4">
                      <?php if(isset($freelancer_info) && $freelancer_info['freelancer_image']){ ?>
                        <img width="150px" src="<?php echo base_url() ?>assets/images/freelancer/<?php echo $freelancer_info['freelancer_image'];  ?>" alt="Slider Image">
                        <input type="hidden" name="old_freelancer_image" value="<?php echo $freelancer_info['freelancer_image']; ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="freelancer_status" id="freelancer_status" value="0" <?php if(isset($freelancer_info) && $freelancer_info['freelancer_status'] == 0){ echo 'checked'; } ?>>
                          <label for="freelancer_status" class="custom-control-label">Disable This User</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Employee/freelancer" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All User</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Freelancer Name</th>
                    <!-- <th>City</th> -->
                    <th class="wt_100">Mobile No.</th>
                    <th class="">Email</th>
                    <th class="wt_75">Role</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($freelancer_list as $list) { $i++;
                      // $city_details = $this->Master_Model->get_info_arr_fields('city_name','city_id', $list->city_id, 'city');
                      $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <?php //if(in_array("freelancer3", $smm_role_permission)){ ?>
                            <a href="<?php echo base_url() ?>Employee/edit_freelancer/<?php echo $list->freelancer_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <?php //} if(in_array("freelancer4", $smm_role_permission)){ ?>
                            <a href="<?php echo base_url() ?>Employee/delete_freelancer/<?php echo $list->freelancer_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Freelancer');"><i class="fa fa-trash text-danger"></i></a>
                          <?php// } ?>
                          </div>
                        </td>
                        <td><?php echo $list->freelancer_name; ?></td>
                        <!-- <td><?php if($city_details){ echo $city_details[0]['city_name']; } ?></td> -->
                        <td><?php echo $list->freelancer_mobile; ?></td>
                        <td><?php echo $list->freelancer_email; ?></td>
                        <td><?php if($role_details){ echo $role_details[0]['role_name']; } ?></td>
                        <td>
                          <?php if($list->freelancer_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
<script type="text/javascript">
// Check Mobile Duplication..
  var freelancer_mobile1 = $('#freelancer_mobile').val();
  $('#freelancer_mobile').on('change',function(){
    var freelancer_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"freelancer_mobile",
             "column_val":freelancer_mobile,
             "table_name":"smm_freelancer"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#freelancer_mobile').val(freelancer_mobile1);
          toastr.error(freelancer_mobile+' Mobile No Exist.');
        }
      }
    });
  });

  $("#country_id").on("change", function(){
    var country_id =  $('#country_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/get_state_by_country',
      type: 'POST',
      data: {"country_id":country_id},
      context: this,
      success: function(result){
        $('#state_id').html(result);
      }
    });
  });

  $("#state_id").on("change", function(){
    var state_id =  $('#state_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/get_city_by_state',
      type: 'POST',
      data: {"state_id":state_id},
      context: this,
      success: function(result){
        $('#city_id').html(result);
      }
    });
  });


</script>
