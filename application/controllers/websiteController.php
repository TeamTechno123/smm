<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class websiteController extends CI_Controller{
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

 public function check_url(){
   $url = $_POST['url'];
   $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_id, company_id, template_id', '', 'reseller_website', $url, '', '', '', '', 'smm_reseller');
   if($reseller_info){
     $this->session->set_userdata('web_reseller_id',$reseller_info[0]['reseller_id']);
     $this->session->set_userdata('web_company_id',$reseller_info[0]['company_id']);
     $this->session->set_userdata('web_template_id',$reseller_info[0]['template_id']);
     echo 'success';
   } else{
     echo 'error';
   }
 }

 public function home(){
   $web_reseller_id = $this->session->userdata('web_reseller_id');
   $web_company_id = $this->session->userdata('web_company_id');
   $web_template_id = $this->session->userdata('web_template_id');
   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }

   $data['testomonial_list'] = $data['project_list'] = $this->Master_Model->get_list_by_id3($web_company_id,'testimonial_addedby_type','2','testimonial_addedby',$web_reseller_id,'','','testimonial_id','DESC','smm_testimonial');
   $data['package_list'] = $this->Master_Model->get_list_by_id3($web_company_id,'reseller_id',$web_reseller_id,'','','','','reseller_package_id','DESC','smm_reseller_package');
   if($web_template_id == 1){
     $this->load->view('Website/home1', $data);
   } elseif ($web_template_id == 2) {
     $this->load->view('Website/home2', $data);
   } elseif($web_template_id == 3){
     $this->load->view('Website/home3', $data);
   }

 }

 public function login(){
   $web_reseller_id = $this->session->userdata('web_reseller_id');
   $web_company_id = $this->session->userdata('web_company_id');
   $web_template_id = $this->session->userdata('web_template_id');
   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
   if($web_template_id == 1){
     $this->load->view('Website/login1');
   } elseif ($web_template_id == 2) {
     $this->load->view('Website/login2');
   } elseif($web_template_id == 3){
     $this->load->view('Website/login3');
   }
 }

 public function signup(){
   $web_reseller_id = $this->session->userdata('web_reseller_id');
   $web_company_id = $this->session->userdata('web_company_id');
   $web_template_id = $this->session->userdata('web_template_id');
   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
   if($web_template_id == 1){
     $this->load->view('Website/signup1');
   } elseif ($web_template_id == 2) {
     $this->load->view('Website/signup2');
   } elseif($web_template_id == 3){
     $this->load->view('Website/signup3');
   }
 }

 public function login1(){
  $this->load->view('Website/login1');
 }

 public function signup1(){
  $this->load->view('Website/signup1');
 }
 public function home1(){
  $this->load->view('Website/home1');
 }
 public function home2(){
  $this->load->view('Website/home2');
 }

 public function login2(){
  $this->load->view('Website/login2');
 }

 public function signup2(){
  $this->load->view('Website/signup2');
 }

 public function home3(){
  $this->load->view('Website/home3');
 }

 public function login3(){
  $this->load->view('Website/login3');
 }

 public function signup3(){
  $this->load->view('Website/signup3');
 }


}
?>
