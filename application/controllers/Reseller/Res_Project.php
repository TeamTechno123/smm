<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_Project extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

/********************************* Project ***********************************/
  // Add Project...
  public function project(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_id','ASC','smm_project');
    $data['page'] = 'Project';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/project', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Project...
  public function view_project($project_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $project_info = $this->Master_Model->get_info_arr('project_id',$project_id,'smm_project');
    if(!$project_info){ header('location:'.base_url().'Reseller/Res_Project/project'); }
    $data['update'] = 'update';
    $data['update_project'] = 'update';
    $data['project_info'] = $project_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Project/edit_project/'.$project_id;
    $data['client_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','client_name','ASC','smm_client');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'is_admin','0','','','','','user_name','ASC','user');
    $data['project_file_list'] = $this->Master_Model->get_list_by_id3('','project_id',$project_id,'','','','','project_file_id','DESC','smm_project_file');
    $data['project_del_phase_list'] = $this->Master_Model->get_list_by_id3('','project_id',$project_id,'','','','','project_del_phase_id','ASC','smm_project_del_phase');

    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_id','ASC','smm_project');
    $data['page'] = 'Edit Project';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/project', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }


/*********************************** Ticket *********************************/

  // Add Ticket....
  public function ticket(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('ticket_title', 'Ticket Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $ticket_status = $this->input->post('ticket_status');
      if(!isset($ticket_status)){ $ticket_status = '1'; }
      $save_data = $_POST;
      // $save_data['ticket_status'] = $ticket_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['ticket_addedby_type'] = '2';
      $save_data['ticket_addedby'] = $smm_reseller_id;
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
          $ticket_image_up['ticket_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $ticket_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Project/ticket');
    }
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');

    $data['ticket_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'ticket_addedby_type','2','ticket_addedby',$smm_reseller_id,'','','ticket_id','DESC','smm_ticket');
    $data['page'] = 'Ticket';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/ticket', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Ticket...
  public function edit_ticket($ticket_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('ticket_title', 'Ticket Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $ticket_status = $this->input->post('ticket_status');
      if(!isset($ticket_status)){ $ticket_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_ticket_image']);
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
          $ticket_image_up['ticket_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $ticket_image_up);
          if($_POST['old_ticket_img']){ unlink("assets/images/ticket/".$_POST['old_ticket_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Project/ticket');
    }

    $ticket_info = $this->Master_Model->get_info_arr('ticket_id',$ticket_id,'smm_ticket');
    if(!$ticket_info){ header('location:'.base_url().'Reseller/Res_Project/ticket'); }
    $data['update'] = 'update';
    $data['update_ticket'] = 'update';
    $data['ticket_info'] = $ticket_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Project/edit_ticket/'.$ticket_id;
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');

    $data['ticket_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'ticket_addedby_type','2','ticket_addedby',$smm_reseller_id,'','','ticket_id','DESC','smm_ticket');
    $data['page'] = 'Edit Ticket';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/ticket', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Ticket...
  public function delete_ticket($ticket_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_res_company_id == ''){ header('location:'.base_url().'User'); }
    $ticket_info = $this->Master_Model->get_info_arr_fields('ticket_image, ticket_id', 'ticket_id', $ticket_id, 'smm_ticket');
    if($ticket_info){
      $ticket_image = $ticket_info[0]['ticket_image'];
      if($ticket_image){ unlink("assets/images/ticket/".$ticket_image); }
    }
    $this->Master_Model->delete_info('ticket_id', $ticket_id, 'smm_ticket');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Project/ticket');
  }

/********************************* Task  ***********************************/
  // Add Task ...
  public function task(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    // $this->form_validation->set_rules('task_status_name', 'Task Status Name', 'trim|required');
    // if ($this->form_validation->run() != FALSE) {
    //   $task_status_status = $this->input->post('task_status_status');
    //   if(!isset($task_status_status)){ $task_status_status = '1'; }
    //   $save_data = $_POST;
    //   $save_data['task_status_status'] = $task_status_status;
    //   $save_data['company_id'] = $smm_res_company_id;
    //   $save_data['task_status_addedby'] = $smm_user_id;
    //   $user_id = $this->Master_Model->save_data('smm_task_status', $save_data);
    //
    //   $this->session->set_flashdata('save_success','success');
    //   header('location:'.base_url().'Project/task_status');
    // }
    //
    // $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','task_status_id','ASC','smm_task_status');
    $data['page'] = 'Task';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/task', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }


}
?>
