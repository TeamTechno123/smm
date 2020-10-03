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
            <h4>Bug</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Bug</h3>
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
                        <div class="form-group col-md-12 ">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value="" placeholder="Title">
                          </div>

                           <div class="form-group col-md-12">
                            <label>Attach File</label>
                            <input type="file" class="form-control form-control-sm" name="profile_picture" id="profile_picture">
                            <label>.jpg/.png/.jpeg file &amp; size less than 500kb.</label>
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
                <table id="example1" class="table table-bordered table-striped scroll" >
                  <thead>
                  <tr>
                    <th>Action </th>
                    <th>Bug Name</th>
                    <th>Bug Status </th>                                                                          
                  </tr>
                  </thead>
                  <tbody>
                <tr>
                  <td>#</td>
                  <td>
                    Fiona Grace (Software Developer )
                  </td>
                  <td>
                    Fixed
                  </td>
                </tr>
                </table>
                <br>
            </div>
          </div>
          </div>
    </section>
  </div>

</body>
</html>
