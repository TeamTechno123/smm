<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  /********************************* Order ***********************************/

    // Order List...
    public function order_list(){
      $smm_user_id = $this->session->userdata('smm_user_id');
      $smm_company_id = $this->session->userdata('smm_company_id');
      $smm_role_id = $this->session->userdata('smm_role_id');
      if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }


      $data['order_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','order_id','DESC','smm_order');
      $data['page'] = 'Order List';
      $this->load->view('Admin/Include/head', $data);
      $this->load->view('Admin/Include/navbar', $data);
      $this->load->view('Admin/Transaction/order_list', $data);
      $this->load->view('Admin/Include/footer', $data);
    }


    // Order Cancel List...
    public function order_cancel_list(){
      $smm_user_id = $this->session->userdata('smm_user_id');
      $smm_company_id = $this->session->userdata('smm_company_id');
      $smm_role_id = $this->session->userdata('smm_role_id');
      if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }


      $data['order_cancel_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'order_status','2','','','','','order_id','DESC','smm_order');
      $data['page'] = 'Order List';
      $this->load->view('Admin/Include/head', $data);
      $this->load->view('Admin/Include/navbar', $data);
      $this->load->view('Admin/Transaction/order_cancel_list', $data);
      $this->load->view('Admin/Include/footer', $data);
    }

    //  Cancel Order List...
    public function cancel_order_approve(){
      $smm_user_id = $this->session->userdata('smm_user_id');
      $smm_company_id = $this->session->userdata('smm_company_id');
      $smm_role_id = $this->session->userdata('smm_role_id');
      if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

      $order_id = $_POST['order_id'];
      $update_data['order_cancel_approve'] = $_POST['order_cancel_approve'];
      $this->Master_Model->update_info('order_id', $order_id, 'smm_order', $update_data);

      if($_POST['order_cancel_approve'] == '1'){
        // Cancel Project...
        $update_data2['project_status'] = '3';
        $this->Master_Model->update_info('order_id', $order_id, 'smm_project', $update_data2);

        // Cancel Invoice...
        $update_data3['invoice_status'] = '2';
        $this->Master_Model->update_info('ref_order_id', $order_id, 'smm_invoice', $update_data3);

        // Cancel Commission...
        $cancelled_invoice_list = $this->Master_Model->get_list_by_id3($smm_company_id,'ref_order_id',$order_id,'invoice_status','2','','','invoice_id','ASC','smm_invoice');
        foreach ($cancelled_invoice_list as $cancelled_invoice_list1) {
          $invoice_id = $cancelled_invoice_list1->invoice_id;
          $update_data4['commission_status'] = '2';
          $this->Master_Model->update_info('invoice_id', $invoice_id, 'smm_commission', $update_data4);
        }
      }

      header('location:'.base_url().'Transaction/order_cancel_list');
    }


}
?>
