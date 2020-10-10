<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }

/*********************************** Product Settings *********************************/

/********************************* Item Company ***********************************/
  // Add Item Company...
  public function item_company(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('item_company_name', 'Item Company Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $item_company_status = $this->input->post('item_company_status');
      if(!isset($item_company_status)){ $item_company_status = '1'; }
      $save_data = $_POST;
      $save_data['item_company_status'] = $item_company_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['item_company_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_item_company', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/item_company');
    }
    $data['update_product_setting'] = 'update';
    $data['act_link'] = base_url().'Product/item_company';

    $data['item_company_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_company_id','ASC','smm_item_company');
    $data['setting_menu'] = 'item_company';
    $data['page'] = 'Item Company';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/item_company', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Item Company...
  public function edit_item_company($item_company_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('item_company_name', 'Item Company Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $item_company_status = $this->input->post('item_company_status');
      if(!isset($item_company_status)){ $item_company_status = '1'; }
      $update_data = $_POST;
      $update_data['item_company_status'] = $item_company_status;
      $update_data['item_company_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('item_company_id', $item_company_id, 'smm_item_company', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/item_company');
    }

    $item_company_info = $this->Master_Model->get_info_arr('item_company_id',$item_company_id,'smm_item_company');
    if(!$item_company_info){ header('location:'.base_url().'Product/item_company'); }
    $data['update'] = 'update';
    $data['update_product_setting'] = 'update';
    $data['item_company_info'] = $item_company_info[0];
    $data['act_link'] = base_url().'Product/edit_item_company/'.$item_company_id;

    $data['item_company_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_company_id','ASC','smm_item_company');
    $data['setting_menu'] = 'item_company';
    $data['page'] = 'Edit Item Company';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/item_company', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Item Company...
  public function delete_item_company($item_company_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('item_company_id', $item_company_id, 'smm_item_company');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/item_company');
  }

/********************************* Item Group ***********************************/
  // Add Item Group...
  public function item_group(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('item_group_name', 'Item Group Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $item_group_status = $this->input->post('item_group_status');
      if(!isset($item_group_status)){ $item_group_status = '1'; }
      $save_data = $_POST;
      $save_data['item_group_status'] = $item_group_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['item_group_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_item_group', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/item_group');
    }
    $data['update_product_setting'] = 'update';
    $data['act_link'] = base_url().'Product/item_group';

    $data['item_group_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_group_id','ASC','smm_item_group');
    $data['setting_menu'] = 'item_group';
    $data['page'] = 'Item Group';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/item_group', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Item Group...
  public function edit_item_group($item_group_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('item_group_name', 'Item Group Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $item_group_status = $this->input->post('item_group_status');
      if(!isset($item_group_status)){ $item_group_status = '1'; }
      $update_data = $_POST;
      $update_data['item_group_status'] = $item_group_status;
      $update_data['item_group_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('item_group_id', $item_group_id, 'smm_item_group', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/item_group');
    }

    $item_group_info = $this->Master_Model->get_info_arr('item_group_id',$item_group_id,'smm_item_group');
    if(!$item_group_info){ header('location:'.base_url().'Product/item_group'); }
    $data['update'] = 'update';
    $data['update_product_setting'] = 'update';
    $data['item_group_info'] = $item_group_info[0];
    $data['act_link'] = base_url().'Product/edit_item_group/'.$item_group_id;

    $data['item_group_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_group_id','ASC','smm_item_group');
    $data['setting_menu'] = 'item_group';
    $data['page'] = 'Edit Item Group';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/item_group', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Item Group...
  public function delete_item_group($item_group_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('item_group_id', $item_group_id, 'smm_item_group');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/item_group');
  }

/********************************* Unit ***********************************/
  // Add Unit...
  public function unit(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $unit_status = $this->input->post('unit_status');
      if(!isset($unit_status)){ $unit_status = '1'; }
      $save_data = $_POST;
      $save_data['unit_status'] = $unit_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['unit_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_unit', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/unit');
    }
    $data['update_product_setting'] = 'update';
    $data['act_link'] = base_url().'Product/unit';

    $data['unit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','unit_id','ASC','smm_unit');
    $data['setting_menu'] = 'unit';
    $data['page'] = 'Unit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/unit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Unit...
  public function edit_unit($unit_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $unit_status = $this->input->post('unit_status');
      if(!isset($unit_status)){ $unit_status = '1'; }
      $update_data = $_POST;
      $update_data['unit_status'] = $unit_status;
      $update_data['unit_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('unit_id', $unit_id, 'smm_unit', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/unit');
    }

    $unit_info = $this->Master_Model->get_info_arr('unit_id',$unit_id,'smm_unit');
    if(!$unit_info){ header('location:'.base_url().'Product/unit'); }
    $data['update'] = 'update';
    $data['update_product_setting'] = 'update';
    $data['unit_info'] = $unit_info[0];
    $data['act_link'] = base_url().'Product/edit_unit/'.$unit_id;

    $data['unit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','unit_id','ASC','smm_unit');
    $data['setting_menu'] = 'unit';
    $data['page'] = 'Edit Unit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/unit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Unit...
  public function delete_unit($unit_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('unit_id', $unit_id, 'smm_unit');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/unit');
  }

/********************************* GST Slab ***********************************/

  // Add GST Slab...
  public function gst_slab(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('gst_slab_name', 'gst_slab Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $gst_slab_status = $this->input->post('gst_slab_status');
      if(!isset($gst_slab_status)){ $gst_slab_status = '1'; }

      $save_data = $_POST;
      $save_data['gst_slab_status'] = $gst_slab_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['gst_slab_addedby'] = $smm_user_id;
      $gst_slab_id = $this->Master_Model->save_data('smm_gst_slab', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/gst_slab');
    }

    $data['gst_slab_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','gst_slab_id','DESC','smm_gst_slab');

    $data['page'] = 'GST Slab';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/gst_slab', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit GST Slab...
  public function edit_gst_slab($gst_slab_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('gst_slab_name', 'gst_slab title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $gst_slab_status = $this->input->post('gst_slab_status');
      if(!isset($gst_slab_status)){ $gst_slab_status = '1'; }

      $update_data = $_POST;
      $update_data['gst_slab_status'] = $gst_slab_status;
      $update_data['gst_slab_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('gst_slab_id', $gst_slab_id, 'smm_gst_slab', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/gst_slab');
    }
    $gst_slab_info = $this->Master_Model->get_info_arr('gst_slab_id',$gst_slab_id,'smm_gst_slab');
    if(!$gst_slab_info){ header('location:'.base_url().'Product/gst_slab'); }
    $data['update'] = 'update';
    $data['update_gst_slab'] = 'update';
    $data['gst_slab_info'] = $gst_slab_info[0];
    $data['act_link'] = base_url().'Product/edit_gst_slab/'.$gst_slab_id;

    $data['gst_slab_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','gst_slab_id','DESC','smm_gst_slab');
    $data['page'] = 'Edit GST Slab';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/gst_slab', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete GST Slab...
  public function delete_gst_slab($gst_slab_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('gst_slab_id', $gst_slab_id, 'smm_gst_slab');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/gst_slab');
  }

/*********************************** Product *********************************/

  // Add Product....
  public function product(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('product_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $product_status = $this->input->post('product_status');
      if(!isset($product_status)){ $product_status = '1'; }
      $save_data = $_POST;
      $save_data['product_status'] = $product_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['product_addedby'] = $smm_user_id;
      $product_id = $this->Master_Model->save_data('smm_product', $save_data);

      if($_FILES['product_image']['name']){
        $time = time();
        $image_name = 'product_'.$product_id.'_'.$time;
        $config['upload_path'] = 'assets/images/product/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['product_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('product_image') && $product_id && $image_name && $ext && $filename){
          $product_image_up['product_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('product_id', $product_id, 'smm_product', $product_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/product');
    }
    $data['gst_slab_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','gst_slab_per','ASC','smm_gst_slab');
    $data['unit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','unit_name','ASC','smm_unit');
    $data['item_company_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_company_name','ASC','smm_item_company');
    $data['item_group_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_group_name','ASC','smm_item_group');

    $data['product_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','product_id','DESC','smm_product');
    $data['page'] = 'Product';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/product', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Product...
  public function edit_product($product_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('product_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $product_status = $this->input->post('product_status');
      if(!isset($product_status)){ $product_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_product_image']);
      $update_data['product_status'] = $product_status;
      $update_data['product_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('product_id', $product_id, 'smm_product', $update_data);

      if($_FILES['product_image']['name']){
        $time = time();
        $image_name = 'product_'.$product_id.'_'.$time;
        $config['upload_path'] = 'assets/images/product/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['product_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('product_image') && $product_id && $image_name && $ext && $filename){
          $product_image_up['product_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('product_id', $product_id, 'smm_product', $product_image_up);
          if($_POST['old_product_img']){ unlink("assets/images/product/".$_POST['old_product_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/product');
    }

    $product_info = $this->Master_Model->get_info_arr('product_id',$product_id,'smm_product');
    if(!$product_info){ header('location:'.base_url().'Product/product'); }
    $data['update'] = 'update';
    $data['update_product'] = 'update';
    $data['product_info'] = $product_info[0];
    $data['act_link'] = base_url().'Product/edit_product/'.$product_id;
    // $product_category_type = $product_info[0]['product_category_type'];
    // $data['product_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'product_category_status','1','product_category_type',$product_category_type,'','','product_category_name','ASC','smm_product_category');
    $data['gst_slab_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','gst_slab_per','ASC','smm_gst_slab');
    $data['unit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','unit_name','ASC','smm_unit');
    $data['item_company_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_company_name','ASC','smm_item_company');
    $data['item_group_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','item_group_name','ASC','smm_item_group');

    $data['product_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','product_id','DESC','smm_product');
    $data['page'] = 'Edit Product';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/product', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Product...
  public function delete_product($product_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $product_info = $this->Master_Model->get_info_arr_fields('product_image, product_id', 'product_id', $product_id, 'smm_product');
    if($product_info){
      $product_image = $product_info[0]['product_image'];
      if($product_image){ unlink("assets/images/product/".$product_image); }
    }
    $this->Master_Model->delete_info('product_id', $product_id, 'smm_product');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/product');
  }



/********************************* Package Category ***********************************/
  // Add Package Category...
  public function package_category(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('package_category_name', 'Package Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $package_category_status = $this->input->post('package_category_status');
      if(!isset($package_category_status)){ $package_category_status = '1'; }
      $save_data = $_POST;
      $save_data['package_category_status'] = $package_category_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['package_category_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_package_category', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/package_category');
    }
    $data['update_product_setting'] = 'update';
    $data['act_link'] = base_url().'Product/package_category';

    $data['package_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','package_category_id','ASC','smm_package_category');
    $data['setting_menu'] = 'package_category';
    $data['page'] = 'Package Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/package_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Package Category...
  public function edit_package_category($package_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('package_category_name', 'Package Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $package_category_status = $this->input->post('package_category_status');
      if(!isset($package_category_status)){ $package_category_status = '1'; }
      $update_data = $_POST;
      $update_data['package_category_status'] = $package_category_status;
      $update_data['package_category_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('package_category_id', $package_category_id, 'smm_package_category', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/package_category');
    }

    $package_category_info = $this->Master_Model->get_info_arr('package_category_id',$package_category_id,'smm_package_category');
    if(!$package_category_info){ header('location:'.base_url().'Product/package_category'); }
    $data['update'] = 'update';
    $data['update_product_setting'] = 'update';
    $data['package_category_info'] = $package_category_info[0];
    $data['act_link'] = base_url().'Product/edit_package_category/'.$package_category_id;

    $data['package_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','package_category_id','ASC','smm_package_category');
    $data['setting_menu'] = 'package_category';
    $data['page'] = 'Edit Package Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/package_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Package Category...
  public function delete_package_category($package_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('package_category_id', $package_category_id, 'smm_package_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/package_category');
  }

/********************************* Package ***********************************/
  // Add Package...
  public function package(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('package_name', 'Package Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $save_data = $_POST;
      unset($save_data['files']);
      unset($save_data['input']);
      unset($save_data['package_feature_name']);
      $package_status = $this->input->post('package_status');
      if(!isset($package_status)){ $package_status = '1'; }
      $save_data['package_status'] = $package_status;

      $package_is_refundable = $this->input->post('package_is_refundable');
      if(!isset($package_is_refundable)){ $package_is_refundable = '0'; }
      $save_data['package_is_refundable'] = $package_is_refundable;

      $package_is_renewable = $this->input->post('package_is_renewable');
      if(!isset($package_is_renewable)){ $package_is_renewable = '0'; }
      $save_data['package_is_renewable'] = $package_is_renewable;

      $save_data['company_id'] = $smm_company_id;
      $save_data['package_addedby'] = $smm_user_id;
      $package_id = $this->Master_Model->save_data('smm_package', $save_data);

      if($_FILES['package_image']['name']){
        $time = time();
        $image_name = 'package_'.$package_id.'_'.$time;
        $config['upload_path'] = 'assets/images/package/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['package_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('package_image') && $package_id && $image_name && $ext && $filename){
          $package_image_up['package_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('package_id', $package_id, 'smm_package', $package_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      // if(isset($_FILES['package_feature_image']['name'])){
      //   $this->load->library('upload');
      //   $files = $_FILES;
      //   $cpt = count($_FILES['package_feature_image']['name']);
      //   for($i=0; $i<$cpt; $i++)
      //   {
      //     $j = $i+1;
      //     $time = time();
      //     $image_name = 'package_feature_'.$package_id.'_'.$j.'_'.$time;
      //     $_FILES['package_feature_image']['name']= $files['package_feature_image']['name'][$i];
      //     $_FILES['package_feature_image']['type']= $files['package_feature_image']['type'][$i];
      //     $_FILES['package_feature_image']['tmp_name']= $files['package_feature_image']['tmp_name'][$i];
      //     $_FILES['package_feature_image']['error']= $files['package_feature_image']['error'][$i];
      //     $_FILES['package_feature_image']['size']= $files['package_feature_image']['size'][$i];
      //     $config['upload_path'] = 'assets/images/package/';
      //     $config['allowed_types'] = 'gif|jpg|jpeg|png';
      //     $config['file_name'] = $image_name;
      //     $config['overwrite']     = FALSE;
      //     $filename = $files['package_feature_image']['name'][$i];
      //     $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //     $this->upload->initialize($config);
      //     $package_feature_name = $_POST['package_feature_name'][$i];
      //     if($this->upload->do_upload('package_feature_image') && $filename && $ext ){
      //       $file_data['package_feature_image'] = $image_name.'.'.$ext;
      //       $file_data['package_id'] = $package_id;
      //       $file_data['package_feature_name'] = $package_feature_name;
      //       $this->Master_Model->save_data('smm_package_feature', $file_data);
      //     }
      //     else{
      //       $error = $this->upload->display_errors();
      //       $this->session->set_flashdata('status',$this->upload->display_errors());
      //     }
      //   }
      // }
      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          $multi_data['package_id'] = $package_id;
          $multi_data['company_id'] = $smm_company_id;
          $multi_data['package_feature_addedby'] = $smm_user_id;
          $this->db->insert('smm_package_feature', $multi_data);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/package');
    }
    $data['gst_slab_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','gst_slab_per','ASC','smm_gst_slab');
    $data['package_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','package_category_name','ASC','smm_package_category');

    $data['package_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','package_id','ASC','smm_package');
    $data['page'] = 'Package';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/package', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Package...
  public function edit_package($package_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('package_name', 'Package Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $update_data = $_POST;
      unset($update_data['files']);
      unset($update_data['input']);
      unset($update_data['old_package_image']);
      unset($update_data['package_feature_name']);
      
      $package_status = $this->input->post('package_status');
      if(!isset($package_status)){ $package_status = '1'; }
      $update_data['package_status'] = $package_status;

      $package_is_refundable = $this->input->post('package_is_refundable');
      if(!isset($package_is_refundable)){ $package_is_refundable = '0'; }
      $save_data['package_is_refundable'] = $package_is_refundable;

      $package_is_renewable = $this->input->post('package_is_renewable');
      if(!isset($package_is_renewable)){ $package_is_renewable = '0'; }
      $save_data['package_is_renewable'] = $package_is_renewable;

      $update_data['package_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('package_id', $package_id, 'smm_package', $update_data);

      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          if(isset($multi_data['package_feature_id'])){
            $package_feature_id = $multi_data['package_feature_id'];
            if(!isset($multi_data['package_feature_name'])){
              $this->Master_Model->delete_info('package_feature_id', $package_feature_id, 'smm_package_feature');
            }else{
              $multi_data['package_feature_addedby'] = $smm_user_id;
              $this->Master_Model->update_info('package_feature_id', $package_feature_id, 'smm_package_feature', $multi_data);
            }
          }
          else{
            $multi_data['package_id'] = $package_id;
            $multi_data['company_id'] = $smm_company_id;
            $multi_data['package_feature_addedby'] = $smm_user_id;
            $this->db->insert('smm_package_feature', $multi_data);
          }
        }
      }

      // if(isset($_FILES['package_feature_image']['name'])){
      //   $this->load->library('upload');
      //   $files = $_FILES;
      //   $cpt = count($_FILES['package_feature_image']['name']);
      //   for($i=0; $i<$cpt; $i++)
      //   {
      //     $j = $i+1;
      //     $time = time();
      //     $image_name = 'package_feature_'.$package_id.'_'.$j.'_'.$time;
      //     $_FILES['package_feature_image']['name']= $files['package_feature_image']['name'][$i];
      //     $_FILES['package_feature_image']['type']= $files['package_feature_image']['type'][$i];
      //     $_FILES['package_feature_image']['tmp_name']= $files['package_feature_image']['tmp_name'][$i];
      //     $_FILES['package_feature_image']['error']= $files['package_feature_image']['error'][$i];
      //     $_FILES['package_feature_image']['size']= $files['package_feature_image']['size'][$i];
      //     $config['upload_path'] = 'assets/images/package/';
      //     $config['allowed_types'] = 'gif|jpg|jpeg|png';
      //     $config['file_name'] = $image_name;
      //     $config['overwrite']     = FALSE;
      //     $filename = $files['package_feature_image']['name'][$i];
      //     $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //     $this->upload->initialize($config);
      //     $package_feature_name = $_POST['package_feature_name'][$i];
      //     if($this->upload->do_upload('package_feature_image') && $filename && $ext ){
      //       $file_data['package_feature_image'] = $image_name.'.'.$ext;
      //       $file_data['package_id'] = $package_id;
      //       $file_data['package_feature_name'] = $package_feature_name;
      //       $this->Master_Model->save_data('smm_package_feature', $file_data);
      //     }
      //     else{
      //       $error = $this->upload->display_errors();
      //       $this->session->set_flashdata('status',$this->upload->display_errors());
      //     }
      //   }
      // }

      if($_FILES['package_image']['name']){
        $time = time();
        $image_name = 'package_'.$package_id.'_'.$time;
        $config['upload_path'] = 'assets/images/package/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['package_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('package_image') && $package_id && $image_name && $ext && $filename){
          $package_image_up['package_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('package_id', $package_id, 'smm_package', $package_image_up);
          if($_POST['old_package_image']){ unlink("assets/images/package/".$_POST['old_package_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/package');
    }

    $package_info = $this->Master_Model->get_info_arr('package_id',$package_id,'smm_package');
    if(!$package_info){ header('location:'.base_url().'Product/package'); }
    $data['update'] = 'update';
    $data['update_package'] = 'update';
    $data['package_info'] = $package_info[0];
    $data['act_link'] = base_url().'Product/edit_package/'.$package_id;
    $data['gst_slab_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'gst_slab_status','1','','','','','gst_slab_per','ASC','smm_gst_slab');
    $data['package_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','package_category_name','ASC','smm_package_category');

    $data['package_feature_list'] = $this->Master_Model->get_list_by_id3('','','','','','package_id',$package_id,'package_feature_id','ASC','smm_package_feature');
    $data['package_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','package_id','ASC','smm_package');
    $data['page'] = 'Edit Package';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/package', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Package Feature File
  public function delete_package_feature(){
    $package_feature_id = $this->input->post('package_feature_id');
    $package_feature_info = $this->Master_Model->get_info_arr_fields('package_feature_image, package_feature_id', 'package_feature_id', $package_feature_id, 'smm_package_feature');
    if($package_feature_info){
      $package_feature_image = $package_feature_info[0]['package_feature_image'];
      if($package_feature_image){ unlink("assets/images/feature/".$package_feature_image); }
    }
    $this->Master_Model->delete_info('package_feature_id', $package_feature_id, 'smm_package_feature');
  }

  //Delete Package...
  public function delete_package($package_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $package_info = $this->Master_Model->get_info_arr_fields('package_image, package_id', 'package_id', $package_id, 'smm_package');
    if($package_info){
      $package_image = $package_info[0]['package_image'];
      if($package_image){ unlink("assets/images/package/".$package_image); }
    }
    $this->Master_Model->delete_info('package_id', $package_id, 'smm_package');
    $this->Master_Model->delete_info('package_id', $package_id, 'smm_package_feature');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/package');
  }



















/*********************************** Brand *********************************/

  // Add Brand....
  public function brand(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('brand_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $brand_status = $this->input->post('brand_status');
      if(!isset($brand_status)){ $brand_status = '1'; }
      $save_data = $_POST;
      $save_data['brand_status'] = $brand_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['brand_addedby'] = $smm_user_id;
      $brand_id = $this->Master_Model->save_data('brand', $save_data);

      if($_FILES['brand_image']['name']){
        $time = time();
        $image_name = 'brand_'.$brand_id.'_'.$time;
        $config['upload_path'] = 'assets/images/brand/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['brand_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('brand_image') && $brand_id && $image_name && $ext && $filename){
          $brand_image_up['brand_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('brand_id', $brand_id, 'brand', $brand_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/brand');
    }

    $data['brand_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','brand_id','DESC','brand');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/brand', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Brand...
  public function edit_brand($brand_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('brand_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $brand_status = $this->input->post('brand_status');
      if(!isset($brand_status)){ $brand_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_brand_img']);
      $update_data['brand_status'] = $brand_status;
      $update_data['brand_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('brand_id', $brand_id, 'brand', $update_data);

      if($_FILES['brand_image']['name']){
        $time = time();
        $image_name = 'brand_'.$brand_id.'_'.$time;
        $config['upload_path'] = 'assets/images/brand/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['brand_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('brand_image') && $brand_id && $image_name && $ext && $filename){
          $brand_image_up['brand_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('brand_id', $brand_id, 'brand', $brand_image_up);
          if($_POST['old_brand_img']){ unlink("assets/images/brand/".$_POST['old_brand_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/brand');
    }

    $brand_info = $this->Master_Model->get_info_arr('brand_id',$brand_id,'brand');
    if(!$brand_info){ header('location:'.base_url().'Product/brand'); }
    $data['update'] = 'update';
    $data['update_brand'] = 'update';
    $data['brand_info'] = $brand_info[0];
    $data['act_link'] = base_url().'Product/edit_brand/'.$brand_id;

    $data['brand_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','brand_id','DESC','brand');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/brand', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Brand...
  public function delete_brand($brand_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $brand_info = $this->Master_Model->get_info_arr_fields('brand_image, brand_id', 'brand_id', $brand_id, 'brand');
    if($brand_info){
      $brand_image = $brand_info[0]['brand_image'];
      if($brand_image){ unlink("assets/images/brand/".$brand_image); }
    }
    $this->Master_Model->delete_info('brand_id', $brand_id, 'brand');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/brand');
  }


/***************************************************************************************************************/
/*********************************************** Hospital ******************************************************/
/***************************************************************************************************************/






/***************************************************************************************************************/
  public function get_sub_category_by_main(){
    $smm_company_id = $this->session->userdata('smm_company_id');
    $main_category_id = $this->input->post('main_category_id');
    $sub_category_list = $this->Master_Model->get_list_by_id3($smm_company_id,'main_category_id',$main_category_id,'','','','','sub_category_name','ASC','sub_category');
    echo '<option value="" selected >Select Sub Category (Level-1)</option>';
    foreach ($sub_category_list as $sub_category_list1) {
      echo '<option value="'.$sub_category_list1->sub_category_id.'">'.$sub_category_list1->sub_category_name.'</option>';
    }
  }

  public function get_sub_category_two_by_sub(){
    $smm_company_id = $this->session->userdata('smm_company_id');
    $sub_category_id = $this->input->post('sub_category_id');
    $sub_category_list = $this->Master_Model->get_list_by_id3($smm_company_id,'sub_category_id',$sub_category_id,'','','','','sub_category_two_name','ASC','sub_category_two');
    echo '<option value="" selected >Select Sub Category (Level-2)</option>';
    foreach ($sub_category_list as $sub_category_list1) {
      echo '<option value="'.$sub_category_list1->sub_category_two_id.'">'.$sub_category_list1->sub_category_two_name.'</option>';
    }
  }

}
