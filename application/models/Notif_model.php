<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notif_model extends CI_Model
{

  public $table = 'user_tbl';
  public $id_user = 'id_user';
  public $order = 'DESC';


  function __construct()
  {
    parent::__construct();
  }


  function push_member()
  {
    //tambahkan paramerter push_member($id_user=null)
    // $this->db->like('id_user', $id_user);
    // $this->db->or_like('nama', $id_user);
    // $this->db->or_like('email', $id_user);
    // $this->db->or_like('password', $id_user);
    // $this->db->or_like('phone', $id_user);
    // $this->db->or_like('status', $id_user);
    // $this->db->or_like('role', $id_user);
    // $this->db->or_like('foto', $id_user);
    // $this->db->or_like('created_time', $id_user);
    // $this->db->from($this->table);
    $check = $this->db->get_where('user_tbl', array('status' => 'N'))->num_rows();
    // return $check_siapa->nama;
    return $check;
    // return $this->db->count_all_results();
  }
  function push_member_siapa()
  {
    $check_siapa = $this->db->get_where('user_tbl', array('status' => 'N'))->row();
    if ($check_siapa == null) {
      return $check_siapa = array(
        'nama' => '0',
        'email' => '0'
      );
    }
    return $check_siapa = array(
      'nama' => $check_siapa->nama,
      'email' => $check_siapa->email
    );
  }
}
