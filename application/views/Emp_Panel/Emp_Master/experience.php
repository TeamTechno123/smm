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
            <h4>Work Experience</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Experience</h3>
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
                            <label>Company</label>
                            <input type="text" class="form-control form-control-sm" name="company" id="company" value="" placeholder="Company">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Post</label>
                            <input type="text" class="form-control form-control-sm" name="post" id="post" value="" placeholder="Post">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Time Period From </label>
                            <input type="text" class="form-control form-control-sm" name="start_year" id="start_year" value="" placeholder="From ">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>To </label>
                            <input type="text" class="form-control form-control-sm" name="end_year" id="end_year" value="" placeholder="To">
                          </div>
                           <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Description"></textarea>
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
            <!-- general form elements -->
            <div class="card">
          
            <div class="card-body">
                <hr>
                <table id="example1" class="table table-bordered table-striped scroll" >
                  <thead>
                  <tr>
                    <th>Action </th>
                    <th>Company</th>
                    <th>Post </th>
                    <th>From Date</th>
                    <th>To Date</th>                                                       
                  </tr>
                  </thead>
                  <tbody>
              
                </table>
                <br>
            </div>
          </div>
          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
