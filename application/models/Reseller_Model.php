<?php
class Reseller_Model extends CI_Model{

  function check_login($mobile, $password){
    $this->db->select('*');
    $this->db->where('reseller_mobile', $mobile);
    $this->db->where('reseller_password', $password);
    $this->db->where('reseller_status', '1');
    $this->db->from('smm_reseller');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  function reseller_package_list($smm_res_company_id,$smm_added_reseller_id){
    $this->db->select('smm_reseller_package.*, smm_package.*');
    $this->db->from('smm_reseller_package');
    $this->db->where('smm_reseller_package.company_id', $smm_res_company_id);
    $this->db->where('smm_reseller_package.reseller_id', $smm_added_reseller_id);
    $this->db->join('smm_package','smm_reseller_package.package_id = smm_package.package_id','left');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  function reseller_package_details($smm_res_company_id,$smm_added_reseller_id,$package_id){
    $this->db->select('smm_reseller_package.*, smm_package.*');
    $this->db->from('smm_reseller_package');
    $this->db->where('smm_reseller_package.company_id', $smm_res_company_id);
    $this->db->where('smm_reseller_package.reseller_id', $smm_added_reseller_id);
    $this->db->where('smm_reseller_package.package_id', $package_id);
    $this->db->join('smm_package','smm_reseller_package.package_id = smm_package.package_id','left');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }


}
?>
