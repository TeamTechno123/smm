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
          <div class="col-sm-12 text-center mt-2">
            <h1> Dashboard Information</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <hr>
        <!-- <h4 class="mb-3">Master Summary</h4> -->
        <div class="row">

          <div class="col-md-10">
            <div class="row mb-5">
              <div class="col-4">
                <img class="profile-img" src="<?php echo base_url(); ?>assets/images/employee/<?php echo $employee_info['employee_image']; ?>">
              </div>
              <div class="col-6">
                <h4 class=""><?php echo $employee_info['employee_name'].' '.$employee_info['employee_lname']; ?><span class="admin-grey"> @ <?php echo $designation_info['designation_name']; ?></span></h4>
                <p>Id : <?php echo $employee_info['employee_emp_id']; ?></p>
                <h6>My Office Shift 9:00am To 6:00pm</h6>
                <div class="row">
                  <div class="col-md-auto">
                    <?php
                    $smm_emp_id = $this->session->userdata('smm_emp_id');
                    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
                    $attendence_date = date('d-m-Y');

                    $check_clock_in = $this->Master_Model->get_info_arr_fields3('*', $smm_emp_company_id, 'attendence_date',$attendence_date, 'employee_id', $smm_emp_id, '', '', 'smm_attendence'); ?>

                    <form class="" action="<?php echo base_url(); ?>Emp_Panel/Emp_Master/clock_in" method="post">
                      <button type="submit" class="btn btn-primary btn-sm" <?php if($check_clock_in){ echo 'disabled'; } ?>>Clock In </button>
                    </form>
                  </div>
                  <div class="col-md-auto">
                    <form class="" action="<?php echo base_url(); ?>Emp_Panel/Emp_Master/clock_out" method="post">
                      <button type="submit" class="btn btn-primary btn-sm">Clock Out </button>
                    </form>
                  </div>
                  <div class="col-md-auto">
                    <button style="display:inline;" type="submit" class="btn btn-secondary"><i class="fas fa-user-times"></i></button>
                  </div>
                </div>






              </div>
            </div>
          </div>
          <div class="col-md-2">

          </div>

          <div class="col-md-4 col-6">
            <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/employee">
              <div class="info-box">
                <span class="info-box-icon text-success"><i class="far fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-number text-primary f-14">0 Awards</span>
                   <span class="info-box-text text-secondary">View</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Package/my_package_list">
              <div class="info-box">
                <span class="info-box-icon text-info"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-number text-primary f-14">0 Payslip</span>
                   <span class="info-box-text text-secondary">View</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Master/announcement">
              <div class="info-box">
                <span class="info-box-icon text-warning"><i class="fas fa-bullhorn"></i></span>
                <div class="info-box-content">
                   <span class="info-box-number text-primary f-14">0 Managment </span>
                   <span class="info-box-text text-secondary">Leave</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Master/announcement">
              <div class="info-box">
                <span class="info-box-icon text-danger"><i class="fas fa-comment-dots"></i></span>
                <div class="info-box-content">
                  <span class="info-box-number text-primary f-14">0 Travel</span>
                   <span class="info-box-text text-secondary">Request</span>
                </div>
              </div>
            </a>
          </div>


          <div class="col-md-4 col-6">
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-number text-primary f-14">0 Awards</span>
                   <span class="info-box-text text-secondary">View</span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-6">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
               <span class="info-box-number text-primary f-14">0 Awards</span>
                   <span class="info-box-text text-secondary">View</span>
              </div>
              </div>
            </div>
          </div>

        </div>

        <hr>
      </div>
    </section>
  </div>

</body>
</html>

<script type="text/javascript">
  <?php if($this->session->flashdata('clock_in_exist')){ ?>
    $(document).ready(function(){
      toastr.error('Already Clock In');
    });
  <?php } ?>
</script>
