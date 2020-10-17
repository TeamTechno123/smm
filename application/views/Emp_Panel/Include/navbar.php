<?php
  $smm_emp_id = $this->session->userdata('smm_emp_id');
  $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
  // $smm_role_id = $this->session->userdata('smm_role_id');
  $company_info = $this->Master_Model->get_info_arr_fields('company_name, company_shortname, company_logo','company_id', $smm_emp_company_id, 'company');
  $employee_info = $this->Master_Model->get_info_arr_fields('employee_name, employee_lname, employee_image','employee_id', $smm_emp_id, 'smm_employee');
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-user"></i>
          <?php echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <div class="dropdown-item"> -->
            <div class="row">
              <div class="col-6 text-center">
                <a href="<?php echo base_url(); ?>Reseller/Res_User/profile" class="dropdown-item py-4">
                <!-- <a href="" class="dropdown-item py-4"> -->
                  <i class="far fa-user f-22"></i><br>Profile
                </a>
              </div>
              <div class="col-6 text-center">
                <a href="<?php echo base_url(); ?>Reseller/Res_User/dashboard" class="dropdown-item py-4">
                  <i class="fas fa-th f-22"></i><br>Dashboars
                </a>
              </div>
            </div>
          <!-- </div> -->
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>Reseller/Res_User/logout" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>User/logout">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <?php if($company_info[0]['company_logo']){ ?>
      <img src="<?php echo base_url() ?>assets/images/master/<?php echo $company_info[0]['company_logo']; ?>" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
    <?php } ?>
    <span class="brand-text font-weight-light"><?php echo $company_info[0]['company_shortname']; ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if($employee_info[0]['employee_image']){ ?>
          <img src="<?php echo base_url() ?>assets/images/employee/<?php echo $employee_info[0]['employee_image'];  ?>" class="img-circle elevation-2" alt="User Image">
        <?php } ?>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Emp_Panel/Emp_User/dashboard" class="nav-link head">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/attendence_list" class="nav-link head">
            <i class="nav-icon far fa-money-bill-alt"></i>
            <p>
              Timesheet
            </p>
          </a>
        </li>

         <li class="nav-item">
          <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/payslip" class="nav-link head">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Payslip
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon far fa-money-bill-alt"></i>
            <p>
              Project Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Emp_Panel/Emp_Project/project" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Projects</p>
              </a>
            </li>
            <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Emp_Panel/Emp_Project/task" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/progress" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Projects</p>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/tasks" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tasks</p>
              </a>
            </li> -->

             <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/timelog" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Timelog</p>
              </a>
            </li>

             <li class="nav-item">
              <a  <?php if(isset($update_ticket)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Emp_Panel/Emp_Project/ticket" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ticket</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Profile/basic_info" class="nav-link head">
            <i class="nav-icon far fa-money-bill-alt"></i>
            <p>
              My Profile
            </p>
          </a>
        </li>
      </nav>
    <!-- /.sidebar-menu -->
    </div>
  <!-- /.sidebar -->
  </aside>
