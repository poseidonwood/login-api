<footer class="main-footer d-flex p-2 px-3 bg-white border-top">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Services</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Products</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Blog</a>
    </li>
  </ul>
  <span class="copyright ml-auto my-auto mr-2">Copyright © 2018
    <a href="https://designrevision.com" rel="nofollow">DesignRevision</a>
  </span>
</footer>
</main>
</div>
</div>
<?php
if ($this->session->userdata('user_role') !== 'admin') {
} else {

?>
  <div id="notifnya" class="promo-popup animated">
    <a href="#" class="pp-cta extra-action">
      <img src="<?= base_url(); ?>asset/images/avatars/default-picture.png" width="160"> </a>
    <!-- <div class="extra-action">
    <img src="<?= base_url(); ?>asset/images/avatars/default-picture.png" width="160"> </div> -->
    <div class="pp-intro-bar"><i id="notif_member"></i>
      <span class="close">
        <i class="material-icons">close</i>
      </span>
      <span class="up">
        <i class="material-icons">keyboard_arrow_up</i>
      </span>
    </div>
    <div id="load_div" class="pp-inner-content">
      <h2 id="siapa_member">Default_People</h2>
      <p id="email_member">Default_email</p>
      <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-white">
          <span class="text-success">
            <i class="material-icons">check</i>
          </span> Terima </button>
        <button type="button" class="btn btn-white">
          <span class="text-danger">
            <i class="material-icons">clear</i>
          </span> Tolak </button>
        <hr>
        <button type="button" class="btn btn-white">
          <span class="text-primary">
            <i class="material-icons">more_horiz</i>
          </span> More Member </button>
      </div>
    </div>
  </div>

  <!-- Realtime Notifikasi -->
  <script type="text/javascript">
    setInterval(function() {
      $.ajax({
        url: "<?= base_url() ?>proses/notif_member",
        type: "POST",
        dataType: "json", //datatype lainnya: html, text
        data: {},
        success: function(data) {
          $("#siapa_member").html(data.siapa_member);
          // alert(data.notif_member);
          if (data.notif_member == 0) {
            $('#notifnya').hide();
          } else {
            $('#notifnya').show();
            $("#notif_member").html(data.notif_member + " Orang Baru Saja Bergabung");
            $("#siapa_member").html(data.siapa_member);
            $("#email_member").html("Email: " + data.email);

          }
          // alert(data.notif_member);
        }
      });
    }, 2000);
  </script>
<?php
} ?>
<!-- Akhir Realtime Notifikasi -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
<script src="<?= base_url('asset/'); ?>scripts/extras.1.1.0.min.js"></script>
<script src="<?= base_url('asset/'); ?>scripts/shards-dashboards.1.1.0.min.js"></script>
<script src="<?= base_url('asset/'); ?>scripts/app/app-blog-overview.1.1.0.js"></script>
<script src="<?= base_url('asset/'); ?>scripts/app/app-blog-new-post.1.1.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.min.js"></script>
</body>

</html>