<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }

/**************************      Employee Dashboard      ********************************/
  public function timesheet_dashboard(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $data['page'] = 'Employee Dashboard';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Timesheet/timesheet_dashboard', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

/*********************************** Attendence *********************************/

  // Add Attendence....
  public function attendence(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('attendence_date', 'Attendence Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $attendence_status = $this->input->post('attendence_status');
      if(!isset($attendence_status)){ $attendence_status = '1'; }
      $save_data = $_POST;
      $save_data['attendence_status'] = $attendence_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['attendence_addedby'] = $smm_user_id;
      $attendence_id = $this->Master_Model->save_data('smm_attendence', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Timesheet/attendence');
    }
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','user_status','1','user_name','ASC','user');

    $data['attendence_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','attendence_id','DESC','smm_attendence');
    $data['page'] = 'Attendence';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Timesheet/attendence', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Attendence...
  public function edit_attendence($attendence_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('attendence_date', 'Attendence Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $attendence_status = $this->input->post('attendence_status');
      if(!isset($attendence_status)){ $attendence_status = '1'; }
      $update_data = $_POST;
      $update_data['attendence_status'] = $attendence_status;
      $update_data['attendence_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('attendence_id', $attendence_id, 'smm_attendence', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Timesheet/attendence');
    }

    $attendence_info = $this->Master_Model->get_info_arr('attendence_id',$attendence_id,'smm_attendence');
    if(!$attendence_info){ header('location:'.base_url().'Timesheet/attendence'); }
    $data['update'] = 'update';
    $data['update_attendence'] = 'update';
    $data['attendence_info'] = $attendence_info[0];
    $data['act_link'] = base_url().'Timesheet/edit_attendence/'.$attendence_id;
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','user_status','1','user_name','ASC','user');

    $data['attendence_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','attendence_id','DESC','smm_attendence');
    $data['page'] = 'Edit Attendence';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Timesheet/attendence', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Attendence...
  public function delete_attendence($attendence_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('attendence_id', $attendence_id, 'smm_attendence');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Timesheet/attendence');
  }



/*********************************** Overtime Request *********************************/

  // Add Overtime Request....
  public function overtime_request(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('overtime_request_date', 'Overtime Request Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $overtime_request_status = $this->input->post('overtime_request_status');
      // if(!isset($overtime_request_status)){ $overtime_request_status = '1'; }
      $save_data = $_POST;
      // $save_data['overtime_request_status'] = $overtime_request_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['overtime_request_addedby'] = $smm_user_id;
      $overtime_request_id = $this->Master_Model->save_data('smm_overtime_request', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Timesheet/overtime_request');
    }
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','','','user_name','ASC','user');

    $data['overtime_request_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','overtime_request_id','DESC','smm_overtime_request');
    $data['page'] = 'Overtime Request';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Timesheet/overtime_request', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Overtime Request...
  public function edit_overtime_request($overtime_request_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('overtime_request_date', 'Overtime Request Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $overtime_request_status = $this->input->post('overtime_request_status');
      // if(!isset($overtime_request_status)){ $overtime_request_status = '1'; }
      $update_data = $_POST;
      // $update_data['overtime_request_status'] = $overtime_request_status;
      $update_data['overtime_request_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('overtime_request_id', $overtime_request_id, 'smm_overtime_request', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Timesheet/overtime_request');
    }

    $overtime_request_info = $this->Master_Model->get_info_arr('overtime_request_id',$overtime_request_id,'smm_overtime_request');
    if(!$overtime_request_info){ header('location:'.base_url().'Timesheet/overtime_request'); }
    $data['update'] = 'update';
    $data['update_overtime_request'] = 'update';
    $data['overtime_request_info'] = $overtime_request_info[0];
    $data['act_link'] = base_url().'Timesheet/edit_overtime_request/'.$overtime_request_id;
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','','','user_name','ASC','user');

    $data['overtime_request_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','overtime_request_id','DESC','smm_overtime_request');
    $data['page'] = 'Edit Overtime Request';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Timesheet/overtime_request', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Overtime Request...
  public function delete_overtime_request($overtime_request_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('overtime_request_id', $overtime_request_id, 'smm_overtime_request');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Timesheet/overtime_request');
  }





/********************************* Leave ***********************************/

  // Add Leave...
  public function leave(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_id', 'Leave', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $leave_status = $this->input->post('leave_status');
      // if(!isset($leave_status)){ $leave_status = '1'; }
      $save_data = $_POST;
      // $save_data['leave_status'] = $leave_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['leave_addedby'] = $smm_user_id;
      $leave_id = $this->Master_Model->save_data('smm_leave', $save_data);

      if($_FILES['leave_image']['name']){
        $time = time();
        $image_name = 'leave_'.$leave_id.'_'.$time;
        $config['upload_path'] = 'assets/images/leave/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['leave_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('leave_image') && $leave_id && $image_name && $ext && $filename){
          $leave_image_up['leave_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('leave_id', $leave_id, 'smm_leave', $leave_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Timesheet/leave');
    }
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','','','user_name','ASC','user');

    $data['leave_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_id','DESC','smm_leave');
    $data['page'] = 'Leave';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Timesheet/leave', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Leave...
  public function edit_leave($leave_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_id', 'Leave', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $leave_status = $this->input->post('leave_status');
      // if(!isset($leave_status)){ $leave_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_leave_image']);
      // $update_data['leave_status'] = $leave_status;
      $update_data['leave_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('leave_id', $leave_id, 'smm_leave', $update_data);

      if($_FILES['leave_image']['name']){
        $time = time();
        $image_name = 'leave_'.$leave_id.'_'.$time;
        $config['upload_path'] = 'assets/images/leave/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['leave_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('leave_image') && $leave_id && $image_name && $ext && $filename){
          $leave_image_up['leave_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('leave_id', $leave_id, 'smm_leave', $leave_image_up);
          if($_POST['old_leave_image']){ unlink("assets/images/leave/".$_POST['old_leave_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Timesheet/leave');
    }
    $leave_info = $this->Master_Model->get_info_arr('leave_id',$leave_id,'smm_leave');
    if(!$leave_info){ header('location:'.base_url().'Timesheet/leave'); }
    $data['update'] = 'update';
    $data['update_leave'] = 'update';
    $data['leave_info'] = $leave_info[0];
    $data['act_link'] = base_url().'Timesheet/edit_leave/'.$leave_id;
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','','','user_name','ASC','user');

    $data['leave_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_id','DESC','smm_leave');
    $data['page'] = 'Edit Leave';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Timesheet/leave', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Leave...
  public function delete_leave($leave_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $leave_info = $this->Master_Model->get_info_arr_fields('leave_image, leave_id', 'leave_id', $leave_id, 'smm_leave');
    if($leave_info){
      $leave_image = $leave_info[0]['leave_image'];
      if($leave_image){ unlink("assets/images/leave/".$leave_image); }
    }
    $this->Master_Model->delete_info('leave_id', $leave_id, 'smm_leave');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Timesheet/leave');
  }



}
?>
