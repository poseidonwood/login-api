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
              $user_id = $this->session->userdata("user_id");
              $base = base_url();
              $role_management = $this->db->query("select *from hakakses_tbl where id_user ='$user_id'");

              foreach ($role_management->result() as $role_m) {
                $id_menu = $role_m->id_menu;
                $role = $role_m->role;
                if ($role == 1) {
                  $menu = $this->db->query("select *from menu_tbl where  (premium = 'Y' or premium = 'N')");
                } else {
                  $premium = 'N';
                  $menu = $this->db->query("select *from menu_tbl where id_menu = '$id_menu' and premium = '$premium'");
                }
                foreach ($menu->result() as $menus) {

                  if ($menus->sub_active == 'Y') {

                    echo
                      "<li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle text-nowrap' data-toggle='dropdown' href='$base$menus->link_menu' role='button' aria-haspopup='true' aria-expanded='false'>
                    <i class='$menus->icon_menu'></i>
                    <span>$menus->nama_menu</span>
                  </a>
                  <div class='dropdown-menu dropdown-menu-small'>
                  ";
                    $a = $menus->id_menu;
                    $submenu = $this->db->query("select *from submenu_tbl where id_menu = '$a'");
                    foreach ($submenu->result() as $sub) {
                      if ($sub->active == 'Y') {
                        echo "
  <a class='dropdown-item' href='$base$sub->link'>
    <i class='$sub->icon_submenu'></i>$sub->nama_submenu</a>";
                      }
                    }
                    echo "</div>
                  </li>";
                  } else {

                    echo
                      "<li class='nav-item dropdown'>
                  <a class='nav-link' href='$base$menus->link_menu'>
                    <i class='$menus->icon_menu'></i>
                    <span>$menus->nama_menu</span>
                  </a></div>
                  </li>";
                  }
                }
              }

              ?>

              <!-- 
              <li class="nav-item">
                <a class="nav-link " href="tables.html">
                  <i class="material-icons">table_chart</i>
                  <span>Tables</span>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a class="nav-link " href="<?= base_url('home/profile'); ?>">
                  <i class="material-icons">person</i>
                  <span>User Profile</span>
                </a>
              </li> -->
            </ul>
          </div>
        </aside>
        <!-- End Main Sidebar -->