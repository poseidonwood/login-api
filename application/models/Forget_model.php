<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forget_model extends CI_Model
{

  function check_email($table, $field1)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($field1);
    $this->db->where(array('status' => 'Y'));
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
      return FALSE;
    } else {
      return $query->result();
    }
  }
  function check_token($table, $field1)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($field1);
    $this->db->where(array('valid' => 'Y'));
    $this->db->where(array('purpose' => 'LUPA PASSWORD'));

    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
      return FALSE;
    } else {
      return $query->result();
    }
  }
  function validasi_email($table, $field1)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($field1);
    $this->db->where(array('valid' => 'Y'));
    $this->db->where(array('purpose' => 'LUPA PASSWORD'));
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
      return FALSE;
    } else {
      return $query->result();
    }
  }
}

/* End of file Login_model.php */
