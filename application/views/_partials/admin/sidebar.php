    <!-- <div class="color-switcher animated">
    <h5>Tema Warna</h5>
    <ul class="accent-colors">
      <li class="accent-primary active" data-color="primary">
        <i class="material-icons">check</i>
      </li>
      <li class="accent-secondary" data-color="secondary">
        <i class="material-icons">check</i>
      </li>
      <li class="accent-success" data-color="success">
        <i class="material-icons">check</i>
      </li>
      <li class="accent-info" data-color="info">
        <i class="material-icons">check</i>
      </li>
      <li class="accent-warning" data-color="warning">
        <i class="material-icons">check</i>
      </li>
      <li class="accent-danger" data-color="danger">
        <i class="material-icons">check</i>
      </li>
    </ul>
    <div class="actions mb-4">
      <a class="mb-2 btn btn-sm btn-primary w-100 d-table mx-auto extra-action"
        href="https://designrevision.com/downloads/shards-dashboard-lite/">
        <i class="material-icons">cloud</i> Download</a>
      <a class="mb-2 btn btn-sm btn-white w-100 d-table mx-auto extra-action"
        href="https://designrevision.com/docs/shards-dashboard-lite">
        <i class="material-icons">book</i> Documentation</a>
    </div>
    <div class="social-wrapper">
      <div id="social-share" data-url="https://designrevision.com/downloads/shards-dashboard-lite/"
        data-text="🔥 Check out Shards Dashboard Lite, a free and beautiful Bootstrap 4 admin dashboard template!"
        data-title="share"></div>
      <div class="loading-overlay">
        <div class="spinner"></div>
      </div>
    </div>
    <div class="close">
      <i class="material-icons">close</i>
    </div>
  </div>
  <div class="color-switcher-toggle animated pulse infinite">
    <i class="material-icons">settings</i>
  </div> -->
    <div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
          <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
              <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                  <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="<?= base_url('asset/'); ?>images/logo-poseidonwood.svg" alt="Shards Dashboard">
                  <span class="d-none d-md-inline ml-1">[Your Company & Logo]</span>
                </div>
              </a>
              <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
              </a>
            </nav>
          </div>
          <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
            <div class="input-group input-group-seamless ml-3">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-search"></i>
                </div>
              </div>
              <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search">
            </div>
          </form>
          <div class="nav-wrapper">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="<?= base_url(); ?>">
                  <i class="material-icons">dashboard</i>
                  <span>Dashboard</span>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link " href="components-blog-posts.html">
                  <i class="material-icons">vertical_split</i>
                  <span>Blog Posts</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="add-new-post.html">
                  <i class="material-icons">note_add</i>
                  <span>Add New Post</span>
                </a>
              </li> -->
              <?php
              $role = $this->session->userdata("user_role");
              $link_wa = base_url('wa');
              $link_api = base_url('wa/api_setting');
              $saldo = $this->session->flashdata('balance');
              if ($role == 'admin') {
                echo "
                <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-nowrap' data-toggle='dropdown' href='form-components.html' role='button' aria-haspopup='true' aria-expanded='false'>
                  <i class='material-icons'>supervisor_account</i>
                  <span>Admin Fitur</span>
                </a>
                <div class='dropdown-menu dropdown-menu-small'>
                  <a class='dropdown-item' href='$link_api'>
                    <i class='material-icons'>settings</i>API SETTING (RAPIWHA)</a>
                  <a class='dropdown-item' href='$link_wa'>
                    <i class='fa fa-whatsapp'></i>WA TEST ($saldo)</a>
                </div>
              </li>";
              } else {
                echo "
                <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-nowrap' data-toggle='dropdown' href='form-components.html' role='button' aria-haspopup='true' aria-expanded='false'>
                  <i class='material-icons'>supervisor_account</i>
                  <span>Fitur Dasar</span>
                </a>
                <div class='dropdown-menu dropdown-menu-small'>
                  <a class='dropdown-item' href='$link_wa'>
                    <i class='fa fa-whatsapp'></i>WA TEST ($saldo)</a>
                </div>
              </li>";
              }
              ?>
              <!-- 
              <li class="nav-item">
                <a class="nav-link " href="tables.html">
                  <i class="material-icons">table_chart</i>
                  <span>Tables</span>
                </a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link " href="<?= base_url('home/profile'); ?>">
                  <i class="material-icons">person</i>
                  <span>User Profile</span>
                </a>
              </li>
            </ul>
          </div>
        </aside>
        <!-- End Main Sidebar -->