<?php defined('BASEPATH') or exit('No direct script access allowed');
class Email extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('forget_model');
    $this->load->model('email_model');
  }

  public function send()
  {
    $token = $this->input->get('token');
    $email_to = $this->input->get('emailto');
    //link token
    $link = base_url("verif/instant/$token");
    // $this->email_model->send($email_to, $pesan, $redirect);

    //Load email library
    $this->load->library('email');

    //SMTP & mail configuration
    $config = array(
      'protocol'  => 'smtp',
      'smtp_host' => 'herman.id',
      'smtp_port' => 25,
      'smtp_user' => 'no-reply@herman.id',
      'smtp_pass' => 'Putr!123',
      'mailtype'  => 'html',
      'charset'   => 'utf-8'
    );
    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->set_newline("\r\n");
    //Email content
    $htmlContent = "<h4><strong>Hallo! </strong></h4>";
    $htmlContent .= "<p>Terimakasih telah registrasi di web ini. Untuk melengkapi registrasi. Masukkan code verifikasi dibawah ini.<br>Verification code: " . $token . "<br>
    Atau klink link ini :<a href='$link' target ='_blank' >$link</a></p>";
    $this->email->to($email_to);
    $this->email->from('no-reply@herman.id', 'yourdomain.com');
    $this->email->subject('Ini Verification Code');
    $this->email->message($htmlContent);

    //Send email

    $mail = $this->email->send();
    if ($mail) {
      $this->session->set_flashdata('email_check', "<p>Tolong perika email ($email_to) atau whatsapp dan masukkan verifikasi code nya</p><br>");
      redirect('/verif', 'refresh');
      // echo "sukses";
    } else {
      $this->session->set_flashdata('email_check', "<p>Gagal Kirim Email</p><br>");
      redirect('home/signin', 'refresh');
    }
  }
  public function email_forget($email_to = null, $token = null, $id_user = null)
  {
    if (isset($email_to)) {
      $checking = $this->forget_model->check_email('user_tbl', array('email' => $email_to));
      if ($checking != FALSE) {
        //check token
        $checking_token = $this->forget_model->check_token('token_tbl', array('token' => $token));
        if ($checking_token != FALSE) {
          //Load email library
          $this->load->library('email');

          //SMTP & mail configuration
          $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'herman.id',
            'smtp_port' => 25,
            'smtp_user' => 'no-reply@herman.id',
            'smtp_pass' => 'Putr!123',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
          );
          $this->email->initialize($config);
          $this->email->set_mailtype("html");
          $this->email->set_newline("\r\n");
          $link = base_url("forget/change/$token?id_user=$id_user");
          //Email content
          $htmlContent = "<h4>Form Ubah Password</h4>";
          $htmlContent .= "<p>Klik link ini!<br>
       untuk mengubah password  <a href='$link'>klik ini</a></p>";
          $this->email->to($email_to);
          $this->email->from('no-reply@herman.id', 'No-Reply');
          $this->email->subject('Ganti Password');
          $this->email->message($htmlContent);

          //Send email
          $mail = $this->email->send();
          if ($mail) {
            $this->session->set_flashdata('email_check', "<p>Tolong perika email ($email_to) untuk merubah password anda</p><br>");
            redirect('home/signin', 'refresh');
          } else {
            echo  $this->email->print_debugger($mail);
          }
        } else {
          redirect("home", "refresh");
        }
      } else {
        redirect("home", "refresh");
      }
    } else {
      redirect("home", "refresh");
    }
  }
}
