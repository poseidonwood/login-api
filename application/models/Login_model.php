<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{


  function logged_id()
  {
    return $this->session->userdata('user_id');
  }
  function check_login($table, $field1, $field2)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($field1);
    $this->db->where($field2);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
      return FALSE;
    } else {
      return $query->result();
    }
  }
  function check_log($table, $field1, $field2)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($field1);
    $this->db->where($field2);
    $this->db->limit(1);
    $query1 = $this->db->get();
    if ($query1->num_rows() == 0) {
      return FALSE;
    } else {
      return $query1->result();
    }
  }
  function check_log1($table, $field1)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($field1);
    $this->db->limit(1);
    $query1 = $this->db->get();
    if ($query1->num_rows() == 0) {
      return FALSE;
    } else {
      return $query1->result();
    }
  }
}


/* End of file Login_model.php */
