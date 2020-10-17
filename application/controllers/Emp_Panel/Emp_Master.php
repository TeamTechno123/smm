<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_Master extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){
    // $this->load->view('Admin/User/forgot_password');
  }


/**************************      Timesheet      ********************************/
  public function timesheet(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $data['page'] = 'Employee Timesheet';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Master/timesheet', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

/**************************      Attendance List      ********************************/
  public function attendence_list(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $data['attendence_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','attendence_id','DESC','smm_attendence');
    $data['page'] = 'Employee Attendance List';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Master/attendence_list', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }


/*********************************** Overtime Request *********************************/

  // Add Overtime Request....
  public function overtime_request(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('overtime_request_date', 'Overtime Request Date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;

      // Work Time...
      $in_time = $_POST['overtime_request_in_time'];
      $out_time = $_POST['overtime_request_out_time'];
      $out_time1 = strtotime($out_time);
      $in_time = strtotime($in_time);
      $difference = $out_time1 - $in_time;
      $hours = abs(floor($difference / 3600));
      $mins = abs(floor(($difference-($hours * 3600))/60));#floor($difference / 60);
      $overtime_request_tot_time = $hours.':'.$mins;
      $save_data['overtime_request_tot_time'] = $overtime_request_tot_time;
      $save_data['overtime_request_tot_second'] = $difference;

      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['employee_id'] = $smm_emp_id;
      $save_data['overtime_request_status'] = '0';
      $save_data['overtime_request_addedby'] = $smm_emp_id;
      $save_data['overtime_request_addedby_type'] = '2';
      $overtime_request_id = $this->Master_Model->save_data('smm_overtime_request', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Master/overtime_request');
    }
    $data['overtime_request_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','overtime_request_id','DESC','smm_overtime_request');
    $data['page'] = 'Overtime Request';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Master/overtime_request', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Add Overtime Request....
  public function edit_overtime_request($overtime_request_id = null){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('overtime_request_date', 'Overtime Request Date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;

      // Work Time...
      $in_time = $_POST['overtime_request_in_time'];
      $out_time = $_POST['overtime_request_out_time'];
      $out_time1 = strtotime($out_time);
      $in_time = strtotime($in_time);
      $difference = $out_time1 - $in_time;
      $hours = abs(floor($difference / 3600));
      $mins = abs(floor(($difference-($hours * 3600))/60));#floor($difference / 60);
      $overtime_request_tot_time = $hours.':'.$mins;
      $update_data['overtime_request_tot_time'] = $overtime_request_tot_time;
      $update_data['overtime_request_tot_second'] = $difference;

      $update_data['company_id'] = $smm_emp_company_id;
      $update_data['employee_id'] = $smm_emp_id;
      $update_data['overtime_request_status'] = '0';
      $update_data['overtime_request_addedby'] = $smm_emp_id;
      $update_data['overtime_request_addedby_type'] = '2';
      $this->Master_Model->update_info('overtime_request_id', $overtime_request_id, 'smm_overtime_request', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Emp_Panel/Emp_Master/overtime_request');
    }
    $overtime_request_info = $this->Master_Model->get_info_arr_fields3('*', $smm_emp_company_id, 'overtime_request_id',$overtime_request_id, 'employee_id', $smm_emp_id, '', '', 'smm_overtime_request');
    if(!$overtime_request_info){ header('location:'.base_url().'Emp_Panel/Emp_Master/overtime_request'); }
    $data['update'] = 'update';
    $data['update_overtime_request'] = 'update';
    $data['overtime_request_info'] = $overtime_request_info[0];
    $data['act_link'] = base_url().'Emp_Panel/Emp_Master/edit_overtime_request/'.$overtime_request_id;

    $data['overtime_request_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','overtime_request_id','DESC','smm_overtime_request');
    $data['page'] = 'Overtime Request';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Master/overtime_request', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  //Delete Overtime Request...
  public function delete_overtime_request($overtime_request_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->Master_Model->delete_info('overtime_request_id', $overtime_request_id, 'smm_overtime_request');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Emp_Panel/Emp_Master/overtime_request');
  }


/********************************* Leave ***********************************/

  // Add Leave...
  public function leave(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('leave_type_id', 'Leave', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;

      $leave_half_day = $this->input->post('leave_half_day');
      if(isset($leave_half_day)){
        $save_data['leave_total_days'] = '0';
        $save_data['leave_half_day'] = '1';
      } else{
        $date1 = $_POST['leave_start_date'];
        $date2 = $_POST['leave_end_date'];
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        $datediff = $date2 - $date1;
        $leave_total_days = round($datediff / (60 * 60 * 24)) + 1;
        $save_data['leave_total_days'] = $leave_total_days;
        $save_data['leave_half_day'] = '0';
      }

      $save_data['leave_status'] = '0';
      $save_data['company_id'] = $smm_emp_company_id;
      $save_data['employee_id'] = $smm_emp_id;
      $save_data['leave_addedby'] = $smm_emp_id;
      $save_data['leave_addedby_type'] = '2';
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
      header('location:'.base_url().'Emp_Panel/Emp_Master/leave');
    }
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');

    $data['leave_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'employee_id',$smm_emp_id,'','','','','leave_id','DESC','smm_leave');
    $data['page'] = 'Leave';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Master/leave', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Edit Leave...
  public function edit_leave($leave_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $this->form_validation->set_rules('leave_type_id', 'Leave', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;

      $leave_half_day = $this->input->post('leave_half_day');
      if(isset($leave_half_day)){
        $update_data['leave_total_days'] = '0';
        $update_data['leave_half_day'] = '1';
      } else{
        $date1 = $_POST['leave_start_date'];
        $date2 = $_POST['leave_end_date'];
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        $datediff = $date2 - $date1;
        $leave_total_days = round($datediff / (60 * 60 * 24)) + 1;
        $update_data['leave_total_days'] = $leave_total_days;
        $update_data['leave_half_day'] = '0';
      }

      unset($update_data['old_leave_image']);
      $update_data['leave_status'] = '0';
      $update_data['company_id'] = $smm_emp_company_id;
      $update_data['employee_id'] = $smm_emp_id;
      $update_data['leave_addedby'] = $smm_emp_id;
      $update_data['leave_addedby_type'] = '2';
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
      header('location:'.base_url().'Emp_Panel/Emp_Master/leave');
    }
    $leave_info = $this->Master_Model->get_info_arr_fields3('*', $smm_emp_company_id, 'leave_id',$leave_id, 'employee_id', $smm_emp_id, '', '', 'smm_leave');
    if(!$leave_info){ header('location:'.base_url().'Timesheet/leave'); }
    $data['update'] = 'update';
    $data['update_leave'] = 'update';
    $data['leave_info'] = $leave_info[0];
    $data['act_link'] = base_url().'Emp_Panel/Emp_Master/edit_leave/'.$leave_id;
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');

    $data['leave_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','leave_id','DESC','smm_leave');
    $data['page'] = 'Leave';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Master/leave', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

  // Delete Leave...
  public function delete_leave($leave_id){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }
    $leave_info = $this->Master_Model->get_info_arr_fields('leave_image, leave_id', 'leave_id', $leave_id, 'smm_leave');
    if($leave_info){
      $leave_image = $leave_info[0]['leave_image'];
      if($leave_image){ unlink("assets/images/leave/".$leave_image); }
    }
    $this->Master_Model->delete_info('leave_id', $leave_id, 'smm_leave');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Emp_Panel/Emp_Master/leave');
  }



  /**************************      Payslip      ********************************/
  public function payslip(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    // $data['reseller_cnt'] = $this->Master_Model->get_sum($smm_emp_company_id,'reseller_id','reseller_added_type','2','reseller_addedby',$smm_emp_id,'','','smm_reseller');
    //
    // $data['reseller_cnt'] = $this->Master_Model->get_count('reseller_id',$smm_emp_company_id,'reseller_added_type','2','reseller_addedby',$smm_emp_id,'','','smm_reseller');
    // $data['package_cnt'] = $this->Master_Model->get_count('reseller_id',$smm_emp_company_id,'reseller_id',$smm_emp_id,'','','','','smm_reseller_package');
    // $data['announcement_cnt'] = $this->Master_Model->get_count('announcement_id',$smm_emp_company_id,'announcement_addedby_type','2','announcement_addedby',$smm_emp_id,'','','smm_announcement');
    // $data['testimonial_cnt'] = $this->Master_Model->get_count('testimonial_id',$smm_emp_company_id,'testimonial_addedby_type','2','testimonial_addedby',$smm_emp_id,'','','smm_testimonial');

    // $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_emp_company_id,'','','','','','','project_id','ASC','smm_project');
    $data['page'] = 'Employee Payslip';
    $this->load->view('Emp_Panel/Include/head', $data);
    $this->load->view('Emp_Panel/Include/navbar', $data);
    $this->load->view('Emp_Panel/Emp_Master/payslip', $data);
    $this->load->view('Emp_Panel/Include/footer', $data);
  }

/*************************************************************************************/
/**************************       Attendance      ************************************/
/*************************************************************************************/

  // Clock In...
  public function clock_in(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $attendence_date = date('d-m-Y');
    $check_clock_in = $this->Master_Model->get_info_arr_fields3('*', $smm_emp_company_id, 'attendence_date',$attendence_date, 'employee_id', $smm_emp_id, '', '', 'smm_attendence');
    if($check_clock_in){
      $this->session->set_flashdata('clock_in_exist','error');
    } else{
      $attendence_in_time = date('h:i A');
      $clock_in_data = array(
        'company_id' => $smm_emp_company_id,
        'employee_id' => $smm_emp_id,
        'attendence_date' => $attendence_date,
        'attendence_in_time' => $attendence_in_time,
        'attendence_addedby' => $smm_emp_id,
        'attendence_addedby_type' => '2',
      );
      $attendence_id = $this->Master_Model->save_data('smm_attendence', $clock_in_data);
      $this->session->set_flashdata('save_success','success');
    }
    header('location:'.base_url().'Emp_Panel/Emp_User/dashboard');
  }

  // Clock Out...
  public function clock_out(){
    $smm_emp_id = $this->session->userdata('smm_emp_id');
    $smm_emp_company_id = $this->session->userdata('smm_emp_company_id');
    if($smm_emp_id == '' || $smm_emp_company_id == ''){ header('location:'.base_url().'Employee/Emp_User'); }

    $attendence_date = date('d-m-Y');
    $check_clock_in = $this->Master_Model->get_info_arr_fields3('*', $smm_emp_company_id, 'attendence_date',$attendence_date, 'employee_id', $smm_emp_id, '', '', 'smm_attendence');
    if($check_clock_in){
      $attendence_out_time = date('h:i A');
      $attendence_id = $check_clock_in[0]['attendence_id'];
      $attendence_in_time = $check_clock_in[0]['attendence_in_time'];

      // Work Time...
      $attendence_out_time1 = strtotime($attendence_out_time);
      $attendence_in_time = strtotime($attendence_in_time);
      $difference = $attendence_out_time1 - $attendence_in_time;
      $hours = abs(floor($difference / 3600));
      $mins = abs(floor(($difference-($hours * 3600))/60));#floor($difference / 60);
      $attendence_tot_time = $hours.':'.$mins;

      //Owertime...
      $overtime_request_tot_second = '0';
      $overtime_request_tot_time = '0';
      $tot_present_second = '0';
      $tot_present_time = '0';
      $overtime_info = $this->Master_Model->get_info_arr_fields3('*', $smm_emp_company_id, 'overtime_request_date',$attendence_date, 'employee_id', $smm_emp_id, 'overtime_request_status', '1', 'smm_overtime_request');
      if($overtime_info){
        $overtime_request_tot_second = $overtime_info[0]['overtime_request_tot_second'];
        $overtime_request_tot_time = $overtime_info[0]['overtime_request_tot_time'];

        $tot_present_second = $overtime_request_tot_second + $difference;
        $tot_present_hours = abs(floor($tot_present_second / 3600));
        $tot_present_mins = abs(floor(($tot_present_second-($tot_present_hours * 3600))/60));#floor($difference / 60);
        $tot_present_time = $tot_present_hours.':'.$tot_present_mins;
      }



      if($attendence_id){
        $clock_out_data = array(
          'company_id' => $smm_emp_company_id,
          'employee_id' => $smm_emp_id,
          'attendence_date' => $attendence_date,
          'attendence_out_time' => $attendence_out_time,
          'attendence_total_second' => $difference,
          'attendence_tot_time' => $attendence_tot_time,
          'overtime_tot_second' => $overtime_request_tot_second,
          'overtime_tot_time' => $overtime_request_tot_time,
          'tot_present_second' => $tot_present_second,
          'tot_present_time' => $tot_present_time,
          'attendence_addedby' => $smm_emp_id,
          'attendence_addedby_type' => '2',
        );
        $this->Master_Model->update_info('attendence_id', $attendence_id, 'smm_attendence', $clock_out_data);
        $this->session->set_flashdata('save_success','success');
      } else{
        $this->session->set_flashdata('clock_in_exist','error');
      }
    } else{
      $this->session->set_flashdata('clock_in_exist','error');
    }
    header('location:'.base_url().'Emp_Panel/Emp_User/dashboard');
  }




}
?>
