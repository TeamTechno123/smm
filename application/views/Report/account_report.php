<!DOCTYPE html>
<html>
<style>

  td{
    padding:2px 10px !important;
  }
  table{
    /* overflow: hidden; */
  }
  th, td { min-width:200px; }
  .sr_no, .td_btn{
    min-width:50px !important;
  }
  .td_w{
    min-width:100px !important;
  }
  html, body, .row{
    overflow-x: hidden;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1 text-center">
            <h4>Account Statement</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i> List Party Information</h3>
              <div class="card-tools">
                <a href="party_information" class="btn btn-sm btn-block btn-primary">Add Party</a>
              </div>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body" >
              <form role="form">
                <div class="card-body row">

                   <div class="form-group col-md-3">
                    <select class="form-control select2 form-control-sm" title="Select Account">
                      <option selected="selected">Select Account</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <input type="date" class="form-control form-control-sm" name="" id="" title="From Date" placeholder="From Date">
                  </div>

                  <div class="form-group col-md-3">
                    <input type="date" class="form-control form-control-sm" name="" id="" title="From Date" placeholder="To Date">
                  </div>

                  <div class="form-group col-md-3">
                    <button class="btn btn-sm btn-block btn-primary">View </button>
                  </div>
                  <!-- <div class="form-group col-md-2">
                    <button href="accessories_information" class="btn btn-sm btn-block btn-primary">Cancel</button>
                  </div>
 -->
              <div class="" style="overflow-x:auto; margin-top: 20px;">
                <table id="myTable" class="table table-bordered table-striped " style="">
                  <thead>
                   
                  <tr>
                    <th>Sr. No.</th>
                    <th>Id </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company </th> 
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Status</th> 
                   
                  </tr>
                  </thead>
                  <tbody>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td> 
                    <td>7</td>
                    <td>7</td>                    
                  </tbody>
                </table>
              </div>
              <br><br>
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                              <div class="col-12">
                                <a href="#" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                              </div>
                            </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>


</body>
</html>