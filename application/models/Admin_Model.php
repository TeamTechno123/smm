<?php
class Admin_Model extends CI_Model{

  function check_login($mobile, $password){
    $this->db->select('*');
    $this->db->where('admin_mobile', $mobile);
    // $this->db->where('admin_email', $email);
    $this->db->where('admin_password', $password);
    $this->db->where('admin_status', '1');
    $this->db->from('admin');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

}
?>
