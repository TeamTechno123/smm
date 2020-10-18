<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

/**************************      Employee Dashboard      ********************************/
  public function employee_dashboard(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $data['total_employee'] =$this->Master_Model->get_count('employee_id',$smm_company_id,'','','','','','','smm_employee');
    $data['total_freelancer'] =$this->Master_Model->get_count('freelancer_id',$smm_company_id,'','','','','','','smm_freelancer');
    $data['total_leave_request'] =$this->Master_Model->get_count('leave_id',$smm_company_id,'','','','','','','smm_leave');
    $data['total_overtime_request'] =$this->Master_Model->get_count('overtime_request_id',$smm_company_id,'','','','','','','smm_overtime_request');
    $data['page'] = 'Employee Dashboard';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Employee/employee_dashboard', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


/*******************************    Employee Information      ****************************/

  // Add Employee...
  public function employee(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // if(!in_array("user1", $smm_role_permission)){ header('location:'.base_url().'Employee/dashboard'); }

    $this->form_validation->set_rules('employee_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $employee_status = $this->input->post('employee_status');
      if(!isset($employee_status)){ $employee_status = '1'; }
      $leave_type_id = $_POST['leave_type_id'];
      $leave_type_id = implode(',',$leave_type_id);

      $save_data = $_POST;
      $save_data['leave_type_id'] = $leave_type_id;
      $save_data['employee_status'] = $employee_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['employee_addedby'] = $smm_user_id;
      $employee_id = $this->Master_Model->save_data('smm_employee', $save_data);

      if($_FILES['employee_image']['name']){
        $time = time();
        $image_name = 'employee_'.$employee_id.'_'.$time;
        $config['upload_path'] = 'assets/images/employee/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['employee_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('employee_image') && $employee_id && $image_name && $ext && $filename){
          $employee_image_up['employee_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('employee_id', $employee_id, 'smm_employee', $employee_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Employee/employee');
    }
    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    // $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    // $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    // $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');
    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','role_id','ASC','role');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_name','ASC','smm_designation');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');
    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','office_shift_name','ASC','smm_office_shift');
    $data['employee_report_to_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');

    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_id','ASC','smm_employee');
    $data['page'] = 'Employee';
    $data['smm_role_permission'] = $smm_role_permission;
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Employee/employee', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Education Level...
  public function edit_employee($employee_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // if(!in_array("user3", $smm_role_permission)){ header('location:'.base_url().'Employee/dashboard'); }

    $this->form_validation->set_rules('employee_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $employee_status = $this->input->post('employee_status');
      if(!isset($employee_status)){ $employee_status = '1'; }
      $leave_type_id = $_POST['leave_type_id'];
      $leave_type_id = implode(',',$leave_type_id);
      $update_data = $_POST;
      unset($update_data['old_employee_image']);
      $update_data['leave_type_id'] = $leave_type_id;
      $update_data['employee_status'] = $employee_status;
      $update_data['employee_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('employee_id', $employee_id, 'smm_employee', $update_data);

      if($_FILES['employee_image']['name']){
        $time = time();
        $image_name = 'employee_'.$employee_id.'_'.$time;
        $config['upload_path'] = 'assets/images/employee/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['employee_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('employee_image') && $employee_id && $image_name && $ext && $filename){
          $employee_image_up['employee_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('employee_id', $employee_id, 'smm_employee', $employee_image_up);
          if($_POST['old_employee_img']){ unlink("assets/images/employee/".$_POST['old_employee_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Employee/employee');
    }

    $employee_info = $this->Master_Model->get_info_arr('employee_id',$employee_id,'smm_employee');
    if(!$employee_info){ header('location:'.base_url().'Employee/employee'); }
    $data['update'] = 'update';
    $data['update_user'] = 'update';
    $data['employee_info'] = $employee_info[0];
    $data['act_link'] = base_url().'Employee/edit_user/'.$employee_id;
    $country_id = $employee_info[0]['country_id'];
    $state_id = $employee_info[0]['state_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    // $data['district_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','role_id','ASC','role');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_name','ASC','smm_designation');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');
    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','office_shift_name','ASC','smm_office_shift');
    $data['employee_report_to_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_name','ASC','smm_employee');
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');

    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_id','ASC','smm_employee');
    $data['page'] = 'Edit User';
    $data['smm_role_permission'] = $smm_role_permission;
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Employee/employee', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Education Level...
  public function delete_user($employee_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // if(!in_array("user4", $smm_role_permission)){ header('location:'.base_url().'Employee/dashboard'); }
    else{
      $this->Master_Model->delete_info('user_id', $user_id, 'user');
      $this->session->set_flashdata('delete_success','success');
      header('location:'.base_url().'Employee/employee');
    }
  }






/*******************************    Freelancer      ****************************/

  // Add Freelancer...
  public function freelancer(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // if(!in_array("user1", $smm_role_permission)){ header('location:'.base_url().'Employee/dashboard'); }

    $this->form_validation->set_rules('freelancer_name', 'Freelancer Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $freelancer_status = $this->input->post('freelancer_status');
      if(!isset($freelancer_status)){ $freelancer_status = '1'; }
      $save_data = $_POST;
      $save_data['freelancer_status'] = $freelancer_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['freelancer_addedby'] = $smm_user_id;
      $freelancer_id = $this->Master_Model->save_data('smm_freelancer', $save_data);

      if($_FILES['freelancer_image']['name']){
        $time = time();
        $image_name = 'freelancer_'.$freelancer_id.'_'.$time;
        $config['upload_path'] = 'assets/images/freelancer/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['freelancer_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('freelancer_image') && $freelancer_id && $image_name && $ext && $filename){
          $freelancer_image_up['freelancer_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('freelancer_id', $freelancer_id, 'smm_freelancer', $freelancer_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Employee/freelancer');
    }
    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    // $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    // $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    // $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');
    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','role_id','ASC','role');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_name','ASC','smm_designation');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');
    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','office_shift_name','ASC','smm_office_shift');
    $data['freelancer_report_to_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','user_name','ASC','user');
    // $data['leave_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_category_name','ASC','smm_leave_category');

    $data['freelancer_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','freelancer_id','ASC','smm_freelancer');
    $data['page'] = 'Freelancer';
    $data['smm_role_permission'] = $smm_role_permission;
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Employee/freelancer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Freelancer...
  public function edit_freelancer($freelancer_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // if(!in_array("freelancer3", $smm_role_permission)){ header('location:'.base_url().'Employee/dashboard'); }

    $this->form_validation->set_rules('freelancer_name', 'Freelancer Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $freelancer_status = $this->input->post('freelancer_status');
      if(!isset($freelancer_status)){ $freelancer_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_freelancer_image']);
      $update_data['freelancer_status'] = $freelancer_status;
      $update_data['freelancer_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('freelancer_id', $freelancer_id, 'smm_freelancer', $update_data);

      if($_FILES['freelancer_image']['name']){
        $time = time();
        $image_name = 'freelancer_'.$freelancer_id.'_'.$time;
        $config['upload_path'] = 'assets/images/freelancer/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['freelancer_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('freelancer_image') && $freelancer_id && $image_name && $ext && $filename){
          $freelancer_image_up['freelancer_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('freelancer_id', $freelancer_id, 'smm_freelancer', $freelancer_image_up);
          if($_POST['old_freelancer_img']){ unlink("assets/images/freelancer/".$_POST['old_freelancer_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Employee/freelancer');
    }

    $freelancer_info = $this->Master_Model->get_info_arr('freelancer_id',$freelancer_id,'smm_freelancer');
    if(!$freelancer_info){ header('location:'.base_url().'Employee/freelancer'); }
    $data['update'] = 'update';
    $data['update_freelancer'] = 'update';
    $data['freelancer_info'] = $freelancer_info[0];
    $data['act_link'] = base_url().'Employee/edit_freelancer/'.$freelancer_id;
    $country_id = $freelancer_info[0]['country_id'];
    $state_id = $freelancer_info[0]['state_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    // $data['district_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','role_id','ASC','role');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_name','ASC','smm_designation');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');
    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','office_shift_name','ASC','smm_office_shift');
    $data['freelancer_report_to_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','user_name','ASC','user');
    // $data['leave_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_category_name','ASC','smm_leave_category');

    $data['freelancer_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','freelancer_id','ASC','smm_freelancer');
    $data['page'] = 'Freelancer User';
    $data['smm_role_permission'] = $smm_role_permission;
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Employee/freelancer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Freelancer...
  public function delete_freelancer($freelancer_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    // if(!in_array("freelancer4", $smm_role_permission)){ header('location:'.base_url().'Employee/dashboard'); }
    else{
      $this->Master_Model->delete_info('freelancer_id', $freelancer_id, 'smm_freelancer');
      $this->session->set_flashdata('delete_success','success');
      header('location:'.base_url().'Employee/freelancer');
    }
  }
}
?>
