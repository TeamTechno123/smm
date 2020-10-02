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
            <h4>Emergency Contact </h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Contact</h3>
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
                            <label>Select Relation</label>
                            <select class="form-control select2 form-control-sm " name="gender_id" id="gender_id" data-placeholder="Select  Relation" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11">Select  Relation</option>
                                <option value="1" data-select2-id="19">Male</option>
                              </select>
                          </div>

                      <div class="form-group col-md-6 ">
                            <label>Email</label>
                            <input type="text" class="form-control form-control-sm" name="email" id="email" value="" placeholder="Email">
                          </div>

                          <div class="col-md-4 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="award_status" id="award_status" value="0">
                            <label for="award_status" class="custom-control-label pt-1">Primary Contact</label>
                          </div>
                        </div>

                        <div class="col-md-4 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="award_status" id="award_status" value="0">
                            <label for="award_status" class="custom-control-label pt-1">Dependant</label>
                          </div>
                        </div>

                         <div class="form-group col-md-4 ">                           
                            <input type="text" class="form-control form-control-sm" name="dependant" id="dependant" value="dependant" placeholder="dependant">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label> Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" value="" placeholder="Name">
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Phone</label>
                            <input type="text" class="form-control form-control-sm" name="phone" id="phone" value="" placeholder="Phone">
                          </div>

                           <div class="form-group col-md-12">
                              <label>Address</label>
                              <textarea class="form-control" rows="3" placeholder="Enter Address"></textarea>
                            </div>


                      <div class="form-group col-md-3 ">
                            <label>Mobile</label>
                            <input type="number" class="form-control form-control-sm" name="mobile" id="mobile" value="" placeholder="Mobile">
                          </div>

                          <div class="form-group col-md-3 ">
                            <label>City</label>
                            <input type="text" class="form-control form-control-sm" name="city" id="city" value="" placeholder="City">
                          </div>

                           <div class="form-group col-md-3 ">
                            <label>State</label>
                            <input type="text" class="form-control form-control-sm" name="state" id="state" value="" placeholder="State">
                          </div>
                           <div class="form-group col-md-3 ">
                            <label>Zipcode</label>
                            <input type="text" class="form-control form-control-sm" name="zipcode" id="zipcode" value="" placeholder="Zipcode">
                          </div>

                           <div class="form-group col-md-6">
                            <label>Home Number</label>
                            <input type="text" class="form-control form-control-sm" name="home_number" id="home_number" value="" placeholder="Home Number">
                          </div>

                          <div class="form-group col-md-6 select_sm" data-select2-id="14">
                            <label>Country</label>
                            <select class="form-control select2 form-control-sm " name="country_id" id="country_id" data-placeholder="Select Country" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11">Select Country</option>
                                <option value="1" data-select2-id="19">India</option>
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

          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
