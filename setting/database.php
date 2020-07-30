<?php
$koneksi = mysqli_connect("localhost", "root", "", "api");

// Check connection
if (mysqli_connect_errno()) {
  echo "Koneksi database gagal : " . mysqli_connect_error();
}
$useragent = $_SERVER['HTTP_USER_AGENT'];


function generateRandomString($length = 4)
{
  return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
}
