<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

  function menu()
  {
    return $this->db->get('menu_tbl')->result();
  }
  function role_menu()
  {
    return $this->db->get_where('hakakses_tbl', array('role' => 1), 1);
  }
}
