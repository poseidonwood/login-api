<?php


defined('BASEPATH') or exit('No direct script access allowed');

class WA extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('wa_model');
    $this->load->model('login_model');
  }

  // List all your items
  public function index()
  {
    if ($this->login_model->logged_id()) {
      if ($this->session->userdata('user_role') == 'admin') {
        $data = array(
          'title' => 'ADMIN - Dashboard '
        );
      } else {
        $data = array(
          'title' => 'Dashboard '
        );
      }
      $data['content'] = $this->db->get_where('nomor_tbl', array(
        'status' => 'Y'
      ));
      $this->wa_model->get_credit();
      $this->load->view('admin/wa', $data);
    } else {
      redirect('home/signin', 'refresh');
    }
  }
  public function Api_setting()
  {
    if ($this->login_model->logged_id()) {
      if ($this->session->userdata('user_role') == 'pegawai') {
        redirect('home');
      }
      $data['content'] = $this->db->get_where('nomor_tbl', array(
        'status' => 'Y'
      ));
      $data['api_list'] = $this->db->get('api_tbl');
      $this->wa_model->get_credit();
      $this->load->view('admin/api_setting', $data);
    } else {
      redirect('home/signin', 'refresh');
    }
  }
  public function simpan()
  {
    $data = array(
      'id_nomor' => $this->wa_model->generateId(4),
      'nama' => $this->input->post('nama'),
      'nomor' => $this->input->post('number'),
      'status' => 'Y'
    );
    if ($data['nama'] == null) {
      redirect('home', 'refresh');
    } else {
      $this->db->insert('nomor_tbl', $data);
      redirect('wa', 'refresh');
    }
  }

  public function kirim()
  {
    $data = array(
      'id_wa' => $this->wa_model->generateId(4),
      'nomor_wa' => $this->input->post('nomor'),
      'pesan_wa' => $this->input->post('pesan'),
      'status' => 'PENDING'
    );
    if ($data['nomor_wa'] == 'Kirim Semua Nomor') {
      $checking = $this->wa_model->check_nomor('nomor_tbl', array('status' => 'Y'));
      if ($checking != FALSE) {
        foreach ($checking as $resultnya) {
          $data_result = array(
            'id_wa' => $this->wa_model->generateId(4),
            'nomor_wa' => $resultnya->nomor,
            'pesan_wa' => $this->input->post('pesan'),
            'status' => 'PENDING'
          );
          // echo $data_result['nomor_wa'];
          $this->db->insert('wa_tbl', $data_result);
          $this->wa_model->wa_send($data_result['nomor_wa'], $data['pesan_wa'], $data_result['id_wa']);
        }
        $this->session->set_flashdata("notif", $data['nomor_wa'] . "<p>Sukses terkirim</p>");
        redirect('wa', 'refresh');
      } else {
        $this->session->set_flashdata("notif", "<p>Gagal terkirim</p>");
      }
      // $this->session->set_flashdata("notif", "<p>Sukses terkirim</p>");
      // redirect('wa', 'refresh');
    } else {
      $this->db->insert('wa_tbl', $data);
      $this->wa_model->wa_send($data['nomor_wa'], $data['pesan_wa'], $data['id_wa']);
      $this->session->set_flashdata("notif", $data['nomor_wa'] . "<p>Sukses terkirim</p>");
      redirect('wa', 'refresh');
      // echo $data['nomor_wa'];
    }
  }

  public function api_status($id_api, $status)
  {

    $this->db->where('id_api', $id_api);
    $this->db->update('api_tbl', array('status' => $status));
    $update = $this->db->affected_rows();
    if ($update) {
      if ($status == 'Y') {
        $notif = array('sukses' => "<span class='badge badge-success'>Active</span>");
      } else {
        $notif = array('sukses' => "<span class='badge badge-danger'>Non - Active</span>");
      }
      echo json_encode($notif);
    } else {
      $notif = array('sukses' => "<span class='badge badge-danger'>Gagal Update</span>");
      echo json_encode($notif);
    }
  }
}

/* End of file Controllername.php */
