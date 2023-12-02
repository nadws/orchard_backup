<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= $title; ?></title>
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>loading.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/css/'); ?>OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/css/'); ?>adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/css/'); ?>bootstrap-4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('asset/'); ?>ambil/apis.css">
  <link rel="stylesheet" href="<?= base_url('asset/'); ?>popover.js">
  <link rel="icon" type="image/png" href="<?= base_url('asset/');  ?>orchard_small.png" />
  <link rel="stylesheet" href="<?= base_url() ?>asset/time/jquery.skedTape.css">
</head>

<style type="text/css">
  .tombolmenu:hover {
    background-color: white;
    color: blue;

  }

  .bg-gradient {
    background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
    color: white;
  }

  table {
    text-align: left;
    position: relative;
    /* border-collapse: collapse; */
    /* font-family: Arial; */

  }

  /* th, td {
    padding: 0.25rem;
  } */

  th {
    background: #fadadd;
    position: sticky;
    color: #787878;
    top: 0;
    /*box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);*/
    /* border: #F78CA0; */
  }

  /* td {
    text-transform: lowercase;
  } */


  #loading {
    width: 60px;
    height: 60px;
    border: solid 5px #ccc;
    border-top-color: #ff6a00;
    border-radius: 100%;

    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    margin: auto;


    animation: putar 1s linear infinite;
  }

  @keyframes putar {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
    color: #787878;
  }
</style>

<!-- <?php
      $beda = $this->session->userdata('salon');
      if (!$beda) {

        redirect('Login');
        exit;
      }

      ?> -->

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style=" background:#fadadd; color: #787878;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <?php
      $bulan = date('m');
      $days = date('d');
      $ultah = $this->db->query("SELECT * FROM tb_customer as a where month(a.tanggal_lahir) = '$bulan' and Day(a.tanggal_lahir) = '$days'")->result();


      foreach ($ultah as $no => $u) {
        $count = $no + 1;
      }
      ?>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown mr-4">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-birthday-cake"></i>
            <span class="badge badge-danger navbar-badge"><?= empty($count) ? '' : "$count" ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php foreach ($ultah as $no => $u) : ?>
                   
              <a href="#" class="dropdown-item" onclick="wa(<?= (String) $u->telepon ?>)">
                <div class="media">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      <?= $u->nama ?>
                      <span class="float-right text-sm "><i class="fas fa-calendar-minus"></i></span>
                    </h3>
                    <p class="text-sm text-muted"><i class="fas fa-mobile-alt mr-1"></i> <?= $u->telepon ?> </p>
                    <p class="text-sm text-muted"><i class="fas fa-calendar-week mr-1"></i> <?= date('d-m-Y', strtotime($u->tanggal_lahir)) ?></p>
                  </div>
                </div>

              </a>
              <div class="dropdown-divider"></div>
            <?php endforeach ?>
          </div>
        </li>

        <li class="nav-item mr-2">
          <a href="<?= base_url('Login/logout'); ?>" id="tombolmenu" class="nav-link shadow"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
        <!-- Notifications Dropdown Menu -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <div class="modal fade" id="modal-user">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #FFA07A;">
            <h4 class="modal-title">Data User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style=" font-size: 20px;">
            <?= $this->session->userdata('nm_user'); ?>
            <hr>
            <?= $this->session->userdata('username'); ?>
            <hr>
            <?= $this->session->userdata('password'); ?>
            <hr>
            <?= $this->session->userdata('email'); ?>
            <hr>
            <?= $this->session->userdata('id_role'); ?>
            <hr>
          </div>
        </div>
      </div>
    </div>
    <script>
        function wa(no) {
            location.href = "https://wa.me/62"+no
        }
        
        var loading = document.getElementById('loading');

        window.addEventListener('load', function() {
            loading.style.display = "none";
        })
    </script>
    <?php $this->load->view('tema/sidebar'); ?>