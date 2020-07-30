<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wa_model extends CI_Model
{

  function generateId($length = null)
  {
    return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
  }

  function check_nomor($table, $field1)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($field1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
      return FALSE;
    } else {
      return $query->result();
    }
  }
  function get_credit()
  {
    //send wa
    $api_nilai = $this->db->get_where('api_tbl', array(
      'status' => 'Y'
    ), 1);
    // Send Message
    $ret = $api_nilai->row();
    if ($ret !== null) {
      $status = $ret->status;
      if ($status == 'Y') {
        //kirim wa
        $my_apikey = $ret->api;
        $api_url = "http://panel.rapiwha.com/get_credit.php";
        $api_url .= "?apikey=" . urlencode($my_apikey);
        $my_result_object = json_decode(file_get_contents($api_url, false));

        if ($my_result_object->credit == TRUE) {
          $saldo = round($my_result_object->credit, 3);
          if ($saldo < 1.0) {
            return $this->session->set_flashdata(array(
              'balance' => "$ $saldo <span class='badge bg-danger'>Limit</span> ",
              'api' => "$my_apikey"
            ));
          } else {
            return $this->session->set_flashdata(array(
              'balance' => "$ $saldo",
              'api' => "$my_apikey"
            ));
          }
        } else {
          return $this->session->set_flashdata('balance', "No Selected api");
        }
      } else {
        return $this->session->set_flashdata('balance', "No Selected api");
      }
    } else {
      return $this->session->set_flashdata('balance', "No Selected api");
    }
  }
  function get_credit_api($field1)
  {
    //send wa
    $api_nilai = $this->db->get_where('api_tbl', array(
      'nama_api' => 'RAPIWHA'
    ));
    // Send Message

    $my_apikey = $field1;
    $api_url = "http://panel.rapiwha.com/get_credit.php";
    $api_url .= "?apikey=" . urlencode($my_apikey);
    $my_result_object = json_decode(file_get_contents($api_url, false));

    if ($my_result_object->credit == TRUE) {
      $saldo = round($my_result_object->credit, 3);
      if ($saldo < 1.0) {
        return $this->session->set_flashdata('balance_api', "$ $saldo <span class='badge bg-danger'>Limit</span>");
      } else {
        return $this->session->set_flashdata('balance_api', "$ $saldo");
      }
    } else {
      return FALSE;
    }
  }
  function wa_send($phone, $pesan, $id_wa)
  {
    //send wa
    $api_nilai = $this->db->get_where('api_tbl', array(
      'status' => 'Y'
    ));
    // Send Message
    $ret = $api_nilai->row();
    // $status = $ret->status;
    if ($ret !== null) {
      //kirim wa
      $my_apikey = $ret->api;
      $destination = $phone;
      $message = $pesan;
      $api_url = "http://panel.rapiwha.com/send_message.php";
      $api_url .= "?apikey=" . urlencode($my_apikey);
      $api_url .= "&number=" . urlencode($destination);
      $api_url .= "&text=" . urlencode($message);
      $my_result_object = json_decode(file_get_contents($api_url, false));
      if ($my_result_object->success == "1") {
        $this->db->where('id_wa', $id_wa);
        $this->db->update('wa_tbl', array('status' => 'TERKIRIM'));
        $this->db->affected_rows();
      }
    } else {
      $this->session->set_flashdata("notif", "<p>Gagal terkirim (Api tidak aktif)</p>");
      redirect('wa', 'refresh');
    }
    // echo "<br>Result: " . $my_result_object->success;
    // echo "<br>Description: " . $my_result_object->description;
    // echo "<br>Code: " . $my_result_object->result_code;
    //end send wa

  }
}

/* End of file Login_model.php */
