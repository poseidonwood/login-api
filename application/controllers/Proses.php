<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Proses extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('notif_model');
  }

  // List all your items
  public function index()
  {
    // $data['content'] = $this->db->get('user_tbl');
    // $this->load->view('proses/index', $data);
    redirect('home/signin', 'refresh');
  }

  // Add a new item
  public function action_add()
  {

    //generate time

    function generateRandomString($length = null)
    {
      return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
    }
    function generateToken($length = null)
    {
      return substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
    //generate end
    date_default_timezone_set("Asia/Jakarta");
    $date = date("Y-m-d H:i:s");
    $end_time = date('Y-m-d', strtotime($date . ' + 1 days'));

    $data = array(
      'id_user' => generateRandomString(4),
      'nama' => $this->input->post('name'),
      'email' => $this->input->post('email'),
      'password' => md5($this->input->post('password')),
      'phone' => $this->input->post('phone'),
      'status' => 'N',
      'role' => 'pegawai',
      'created_time' => $date
    );
    if ($data['nama'] == null) {
      redirect('home', 'refresh');
    }

    //validasi apakah email sudah terdafta()
    //cek db
    $cek = $this->db->get_where('user_tbl', array('email' => $data['email']))->num_rows();
    if ($cek > 0) {
      $data = array(
        'title' => 'Sign In Page'
      );
      $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                      <div class="header"><b>(<i class="fa fa-exclamation-circle"></i> DITOLAK ) </b>Email anda sudah terdaftar</div></div><br>';
      $this->load->view('signup', $data);
    } else {
      $this->db->insert('user_tbl', $data);
      $token_data = array(
        'id_token' => generateRandomString(5),
        'id_user' => $data['id_user'],
        'token' => generateToken(4),
        'created_time' => $date,
        'end_time' => $end_time,
        'purpose' => 'REGISTER',
        'valid' => 'Y'
      );

      $this->db->insert('token_tbl', $token_data);
      //variable yang di perlukan
      $email_to = $data['email'];
      $token_api = $token_data['token'];
      $nama = $data['nama'];
      $email = $data['email'];
      //send wa
      $api_nilai = $this->db->get_where('api_tbl', array(
        'nama_api' => 'RAPIWHA'
      ));
      // Send Message
      $ret = $api_nilai->row();
      $status = $ret->status;
      if ($status == 'Y') {
        //kirim wa
        $my_apikey = $ret->api;
        $phone = $data['phone'];
        $token_nilai = $token_data['token'];
        $destination = "62" . $phone;
        $link = base_url("verif/instant/$token_nilai");
        $message = "Anda registrasi dengan data :
Nama : $nama
Email : $email
Kode Verifikasi Anda :  $token_nilai
Atau klik link ini : $link";
        $api_url = "http://panel.rapiwha.com/send_message.php";
        $api_url .= "?apikey=" . urlencode($my_apikey);
        $api_url .= "&number=" . urlencode($destination);
        $api_url .= "&text=" . urlencode($message);
        $my_result_object = json_decode(file_get_contents($api_url, false));
        // echo "<br>Result: " . $my_result_object->success;
        // echo "<br>Description: " . $my_result_object->description;
        // echo "<br>Code: " . $my_result_object->result_code;
        //end send wa
        redirect("/email/send?emailto=$email_to&token=$token_api", "refresh");
      } else {
        //jika api mati hanya kirim email
        redirect("/email/send?emailto=$email_to&token=$token_api", "refresh");
      }
    }
  }




  //Update one item
  public function update($id = NULL)
  {
  }

  //Delete one item
  public function delete($id = NULL)
  {
    $this->db->where('id_user', $id);
    $this->db->delete('user_tbl');


    redirect('/proses', 'refresh');
  }
  public function notif_member()
  {
    $notif_member_new = $this->notif_model->push_member();
    $result['notif_member'] = $notif_member_new;
    $result['msg'] = "Berhasil direfresh secara realtime";
    //siapa member yang gabung
    $notif_member_who = $this->notif_model->push_member_siapa();
    $result['siapa_member'] = $notif_member_who['nama'];
    $result['email'] = $notif_member_who['email'];
    echo json_encode($result);
  }
}

/* End of file proses.php */
