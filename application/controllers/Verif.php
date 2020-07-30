<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verif extends CI_Controller
{


  public function index()
  {
    $data = array(
      'title' => 'Verification Page'
    );
    // echo "ini Halaman HOME";
    $this->load->view('verif', $data);
  }
  public function instant($verif_kode = null)
  {
    if ($verif_kode == null) {
      redirect('home', 'refresh');
    } else {
      // echo $verif_kode . "ada isiny";
      $data = array(
        'verifikasi' => $verif_kode
      );
      $cek = $this->db->get_where('token_tbl', array(
        'token' => $data['verifikasi'],
        'valid' => 'Y'
      ))->num_rows();

      if ($cek > 0) {
        //jika token tidak valid , data user di hapus
        $query = $this->db->get_where('token_tbl', array(
          'token' => $data['verifikasi']
        ))->row();
        $id_user = $query->id_user;
        if ($query->valid == 'N') {
          //delete tbl_user
          $this->db->where('id_user', $id_user);
          $this->db->delete('user_tbl');
          $data = array(
            'title' => 'Sign In Page'
          );
          $this->session->set_flashdata('notif_token', "<p>Token anda tidak valid, Silahkan daftar kembali. <br>");
          redirect('home/signup', 'refresh');
        } elseif ($query->purpose == 'USED') {
          //delete tbl_user
          $data = array(
            'title' => 'Sign In Page'
          );
          $this->session->set_flashdata('notif_token', "<p>Token yang anda pakai sudah terpakai , akun anda aktif. Silahkan Login</p><br>");
          redirect('home/signin', 'refresh');
        } else {
          //update akun jadi Y dan aktif
          $data_update = array('status' => 'Y');
          $query_update = $this->db->update('user_tbl', $data_update, array('id_user' => $id_user));
          if ($query_update) {
            $this->session->set_flashdata('notif_token', "<p>Akun anda sudah aktif. Silahkan Login</p><br>");
            //update token set purpose = done
            $data_update_token = array('purpose' => 'USED');
            $query_update_token = $this->db->update('token_tbl', $data_update_token, array('id_user' => $id_user));
            if ($query_update_token) {
              redirect('home/signin', 'refresh');
            } else {
              echo "error query update token";
            }
          }
        }
      } else {
        //keluar notif error
        $this->session->set_flashdata('notif_token', "<p>Kode verifikasi yang anda masukkan tidak kami ketahui</p>");
        redirect('/verif', 'refresh');
      }
    }
    // $this->load->view('verif', $data);
  }
  public function check()
  {
    $data = array(
      'verifikasi' => $this->input->post('verifikasi')
    );
    if (isset($data['verifikasi'])) {
      $cek = $this->db->get_where('token_tbl', array(
        'token' => $data['verifikasi'],
        'valid' => 'Y'
      ))->num_rows();

      if ($cek > 0) {
        //jika token tidak valid , data user di hapus
        $query = $this->db->get_where('token_tbl', array(
          'token' => $data['verifikasi']
        ))->row();
        $id_user = $query->id_user;
        if ($query->valid == 'N') {
          //delete tbl_user
          $this->db->where('id_user', $id_user);
          $this->db->delete('user_tbl');
          $data = array(
            'title' => 'Sign In Page'
          );
          $this->session->set_flashdata('notif_token', "<p>Token anda tidak valid, Silahkan daftar kembali. <br>");
          redirect('home/signup', 'refresh');
        } elseif ($query->purpose == 'USED') {
          //delete tbl_user
          $data = array(
            'title' => 'Sign In Page'
          );
          $this->session->set_flashdata('notif_token', "<p>Token yang anda pakai sudah terpakai , akun anda aktif. Silahkan Login</p><br>");
          redirect('home/signin', 'refresh');
        } else {
          //update akun jadi Y dan aktif
          $data_update = array('status' => 'Y');
          $query_update = $this->db->update('user_tbl', $data_update, array('id_user' => $id_user));
          if ($query_update) {
            $this->session->set_flashdata('notif_token', "<p>Akun anda sudah aktif. Silahkan Login</p><br>");
            //update token set purpose = done
            $data_update_token = array('purpose' => 'USED');
            $query_update_token = $this->db->update('token_tbl', $data_update_token, array('id_user' => $id_user));
            if ($query_update_token) {
              redirect('home/signin', 'refresh');
            } else {
              echo "error query update token";
            }
          }
        }
      } else {
        //keluar notif error
        $this->session->set_flashdata('notif_token', "<p>Kode verifikasi yang anda masukkan tidak kami ketahui</p>");
        redirect('/verif', 'refresh');
      }
    } else {
      redirect('/verif', 'refresh');
    }
  }
}
