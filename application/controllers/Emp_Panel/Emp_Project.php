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


  // Project Overview...
  public function project_det_overview(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $project_id = $this->session->userdata('project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];
    $data['page'] = 'Project Overview';

    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/project_det_overview', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Project Progress...
  public function project_det_progress(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $project_id = $this->session->userdata('project_id');
    $this->form_validation->set_rules('project_status', 'Project Status', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $this->Master_Model->update_info('project_id', $project_id, 'smm_project', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/project_det_progress');
    }

    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];
    $data['page'] = 'Project Progress';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/project_det_progress', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Project Time Log...
  public function project_det_time_log(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $project_id = $this->session->userdata('project_id');
    $this->form_validation->set_rules('employee_id', 'Time Log Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      $save_data['project_id'] = $project_id;
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['time_log_addedby'] = $smm_emp_id;
      $save_data['time_log_addedby_type'] = '2';

      $start_date = $_POST['time_log_start_date'];
      $start_time = $_POST['time_log_start_time'];
      $end_date = $_POST['time_log_end_date'];
      $end_time = $_POST['time_log_end_time'];

      $start = $start_date.' '.$start_time;
      $end = $end_date.' '.$end_time;
      $timestamp1 = strtotime($start);
      $timestamp2 = strtotime($end);
      $hour = abs($timestamp2 - $timestamp1)/(60*60);
      $hour = round($hour);
      if($hour <= 0){
        $this->session->set_flashdata('invalid_time','error');
      } else{
        $save_data['time_log_hrs'] = $hour;
        $time_log_id = $this->Master_Model->save_data('smm_time_log', $save_data);
        $this->session->set_flashdata('save_success','success');
      }
      header('location:'.base_url().'Emp_Panel/Emp_Project/project_det_time_log');
    }

    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');

    $employee_list = array();
    $employee_info = $this->Master_Model->get_info_arr_fields('employee_id,employee_name,employee_lname', 'employee_id', $smm_emp_id, 'smm_employee');
    if($employee_info){
      $employee_list[0]['employee_id'] = $smm_emp_id;
      $employee_list[0]['employee_name'] = $employee_info[0]['employee_name'];
      $employee_list[0]['employee_lname'] = $employee_info[0]['employee_lname'];
    }

    $data['page'] = 'Project Time Log';
    $data['employee_list'] = $employee_list;
    $data['time_log_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'project_id',$project_id,'employee_id',$smm_emp_id,'','','time_log_id','ASC','smm_time_log');
    $data['project_info'] = $project_info[0];


    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/project_det_time_log', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Project Task...
  public function project_det_task(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $project_id = $this->session->userdata('project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];

    $project_member = $project_info[0]['project_member'];
    $project_member = explode(',',$project_member);
    $i=0;
    $employee_list = array();
    foreach ($project_member as $project_member_id) {
      $employee_info = $this->Master_Model->get_info_arr_fields('*', 'employee_id', $project_member_id, 'smm_employee');
      if($employee_info){
        $employee_list[$i]['employee_id'] = $project_member_id;
        $employee_list[$i]['employee_name'] = $employee_info[0]['employee_name'];
        $employee_list[$i]['employee_lname'] = $employee_info[0]['employee_lname'];
        $i++;
      }
    }

    $data['employee_list'] = $employee_list;
    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','task_status_id','ASC','smm_task_status');

    $data['task_list'] = $this->Employee_Model->get_list_by_id3_find_in_set($smm_emp_company_id,'task_assign_to',$smm_emp_id,'','','','','','','task_id','DESC','smm_task');
    $data['page'] = 'Project Task';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/project_det_task', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Project File...
  public function project_det_file(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $project_id = $this->session->userdata('project_id');

    $this->form_validation->set_rules('project_file_name', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $save_data = $_POST;
      $save_data['project_id'] = $project_id;
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['project_file_addedby'] = $smm_emp_id;
      $save_data['project_file_addedby_type'] = '2';

      $project_file_id = $this->Master_Model->save_data('smm_project_file', $save_data);

      if($_FILES['project_file_image']['name']){
        $time = time();
        $image_name = 'project_file_'.$project_file_id.'_'.$project_id.'_'.$time;
        $config['upload_path'] = 'assets/images/project/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
        $config['file_name'] = $image_name;
        $filename = $_FILES['project_file_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('project_file_image') && $project_file_id && $image_name && $ext && $filename){
          $project_file_image_up['project_file_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('project_file_id', $project_file_id, 'smm_project_file', $project_file_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
          $this->session->set_flashdata('save_success','success');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
          $this->Master_Model->delete_info('project_file_id', $project_fil_id, 'smm_project_file');
        }
      }
      header('location:'.base_url().'Emp_Panel/Emp_Project/project_det_file');
    }


    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['page'] = 'Project File';
    $data['project_file_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'project_id',$project_id,'','','','','project_file_id','DESC','smm_project_file');
    $data['project_info'] = $project_info[0];

    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/project_det_file', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }


/************************************ Task ***************************************/

  // Project Task...
  public function task(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $data['task_list'] = $this->Employee_Model->get_list_by_id3_find_in_set($smm_emp_company_id,'task_assign_to',$smm_emp_id,'','','','','','','task_id','DESC','smm_task');
    $data['page'] = 'Task';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/task', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Set Task Session...
  public function set_task_session($task_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $task_info = $this->Master_Model->get_info_arr_fields('task_id, project_id', 'task_id', $task_id, 'smm_task');
    if(!$task_info){
      header('location:'.base_url().'Emp_Panel/Emp_Project/task');
    } else{
      $this->session->set_userdata('task_id', $task_id);
      $this->session->set_userdata('task_project_id', $task_info[0]['project_id']);
      header('location:'.base_url().'Emp_Panel/Emp_Project/task_det_overview');
    }
  }

  // Project Overview...
  public function task_det_overview(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $task_id = $this->session->userdata('task_id');
    $task_info = $this->Master_Model->get_info_arr_fields('*', 'task_id', $task_id, 'smm_task');
    $data['task_info'] = $task_info[0];

    $project_id = $this->session->userdata('task_project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];

    $data['page'] = 'Task Overview';
    // echo $project_id;
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/task_det_overview', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

// Project Progress...
  public function task_det_progress(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $task_id = $this->session->userdata('task_id');

    $this->form_validation->set_rules('task_status', 'Project Status', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $this->Master_Model->update_info('task_id', $task_id, 'smm_task', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Project/task_det_progress');
    }


    $task_info = $this->Master_Model->get_info_arr_fields('*', 'task_id', $task_id, 'smm_task');
    $data['task_info'] = $task_info[0];

    $project_id = $this->session->userdata('task_project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];

    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','task_status_id','ASC','smm_task_status');

    $data['page'] = 'Task Progress';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/task_det_progress', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

// Project File...
  public function task_det_file(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }

    $task_id = $this->session->userdata('task_id');

    $this->form_validation->set_rules('task_file_name', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $save_data = $_POST;
      $save_data['task_id'] = $task_id;
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['task_file_addedby'] = $smm_emp_id;
      $save_data['task_file_addedby_type'] = '2';

      $task_file_id = $this->Master_Model->save_data('smm_task_file', $save_data);

      if($_FILES['task_file_image']['name']){
        $time = time();
        $image_name = 'task_file_'.$task_file_id.'_'.$task_id.'_'.$time;
        $config['upload_path'] = 'assets/images/task/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
        $config['file_name'] = $image_name;
        $filename = $_FILES['task_file_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('task_file_image') && $task_file_id && $image_name && $ext && $filename){
          $task_file_image_up['task_file_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('task_file_id', $task_file_id, 'smm_task_file', $task_file_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
          $this->session->set_flashdata('save_success','success');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
          $this->Master_Model->delete_info('task_file_id', $task_file_id, 'smm_task_file');
        }
      }

      header('location:'.base_url().'Emp_Panel/Emp_Project/task_det_file');
    }


    $task_info = $this->Master_Model->get_info_arr_fields('*', 'task_id', $task_id, 'smm_task');
    $data['task_info'] = $task_info[0];

    $project_id = $this->session->userdata('task_project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];

    $data['task_file_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'task_id',$task_id,'','','','','task_file_id','DESC','smm_task_file');
    $data['page'] = 'Task File';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/task_det_file', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

// Ticket...
  public function ticket($ticket_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    $smm_emp_role_id = $this->session->userdata('smm_emp_role_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee'); }




    if(isset($ticket_id) && $ticket_id){
      $this->form_validation->set_rules('ticket_no', 'Ticket Number', 'trim|required');
      if ($this->form_validation->run() != FALSE) {
        $update_data = $_POST;
        $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $update_data);

        $this->session->set_flashdata('update_success','success');
        header('location:'.base_url().'Emp_Panel/Emp_Project/ticket');
      }

      $ticket_info = $this->Master_Model->get_info_arr_fields3('*', '', 'ticket_id',$ticket_id, 'ticket_assign_to',$smm_emp_id, '', '', 'smm_ticket');
      if(!$ticket_info){ header('location:'.base_url().'Emp_Panel/Emp_Project/ticket/'); }
      $data['update'] = 'update';
      $data['update_ticket'] = 'update';
      $data['ticket_info'] = $ticket_info[0];
      $data['act_link'] = base_url().'Emp_Panel/Emp_Project/ticket/'.$ticket_id;
      $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','department_status','1','department_name','ASC','smm_department');
      $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','is_admin','0','user_status','1','user_name','ASC','user');
      $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','project_name','ASC','smm_project');
      $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','employee_name','ASC','smm_employee');
    }

    $data['ticket_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'ticket_assign_to',$smm_emp_id,'','','','','ticket_id','DESC','smm_ticket');
    $data['page'] = 'Ticket';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Project/ticket', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }








}
?>
