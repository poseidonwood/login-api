<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //load model login_mmodel
    $this->load->model('login_model');
    $this->load->model('wa_model');
    $this->load->model('menu_model');
  }
  public function index()
  {
    if ($this->login_model->logged_id()) {
      //cek apakah role admin 
      $role = $this->session->userdata("user_role");
      if ($role == 'admin') {
        //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
        redirect('home/dashboard', 'refresh');
      } else {
        redirect('home/member', 'refresh');
      }
    } else {
      redirect('home/signin', 'refresh');
    }
  }
  public function signup()
  {
    if ($this->login_model->logged_id()) {
      //cek apakah role admin 
      $role = $this->session->userdata("user_role");
      if ($role == 'admin') {
        //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
        redirect('home/dashboard', 'refresh');
      } else {
        redirect('home/member', 'refresh');
      }
    } else {
      $data = array(
        'title' => 'Sign Up Page'
      );
      $this->load->view('signup', $data);
    }
  }
  public function signin()
  {
    if ($this->login_model->logged_id()) {
      //cek apakah role admin 
      $role = $this->session->userdata("user_role");
      if ($role == 'admin') {
        //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
        redirect('home/dashboard', 'refresh');
      } else {
        redirect('home/member', 'refresh');
      }
    } else {
      $data = array(
        'title' => 'Sign In Page'
      );
      $this->load->view('auth', $data);
    }
  }

  public function dashboard()
  {
    if ($this->login_model->logged_id()) {
      //cek apakah role admin 
      $role = $this->session->userdata("user_role");
      if ($role == 'admin') {
        $this->wa_model->get_credit();
        $data['menu'] = $this->menu_model->menu();
        //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
        $this->load->view('admin/home', $data);
      } else {
        redirect('home/member', 'refresh');
      }
    } else {
      redirect('home/signin', 'refresh');
    }
  }
  public function member()
  {
    if ($this->login_model->logged_id()) {
      $this->wa_model->get_credit();
      // $data['menu'] = $this->menu_model->menu();
      // $data['role_menu'] = $this->menu_model->role_menu();
      $data['user_role'] = $this->session->userdata('user_role');
      //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
      $this->load->view('admin/home', $data);
    } else {
      redirect('home/signin', 'refresh');
    }
  }
  public function profile()
  {
    if ($this->login_model->logged_id()) {
      $this->wa_model->get_credit();
      //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
      $this->load->view('admin/profile');
    } else {
      redirect('home/signin', 'refresh');
    }
  }

  public function logout()
  {
    $id_log = $this->session->userdata("user_id_log");
    $checking = $this->login_model->check_log1('log_tbl', array('id_log' => $id_log));
    //jika ditemukan, maka create session
    if ($checking != FALSE) {
      //id_log
      foreach ($checking as $log) {
        $date_login = $log->start_login;
        date_default_timezone_set("Asia/Jakarta");
        $date_end = date("yy-m-d H:i:s");
        $detik_date_end = strtotime($date_end);
        $start_login = strtotime($date_login);
        $selisih_waktu = round(abs($detik_date_end - $start_login) / 60, 2) . " minute";
        $data1 = array(
          'end_login' => $date_end,
          'selisih_waktu' => $selisih_waktu,
          'status' => 'LOGOUT'
        );
        $this->db->where('id_log', $id_log);
        $updated_status = $this->db->update('log_tbl', $data1);
        // $this->session->sess_destroy();
        // echo $detik_date_end . " - " . $start_login . " = " . $selisih_waktu;
      }
      $this->session->sess_destroy();
      redirect('home/signin');
    } else {
      redirect('home/signin');
    }
  }
}
