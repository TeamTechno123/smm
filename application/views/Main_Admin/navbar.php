<?php
  $smm_admin_id = $this->session->userdata('smm_admin_id');
  // $smm_customer_id = $this->session->userdata('smm_customer_id');
  // $smm_company_id = $this->session->userdata('smm_company_id');
  // // $smm_role_id = $this->session->userdata('smm_role_id');
  // $company_info = $this->Master_Model->get_info_arr_fields('company_name','company_id', $smm_company_id, 'company');
  // $customer_info = $this->Master_Model->get_info_arr_fields('customer_name','customer_id', $smm_customer_id, 'smm_customer');
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
          SMM
          <!-- <?php echo $customer_info[0]['customer_name']; ?> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <div class="dropdown-item"> -->
            <div class="row">
              <div class="col-6 text-center">
                <!-- <a href="<?php echo base_url(); ?>Master/manage_profile" class="dropdown-item py-4"> -->
                <a href="" class="dropdown-item py-4">
                  <i class="far fa-user f-22"></i><br>Profile
                </a>
              </div>
              <div class="col-6 text-center">
                <a href="<?php echo base_url(); ?>Admin/dashboard" class="dropdown-item py-4">
                  <i class="fas fa-th f-22"></i><br>Dashboars
                </a>
              </div>
            </div>
          <!-- </div> -->
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>Admin/logout" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
    <img src="dist/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">SMM</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
      </div>
      <div class="info">
        <!-- <a href="#" class="d-block"><?php echo $customer_info[0]['customer_name']; ?></a> -->
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Admin/dashboard" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Admin/company" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Company
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Admin/logout" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>
              Logout
            </p>
          </a>
        </li>





      </nav>
    <!-- /.sidebar-menu -->
    </div>
  <!-- /.sidebar -->
  </aside>
