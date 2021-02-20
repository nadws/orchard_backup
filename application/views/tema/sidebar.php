<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-pink elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style=" background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%); color: white;">
      <img src="<?= base_url('asset/');  ?>orchard_small.png" alt="Orchard Beauty Product" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">ORCHARD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
              <p>
              Appointment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Match/app'); ?>" class="nav-link">
                  <p>Appointment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/appoiment'); ?>" class="nav-link">
                  <p>App</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/cancel'); ?>" class="nav-link">
                  <p>Cancel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/customer'); ?>" class="nav-link">
                  <p>Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/dt_servis'); ?>" class="nav-link">
                  <p>Service</p>
                </a>
              </li>
            </ul>
          </li>  

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Produk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Match/kategori'); ?>" class="nav-link">
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/produk'); ?>" class="nav-link">
                  <p>Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url() ?>match/order" class="nav-link">
                  <p>Penjualan Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/kelolaProduk'); ?>" class="nav-link">
                  <p>Kelola Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/produk_masuk'); ?>" class="nav-link">
                  <p>Produk Masuk</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Catatan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Match/absen'); ?>" class="nav-link">                  
                  <p>Absen Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/denda'); ?>" class="nav-link">                  
                  <p>Denda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/kasbon'); ?>" class="nav-link">
                  
                  <p>Kasbon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/tips'); ?>" class="nav-link">
                  
                  <p>Tips</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($this->session->userdata('id_role')=='1'): ?>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-caret-square-down"></i>
              <p>
                More
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Match/dt_anak'); ?>" class="nav-link">
                  
                  <p>Tb Karyawan</p>
                </a>
              </li>
              <?php if ($this->session->userdata('id_role')=='1'): ?>
                <li class="nav-item">
                <a href="<?= base_url('Match/dt_user'); ?>" class="nav-link">
                  
                  <p>Tn User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/trash'); ?>" class="nav-link">
                  
                  <p>Clear-Data</p>
                </a>
              </li>
              <?php endif; ?>              
            </ul>
          </li>
          <?php endif; ?>  


          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">