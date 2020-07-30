<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies

  }

  // List all your items
  public function index()
  {
    $data = array(
      'judul' => 'Admin | Dashboard'
    );
    $this->load->view('admin/home', $data);
  }
}

/* End of file Controllername.php */
