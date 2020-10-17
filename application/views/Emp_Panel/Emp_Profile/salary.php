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
            <h4>Salary</h4>
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
                <h3 class="card-title">  Salary Information</h3>
                <div class="card-tools">
                  <!-- <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?> -->
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" >
                  <div class="row p-4">
                     <div class="col-6">
                      <p class="mb-0 text-info">Payslip Type</p>
                      <p class="mb-0 f-14"> <?php echo $employee_info['employee_salary_type']; ?> Payslip</p>
                    </div>

                     <div class="col-6">
                      <p class="mb-0 text-info">Salary</p>
                      <p class="mb-0 f-14"> <?php echo $employee_info['employee_salary'].'/'.$employee_info['employee_salary_type']; ?></p>
                    </div>
                  </div>
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
