<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }

/********************************* Reseller ***********************************/

  // Add Reseller...
  public function reseller(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('reseller_name', 'reseller title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $reseller_status = $this->input->post('reseller_status');
      if(!isset($reseller_status)){ $reseller_status = '1'; }
      $save_data = $_POST;
      $save_data['reseller_status'] = $reseller_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['reseller_addedby'] = $smm_user_id;
      $reseller_id = $this->Master_Model->save_data('smm_reseller', $save_data);

      // Save in Web Setting...
      $save_web_setting = array(
        'company_id' => $smm_company_id,
        'reseller_id' => $reseller_id,
        'web_setting_name' => $_POST['reseller_name'],
        'web_setting_address' => $_POST['reseller_address'],
        'country_id' => $_POST['country_id'],
        'state_id' => $_POST['state_id'],
        'city_id' => $_POST['city_id'],
        'web_setting_addedby_type' => 2,
      );
      $web_setting_id = $this->Master_Model->save_data('smm_web_setting', $save_web_setting);

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
          $reseller_logo_up['reseller_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $reseller_logo_up);
          // unlink("assets/images/tours/".$reseller_logo_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Finance/reseller');
    }
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');

    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'reseller_added_type','1','','','','','reseller_id','DESC','smm_reseller');
    $data['page'] = 'Reseller';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/reseller', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Reseller...
  public function edit_reseller($reseller_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('reseller_name', 'reseller title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $reseller_status = $this->input->post('reseller_status');
      if(!isset($reseller_status)){ $reseller_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_reseller_logo']);
      $update_data['reseller_status'] = $reseller_status;
      // $update_data['reseller_addedby'] = $smm_user_id;
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
          $reseller_logo_up['reseller_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $reseller_logo_up);
          if($_POST['old_reseller_logo']){ unlink("assets/images/reseller/".$_POST['old_reseller_logo']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Finance/reseller');
    }
    $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$reseller_id,'smm_reseller');
    if(!$reseller_info){ header('location:'.base_url().'Finance/reseller'); }
    $data['update'] = 'update';
    $data['update_reseller'] = 'update';
    $data['reseller_info'] = $reseller_info[0];
    $data['act_link'] = base_url().'Finance/edit_reseller/'.$reseller_id;
    $state_id = $reseller_info[0]['state_id'];
    $country_id = $reseller_info[0]['country_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','branch_name','ASC','smm_branch');

    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'reseller_added_type','1','','','','','reseller_id','DESC','smm_reseller');
    $data['page'] = 'Edit Reseller';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/reseller', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Reseller...
  public function delete_reseller($reseller_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $reseller_info = $this->Master_Model->get_info_arr_fields('reseller_logo, reseller_id', 'reseller_id', $reseller_id, 'smm_reseller');
    if($reseller_info){
      $reseller_logo = $reseller_info[0]['reseller_logo'];
      if($reseller_logo){ unlink("assets/images/reseller/".$reseller_logo); }
    }
    $this->Master_Model->delete_info('reseller_id', $reseller_id, 'smm_reseller');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Finance/reseller');
  }


/********************************* Bank Account ***********************************/

  // Add Bank Account...
  public function bank_account(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('bank_account_name', 'Bank Account Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $bank_account_status = $this->input->post('bank_account_status');
      if(!isset($bank_account_status)){ $bank_account_status = '1'; }
      $save_data = $_POST;
      $save_data['bank_account_status'] = $bank_account_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['bank_account_addedby'] = $smm_user_id;
      $bank_account_id = $this->Master_Model->save_data('smm_bank_account', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Finance/bank_account');
    }
    $data['bank_account_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','bank_account_id','DESC','smm_bank_account');
    $data['page'] = 'Bank Account';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/bank_account', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Bank Account...
  public function edit_bank_account($bank_account_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('bank_account_name', 'Bank Account Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $bank_account_status = $this->input->post('bank_account_status');
      if(!isset($bank_account_status)){ $bank_account_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_bank_account_logo']);
      $update_data['bank_account_status'] = $bank_account_status;
      $update_data['bank_account_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('bank_account_id', $bank_account_id, 'smm_bank_account', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Finance/bank_account');
    }
    $bank_account_info = $this->Master_Model->get_info_arr('bank_account_id',$bank_account_id,'smm_bank_account');
    if(!$bank_account_info){ header('location:'.base_url().'Finance/bank_account'); }
    $data['update'] = 'update';
    $data['update_bank_account'] = 'update';
    $data['bank_account_info'] = $bank_account_info[0];
    $data['act_link'] = base_url().'Finance/edit_bank_account/'.$bank_account_id;

    $data['bank_account_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','bank_account_id','DESC','smm_bank_account');
    $data['page'] = 'Edit Bank Account';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/bank_account', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Bank Account...
  public function delete_bank_account($bank_account_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('bank_account_id', $bank_account_id, 'smm_bank_account');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Finance/bank_account');
  }


/********************************* Deposit ***********************************/

  // Add Deposit...
  public function deposit(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('deposit_date', 'Deposit', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $deposit_status = $this->input->post('deposit_status');
      if(!isset($deposit_status)){ $deposit_status = '1'; }
      $save_data = $_POST;
      $save_data['deposit_status'] = $deposit_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['deposit_addedby'] = $smm_user_id;
      $deposit_id = $this->Master_Model->save_data('smm_deposit', $save_data);

      if($_FILES['deposit_image']['name']){
        $time = time();
        $image_name = 'deposit_'.$deposit_id.'_'.$time;
        $config['upload_path'] = 'assets/images/deposit/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['deposit_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('deposit_image') && $deposit_id && $image_name && $ext && $filename){
          $deposit_image_up['deposit_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('deposit_id', $deposit_id, 'smm_deposit', $deposit_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Finance/deposit');
    }
    $data['bank_account_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','bank_account_name','ASC','smm_bank_account');

    $data['deposit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','deposit_id','DESC','smm_deposit');
    $data['page'] = 'Deposit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/deposit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Deposit...
  public function edit_deposit($deposit_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('deposit_date', 'Deposit', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $deposit_status = $this->input->post('deposit_status');
      if(!isset($deposit_status)){ $deposit_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_deposit_image']);
      $update_data['deposit_status'] = $deposit_status;
      $update_data['deposit_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('deposit_id', $deposit_id, 'smm_deposit', $update_data);

      if($_FILES['deposit_image']['name']){
        $time = time();
        $image_name = 'deposit_'.$deposit_id.'_'.$time;
        $config['upload_path'] = 'assets/images/deposit/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['deposit_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('deposit_image') && $deposit_id && $image_name && $ext && $filename){
          $deposit_image_up['deposit_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('deposit_id', $deposit_id, 'smm_deposit', $deposit_image_up);
          if($_POST['old_deposit_image']){ unlink("assets/images/deposit/".$_POST['old_deposit_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Finance/deposit');
    }
    $deposit_info = $this->Master_Model->get_info_arr('deposit_id',$deposit_id,'smm_deposit');
    if(!$deposit_info){ header('location:'.base_url().'Finance/deposit'); }
    $data['update'] = 'update';
    $data['update_deposit'] = 'update';
    $data['deposit_info'] = $deposit_info[0];
    $data['act_link'] = base_url().'Finance/edit_deposit/'.$deposit_id;
    $data['bank_account_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','bank_account_name','ASC','smm_bank_account');

    $data['deposit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','deposit_id','DESC','smm_deposit');
    $data['page'] = 'Edit Deposit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/deposit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Deposit...
  public function delete_deposit($deposit_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $deposit_info = $this->Master_Model->get_info_arr_fields('deposit_image, deposit_id', 'deposit_id', $deposit_id, 'smm_deposit');
    if($deposit_info){
      $deposit_image = $deposit_info[0]['deposit_image'];
      if($deposit_image){ unlink("assets/images/deposit/".$deposit_image); }
    }
    $this->Master_Model->delete_info('deposit_id', $deposit_id, 'smm_deposit');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Finance/deposit');
  }




/********************************* Expense ***********************************/
  // Add Expense...
  public function expense(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('expense_name', 'Expense Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $expense_status = $this->input->post('expense_status');
      if(!isset($expense_status)){ $expense_status = '1'; }
      $save_data = $_POST;
      unset($save_data['files']);
      $save_data['expense_status'] = $expense_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['expense_addedby'] = $smm_user_id;
      $expense_id = $this->Master_Model->save_data('smm_expense', $save_data);

      if($_FILES['expense_image']['name']){
        $time = time();
        $image_name = 'expense_'.$expense_id.'_'.$time;
        $config['upload_path'] = 'assets/images/expense/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['expense_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('expense_image') && $expense_id && $image_name && $ext && $filename){
          $expense_image_up['expense_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('expense_id', $expense_id, 'smm_expense', $expense_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Finance/expense');
    }
    $data['expense_no'] = $this->Master_Model->get_count_no($smm_company_id, 'expense_no', 'smm_expense');
    $data['expense_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','expense_type_name','ASC','smm_expense_type');

    $data['expense_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','expense_id','ASC','smm_expense');
    $data['page'] = 'Expense';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/expense', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Expense...
  public function edit_expense($expense_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('expense_name', 'Expense Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $expense_status = $this->input->post('expense_status');
      if(!isset($expense_status)){ $expense_status = '1'; }
      $update_data = $_POST;
      unset($update_data['files']);
      unset($update_data['old_expense_image']);
      $update_data['expense_status'] = $expense_status;
      $update_data['expense_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('expense_id', $expense_id, 'smm_expense', $update_data);

      if($_FILES['expense_image']['name']){
        $time = time();
        $image_name = 'expense_'.$expense_id.'_'.$time;
        $config['upload_path'] = 'assets/images/expense/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['expense_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('expense_image') && $expense_id && $image_name && $ext && $filename){
          $expense_image_up['expense_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('expense_id', $expense_id, 'smm_expense', $expense_image_up);
          if($_POST['old_expense_image']){ unlink("assets/images/expense/".$_POST['old_expense_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Finance/expense');
    }

    $expense_info = $this->Master_Model->get_info_arr('expense_id',$expense_id,'smm_expense');
    if(!$expense_info){ header('location:'.base_url().'Finance/expense'); }
    $data['update'] = 'update';
    $data['update_expense'] = 'update';
    $data['expense_info'] = $expense_info[0];
    $data['act_link'] = base_url().'Finance/edit_expense/'.$expense_id;
    $data['expense_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','expense_type_name','ASC','smm_expense_type');

    $data['expense_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','expense_id','ASC','smm_expense');
    $data['page'] = 'Edit Expense';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/expense', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Expense...
  public function delete_expense($expense_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $expense_info = $this->Master_Model->get_info_arr_fields('expense_image, expense_id', 'expense_id', $expense_id, 'smm_expense');
    if($expense_info){
      $expense_image = $expense_info[0]['expense_image'];
      if($expense_image){ unlink("assets/images/expense/".$expense_image); }
    }
    $this->Master_Model->delete_info('expense_id', $expense_id, 'smm_expense');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Finance/expense');
  }

/********************************* Fund ***********************************/
  // Add Fund...
  public function fund(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('fund_no', 'Fund Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $fund_status = $this->input->post('fund_status');
      if(!isset($fund_status)){ $fund_status = '1'; }
      $save_data = $_POST;
      unset($save_data['files']);
      $save_data['fund_status'] = $fund_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['fund_addedby'] = $smm_user_id;
      $fund_id = $this->Master_Model->save_data('smm_fund', $save_data);

      if($_FILES['fund_image']['name']){
        $time = time();
        $image_name = 'fund_'.$fund_id.'_'.$time;
        $config['upload_path'] = 'assets/images/fund/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['fund_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('fund_image') && $fund_id && $image_name && $ext && $filename){
          $fund_image_up['fund_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('fund_id', $fund_id, 'smm_fund', $fund_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Finance/fund');
    }
    $data['fund_no'] = $this->Master_Model->get_count_no($smm_company_id, 'fund_no', 'smm_fund');
    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','reseller_name','ASC','smm_reseller');

    $data['fund_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','fund_id','ASC','smm_fund');
    $data['page'] = 'Fund';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/fund', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Fund...
  public function edit_fund($fund_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('fund_no', 'Fund Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $fund_status = $this->input->post('fund_status');
      if(!isset($fund_status)){ $fund_status = '1'; }
      $update_data = $_POST;
      unset($update_data['files']);
      unset($update_data['old_fund_image']);
      $update_data['fund_status'] = $fund_status;
      $update_data['fund_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('fund_id', $fund_id, 'smm_fund', $update_data);

      if($_FILES['fund_image']['name']){
        $time = time();
        $image_name = 'fund_'.$fund_id.'_'.$time;
        $config['upload_path'] = 'assets/images/fund/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['fund_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('fund_image') && $fund_id && $image_name && $ext && $filename){
          $fund_image_up['fund_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('fund_id', $fund_id, 'smm_fund', $fund_image_up);
          if($_POST['old_fund_image']){ unlink("assets/images/fund/".$_POST['old_fund_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Finance/fund');
    }

    $fund_info = $this->Master_Model->get_info_arr('fund_id',$fund_id,'smm_fund');
    if(!$fund_info){ header('location:'.base_url().'Finance/fund'); }
    $data['update'] = 'update';
    $data['update_fund'] = 'update';
    $data['fund_info'] = $fund_info[0];
    $data['act_link'] = base_url().'Finance/edit_fund/'.$fund_id;
    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','reseller_name','ASC','smm_reseller');

    $data['fund_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','fund_id','ASC','smm_fund');
    $data['page'] = 'Edit Fund';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/fund', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Fund...
  public function delete_fund($fund_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $fund_info = $this->Master_Model->get_info_arr_fields('fund_image, fund_id', 'fund_id', $fund_id, 'smm_fund');
    if($fund_info){
      $fund_image = $fund_info[0]['fund_image'];
      if($fund_image){ unlink("assets/images/fund/".$fund_image); }
    }
    $this->Master_Model->delete_info('fund_id', $fund_id, 'smm_fund');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Finance/fund');
  }

/********************************* Invoice ***********************************/
  // Add Invoice...
  public function invoice(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('invoice_no', 'Invoice Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      unset($save_data['input']);
      $save_data['company_id'] = $smm_company_id;
      $save_data['invoice_addedby'] = $smm_user_id;
      $invoice_id = $this->Master_Model->save_data('smm_invoice', $save_data);

      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          $multi_data['invoice_id'] = $invoice_id;
          $multi_data['company_id'] = $smm_company_id;
          $multi_data['invoice_item_addedby'] = $smm_user_id;
          $this->db->insert('smm_invoice_item', $multi_data);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Finance/invoice');
    }
    $data['invoice_no'] = $this->Master_Model->get_count_no($smm_company_id, 'invoice_no', 'smm_invoice');
    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','reseller_name','ASC','smm_reseller');
    // $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['package_list'] = $this->Master_Model->package_list($smm_company_id);

    $data['invoice_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','invoice_id','ASC','smm_invoice');
    $data['page'] = 'Invoice';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/invoice', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Invoice...
  public function edit_invoice($invoice_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('invoice_no', 'Invoice Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['input']);
      $update_data['invoice_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('invoice_id', $invoice_id, 'smm_invoice', $update_data);

      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          if(isset($multi_data['invoice_item_id'])){
            $invoice_item_id = $multi_data['invoice_item_id'];
            if(!isset($multi_data['invoice_item_qty'])){
              $this->Master_Model->delete_info('invoice_item_id', $invoice_item_id, 'smm_invoice_item');
            }else{
              $multi_data['invoice_item_addedby'] = $smm_user_id;
              $this->Master_Model->update_info('invoice_item_id', $invoice_item_id, 'smm_invoice_item', $multi_data);
            }
          }
          else{
            $multi_data['invoice_id'] = $invoice_id;
            $multi_data['company_id'] = $smm_company_id;
            $multi_data['invoice_item_addedby'] = $smm_user_id;
            $this->db->insert('smm_invoice_item', $multi_data);
          }
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Finance/invoice');
    }

    $invoice_info = $this->Master_Model->get_info_arr('invoice_id',$invoice_id,'smm_invoice');
    if(!$invoice_info){ header('location:'.base_url().'Finance/invoice'); }
    $data['update'] = 'update';
    $data['update_invoice'] = 'update';
    $data['invoice_info'] = $invoice_info[0];
    $data['act_link'] = base_url().'Finance/edit_invoice/'.$invoice_id;
    $reseller_id =  $invoice_info[0]['reseller_id'];
    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','reseller_name','ASC','smm_reseller');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'client_id',$reseller_id,'','','','','project_name','ASC','smm_project');
    $data['package_list'] = $this->Master_Model->package_list($smm_company_id);
    $data['invoice_item_list'] = $this->Master_Model->get_list_by_id3('','invoice_id',$invoice_id,'','','','','invoice_item_id','ASC','smm_invoice_item');

    $data['invoice_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','invoice_id','ASC','smm_invoice');
    $data['page'] = 'Edit Invoice';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/invoice', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Invoice...
  public function delete_invoice_file(){
    $invoice_file_id = $this->input->post('invoice_file_id');
    $invoice_file_info = $this->Master_Model->get_info_arr_fields('invoice_file_image, invoice_file_id', 'invoice_file_id', $invoice_file_id, 'smm_invoice_file');
    if($invoice_file_info){
      $invoice_file_image = $invoice_file_info[0]['invoice_file_image'];
      if($invoice_file_image){ unlink("assets/images/invoice/".$invoice_file_image); }
    }
    $this->Master_Model->delete_info('invoice_file_id', $invoice_file_id, 'smm_invoice_file');
  }

  // Delete Invoice...
  public function delete_invoice($invoice_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $invoice_file_list = $this->Master_Model->get_list_by_id3($smm_company_id,'invoice_id',$invoice_id,'','','','','invoice_file_id','ASC','smm_invoice_file');
    foreach ($invoice_file_list as $invoice_file_list1) {
      $invoice_file_image = $invoice_file_list1->invoice_file_image;
      if($invoice_file_image){ unlink("assets/images/invoice/".$invoice_file_image); }
    }
    $this->Master_Model->delete_info('invoice_id', $invoice_id, 'smm_invoice');
    $this->Master_Model->delete_info('invoice_id', $invoice_id, 'smm_invoice_file');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Finance/invoice');
  }

/********************************* Invoice Payments ***********************************/
  // Add Invoice Payments...
  public function invoice_payment(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $data['page'] = 'Invoice Payments';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Finance/invoice_payment', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


/**************************************************************************************************/

  public function get_project_by_reseller(){
    $smm_company_id = $this->session->userdata('smm_company_id');
    $reseller_id = $this->input->post('reseller_id');
    $project_list = $this->Master_Model->get_list_by_id3($smm_company_id,'client_id',$reseller_id,'','','','','project_name','ASC','smm_project');
    echo "<option value='' selected >Select Project</option>";
    foreach ($project_list as $list) {
      echo "<option value='".$list->project_id."'> ".$list->project_name." </option>";
    }
  }

}
?>
