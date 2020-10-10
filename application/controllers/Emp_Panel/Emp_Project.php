<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_Project extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){
    // $this->load->view('Admin/User/forgot_password');
  }

  // Employee List...
  public function project(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }
    $data['project_list'] = $this->Employee_Model->get_list_by_id3_find_in_set($smm_emp_company_id,'project_member',$smm_emp_id,'','','','','','','project_id','DESC','smm_project');
    $data['page'] = 'Project';
    // print_r($smm_emp_id);
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/project', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

/******************************** Project Details *****************************/

  // Set Project Session...
  public function set_project_session($project_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }
    $project_info = $this->Master_Model->get_info_arr_fields('project_id', 'project_id', $project_id, 'smm_project');
    if(!$project_info){
      header('location:'.base_url().'Emp_Panel/Emp_Project/project');
    } else{
      $this->session->set_userdata('project_id', $project_id);
      header('location:'.base_url().'Emp_Panel/Emp_Project/project_det_overview');
    }
  }


















}
?>
