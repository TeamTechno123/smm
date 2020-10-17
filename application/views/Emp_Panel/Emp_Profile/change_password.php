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
            <h4>Change Password</h4>
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
                <h3 class="card-title"> Change Password</h3>
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

                <div class="form-group col-md-4 ">
                  <label>Old Password</label>
                  <input type="password" class="form-control form-control-sm" name="old_password" id="old_password" value="" placeholder="Old Password">
                </div>
                <div class="form-group col-md-4 ">
                  <label>New Password</label>
                  <input type="password" class="form-control form-control-sm password" name="new_password" id="new_password" value="" placeholder="New Password">
                </div>
                <div class="form-group col-md-4 ">
                  <label>Confirm New Password</label>
                  <input type="password" class="form-control form-control-sm con_password" id="c_password" value="" placeholder="Confirm New Password">
                </div>
              </div>
              <div class="card-footer clearfix" style="display: block;">
                <div class="row">
                  <div class="col-md-6 text-left">

                  </div>
                  <div class="col-md-6 text-right">
                    <button class="btn btn-sm btn-primary float-right px-4">Update</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    </section>
  </div>

</body>
</html>
