<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //load model admin
    $this->load->model('login_model');
    $this->load->model('wa_model');
  }

  public function index()
  {
    if ($this->login_model->logged_id()) {
      //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
      $role = $this->session->userdata("user_role");
      if ($role == 'admin') {
        //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
        $this->load->view('admin/home');
      } else {
        redirect('home/member', 'refresh');
      }
    } else {

      //jika session belum terdaftar

      //set form validation
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      //set message form validation
      $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

      //cek validasi
      if ($this->form_validation->run() == TRUE) {

        //get data dari FORM
        $email = $this->input->post('email', TRUE);
        $password = MD5($this->input->post('password', TRUE));

        //checking data via model
        $checking = $this->login_model->check_login('user_tbl', array('email' => $email), array('password' => $password));

        //jika ditemukan, maka create session
        if ($checking != FALSE) {
          foreach ($checking as $apps) {
            //id_log
            date_default_timezone_set("Asia/Jakarta");
            $id_log = $this->wa_model->generateId(4);
            $date_login = date("yy-m-d H:i:s");
            $session_data = array(
              'user_id'   => $apps->id_user,
              'user_nama' => $apps->nama,
              'user_email' => $apps->email,
              'user_pass' => $apps->password,
              'user_role' => $apps->role,
              'user_foto' => $apps->foto,
              'user_phone' => $apps->phone,
              'user_status' => $apps->status,
              'user_id_log' => $id_log,
              'user_start_login' => $date_login
            );

            //check log apa ada status loggin? 
            $checking_log = $this->login_model->check_log('log_tbl', array('id_user' => $session_data['user_id']), array('status' => 'LOGGIN'));
            if ($checking_log != FALSE) {
              //jika ada yang session yang masih loggin mental ke login kasih session flash
              $data = array(
                'title' => 'Sign In Page'
              );
              $data['error'] = "<p><b><i class='fa fa-exclamation-circle'></i> ERROR </b>Akun ini masih loggin di perangkat lain</p>";
              $this->load->view('auth', $data);
            } else {
              //create log
              $this->load->library('user_agent');
              if ($this->agent->is_browser()) {
                $agent = $this->agent->browser() . ' ' . $this->agent->version();
              } elseif ($this->agent->is_robot()) {
                $agent = $this->agent->robot();
              } elseif ($this->agent->is_mobile()) {
                $agent = $this->agent->mobile();
              } else {
                $agent = 'Unidentified User Agent';
              }
              $ip = $this->input->ip_address();
              $device_info = $agent . " | " . $_SERVER['HTTP_USER_AGENT'];
              $getloc = json_decode(file_get_contents("http://ipinfo.io/$ip"));
              $ip_final = $this->input->ip_address() . " | " . $getloc->city;
              $data_log = array(
                'id_log' => $id_log,
                'id_user' => $session_data['user_id'],
                'email' => $session_data['user_email'],
                'nama' => $session_data['user_nama'],
                'start_login' => $date_login,
                'end_login' => '',
                'selisih_waktu' => '',
                'device' => $device_info,
                'ip' => $ip_final,
                'status' => 'LOGGIN'
              );
              $this->db->insert('log_tbl', $data_log);
              //end create log
              if ($session_data['user_role'] == 'admin' && $session_data['user_status'] == 'Y') {
                //set session userdata
                $this->session->set_userdata($session_data);

                redirect('home/dashboard');
              } elseif ($session_data['user_role'] == 'pegawai' && $session_data['user_status'] == 'Y') {
                $this->session->set_userdata($session_data);

                redirect('home/member');
              } elseif ($session_data['user_status'] == 'N') {

                $data = array(
                  'title' => 'Sign In Page'
                );
                $data['error'] = "<p><b><i class='fa fa-exclamation-circle'></i> ERROR </b>Akun anda belum aktif , Cek email anda lalu kunjungi ";
                $data['error'] .= base_url('verif') . "</p><br>";
                $this->load->view('auth', $data);
              }
            }
          }
        } else {
          $data = array(
            'title' => 'Sign In Page'
          );
          $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                        <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR </b>Email atau Password salah!</div></div><br>';
          $this->load->view('auth', $data);
        }
      } else {
        $data = array(
          'title' => 'Sign In Page'
        );
        $this->load->view('auth', $data);
      }
    }
  }
}
