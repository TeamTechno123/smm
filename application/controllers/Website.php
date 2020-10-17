<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

 // public function index(){
 //  $this->load->view('Website/index1');
 // }

 public function index(){
  $this->load->view('Website/index');
 }

 public function services(){
  $this->load->view('Website/services');
 }

 public function faq(){
  $this->load->view('Website/faq');
 }

 public function signup(){

   $this->form_validation->set_rules('reseller_name', 'Reseller Name', 'trim|required');
   if ($this->form_validation->run() != FALSE) {
     $save_data = $_POST;
     // $save_data['ticket_status'] = $ticket_status;
     $save_data['company_id'] = '1';
     $save_data['reseller_added_type'] = '1';
     $save_data['reseller_addedby'] = '0';
     $save_data['reseller_is_online_request'] = '1';
     $save_data['reseller_status'] = '1';
     $reseller_id = $this->Master_Model->save_data('smm_reseller', $save_data);

     $save_web_setting = array(
       'company_id' => '1',
       'reseller_id' => $reseller_id,
       'web_setting_name' => $_POST['reseller_name'],
       // 'web_setting_address' => $_POST['reseller_address'],
       'country_id' => $_POST['country_id'],
       'state_id' => $_POST['state_id'],
       'city_id' => $_POST['city_id'],
       'web_setting_addedby_type' => 1,
     );
     $web_setting_id = $this->Master_Model->save_data('smm_web_setting', $save_web_setting);

     $this->session->set_userdata('signup_reseller_id', $reseller_id);
     $this->session->set_flashdata('signup_success','success');
     header('location:'.base_url().'Profile-Add');
   }

   $data['reseller_category_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','reseller_category_name','ASC','smm_reseller_category');
   $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
   $data['page'] = 'Signup';
   $this->load->view('Website/signup', $data);
 }

 // Add Profile...
 public function profile_add(){
   // $web_reseller_id = $this->session->userdata('web_reseller_id');
   // $web_company_id = $this->session->userdata('web_company_id');
   // $web_template_id = $this->session->userdata('web_template_id');
   // if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }

   $signup_reseller_id = $this->session->userdata('signup_reseller_id');
   if(!$signup_reseller_id){ header('location:'.base_url().''); }
   $reseller_id = $signup_reseller_id;
   $this->form_validation->set_rules('reseller_name', 'Reseller Name', 'trim|required');
   if ($this->form_validation->run() != FALSE) {
     $update_data = $_POST;
     $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $update_data);

     if($_FILES['reseller_logo']['name']){
       $time = time();
       $image_name = 'reseller_'.$reseller_id.'_'.$time;
       $config['upload_path'] = 'assets/images/reseller/';
       $config['allowed_types'] = 'jpg|jpeg|png|gif';
       $config['file_name'] = $image_name;
       $filename = $_FILES['reseller_logo']['name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       $this->upload->initialize($config); // if upload library autoloaded
       if ($this->upload->do_upload('reseller_logo') && $reseller_id && $image_name && $ext && $filename){
         $reseller_logo_up['reseller_logo'] =  base_url().'assets/images/reseller/'.$image_name.'.'.$ext;
         $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $reseller_logo_up);
         // if($_POST['old_reseller_logo']){ unlink("assets/images/reseller/".$_POST['old_reseller_logo']); }
         $this->session->set_flashdata('upload_success','File Uploaded Successfully');
       }
       else{
         $error = $this->upload->display_errors();
         $this->session->set_flashdata('upload_error',$error);
       }
     }
     $this->session->set_flashdata('signup_success','success');
     header('location:'.base_url().'Login');
   }

   // $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
   // $data['web_template_id'] = $web_template_id;

   $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$signup_reseller_id,'smm_reseller');
   if(!$reseller_info){ header('location:'.base_url().''); }
   $data['reseller_info'] = $reseller_info[0];
   $country_id = $reseller_info[0]['country_id'];
   $state_id = $reseller_info[0]['state_id'];
   $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
   $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
   $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');

   $data['page'] = 'Profile-Add';
   $this->load->view('Website/profile_add', $data);
 }






 public function login(){

   $smm_reseller_id = $this->session->userdata('smm_reseller_id');
   $smm_res_company_id = $this->session->userdata('smm_res_company_id');

   if($smm_reseller_id == '' || $smm_res_company_id == ''){
     $this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
     $this->form_validation->set_rules('password', 'Password', 'trim|required');
     if ($this->form_validation->run() == FALSE) {
       $this->load->view('Website/login');
     } else{
       $mobile = $this->input->post('mobile');
       $password = $this->input->post('password');

       $login = $this->Reseller_Model->check_login($mobile, $password, $web_reseller_id);
       if($login == null){
         $this->session->set_flashdata('msg','login_error');
         header('location:'.base_url().'Login');
       } else{
         $this->session->set_userdata('smm_reseller_id', $login[0]['reseller_id']);
         $this->session->set_userdata('smm_res_company_id', $login[0]['company_id']);
         $this->session->set_userdata('smm_addedby_type', $login[0]['reseller_added_type']);
         $this->session->set_userdata('smm_addedby', $login[0]['reseller_addedby']);
         // $this->session->set_userdata('branch_id', $login[0]['branch_id']);
         header('location:'.base_url().'Reseller/Res_User/dashboard');
       }
     }
   }
   else{
     header('location:'.base_url().'Reseller/Res_User/dashboard');
   }




 }



}
