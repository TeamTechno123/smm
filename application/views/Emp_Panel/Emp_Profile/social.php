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
            <h4>Social Networking</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Social Networking</h3>
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

                      <div class="form-group col-md-6 ">
                            <label>Facebook Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_facebook" id="employee_facebook" value="<?php echo $employee_info['employee_facebook']; ?>" placeholder="Facebook Profile">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Twitter Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_twitter" id="employee_twitter" value="<?php echo $employee_info['employee_twitter']; ?>" placeholder="Twitter Profile">
                          </div>


                          <div class="form-group col-md-6 ">
                            <label>Blogger Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_blogger" id="employee_blogger" value="<?php echo $employee_info['employee_blogger']; ?>" placeholder="Blogger Profile">
                          </div>

                          <div class="form-group col-md-6 ">
                          </div>


                          <div class="form-group col-md-6 ">
                            <label>LinkedIn Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_linkedin" id="employee_linkedin" value="<?php echo $employee_info['employee_linkedin']; ?>" placeholder="LinkedIn Profile">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Google Plus Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_google_plus" id="employee_google_plus" value="<?php echo $employee_info['employee_google_plus']; ?>" placeholder="Google Plus Profile">
                          </div>

                           <div class="form-group col-md-6">
                            <label>Instagram Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_instagram" id="employee_instagram" value="<?php echo $employee_info['employee_instagram']; ?>" placeholder="Instagram Profile">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Pinterest Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_pinterest" id="employee_pinterest" value="<?php echo $employee_info['employee_pinterest']; ?>" placeholder="Pinterest Profile">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Youtube Profile</label>
                            <input type="text" class="form-control form-control-sm" name="employee_youtube" id="employee_youtube" value="<?php echo $employee_info['employee_youtube']; ?>" placeholder="Youtube Profile">
                          </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">

                      </div>
                      <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-primary float-right px-4">Update</button>
                        <!-- <a href="<?php echo base_url(); ?>Emp_Panel/Emp_User/dashboard" class="btn btn-sm btn-default px-4 mx-4">Cancel</a> -->

                        <!-- <?php if(isset($update)){
                          echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                        } else{
                          echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
                        } ?> -->
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
