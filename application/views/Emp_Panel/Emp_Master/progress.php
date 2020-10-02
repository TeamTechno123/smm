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
            <h4>Progress</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
           <?php include('project_menu.php'); ?>
        </div>         
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Progress</h3>
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

                    <div class="col-md-8">
                      <div class="card p-4">
                      <div class="row">
                        
                          <div class="col-sm-6">
                          <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                          </div>
                          </div>

                   <div class="form-group col-md-6 select_sm" data-select2-id="14">
                            <label>Status</label>
                            <select class="form-control select2 form-control-sm " name="language_id" id="language_id" data-placeholder="In Progess" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11">Select Status</option>
                                <option value="1" data-select2-id="19">Male</option>
                              </select>

                               <label class="mt-2">Priority</label>
                            <select class="form-control select2 form-control-sm " name="language_id" id="language_id" data-placeholder="Hight" required="" tabindex="-1" aria-hidden="true" data-select2-id="award_type_id">
                              <option value="" data-select2-id="11">Select Priority</option>
                                <option value="1" data-select2-id="19">Male</option>
                              </select>
                          </div>
                          <div class="col-md-12">
                            <button class="btn btn-sm btn-success float-right px-4">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                       <?php include('project_details.php'); ?>
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

      </div>
    </section>
  </div>

</body>
</html>
