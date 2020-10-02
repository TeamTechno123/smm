<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Master extends CI_Controller{
    public function __construct(){
      parent::__construct();
      date_default_timezone_set('Asia/Kolkata');
    }

    public function index(){

    }






/********************************* Order Status ***********************************/

  // Add Order Status...
  public function order_status(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('order_status_name', 'Order Status Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $order_status = $this->input->post('order_status');
      if(!isset($order_status)){ $order_status = '1'; }
      $save_data = $_POST;
      $save_data['order_status_status'] = $order_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['order_status_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_order_status', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/order_status');
    }

    $data['order_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','order_status_id','ASC','smm_order_status');
    $data['page'] = 'Order Status';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/order_status', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Order Status...
  public function edit_order_status($order_status_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('order_status_name', 'Order Status Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $order_status = $this->input->post('order_status');
      if(!isset($order_status)){ $order_status = '1'; }
      $update_data = $_POST;
      $update_data['order_status_status'] = $order_status;
      $update_data['order_status_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('order_status_id', $order_status_id, 'smm_order_status', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/order_status');
    }

    $order_status_info = $this->Master_Model->get_info_arr('order_status_id',$order_status_id,'smm_order_status');
    if(!$order_status_info){ header('location:'.base_url().'Master/order_status'); }
    $data['update'] = 'update';
    $data['update_order_status'] = 'update';
    $data['order_status_info'] = $order_status_info[0];
    $data['act_link'] = base_url().'Master/edit_order_status/'.$order_status_id;

    $data['order_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','order_status_id','ASC','smm_order_status');
    $data['page'] = 'Edit Order Status';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/order_status', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Order Status...
  public function delete_order_status($order_status_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('order_status_id', $order_status_id, 'smm_order_status');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/order_status');
  }

/********************************* Product Category ***********************************/

  // Add Product Category...
  public function product_category(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('product_category_name', 'product_category title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $product_category_status = $this->input->post('product_category_status');
      if(!isset($product_category_status)){ $product_category_status = '1'; }

      $save_data = $_POST;
      $save_data['product_category_status'] = $product_category_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['product_category_addedby'] = $smm_user_id;
      $product_category_id = $this->Master_Model->save_data('smm_product_category', $save_data);

      if($_FILES['product_category_image']['name']){
        $time = time();
        $image_name = 'product_category_'.$product_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['product_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('product_category_image') && $product_category_id && $image_name && $ext && $filename){
          $product_category_image_up['product_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('product_category_id', $product_category_id, 'smm_product_category', $product_category_image_up);
          // unlink("assets/images/tours/".$product_category_image_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/product_category');
    }

    $data['product_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','product_category_id','DESC','smm_product_category');
    $data['page'] = 'Product Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/product_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Product Category...
  public function edit_product_category($product_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('product_category_name', 'product_category title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $product_category_status = $this->input->post('product_category_status');
      if(!isset($product_category_status)){ $product_category_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_product_category_img']);
      $update_data['product_category_status'] = $product_category_status;
      $update_data['product_category_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('product_category_id', $product_category_id, 'smm_product_category', $update_data);

      if($_FILES['product_category_image']['name']){
        $time = time();
        $image_name = 'product_category_'.$product_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['product_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('product_category_image') && $product_category_id && $image_name && $ext && $filename){
          $product_category_image_up['product_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('product_category_id', $product_category_id, 'smm_product_category', $product_category_image_up);
          if($_POST['old_product_category_img']){ unlink("assets/images/category/".$_POST['old_product_category_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/product_category');
    }
    $product_category_info = $this->Master_Model->get_info_arr('product_category_id',$product_category_id,'smm_product_category');
    if(!$product_category_info){ header('location:'.base_url().'Master/product_category'); }
    $data['update'] = 'update';
    $data['update_product_category'] = 'update';
    $data['product_category_info'] = $product_category_info[0];
    $data['act_link'] = base_url().'Master/edit_product_category/'.$product_category_id;

    $data['product_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','product_category_id','DESC','smm_product_category');
    $data['page'] = 'Edit Product Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/product_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Product Category...
  public function delete_product_category($product_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $product_category_info = $this->Master_Model->get_info_arr_fields('product_category_image, product_category_id', 'product_category_id', $product_category_id, 'smm_product_category');
    if($product_category_info){
      $product_category_image = $product_category_info[0]['product_category_image'];
      if($product_category_image){ unlink("assets/images/category/".$product_category_image); }
    }
    $this->Master_Model->delete_info('product_category_id', $product_category_id, 'smm_product_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/product_category');
  }





/********************************* Purchase Type ***********************************/
  // Add Purchase Type...
  public function purchase_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('purchase_type_name', 'Purchase Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $purchase_type_status = $this->input->post('purchase_type_status');
      if(!isset($purchase_type_status)){ $purchase_type_status = '1'; }
      $save_data = $_POST;
      $save_data['purchase_type_status'] = $purchase_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['purchase_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_purchase_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/purchase_type');
    }

    $data['purchase_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','purchase_type_id','ASC','smm_purchase_type');
    $data['page'] = 'Edit Purchase Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/purchase_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Purchase Type...
  public function edit_purchase_type($purchase_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('purchase_type_name', 'Purchase Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $purchase_type_status = $this->input->post('purchase_type_status');
      if(!isset($purchase_type_status)){ $purchase_type_status = '1'; }
      $update_data = $_POST;
      $update_data['purchase_type_status'] = $purchase_type_status;
      $update_data['purchase_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('purchase_type_id', $purchase_type_id, 'smm_purchase_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/purchase_type');
    }

    $purchase_type_info = $this->Master_Model->get_info_arr('purchase_type_id',$purchase_type_id,'smm_purchase_type');
    if(!$purchase_type_info){ header('location:'.base_url().'Master/purchase_type'); }
    $data['update'] = 'update';
    $data['update_purchase_type'] = 'update';
    $data['purchase_type_info'] = $purchase_type_info[0];
    $data['act_link'] = base_url().'Master/edit_purchase_type/'.$purchase_type_id;

    $data['purchase_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','purchase_type_id','ASC','smm_purchase_type');
    $data['page'] = 'Edit Purchase Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/purchase_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Purchase Type...
  public function delete_purchase_type($purchase_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('purchase_type_id', $purchase_type_id, 'smm_purchase_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/purchase_type');
  }


/********************************* Sale Type ***********************************/
  // Add Sale Type...
  public function sale_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('sale_type_name', 'Sale Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $sale_type_status = $this->input->post('sale_type_status');
      if(!isset($sale_type_status)){ $sale_type_status = '1'; }
      $save_data = $_POST;
      $save_data['sale_type_status'] = $sale_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['sale_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_sale_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/sale_type');
    }

    $data['sale_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','sale_type_id','ASC','smm_sale_type');
    $data['page'] = 'Sale Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/sale_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Sale Type...
  public function edit_sale_type($sale_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('sale_type_name', 'Sale Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $sale_type_status = $this->input->post('sale_type_status');
      if(!isset($sale_type_status)){ $sale_type_status = '1'; }
      $update_data = $_POST;
      $update_data['sale_type_status'] = $sale_type_status;
      $update_data['sale_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('sale_type_id', $sale_type_id, 'smm_sale_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/sale_type');
    }

    $sale_type_info = $this->Master_Model->get_info_arr('sale_type_id',$sale_type_id,'smm_sale_type');
    if(!$sale_type_info){ header('location:'.base_url().'Master/sale_type'); }
    $data['update'] = 'update';
    $data['update_sale_type'] = 'update';
    $data['sale_type_info'] = $sale_type_info[0];
    $data['act_link'] = base_url().'Master/edit_sale_type/'.$sale_type_id;

    $data['sale_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','sale_type_id','ASC','smm_sale_type');
    $data['page'] = 'Edit Sale Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/sale_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Sale Type...
  public function delete_sale_type($sale_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('sale_type_id', $sale_type_id, 'smm_sale_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/sale_type');
  }






/********************************* Freelancer ***********************************/

  // Add Freelancer...
  public function freelancer(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('freelancer_name', 'freelancer title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $freelancer_status = $this->input->post('freelancer_status');
      if(!isset($freelancer_status)){ $freelancer_status = '1'; }
      $save_data = $_POST;
      $save_data['freelancer_status'] = $freelancer_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['freelancer_addedby'] = $smm_user_id;
      $freelancer_id = $this->Master_Model->save_data('smm_freelancer', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/freelancer');
    }
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');

    $data['freelancer_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','freelancer_id','DESC','smm_freelancer');
    $data['page'] = 'Freelancer';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/freelancer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Freelancer...
  public function edit_freelancer($freelancer_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('freelancer_name', 'freelancer title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $freelancer_status = $this->input->post('freelancer_status');
      if(!isset($freelancer_status)){ $freelancer_status = '1'; }
      $update_data = $_POST;
      $update_data['freelancer_status'] = $freelancer_status;
      $update_data['freelancer_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('freelancer_id', $freelancer_id, 'smm_freelancer', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/freelancer');
    }
    $freelancer_info = $this->Master_Model->get_info_arr('freelancer_id',$freelancer_id,'smm_freelancer');
    if(!$freelancer_info){ header('location:'.base_url().'Master/freelancer'); }
    $data['update'] = 'update';
    $data['update_freelancer'] = 'update';
    $data['freelancer_info'] = $freelancer_info[0];
    $data['act_link'] = base_url().'Master/edit_freelancer/'.$freelancer_id;
    $state_id = $freelancer_info[0]['state_id'];
    $country_id = $freelancer_info[0]['country_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');

    $data['freelancer_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','freelancer_id','DESC','smm_freelancer');
    $data['page'] = 'Edit Freelancer';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/freelancer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Freelancer...
  public function delete_freelancer($freelancer_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // $freelancer_info = $this->Master_Model->get_info_arr_fields('freelancer_logo, freelancer_id', 'freelancer_id', $freelancer_id, 'smm_freelancer');
    // if($freelancer_info){
    //   $freelancer_logo = $freelancer_info[0]['freelancer_logo'];
    //   if($freelancer_logo){ unlink("assets/images/freelancer/".$freelancer_logo); }
    // }
    $this->Master_Model->delete_info('freelancer_id', $freelancer_id, 'smm_freelancer');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/freelancer');
  }


/*********************************** Review *********************************/

  // Add Review....
  public function review(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('review_date', 'Review Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $review_status = $this->input->post('review_status');
      if(!isset($review_status)){ $review_status = '1'; }
      $save_data = $_POST;
      $save_data['review_status'] = $review_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['review_addedby'] = $smm_user_id;
      $review_id = $this->Master_Model->save_data('smm_review', $save_data);

      if($_FILES['review_image']['name']){
        $time = time();
        $image_name = 'review_'.$review_id.'_'.$time;
        $config['upload_path'] = 'assets/images/review/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['review_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('review_image') && $review_id && $image_name && $ext && $filename){
          $review_image_up['review_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('review_id', $review_id, 'smm_review', $review_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/review');
    }
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['client_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','client_name','ASC','smm_client');

    $data['review_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','review_id','DESC','smm_review');
    $data['page'] = 'Review';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/review', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Review...
  public function edit_review($review_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('review_date', 'Review Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $review_status = $this->input->post('review_status');
      if(!isset($review_status)){ $review_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_review_img']);
      $update_data['review_status'] = $review_status;
      $update_data['review_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('review_id', $review_id, 'smm_review', $update_data);

      if($_FILES['review_image']['name']){
        $time = time();
        $image_name = 'review_'.$review_id.'_'.$time;
        $config['upload_path'] = 'assets/images/review/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['review_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('review_image') && $review_id && $image_name && $ext && $filename){
          $review_image_up['review_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('review_id', $review_id, 'smm_review', $review_image_up);
          if($_POST['old_review_img']){ unlink("assets/images/review/".$_POST['old_review_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/review');
    }

    $review_info = $this->Master_Model->get_info_arr('review_id',$review_id,'smm_review');
    if(!$review_info){ header('location:'.base_url().'Master/review'); }
    $data['update'] = 'update';
    $data['update_review'] = 'update';
    $data['review_info'] = $review_info[0];
    $data['act_link'] = base_url().'Master/edit_review/'.$review_id;
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['client_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','client_name','ASC','smm_client');

    $data['review_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','review_id','DESC','smm_review');
    $data['page'] = 'Edit Review';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/review', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Review...
  public function delete_review($review_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $review_info = $this->Master_Model->get_info_arr_fields('review_image, review_id', 'review_id', $review_id, 'smm_review');
    if($review_info){
      $review_image = $review_info[0]['review_image'];
      if($review_image){ unlink("assets/images/review/".$review_image); }
    }
    $this->Master_Model->delete_info('review_id', $review_id, 'smm_review');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/review');
  }


/*********************************** Web Setup Request *********************************/

  // Add Web Setup Request....
  public function web_setup_request(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }


    $data['web_setup_request_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','web_setup_request_id','DESC','smm_web_setup_request');
    $data['page'] = 'Web Setup Request';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/web_setup_request', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Web Setup Request...
  public function edit_web_setup_request($web_setup_request_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('web_setup_request_no', 'Web Setup Request Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $this->Master_Model->update_info('web_setup_request_id', $web_setup_request_id, 'smm_web_setup_request', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/web_setup_request');
    }

    $web_setup_request_info = $this->Master_Model->get_info_arr('web_setup_request_id',$web_setup_request_id,'smm_web_setup_request');
    if(!$web_setup_request_info){ header('location:'.base_url().'Master/web_setup_request'); }
    $data['update'] = 'update';
    $data['update_web_setup_request'] = 'update';
    $data['web_setup_request_info'] = $web_setup_request_info[0];
    $data['act_link'] = base_url().'Master/edit_web_setup_request/'.$web_setup_request_id;

    $data['web_setup_request_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','web_setup_request_id','DESC','smm_web_setup_request');
    $data['page'] = 'Edit Web Setup Request';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/web_setup_request', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

/*****************************************************************************************/
  // Check Duplication
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->Master_Model->check_duplication($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }

  // get_sub_testgroup_by_main
  // public function get_sub_testgroup_by_main(){
  //   $test_group_id = $this->input->post('test_group_id');
  //   $test_subgroup_list = $this->Master_Model->get_list_by_id3('','primary_test_group_id',$test_group_id,'test_group_status','1','','','test_group_name','ASC','test_group');
  //   echo "<option value='' selected >Select Test SubGroup</option>";
  //   foreach ($test_subgroup_list as $list) {
  //     echo "<option value='".$list->test_group_id."'> ".$list->test_group_name." </option>";
  //   }
  // }

  // get_state_by_country
  public function get_state_by_country(){
    $country_id = $this->input->post('country_id');
    $state_list = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    echo "<option value='' selected >Select State</option>";
    foreach ($state_list as $list) {
      echo "<option value='".$list->state_id."'> ".$list->state_name." </option>";
    }
  }

  // get_city_by_state
  public function get_city_by_state(){
    $state_id = $this->input->post('state_id');
    $city_list = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    echo "<option value='' selected >Select City</option>";
    foreach ($city_list as $list) {
      echo "<option value='".$list->city_id."'> ".$list->city_name." </option>";
    }
  }

  // category_by_type
  public function category_by_type(){
    $product_category_type = $this->input->post('product_category_type');
    $product_category_list = $this->Master_Model->get_list_by_id3('','product_category_type',$product_category_type,'product_category_status','1','','','product_category_name','ASC','smm_product_category');
    echo "<option value='' selected >Select Category</option>";
    foreach ($product_category_list as $list) {
      echo "<option value='".$list->product_category_id."'> ".$list->product_category_name." </option>";
    }
  }


}
?>
