<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_info extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }

/*********************************** Slider *********************************/

  // Add Slider....
  public function slider(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_name', 'Slider Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $save_data = $_POST;
      $save_data['slider_status'] = $slider_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['slider_addedby'] = $smm_user_id;
      $slider_id = $this->Master_Model->save_data('smm_slider', $save_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $slider_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/slider');
    }

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'slider_addedby_type','1','','','','','slider_id','DESC','smm_slider');
    $data['page'] = 'Slider';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/slider', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Slider...
  public function edit_slider($slider_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_name', 'Slider Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_slider_img']);
      $update_data['slider_status'] = $slider_status;
      $update_data['slider_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $update_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $slider_image_up);
          if($_POST['old_slider_img']){ unlink("assets/images/slider/".$_POST['old_slider_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/slider');
    }

    $slider_info = $this->Master_Model->get_info_arr('slider_id',$slider_id,'smm_slider');
    if(!$slider_info){ header('location:'.base_url().'Web_info/slider'); }
    $data['update'] = 'update';
    $data['update_slider'] = 'update';
    $data['slider_info'] = $slider_info[0];
    $data['act_link'] = base_url().'Web_info/edit_slider/'.$slider_id;

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'slider_addedby_type','1','','','','','slider_id','DESC','smm_slider');
    $data['page'] = 'Edit Slider';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/slider', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Slider...
  public function delete_slider($slider_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $slider_info = $this->Master_Model->get_info_arr_fields('slider_image, slider_id', 'slider_id', $slider_id, 'smm_slider');
    if($slider_info){
      $slider_image = $slider_info[0]['slider_image'];
      if($slider_image){ unlink("assets/images/slider/".$slider_image); }
    }
    $this->Master_Model->delete_info('slider_id', $slider_id, 'smm_slider');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/slider');
  }



}
?>
