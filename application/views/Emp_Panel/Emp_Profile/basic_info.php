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
            <h4>Profile</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <?php include('profile_menu.php'); ?>
          </div>
          <div class="col-md-9">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Profile</h3>
                <div class="card-tools">
                  <!-- <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?> -->
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" >
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">

                    <div class="col-md-10">
                      <div class="row mb-5">
                        <div class="col-4">
                          <img class="profile-img-2" src="<?php echo base_url(); ?>assets/images/employee/<?php echo $employee_info['employee_image']; ?>" width="50%" height="50%">
                        </div>
                        <div class="col-6">
                          <p class="mb-0"><?php echo $employee_info['employee_name'].' '.$employee_info['employee_lname']; ?></p>
                          <?php $office_shift_info = $this->Master_Model->get_info_arr_fields('*','office_shift_id', $employee_info['office_shift_id'], 'smm_office_shift'); ?>
                          <p class="mb-0"> Shift : <?php if($office_shift_info){ echo $office_shift_info[0]['office_shift_name']; } ?></p>
                        </div>
                      </div>
                    </div>

                      <div class="col-md-2">

                      </div>

                      <div class="form-group col-md-6 ">
                        <label>First Name</label>
                        <input type="text" class="form-control form-control-sm" name="employee_name" id="employee_name" value="<?php echo $employee_info['employee_name']; ?>" placeholder="First Name">
                      </div>

                          <div class="form-group col-md-6 ">
                            <label>Last Name</label>
                            <input type="text" class="form-control form-control-sm" name="employee_lname" id="employee_lname" value="<?php echo $employee_info['employee_lname']; ?>" placeholder="Last Name">
                          </div>


                      <div class="form-group col-md-6 ">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm" name="employee_email" id="employee_email" value="<?php echo $employee_info['employee_email']; ?>" placeholder="Email">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Date Of Birth</label>
                            <input type="text" class="form-control form-control-sm" name="employee_dob" value="<?php echo $employee_info['employee_dob']; ?>"  id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Date Of Birth">
                          </div>

                          <div class="form-group col-md-4 select_sm" data-select2-id="14">
                            <label>Gender</label>
                            <select class="form-control select2 form-control-sm " name="employee_gender" id="employee_gender" data-placeholder="Select Gender" required="" >
                              <option value="" >Select Gender</option>
                              <option value="Male" <?php if( $employee_info['employee_gender'] == 'Male'){ echo 'selected'; } ?>>Male</option>
                              <option value="Female" <?php if( $employee_info['employee_gender'] == 'Female'){ echo 'selected'; } ?>>Female</option>
                            </select>
                          </div>

                          <div class="form-group col-md-4 select_sm" data-select2-id="14">
                            <label>Marital Status</label>
                            <select class="form-control select2 form-control-sm " name="employee_marital_status" id="employee_marital_status" data-placeholder=" Marital Status" >
                              <option value="" >Select Marital Status</option>
                              <option value="Single" <?php if( $employee_info['employee_marital_status'] == 'Single'){ echo 'selected'; } ?>>Single</option>
                              <option value="Married" <?php if( $employee_info['employee_marital_status'] == 'Married'){ echo 'selected'; } ?>>Married</option>
                            </select>
                          </div>

                          <div class="form-group col-md-4 ">
                            <label>Contact Number</label>
                            <input type="number" class="form-control form-control-sm" name="employee_mobile" id="employee_mobile" value="<?php echo $employee_info['employee_mobile']; ?>" placeholder="Contact Number" readonly>
                          </div>

                          <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea class="form-control" name="employee_address" id="employee_address" rows="3" placeholder="Enter Address"><?php echo $employee_info['employee_address']; ?></textarea>
                          </div>

                          <div class="form-group col-md-12">
                            <label>Profile Picture</label>
                            <input type="hidden" name="old_employee_image" value="<?php echo $employee_info['employee_image']; ?>">
                            <input type="file" class="form-control form-control-sm valid_image" name="employee_image" id="employee_image">
                            <label>.jpg/.png/.jpeg file &amp; size less than 500kb.</label>

                          </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">

                      </div>
                      <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-primary float-right px-4">Update</button>
                        <!-- <a href="<?php echo base_url(); ?>Emp_Panel/Emp_User/dashboard" class="btn btn-sm btn-default px-4 mx-4">Cancel</a> -->

                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>


          </div>

          <div class="col-md-12">

          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
