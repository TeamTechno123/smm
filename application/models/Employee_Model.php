<?php
class Employee_Model extends CI_Model{

  function check_login($mobile, $password){
    $this->db->select('*');
    $this->db->where('employee_mobile', $mobile);
    $this->db->where('employee_password', $password);
    // $this->db->where('reseller_addedby', $web_reseller_id);
    // $this->db->where('reseller_added_type', '1');
    $this->db->where('employee_status', '1');
    $this->db->from('smm_employee');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  // Get List.. Company Id... 3 check fields... Order...
  public function get_list_by_id3_find_in_set($company_id,$set_col,$set_val,$col_name1,$col_val1,$col_name2,$col_val2,$col_name3,$col_val3,$order_col,$order,$tbl_name){
    $this->db->select('*');
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($set_col != ''){
      $this->db->where("FIND_IN_SET('".$set_val."', ".$set_col.") != 0");
    }
    if($col_name1 != ''){
      $this->db->where($col_name1,$col_val1);
    }
    if($col_name2 != ''){
      $this->db->where($col_name2,$col_val2);
    }
    if($col_name3 != ''){
      $this->db->where($col_name3,$col_val3);
    }
    if($order_col != ''){
      $this->db->order_by($order_col, $order);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    // $q = $this->db->last_query();
    // return $q;
  }






}
?>
