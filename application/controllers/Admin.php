<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function logout(){
    // $this->session->sess_destroy();
    $this->session->unset_userdata('smm_admin_id');
    $this->session->unset_userdata('smm_company_id');
    $this->session->unset_userdata('smm_role_id');
    $this->session->unset_userdata('smm_role_permission');
    header('location:'.base_url().'Admin');
  }

/**************************      Login      ********************************/

  public function index(){
    $smm_admin_id = $this->session->userdata('smm_admin_id');

    $this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
    	$this->load->view('Main_Admin/login');
    } else{
      $mobile = $this->input->post('mobile');
      $password = $this->input->post('password');

      $login = $this->Admin_Model->check_login($mobile, $password);
      if($login == null){
        $this->session->set_flashdata('msg','login_error');
        header('location:'.base_url().'Admin');
      } else{
        $this->session->set_userdata('smm_admin_id', $login[0]['admin_id']);
        // $this->session->set_userdata('smm_company_id', $login[0]['company_id']);
        // $this->session->set_userdata('smm_role_id', $login[0]['role_id']);
        // $this->session->set_userdata('smm_role_permission', $role_permission_arr);
        // $this->session->set_userdata('branch_id', $login[0]['branch_id']);
        header('location:'.base_url().'Admin/dashboard');
      }
    }
  }

/**************************      Dashboard      ********************************/
  public function dashboard(){
    $smm_admin_id = $this->session->userdata('smm_admin_id');
    if($smm_admin_id == ''){ header('location:'.base_url().'Admin'); }

    // $data['regular_bed_cnt'] = $this->Master_Model->get_sum('','avlb_regular_bed','hospital_status','1','','','','','hospital');
    // $data['oxygen_bed_cnt'] = $this->Master_Model->get_sum('','avlb_oxygen_bed','hospital_status','1','','','','','hospital');
    // $data['icu_bed_cnt'] = $this->Master_Model->get_sum('','avlb_icu_bed','hospital_status','1','','','','','hospital');
    // $data['special_bed_cnt'] = $this->Master_Model->get_sum('','avlb_special_bed','hospital_status','1','','','','','hospital');
    //
    // $data['hospital_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','1','','','','','hospital');
    // $data['gov_qua_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','2','','','','','hospital');
    // $data['private_qua_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','3','','','','','hospital');
    // $data['hotel_qua_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','4','','','','','hospital');

    $data['page'] = 'Admin Dashboard';
    $this->load->view('Main_Admin/head', $data);
    $this->load->view('Main_Admin/navbar', $data);
    $this->load->view('Main_Admin/dashboard', $data);
    $this->load->view('Main_Admin/footer', $data);
  }


/******************************* Company ****************************/

  // Add Company...
  public function company(){
    $smm_admin_id = $this->session->userdata('smm_admin_id');
    if($smm_admin_id == ''){ header('location:'.base_url().'Admin'); }

    $this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
    $this->form_validation->set_rules('company_address', 'company_address', 'trim|required');

    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      unset($save_data['user_mobile']);
      unset($save_data['user_password']);
      $company_id = $this->Master_Model->save_data('company', $save_data);

      $user_save_info = array(
        'user_mobile' => $_POST['user_mobile'],
        'user_password' => $_POST['user_password'],
        'company_id' => $company_id,
        'user_address' => $_POST['company_address'],
        'country_id' => $_POST['country_id'],
        'state_id' => $_POST['state_id'],
        'city_id' => $_POST['city_id'],
        'role_id' => '1',
        'user_name' => 'Admin',
        'user_join_date' => date('d-m-Y'),
        'user_username' => 'Admin'.$company_id,
        'is_admin' => '1',
        'user_addedby' => '0',
        'user_password' => $_POST['user_password'],
      );
      $user_id = $this->Master_Model->save_data('user', $user_save_info);

      $save_web_setting = array(
        'company_id' => $company_id,
        'web_setting_name' => $_POST['company_name'],
        'web_setting_address' => $_POST['company_address'],
        'country_id' => $_POST['country_id'],
        'state_id' => $_POST['state_id'],
        'city_id' => $_POST['city_id'],
        'web_setting_addedby_type' => 1,
      );
      $web_setting_id = $this->Master_Model->save_data('smm_web_setting', $save_web_setting);

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
          // if($_POST['old_company_logo']){ unlink("assets/images/master/".$_POST['old_company_logo']); }
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
          // if($_POST['old_company_fevicon']){ unlink("assets/images/master/".$_POST['old_company_fevicon']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Admin/company');
    }

    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['currency_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','currency_name','ASC','smm_currency');
    $data['company_entity_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','company_entity_name','ASC','smm_company_entity');

    $data['company_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','company_id','ASC','company');
    $data['page'] = 'Company';
    $this->load->view('Main_Admin/head', $data);
    $this->load->view('Main_Admin/navbar', $data);
    $this->load->view('Main_Admin/company', $data);
    $this->load->view('Main_Admin/footer', $data);
  }

  // Edit/Update Company...
  public function edit_company($company_id){
    $smm_admin_id = $this->session->userdata('smm_admin_id');
    if($smm_admin_id == ''){ header('location:'.base_url().'Admin'); }

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
      header('location:'.base_url().'Admin/company');
    }
    $company_info = $this->Master_Model->get_info_arr('company_id',$company_id,'company');
    if(!$company_info){ header('location:'.base_url().'Admin/company'); }
    $data['update'] = 'update';
    $data['update_company'] = 'update';
    $data['company_info'] = $company_info[0];
    $data['act_link'] = base_url().'Admin/edit_company/'.$company_id;
    $country_id = $company_info[0]['country_id'];
    $state_id = $company_info[0]['state_id'];

    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');

    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    $data['district_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','district_name','ASC','district');

    $data['currency_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','currency_name','ASC','smm_currency');
    $data['company_entity_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','company_entity_name','ASC','smm_company_entity');

    $data['company_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','company_id','ASC','company');
    $data['page'] = 'Edit Company';
    $this->load->view('Main_Admin/head', $data);
    $this->load->view('Main_Admin/navbar', $data);
    $this->load->view('Main_Admin/company', $data);
    $this->load->view('Main_Admin/footer', $data);
  }

  //Delete Company...
  public function delete_company($company_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('company_id', $company_id, 'smm_company');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Company/company');
  }


}
?>
