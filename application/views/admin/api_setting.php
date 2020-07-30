<?php
$this->load->view('_partials/admin/head');
$this->load->view('_partials/admin/sidebar');
$this->load->view('_partials/admin/navbar');
?>
<!-- / .main-conntent -->
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle"><i class="fa fa-cog"> </i> API WA Setting</span>
      <h3 class="page-title"> RAPIWHA PROVIDER
      </h3>
    </div>
  </div>
  <!-- End Page Header -->

  <!-- Default Light Table -->
  <div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">[TAMBAH API]</h6>
        </div>
        <div class="card-body p-0 pb-3 text-center">
          <table class="table mb-0">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">No</th>
                <th scope="col" class="border-0">Api</th>
                <th scope="col" class="border-0">Api Balance</th>
                <th scope="col" class="border-0">Api Status</th>
                <th scope="col" class="border-0">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($api_list->result() as $api) {
                $id_api = $api->id_api;
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $api->api; ?></td>
                  <td><?php
                      $apinya = $api->api;
                      $this->wa_model->get_credit_api($apinya);
                      echo $this->session->flashdata('balance_api');
                      ?></td>
                  <td>
                    <?php
                    if ($api->status == 'Y') {
                      echo "<i id='result$id_api'><span class='badge badge-success'>Active</span></i>";
                    } else {
                      echo "<i id='result$id_api'><span class='badge badge-danger'>Non - Active</span></i>";
                    } ?>
                  </td>
                  <td>
                    <?php
                    if ($api->status == 'Y') {
                      echo "
                  <label class='switch'>
                  <input type='checkbox' checked id='$id_api' value='Y' onclick ='check_change$id_api()'  name='$id_api' class='form-control'>  <span class='slider round'></span>
                  </label>";
                    } else {
                      echo "
                  <label class='switch'>
                  <input type='checkbox' id='$id_api' value='Y' onclick ='check_change$id_api()'  name='$id_api' class='form-control'>  <span class='slider round'></span>
                  </label>";
                    } ?>

                  </td>
                </tr>
                <script>
                  function check_change<?= $id_api; ?>() {
                    var check<?= $id_api; ?> = document.getElementById("<?= $id_api; ?>");
                    var id_api = '<?= $id_api; ?>';
                    if (check<?= $id_api; ?>.checked == true) {
                      var status = 'Y';
                      // alert(check<?= $id_api; ?>.value);
                    } else {
                      var status = 'N';
                      // alert(check<?= $id_api; ?>.value);
                    }
                    $.ajax({
                      url: 'api_status/' + id_api + '/' + status,
                    }).done(function(data) {
                      var json = data,
                        obj = JSON.parse(json);
                      $("#result<?= $id_api; ?>").html(obj.sukses);
                    });
                  }
                </script>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Default Light Table -->
</div>
<?php
$this->load->view('_partials/admin/footer');
?>