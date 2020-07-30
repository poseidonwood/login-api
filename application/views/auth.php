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
  <h1 class="error">Sign In Here</h1>
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
          <h2> Login Here / List User</h2>
        </a>
        <?php if (isset($error)) {
          echo $error;
        };
        if ($this->session->flashdata('notif_token')) {
          echo $this->session->flashdata('notif_token');
        }
        if ($this->session->flashdata('email_check')) {
          echo $this->session->flashdata('email_check');
        } ?>

        <form action="<?= base_url(); ?>login" method="post">
          <div class="form-left-to-w3l">
            <span class="fa fa-envelope-o" aria-hidden="true"></span>
            <input type="email" name="email" placeholder="Email" autofocus required>
            <div class="clear"></div>
          </div>
          <?= form_error('email'); ?>
          <div class="form-left-to-w3l ">
            <span class="fa fa-lock" aria-hidden="true"></span>
            <input type="password" id="mypassword" name="password" placeholder="Password" required="">
            <div class="clear"></div>
          </div>
          <?= form_error('password'); ?>
          <div class="main-two-w3ls">
            <div class="left-side-forget">
              <label for="password">
                <input type="checkbox" class="checked" onclick="showPassword()">
                <span id="password" class="remenber-me">Show Password</span>
              </label>
            </div>
            <div class="right-side-forget">
              <a href="<?= base_url('forget'); ?>" class="for">Forgot password...?</a>
            </div>
          </div>
          <div class="btnn">
            <button type="submit">Sign In </button>
          </div>
        </form>
        <div class="w3layouts_more-buttn">
          <h3>Don't Have an account..?
            <a href="<?= base_url('/home/signup'); ?>">Register Here
            </a>
          </h3>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>

  <script>
    function showPassword() {
      var x = document.getElementById("mypassword");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

  <!---728x90--->
  <footer class="copyrigh-wthree">
    <p>
      © 2019 Gadget Sign In Form. All Rights Reserved | Design by
      <a href="http://www.W3Layouts.com" target="_blank">W3Layouts</a>
    </p>
  </footer>
</body>

</html>