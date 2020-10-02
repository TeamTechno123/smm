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
                            <input type="text" class="form-control form-control-sm" name="facebook" id="facebook" value="" placeholder="Facebook Profile">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Twitter Profile</label>
                            <input type="text" class="form-control form-control-sm" name="twitter" id="twitter" value="" placeholder="Twitter Profile">
                          </div>


                          <div class="form-group col-md-6 ">
                            <label>Blogger Profile</label>
                            <input type="text" class="form-control form-control-sm" name="Blogger" id="Blogger" value="" placeholder="Blogger Profile">
                          </div>

                          <div class="form-group col-md-6 ">
                          </div>


                          <div class="form-group col-md-6 ">
                            <label>LinkedIn Profile</label>
                            <input type="text" class="form-control form-control-sm" name="LinkedIn" id="LinkedIn" value="" placeholder="LinkedIn Profile">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Google Plus Profile</label>
                            <input type="text" class="form-control form-control-sm" name="google" id="google" value="" placeholder="Google Plus Profile">
                          </div>

                           <div class="form-group col-md-6">
                            <label>Instagram Profile</label>
                            <input type="text" class="form-control form-control-sm" name="instagram" id="instagram" value="" placeholder="Instagram Profile">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Pinterest Profile</label>
                            <input type="text" class="form-control form-control-sm" name="Pinterest" id="Pinterest" value="" placeholder="Pinterest Profile">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Youtube Profile</label>
                            <input type="text" class="form-control form-control-sm" name="youtube" id="youtube" value="" placeholder="Youtube Profile">
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
