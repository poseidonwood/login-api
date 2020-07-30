<!DOCTYPE html>

<html lang="en">

<head>
  <title><?= $title; ?></title>
  <!-- Meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Gadget Sign Up Form Responsive Widget, Audio and Video players, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
  <script>
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- Meta tags -->
  <!-- font-awesome icons -->
  <link href="<?= base_url('asset/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <!-- //font-awesome icons -->
  <!--stylesheets-->
  <link href="<?= base_url('asset/css/style.css'); ?>" rel='stylesheet' type='text/css' media="all">
  <!--//style sheet end here-->
  <link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
</head>

<body>

  <!---728x90--->
  <div class="w3layouts-two-grids">
    <!---728x90--->
    <div class="mid-class">
      <div class="img-right-side">
        <h3>Manage Your Gadgets Account</h3>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget Lorem ipsum dolor sit
          amet, consectetuer adipiscing elit. Aenean commodo ligula ege</p>
        <img src="<?= base_url('asset/images/b11.png'); ?>" class="img-fluid" alt="">
      </div>
      <div class="txt-left-side">
        <a href="<?= base_url('/proses'); ?>">
          <h2> Forget Password</h2>
        </a>
        <form action="<?= base_url('forget/proses'); ?>" method="post">
          <div class="form-left-to-w3l ">
            <span class="fa fa-lock" aria-hidden="true"></span>
            <input type="password" name="password1" placeholder="Masukkan Password Baru Anda" required autofocus>
            <div class="clear"></div>
          </div>
          <div class="form-left-to-w3l ">
            <span class="fa fa-lock" aria-hidden="true"></span>
            <input type="password" name="password2" placeholder="Konfirmasi Password Baru Anda" required>
            <input type="hidden" name="id_user" value="<?php echo $this->input->get('id_user'); ?>">
            <div class="clear"></div>
          </div>
          <input type="hidden" name="token" value="<?php echo $token; ?>">


          <?php
          if ($this->session->flashdata('notif_token')) {
            echo $this->session->flashdata('notif_token');
          } else if ($this->session->flashdata('email_check')) {
            echo $this->session->flashdata('email_check');
          }  ?>

          <div class="right-side-forget">
            <button type="submit"> Ubah Password </button>
          </div>
        </form>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <!---728x90--->
  <footer class="copyrigh-wthree">
    <p>
      © 2019 Gadget Forget Form. All Rights Reserved | Design by
      <a href="http://www.W3Layouts.com" target="_blank">W3Layouts</a>
    </p>
  </footer>
</body>

</html>