<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Report extends CI_Controller{
    public function __construct(){
      parent::__construct();
      date_default_timezone_set('Asia/Kolkata');
    }

    
/********************************* Order Report ***********************************/

public function order_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/order_report');
          $this->load->view('Admin/Include/footer');
    }


    public function invoice_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/invoice_report');
          $this->load->view('Admin/Include/footer');
    }
    

    public function payslip_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/payslip_report');
          $this->load->view('Admin/Include/footer');
    }

    public function attendance_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/attendance_report');
          $this->load->view('Admin/Include/footer');
    }

    public function project_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/project_report');
          $this->load->view('Admin/Include/footer');
    }

    public function task_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/task_report');
          $this->load->view('Admin/Include/footer');
    }

    public function account_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/account_report');
          $this->load->view('Admin/Include/footer');
    }

    public function employee_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/employee_report');
          $this->load->view('Admin/Include/footer');
    }

     public function expence_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/expence_report');
          $this->load->view('Admin/Include/footer');
    }
     

     public function income_report(){

          $this->load->view('Admin/Include/head');
          $this->load->view('Admin/Include/navbar');
          $this->load->view('Report/income_report');
          $this->load->view('Admin/Include/footer');
    }
  
}
?>
