<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

/**************************      Company Information      ********************************/

  // Company List...
  public function company_list(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $data['company_list'] = $this->Master_Model->get_list($smm_company_id,'company_id','ASC','company');
    $data['page'] = 'Company';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/company_list', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Company...
  public function edit_company($company_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
    $this->form_validation->set_rules('company_address', 'company_address', 'trim|required');

    if ($this->form_validation->run() != FALSE) {
      $up_data = $_POST;
      unset($up_data['old_company_logo']);
      unset($up_data['old_company_fevicon']);
      $this->Master_Model->update_info('company_id', $company_id, 'company', $up_data);

      if($_FILES['company_logo']['name']){
        $time = time();
        $image_name = 'company_logo_'.$company_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['company_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('company_logo') && $company_id && $image_name && $ext && $filename){
          $company_logo_up['company_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('company_id', $company_id, 'company', $company_logo_up);
          if($_POST['old_company_logo']){ unlink("assets/images/master/".$_POST['old_company_logo']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      if($_FILES['company_fevicon']['name']){
        $time = time();
        $image_name = 'company_fevicon_'.$company_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['company_fevicon']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('company_fevicon') && $company_id && $image_name && $ext && $filename){
          $company_fevicon_up['company_fevicon'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('company_id', $company_id, 'company', $company_fevicon_up);
          if($_POST['old_company_fevicon']){ unlink("assets/images/master/".$_POST['old_company_fevicon']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/company_list');
    }
    $company_info = $this->Master_Model->get_info_arr('company_id',$company_id,'company');
    if(!$company_info){ header('location:'.base_url().'Company/company_list'); }
    $data['update'] = 'update';
    $data['update_company'] = 'update';
    $data['company_info'] = $company_info[0];
    $data['act_link'] = base_url().'Company/edit_company/'.$company_id;

    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');
    $data['currency_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','currency_name','ASC','smm_currency');
    $data['company_entity_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','company_entity_name','ASC','smm_company_entity');

    $data['page'] = 'Update Company';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/company_information', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

/******************************* Department ****************************/

  // Add Department...
  public function department(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('department_name', 'Department Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $department_status = $this->input->post('department_status');
      if(!isset($department_status)){ $department_status = '1'; }
      $save_data = $_POST;
      $save_data['department_status'] = $department_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['department_addedby'] = $smm_user_id;
      $department_id = $this->Master_Model->save_data('smm_department', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/department');
    }
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_id','ASC','smm_department');
    $data['page'] = 'Department';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/department', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Department...
  public function edit_department($department_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('department_name', 'Department Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $department_status = $this->input->post('department_status');
      if(!isset($department_status)){ $department_status = '1'; }
      $update_data = $_POST;
      $update_data['department_status'] = $department_status;
      $update_data['department_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('department_id', $department_id, 'smm_department', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/department');
    }

    $department_info = $this->Master_Model->get_info_arr('department_id',$department_id,'smm_department');
    if(!$department_info){ header('location:'.base_url().'Company/department'); }
    $data['update'] = 'update';
    $data['update_department'] = 'update';
    $data['department_info'] = $department_info[0];
    $data['act_link'] = base_url().'Company/edit_department/'.$department_id;

    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_id','ASC','user');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_id','ASC','smm_department');
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['page'] = 'Edit Department';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/department', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Department...
  public function delete_department($department_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('department_id', $department_id, 'smm_department');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/department');
  }

/*******************************    Branch Information      ****************************/

  // Add Branch...
  public function branch(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('branch_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $branch_status = $this->input->post('branch_status');
      if(!isset($branch_status)){ $branch_status = '1'; }
      $save_data = $_POST;
      $save_data['branch_status'] = $branch_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['branch_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_branch', $save_data);

      // if($_FILES['branch_image']['name']){
      //   $time = time();
      //   $image_name = 'branch_'.$branch_id.'_'.$time;
      //   $config['upload_path'] = 'assets/images/master/';
      //   $config['allowed_types'] = 'jpg|jpeg|png|gif';
      //   $config['file_name'] = $image_name;
      //   $filename = $_FILES['branch_image']['name'];
      //   $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //   $this->upload->initialize($config); // if upload library autoloaded
      //   if ($this->upload->do_upload('branch_image') && $branch_id && $image_name && $ext && $filename){
      //     $branch_image_up['branch_image'] =  $image_name.'.'.$ext;
      //     $this->Master_Model->update_info('branch_id', $branch_id, 'smm_branch', $branch_image_up);
      //     $this->session->set_flashdata('upload_success','File Uploaded Successfully');
      //   }
      //   else{
      //     $error = $this->upload->display_errors();
      //     $this->session->set_flashdata('upload_error',$error);
      //   }
      // }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/branch');
    }
    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    // $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    // $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    // $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_id','ASC','user');

    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_id','ASC','smm_branch');
    $data['page'] = 'Branch';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/branch', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Branch...
  public function edit_branch($branch_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $branch_status = $this->input->post('branch_status');
      if(!isset($branch_status)){ $branch_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_branch_image']);
      $update_data['branch_status'] = $branch_status;
      $update_data['branch_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('branch_id', $branch_id, 'smm_branch', $update_data);

      // if($_FILES['branch_image']['name']){
      //   $time = time();
      //   $image_name = 'branch_'.$branch_id.'_'.$time;
      //   $config['upload_path'] = 'assets/images/master/';
      //   $config['allowed_types'] = 'jpg|jpeg|png|gif';
      //   $config['file_name'] = $image_name;
      //   $filename = $_FILES['branch_image']['name'];
      //   $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //   $this->upload->initialize($config); // if upload library autoloaded
      //   if ($this->upload->do_upload('branch_image') && $branch_id && $image_name && $ext && $filename){
      //     $branch_image_up['branch_image'] =  $image_name.'.'.$ext;
      //     $this->Master_Model->update_info('branch_id', $branch_id, 'smm_branch', $branch_image_up);
      //     if($_POST['old_branch_img']){ unlink("assets/images/master/".$_POST['old_branch_img']); }
      //     $this->session->set_flashdata('upload_success','File Uploaded Successfully');
      //   }
      //   else{
      //     $error = $this->upload->display_errors();
      //     $this->session->set_flashdata('upload_error',$error);
      //   }
      // }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/branch');
    }

    $branch_info = $this->Master_Model->get_info_arr('branch_id',$branch_id,'smm_branch');
    if(!$branch_info){ header('location:'.base_url().'Company/branch'); }
    $data['update'] = 'update';
    $data['update_branch'] = 'update';
    $data['branch_info'] = $branch_info[0];
    $data['act_link'] = base_url().'Company/edit_branch/'.$branch_id;
    $country_id = $branch_info[0]['country_id'];
    $state_id = $branch_info[0]['state_id'];

    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_id','ASC','user');

    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_id','ASC','smm_branch');
    $data['page'] = 'Edit Branch';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/branch', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Branch...
  public function delete_branch($branch_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // $branch_info = $this->Master_Model->get_info_arr_fields('branch_image, branch_id', 'branch_id', $branch_id, 'smm_branch');
    // if($branch_info){
    //   $branch_image = $branch_info[0]['branch_image'];
    //   if($branch_image){ unlink("assets/images/master/".$branch_image); }
    // }
    $this->Master_Model->delete_info('branch_id', $branch_id, 'smm_branch');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/branch');
  }

/******************************* Designation ****************************/

  // Add Designation...
  public function designation(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('designation_name', 'Designation Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $designation_status = $this->input->post('designation_status');
      if(!isset($designation_status)){ $designation_status = '1'; }
      $save_data = $_POST;
      $save_data['designation_status'] = $designation_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['designation_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_designation', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/designation');
    }
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_id','ASC','smm_department');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_id','ASC','smm_designation');
    $data['page'] = 'Designation';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/designation', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Designation...
  public function edit_designation($designation_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('designation_name', 'Designation Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $designation_status = $this->input->post('designation_status');
      if(!isset($designation_status)){ $designation_status = '1'; }
      $update_data = $_POST;
      $update_data['designation_status'] = $designation_status;
      $update_data['designation_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('designation_id', $designation_id, 'smm_designation', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/designation');
    }

    $designation_info = $this->Master_Model->get_info_arr('designation_id',$designation_id,'smm_designation');
    if(!$designation_info){ header('location:'.base_url().'Company/designation'); }
    $data['update'] = 'update';
    $data['update_designation'] = 'update';
    $data['designation_info'] = $designation_info[0];
    $data['act_link'] = base_url().'Company/edit_designation/'.$designation_id;

    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_id','ASC','smm_department');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_id','ASC','smm_designation');
    $data['page'] = 'Edit Designation';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/designation', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Designation...
  public function delete_designation($designation_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('designation_id', $designation_id, 'smm_designation');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/designation');
  }

/*********************************** Announcement *********************************/

  // Add Announcement....
  public function announcement(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('announcement_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $announcement_status = $this->input->post('announcement_status');
      if(!isset($announcement_status)){ $announcement_status = '1'; }
      $save_data = $_POST;
      $save_data['announcement_status'] = $announcement_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['announcement_addedby'] = $smm_user_id;
      $announcement_id = $this->Master_Model->save_data('smm_announcement', $save_data);

      if($_FILES['announcement_image']['name']){
        $time = time();
        $image_name = 'announcement_'.$announcement_id.'_'.$time;
        $config['upload_path'] = 'assets/images/announcement/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['announcement_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('announcement_image') && $announcement_id && $image_name && $ext && $filename){
          $announcement_image_up['announcement_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('announcement_id', $announcement_id, 'smm_announcement', $announcement_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/announcement');
    }
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['announcement_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'announcement_addedby_type','1','','','','','announcement_id','DESC','smm_announcement');
    $data['page'] = 'Announcement';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/announcement', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Announcement...
  public function edit_announcement($announcement_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('announcement_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $announcement_status = $this->input->post('announcement_status');
      if(!isset($announcement_status)){ $announcement_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_announcement_img']);
      $update_data['announcement_status'] = $announcement_status;
      $update_data['announcement_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('announcement_id', $announcement_id, 'smm_announcement', $update_data);

      if($_FILES['announcement_image']['name']){
        $time = time();
        $image_name = 'announcement_'.$announcement_id.'_'.$time;
        $config['upload_path'] = 'assets/images/announcement/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['announcement_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('announcement_image') && $announcement_id && $image_name && $ext && $filename){
          $announcement_image_up['announcement_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('announcement_id', $announcement_id, 'smm_announcement', $announcement_image_up);
          if($_POST['old_announcement_img']){ unlink("assets/images/announcement/".$_POST['old_announcement_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/announcement');
    }

    $announcement_info = $this->Master_Model->get_info_arr('announcement_id',$announcement_id,'smm_announcement');
    if(!$announcement_info){ header('location:'.base_url().'Company/announcement'); }
    $data['update'] = 'update';
    $data['update_announcement'] = 'update';
    $data['announcement_info'] = $announcement_info[0];
    $data['act_link'] = base_url().'Company/edit_announcement/'.$announcement_id;
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['announcement_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'announcement_addedby_type','2','','','','','announcement_id','DESC','smm_announcement');
    $data['page'] = 'Edit Announcement';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/announcement', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Announcement...
  public function delete_announcement($announcement_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $announcement_info = $this->Master_Model->get_info_arr_fields('announcement_image, announcement_id', 'announcement_id', $announcement_id, 'smm_announcement');
    if($announcement_info){
      $announcement_image = $announcement_info[0]['announcement_image'];
      if($announcement_image){ unlink("assets/images/announcement/".$announcement_image); }
    }
    $this->Master_Model->delete_info('announcement_id', $announcement_id, 'smm_announcement');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/announcement');
  }

/*********************************** Policy *********************************/

  // Add Policy....
  public function policy(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('policy_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $policy_status = $this->input->post('policy_status');
      if(!isset($policy_status)){ $policy_status = '1'; }
      $save_data = $_POST;
      $save_data['policy_status'] = $policy_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['policy_addedby'] = $smm_user_id;
      $policy_id = $this->Master_Model->save_data('smm_policy', $save_data);

      if($_FILES['policy_image']['name']){
        $time = time();
        $image_name = 'policy_'.$policy_id.'_'.$time;
        $config['upload_path'] = 'assets/images/policy/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['policy_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('policy_image') && $policy_id && $image_name && $ext && $filename){
          $policy_image_up['policy_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('policy_id', $policy_id, 'smm_policy', $policy_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/policy');
    }
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['policy_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','policy_id','DESC','smm_policy');
    $data['page'] = 'Policy';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/policy', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Policy...
  public function edit_policy($policy_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('policy_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $policy_status = $this->input->post('policy_status');
      if(!isset($policy_status)){ $policy_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_policy_img']);
      $update_data['policy_status'] = $policy_status;
      $update_data['policy_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('policy_id', $policy_id, 'smm_policy', $update_data);

      if($_FILES['policy_image']['name']){
        $time = time();
        $image_name = 'policy_'.$policy_id.'_'.$time;
        $config['upload_path'] = 'assets/images/policy/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['policy_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('policy_image') && $policy_id && $image_name && $ext && $filename){
          $policy_image_up['policy_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('policy_id', $policy_id, 'smm_policy', $policy_image_up);
          if($_POST['old_policy_img']){ unlink("assets/images/policy/".$_POST['old_policy_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/policy');
    }

    $policy_info = $this->Master_Model->get_info_arr('policy_id',$policy_id,'smm_policy');
    if(!$policy_info){ header('location:'.base_url().'Company/policy'); }
    $data['update'] = 'update';
    $data['update_policy'] = 'update';
    $data['policy_info'] = $policy_info[0];
    $data['act_link'] = base_url().'Company/edit_policy/'.$policy_id;
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['policy_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','policy_id','DESC','smm_policy');
    $data['page'] = 'Edit Policy';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/policy', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Policy...
  public function delete_policy($policy_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $policy_info = $this->Master_Model->get_info_arr_fields('policy_image, policy_id', 'policy_id', $policy_id, 'smm_policy');
    if($policy_info){
      $policy_image = $policy_info[0]['policy_image'];
      if($policy_image){ unlink("assets/images/policy/".$policy_image); }
    }
    $this->Master_Model->delete_info('policy_id', $policy_id, 'smm_policy');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/policy');
  }

/********************************** Office Shift Information *********************************/

  // Add Office Shift...
  public function office_shift(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('office_shift_name', 'Office Shift Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $office_shift_status = $this->input->post('office_shift_status');
      if(!isset($office_shift_status)){ $office_shift_status = '1'; }
      $save_data = $_POST;
      $save_data['office_shift_status'] = $office_shift_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['office_shift_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_office_shift', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/office_shift');
    }

    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','office_shift_id','ASC','smm_office_shift');
    $data['page'] = 'Office Shift';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/office_shift', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Office Shift...
  public function edit_office_shift($office_shift_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('office_shift_name', 'Office Shift Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $office_shift_status = $this->input->post('office_shift_status');
      if(!isset($office_shift_status)){ $office_shift_status = '1'; }
      $update_data = $_POST;
      $update_data['office_shift_status'] = $office_shift_status;
      $update_data['office_shift_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('office_shift_id', $office_shift_id, 'smm_office_shift', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/office_shift');
    }

    $office_shift_info = $this->Master_Model->get_info_arr('office_shift_id',$office_shift_id,'smm_office_shift');
    if(!$office_shift_info){ header('location:'.base_url().'Company/office_shift'); }
    $data['update'] = 'update';
    $data['update_office_shift'] = 'update';
    $data['office_shift_info'] = $office_shift_info[0];
    $data['act_link'] = base_url().'Company/edit_office_shift/'.$office_shift_id;

    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','office_shift_id','ASC','smm_office_shift');
    $data['page'] = 'Edit Office Shift';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/office_shift', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Office Shift...
  public function delete_office_shift($office_shift_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('office_shift_id', $office_shift_id, 'smm_office_shift');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/office_shift');
  }

/*********************************** Become Reseller *********************************/

  // Add Become Reseller....
  public function become_reseller(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('become_reseller_possition', 'Become Reseller Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $become_reseller_status = $this->input->post('become_reseller_status');
      // if(!isset($become_reseller_status)){ $become_reseller_status = '1'; }
      $save_data = $_POST;
      // $save_data['become_reseller_status'] = $become_reseller_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['become_reseller_addedby'] = $smm_user_id;
      $become_reseller_id = $this->Master_Model->save_data('smm_become_reseller', $save_data);

      if($_FILES['become_reseller_image']['name']){
        $time = time();
        $image_name = 'become_reseller_'.$become_reseller_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['become_reseller_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('become_reseller_image') && $become_reseller_id && $image_name && $ext && $filename){
          $become_reseller_image_up['become_reseller_image'] =  base_url().'assets/images/master/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('become_reseller_id', $become_reseller_id, 'smm_become_reseller', $become_reseller_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/become_reseller');
    }

    $data['become_reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','become_reseller_id','DESC','smm_become_reseller');
    $data['page'] = 'Become Reseller';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/become_reseller', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Become Reseller...
  public function edit_become_reseller($become_reseller_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('become_reseller_descr', 'Become Reseller Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $become_reseller_status = $this->input->post('become_reseller_status');
      // if(!isset($become_reseller_status)){ $become_reseller_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_become_reseller_img']);
      // $update_data['become_reseller_status'] = $become_reseller_status;
      $update_data['become_reseller_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('become_reseller_id', $become_reseller_id, 'smm_become_reseller', $update_data);

      if($_FILES['become_reseller_image']['name']){
        $time = time();
        $image_name = 'become_reseller_'.$become_reseller_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['become_reseller_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('become_reseller_image') && $become_reseller_id && $image_name && $ext && $filename){
          $become_reseller_image_up['become_reseller_image'] =  base_url().'assets/images/master/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('become_reseller_id', $become_reseller_id, 'smm_become_reseller', $become_reseller_image_up);
          if($_POST['old_become_reseller_img']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_become_reseller_img']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/become_reseller');
    }

    $become_reseller_info = $this->Master_Model->get_info_arr('become_reseller_id',$become_reseller_id,'smm_become_reseller');
    if(!$become_reseller_info){ header('location:'.base_url().'Company/become_reseller'); }
    $data['update'] = 'update';
    $data['update_become_reseller'] = 'update';
    $data['become_reseller_info'] = $become_reseller_info[0];
    $data['act_link'] = base_url().'Company/edit_become_reseller/'.$become_reseller_id;

    $data['become_reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','become_reseller_id','DESC','smm_become_reseller');
    $data['page'] = 'Edit Become Reseller';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/become_reseller', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Become Reseller...
  public function delete_become_reseller($become_reseller_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $become_reseller_info = $this->Master_Model->get_info_arr_fields('become_reseller_image, become_reseller_id', 'become_reseller_id', $become_reseller_id, 'smm_become_reseller');
    if($become_reseller_info){
      $become_reseller_image = $become_reseller_info[0]['become_reseller_image'];
      if($become_reseller_image){
        $unlink_image = str_replace(base_url(), "",$become_reseller_image);
        unlink($unlink_image);
      }
    }
    $this->Master_Model->delete_info('become_reseller_id', $become_reseller_id, 'smm_become_reseller');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/become_reseller');
  }

/********************************** Mail Setting Information *********************************/

  // // Add Mail Setting...
  // public function mail_setting(){
  //   $smm_user_id = $this->session->userdata('smm_user_id');
  //   $smm_company_id = $this->session->userdata('smm_company_id');
  //   $smm_role_id = $this->session->userdata('smm_role_id');
  //   if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
  //
  //   $this->form_validation->set_rules('mail_setting_type', 'Mail Setting Name', 'trim|required');
  //   if ($this->form_validation->run() != FALSE) {
  //     $mail_setting_status = $this->input->post('mail_setting_status');
  //     if(!isset($mail_setting_status)){ $mail_setting_status = '1'; }
  //     $save_data = $_POST;
  //     $save_data['mail_setting_status'] = $mail_setting_status;
  //     $save_data['company_id'] = $smm_company_id;
  //     $save_data['mail_setting_addedby'] = $smm_user_id;
  //     $user_id = $this->Master_Model->save_data('smm_mail_setting', $save_data);
  //
  //     $this->session->set_flashdata('save_success','success');
  //     header('location:'.base_url().'Company/mail_setting');
  //   }
  //
  //   $data['mail_setting_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','mail_setting_id','ASC','smm_mail_setting');
  //   $data['page'] = 'Mail Setting';
  //   $this->load->view('Admin/Include/head', $data);
  //   $this->load->view('Admin/Include/navbar', $data);
  //   $this->load->view('Admin/Company/mail_setting', $data);
  //   $this->load->view('Admin/Include/footer', $data);
  // }

  // Edit/Update Mail Setting...
  public function edit_mail_setting($mail_setting_id = null){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('mail_setting_type', 'Mail Setting Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      // $mail_setting_status = $this->input->post('mail_setting_status');
      // if(!isset($mail_setting_status)){ $mail_setting_status = '1'; }
      $update_data = $_POST;
      // $update_data['mail_setting_status'] = $mail_setting_status;
      $update_data['mail_setting_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('mail_setting_id', $mail_setting_id, 'smm_mail_setting', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/edit_mail_setting/'.$mail_setting_id);
    }

    $mail_setting_info = $this->Master_Model->get_info_arr('mail_setting_id',$mail_setting_id,'smm_mail_setting');
    if(!$mail_setting_info){ header('location:'.base_url().'Company/mail_setting'); }
    $data['update'] = 'update';
    $data['update_mail_setting'] = 'update';
    $data['mail_setting_info'] = $mail_setting_info[0];
    $data['act_link'] = base_url().'Company/edit_mail_setting/'.$mail_setting_id;

    $data['mail_setting_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','mail_setting_id','ASC','smm_mail_setting');
    $data['page'] = 'Edit Mail Setting';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/mail_setting', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // //Delete Mail Setting...
  // public function delete_mail_setting($mail_setting_id){
  //   $smm_user_id = $this->session->userdata('smm_user_id');
  //   $smm_company_id = $this->session->userdata('smm_company_id');
  //   $smm_role_id = $this->session->userdata('smm_role_id');
  //   if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
  //   $this->Master_Model->delete_info('mail_setting_id', $mail_setting_id, 'smm_mail_setting');
  //   $this->session->set_flashdata('delete_success','success');
  //   header('location:'.base_url().'Company/mail_setting');
  // }







/****************************************************************************************/
/*                                 Coupon Menu Forms                                   */
/***************************************************************************************/


/******************************* Coupon ****************************/

  // Add Coupon...
  public function coupon(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('coupon_code', 'Coupon Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $coupon_status = $this->input->post('coupon_status');
      if(!isset($coupon_status)){ $coupon_status = '1'; }
      $save_data = $_POST;
      $save_data['coupon_status'] = $coupon_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['coupon_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_coupon', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/coupon');
    }
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_id','ASC','user');
    $data['coupon_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','coupon_id','ASC','smm_coupon');
    $data['page'] = 'Coupon';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/coupon', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Coupon...
  public function edit_coupon($coupon_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('coupon_code', 'Coupon Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $coupon_status = $this->input->post('coupon_status');
      if(!isset($coupon_status)){ $coupon_status = '1'; }
      $update_data = $_POST;
      $update_data['coupon_status'] = $coupon_status;
      $update_data['coupon_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('coupon_id', $coupon_id, 'smm_coupon', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/coupon');
    }

    $coupon_info = $this->Master_Model->get_info_arr('coupon_id',$coupon_id,'smm_coupon');
    if(!$coupon_info){ header('location:'.base_url().'Company/coupon'); }
    $data['update'] = 'update';
    $data['update_coupon'] = 'update';
    $data['coupon_info'] = $coupon_info[0];
    $data['act_link'] = base_url().'Company/edit_coupon/'.$coupon_id;

    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_id','ASC','user');
    $data['coupon_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','coupon_id','ASC','smm_coupon');
    $data['page'] = 'Edit Coupon';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/coupon', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Coupon...
  public function delete_coupon($coupon_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('coupon_id', $coupon_id, 'smm_coupon');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/coupon');
  }

/***********************************************************************************************/
/*                                        Setting Menu Forms                                   */
/***********************************************************************************************/

/******************************* Payment Gateway ****************************/

  // Add Payment Gateway...
  public function payment_gateway(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('payment_gateway_name', 'Payment Gateway Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $payment_gateway_status = $this->input->post('payment_gateway_status');
      if(!isset($payment_gateway_status)){ $payment_gateway_status = '1'; }
      $save_data = $_POST;
      $save_data['payment_gateway_status'] = $payment_gateway_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['payment_gateway_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_payment_gateway', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Company/payment_gateway');
    }
    $data['payment_gateway_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','payment_gateway_id','ASC','smm_payment_gateway');
    $data['page'] = 'Payment Gateway';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/payment_gateway', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Payment Gateway...
  public function edit_payment_gateway($payment_gateway_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('payment_gateway_name', 'Payment Gateway Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $payment_gateway_status = $this->input->post('payment_gateway_status');
      if(!isset($payment_gateway_status)){ $payment_gateway_status = '1'; }
      $update_data = $_POST;
      $update_data['payment_gateway_status'] = $payment_gateway_status;
      $update_data['payment_gateway_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('payment_gateway_id', $payment_gateway_id, 'smm_payment_gateway', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Company/payment_gateway');
    }

    $payment_gateway_info = $this->Master_Model->get_info_arr('payment_gateway_id',$payment_gateway_id,'smm_payment_gateway');
    if(!$payment_gateway_info){ header('location:'.base_url().'Company/payment_gateway'); }
    $data['update'] = 'update';
    $data['update_payment_gateway'] = 'update';
    $data['payment_gateway_info'] = $payment_gateway_info[0];
    $data['act_link'] = base_url().'Company/edit_payment_gateway/'.$payment_gateway_id;

    $data['payment_gateway_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','payment_gateway_id','ASC','smm_payment_gateway');
    $data['page'] = 'Edit Payment Gateway';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Company/payment_gateway', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Payment Gateway...
  public function delete_payment_gateway($payment_gateway_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('payment_gateway_id', $payment_gateway_id, 'smm_payment_gateway');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/payment_gateway');
  }


}
?>
