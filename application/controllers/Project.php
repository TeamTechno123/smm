<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }
  /**************************      Project Dashboard      ********************************/
    public function project_dashboard(){
      $smm_user_id = $this->session->userdata('smm_user_id');
      $smm_company_id = $this->session->userdata('smm_company_id');
      $smm_role_id = $this->session->userdata('smm_role_id');
      if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

      $data['page'] = 'Project Dashboard';
      $this->load->view('Admin/Include/head', $data);
      $this->load->view('Admin/Include/navbar', $data);
      $this->load->view('Admin/Project/project_dashboard', $data);
      $this->load->view('Admin/Include/footer', $data);
    }

/********************************* Project ***********************************/
  // Add Project...
  public function project($order_id = null){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $project_status = $this->input->post('project_status');
      // if(!isset($project_status)){ $project_status = '1'; }
      $project_member = $_POST['project_member'];
      $project_member = implode(',', $project_member);
      $save_data = $_POST;
      unset($save_data['input']);
      unset($save_data['files']);
      unset($save_data['project_file_image']);
      unset($save_data['project_file_name']);
      $save_data['project_member'] = $project_member;
      $save_data['company_id'] = $smm_company_id;
      $save_data['project_addedby'] = $smm_user_id;
      if($order_id){
        $save_data['order_id'] = $order_id;
      }
      $project_id = $this->Master_Model->save_data('smm_project', $save_data);
      if($order_id){
        $update_data['project_id'] = $project_id;
        $this->Master_Model->update_info('order_id', $order_id, 'smm_order', $update_data);
      }

      if(isset($_FILES['project_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['project_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'project_file_'.$project_id.'_'.$j.'_'.$time;
          $_FILES['project_file_image']['name']= $files['project_file_image']['name'][$i];
          $_FILES['project_file_image']['type']= $files['project_file_image']['type'][$i];
          $_FILES['project_file_image']['tmp_name']= $files['project_file_image']['tmp_name'][$i];
          $_FILES['project_file_image']['error']= $files['project_file_image']['error'][$i];
          $_FILES['project_file_image']['size']= $files['project_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/project/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['project_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $project_file_name = $_POST['project_file_name'][$i];
          if($this->upload->do_upload('project_file_image') && $filename && $ext ){
            $file_data['project_file_image'] = $image_name.'.'.$ext;
            $file_data['project_id'] = $project_id;
            $file_data['company_id'] = $smm_company_id;
            $file_data['project_file_name'] = $project_file_name;
            $this->Master_Model->save_data('smm_project_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          $multi_data['project_id'] = $project_id;
          $multi_data['company_id'] = $smm_company_id;
          $multi_data['project_del_phase_addedby'] = $smm_user_id;
          $this->db->insert('smm_project_del_phase', $multi_data);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/project');
    }
    $data['project_no'] = $this->Master_Model->get_count_no($smm_company_id, 'project_no', 'smm_project');

    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');

    if($order_id){
      $order_info = $this->Master_Model->get_info_arr_fields3('*', $smm_company_id, 'order_id', $order_id, 'project_id', '0', '', '', 'smm_order');
      if(!$order_info){ header('location:'.base_url().'Transaction/order_list'); }
      $package_info = $this->Master_Model->get_info_arr_fields3('*', $smm_company_id, 'package_id', $order_info[0]['package_id'], '', '', '', '', 'smm_package');
      if(!$order_info){ header('location:'.base_url().'Transaction/order_list'); }
      $data['from_order'] = 'true';
      $data['start_date'] = $order_info[0]['order_date'];

      $order_date = strtotime($order_info[0]['order_date']);
      $end_date = strtotime("+".$package_info[0]['package_per_duration']." day", $order_date);
      $end_date = date('d-m-Y', $end_date);
      $data['end_date'] = $end_date;
      $data['budget_amount'] = $order_info[0]['order_net_amount'];
      $data['revisions'] = $package_info[0]['package_revisions'];
      $data['descr'] = '<p>Package: '.$package_info[0]['package_name'].'</p>'.$package_info[0]['package_descr'];

      $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'reseller_id',$order_info[0]['client_id'],'','','','','reseller_name','ASC','smm_reseller');
      $data['order_id'] = $order_id;
    } else{
      $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','reseller_name','ASC','smm_reseller');
    }

    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_id','DESC','smm_project');
    $data['page'] = 'Project';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Project...
  public function edit_project($project_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $project_status = $this->input->post('project_status');
      // if(!isset($project_status)){ $project_status = '1'; }
      $project_member = $_POST['project_member'];
      $project_member = implode(',', $project_member);
      $update_data = $_POST;
      unset($update_data['input']);
      unset($update_data['files']);
      unset($update_data['project_file_image']);
      unset($update_data['project_file_name']);
      $update_data['project_member'] = $project_member;
      // $update_data['project_status'] = $project_status;
      $update_data['project_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('project_id', $project_id, 'smm_project', $update_data);

      if(isset($_FILES['project_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['project_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'project_file_'.$project_id.'_'.$j.'_'.$time;
          $_FILES['project_file_image']['name']= $files['project_file_image']['name'][$i];
          $_FILES['project_file_image']['type']= $files['project_file_image']['type'][$i];
          $_FILES['project_file_image']['tmp_name']= $files['project_file_image']['tmp_name'][$i];
          $_FILES['project_file_image']['error']= $files['project_file_image']['error'][$i];
          $_FILES['project_file_image']['size']= $files['project_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/project/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['project_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $project_file_name = $_POST['project_file_name'][$i];
          if($this->upload->do_upload('project_file_image') && $filename && $ext ){
            $file_data['project_file_image'] = $image_name.'.'.$ext;
            $file_data['project_id'] = $project_id;
            $file_data['company_id'] = $smm_company_id;
            $file_data['project_file_name'] = $project_file_name;
            $this->Master_Model->save_data('smm_project_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          if(isset($multi_data['project_del_phase_id'])){
            $project_del_phase_id = $multi_data['project_del_phase_id'];
            if(!isset($multi_data['project_del_phase_descr'])){
              $this->Master_Model->delete_info('project_del_phase_id', $project_del_phase_id, 'smm_project_del_phase');
            }else{
              $multi_data['project_del_phase_addedby'] = $smm_user_id;
              $this->Master_Model->update_info('project_del_phase_id', $project_del_phase_id, 'smm_project_del_phase', $multi_data);
            }
          }
          else{
            $multi_data['project_id'] = $project_id;
            $multi_data['company_id'] = $smm_company_id;
            $multi_data['project_del_phase_addedby'] = $smm_user_id;
            $this->db->insert('smm_project_del_phase', $multi_data);
          }
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/project');
    }

    $project_info = $this->Master_Model->get_info_arr('project_id',$project_id,'smm_project');
    if(!$project_info){ header('location:'.base_url().'Project/project'); }
    $data['update'] = 'update';
    $data['update_project'] = 'update';
    $data['project_info'] = $project_info[0];
    $data['act_link'] = base_url().'Project/edit_project/'.$project_id;
    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','reseller_name','ASC','smm_reseller');
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['project_file_list'] = $this->Master_Model->get_list_by_id3('','project_id',$project_id,'','','','','project_file_id','DESC','smm_project_file');
    $data['project_del_phase_list'] = $this->Master_Model->get_list_by_id3('','project_id',$project_id,'','','','','project_del_phase_id','ASC','smm_project_del_phase');

    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_id','DESC','smm_project');
    $data['page'] = 'Edit Project';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Project...
  public function delete_project_file(){
    $project_file_id = $this->input->post('project_file_id');
    $project_file_info = $this->Master_Model->get_info_arr_fields('project_file_image, project_file_id', 'project_file_id', $project_file_id, 'smm_project_file');
    if($project_file_info){
      $project_file_image = $project_file_info[0]['project_file_image'];
      if($project_file_image){ unlink("assets/images/project/".$project_file_image); }
    }
    $this->Master_Model->delete_info('project_file_id', $project_file_id, 'smm_project_file');
  }

  //Delete Project...
  public function delete_project($project_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $project_file_list = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','project_file_id','ASC','smm_project_file');
    foreach ($project_file_list as $project_file_list1) {
      $project_file_image = $project_file_list1->project_file_image;
      if($project_file_image){ unlink("assets/images/project/".$project_file_image); }
    }
    $this->Master_Model->delete_info('project_id', $project_id, 'smm_project');
    $this->Master_Model->delete_info('project_id', $project_id, 'smm_project_file');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/project');
  }


  /******************************** Project Details *****************************/

  // Set Project Session...
  public function set_project_session($project_id = null){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $project_info = $this->Master_Model->get_info_arr_fields('project_id', 'project_id', $project_id, 'smm_project');
    if(!$project_info){
      header('location:'.base_url().'Project/project');
    } else{
      $this->session->set_userdata('project_id', $project_id);
      header('location:'.base_url().'Project/project_det_overview');
    }
  }

  // Project Overview...
  public function project_det_overview(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];
    $data['page'] = 'Project Overview';

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_overview', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


  // Project Progress...
  public function project_det_progress(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

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
    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_progress', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


  // Project Time Log...
  public function project_det_time_log(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');
    $this->form_validation->set_rules('employee_id', 'Time Log Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      $save_data['project_id'] = $project_id;
      $save_data['company_id'] = $smm_company_id;
      $save_data['time_log_addedby'] = $smm_user_id;

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
      header('location:'.base_url().'Project/project_det_time_log');
    }

    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');

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

    $data['page'] = 'Project Time Log';
    $data['employee_list'] = $employee_list;
    $data['time_log_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','time_log_id','ASC','smm_time_log');
    $data['project_info'] = $project_info[0];

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_time_log', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Project Revision...
  public function project_det_revision(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');

    $data['page'] = 'Project Revision';
    $data['project_revision_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','project_revision_id','ASC','smm_project_revision');
    $data['project_info'] = $project_info[0];

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_revision', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


  // Project Task...
  public function project_det_task(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');

    $this->form_validation->set_rules('task_title', 'Task Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      unset($save_data['task_assign_to']);
      unset($save_data['task_file_name']);
      unset($save_data['task_file_image']);
      unset($save_data['input']);

      $task_assign_to=implode(',', $_POST['task_assign_to']);
      $save_data['task_assign_to'] = $task_assign_to;
      // $save_data['task_status'] = $task_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['task_addedby'] = $smm_user_id;
      $task_id = $this->Master_Model->save_data('smm_task', $save_data);

      if(isset($_FILES['task_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['task_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'task_file_'.$task_id.'_'.$j.'_'.$time;
          $_FILES['task_file_image']['name']= $files['task_file_image']['name'][$i];
          $_FILES['task_file_image']['type']= $files['task_file_image']['type'][$i];
          $_FILES['task_file_image']['tmp_name']= $files['task_file_image']['tmp_name'][$i];
          $_FILES['task_file_image']['error']= $files['task_file_image']['error'][$i];
          $_FILES['task_file_image']['size']= $files['task_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/task/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['task_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $task_file_name = $_POST['task_file_name'][$i];
          if($this->upload->do_upload('task_file_image') && $filename && $ext ){
            $file_data['task_file_image'] = base_url().'assets/images/task/'.$image_name.'.'.$ext;
            $file_data['task_id'] = $task_id;
            $file_data['company_id'] = $smm_company_id;
            $file_data['task_file_name'] = $task_file_name;
            $this->Master_Model->save_data('smm_task_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }
    }
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
    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_status_id','ASC','smm_task_status');

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $data['page'] = 'Project Task';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_task', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Project File...
  public function project_det_file(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');

    $this->form_validation->set_rules('project_file_name', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $save_data = $_POST;
      $save_data['project_id'] = $project_id;
      $save_data['company_id'] = $smm_company_id;
      $save_data['project_file_addedby'] = $smm_user_id;

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
      header('location:'.base_url().'Project/project_det_file');
    }


    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['page'] = 'Project File';
    $data['project_file_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','project_file_id','DESC','smm_project_file');
    $data['project_info'] = $project_info[0];

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_file', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Project Milestone...
  public function project_det_milestone(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];
    $data['project_del_phase_list'] = $this->Master_Model->get_list_by_id3('','project_id',$project_id,'','','','','project_del_phase_id','ASC','smm_project_del_phase');

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $data['page'] = 'Project Milestone';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_milestone', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Project Invoice...
  public function project_det_invoice(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];
    $order_id = $project_info[0]['order_id'];
    $data['invoice_list'] = $this->Master_Model->get_list_by_id3('','','','order_id',$order_id,'','','invoice_id','ASC','smm_invoice');

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $data['page'] = 'Project Invoice';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_invoice', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Project Discussion...
  public function project_det_discussion(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');

    $this->form_validation->set_rules('project_discussion_title', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      $save_data['project_id'] = $project_id;
      $save_data['company_id'] = $smm_company_id;
      $save_data['project_discussion_date'] = date('d-m-Y');
      $save_data['project_discussion_addedby'] = $smm_user_id;
      unset($save_data['files']);
      $project_discussion_id = $this->Master_Model->save_data('smm_project_discussion', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/project_det_discussion');
    }

    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];
    $order_id = $project_info[0]['order_id'];
    $data['project_discussion_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','project_discussion_id','ASC','smm_project_discussion');

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','task_id','ASC','smm_task');
    $data['page'] = 'Project Discussion';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_discussion', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Project Discussion...
  public function edit_project_det_discussion($project_discussion_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $project_id = $this->session->userdata('project_id');

    $this->form_validation->set_rules('project_discussion_title', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $update_data['project_discussion_addedby_type'] = '1';
      $update_data['project_discussion_addedby'] = $smm_user_id;
      unset($update_data['files']);
      $this->Master_Model->update_info('project_discussion_id', $project_discussion_id, 'smm_project_discussion', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/project_det_discussion');
    }

    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];
    $order_id = $project_info[0]['order_id'];
    $data['project_discussion_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_id',$project_id,'','','','','project_discussion_id','ASC','smm_project_discussion');

    $project_discussion_info = $this->Master_Model->get_info_arr('project_discussion_id',$project_discussion_id,'smm_project_discussion');
    if(!$project_discussion_info){ header('location:'.base_url().'Project/project_det_discussion'); }
    $data['update'] = 'update';
    $data['update_project_discussion'] = 'update';
    $data['project_discussion_info'] = $project_discussion_info[0];

    $data['page'] = 'Project Discussion';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_det_discussion', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Order Status...
  public function delete_project_det_discussion($project_discussion_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('project_discussion_id', $project_discussion_id, 'smm_project_discussion');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/project_det_discussion');
  }



/******************************** Task Details *****************************/

  // Set Task Session...
  public function set_task_session($task_id = null){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $task_info = $this->Master_Model->get_info_arr_fields('task_id, project_id', 'task_id', $task_id, 'smm_task');
    if(!$task_info){
      header('location:'.base_url().'Project/task');
    } else{
      $this->session->set_userdata('task_id', $task_id);
      $this->session->set_userdata('task_project_id', $task_info[0]['project_id']);
      header('location:'.base_url().'Project/task_det_overview');
    }
  }

  // Project Overview...
  public function task_det_overview(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $task_id = $this->session->userdata('task_id');
    $task_info = $this->Master_Model->get_info_arr_fields('*', 'task_id', $task_id, 'smm_task');
    $data['task_info'] = $task_info[0];

    $project_id = $this->session->userdata('task_project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];

    $data['page'] = 'Task Overview';
    // echo $project_id;
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/task_det_overview', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

// Project Progress...
  public function task_det_progress(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $task_id = $this->session->userdata('task_id');

    $this->form_validation->set_rules('task_status', 'Project Status', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $this->Master_Model->update_info('task_id', $task_id, 'smm_task', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/task_det_progress');
    }


    $task_info = $this->Master_Model->get_info_arr_fields('*', 'task_id', $task_id, 'smm_task');
    $data['task_info'] = $task_info[0];

    $project_id = $this->session->userdata('task_project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];

    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_status_id','ASC','smm_task_status');

    $data['page'] = 'Task Progress';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/task_det_progress', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

// Project File...
  public function task_det_file(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $task_id = $this->session->userdata('task_id');

    $this->form_validation->set_rules('task_file_name', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $save_data = $_POST;
      $save_data['task_id'] = $task_id;
      $save_data['company_id'] = $smm_company_id;
      $save_data['task_file_addedby'] = $smm_user_id;

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

      header('location:'.base_url().'Project/task_det_file');
    }


    $task_info = $this->Master_Model->get_info_arr_fields('*', 'task_id', $task_id, 'smm_task');
    $data['task_info'] = $task_info[0];

    $project_id = $this->session->userdata('task_project_id');
    $project_info = $this->Master_Model->get_info_arr_fields('*', 'project_id', $project_id, 'smm_project');
    $data['project_info'] = $project_info[0];

    $data['task_file_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'task_id',$task_id,'','','','','task_file_id','DESC','smm_task_file');
    $data['page'] = 'Task File';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/task_det_file', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

















/********************************* Client ***********************************/

  // Add Client...
  public function client(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('client_name', 'client title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $client_status = $this->input->post('client_status');
      if(!isset($client_status)){ $client_status = '1'; }
      $save_data = $_POST;
      $save_data['client_status'] = $client_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['client_addedby'] = $smm_user_id;
      $client_id = $this->Master_Model->save_data('smm_client', $save_data);

      if($_FILES['client_logo']['name']){
        $time = time();
        $image_name = 'client_'.$client_id.'_'.$time;
        $config['upload_path'] = 'assets/images/client/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['client_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('client_logo') && $client_id && $image_name && $ext && $filename){
          $client_logo_up['client_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('client_id', $client_id, 'smm_client', $client_logo_up);
          // unlink("assets/images/tours/".$client_logo_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/client');
    }
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    // $data['state_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','state_name','ASC','state');
    // $data['city_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','city_name','ASC','city');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');

    $data['client_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','client_id','DESC','smm_client');
    $data['page'] = 'Client';

    // print_r($data['branch_list']);

    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/client', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Client...
  public function edit_client($client_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('client_name', 'client title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $client_status = $this->input->post('client_status');
      if(!isset($client_status)){ $client_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_client_logo']);
      $update_data['client_status'] = $client_status;
      $update_data['client_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('client_id', $client_id, 'smm_client', $update_data);

      if($_FILES['client_logo']['name']){
        $time = time();
        $image_name = 'client_'.$client_id.'_'.$time;
        $config['upload_path'] = 'assets/images/client/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['client_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('client_logo') && $client_id && $image_name && $ext && $filename){
          $client_logo_up['client_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('client_id', $client_id, 'smm_client', $client_logo_up);
          if($_POST['old_client_logo']){ unlink("assets/images/client/".$_POST['old_client_logo']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/client');
    }
    $client_info = $this->Master_Model->get_info_arr('client_id',$client_id,'smm_client');
    if(!$client_info){ header('location:'.base_url().'Project/client'); }
    $data['update'] = 'update';
    $data['update_client'] = 'update';
    $data['client_info'] = $client_info[0];
    $data['act_link'] = base_url().'Project/edit_client/'.$client_id;
    $state_id = $client_info[0]['state_id'];
    $country_id = $client_info[0]['country_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');

    $data['client_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','client_id','DESC','smm_client');
    $data['page'] = 'Edit Client';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/client', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Client...
  public function delete_client($client_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $client_info = $this->Master_Model->get_info_arr_fields('client_logo, client_id', 'client_id', $client_id, 'smm_client');
    if($client_info){
      $client_logo = $client_info[0]['client_logo'];
      if($client_logo){ unlink("assets/images/client/".$client_logo); }
    }
    $this->Master_Model->delete_info('client_id', $client_id, 'smm_client');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/client');
  }

/********************************* Task Status ***********************************/
  // Add Task Status...
  public function task_status(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('task_status_name', 'Task Status Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $task_status_status = $this->input->post('task_status_status');
      if(!isset($task_status_status)){ $task_status_status = '1'; }
      $save_data = $_POST;
      $save_data['task_status_status'] = $task_status_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['task_status_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_task_status', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/task_status');
    }

    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_status_id','ASC','smm_task_status');
    $data['page'] = 'Task Status';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/task_status', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Task Status...
  public function edit_task_status($task_status_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('task_status_name', 'Task Status Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $task_status_status = $this->input->post('task_status_status');
      if(!isset($task_status_status)){ $task_status_status = '1'; }
      $update_data = $_POST;
      $update_data['task_status_status'] = $task_status_status;
      $update_data['task_status_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('task_status_id', $task_status_id, 'smm_task_status', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/task_status');
    }

    $task_status_info = $this->Master_Model->get_info_arr('task_status_id',$task_status_id,'smm_task_status');
    if(!$task_status_info){ header('location:'.base_url().'Project/task_status'); }
    $data['update'] = 'update';
    $data['update_task_status'] = 'update';
    $data['task_status_info'] = $task_status_info[0];
    $data['act_link'] = base_url().'Project/edit_task_status/'.$task_status_id;

    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_status_id','ASC','smm_task_status');
    $data['page'] = 'Edit Task Status';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/task_status', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Task Status...
  public function delete_task_status($task_status_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('task_status_id', $task_status_id, 'smm_task_status');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/task_status');
  }


/*********************************** Task *********************************/

  // Add Task....
  public function task(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('task_title', 'Task Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      unset($save_data['task_assign_to']);
      unset($save_data['task_file_name']);
      unset($save_data['task_file_image']);
      unset($save_data['input']);

      $task_assign_to=implode(',', $_POST['task_assign_to']);
      $save_data['task_assign_to'] = $task_assign_to;
      // $save_data['task_status'] = $task_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['task_addedby'] = $smm_user_id;
      $task_id = $this->Master_Model->save_data('smm_task', $save_data);

      if(isset($_FILES['task_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['task_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'task_file_'.$task_id.'_'.$j.'_'.$time;
          $_FILES['task_file_image']['name']= $files['task_file_image']['name'][$i];
          $_FILES['task_file_image']['type']= $files['task_file_image']['type'][$i];
          $_FILES['task_file_image']['tmp_name']= $files['task_file_image']['tmp_name'][$i];
          $_FILES['task_file_image']['error']= $files['task_file_image']['error'][$i];
          $_FILES['task_file_image']['size']= $files['task_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/task/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['task_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $task_file_name = $_POST['task_file_name'][$i];
          if($this->upload->do_upload('task_file_image') && $filename && $ext ){
            $file_data['task_file_image'] = base_url().'assets/images/task/'.$image_name.'.'.$ext;
            $file_data['task_id'] = $task_id;
            $file_data['company_id'] = $smm_company_id;
            $file_data['task_file_name'] = $task_file_name;
            $this->Master_Model->save_data('smm_task_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/task');
    }
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_id','DESC','smm_project');
    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_status_id','ASC','smm_task_status');
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_id','DESC','smm_task');
    $data['page'] = 'Task';
    // print_r($data['employee_list']);
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/task', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Task...
  public function edit_task($task_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('task_title', 'Task Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $task_status = $this->input->post('task_status');
      // if(!isset($task_status)){ $task_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_task_image']);
      unset($update_data['task_assign_to']);
      unset($update_data['task_file_name']);
      unset($update_data['task_file_image']);
      unset($update_data['input']);
      $task_assign_to=implode(',', $_POST['task_assign_to']);
      $update_data['task_assign_to'] = $task_assign_to;
      // $update_data['task_status'] = $task_status;
      $update_data['task_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('task_id', $task_id, 'smm_task', $update_data);

      if(isset($_FILES['task_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['task_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'task_file_'.$task_id.'_'.$j.'_'.$time;
          $_FILES['task_file_image']['name']= $files['task_file_image']['name'][$i];
          $_FILES['task_file_image']['type']= $files['task_file_image']['type'][$i];
          $_FILES['task_file_image']['tmp_name']= $files['task_file_image']['tmp_name'][$i];
          $_FILES['task_file_image']['error']= $files['task_file_image']['error'][$i];
          $_FILES['task_file_image']['size']= $files['task_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/task/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['task_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $task_file_name = $_POST['task_file_name'][$i];
          if($this->upload->do_upload('task_file_image') && $filename && $ext ){
            $file_data['task_file_image'] = base_url().'assets/images/task/'.$image_name.'.'.$ext;
            $file_data['task_id'] = $task_id;
            $file_data['company_id'] = $smm_company_id;
            $file_data['task_file_name'] = $task_file_name;
            $this->Master_Model->save_data('smm_task_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/task');
    }

    $task_info = $this->Master_Model->get_info_arr('task_id',$task_id,'smm_task');
    if(!$task_info){ header('location:'.base_url().'Project/task'); }
    $data['update'] = 'update';
    $data['update_task'] = 'update';
    $data['task_info'] = $task_info[0];
    $data['act_link'] = base_url().'Project/edit_task/'.$task_id;
    // $task_category_type = $task_info[0]['task_category_type'];
    // $data['task_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'task_category_status','1','task_category_type',$task_category_type,'','','task_category_name','ASC','smm_task_category');
    // $data['gst_slab_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'gst_slab_status','1','','','','','gst_slab_per','ASC','smm_gst_slab');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_id','DESC','smm_project');
    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_status_id','ASC','smm_task_status');
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['task_file_list'] = $this->Master_Model->get_list_by_id3('','task_id',$task_id,'','','','','task_file_id','DESC','smm_task_file');

    $data['task_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','task_id','DESC','smm_task');
    $data['page'] = 'Edit Task';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/task', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Task File
  public function delete_task_file(){
    $task_file_id = $this->input->post('task_file_id');
    $task_file_info = $this->Master_Model->get_info_arr_fields('task_file_image, task_file_id', 'task_file_id', $task_file_id, 'smm_task_file');
    if($task_file_info){
      $task_file_image = $task_file_info[0]['task_file_image'];
      if($task_file_image){ unlink("".$task_file_image); }
    }
    $this->Master_Model->delete_info('task_file_id', $task_file_id, 'smm_task_file');
  }

  //Delete Task...
  public function delete_task($task_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // $task_info = $this->Master_Model->get_info_arr_fields('task_image, task_id', 'task_id', $task_id, 'smm_task');
    // if($task_info){
    //   $task_image = $task_info[0]['task_image'];
    //   if($task_image){ unlink("assets/images/task/".$task_image); }
    // }
    $task_file_list = $this->Master_Model->get_list_by_id3($smm_company_id,'task_id',$task_id,'','','','','task_file_id','ASC','smm_task_file');
    foreach ($task_file_list as $task_file_list1) {
      $task_file_image = $task_file_list1->task_file_image;
      if($task_file_image){ unlink("".$task_file_image); }
    }
    $this->Master_Model->delete_info('task_id', $task_id, 'smm_task');
    $this->Master_Model->delete_info('task_id', $task_id, 'smm_task_file');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/task');
  }




/********************************* Time Log ***********************************/
  // Add Time Log...
  public function time_log(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('project_id', 'Time Log Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $time_log_status = $this->input->post('time_log_status');
      if(!isset($time_log_status)){ $time_log_status = '1'; }
      $save_data = $_POST;
      $save_data['time_log_status'] = $time_log_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['time_log_addedby'] = $smm_user_id;

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

      // $user_id = $this->Master_Model->save_data('smm_time_log', $save_data);

      // $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/time_log');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');

    $data['time_log_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','time_log_id','ASC','smm_time_log');
    $data['page'] = 'Time Log';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/time_log', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Time Log...
  public function edit_time_log($time_log_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('project_id', 'Time Log Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $time_log_status = $this->input->post('time_log_status');
      if(!isset($time_log_status)){ $time_log_status = '1'; }
      $update_data = $_POST;
      $update_data['time_log_status'] = $time_log_status;
      $update_data['time_log_addedby'] = $smm_user_id;

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
        $update_data['time_log_hrs'] = $hour;
        $this->Master_Model->update_info('time_log_id', $time_log_id, 'smm_time_log', $update_data);
        $this->session->set_flashdata('update_success','success');
      }

      header('location:'.base_url().'Project/time_log');
    }

    $time_log_info = $this->Master_Model->get_info_arr('time_log_id',$time_log_id,'smm_time_log');
    if(!$time_log_info){ header('location:'.base_url().'Project/time_log'); }
    $data['update'] = 'update';
    $data['update_time_log'] = 'update';
    $data['time_log_info'] = $time_log_info[0];
    $data['act_link'] = base_url().'Project/edit_time_log/'.$time_log_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');

    $data['time_log_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','time_log_id','ASC','smm_time_log');
    $data['page'] = 'Edit Time Log';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/time_log', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Time Log...
  public function delete_time_log($time_log_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('time_log_id', $time_log_id, 'smm_time_log');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/time_log');
  }


/*********************************** Projects Kanban Board *********************************/

  // Projects Kanban Board....
  public function project_kanban(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $data['project_not_started_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_status','0','','','','','project_id','DESC','smm_project');
    $data['project_in_process_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_status','1','','','','','project_id','DESC','smm_project');
    $data['project_complete_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_status','2','','','','','project_id','DESC','smm_project');
    $data['project_cancel_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_status','3','','','','','project_id','DESC','smm_project');
    $data['project_hold_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_status','4','','','','','project_id','DESC','smm_project');

    $data['page'] = 'Projects Kanban Board';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_kanban', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


/********************************* Project Revision  ***********************************/
  // Add Project Revision ...
  public function project_revision(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('project_revision_title', 'Project Revision Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $project_revision_status = $this->input->post('project_revision_status');
      // if(!isset($project_revision_status)){ $project_revision_status = '1'; }
      $save_data = $_POST;
      $save_data['project_revision_company'] = $smm_company_id;
      $save_data['project_revision_addedby'] = $smm_user_id;
      $save_data['project_revision_date'] = date('d-m-Y');
      unset($save_data['project_revision_file_name']);
      unset($save_data['project_revision_file_image']);
      unset($save_data['input']);
      $project_revision_id = $this->Master_Model->save_data('smm_project_revision', $save_data);

      if(isset($_FILES['project_revision_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['project_revision_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'project_revision_file_'.$project_revision_id.'_'.$j.'_'.$time;
          $_FILES['project_revision_file_image']['name']= $files['project_revision_file_image']['name'][$i];
          $_FILES['project_revision_file_image']['type']= $files['project_revision_file_image']['type'][$i];
          $_FILES['project_revision_file_image']['tmp_name']= $files['project_revision_file_image']['tmp_name'][$i];
          $_FILES['project_revision_file_image']['error']= $files['project_revision_file_image']['error'][$i];
          $_FILES['project_revision_file_image']['size']= $files['project_revision_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/project_revision/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['project_revision_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $project_revision_file_name = $_POST['project_revision_file_name'][$i];
          if($this->upload->do_upload('project_revision_file_image') && $filename && $ext ){
            $file_data['project_revision_file_image'] = base_url().'assets/images/project_revision/'.$image_name.'.'.$ext;
            $file_data['project_revision_id'] = $project_revision_id;
            $file_data['company_id'] = $smm_company_id;
            $file_data['project_revision_file_name'] = $project_revision_file_name;
            $this->Master_Model->save_data('smm_project_revision_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/project_revision');
    }
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['project_revision_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_revision_category_id','ASC','smm_project_revision_category');
    // $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','user_name','ASC','user');

    $data['project_revision_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_revision_id','DESC','smm_project_revision');
    $data['page'] = 'Project Revision';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_revision', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Project Revision...
  public function edit_project_revision($project_revision_id){
    $smm_user_id = $this->session->userdata('smm_reseller_id');
    $smm_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('project_revision_title', 'Project Revision Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_project_revision_image']);
      unset($update_data['project_revision_file_name']);
      unset($update_data['project_revision_file_image']);
      unset($update_data['input']);
      $this->Master_Model->update_info('project_revision_id', $project_revision_id, 'smm_project_revision', $update_data);

      if(isset($_FILES['project_revision_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['project_revision_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'project_revision_file_'.$project_revision_id.'_'.$j.'_'.$time;
          $_FILES['project_revision_file_image']['name']= $files['project_revision_file_image']['name'][$i];
          $_FILES['project_revision_file_image']['type']= $files['project_revision_file_image']['type'][$i];
          $_FILES['project_revision_file_image']['tmp_name']= $files['project_revision_file_image']['tmp_name'][$i];
          $_FILES['project_revision_file_image']['error']= $files['project_revision_file_image']['error'][$i];
          $_FILES['project_revision_file_image']['size']= $files['project_revision_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/project_revision/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['project_revision_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $project_revision_file_name = $_POST['project_revision_file_name'][$i];
          if($this->upload->do_upload('project_revision_file_image') && $filename && $ext ){
            $file_data['project_revision_file_image'] = base_url().'assets/images/project_revision/'.$image_name.'.'.$ext;
            $file_data['project_revision_id'] = $project_revision_id;
            $file_data['company_id'] = $smm_company_id;
            $file_data['project_revision_file_name'] = $project_revision_file_name;
            $this->Master_Model->save_data('smm_project_revision_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/project_revision');
    }

    $project_revision_info = $this->Master_Model->get_info_arr('project_revision_id',$project_revision_id,'smm_project_revision');
    if(!$project_revision_info){ header('location:'.base_url().'Project/project_revision'); }
    $data['update'] = 'update';
    $data['update_project_revision'] = 'update';
    $data['project_revision_info'] = $project_revision_info[0];
    $data['act_link'] = base_url().'Project/edit_project_revision/'.$project_revision_id;
    // $data['project_revision_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'project_revision_category_status','1','project_revision_category_type',$project_revision_category_type,'','','project_revision_category_name','ASC','smm_project_revision_category');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['project_revision_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_revision_category_id','ASC','smm_project_revision_category');
    // $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','user_name','ASC','user');

    $data['project_revision_file_list'] = $this->Master_Model->get_list_by_id3('','project_revision_id',$project_revision_id,'','','','','project_revision_file_id','DESC','smm_project_revision_file');

    $data['project_revision_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_revision_id','DESC','smm_project_revision');
    $data['page'] = 'Project Revision';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/project_revision', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Project Revision File
  public function delete_project_revision_file(){
    $project_revision_file_id = $this->input->post('project_revision_file_id');
    $project_revision_file_info = $this->Master_Model->get_info_arr_fields('project_revision_file_image, project_revision_file_id', 'project_revision_file_id', $project_revision_file_id, 'smm_project_revision_file');
    if($project_revision_file_info){
      $project_revision_file_image = $project_revision_file_info[0]['project_revision_file_image'];
      if($project_revision_file_image){ unlink("".$project_revision_file_image); }
    }
    $this->Master_Model->delete_info('project_revision_file_id', $project_revision_file_id, 'smm_project_revision_file');
  }

  //Delete Task...
  public function delete_project_revision($project_revision_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // $project_revision_info = $this->Master_Model->get_info_arr_fields('project_revision_image, project_revision_id', 'project_revision_id', $project_revision_id, 'smm_project_revision');
    // if($project_revision_info){
    //   $project_revision_image = $project_revision_info[0]['project_revision_image'];
    //   if($project_revision_image){ unlink("assets/images/project_revision/".$project_revision_image); }
    // }
    $project_revision_file_list = $this->Master_Model->get_list_by_id3($smm_company_id,'project_revision_id',$project_revision_id,'','','','','project_revision_file_id','ASC','smm_project_revision_file');
    foreach ($project_revision_file_list as $project_revision_file_list1) {
      $project_revision_file_image = $project_revision_file_list1->project_revision_file_image;
      if($project_revision_file_image){ unlink("".$project_revision_file_image); }
    }
    $this->Master_Model->delete_info('project_revision_id', $project_revision_id, 'smm_project_revision');
    $this->Master_Model->delete_info('project_revision_id', $project_revision_id, 'smm_project_revision_file');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/project_revision');
  }


/****************************************************************************/
/**                                 Ticket                                 **/
/****************************************************************************/


/*********************************** Ticket *********************************/

  // Add Ticket....
  public function ticket(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('ticket_title', 'Ticket Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $ticket_status = $this->input->post('ticket_status');
      // if(!isset($ticket_status)){ $ticket_status = '1'; }
      $save_data = $_POST;
      // $save_data['ticket_status'] = $ticket_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['ticket_addedby'] = $smm_user_id;
      $ticket_id = $this->Master_Model->save_data('smm_ticket', $save_data);

      if($_FILES['ticket_image']['name']){
        $time = time();
        $image_name = 'ticket_'.$ticket_id.'_'.$time;
        $config['upload_path'] = 'assets/images/ticket/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['ticket_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('ticket_image') && $ticket_id && $image_name && $ext && $filename){
          $ticket_image_up['ticket_image'] =  base_url().'assets/images/ticket/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $ticket_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Project/ticket');
    }
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','department_status','1','department_name','ASC','smm_department');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','user_status','1','user_name','ASC','user');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');

    $data['ticket_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','ticket_id','DESC','smm_ticket');
    $data['page'] = 'Ticket';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/ticket', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Ticket...
  public function edit_ticket($ticket_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('ticket_title', 'Ticket Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $ticket_status = $this->input->post('ticket_status');
      // if(!isset($ticket_status)){ $ticket_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_ticket_image']);
      // $update_data['ticket_status'] = $ticket_status;
      // $update_data['ticket_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $update_data);

      if($_FILES['ticket_image']['name']){
        $time = time();
        $image_name = 'ticket_'.$ticket_id.'_'.$time;
        $config['upload_path'] = 'assets/images/ticket/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['ticket_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('ticket_image') && $ticket_id && $image_name && $ext && $filename){
          $ticket_image_up['ticket_image'] =  base_url().'assets/images/ticket/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $ticket_image_up);
          if($_POST['old_ticket_img']){ unlink("".$_POST['old_ticket_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Project/ticket');
    }

    $ticket_info = $this->Master_Model->get_info_arr('ticket_id',$ticket_id,'smm_ticket');
    if(!$ticket_info){ header('location:'.base_url().'Project/ticket'); }
    $data['update'] = 'update';
    $data['update_ticket'] = 'update';
    $data['ticket_info'] = $ticket_info[0];
    $data['act_link'] = base_url().'Project/edit_ticket/'.$ticket_id;
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','department_status','1','department_name','ASC','smm_department');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','user_status','1','user_name','ASC','user');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');

    $data['ticket_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','ticket_id','DESC','smm_ticket');
    $data['page'] = 'Edit Ticket';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Project/ticket', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Ticket...
  public function delete_ticket($ticket_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $ticket_info = $this->Master_Model->get_info_arr_fields('ticket_image, ticket_id', 'ticket_id', $ticket_id, 'smm_ticket');
    if($ticket_info){
      $ticket_image = $ticket_info[0]['ticket_image'];
      if($ticket_image){ unlink("".$ticket_image); }
    }
    $this->Master_Model->delete_info('ticket_id', $ticket_id, 'smm_ticket');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Project/ticket');
  }





}
?>
