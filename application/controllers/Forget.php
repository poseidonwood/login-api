<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Forget extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('forget_model');
  }

  // List all your items
  public function index()
  {
    $data = array('title' => 'Lupa Password Form');
    $this->load->view('forget', $data);
  }
  public function check()
  {
    date_default_timezone_set("Asia/Bangkok");
    //tambah end time 
    $t = strtotime('+2 days');
    $lusa = date('Y-m-d H:i:s', $t) . PHP_EOL;
    function generateToken($length = null)
    {
      return substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghifghijklmnopqrstuvwxyz', ceil($length / strlen($x)))), 1, $length);
    }
    function generateId($length = null)
    {
      return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
    }

    $email =  $this->input->post('email');

    //check data di model
    $checking = $this->forget_model->check_email('user_tbl', array('email' => $email));
    if ($checking != FALSE) {
      //jika data ada dan benar 
      foreach ($checking as $resultnya) {
        $token = generateToken(20);
        $id_token = generateToken(4);
        date_default_timezone_set("Asia/Jakarta");
        $date = date("yy-m-d H:i:s");
        $data_result = array(
          'id_token' => $id_token,
          'id_user' => $resultnya->id_user,
          'token' => $token,
          'created_time' => $date,
          'end_time' => $lusa,
          'purpose' => 'LUPA PASSWORD',
          'valid' => 'Y'
        );
        $id_user = $data_result['id_user'];
        $data_email = array('email' => $resultnya->email);
        $email_to = $data_email['email'];
        //menghindari spam cek di tbl_token ,apa ada token aktif atau tidak
        $validasi_email = $this->forget_model->validasi_email('token_tbl', array('id_user' => $id_user));
        if ($validasi_email != FALSE) {
          $data = array('title' => 'Lupa Password Form');
          $this->load->view('forget_form', $data);
          $this->session->set_flashdata('email_check', "<p>Kami sebelumnya sudah mengirim link perubahan password. Tolong perika email ($email_to) untuk merubah password anda</p>");
          redirect("forget");
        } else {
          //jika data tidak ada token maka insert token baru
          $this->db->insert('token_tbl', $data_result);
          //arahkan ke controler email forget untuk kirim link ganti password
          redirect("email/email_forget/$email_to/$token/$id_user");
        }
      }
    } else {
      $this->session->set_flashdata('notif_token', "<p>Email tidak di temukan</p>");
      redirect('forget', 'refresh');
    }
  }
  public function change($token = null)
  {
    if (isset($token)) {
      $checking_token = $this->forget_model->check_token('token_tbl', array('token' => $token));
      if ($checking_token != FALSE) {
        $data = array(
          'title' => 'Lupa Password Form',
          'token' => $token
        );
        $this->load->view("forget_form", $data);
      } else {
        //jika data token tidak ada
        $link = base_url();
        echo "Link tidak ditemukan/tidak valid <a href ='$link'>Kembali Ke Home</a> ";
      }
    } else {
      //jika tidak isset token di arahkan kehome
      redirect('home', 'refresh');
    }
    //tampilkan form ubah dimana membutuh kan get token
    // $data = array('title' => 'Lupa Password Form');
    // $this->load->view('forget_form', $data);
  }
  public function proses()
  {
    //proses ubah password
    $password1 = md5($this->input->post('password1'));
    $password2 = md5($this->input->post('password2'));
    $id_user = $this->input->post('id_user');
    $token = $this->input->post('token');


    if ($password1 !== $password2) {
      $this->session->set_flashdata('email_check', "<p>(ERROR) Password dan Konfirmasi Password berbeda</p><br>");
      echo "<script>window.history.back();</script>";
    } else {
      //jika password sama update pass
      $data1 = array('password' => $password1);
      $this->db->where('id_user', $id_user);
      $updated_status = $this->db->update('user_tbl', $data1);
      // $updated_status = $this->db->affected_rows();


      if ($updated_status) {

        $data = array('valid' => 'N', 'purpose' => 'USED');
        $this->db->where('token', $token);
        $this->db->update('token_tbl', $data);
        $update_token = $this->db->affected_rows();

        $this->session->set_flashdata('email_check', "<p>(Sukses) Silahkan login dengan password baru anda.</p><br>");
        redirect("home/signin", "refresh");
      } else {
        print_r($this->db->affected_rows());
        echo $id_user . "<br>";
        print_r($data1);
        return false;
      }
    }
  }
}
