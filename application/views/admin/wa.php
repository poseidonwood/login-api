<?php
$this->load->view('_partials/admin/head');
$this->load->view('_partials/admin/sidebar');
$this->load->view('_partials/admin/navbar');
?>
<!-- / .main-navbar -->
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle"><i class="fa fa-whatsapp"></i> WA TEST</span>
      <h3 class="page-title"> Kirim WA</h3>
    </div>
  </div>
  <!-- End Page Header -->
  <div class="row">
    <div class="col-lg-9 col-md-12">
      <!-- Add New Post Form -->
      <div class="card card-small mb-3">
        <div class="card-body">
          <form class="add-new-post" action="<?= base_url('wa/kirim'); ?>" method="POST">
            <div class="input-group mb-3">
              <select class="form-control" name="nomor">
                <?php
                foreach ($content->result() as $key) {
                  echo "<option value='$key->nomor'>$key->nomor - $key->nama</option>";
                } ?>
                <option value="Kirim Semua Nomor">Kirim Semua Nomor</option>
              </select>
              <div class="input-group-append">
                <button type="submit" class="btn btn-sm btn-accent">
                  <i class="material-icons mr-1">send</i> Send</button>

              </div>
            </div>
            <textarea rows="10" name="pesan" class="form-control form-control-lg mb-3"></textarea>
          </form>
        </div>
      </div>
      <!-- / Add New Post Form -->
    </div>
    <div class="col-lg-3 col-md-12">
      <!-- Post Overview -->
      <div class='card card-small mb-3'>
        <div class="card-header border-bottom">
          <h6 class="m-0">Status</h6>
        </div>
        <div class='card-body p-0'>
          <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
              <?php if ($this->session->flashdata('notif')) {
                $notif_status = $this->session->flashdata('notif');
                echo "
        <span class='d-flex mb-2'>
                <i class='material-icons mr-1'>send</i>
                <strong class='mr-1'>Sending:</strong>
              </span>
              <strong class=''>$notif_status</strong>
              ";
              } ?>
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">account_balance_wallet</i>
                <strong class="mr-1">Saldo:</strong>
                <strong class=""><?= $this->session->flashdata('balance'); ?></strong>
              </span>
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">vpn_key</i>
                <strong class="mr-1">API Key:</strong>
              </span>
              <strong class="text-success"><?= $this->session->flashdata('api'); ?></strong>
            </li>
            <li class="list-group-item d-flex px-3">
              <button class="btn btn-sm btn-outline-accent" data-toggle="modal" data-target="#penerima">
                <i class="material-icons">save</i> Tambah Penerima</button>
            </li>
          </ul>
        </div>
      </div>
      <!-- / Post Overview -->
    </div>
  </div>
</div>


<!-- Modal Penerima -->
<!-- Modal -->
<div class="modal fade" id="penerima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Penerima</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel panel-default">
          <div class="panel-body">
            <form action="<?= base_url('wa/simpan'); ?>" method="POST">
              <div class="form-group">
                <label for="exampleFormControlInput1">Nomor Telpon</label>
                <input type="number" name="number" class="form-control" id="exampleFormControlInput1" placeholder="62(ganti 0 dengan 62 / tambahkan 62 jadi 628233xxx" required autofocus>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Nama(GK WAJIB)</label>
                <input type="text" name="nama" class="form-control" id="exampleFormControlInput1" value="Guest" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- End Modal penerima -->
<?php
$this->load->view('_partials/admin/footer');
?>