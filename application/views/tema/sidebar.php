<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-pink elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style=" background:#fadadd; color: #787878;">
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
          <?php 
          $menu = $this->db->get('tb_menu')->result();
          $sub_menu = $this->db->get('tb_sub_menu')->result();
           ?>
          <?php foreach($menu as $mn): ?>
            <?php if(in_array($mn->id_menu, $this->session->userdata('dt_menu'))): ?>      
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon <?= $mn->icon; ?>"></i>
              <p>
                <?= $mn->menu; ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php foreach($sub_menu as $smn): ?>
              <?php if($mn->id_menu == $smn->id_menu): ?>
                <?php if(in_array($smn->id_sub_menu, $this->session->userdata('permission'))): ?>
            <li class="nav-item">
                <a href="<?= base_url($smn->url); ?>" class="nav-link">
                  <p><?= $smn->sub_menu; ?></p>
                </a>
              </li>
                <?php endif; ?>
            <?php endif; ?>
              
            <?php endforeach; ?>  

            </ul>
          </li>
          <?php endif; ?>
          <?php endforeach; ?>     

          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Daftar Product 
                <div class="right">(<i class="fas fa-key"></i> 1)</div>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?= base_url('Match/produk'); ?>" class="nav-link">
                  <p>Daftar &+ Product</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/kategori'); ?>" class="nav-link">
                  <p>Kategori</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/satuan'); ?>" class="nav-link">
                  <p>Satuan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/dt_servis'); ?>" class="nav-link">
                  <p>Data &+ Service</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/bahan'); ?>" class="nav-link">
                  <p>Daftar Bahan & Stock</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/diskon'); ?>" class="nav-link">
                  
                  <p>Data Diskon</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Cashier
                <div class="right">(<i class="fas fa-key"></i> 2)</div>
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
                  <p>Komisi Appointment</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/cancel'); ?>" class="nav-link">
                  <p>List Tamu Cancel</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/customer'); ?>" class="nav-link">
                  <p>Data Customer</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/daftar_app'); ?>" class="nav-link">
                  <p>Data Pendapatan Service</p>
                </a>
              </li>



              <li class="nav-item">
                <a href="<?= base_url() ?>match/order" class="nav-link">
                  <p>Penjualan Produk</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url() ?>match/list_penjualan" class="nav-link">
                  <p>Daftar Penjualan Produk</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/dp'); ?>" class="nav-link">
                  
                  <p>Data DP</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/data_void'); ?>" class="nav-link">
                  
                  <p>Void</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/invoice'); ?>" class="nav-link">
                  
                  <p>Invoice</p>
                </a>
              </li>

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

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Opname
                <div class="right">(<i class="fas fa-key"></i> 3)</div>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="<?= base_url('Match/opname'); ?>" class="nav-link">
                  <p>Opname Produk</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calculator"></i>
              <p>
              Accounting
              <div class="right">(<i class="fas fa-key"></i> 4)</div>
              </p>
            </a>
            <ul class="nav nav-treeview">

            
            <li class="nav-item">
                <a href="<?= base_url('Match/akun'); ?>" class="nav-link">
                  <p>Akun</p>  
                </a>
              </li> 
              

              <li class="nav-item">
                <a href="<?= base_url('Match/jurnal'); ?>" class="nav-link">
                  <p>Journal Pemasukan</p>  
                </a>
              </li>
            

              
              <li class="nav-item">
                <a href="<?= base_url('Match/pengeluaran'); ?>" class="nav-link">
                  <p>Journal Pengeluaran</p>  
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?= base_url('Match/buku_besar'); ?>" class="nav-link">
                  <p>Buku Besar</p>  
                </a>
              </li>
              
            <li class="nav-item">
                <a href="<?= base_url('Match/neraca_saldo'); ?>" class="nav-link">
                  <p>Neraca Saldo</p>  
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?= base_url('Match/jurnal_penyesuaian'); ?>" class="nav-link">
                  <p>Jurnal Penyesuaian</p>  
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?= base_url('Lajur'); ?>" class="nav-link">
                  <p>Neraca Lajur</p>  
                </a>
              </li>
            
              <li class="nav-item">
                <a href="<?= base_url('Match/jurnal_penutup'); ?>" class="nav-link">
                  <p>Jurnal Penutup</p>  
                </a>
              </li>
              
            <li class="nav-item">
                <a href="<?= base_url('Lajur/akumulasi'); ?>" class="nav-link">
                  <p>Akumulasi Aktiva</p>  
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Lajur/laporan_neraca'); ?>" class="nav-link">
                  <p>Laporan Neraca</p>  
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/laporan_laba_rugi'); ?>" class="nav-link">
                  <p>Laporan Laba / Rugi</p>  
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?= base_url('Match/daftar_komisi'); ?>" class="nav-link">
                  <p>Daftar Komisi Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/daftar_komisi_app'); ?>" class="nav-link">
                  <p>Daftar Komisi Appointment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Match/laporan_komisi?tgl1='.date('Y-m-').'01&tgl2='.date('Y-m-').'30'); ?>" class="nav-link">
                  <p>Daftar Komisi</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Match/laporan_pemasukan'); ?>" class="nav-link">                  
                  <p>Laporan Pemasukan</p>
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
                <div class="right">(<i class="fas fa-key"></i> 5)</div>
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
                  
                  <p>Tb User</p>
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
          <?php endif; ?>   -->


          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
