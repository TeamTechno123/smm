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
            <h4>Tasks</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Tasks</h3>
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
                      <div class="card p-4 scroll">
                      
                        <table id="example1" class="table table-bordered table-striped  tw-800" >
                              <thead>
                              <tr>
                                <th>Action </th>
                                <th>Title</th>
                                <th>End Date </th>        
                                <th>Status</th>  
                                <th>Assign To</th>
                                <th>Created By</th>
                                <th>Progress</th>                                                      
                              </tr>
                              </thead>
                              <tbody>
                           
                            </table>
                      </div>
                    </div>

                    <div class="col-md-4">
                       <?php include('project_details.php'); ?>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>

            
          </div>

      </div>

      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">          
            <div class="card-body">
                <hr>
                
                <br>
            </div>
          </div>
          </div>
    </section>
  </div>

</body>
</html>
