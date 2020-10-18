<?php
  $smm_user_id = $this->session->userdata('smm_user_id');
  $smm_company_id = $this->session->userdata('smm_company_id');
  $smm_role_id = $this->session->userdata('smm_role_id');
  $company_info = $this->Master_Model->get_info_arr_fields('company_name, company_shortname, company_logo','company_id', $smm_company_id, 'company');
  $user_info = $this->Master_Model->get_info_arr_fields('user_name,user_image','user_id', $smm_user_id, 'user');
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
          <?php echo $user_info[0]['user_name']; ?>
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
                <a href="<?php echo base_url(); ?>User/dashboard" class="dropdown-item py-4">
                  <i class="fas fa-th f-22"></i><br>Dashboars
                </a>
              </div>
            </div>
          <!-- </div> -->
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>User/logout" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
  <a href="<?php echo base_url(); ?>User" class="brand-link">
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
        <?php if($user_info[0]['user_image']){ ?>
          <img src="<?php echo base_url() ?>assets/images/master/<?php echo $user_info[0]['user_image'];  ?>" class="img-circle elevation-2" alt="User Image">
        <?php } ?>
      </div>
      <div class="info">
        <a href="<?php echo base_url(); ?>User/user_profile" class="d-block"><?php echo $user_info[0]['user_name']; ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>User/dashboard" class="nav-link  head">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Company
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_company)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/company_list" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Company Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_department)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/department" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_designation)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/designation" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Designation</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_announcement)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/announcement" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Announcement</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_policy)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/policy" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Policies</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_office_shift)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/office_shift" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Office Shifts</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_mail_setting)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/edit_mail_setting/1" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Email Setting</p>
              </a>
            </li>

            <!-- <li class="nav-item">
              <a <?php if(isset($update_branch)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/branch" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Branch</p>
              </a>
            </li> -->
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Product/Service
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_item_company)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Product/item_company" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Item Company</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_item_group)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Product/item_group" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Item Group/Category</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a <?php if(isset($update_product_category)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Category</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a <?php if(isset($update_unit)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Product/unit" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Unit</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_gst_slab)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Product/gst_slab" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>GST Slab</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_product)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Product/product" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_package_category)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Product/package_category" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Package Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_package)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Product/package" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Package</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Employee
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_employee_dashboard)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Employee/employee_dashboard" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Employee Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_role)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>User/role" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_employee)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Employee/employee" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Employee</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_freelancer)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Employee/freelancer" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Freelancer</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-user"></i>
            <p>
              HR Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <li class="nav-item">
                <a <?php if(isset($update_hr_setting)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/award_type" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HR Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_award)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/award" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Award</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_transfer)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/transfer" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_resignation)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/resignation" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Resignation</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_travel)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/travel" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Travels</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_promotion)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/promotion" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promotion</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_complaint)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/complaint" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Complaints</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_warning)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/warning" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Warnings</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_termination)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/termination" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Termination</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_employee_exit)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/employee_exit" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Exit</p>
                </a>
              </li>
              <li class="nav-item">
                <a <?php if(isset($update_holiday)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Hr_setting/holiday" <?php } ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Holiday</p>
                </a>
              </li>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon far fa-clock"></i>
            <p>
              Timesheet
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_timesheet_dashboard)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Timesheet/timesheet_dashboard" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Timesheet Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_attendence)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Timesheet/attendence" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Attendence</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Monthly Timesheet</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_overtime_request)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Timesheet/overtime_request" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Overtime Request</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_leave)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Timesheet/leave" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Leave Information</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon far fa-money-bill-alt"></i>
            <p>
              Payroll
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Generate Payslip</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payslip History</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Advance Salary</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>
              Project Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_project_dashboard)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/project_dashboard" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_project)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/project" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_project_revision)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/project_revision" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project Revision</p>
              </a>
            </li>


            <li class="nav-item">
              <a <?php if(isset($update_task)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/task" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_time_log)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/time_log" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Time Logs</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project Calendar</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Project/project_kanban" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project Kanban Board</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task Calendar </p>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task Kanban Board</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a <?php if(isset($update_ticket)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/ticket" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ticket</p>
              </a>
            </li>





            <!-- <li class="nav-item">
              <a <?php if(isset($update_client)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/client" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Client</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_task_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Project/task_status" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task Status</p>
              </a>
            </li> -->
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>
              Reseller Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_reseller_category)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/reseller_category" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reseller Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_reseller)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Finance/reseller" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reseller</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_web_setup_request)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/web_setup_request" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Web Setup Request</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_become_reseller)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/become_reseller" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Become Reseller</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_faq)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/faq" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>FAQ</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_faq)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/tutorial" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tutorial</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              Finance Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Finance/bank_account" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bank Account</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_expense)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Finance/expense" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Expense</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_fund)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Finance/fund" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Fund</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_deposit)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Finance/deposit" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Deposit</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_invoice)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Finance/invoice" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice Calender</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_invoice_payment)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Finance/invoice_payment" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice Payment</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Debit Note</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Finance/redeem_request_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Redeem Request</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>
              Order Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Transaction/order_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Order List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Transaction/order_cancel_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Cancel Request</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Coupons Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_coupon)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/coupon" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Coupon Information</p>
              </a>
            </li>
          </ul>
        </li> -->

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Website Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">

            <li class="nav-item">
              <a <?php if(isset($update_blog_category)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Web_info/blog_category" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Blog Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_blog)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Web_info/blog" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Blog</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_tutorial_category)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Web_info/tutorial_category" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tutorial Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_tutorial)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Web_info/tutorial" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tutorial</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_faq)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Web_info/faq" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>FAQ</p>
              </a>
            </li>

            <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Web_info/web_setting" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Website Information</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a <?php if(isset($update_slider)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Web_info/slider" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>About Us Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Contact Us Page</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="#" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Theme Settings</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a <?php if(isset($update_review)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/review" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Review</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a <?php if(isset($update_testimonial)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Web_info/testimonial" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Testimonial</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_payment_gateway)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Company/payment_gateway" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Gateway</p>
              </a>
            </li>
          </ul>
        </li>



        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Report
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/order_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Report</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/invoice_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice Report</p>
              </a>
            </li>

             <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/payslip_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payslip Report</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/attendance_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Attendance Report</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/project_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project Report</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/task_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task Report</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/employee_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Employee Report</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/account_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Account Statement </p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/expence_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Expence Report </p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_bank_account)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Report/income_report" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Income Report </p>
              </a>
            </li>

          </ul>
        </li>
      </nav>
    <!-- /.sidebar-menu -->
    </div>
  <!-- /.sidebar -->
  </aside>
