<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_setting extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }

/********************************************************************************/
/*                                  Setting                                     */
/********************************************************************************/

/********************************* Award Type ***********************************/
  // Add Award Type...
  public function award_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('award_type_name', 'Award Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $award_type_status = $this->input->post('award_type_status');
      if(!isset($award_type_status)){ $award_type_status = '1'; }
      $save_data = $_POST;
      $save_data['award_type_status'] = $award_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['award_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_award_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/award_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/award_type';

    $data['award_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','award_type_id','ASC','smm_award_type');
    $data['setting_menu'] = 'award_type';
    $data['page'] = 'Award Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/award_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Award Type...
  public function edit_award_type($award_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('award_type_name', 'Award Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $award_type_status = $this->input->post('award_type_status');
      if(!isset($award_type_status)){ $award_type_status = '1'; }
      $update_data = $_POST;
      $update_data['award_type_status'] = $award_type_status;
      $update_data['award_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('award_type_id', $award_type_id, 'smm_award_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/award_type');
    }

    $award_type_info = $this->Master_Model->get_info_arr('award_type_id',$award_type_id,'smm_award_type');
    if(!$award_type_info){ header('location:'.base_url().'Hr_setting/award_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['award_type_info'] = $award_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_award_type/'.$award_type_id;

    $data['award_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','award_type_id','ASC','smm_award_type');
    $data['setting_menu'] = 'award_type';
    $data['page'] = 'Edit Award Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/award_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Award Type...
  public function delete_award_type($award_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('award_type_id', $award_type_id, 'smm_award_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/award_type');
  }

/********************************* Company Type ***********************************/
  // Add Company Type...
  public function company_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('company_type_name', 'Company Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $company_type_status = $this->input->post('company_type_status');
      if(!isset($company_type_status)){ $company_type_status = '1'; }
      $save_data = $_POST;
      $save_data['company_type_status'] = $company_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['company_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_company_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/company_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/company_type';

    $data['company_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','company_type_id','ASC','smm_company_type');
    $data['setting_menu'] = 'company_type';
    $data['page'] = 'Company Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/company_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Company Type...
  public function edit_company_type($company_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('company_type_name', 'Company Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $company_type_status = $this->input->post('company_type_status');
      if(!isset($company_type_status)){ $company_type_status = '1'; }
      $update_data = $_POST;
      $update_data['company_type_status'] = $company_type_status;
      $update_data['company_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('company_type_id', $company_type_id, 'smm_company_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/company_type');
    }

    $company_type_info = $this->Master_Model->get_info_arr('company_type_id',$company_type_id,'smm_company_type');
    if(!$company_type_info){ header('location:'.base_url().'Hr_setting/company_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['company_type_info'] = $company_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_company_type/'.$company_type_id;

    $data['company_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','company_type_id','ASC','smm_company_type');
    $data['setting_menu'] = 'company_type';
    $data['page'] = 'Edit Company Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/company_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Company Type...
  public function delete_company_type($company_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('company_type_id', $company_type_id, 'smm_company_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/company_type');
  }

/********************************* Document Type ***********************************/
  // Add Document Type...
  public function document_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('document_type_name', 'Document Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $document_type_status = $this->input->post('document_type_status');
      if(!isset($document_type_status)){ $document_type_status = '1'; }
      $save_data = $_POST;
      $save_data['document_type_status'] = $document_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['document_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_document_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/document_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/document_type';

    $data['document_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','document_type_id','ASC','smm_document_type');
    $data['setting_menu'] = 'document_type';
    $data['page'] = 'Document Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/document_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Document Type...
  public function edit_document_type($document_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('document_type_name', 'Document Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $document_type_status = $this->input->post('document_type_status');
      if(!isset($document_type_status)){ $document_type_status = '1'; }
      $update_data = $_POST;
      $update_data['document_type_status'] = $document_type_status;
      $update_data['document_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('document_type_id', $document_type_id, 'smm_document_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/document_type');
    }

    $document_type_info = $this->Master_Model->get_info_arr('document_type_id',$document_type_id,'smm_document_type');
    if(!$document_type_info){ header('location:'.base_url().'Hr_setting/document_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['document_type_info'] = $document_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_document_type/'.$document_type_id;

    $data['document_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','document_type_id','ASC','smm_document_type');
    $data['setting_menu'] = 'document_type';
    $data['page'] = 'Edit Document Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/document_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Document Type...
  public function delete_document_type($document_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('document_type_id', $document_type_id, 'smm_document_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/document_type');
  }

/********************************* Education Information ***********************************/
  // Add Education Information...
  public function education_info(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('education_info_name', 'Education Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $education_info_status = $this->input->post('education_info_status');
      if(!isset($education_info_status)){ $education_info_status = '1'; }
      $save_data = $_POST;
      $save_data['education_info_status'] = $education_info_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['education_info_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_education_info', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/education_info');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/education_info';

    $data['education_info_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','education_info_id','ASC','smm_education_info');
    $data['setting_menu'] = 'education_info';
    $data['page'] = 'Education Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/education_info', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Education Information...
  public function edit_education_info($education_info_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('education_info_name', 'Education Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $education_info_status = $this->input->post('education_info_status');
      if(!isset($education_info_status)){ $education_info_status = '1'; }
      $update_data = $_POST;
      $update_data['education_info_status'] = $education_info_status;
      $update_data['education_info_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('education_info_id', $education_info_id, 'smm_education_info', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/education_info');
    }

    $education_info_info = $this->Master_Model->get_info_arr('education_info_id',$education_info_id,'smm_education_info');
    if(!$education_info_info){ header('location:'.base_url().'Hr_setting/education_info'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['education_info_info'] = $education_info_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_education_info/'.$education_info_id;

    $data['education_info_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','education_info_id','ASC','smm_education_info');
    $data['setting_menu'] = 'education_info';
    $data['page'] = 'Edit Education Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/education_info', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Education Information...
  public function delete_education_info($education_info_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('education_info_id', $education_info_id, 'smm_education_info');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/education_info');
  }

/********************************* Expense Type ***********************************/
  // Add Expense Type...
  public function expense_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('expense_type_name', 'Expense Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $expense_type_status = $this->input->post('expense_type_status');
      if(!isset($expense_type_status)){ $expense_type_status = '1'; }
      $save_data = $_POST;
      $save_data['expense_type_status'] = $expense_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['expense_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_expense_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/expense_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/expense_type';

    $data['expense_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','expense_type_id','ASC','smm_expense_type');
    $data['setting_menu'] = 'expense_type';
    $data['page'] = 'Expense Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/expense_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Expense Type...
  public function edit_expense_type($expense_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('expense_type_name', 'Expense Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $expense_type_status = $this->input->post('expense_type_status');
      if(!isset($expense_type_status)){ $expense_type_status = '1'; }
      $update_data = $_POST;
      $update_data['expense_type_status'] = $expense_type_status;
      $update_data['expense_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('expense_type_id', $expense_type_id, 'smm_expense_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/expense_type');
    }

    $expense_type_info = $this->Master_Model->get_info_arr('expense_type_id',$expense_type_id,'smm_expense_type');
    if(!$expense_type_info){ header('location:'.base_url().'Hr_setting/expense_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['expense_type_info'] = $expense_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_expense_type/'.$expense_type_id;

    $data['expense_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','expense_type_id','ASC','smm_expense_type');
    $data['setting_menu'] = 'expense_type';
    $data['page'] = 'Edit Expense Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/expense_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Expense Type...
  public function delete_expense_type($expense_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('expense_type_id', $expense_type_id, 'smm_expense_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/expense_type');
  }

/********************************* Contract Information ***********************************/
  // Add Contract Information...
  public function contract_info(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('contract_info_name', 'Contract Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $contract_info_status = $this->input->post('contract_info_status');
      if(!isset($contract_info_status)){ $contract_info_status = '1'; }
      $save_data = $_POST;
      $save_data['contract_info_status'] = $contract_info_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['contract_info_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_contract_info', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/contract_info');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/contract_info';

    $data['contract_info_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','contract_info_id','ASC','smm_contract_info');
    $data['setting_menu'] = 'contract_info';
    $data['page'] = 'Contract Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/contract_info', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Contract Information...
  public function edit_contract_info($contract_info_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('contract_info_name', 'Contract Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $contract_info_status = $this->input->post('contract_info_status');
      if(!isset($contract_info_status)){ $contract_info_status = '1'; }
      $update_data = $_POST;
      $update_data['contract_info_status'] = $contract_info_status;
      $update_data['contract_info_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('contract_info_id', $contract_info_id, 'smm_contract_info', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/contract_info');
    }

    $contract_info_info = $this->Master_Model->get_info_arr('contract_info_id',$contract_info_id,'smm_contract_info');
    if(!$contract_info_info){ header('location:'.base_url().'Hr_setting/contract_info'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['contract_info_info'] = $contract_info_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_contract_info/'.$contract_info_id;

    $data['contract_info_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','contract_info_id','ASC','smm_contract_info');
    $data['setting_menu'] = 'contract_info';
    $data['page'] = 'Edit Contract Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/contract_info', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Contract Information...
  public function delete_contract_info($contract_info_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('contract_info_id', $contract_info_id, 'smm_contract_info');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/contract_info');
  }

/********************************* Employee Exit Type ***********************************/
  // Add Employee Exit Type...
  public function employee_exit_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_exit_type_name', 'Employee Exit Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $employee_exit_type_status = $this->input->post('employee_exit_type_status');
      if(!isset($employee_exit_type_status)){ $employee_exit_type_status = '1'; }
      $save_data = $_POST;
      $save_data['employee_exit_type_status'] = $employee_exit_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['employee_exit_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_employee_exit_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/employee_exit_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/employee_exit_type';

    $data['employee_exit_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_exit_type_id','ASC','smm_employee_exit_type');
    $data['setting_menu'] = 'employee_exit_type';
    $data['page'] = 'Employee Exit Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/employee_exit_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Employee Exit Type...
  public function edit_employee_exit_type($employee_exit_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_exit_type_name', 'Employee Exit Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $employee_exit_type_status = $this->input->post('employee_exit_type_status');
      if(!isset($employee_exit_type_status)){ $employee_exit_type_status = '1'; }
      $update_data = $_POST;
      $update_data['employee_exit_type_status'] = $employee_exit_type_status;
      $update_data['employee_exit_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('employee_exit_type_id', $employee_exit_type_id, 'smm_employee_exit_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/employee_exit_type');
    }

    $employee_exit_type_info = $this->Master_Model->get_info_arr('employee_exit_type_id',$employee_exit_type_id,'smm_employee_exit_type');
    if(!$employee_exit_type_info){ header('location:'.base_url().'Hr_setting/employee_exit_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['employee_exit_type_info'] = $employee_exit_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_employee_exit_type/'.$employee_exit_type_id;

    $data['employee_exit_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_exit_type_id','ASC','smm_employee_exit_type');
    $data['setting_menu'] = 'employee_exit_type';
    $data['page'] = 'Edit Employee Exit Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/employee_exit_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Employee Exit Type...
  public function delete_employee_exit_type($employee_exit_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('employee_exit_type_id', $employee_exit_type_id, 'smm_employee_exit_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/employee_exit_type');
  }

/********************************* Income Type ***********************************/
  // Add Income Type...
  public function income_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('income_type_name', 'Income Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $income_type_status = $this->input->post('income_type_status');
      if(!isset($income_type_status)){ $income_type_status = '1'; }
      $save_data = $_POST;
      $save_data['income_type_status'] = $income_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['income_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_income_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/income_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/income_type';

    $data['income_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','income_type_id','ASC','smm_income_type');
    $data['setting_menu'] = 'income_type';
    $data['page'] = 'Income Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/income_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Income Type...
  public function edit_income_type($income_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('income_type_name', 'Income Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $income_type_status = $this->input->post('income_type_status');
      if(!isset($income_type_status)){ $income_type_status = '1'; }
      $update_data = $_POST;
      $update_data['income_type_status'] = $income_type_status;
      $update_data['income_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('income_type_id', $income_type_id, 'smm_income_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/income_type');
    }

    $income_type_info = $this->Master_Model->get_info_arr('income_type_id',$income_type_id,'smm_income_type');
    if(!$income_type_info){ header('location:'.base_url().'Hr_setting/income_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['income_type_info'] = $income_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_income_type/'.$income_type_id;

    $data['income_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','income_type_id','ASC','smm_income_type');
    $data['setting_menu'] = 'income_type';
    $data['page'] = 'Edit Income Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/income_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Income Type...
  public function delete_income_type($income_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('income_type_id', $income_type_id, 'smm_income_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/income_type');
  }

/********************************* Job Category ***********************************/
  // Add Job Category...
  public function job_category(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('job_category_name', 'Job Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $job_category_status = $this->input->post('job_category_status');
      if(!isset($job_category_status)){ $job_category_status = '1'; }
      $save_data = $_POST;
      $save_data['job_category_status'] = $job_category_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['job_category_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_job_category', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/job_category');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/job_category';

    $data['job_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','job_category_id','ASC','smm_job_category');
    $data['setting_menu'] = 'job_category';
    $data['page'] = 'Job Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/job_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Job Category...
  public function edit_job_category($job_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('job_category_name', 'Job Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $job_category_status = $this->input->post('job_category_status');
      if(!isset($job_category_status)){ $job_category_status = '1'; }
      $update_data = $_POST;
      $update_data['job_category_status'] = $job_category_status;
      $update_data['job_category_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('job_category_id', $job_category_id, 'smm_job_category', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/job_category');
    }

    $job_category_info = $this->Master_Model->get_info_arr('job_category_id',$job_category_id,'smm_job_category');
    if(!$job_category_info){ header('location:'.base_url().'Hr_setting/job_category'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['job_category_info'] = $job_category_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_job_category/'.$job_category_id;

    $data['job_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','job_category_id','ASC','smm_job_category');
    $data['setting_menu'] = 'job_category';
    $data['page'] = 'Edit Job Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/job_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Job Category...
  public function delete_job_category($job_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('job_category_id', $job_category_id, 'smm_job_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/job_category');
  }

/********************************* Job Type ***********************************/
  // Add Job Type...
  public function job_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('job_type_name', 'Job Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $job_type_status = $this->input->post('job_type_status');
      if(!isset($job_type_status)){ $job_type_status = '1'; }
      $save_data = $_POST;
      $save_data['job_type_status'] = $job_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['job_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_job_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/job_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/job_type';

    $data['job_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','job_type_id','ASC','smm_job_type');
    $data['setting_menu'] = 'job_type';
    $data['page'] = 'Job Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/job_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Job Type...
  public function edit_job_type($job_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('job_type_name', 'Job Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $job_type_status = $this->input->post('job_type_status');
      if(!isset($job_type_status)){ $job_type_status = '1'; }
      $update_data = $_POST;
      $update_data['job_type_status'] = $job_type_status;
      $update_data['job_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('job_type_id', $job_type_id, 'smm_job_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/job_type');
    }

    $job_type_info = $this->Master_Model->get_info_arr('job_type_id',$job_type_id,'smm_job_type');
    if(!$job_type_info){ header('location:'.base_url().'Hr_setting/job_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['job_type_info'] = $job_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_job_type/'.$job_type_id;

    $data['job_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','job_type_id','ASC','smm_job_type');
    $data['setting_menu'] = 'job_type';
    $data['page'] = 'Edit Job Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/job_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Job Type...
  public function delete_job_type($job_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('job_type_id', $job_type_id, 'smm_job_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/job_type');
  }

/********************************* Leave Type ***********************************/
  // Add Leave Type...
  public function leave_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('leave_type_name', 'Leave Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $leave_type_status = $this->input->post('leave_type_status');
      if(!isset($leave_type_status)){ $leave_type_status = '1'; }
      $save_data = $_POST;
      $save_data['leave_type_status'] = $leave_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['leave_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_leave_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/leave_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/leave_type';

    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_type_id','ASC','smm_leave_type');
    $data['setting_menu'] = 'leave_type';
    $data['page'] = 'Leave Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/leave_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Leave Type...
  public function edit_leave_type($leave_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('leave_type_name', 'Leave Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $leave_type_status = $this->input->post('leave_type_status');
      if(!isset($leave_type_status)){ $leave_type_status = '1'; }
      $update_data = $_POST;
      $update_data['leave_type_status'] = $leave_type_status;
      $update_data['leave_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('leave_type_id', $leave_type_id, 'smm_leave_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/leave_type');
    }

    $leave_type_info = $this->Master_Model->get_info_arr('leave_type_id',$leave_type_id,'smm_leave_type');
    if(!$leave_type_info){ header('location:'.base_url().'Hr_setting/leave_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['leave_type_info'] = $leave_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_leave_type/'.$leave_type_id;

    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','leave_type_id','ASC','smm_leave_type');
    $data['setting_menu'] = 'leave_type';
    $data['page'] = 'Edit Leave Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/leave_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Leave Type...
  public function delete_leave_type($leave_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('leave_type_id', $leave_type_id, 'smm_leave_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/leave_type');
  }

/********************************* Religion Information ***********************************/
  // Add Religion Information...
  public function religion_info(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('religion_info_name', 'Religion Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $religion_info_status = $this->input->post('religion_info_status');
      if(!isset($religion_info_status)){ $religion_info_status = '1'; }
      $save_data = $_POST;
      $save_data['religion_info_status'] = $religion_info_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['religion_info_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_religion_info', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/religion_info');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/religion_info';

    $data['religion_info_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','religion_info_id','ASC','smm_religion_info');
    $data['setting_menu'] = 'religion_info';
    $data['page'] = 'Religion Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/religion_info', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Religion Information...
  public function edit_religion_info($religion_info_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('religion_info_name', 'Religion Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $religion_info_status = $this->input->post('religion_info_status');
      if(!isset($religion_info_status)){ $religion_info_status = '1'; }
      $update_data = $_POST;
      $update_data['religion_info_status'] = $religion_info_status;
      $update_data['religion_info_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('religion_info_id', $religion_info_id, 'smm_religion_info', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/religion_info');
    }

    $religion_info_info = $this->Master_Model->get_info_arr('religion_info_id',$religion_info_id,'smm_religion_info');
    if(!$religion_info_info){ header('location:'.base_url().'Hr_setting/religion_info'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['religion_info_info'] = $religion_info_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_religion_info/'.$religion_info_id;

    $data['religion_info_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','religion_info_id','ASC','smm_religion_info');
    $data['setting_menu'] = 'religion_info';
    $data['page'] = 'Edit Religion Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/religion_info', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Religion Information...
  public function delete_religion_info($religion_info_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('religion_info_id', $religion_info_id, 'smm_religion_info');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/religion_info');
  }

/********************************* Security Type ***********************************/
  // Add Security Type...
  public function security_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('security_type_name', 'Security Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $security_type_status = $this->input->post('security_type_status');
      if(!isset($security_type_status)){ $security_type_status = '1'; }
      $save_data = $_POST;
      $save_data['security_type_status'] = $security_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['security_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_security_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/security_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/security_type';

    $data['security_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','security_type_id','ASC','smm_security_type');
    $data['setting_menu'] = 'security_type';
    $data['page'] = 'Security Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/security_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Security Type...
  public function edit_security_type($security_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('security_type_name', 'Security Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $security_type_status = $this->input->post('security_type_status');
      if(!isset($security_type_status)){ $security_type_status = '1'; }
      $update_data = $_POST;
      $update_data['security_type_status'] = $security_type_status;
      $update_data['security_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('security_type_id', $security_type_id, 'smm_security_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/security_type');
    }

    $security_type_info = $this->Master_Model->get_info_arr('security_type_id',$security_type_id,'smm_security_type');
    if(!$security_type_info){ header('location:'.base_url().'Hr_setting/security_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['security_type_info'] = $security_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_security_type/'.$security_type_id;

    $data['security_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','security_type_id','ASC','smm_security_type');
    $data['setting_menu'] = 'security_type';
    $data['page'] = 'Edit Security Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/security_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Security Type...
  public function delete_security_type($security_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('security_type_id', $security_type_id, 'smm_security_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/security_type');
  }

/********************************* Skill Information ***********************************/
  // Add Skill Information...
  public function skill(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('skill_name', 'Skill Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $skill_status = $this->input->post('skill_status');
      if(!isset($skill_status)){ $skill_status = '1'; }
      $save_data = $_POST;
      $save_data['skill_status'] = $skill_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['skill_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_skill', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/skill');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/skill';

    $data['skill_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','skill_id','ASC','smm_skill');
    $data['setting_menu'] = 'skill';
    $data['page'] = 'Skill Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/skill', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Skill Information...
  public function edit_skill($skill_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('skill_name', 'Skill Information Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $skill_status = $this->input->post('skill_status');
      if(!isset($skill_status)){ $skill_status = '1'; }
      $update_data = $_POST;
      $update_data['skill_status'] = $skill_status;
      $update_data['skill_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('skill_id', $skill_id, 'smm_skill', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/skill');
    }

    $skill_info = $this->Master_Model->get_info_arr('skill_id',$skill_id,'smm_skill');
    if(!$skill_info){ header('location:'.base_url().'Hr_setting/skill'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['skill_info'] = $skill_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_skill/'.$skill_id;

    $data['skill_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','skill_id','ASC','smm_skill');
    $data['setting_menu'] = 'skill';
    $data['page'] = 'Edit Skill Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/skill', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Skill Information...
  public function delete_skill($skill_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('skill_id', $skill_id, 'smm_skill');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/skill');
  }

/********************************* Termination Type ***********************************/
  // Add Termination Type...
  public function termination_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('termination_type_name', 'Termination Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $termination_type_status = $this->input->post('termination_type_status');
      if(!isset($termination_type_status)){ $termination_type_status = '1'; }
      $save_data = $_POST;
      $save_data['termination_type_status'] = $termination_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['termination_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_termination_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/termination_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/termination_type';

    $data['termination_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','termination_type_id','ASC','smm_termination_type');
    $data['setting_menu'] = 'termination_type';
    $data['page'] = 'Termination Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/termination_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Termination Type...
  public function edit_termination_type($termination_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('termination_type_name', 'Termination Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $termination_type_status = $this->input->post('termination_type_status');
      if(!isset($termination_type_status)){ $termination_type_status = '1'; }
      $update_data = $_POST;
      $update_data['termination_type_status'] = $termination_type_status;
      $update_data['termination_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('termination_type_id', $termination_type_id, 'smm_termination_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/termination_type');
    }

    $termination_type_info = $this->Master_Model->get_info_arr('termination_type_id',$termination_type_id,'smm_termination_type');
    if(!$termination_type_info){ header('location:'.base_url().'Hr_setting/termination_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['termination_type_info'] = $termination_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_termination_type/'.$termination_type_id;

    $data['termination_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','termination_type_id','ASC','smm_termination_type');
    $data['setting_menu'] = 'termination_type';
    $data['page'] = 'Edit Termination Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/termination_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Termination Type...
  public function delete_termination_type($termination_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('termination_type_id', $termination_type_id, 'smm_termination_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/termination_type');
  }

/********************************* Warning Type ***********************************/
  // Add Warning Type...
  public function warning_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('warning_type_name', 'Warning Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $warning_type_status = $this->input->post('warning_type_status');
      if(!isset($warning_type_status)){ $warning_type_status = '1'; }
      $save_data = $_POST;
      $save_data['warning_type_status'] = $warning_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['warning_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_warning_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/warning_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/warning_type';

    $data['warning_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','warning_type_id','ASC','smm_warning_type');
    $data['setting_menu'] = 'warning_type';
    $data['page'] = 'Warning Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/warning_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Warning Type...
  public function edit_warning_type($warning_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('warning_type_name', 'Warning Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $warning_type_status = $this->input->post('warning_type_status');
      if(!isset($warning_type_status)){ $warning_type_status = '1'; }
      $update_data = $_POST;
      $update_data['warning_type_status'] = $warning_type_status;
      $update_data['warning_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('warning_type_id', $warning_type_id, 'smm_warning_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/warning_type');
    }

    $warning_type_info = $this->Master_Model->get_info_arr('warning_type_id',$warning_type_id,'smm_warning_type');
    if(!$warning_type_info){ header('location:'.base_url().'Hr_setting/warning_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['warning_type_info'] = $warning_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_warning_type/'.$warning_type_id;

    $data['warning_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','warning_type_id','ASC','smm_warning_type');
    $data['setting_menu'] = 'warning_type';
    $data['page'] = 'Edit Warning Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/warning_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Warning Type...
  public function delete_warning_type($warning_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('warning_type_id', $warning_type_id, 'smm_warning_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/warning_type');
  }

/********************************* Travel Arrangement Type ***********************************/
  // Add Travel Arrangement Type...
  public function travel_arr_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('travel_arr_type_name', 'Travel Arrangement Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $travel_arr_type_status = $this->input->post('travel_arr_type_status');
      if(!isset($travel_arr_type_status)){ $travel_arr_type_status = '1'; }
      $save_data = $_POST;
      $save_data['travel_arr_type_status'] = $travel_arr_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['travel_arr_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_travel_arr_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/travel_arr_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/travel_arr_type';

    $data['travel_arr_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','travel_arr_type_id','ASC','smm_travel_arr_type');
    $data['setting_menu'] = 'travel_arr_type';
    $data['page'] = 'Travel Arrangement Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/travel_arr_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Travel Arrangement Type...
  public function edit_travel_arr_type($travel_arr_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('travel_arr_type_name', 'Travel Arrangement Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $travel_arr_type_status = $this->input->post('travel_arr_type_status');
      if(!isset($travel_arr_type_status)){ $travel_arr_type_status = '1'; }
      $update_data = $_POST;
      $update_data['travel_arr_type_status'] = $travel_arr_type_status;
      $update_data['travel_arr_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('travel_arr_type_id', $travel_arr_type_id, 'smm_travel_arr_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/travel_arr_type');
    }

    $travel_arr_type_info = $this->Master_Model->get_info_arr('travel_arr_type_id',$travel_arr_type_id,'smm_travel_arr_type');
    if(!$travel_arr_type_info){ header('location:'.base_url().'Hr_setting/travel_arr_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['travel_arr_type_info'] = $travel_arr_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_travel_arr_type/'.$travel_arr_type_id;

    $data['travel_arr_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','travel_arr_type_id','ASC','smm_travel_arr_type');
    $data['setting_menu'] = 'travel_arr_type';
    $data['page'] = 'Edit Travel Arrangement Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/travel_arr_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Travel Arrangement Type...
  public function delete_travel_arr_type($travel_arr_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('travel_arr_type_id', $travel_arr_type_id, 'smm_travel_arr_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/travel_arr_type');
  }

/********************************* Language ***********************************/
  // Add Language...
  public function language(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('language_name', 'Language Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $language_status = $this->input->post('language_status');
      if(!isset($language_status)){ $language_status = '1'; }
      $save_data = $_POST;
      $save_data['language_status'] = $language_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['language_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_language', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/language');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/language';

    $data['language_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','language_id','ASC','smm_language');
    $data['setting_menu'] = 'language';
    $data['page'] = 'Language';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/language', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Language...
  public function edit_language($language_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('language_name', 'Language Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $language_status = $this->input->post('language_status');
      if(!isset($language_status)){ $language_status = '1'; }
      $update_data = $_POST;
      $update_data['language_status'] = $language_status;
      $update_data['language_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('language_id', $language_id, 'smm_language', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/language');
    }

    $language_info = $this->Master_Model->get_info_arr('language_id',$language_id,'smm_language');
    if(!$language_info){ header('location:'.base_url().'Hr_setting/language'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['language_info'] = $language_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_language/'.$language_id;

    $data['language_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','language_id','ASC','smm_language');
    $data['setting_menu'] = 'language';
    $data['page'] = 'Edit Language';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/language', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Language...
  public function delete_language($language_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('language_id', $language_id, 'smm_language');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/language');
  }

/********************************* Currency ***********************************/
  // Add Currency...
  public function currency(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $currency_status = $this->input->post('currency_status');
      if(!isset($currency_status)){ $currency_status = '1'; }
      $save_data = $_POST;
      $save_data['currency_status'] = $currency_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['currency_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_currency', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/currency');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/currency';

    $data['currency_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','currency_id','ASC','smm_currency');
    $data['setting_menu'] = 'currency';
    $data['page'] = 'Currency';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/currency', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Currency...
  public function edit_currency($currency_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $currency_status = $this->input->post('currency_status');
      if(!isset($currency_status)){ $currency_status = '1'; }
      $update_data = $_POST;
      $update_data['currency_status'] = $currency_status;
      $update_data['currency_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('currency_id', $currency_id, 'smm_currency', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/currency');
    }

    $currency_info = $this->Master_Model->get_info_arr('currency_id',$currency_id,'smm_currency');
    if(!$currency_info){ header('location:'.base_url().'Hr_setting/currency'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['currency_info'] = $currency_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_currency/'.$currency_id;

    $data['currency_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','currency_id','ASC','smm_currency');
    $data['setting_menu'] = 'currency';
    $data['page'] = 'Edit Currency';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/currency', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Currency...
  public function delete_currency($currency_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('currency_id', $currency_id, 'smm_currency');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/currency');
  }

/********************************* Professional Course ***********************************/
  // Add Professional Course...
  public function prof_course(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('prof_course_name', 'Professional Course Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $prof_course_status = $this->input->post('prof_course_status');
      if(!isset($prof_course_status)){ $prof_course_status = '1'; }
      $save_data = $_POST;
      $save_data['prof_course_status'] = $prof_course_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['prof_course_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_prof_course', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/prof_course');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/prof_course';

    $data['prof_course_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','prof_course_id','ASC','smm_prof_course');
    $data['setting_menu'] = 'prof_course';
    $data['page'] = 'Professional Course';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/prof_course', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Professional Course...
  public function edit_prof_course($prof_course_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('prof_course_name', 'Professional Course Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $prof_course_status = $this->input->post('prof_course_status');
      if(!isset($prof_course_status)){ $prof_course_status = '1'; }
      $update_data = $_POST;
      $update_data['prof_course_status'] = $prof_course_status;
      $update_data['prof_course_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('prof_course_id', $prof_course_id, 'smm_prof_course', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/prof_course');
    }

    $prof_course_info = $this->Master_Model->get_info_arr('prof_course_id',$prof_course_id,'smm_prof_course');
    if(!$prof_course_info){ header('location:'.base_url().'Hr_setting/prof_course'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['prof_course_info'] = $prof_course_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_prof_course/'.$prof_course_id;

    $data['prof_course_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','prof_course_id','ASC','smm_prof_course');
    $data['setting_menu'] = 'prof_course';
    $data['page'] = 'Edit Professional Course';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/prof_course', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Professional Course...
  public function delete_prof_course($prof_course_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('prof_course_id', $prof_course_id, 'smm_prof_course');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/prof_course');
  }

/********************************* Nationality ***********************************/
  // Add Nationality...
  public function nationality(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('nationality_name', 'Nationality Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $nationality_status = $this->input->post('nationality_status');
      if(!isset($nationality_status)){ $nationality_status = '1'; }
      $save_data = $_POST;
      $save_data['nationality_status'] = $nationality_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['nationality_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_nationality', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/nationality');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/nationality';

    $data['nationality_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','nationality_id','ASC','smm_nationality');
    $data['setting_menu'] = 'nationality';
    $data['page'] = 'Nationality';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/nationality', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Nationality...
  public function edit_nationality($nationality_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('nationality_name', 'Nationality Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $nationality_status = $this->input->post('nationality_status');
      if(!isset($nationality_status)){ $nationality_status = '1'; }
      $update_data = $_POST;
      $update_data['nationality_status'] = $nationality_status;
      $update_data['nationality_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('nationality_id', $nationality_id, 'smm_nationality', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/nationality');
    }

    $nationality_info = $this->Master_Model->get_info_arr('nationality_id',$nationality_id,'smm_nationality');
    if(!$nationality_info){ header('location:'.base_url().'Hr_setting/nationality'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['nationality_info'] = $nationality_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_nationality/'.$nationality_id;

    $data['nationality_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','nationality_id','ASC','smm_nationality');
    $data['setting_menu'] = 'nationality';
    $data['page'] = 'Edit Nationality';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/nationality', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Nationality...
  public function delete_nationality($nationality_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('nationality_id', $nationality_id, 'smm_nationality');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/nationality');
  }

/********************************* Citizenship ***********************************/
  // Add Citizenship...
  public function citizenship(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('citizenship_name', 'Citizenship Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $citizenship_status = $this->input->post('citizenship_status');
      if(!isset($citizenship_status)){ $citizenship_status = '1'; }
      $save_data = $_POST;
      $save_data['citizenship_status'] = $citizenship_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['citizenship_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_citizenship', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/citizenship');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/citizenship';

    $data['citizenship_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','citizenship_id','ASC','smm_citizenship');
    $data['setting_menu'] = 'citizenship';
    $data['page'] = 'Citizenship';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/citizenship', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Citizenship...
  public function edit_citizenship($citizenship_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('citizenship_name', 'Citizenship Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $citizenship_status = $this->input->post('citizenship_status');
      if(!isset($citizenship_status)){ $citizenship_status = '1'; }
      $update_data = $_POST;
      $update_data['citizenship_status'] = $citizenship_status;
      $update_data['citizenship_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('citizenship_id', $citizenship_id, 'smm_citizenship', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/citizenship');
    }

    $citizenship_info = $this->Master_Model->get_info_arr('citizenship_id',$citizenship_id,'smm_citizenship');
    if(!$citizenship_info){ header('location:'.base_url().'Hr_setting/citizenship'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['citizenship_info'] = $citizenship_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_citizenship/'.$citizenship_id;

    $data['citizenship_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','citizenship_id','ASC','smm_citizenship');
    $data['setting_menu'] = 'citizenship';
    $data['page'] = 'Edit Citizenship';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/citizenship', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Citizenship...
  public function delete_citizenship($citizenship_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('citizenship_id', $citizenship_id, 'smm_citizenship');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/citizenship');
  }

/********************************* Payslip Type ***********************************/
  // Add Payslip Type...
  public function payslip_type(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('payslip_type_name', 'Payslip Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $payslip_type_status = $this->input->post('payslip_type_status');
      if(!isset($payslip_type_status)){ $payslip_type_status = '1'; }
      $save_data = $_POST;
      $save_data['payslip_type_status'] = $payslip_type_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['payslip_type_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_payslip_type', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/payslip_type');
    }
    $data['update_hr_setting'] = 'update';
    $data['act_link'] = base_url().'Hr_setting/payslip_type';

    $data['payslip_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','payslip_type_id','ASC','smm_payslip_type');
    $data['setting_menu'] = 'payslip_type';
    $data['page'] = 'Payslip Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/payslip_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Payslip Type...
  public function edit_payslip_type($payslip_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('payslip_type_name', 'Payslip Type Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $payslip_type_status = $this->input->post('payslip_type_status');
      if(!isset($payslip_type_status)){ $payslip_type_status = '1'; }
      $update_data = $_POST;
      $update_data['payslip_type_status'] = $payslip_type_status;
      $update_data['payslip_type_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('payslip_type_id', $payslip_type_id, 'smm_payslip_type', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/payslip_type');
    }

    $payslip_type_info = $this->Master_Model->get_info_arr('payslip_type_id',$payslip_type_id,'smm_payslip_type');
    if(!$payslip_type_info){ header('location:'.base_url().'Hr_setting/payslip_type'); }
    $data['update'] = 'update';
    $data['update_hr_setting'] = 'update';
    $data['payslip_type_info'] = $payslip_type_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_payslip_type/'.$payslip_type_id;

    $data['payslip_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','payslip_type_id','ASC','smm_payslip_type');
    $data['setting_menu'] = 'payslip_type';
    $data['page'] = 'Edit Payslip Type';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/payslip_type', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Payslip Type...
  public function delete_payslip_type($payslip_type_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('payslip_type_id', $payslip_type_id, 'smm_payslip_type');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/payslip_type');
  }






/*****************************************************************************************/
/*                                  HR Setting Forms End                                 */
/*****************************************************************************************/






/*********************************** Holiday *********************************/

  // Add Holiday....
  public function holiday(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('holiday_name', 'Holiday Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $holiday_status = $this->input->post('holiday_status');
      if(!isset($holiday_status)){ $holiday_status = '1'; }
      $save_data = $_POST;
      $save_data['holiday_status'] = $holiday_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['holiday_addedby'] = $smm_user_id;
      $holiday_id = $this->Master_Model->save_data('smm_holiday', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/holiday');
    }
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','department_status','1','department_name','ASC','smm_department');
    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','is_admin','0','user_status','1','user_name','ASC','user');

    $data['holiday_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','holiday_id','DESC','smm_holiday');
    $data['page'] = 'Holiday';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/holiday', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Holiday...
  public function edit_holiday($holiday_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('holiday_name', 'Holiday Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $holiday_status = $this->input->post('holiday_status');
      if(!isset($holiday_status)){ $holiday_status = '1'; }
      $update_data = $_POST;
      $update_data['holiday_status'] = $holiday_status;
      $update_data['holiday_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('holiday_id', $holiday_id, 'smm_holiday', $update_data);


      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/holiday');
    }

    $holiday_info = $this->Master_Model->get_info_arr('holiday_id',$holiday_id,'smm_holiday');
    if(!$holiday_info){ header('location:'.base_url().'Hr_setting/holiday'); }
    $data['update'] = 'update';
    $data['update_holiday'] = 'update';
    $data['holiday_info'] = $holiday_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_holiday/'.$holiday_id;
    $data['holiday_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','holiday_id','DESC','smm_holiday');
    $data['page'] = 'Edit Holiday';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/holiday', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Holiday...
  public function delete_holiday($holiday_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('holiday_id', $holiday_id, 'smm_holiday');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/holiday');
  }


/********************************* Award ***********************************/

  // Add Award...
  public function award(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('award_date', 'Award', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $award_status = $this->input->post('award_status');
      if(!isset($award_status)){ $award_status = '1'; }
      $save_data = $_POST;
      $save_data['award_status'] = $award_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['award_addedby'] = $smm_user_id;
      $award_id = $this->Master_Model->save_data('smm_award', $save_data);

      if($_FILES['award_image']['name']){
        $time = time();
        $image_name = 'award_'.$award_id.'_'.$time;
        $config['upload_path'] = 'assets/images/award/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['award_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('award_image') && $award_id && $image_name && $ext && $filename){
          $award_image_up['award_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('award_id', $award_id, 'smm_award', $award_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/award');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['award_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','award_type_name','ASC','smm_award_type');

    $data['award_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','award_id','DESC','smm_award');
    $data['page'] = 'Award';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/award', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Award...
  public function edit_award($award_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('award_date', 'Award', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $award_status = $this->input->post('award_status');
      if(!isset($award_status)){ $award_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_award_image']);
      $update_data['award_status'] = $award_status;
      $update_data['award_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('award_id', $award_id, 'smm_award', $update_data);

      if($_FILES['award_image']['name']){
        $time = time();
        $image_name = 'award_'.$award_id.'_'.$time;
        $config['upload_path'] = 'assets/images/award/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['award_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('award_image') && $award_id && $image_name && $ext && $filename){
          $award_image_up['award_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('award_id', $award_id, 'smm_award', $award_image_up);
          if($_POST['old_award_image']){ unlink("assets/images/award/".$_POST['old_award_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/award');
    }
    $award_info = $this->Master_Model->get_info_arr('award_id',$award_id,'smm_award');
    if(!$award_info){ header('location:'.base_url().'Hr_setting/award'); }
    $data['update'] = 'update';
    $data['update_award'] = 'update';
    $data['award_info'] = $award_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_award/'.$award_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['award_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','award_type_name','ASC','smm_award_type');

    $data['award_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','award_id','DESC','smm_award');
    $data['page'] = 'Edit Award';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/award', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Award...
  public function delete_award($award_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $award_info = $this->Master_Model->get_info_arr_fields('award_image, award_id', 'award_id', $award_id, 'smm_award');
    if($award_info){
      $award_image = $award_info[0]['award_image'];
      if($award_image){ unlink("assets/images/award/".$award_image); }
    }
    $this->Master_Model->delete_info('award_id', $award_id, 'smm_award');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/award');
  }

/********************************* Transfer ***********************************/

  // Add Transfer...
  public function transfer(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('transfer_date', 'Transfer', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $transfer_status = $this->input->post('transfer_status');
      if(!isset($transfer_status)){ $transfer_status = '1'; }
      $save_data = $_POST;
      $save_data['transfer_status'] = $transfer_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['transfer_addedby'] = $smm_user_id;
      $transfer_id = $this->Master_Model->save_data('smm_transfer', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/transfer');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['transfer_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','transfer_id','DESC','smm_transfer');
    $data['page'] = 'Transfer';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/transfer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Transfer...
  public function edit_transfer($transfer_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('transfer_date', 'Transfer', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $transfer_status = $this->input->post('transfer_status');
      if(!isset($transfer_status)){ $transfer_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_transfer_image']);
      $update_data['transfer_status'] = $transfer_status;
      $update_data['transfer_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('transfer_id', $transfer_id, 'smm_transfer', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/transfer');
    }
    $transfer_info = $this->Master_Model->get_info_arr('transfer_id',$transfer_id,'smm_transfer');
    if(!$transfer_info){ header('location:'.base_url().'Hr_setting/transfer'); }
    $data['update'] = 'update';
    $data['update_transfer'] = 'update';
    $data['transfer_info'] = $transfer_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_transfer/'.$transfer_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['transfer_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','transfer_id','DESC','smm_transfer');
    $data['page'] = 'Edit Transfer';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/transfer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Transfer...
  public function delete_transfer($transfer_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('transfer_id', $transfer_id, 'smm_transfer');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/transfer');
  }

/********************************* Resignation ***********************************/

  // Add Resignation...
  public function resignation(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('resignation_date', 'Resignation', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $resignation_status = $this->input->post('resignation_status');
      // if(!isset($resignation_status)){ $resignation_status = '1'; }
      $save_data = $_POST;
      $save_data['resignation_status'] = '0';
      $save_data['company_id'] = $smm_company_id;
      $save_data['resignation_addedby'] = $smm_user_id;
      $resignation_id = $this->Master_Model->save_data('smm_resignation', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/resignation');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['resignation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','resignation_id','DESC','smm_resignation');
    $data['page'] = 'Resignation';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/resignation', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Resignation...
  public function edit_resignation($resignation_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('resignation_date', 'Resignation', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $resignation_status = $this->input->post('resignation_status');
      // if(!isset($resignation_status)){ $resignation_status = '1'; }
      $update_data = $_POST;
      // $update_data['resignation_status'] = $resignation_status;
      $update_data['resignation_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('resignation_id', $resignation_id, 'smm_resignation', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/resignation');
    }
    $resignation_info = $this->Master_Model->get_info_arr('resignation_id',$resignation_id,'smm_resignation');
    if(!$resignation_info){ header('location:'.base_url().'Hr_setting/resignation'); }
    $data['update'] = 'update';
    $data['update_resignation'] = 'update';
    $data['resignation_info'] = $resignation_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_resignation/'.$resignation_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['resignation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','resignation_id','DESC','smm_resignation');
    $data['page'] = 'Edit Resignation';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/resignation', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Resignation...
  public function delete_resignation($resignation_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('resignation_id', $resignation_id, 'smm_resignation');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/resignation');
  }


/********************************* Travel ***********************************/

  // Add Travel...
  public function travel(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('travel_start_date', 'Travel', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $travel_status = $this->input->post('travel_status');
      // if(!isset($travel_status)){ $travel_status = '1'; }
      $save_data = $_POST;
      // $save_data['travel_status'] = '0';
      $save_data['company_id'] = $smm_company_id;
      $save_data['travel_addedby'] = $smm_user_id;
      $travel_id = $this->Master_Model->save_data('smm_travel', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/travel');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['travel_arr_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','travel_arr_type_name','ASC','smm_travel_arr_type');

    $data['travel_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','travel_id','DESC','smm_travel');
    $data['page'] = 'Travel';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/travel', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Travel...
  public function edit_travel($travel_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('travel_start_date', 'Travel', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $travel_status = $this->input->post('travel_status');
      // if(!isset($travel_status)){ $travel_status = '1'; }
      $update_data = $_POST;
      // $update_data['travel_status'] = $travel_status;
      $update_data['travel_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('travel_id', $travel_id, 'smm_travel', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/travel');
    }
    $travel_info = $this->Master_Model->get_info_arr('travel_id',$travel_id,'smm_travel');
    if(!$travel_info){ header('location:'.base_url().'Hr_setting/travel'); }
    $data['update'] = 'update';
    $data['update_travel'] = 'update';
    $data['travel_info'] = $travel_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_travel/'.$travel_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['travel_arr_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','travel_arr_type_name','ASC','smm_travel_arr_type');

    $data['travel_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','travel_id','DESC','smm_travel');
    $data['page'] = 'Edit Travel';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/travel', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Travel...
  public function delete_travel($travel_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('travel_id', $travel_id, 'smm_travel');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/travel');
  }

/********************************* Promotion ***********************************/

  // Add Promotion...
  public function promotion(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_id', 'Promotion', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $promotion_status = $this->input->post('promotion_status');
      // if(!isset($promotion_status)){ $promotion_status = '1'; }
      $save_data = $_POST;
      // $save_data['promotion_status'] = '0';
      $save_data['company_id'] = $smm_company_id;
      $save_data['promotion_addedby'] = $smm_user_id;
      $promotion_id = $this->Master_Model->save_data('smm_promotion', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/promotion');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_name','ASC','smm_designation');

    $data['promotion_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','promotion_id','DESC','smm_promotion');
    $data['page'] = 'Promotion';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/promotion', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Promotion...
  public function edit_promotion($promotion_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_id', 'Promotion', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $promotion_status = $this->input->post('promotion_status');
      // if(!isset($promotion_status)){ $promotion_status = '1'; }
      $update_data = $_POST;
      // $update_data['promotion_status'] = $promotion_status;
      $update_data['promotion_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('promotion_id', $promotion_id, 'smm_promotion', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/promotion');
    }
    $promotion_info = $this->Master_Model->get_info_arr('promotion_id',$promotion_id,'smm_promotion');
    if(!$promotion_info){ header('location:'.base_url().'Hr_setting/promotion'); }
    $data['update'] = 'update';
    $data['update_promotion'] = 'update';
    $data['promotion_info'] = $promotion_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_promotion/'.$promotion_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','designation_name','ASC','smm_designation');

    $data['promotion_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','promotion_id','DESC','smm_promotion');
    $data['page'] = 'Edit Promotion';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/promotion', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Promotion...
  public function delete_promotion($promotion_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('promotion_id', $promotion_id, 'smm_promotion');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/promotion');
  }


/********************************* Complaint ***********************************/

  // Add Complaint...
  public function complaint(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('complaint_title', 'Complaint', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $complaint_status = $this->input->post('complaint_status');
      if(!isset($complaint_status)){ $complaint_status = '1'; }
      $save_data = $_POST;
      $save_data['complaint_status'] = $complaint_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['complaint_addedby'] = $smm_user_id;
      $complaint_id = $this->Master_Model->save_data('smm_complaint', $save_data);

      if($_FILES['complaint_image']['name']){
        $time = time();
        $image_name = 'complaint_'.$complaint_id.'_'.$time;
        $config['upload_path'] = 'assets/images/complaint/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['complaint_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('complaint_image') && $complaint_id && $image_name && $ext && $filename){
          $complaint_image_up['complaint_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('complaint_id', $complaint_id, 'smm_complaint', $complaint_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/complaint');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    // $data['complaint_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','complaint_type_name','ASC','smm_complaint_type');

    $data['complaint_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','complaint_id','DESC','smm_complaint');
    $data['page'] = 'Complaint';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/complaint', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Complaint...
  public function edit_complaint($complaint_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('complaint_title', 'Complaint', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $complaint_status = $this->input->post('complaint_status');
      if(!isset($complaint_status)){ $complaint_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_complaint_image']);
      $update_data['complaint_status'] = $complaint_status;
      $update_data['complaint_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('complaint_id', $complaint_id, 'smm_complaint', $update_data);

      if($_FILES['complaint_image']['name']){
        $time = time();
        $image_name = 'complaint_'.$complaint_id.'_'.$time;
        $config['upload_path'] = 'assets/images/complaint/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['complaint_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('complaint_image') && $complaint_id && $image_name && $ext && $filename){
          $complaint_image_up['complaint_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('complaint_id', $complaint_id, 'smm_complaint', $complaint_image_up);
          if($_POST['old_complaint_image']){ unlink("assets/images/complaint/".$_POST['old_complaint_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/complaint');
    }
    $complaint_info = $this->Master_Model->get_info_arr('complaint_id',$complaint_id,'smm_complaint');
    if(!$complaint_info){ header('location:'.base_url().'Hr_setting/complaint'); }
    $data['update'] = 'update';
    $data['update_complaint'] = 'update';
    $data['complaint_info'] = $complaint_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_complaint/'.$complaint_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    // $data['complaint_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','complaint_type_name','ASC','smm_complaint_type');

    $data['complaint_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','complaint_id','DESC','smm_complaint');
    $data['page'] = 'Edit Complaint';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/complaint', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Complaint...
  public function delete_complaint($complaint_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $complaint_info = $this->Master_Model->get_info_arr_fields('complaint_image, complaint_id', 'complaint_id', $complaint_id, 'smm_complaint');
    if($complaint_info){
      $complaint_image = $complaint_info[0]['complaint_image'];
      if($complaint_image){ unlink("assets/images/complaint/".$complaint_image); }
    }
    $this->Master_Model->delete_info('complaint_id', $complaint_id, 'smm_complaint');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/complaint');
  }



/********************************* Warning ***********************************/

  // Add Warning...
  public function warning(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('warning_subject', 'Warning', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $warning_status = $this->input->post('warning_status');
      if(!isset($warning_status)){ $warning_status = '1'; }
      $save_data = $_POST;
      $save_data['warning_status'] = $warning_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['warning_addedby'] = $smm_user_id;
      $warning_id = $this->Master_Model->save_data('smm_warning', $save_data);

      if($_FILES['warning_image']['name']){
        $time = time();
        $image_name = 'warning_'.$warning_id.'_'.$time;
        $config['upload_path'] = 'assets/images/warning/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['warning_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('warning_image') && $warning_id && $image_name && $ext && $filename){
          $warning_image_up['warning_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('warning_id', $warning_id, 'smm_warning', $warning_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/warning');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['warning_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','warning_type_name','ASC','smm_warning_type');

    $data['warning_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','warning_id','DESC','smm_warning');
    $data['page'] = 'Warning';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/warning', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Warning...
  public function edit_warning($warning_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('warning_subject', 'Warning', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $warning_status = $this->input->post('warning_status');
      if(!isset($warning_status)){ $warning_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_warning_image']);
      $update_data['warning_status'] = $warning_status;
      $update_data['warning_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('warning_id', $warning_id, 'smm_warning', $update_data);

      if($_FILES['warning_image']['name']){
        $time = time();
        $image_name = 'warning_'.$warning_id.'_'.$time;
        $config['upload_path'] = 'assets/images/warning/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['warning_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('warning_image') && $warning_id && $image_name && $ext && $filename){
          $warning_image_up['warning_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('warning_id', $warning_id, 'smm_warning', $warning_image_up);
          if($_POST['old_warning_image']){ unlink("assets/images/warning/".$_POST['old_warning_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/warning');
    }
    $warning_info = $this->Master_Model->get_info_arr('warning_id',$warning_id,'smm_warning');
    if(!$warning_info){ header('location:'.base_url().'Hr_setting/warning'); }
    $data['update'] = 'update';
    $data['update_warning'] = 'update';
    $data['warning_info'] = $warning_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_warning/'.$warning_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['warning_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','warning_type_name','ASC','smm_warning_type');

    $data['warning_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','warning_id','DESC','smm_warning');
    $data['page'] = 'Edit Warning';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/warning', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Warning...
  public function delete_warning($warning_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $warning_info = $this->Master_Model->get_info_arr_fields('warning_image, warning_id', 'warning_id', $warning_id, 'smm_warning');
    if($warning_info){
      $warning_image = $warning_info[0]['warning_image'];
      if($warning_image){ unlink("assets/images/warning/".$warning_image); }
    }
    $this->Master_Model->delete_info('warning_id', $warning_id, 'smm_warning');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/warning');
  }


/********************************* Termination ***********************************/

  // Add Termination...
  public function termination(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('termination_date', 'Termination', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $termination_status = $this->input->post('termination_status');
      if(!isset($termination_status)){ $termination_status = '1'; }
      $save_data = $_POST;
      $save_data['termination_status'] = $termination_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['termination_addedby'] = $smm_user_id;
      $termination_id = $this->Master_Model->save_data('smm_termination', $save_data);

      if($_FILES['termination_image']['name']){
        $time = time();
        $image_name = 'termination_'.$termination_id.'_'.$time;
        $config['upload_path'] = 'assets/images/termination/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['termination_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('termination_image') && $termination_id && $image_name && $ext && $filename){
          $termination_image_up['termination_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('termination_id', $termination_id, 'smm_termination', $termination_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/termination');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['termination_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','termination_type_name','ASC','smm_termination_type');

    $data['termination_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','termination_id','DESC','smm_termination');
    $data['page'] = 'Termination';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/termination', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Termination...
  public function edit_termination($termination_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('termination_date', 'Termination', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $termination_status = $this->input->post('termination_status');
      if(!isset($termination_status)){ $termination_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_termination_image']);
      $update_data['termination_status'] = $termination_status;
      $update_data['termination_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('termination_id', $termination_id, 'smm_termination', $update_data);

      if($_FILES['termination_image']['name']){
        $time = time();
        $image_name = 'termination_'.$termination_id.'_'.$time;
        $config['upload_path'] = 'assets/images/termination/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['termination_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('termination_image') && $termination_id && $image_name && $ext && $filename){
          $termination_image_up['termination_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('termination_id', $termination_id, 'smm_termination', $termination_image_up);
          if($_POST['old_termination_image']){ unlink("assets/images/termination/".$_POST['old_termination_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/termination');
    }
    $termination_info = $this->Master_Model->get_info_arr('termination_id',$termination_id,'smm_termination');
    if(!$termination_info){ header('location:'.base_url().'Hr_setting/termination'); }
    $data['update'] = 'update';
    $data['update_termination'] = 'update';
    $data['termination_info'] = $termination_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_termination/'.$termination_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['termination_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','termination_type_name','ASC','smm_termination_type');

    $data['termination_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','termination_id','DESC','smm_termination');
    $data['page'] = 'Edit Termination';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/termination', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Termination...
  public function delete_termination($termination_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $termination_info = $this->Master_Model->get_info_arr_fields('termination_image, termination_id', 'termination_id', $termination_id, 'smm_termination');
    if($termination_info){
      $termination_image = $termination_info[0]['termination_image'];
      if($termination_image){ unlink("assets/images/termination/".$termination_image); }
    }
    $this->Master_Model->delete_info('termination_id', $termination_id, 'smm_termination');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/termination');
  }



/********************************* Employee Exit ***********************************/

  // Add Employee Exit...
  public function employee_exit(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_exit_date', 'Employee Exit', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $employee_exit_status = $this->input->post('employee_exit_status');
      if(!isset($employee_exit_status)){ $employee_exit_status = '1'; }
      $save_data = $_POST;
      $save_data['employee_exit_status'] = $employee_exit_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['employee_exit_addedby'] = $smm_user_id;
      $employee_exit_id = $this->Master_Model->save_data('smm_employee_exit', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Hr_setting/employee_exit');
    }
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['employee_exit_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_exit_type_name','ASC','smm_employee_exit_type');

    $data['employee_exit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_exit_id','DESC','smm_employee_exit');
    $data['page'] = 'Employee Exit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/employee_exit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Employee Exit...
  public function edit_employee_exit($employee_exit_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('employee_exit_date', 'Employee Exit', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $employee_exit_status = $this->input->post('employee_exit_status');
      if(!isset($employee_exit_status)){ $employee_exit_status = '1'; }
      $update_data = $_POST;
      $update_data['employee_exit_status'] = $employee_exit_status;
      $update_data['employee_exit_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('employee_exit_id', $employee_exit_id, 'smm_employee_exit', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Hr_setting/employee_exit');
    }
    $employee_exit_info = $this->Master_Model->get_info_arr('employee_exit_id',$employee_exit_id,'smm_employee_exit');
    if(!$employee_exit_info){ header('location:'.base_url().'Hr_setting/employee_exit'); }
    $data['update'] = 'update';
    $data['update_employee_exit'] = 'update';
    $data['employee_exit_info'] = $employee_exit_info[0];
    $data['act_link'] = base_url().'Hr_setting/edit_employee_exit/'.$employee_exit_id;
    $data['employee_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','is_admin','0','user_name','ASC','user');
    $data['employee_exit_type_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_exit_type_name','ASC','smm_employee_exit_type');

    $data['employee_exit_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','employee_exit_id','DESC','smm_employee_exit');
    $data['page'] = 'Edit Employee Exit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Hr_setting/employee_exit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Employee Exit...
  public function delete_employee_exit($employee_exit_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('employee_exit_id', $employee_exit_id, 'smm_employee_exit');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Hr_setting/employee_exit');
  }

}
?>
