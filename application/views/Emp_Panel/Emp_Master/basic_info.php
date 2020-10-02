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
              <div class="card-body p-0" >
                <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                  <div class="row p-4">

                    <div class="col-md-10">
                      <div class="row mb-5">
                        <div class="col-4">
                          <img class="profile-img-2" src="http://localhost/smm/assets/images/reseller/reseller_2_1599543094.png" width="50%" height="50%">
                        </div>
                        <div class="col-6">                         
                          <p class="mb-0">John Smith</p>
                          <p class="mb-0"> Shift : Morning Shift</p>                        
                        </div>
                      </div>            
                    </div>

                      <div class="col-md-2">
                        
                      </div> 

                      <div class="form-group col-md-6 ">
                            <label>First Name</label>
                            <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value="" placeholder="First Name">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Last Name</label>
                            <input type="text" class="form-control form-control-sm" name="last_name" id="last_name" value="" placeholder="Last Name">
                          </div>


                      <div class="form-group col-md-6 ">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" value="" placeholder="Email">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Date Of Birth</label>
                            <input type="number" class="form-control form-control-sm" name="dob" id="dob" value="" placeholder="Date Of Birth">
                          </div>

                          <div class="form-group col-md-4 select_sm" data-select2-id="14">
                            <label>Gender</label>
                            <select class="form-control select2 form-control-sm " name="gender_id" id="gender_id" data-placeholder="Select Gender" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11">Select Gender</option>
                                <option value="1" data-select2-id="19">Male</option>
                              </select>
                          </div>

                          <div class="form-group col-md-4 select_sm" data-select2-id="14">
                            <label>Marital Status</label>
                            <select class="form-control select2 form-control-sm " name="gender_id" id="gender_id" data-placeholder=" Marital Status" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11"> Marital Status</option>
                                <option value="1" data-select2-id="19">Married</option>
                              </select>
                          </div>

                           <div class="form-group col-md-4 ">
                            <label>Contact Number</label>
                            <input type="number" class="form-control form-control-sm" name="gender" id="gender" value="" placeholder="Contact Number">
                          </div>

                          <div class="form-group col-md-12">
                        <label>Address</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Address"></textarea>
                      </div>

                        <div class="form-group col-md-12">
                            <label>Profile Picture</label>
                            <input type="file" class="form-control form-control-sm" name="profile_picture" id="profile_picture">
                            <label>.jpg/.png/.jpeg file &amp; size less than 500kb.</label>
                          </div>

                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_User/dashboard" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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

          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
