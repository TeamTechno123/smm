<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12">
            <h4>Payslip History</h4>
          </div>
             <div class="col-md-6 col-6">
            <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/employee">
              <div class="info-box">
                <span class="info-box-icon text-success"><i class="far fa-clock"></i></span>
                <div class="info-box-content">                 
                  <span class="info-box-number text-primary f-16">Payroll</span>
                   <span class="info-box-text text-secondary">Generate Payslip</span>
                </div>
              </div>
            </a>
          
          </div>

           <div class="col-md-6 col-6">
            <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/employee">
              <div class="info-box">
                <span class="info-box-icon text-success"><i class="far fa-calendar-alt"></i></span>
                <div class="info-box-content">                 
                  <span class="info-box-number text-primary f-16">Payslip History</span>
                   <span class="info-box-text text-secondary">View Payslip History</span>
                </div>
              </div>
            </a>
          
          </div>

          
        </div>

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
           
           
            <div class="card-body">
              <form class="form-horizontal" autocomplete="off" method="post">
                <div class="form-group row">
                

                

                 <div class="col-sm-8">
                      <label class=""> Select Month</label>
                    <input type="text" class="form-control form-control-sm from_date" name="from_date" id="date1" data-target="#date1" data-toggle="datetimepicker">
                    <label class="text-red">  </label>
                  </div>
                 

                  <div class="col-sm-4 mt-4">
                     <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="button">Get</button>
                    </div>
                  </div>
                
                </div>
               
              </form>
             
            
             
                <hr>
                <table id="example1" class="table table-bordered table-striped scroll" >
                  <thead>
                  <tr>
                    <th>Action </th>
                    <th>Employee Name</th>
                    <th>Company </th>
                    <th>Account</th>
                    <th>Net Payable</th>
                    <th>Salary Month</th>
                    <th>Payroll Date</th>                                    
                  </tr>
                  </thead>
                  <tbody>
              
                </table>
                <br>
                
             
            </div>
          </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    
  </div>

</body>
</html>
