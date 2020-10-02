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
            <h4>Documents</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Documents</h3>
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

                      <div class="form-group col-md-6 select_sm" data-select2-id="14">
                            <label>Document</label>
                            <select class="form-control select2 form-control-sm " name="gender_id" id="gender_id" data-placeholder="Select Document" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11">Select Document</option>
                                <option value="1" data-select2-id="19">Male</option>
                              </select>
                          </div>

                      <div class="form-group col-md-6 ">
                            <label>Date Of Expiry</label>
                            <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value="" placeholder="Date Of Expiry">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Document Title</label>
                            <input type="text" class="form-control form-control-sm" name="documnet_title" id="documnet_title" value="" placeholder="Document Title">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Notification Email</label>
                            <input type="text" class="form-control form-control-sm" name="notification_mail" id="notification_mail" value="" placeholder="Notification Email">
                          </div>

                           <div class="form-group col-md-6 ">
                            <label>Description</label>
                            <input type="text" class="form-control form-control-sm" name="Description" id="Description" value="" placeholder="Description">
                          </div>

                          <div class="form-group col-md-6">
                            <label>Documents File</label>
                            <input type="file" class="form-control form-control-sm" name="document_img" id="document_img">
                            <label>.jpg/.png/.jpeg file &amp; size less than 500kb.</label>
                          </div>

                          <div class="form-group col-md-6 select_sm" data-select2-id="14">
                            <label>Send Notification Mail When Expired</label>
                            <select class="form-control select2 form-control-sm " name="gender_id" id="gender_id" data-placeholder="Select" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11">Yes</option>
                                <option value="1" data-select2-id="19">No</option>
                              </select>
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
                    <th>Document Title</th>
                    <th>Expiry Date </th>
                    <th>Decsription</th>
                    <th>Notification</th>                                                       
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
