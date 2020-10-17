<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_Profile extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){
    // $this->load->view('Admin/User/forgot_password');
  }

  /**************************      Basic Information      ********************************/
  public function basic_info(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_name', 'Employee Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_employee_image']);
      $this->Master_Model->update_info('employee_id', $smm_emp_id, 'smm_employee', $update_data);

      if($_FILES['employee_image']['name']){
        $time = time();
        $image_name = 'employee_'.$smm_emp_id.'_'.$time;
        $config['upload_path'] = 'assets/images/employee/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['employee_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('employee_image') && $smm_emp_id && $image_name && $ext && $filename){
          $employee_image_up['employee_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('employee_id', $smm_emp_id, 'smm_employee', $employee_image_up);
          if($_POST['old_employee_image']){ unlink("assets/images/employee/".$_POST['old_employee_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/basic_info');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];
    $data['page'] = 'Employee Basic Information';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/basic_info', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

/**************************      Salary      ********************************/
  // Employee Salary...
  public function salary(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $data['page'] = 'Employee Basic Information';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/salary', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

/**************************      Contact Information      ********************************/
  // Employee Contact...
  public function employee_contact(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_contact_rel', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;

      $employee_contact_is_primary = $this->input->post('employee_contact_is_primary');
      if(!isset($employee_contact_is_primary)){ $employee_contact_is_primary = '0'; }
      $save_data['employee_contact_is_primary'] = $employee_contact_is_primary;

      $employee_contact_is_dependant = $this->input->post('employee_contact_is_dependant');
      if(!isset($employee_contact_is_dependant)){ $employee_contact_is_dependant = '0'; }
      $save_data['employee_contact_is_dependant'] = $employee_contact_is_dependant;

      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['employee_id'] = $smm_emp_id;
      $save_data['employee_contact_addedby'] = $smm_emp_id;
      $save_data['employee_contact_addedby_type'] = '2';
      $employee_contact_rel_id = $this->Master_Model->save_data('smm_employee_contact', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_contact');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['employee_contact_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_contact_id','DESC','smm_employee_contact');
    $data['page'] = 'Employee Contact';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_contact', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Edit Employee Contact...
  public function edit_employee_contact($employee_contact_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_contact_rel', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;

      $employee_contact_is_primary = $this->input->post('employee_contact_is_primary');
      if(!isset($employee_contact_is_primary)){ $employee_contact_is_primary = '0'; }
      $update_data['employee_contact_is_primary'] = $employee_contact_is_primary;

      $employee_contact_is_dependant = $this->input->post('employee_contact_is_dependant');
      if(!isset($employee_contact_is_dependant)){ $employee_contact_is_dependant = '0'; }
      $update_data['employee_contact_is_dependant'] = $employee_contact_is_dependant;

      $update_data['employee_contact_addedby'] = $smm_emp_id;
      $update_data['employee_contact_addedby_type'] = '2';
      $this->Master_Model->update_info('employee_contact_id', $employee_contact_id, 'smm_employee_contact', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_contact');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $employee_contact_info = $this->Master_Model->get_info_arr_fields3('*', $smm_emp_company_id, 'employee_contact_id', $employee_contact_id, 'employee_id', $smm_emp_id, '', '', 'smm_employee_contact');
    if(!$employee_contact_info){ header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_contact'); }
    $data['update'] = 'update';
    $data['update_employee_contact'] = 'update';
    $data['employee_contact_info'] = $employee_contact_info[0];
    $data['act_link'] = base_url().'Emp_Panel/Emp_Profile/edit_employee_contact/'.$employee_contact_id;


    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['employee_contact_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_contact_id','DESC','smm_employee_contact');
    $data['page'] = 'Employee Contact';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_contact', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Delete Employee Contact...
  public function delete_employee_contact($employee_contact_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }
    // $employee_contact_info = $this->Master_Model->get_info_arr_fields('employee_contact_image, employee_contact_id', 'employee_contact_id', $employee_contact_id, 'smm_employee_contact');
    // if($employee_contact_info){
    //   $employee_contact_image = $employee_contact_info[0]['employee_contact_image'];
    //   if($employee_contact_image){ unlink("assets/images/employee_contact/".$employee_contact_image); }
    // }
    $this->Master_Model->delete_info('employee_contact_id', $employee_contact_id, 'smm_employee_contact');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_contact');
  }



/**************************      Social Networking      ********************************/
  // Employee Social Networking...
  public function social(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_facebook', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $this->Master_Model->update_info('employee_id', $smm_emp_id, 'smm_employee', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/social');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];
    $data['page'] = 'Employee Basic Information';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/social', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  /**************************      Employee Document     ********************************/
  // Employee Document...
  public function employee_doc(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_doc_title', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['employee_id'] = $smm_emp_id;
      $save_data['employee_doc_addedby'] = $smm_emp_id;
      $save_data['employee_doc_addedby_type'] = '2';
      $employee_doc_id = $this->Master_Model->save_data('smm_employee_doc', $save_data);

      if($_FILES['employee_doc_image']['name']){
        $time = time();
        $image_name = 'employee_doc_'.$smm_emp_id.'_'.$employee_doc_id.'_'.$time;
        $config['upload_path'] = 'assets/images/employee_doc/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['employee_doc_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('employee_doc_image') && $employee_doc_id && $image_name && $ext && $filename){
          $employee_doc_image_up['employee_doc_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('employee_doc_id', $employee_doc_id, 'smm_employee_doc', $employee_doc_image_up);
          // unlink("assets/images/tours/".$employee_doc_image_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_doc');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];
    $data['document_type_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','document_type_name','ASC','smm_document_type');

    $data['employee_doc_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_doc_id','DESC','smm_employee_doc');
    $data['page'] = 'Employee Basic Information';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_doc', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }


  // Edit Employee Document...
  public function edit_employee_doc($employee_doc_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_doc_title', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_employee_doc_image']);
      $update_data['employee_doc_addedby'] = $smm_emp_id;
      $update_data['employee_doc_addedby_type'] = '2';
      $this->Master_Model->update_info('employee_doc_id', $employee_doc_id, 'smm_employee_doc', $update_data);

      if($_FILES['employee_doc_image']['name']){
        $time = time();
        $image_name = 'employee_doc_'.$smm_emp_id.'_'.$employee_doc_id.'_'.$time;
        $config['upload_path'] = 'assets/images/employee_doc/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['employee_doc_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('employee_doc_image') && $employee_doc_id && $image_name && $ext && $filename){
          $employee_doc_image_up['employee_doc_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('employee_doc_id', $employee_doc_id, 'smm_employee_doc', $employee_doc_image_up);
          if($_POST['old_employee_doc_image']){ unlink("assets/images/employee_doc/".$_POST['old_employee_doc_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_doc');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $employee_doc_info = $this->Master_Model->get_info_arr('employee_doc_id',$employee_doc_id,'smm_employee_doc');
    if(!$employee_doc_info){ header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_doc'); }
    $data['update'] = 'update';
    $data['update_employee_doc'] = 'update';
    $data['employee_doc_info'] = $employee_doc_info[0];
    $data['act_link'] = base_url().'Emp_Panel/Emp_Profile/edit_employee_doc/'.$employee_doc_id;

    $data['document_type_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','document_type_name','ASC','smm_document_type');

    $data['employee_doc_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_doc_id','DESC','smm_employee_doc');
    $data['page'] = 'Employee Basic Information';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_doc', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Delete Employee Document...
  public function delete_employee_doc($employee_doc_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }
    $employee_doc_info = $this->Master_Model->get_info_arr_fields('employee_doc_image, employee_doc_id', 'employee_doc_id', $employee_doc_id, 'smm_employee_doc');
    if($employee_doc_info){
      $employee_doc_image = $employee_doc_info[0]['employee_doc_image'];
      if($employee_doc_image){ unlink("assets/images/employee_doc/".$employee_doc_image); }
    }
    $this->Master_Model->delete_info('employee_doc_id', $employee_doc_id, 'smm_employee_doc');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_doc');
  }

/**************************      Employee Qualification      ********************************/
  // Employee Qualification...
  public function employee_edu(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('education_info_id', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['employee_id'] = $smm_emp_id;
      $save_data['employee_edu_addedby'] = $smm_emp_id;
      // $save_data['employee_doc_addedby_type'] = '2';
      $employee_doc_id = $this->Master_Model->save_data('smm_employee_edu', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_edu');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $data['education_info_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','education_info_name','ASC','smm_education_info');
    $data['language_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','language_name','ASC','smm_language');
    $data['prof_course_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','prof_course_name','ASC','smm_prof_course');

    $data['employee_edu_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_edu_id','DESC','smm_employee_edu');
    $data['page'] = 'Employee Qualification';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_edu', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Edit Employee Qualification...
  public function edit_employee_edu($employee_edu_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('education_info_id', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $update_data['employee_edu_addedby'] = $smm_emp_id;
      $this->Master_Model->update_info('employee_edu_id', $employee_edu_id, 'smm_employee_edu', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_edu');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $employee_edu_info = $this->Master_Model->get_info_arr('employee_edu_id',$employee_edu_id,'smm_employee_edu');
    if(!$employee_edu_info){ header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_edu'); }
    $data['update'] = 'update';
    $data['update_employee_edu'] = 'update';
    $data['employee_edu_info'] = $employee_edu_info[0];
    $data['act_link'] = base_url().'Emp_Panel/Emp_Profile/edit_employee_edu/'.$employee_edu_id;


    $data['education_info_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','education_info_name','ASC','smm_education_info');
    $data['language_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','language_name','ASC','smm_language');
    $data['prof_course_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','prof_course_name','ASC','smm_prof_course');

    $data['employee_edu_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_edu_id','DESC','smm_employee_edu');
    $data['page'] = 'Employee Qualification';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_edu', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Delete Employee Qualification...
  public function delete_employee_edu($employee_edu_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }
    // $employee_edu_info = $this->Master_Model->get_info_arr_fields('employee_edu_image, employee_edu_id', 'employee_edu_id', $employee_edu_id, 'smm_employee_edu');
    // if($employee_edu_info){
    //   $employee_edu_image = $employee_edu_info[0]['employee_edu_image'];
    //   if($employee_edu_image){ unlink("assets/images/employee_edu/".$employee_edu_image); }
    // }
    $this->Master_Model->delete_info('employee_edu_id', $employee_edu_id, 'smm_employee_edu');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_edu');
  }

/**************************      Work Experience      ********************************/
  // Employee Work Experience...
  public function employee_experience(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_experience_company', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['employee_id'] = $smm_emp_id;
      $save_data['employee_experience_addedby'] = $smm_emp_id;
      $save_data['employee_experience_addedby_type'] = '2';
      $employee_doc_id = $this->Master_Model->save_data('smm_employee_experience', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_experience');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $data['employee_experience_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_experience_id','DESC','smm_employee_experience');
    $data['page'] = 'Work Experience';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_experience', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Edit Employee Work Experience...
  public function edit_employee_experience($employee_experience_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_experience_company', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $update_data['employee_experience_addedby'] = $smm_emp_id;
      $update_data['employee_experience_addedby_type'] = '2';
      $this->Master_Model->update_info('employee_experience_id', $employee_experience_id, 'smm_employee_experience', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_experience');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $employee_experience_info = $this->Master_Model->get_info_arr('employee_experience_id',$employee_experience_id,'smm_employee_experience');
    if(!$employee_experience_info){ header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_experience'); }
    $data['update'] = 'update';
    $data['update_employee_experience'] = 'update';
    $data['employee_experience_info'] = $employee_experience_info[0];
    $data['act_link'] = base_url().'Emp_Panel/Emp_Profile/edit_employee_experience/'.$employee_experience_id;

    $data['employee_experience_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_experience_id','DESC','smm_employee_experience');
    $data['page'] = 'Employee Work Experience';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_experience', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Delete Employee Work Experience...
  public function delete_employee_experience($employee_experience_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->Master_Model->delete_info('employee_experience_id', $employee_experience_id, 'smm_employee_experience');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_experience');
  }


/**************************      Employee Bank Account      ********************************/
  // Employee Bank Account...
  public function employee_bank(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_bank_acc_number', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['employee_id'] = $smm_emp_id;
      $save_data['employee_bank_addedby'] = $smm_emp_id;
      $save_data['employee_bank_addedby_type'] = '2';
      $employee_doc_id = $this->Master_Model->save_data('smm_employee_bank', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_bank');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $data['employee_bank_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_bank_id','DESC','smm_employee_bank');
    $data['page'] = 'Bank Account';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_bank', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Edit Employee Bank Account...
  public function edit_employee_bank($employee_bank_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('employee_bank_acc_number', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $update_data['employee_bank_addedby'] = $smm_emp_id;
      $update_data['employee_bank_addedby_type'] = '2';
      $this->Master_Model->update_info('employee_bank_id', $employee_bank_id, 'smm_employee_bank', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_bank');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];

    $employee_bank_info = $this->Master_Model->get_info_arr('employee_bank_id',$employee_bank_id,'smm_employee_bank');
    if(!$employee_bank_info){ header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_bank'); }
    $data['update'] = 'update';
    $data['update_employee_bank'] = 'update';
    $data['employee_bank_info'] = $employee_bank_info[0];
    $data['act_link'] = base_url().'Emp_Panel/Emp_Profile/edit_employee_bank/'.$employee_bank_id;

    $data['employee_bank_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','employee_bank_id','DESC','smm_employee_bank');
    $data['page'] = 'Employee Bank Account';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/employee_bank', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Delete Employee Bank Account...
  public function delete_employee_bank($employee_bank_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->Master_Model->delete_info('employee_bank_id', $employee_bank_id, 'smm_employee_bank');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Emp_Panel/Emp_Profile/employee_bank');
  }


  /**************************      Change Password      ********************************/

  // Employee Change Password...
  public function change_password(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $old_password = $_POST['old_password'];
      $valid_employee = $this->Master_Model->get_info_arr_fields3('employee_id', $smm_emp_company_id, 'employee_password', $old_password, 'employee_id', $smm_emp_id, '', '', 'smm_employee');
      if($valid_employee){
        $update_data['employee_password'] = $_POST['new_password'];
        $this->Master_Model->update_info('employee_id', $smm_emp_id, 'smm_employee', $update_data);
        $this->session->set_flashdata('update_success','success');
      } else{
        $this->session->set_flashdata('invalid_password','error');
      }
      header('location:'.base_url().'Emp_Panel/Emp_Profile/change_password');
    }

    $employee_info = $this->Master_Model->get_info_arr_fields('*','employee_id', $smm_emp_id, 'smm_employee');
    $data['employee_info'] = $employee_info[0];
    $data['page'] = 'Employee Basic Information';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Profile/change_password', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }


}
?>
