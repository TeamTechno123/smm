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
                            <label>Account Title</label>
                            <input type="text" class="form-control form-control-sm" name="company" id="company" value="" placeholder="Account Title">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Bank Name</label>
                            <input type="text" class="form-control form-control-sm" name="post" id="post" value="" placeholder="Bank Name">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Account Number</label>
                            <input type="text" class="form-control form-control-sm" name="start_year" id="start_year" value="" placeholder="Account Number">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Bank Code </label>
                            <input type="text" class="form-control form-control-sm" name="end_year" id="end_year" value="" placeholder="Bank Code">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Bank Branch </label>
                            <input type="text" class="form-control form-control-sm" name="end_year" id="end_year" value="" placeholder="Bank Branch">
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
                    <th>Account Title</th>
                    <th>Bank Name </th>
                    <th>Account Number</th>
                    <th>Branch</th>  
                    <th>Bank Code</th>                                                     
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
