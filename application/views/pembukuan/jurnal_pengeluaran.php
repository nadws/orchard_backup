<?php $this->load->view('tema/Header', $title); ?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css" rel="stylesheet">


<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script>
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<style type="text/css">
  .modal .modal-dialog-aside {
    width: 350px;
    max-width: 80%;
    height: 500px;
    margin: 0;
    transform: translate(0);
    transition: transform .2s;
  }


  .modal .modal-dialog-aside .modal-content {
    height: inherit;
    border: 0;
    border-radius: 0;
  }

  .modal .modal-dialog-aside .modal-content .modal-body {
    overflow-y: auto
  }

  .modal.fixed-left .modal-dialog-aside {
    margin-left: auto;
    transform: translateX(100%);
  }

  .modal.fixed-right .modal-dialog-aside {
    margin-right: auto;
    transform: translateX(-100%);
  }

  .modal.show .modal-dialog-aside {
    transform: translateX(0);
  }

  .th {
    top: 93px;
  }

  .acc {
    top: 60px;
  }
</style>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->

<div class="content-header">
  <div class="container">

    <div class="row mb-2">
      <!-- <div class="col-sm-12">
					<h1 class="m-0 text-dark">Jurnal</h1>
				</div> -->
      <div class="col-sm-6">
        <?php if ($this->session->userdata('edit_hapus') == '1') : ?>
          <!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
          <!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
          <!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
          <!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
        <?php endif ?>
      </div>
      <!-- <div class="col-5 mt-2">
					<a href="<?= base_url('match/order'); ?>" class="btn btn-warning">Kembali</a>
				</div> -->
    </div>
  </div>

  <?php
  $tdebit = 0;
  $tkredit = 0; 
    foreach($jurnal as $jr){
      $tdebit += $jr->debit;
      $tkredit += $jr->kredit;
    }
  ?>
  <div class="row justify-content-center">
    <div class="col-md-12">

    </div>
    <div class="col-12">
      <?= $this->session->flashdata('message'); ?>
      <div class="card">
        <div class="card-header">
          <h4 class="float-left">Jurnal Pengeluaran <?= $sort ?></h4>
          <!--<a href="<?= base_url("Match/bayar_bkin") ?>" class="btn btn-sm btn-outline-secondary float-right ml-2"><i class="fas fa-box-open"></i> Bayar Bk-in</a>-->
          <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
          <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-data"><i class="fa fa-eye"></i> View</button>
          <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#export-data"><i class="fas fa-file-export"></i> Export</button>
          <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#export-data-cash-flow"><i class="fas fa-file-export"></i> Export Cash Flow</button>
        
        <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#add_post_center"><i class="fa fa-plus"></i> Post Center</button>
        </div>

        <div>

        <!-- <a href="<?= base_url("Match/rekapitulasi_pengeluaran?tgl1=$tgl1&tgl2=$tgl2") ?>" class="float-right ml-2 text-dark">Kredit (<strong><?= number_format($tkredit,0) ?></strong>)</a>
        <a href="<?= base_url("Match/rekapitulasi_pengeluaran?tgl1=$tgl1&tgl2=$tgl2") ?>" class="float-right ml-2 text-dark">Debit (<strong><?= number_format($tdebit,0) ?></strong>)</a> -->
        
        <!-- <p class="float-right ml-2">Kredit (<strong><?= number_format($tdebit,0) ?></strong>)</p>
          <p class="float-right ml-2">Debit (<strong><?= number_format($tkredit,0) ?></strong>)</p> -->
        </div>

        <div class="card-body">

          <table class="table mt-2 display" id="pengeluaran">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Nota</th>
                <th>No id</th>
                <th>No Akun</th>
                <th>Nama Akun</th>
                <th>Keterangan</th>
                <th>Debit <a href="<?= base_url("Match/rekapitulasi_pengeluaran?tgl1=$tgl1&tgl2=$tgl2") ?>" class="text-dark">(<strong><small><?= number_format($tdebit,0) ?></small></strong>)</a></th>
                <th>Kredit <a href="<?= base_url("Match/rekapitulasi_pengeluaran?tgl1=$tgl1&tgl2=$tgl2") ?>" class="text-dark">(<strong><small><?= number_format($tkredit,0) ?></small></strong>)</a></th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($jurnal)) {
                $jurnal1 = $jurnal[0];
                $tgl = $jurnal1->tgl;
                $kd_gabungan1 = $jurnal1->kd_gabungan;
                $no = 0;
                $i = 1;
              }

              foreach ($jurnal as $p) : ?>

                <?php if ($kd_gabungan1 != $p->kd_gabungan) {
                  $no += 1;
                  $kd_gabungan1 = $p->kd_gabungan;
                  $tgl = $p->tgl;
                }
                if ($no % 2 == 0) : ?>
                  <tr style="background: #EEEEEE;">

                  <?php endif; ?>
                  <td><?= $i++ ?></td>
                  <?php if ($tgl != '') : ?>
                    <td><?= date('d-m-y', strtotime($tgl)) ?></td>
                  <?php else : ?>
                    <td></td>
                  <?php endif; ?>
                  <td><?= $p->no_nota ?></td>
                  <td><?= $p->no_urutan ?></td>
                  <td><?= $p->no_akun ?></td>
                  <td><?= $p->nm_akun ?></td>
                  <td><?= $p->ket ?></td>
                  <td><?= number_format($p->debit, 2) ?></td>
                  <td><?= number_format($p->kredit, 2) ?></td>
                  <td>
                    <button type="button" class="btn btn-sm btn-outline-secondary btn_edit" kd_gabungan='<?= $p->kd_gabungan ?>' data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                    <a class="btn btn-sm btn-outline-secondary" href="<?= base_url('Match/drop_pengeluaran/') ?><?= $p->kd_gabungan ?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
                  </td>
                  </tr>
                  <?php if ($kd_gabungan1 == $p->kd_gabungan) {
                    $tgl = '';
                  } ?>
                <?php endforeach; ?>
            </tbody>
          </table>
        </div>


      </div>

    </div>
  </div>


</div>
</div>

<style>
  .modal-lg {
    max-width: 900px;
    margin: 2rem auto;
  }
</style>

<form method="POST" action="<?= base_url('Jurnal/add_post_center') ?>">
<div class="modal fade" id="add_post_center" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Post Center</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        <div class="col-6">
              <div class="form-group">
                <label for="list_kategori">Akun</label>
                <select name="id_akun" class="form-control select" required="">
                  <option value="">-Pilih Akun-</option>
                  <?php foreach ($akun_all as $a) : ?>
                    <option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="form-group col-6 ">
              <label>Post center</label>
              <input type="text" name="nm_post" class="form-control" required>
            </div>


          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Seve</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal -->
<form action="" method="POST" id="form-jurnal">
  <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h5 class="modal-title" id="exampleModalLabel">Jurnal Pengeluaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">

            <div class="col-sm-3 col-md-3">
              <div class="form-group">
                <label for="list_kategori">Tanggal</label>
                <input class="form-control" type="date" name="tgl" id="tgl" required>

              </div>
            </div>

            <div class="mt-3 ml-1">
              <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>
            </div>


            <div class="col-sm-4 col-md-4">
              <div class="form-group">
                <label for="list_kategori">Akun</label>
                <select name="id_akun" id="id_akun" class="form-control select" required="">
                  <?php foreach ($akun_all as $a) : ?>
                    <option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="col-sm-2 col-md-2">
              <div class="form-group">
                <label for="list_kategori">Debit</label>
                <input type="number" class="form-control total" id="total" name="total" readonly>
              </div>
            </div>
            <div class="col-sm-2 col-md-2">
              <div class="form-group">
                <label for="list_kategori">Kredit</label>
                <input type="number" class="form-control" readonly>
              </div>
            </div>

            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                <input type="text" placeholder="Nomor id" name="no_urutan" class="form-control" required>
              </div>
            </div>

            <div class="mt-1">
              <p class="mt-1 ml-3 text-warning"><strong>Cr</strong></p>
            </div>

            <div class="col-sm-4 col-md-4">
              <div class="form-group">
                <select name="metode" id="metode" class="form-control select" required>
                  <?php foreach ($akun_all as $k) : ?>
                    <option value="<?= $k->id_akun ?>"><?= $k->nm_akun ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-sm-2 col-md-2">
              <div class="form-group">

                <input type="number" class="form-control" readonly>
              </div>
            </div>
            <div class="col-sm-2 col-md-2">
              <div class="form-group">

                <input type="number" id="total1" class="form-control total" readonly>
              </div>
            </div>

          </div>

          <div class="detail" id="no_bkin">
              <div class="row">
                    <div class="col-sm-3 col-md-3">
                      <div class="form-group">
                        <label for="list_kategori">No Bk-in</label>
                        <input type="text" class="form-control input_detail input_bkin" name="no_bkin">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                    <br>
                    <p class="text-warning mt-2">Hapus PPN jika bayar dengan hutang BKIN</p>
                    </div>
              </div>      
          </div>

          

           <!-- bkin ///////////-->
           <div id="bkin" class="detail">

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="list_kategori">Produk</label>
          <select name="id_produk[]" class="form-control select id_produk input_detail input_bkin" detail="1" required>
            <option>-- Pilih Produk --</option>
            <?php foreach($produk as $p): ?>
             <option value="<?= $p->id_produk ?>"><?= $p->nm_produk ?></option>
           <?php endforeach; ?>                 
         </select> 

       </div>                            
     </div>


     <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">SKU</label>
        <input type="text" class="form-control input_detail input_bkin" id="sku1" name="sku[]"  readonly>                                        
      </div>                            
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">Satuan</label>
        <input type="text" class="form-control input_detail input_bkin" id="satuan1" name="satuan[]" readonly>                                        
      </div>                            
    </div>

    <div class="col-md-1">
      <div class="form-group">
        <label for="list_kategori">Qty</label>
        <input type="text" class="form-control qty1 input_detail input_bkin" qty="1" name="qty[]" placeholder="0" required>                                        
      </div>                            
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">Rp/Satuan</label>
        <input type="text" class="form-control rp_beli rp_beli1 input_detail input_bkin" rp_beli="1" name="rp_beli[]" placeholder="0" required>                                        
      </div>                            
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">PPN</label>
        <input type="text" class="form-control ppn ppn1 input_detail input_bkin" ppn="1" name="ppn[]" placeholder="0">                                        
      </div>                            
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="list_kategori">Rp + Pajak</label>
        <input type="text" class="form-control rp_pajak rp_pajak1 input_detail input_bkin" rp_pajak="1" name="rp_pajak[]" placeholder="0" required>                                        
      </div>                            
    </div>

    <div class="col-3">
     <div class="form-group">
      <label for="list_kategori" >Monitoring</label> <br>
      <label class="normal" for="01">
        <input id="1" type="checkbox" name="mon[]" value="y" class="on1 mon1" onchange="autofill_mon(this)"> ON
      </label> <br>
      <label class="normal" for="02">
        <input id="1" type="checkbox" name="mon[]" value="t" class="off1 mon1" onchange="autofill_mon(this)">  OFF
      </label>
    </div>
  </div>

</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div id="detail_bkin">

</div>
</div>
</div>  

<div align="right" class="mt-2">
<button type="button" id="tambah_bkin" class="btn-sm btn-success">Tambah</button>
</div>

</div>

          <!-- monitoring ///////////-->

          <div id="monitoring" class="detail">
            <hr>

            <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Keterangan</label>
                  <input type="text" class="form-control input_detail input_monitoring" name="ket[]" required>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">Satuan</label>
                  <select name="id_satuan[]" class="form-control select satuan input_detail input_monitoring" required>
                    <?php foreach ($satuan as $p) : ?>
                      <option value="<?= $p->id_satuan ?>"><?= $p->satuan ?></option>
                    <?php endforeach; ?>
                  </select>

                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">Qty</label>
                  <input type="text" class="form-control input_detail input_monitoring qty_monitoring1" qty=1 name="qty[]" required>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">Rp/Satuan</label>
                  <input type="text" class="form-control input_detail input_monitoring rp_satuan1 rp_satuan" name="rp_beli[]" rp_satuan='1' required>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">Total Rp</label>
                  <input type="text" class="form-control  input_detail input_monitoring total_rp total_rp1" name="ttl_rp[]" total_rp='1' required>
                </div>
              </div>

            </div>

            <div id="detail_monitoring">

            </div>

            <div align="right" class="mt-2">
              <button type="button" id="tambah_monitoring" class="btn-sm btn-success">Tambah</button>
            </div>

          </div>

          <!-- aktiva gantung -->


          <!-- <div id="aktiva_gantung" class="detail">
            <hr>
            
            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label for="list_kategori">Post Center</label>
                  <select name="id_post_center" id="select_post_center" class=" select form-control input_detail input_aktiva_gantung" id="detail_post_center">

                  </select>
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" >Tambah Post Center</button>
                  </span>
                </div>
              </div>  
            
              <div class="col-md-4">
                <div class="form-group">
                  <label for="list_kategori">Keterangan</label>
                  <input type="text" class="form-control input_detail input_aktiva_gantung" name="ket[]" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Total Rp</label>
                  <input type="text" class="form-control  input_detail input_aktiva_gantung total_rp" name="ttl_rp[]" required>
                </div>
              </div>

            </div>

          </div> -->
          <!-- end aktiva gantung -->

          <!-- Aktiva -->
          <div id="aktiva" class="detail">
            <hr>


            <div class="row">
              <!-- <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Kelompok</label>
                  <select name="id_kelompok[]" class="form-control select id_kelompok input_detail input_aktiva" detail="1" required>
                    <option>-- Pilih Kelompok --</option>
                    <?php foreach ($aktiva as $p) : ?>
                      <option value="<?= $p->id_kelompok ?>"><?= $p->nm_kelompok ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div> -->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Keterangan</label>
                  <input type="text" class="form-control input_detail input_aktiva" name="ket[]" required>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <label for="list_kategori">Qty</label>
                  <input type="text" class="form-control input_detail input_aktiva qty_aktiva1" id="txt3" qty=1 onkeyup="sum();" name="qty[]" required>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">Rp/Satuan</label>
                  <input type="text" class="form-control input_detail input_aktiva rp_satuan1 rp_satuan_aktiva" id="txt1" name="rp_satuan[]" onkeyup="sum();" rp_satuan='1' required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">PPN</label>
                  <input type="number" class="form-control input_detail input_aktiva total_rp_new1 pajak_tes" id="txt2" onkeyup="sum();" name="ppn[]" rp_satuan='1'>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">Rp + Pajak</label>
                  <input type="text" class="form-control  input_detail input_aktiva pajak_aktiva pajak_aktiva1" id="total2" name="ttl_rp[]" total_rp='1' required>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="list_kategori">Post</label>
                  <input type="text" class="form-control  input_detail input_aktiva pajak_aktiva pajak_aktiva1" id="total2" name="ttl_rp[]" total_rp='1' required>
                </div>
              </div>
              <!-- <div class="col-lg-2">
                <div class="form-group">
                  <input type="button" id="tambah_aktiva" class="btn-sm mt-4 btn-success" value="Tambah">
                </div>
              </div> -->

            </div>

            <div id="detail_aktiva">

            </div>

            <hr>
            <div class="row justify-content-center">
              <div class="col-lg-10">
                <table class="table table-bordered table-sm" width="100%">
                  <thead style="text-align: center;">
                    <tr>
                      <th></th>
                      <th width="15%">Nama Kelompok</th>
                      <th width="15%">Umur</th>
                      <th width="70%">Barang</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($aktiva as $a) : ?>
                      <tr>
                        <td><input type="radio" name="id_kelompok[]" id="" value="<?= $a->id_kelompok ?>"></td>
                        <td><?= $a->nm_kelompok ?></td>
                        <td><?= $a->umur ?> Tahun</td>
                        <td><?= $a->barang_kelompok ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>

          <!-- non-monitoring -->

          <div id="non_monitoring" class="detail">
            <hr>

            <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Post Center</label>
                  <select name="id_post_center[]" class=" select form-control input_detail input_non_monitoring detail_post_center detail_post_center1" >

                  </select>
                </div>
              </div>
              

              <div class="col-md-4">
                <div class="form-group">
                  <label for="list_kategori">Keterangan</label>
                  <input type="text" class="form-control input_detail input_non_monitoring" name="ket[]" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Total Rp</label>
                  <input type="text" class="form-control  input_detail input_non_monitoring total_rp" name="ttl_rp[]" required>
                </div>
              </div>

            </div>

            <div id="detail_non_monitoring">


            </div>

            <div align="right" class="mt-2">
              <button type="button" id="tambah_non_monitoring" class="btn-sm btn-success">Tambah</button>
            </div>

          </div>

          <!-- prive -->

          <div id="prive" class="detail">
            <hr>

            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label for="list_kategori">Keterangan</label>
                  <input type="text" class="form-control input_detail input_prive" name="ket" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Total Rp</label>
                  <input type="text" class="form-control  input_detail input_prive total_rp" name="ttl_rp" required>
                </div>
              </div>

            </div>

            <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                  <select name="laba" class="form-control select input_detail input_prive" required>
                    <?php foreach ($laba as $l) : ?>
                      <option value="<?= $l->id_akun ?>"><?= $l->nm_akun ?></option>
                    <?php endforeach; ?>
                  </select>

                </div>
              </div>
            
            </div> 

          </div>            

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Input</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- modal tambah post center -->
<form  id="form_modal_post_center">
<div class="modal fade" id="tambah_post_center" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Post Center</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        <input type="hidden" name="id_akun" id="id_akun_post">

          <div class="col-md-12">
              <div class="form-group">
                  <label for="list_kategori">Nama Post Center</label>
                  <input class="form-control" type="text" name="nm_post" required>             
              </div>                                          
          </div>

    
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Seve</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- end tambah post center -->


<!-- modal edit -->
<form action="<?= base_url('Match/edit_jurnal_pengeluaran') ?>" method="POST" id="form-jurnal">
  <div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-lg">
    
    <input type="hidden" name="tgl1" value="<?= $tgl1 ?>">
    <input type="hidden" name="tgl2" value="<?= $tgl2 ?>">
      <!-- Modal content-->
      <!-- <form action="<?= base_url() ?>match/app_add_order_multiple2" method="post"> -->
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h4 class="modal-title">Edit Journal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="get_jurnal">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Save/Edit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>

</form>

<!-- Modal View -->
<form action="" method="GET">
  <div class="modal fade" id="view-data" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="form-group col-12 col-md-6">
              <label>Dari</label>
              <input type="date" name="tgl1" class="form-control" required>
            </div>
            <div class="form-group col-12 col-md-6">
              <label>Sampai</label>
              <input type="date" name="tgl2" class="form-control" required>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Lihat</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Eport -->
<form action="<?= base_url('Match/excel_pengeluaran') ?>" method="GET">
  <div class="modal fade" id="export-data" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h5 class="modal-title" id="exampleModalLabel">Export data perperiode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="form-group col-12 col-md-6">
              <label>Dari</label>
              <input type="date" name="tgl1" class="form-control" required>
            </div>
            <div class="form-group col-12 col-md-6">
              <label>Sampai</label>
              <input type="date" name="tgl2" class="form-control" required>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Export</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Eport -->
<form action="<?= base_url('Jurnal/exort_cash_flow') ?>" method="GET">
  <div class="modal fade" id="export-data-cash-flow" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h5 class="modal-title" id="exampleModalLabel">Export cashflow</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="form-group col-12 col-md-6">
              <label>Dari</label>
              <input type="date" name="tgl1" class="form-control" required>
            </div>
            <div class="form-group col-12 col-md-6">
              <label>Sampai</label>
              <input type="date" name="tgl2" class="form-control" required>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Export</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  function sum() {
    var input1 = document.getElementById('txt1').value;
    var input2 = document.getElementById('txt2').value;
    var input3 = document.getElementById('txt3').value;


    var result = (parseInt(input1) * parseInt(input3)) + parseInt(input2);
    var result2 = parseInt(input1) * parseInt(input3);
    if (!isNaN(result)) {
      document.getElementById('total').value = result;
      document.getElementById('total1').value = result;
      document.getElementById('total2').value = result;
    } else {
      document.getElementById('total').value = result2;
      document.getElementById('total1').value = result2;
      document.getElementById('total2').value = result2;
    }
  }
</script>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
<script src="<?= base_url() ?>asset/time/jquery.skedTape.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('asset/'); ?>plugins/simple.money.format.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
  $(function() {
    $('.select').select2()

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

  


  $(document).ready(function() {
    

    // function kodeOtomatis(akun,id_akun){
    //   var tgl = $('#tgl').val();
    //   var tgl1    = tgl.split("-");
    //   var bulan   = tgl1[1];
    //   var tahun   = tgl1[0];
    //   var tahun2  = tahun.substring(2, 4)
    //   var kode    = akun+bulan+tahun2;

    //   $.ajax({
    //                 url:"<?= base_url(); ?>Match/kode/",
    //                 method:"POST",
    //                 data:{id_akun:id_akun, tgl:tgl},
    //                 success:function(data){
    //                 $('#no_nota').val(kode+data);

    //                 }

    //               });


    // }
    hide_default();

    function hide_default() {
      $('.detail').hide();
      $('.input_detail').attr('disabled', 'true');
    }

function get_post_center(id_akun, urutan=1){
  $.ajax({
          url: "<?= base_url(); ?>Jurnal/get_post_center/",
          method: "POST",
          data: {
            id_akun: id_akun
          },
          success: function(data) {
            if(urutan == 1){
              $('.detail_post_center').html(data);
              $('.detail_post_center').select2({
                width: '100%',
                language: {
                  noResults: function() {
                    return '<button class="btn btn-sm btn-primary btn_tambah_post_center" id_akun="'+id_akun+'" data-toggle="modal" data-target="#tambah_post_center">Tambah Post Center</a>';
                  },
                },
                escapeMarkup: function(markup) {
                  return markup;
                },
              }); 
            }else{
              $('.detail_post_center'+urutan).html(data);
              $('.detail_post_center'+urutan).select2({
                width: '100%',
                language: {
                  noResults: function() {
                    return '<button class="btn btn-sm btn-primary btn_tambah_post_center" id_akun="'+id_akun+'" data-toggle="modal" data-target="#tambah_post_center">Tambah Post Center</a>';
                  },
                },
                escapeMarkup: function(markup) {
                  return markup;
                },
              }); 
            }
            
          }
          });
}

        $(document).on('click', '.btn_tambah_post_center', function(){
            
            var id_akun = $(this).attr("id_akun");
            $('#id_akun_post').val(id_akun);
            

        });

    $('#id_akun').change(function() {
      var id_akun = $(this).val();

      var monitoring = [ '11', '12', '18', '29'];
      if (id_akun == 27) {
        hide_default();
        $('#no_bkin').show();
        $('#bkin').show();
        $('.input_bkin').removeAttr('disabled', 'true');
        $("#form-jurnal").attr("action", "<?= base_url() ?>Match/add_bkin");
      } else if (monitoring.includes(id_akun)) {
        hide_default();
        $('#monitoring').show();
        $('.input_monitoring').removeAttr('disabled', 'true');
        $("#form-jurnal").attr("action", "<?= base_url() ?>Match/add_pengeluaran");

      } else if (id_akun == 57) {
        hide_default();
        $('#aktiva').show();
        $('.input_aktiva').removeAttr('disabled', 'true');
        $("#form-jurnal").attr("action", "<?= base_url() ?>Match/add_aktiva");

      } else if(id_akun == 59){
        hide_default();
        $('#prive').show();
        $('.input_prive').removeAttr('disabled', 'true');
        $("#form-jurnal").attr("action", "<?= base_url() ?>Match/add_prive");
      }else {
        hide_default();
        $('#non_monitoring').show();
        $('.input_non_monitoring').removeAttr('disabled', 'true');
        $("#form-jurnal").attr("action", "<?= base_url() ?>Match/add_pengeluaran");

        get_post_center(id_akun);
           
      }

    });


    // $("body").on( "keyup", ".debit_edit", function(){


    // var debit_edit = 0;

    //     $(".debit_edit").each(function(){
    //     debit_edit += parseInt($(this).val());
    //   });
    //   $('.total_edit').val(debit_edit);

    // });
    $("body").on("change", ".id_kelompok", function() {
      // $('.id_kelompok').change(function(){
      var id_kelompok = $(this).val();
      var detail = $(this).attr('detail');

      $.ajax({
        url: "<?= base_url(); ?>match/get_kelompok/",
        method: "POST",
        data: {
          id_kelompok: id_kelompok
        },
        dataType: "json",
        success: function(data) {

          // alert(data.umur);
          //   $('#cancel').modal('show');

          $('#umur' + detail).val(data.umur);
        }

      });
    });

    $("body").on( "change", ".id_produk", function(){
// $('.id_produk').change(function(){
 var id_produk = $(this).val();
 var detail = $(this).attr('detail');
 $.ajax({
  url:"<?= base_url(); ?>match/get_data_produk/",
  method:"POST",
  data:{id_produk:id_produk},
  dataType:"json",
  success:function(data){
    $('#sku'+detail).val(data.sku);
    $('#satuan'+detail).val(data.satuan);  

    if (data.monitoring == 'y') 
    {
      $(".on"+detail).prop("checked", true);
      $(".off"+detail).prop("checked", false);
    }
    else if(data.monitoring == 't' || data.monitoring == 'tdk')
    {
     $(".off"+detail).prop("checked", true);
     $(".on"+detail).prop("checked", false);
   }
 }

});
});



    //////////////////////BKIN/////////////////////////////
    $("body").on( "keyup", ".rp_beli", function(){
        // $('.rp_beli').keyup(function(){
          var rp_beli = parseInt($(this).val());
          var detail = $(this).attr('rp_beli');

          var qty = parseInt($('.qty'+detail).val());

          var ttl_harga = rp_beli * qty;
          var rp_pajak = ttl_harga * 10 / 100;
          var total = ttl_harga + rp_pajak;
            // console.log(total);
            $('.ppn'+detail).val(rp_pajak);
            $('.rp_pajak'+detail).val(total);

            var debit = 0;

            $(".rp_pajak:not([disabled=disabled]").each(function(){
              debit += parseInt($(this).val());
            });
            $('.total').val(debit);
          });
    //////////
    $("body").on("keyup", ".rp_pajak", function() {
      //   $('.rp_pajak').keyup(function(){
      var debit = 0;

      $(".rp_pajak:not([disabled=disabled]").each(function() {
        debit += parseInt($(this).val());
      });
      $('.total').val(debit);
    });

    //edit ppn
    $("body").on( "keyup", ".ppn", function(){
        // $('.rp_beli').keyup(function(){
          var ppn = parseInt($(this).val());
          var detail = $(this).attr('ppn');

          var qty = parseInt($('.qty'+detail).val());

          var rp_beli = parseInt($('.rp_beli'+detail).val());

          if(isNaN(ppn)){
            var total = rp_beli * qty;
          }else{
            var total = rp_beli * qty + ppn;
          }
            $('.rp_pajak'+detail).val(total);

            var debit = 0;

            $(".rp_pajak:not([disabled=disabled]").each(function(){
              debit += parseInt($(this).val());
            });
            $('.total').val(debit);
          });


    var count_bkin = 1;
$('#tambah_bkin').click(function(){
  count_bkin = count_bkin + 1;
        // var no_nota_atk = $("#no_nota_atk").val();
        var html_code = "<div class='row' id='row"+count_bkin+"'>";

        html_code += '  <div class="col-md-3"><div class="form-group"><label for="list_kategori">Produk</label><select name="id_produk[]" class="form-control select id_produk input_detail input_bkin" detail="'+count_bkin+'" required><option>-- Pilih Produk --</option><?php foreach($produk as $p): ?><option value="<?= $p->id_produk ?>"><?= $p->nm_produk ?></option><?php endforeach; ?></select></div></div>';

        html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">SKU</label><input type="text" class="form-control input_detail input_bkin" id="sku'+count_bkin+'" name="sku[]" readonly></div></div>';

        html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">Satuan</label><input type="text" class="form-control input_detail input_bkin" id="satuan'+count_bkin+'" name="satuan[]" readonly></div></div>';

        html_code += '<div class="col-md-1"><div class="form-group"><label for="list_kategori">Qty</label><input type="text" class="form-control qty'+count_bkin+' input_detail input_bkin" qty="'+count_bkin+'" name="qty[]" required></div></div>';

        html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">Rp/Satuan</label><input type="text" class="form-control rp_beli rp_beli'+count_bkin+' input_detail input_bkin" rp_beli="'+count_bkin+'" name="rp_beli[]" required></div></div>';

        html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">PPN</label><input type="text" class="form-control ppn ppn'+count_bkin+' input_detail input_bkin" ppn="'+count_bkin+'" name="ppn[]"></div></div>';

        html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">Rp/Pajak</label><input type="text" class="form-control rp_pajak rp_pajak'+count_bkin+' input_detail input_bkin" rp_pajak="'+count_bkin+'" name="rp_pajak[]" required></div></div>';

        html_code += '<div class="col-md-9"><div class="form-group"><label for="list_kategori" >Monitoring</label> <br><label class="normal" for="01"><input id="'+count_bkin+'" type="checkbox" name="mon[]" value="y" class="on'+count_bkin+' mon'+count_bkin+'" onchange="autofill_mon(this)"> ON</label> <br><label class="normal" for="02"><input id="'+count_bkin+'" type="checkbox" name="mon[]" value="t" class="off'+count_bkin+' mon'+count_bkin+'" onchange="autofill_mon(this)">  OFF</label></div></div>';

        html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row'+count_bkin+'" class="btn btn-danger btn-sm remove">Hapus</button></div>';  
        

        html_code += "</div>";

        $('#detail_bkin').append(html_code);
        $('.select').select2()
      });

    $(document).on('click', '.remove', function() {
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
    });


    var count_aktiva = 1;
    $('#tambah_aktiva').click(function() {
      count_aktiva = count_aktiva + 1;
      // var no_nota_atk = $("#no_nota_atk").val();
      var html_code = "<div class='row' id='row" + count_aktiva + "'>";

      html_code += '  <div class="col-md-3"><div class="form-group"><label for="list_kategori">Produk</label><select name="id_produk[]" class="form-control select id_produk input_detail input_bkin" detail="' + count_aktiva + '" required><option>-- Pilih Produk --</option><?php foreach ($produk as $p) : ?><option value="<?= $p->id_produk ?>"><?= $p->nm_produk ?></option><?php endforeach; ?></select></div></div>';

      html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">SKU</label><input type="text" class="form-control input_detail input_bkin" id="sku' + count_aktiva + '" name="sku[]" readonly></div></div>';

      html_code += '<div class="col-md-1"><div class="form-group"><label for="list_kategori">Satuan</label><input type="text" class="form-control input_detail input_bkin" id="satuan' + count_aktiva + '" name="satuan[]" readonly></div></div>';

      html_code += '<div class="col-md-1"><div class="form-group"><label for="list_kategori">Qty</label><input type="text" class="form-control qty' + count_aktiva + ' input_detail input_bkin" qty="' + count_aktiva + '" name="qty[]" required></div></div>';

      html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">Rp/Satuan</label><input type="text" class="form-control rp_beli input_detail input_bkin" rp_beli="' + count_aktiva + '" name="rp_beli[]" required></div></div>';

      html_code += '<div class="col-md-2"><div class="form-group"><label for="list_kategori">PPN</label><input type="text" class="form-control ppn ppn' + count_aktiva + ' input_detail input_bkin" ppn="' + count_aktiva + '" name="ppn[]" required></div></div>';

      html_code += ' <div class="col-md-2"><div class="form-group"><input type="text" class="form-control rp_pajak rp_pajak' + count_aktiva + ' input_detail input_bkin" rp_pajak="' + count_aktiva + '" name="rp_pajak[]" required></div></div>';

      html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row' + count_aktiva + '" class="btn btn-danger btn-sm remove">-</button></div>';


      html_code += "</div>";

      $('#detail_aktiva').append(html_code);
      $('.select').select2()
    });

    $(document).on('click', '.remove', function() {
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
    });


    //////////////////////Monitoring/////////////////////////////
    $("body").on("keyup", ".rp_satuan", function() {
      // $('.rp_beli').keyup(function(){
      var rp_beli = parseFloat($(this).val());
      var detail = $(this).attr('rp_satuan');

      var qty = parseFloat($('.qty_monitoring' + detail).val());

      var ttl_harga = rp_beli * qty;

      // console.log(rp_beli);
      $('.total_rp' + detail).val(ttl_harga);

      var debit = 0;

      $(".total_rp:not([disabled=disabled]").each(function() {
        debit += parseFloat($(this).val());
      });
      $('.total').val(debit);
    });


    $("body").on("keyup", ".rp_satuan_aktiva", function() {
      // $('.rp_beli').keyup(function(){
      var rp_beli = parseFloat($(this).val());
      var detail = $(this).attr('rp_satuan');

      var qty = parseFloat($('.qty_aktiva' + detail).val());
      var ttl_harga_new = (rp_beli * qty) * 0.1;
      h = isNaN(ttl_harga_new) ? 0 : ttl_harga_new

      if (isNaN(h)) {
        var rp_pajak = (rp_beli * qty);
      } else {
        var rp_pajak = (rp_beli * qty) + h;
      }

      // p = isNaN(rp_pajak) ? 0 : rp_pajak

      // console.log(rp_beli);
      $('.total_rp_new' + detail).val(h);


      $('.pajak_aktiva' + detail).val(rp_pajak);

      var debit = 0;

      $(".pajak_aktiva:not([disabled=disabled]").each(function() {
        debit += parseFloat($(this).val());
      });
      $('.total').val(debit);
    });


    // $("body").on("keyup", ".pajak_tes", function() {
    //   // $('.rp_beli').keyup(function(){
    //   var ppn = parseFloat($(this).val());

    //   h = isNaN(ppn) ? 0 : ppn
    //   var rp_pajak = (rp_beli * qty) + h;

    //   $(".pajak_aktiva:not([disabled=disabled]").each(function() {
    //     debit += parseFloat($(this).val());
    //   });
    //   $('.total').val(debit);
    // });


    //////////
    $("body").on("keyup", ".total_rp", function() {
      //   $('.rp_pajak').keyup(function(){
      var detail = $(this).attr('total_rp');
      var total_rp = parseFloat($(this).val());
      var qty = parseFloat($('.qty_monitoring' + detail).val());
      var harga_satuan = total_rp / qty;
      $('.rp_satuan' + detail).val(harga_satuan);

      var debit = 0;

      // console.log(detail);

      $(".total_rp:not([disabled=disabled]").each(function() {
        debit += parseFloat($(this).val());
      });
      $('.total').val(debit);
    });


    // Monitoring
    var count_monitoring = 1;
    $('#tambah_monitoring').click(function() {
      count_monitoring = count_monitoring + 1;
      // var no_nota_atk = $("#no_nota_atk").val();
      
      var html_code = "<div class='row' id='row_monitoring" + count_monitoring + "'>";

      html_code += '<div class="col-md-3"><div class="form-group"><input type="text" class="form-control input_detail input_monitoring" name="ket[]" required></div></div>';

      html_code += '<div class="col-md-2"><div class="form-group"><select name="id_satuan[]" class="form-control select satuan input_detail input_monitoring" required><?php foreach ($satuan as $p) : ?><option value="<?= $p->id_satuan ?>"><?= $p->satuan ?></option><?php endforeach; ?></select></div></div>';

      html_code += '<div class="col-md-2"><div class="form-group"><input type="text" class="form-control input_detail input_monitoring qty_monitoring' + count_monitoring + '" qty="' + count_monitoring + '" name="qty[]" required></div></div>';

      html_code += '<div class="col-md-2"><div class="form-group"><input type="text" class="form-control input_detail input_monitoring rp_satuan' + count_monitoring + ' rp_satuan" name="rp_beli[]" rp_satuan="' + count_monitoring + '" required></div></div>';

      html_code += '<div class="col-md-2"><div class="form-group"><input type="text" class="form-control  input_detail input_monitoring total_rp total_rp' + count_monitoring + '" name="ttl_rp[]" total_rp="' + count_monitoring + '" required></div></div>';

      html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row_monitoring' + count_monitoring + '" class="btn btn-danger btn-sm remove_monitoring">-</button></div>';


      html_code += "</div>";

      $('#detail_monitoring').append(html_code);
      $('.select').select2()
    });

    $(document).on('click', '.remove_monitoring', function() {
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
    });


    //////////////////////Non Monitoring/////////////////////////////

    $("body").on("keyup", ".total_rp", function() {
      //   $('.rp_pajak').keyup(function(){
      var debit = 0;

      $(".total_rp:not([disabled=disabled]").each(function() {
        debit += parseInt($(this).val());
      });
      $('.total').val(debit);
    });


    // Non Monitoring
    var count_non_monitoring = 1;
    $('#tambah_non_monitoring').click(function() {
      count_non_monitoring = count_non_monitoring + 1;
      // var no_nota_atk = $("#no_nota_atk").val();
      var id_akun = $('#id_akun').val();
      var html_code = "<div class='row' id='row_non_monitoring" + count_non_monitoring + "'>";
      
     html_code += '<div class="col-md-3"><div class="form-group"><select name="id_post_center[]" class=" select form-control input_detail input_non_monitoring detail_post_center detail_post_center'+count_non_monitoring+'" ></select></div></div>';          


      html_code += '<div class="col-md-4"><div class="form-group"><input type="text" class="form-control input_detail input_non_monitoring" name="ket[]" required></div></div>';

      html_code += '<div class="col-md-3"><div class="form-group"><input type="text" class="form-control  input_detail input_non_monitoring total_rp" name="ttl_rp[]" required></div></div>';

      html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row_non_monitoring' + count_non_monitoring + '" class="btn btn-danger btn-sm remove_non_monitoring">-</button></div>';


      html_code += "</div>";

      $('#detail_non_monitoring').append(html_code);
      get_post_center(id_akun,count_non_monitoring);
      // $('.select').select2()
    });

    $(document).on('click', '.remove_non_monitoring', function() {
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
    });

    //edit jurnal

    $('.btn_edit').click(function() {
      var kd_gabungan = $(this).attr("kd_gabungan");

      $.ajax({
        url: "<?= base_url(); ?>Match/get_jurnal/",
        method: "POST",
        data: {
          kd_gabungan: kd_gabungan
        },
        success: function(data) {
          $('#get_jurnal').html(data);
          $('.select').select2()
        }
      });

    });


    $(document).on('submit', '#form_modal_post_center', function(event) {
            event.preventDefault();

            var id_akun = $('#id_akun_post').val();
            $.ajax({
                url: "<?php echo base_url('Jurnal/add_post_center_jurnal'); ?>",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#tambah_post_center').hide();
                    // setTimeout(function(){
                    //   $('#tambah_post_center').modal('toggle');
                    //     },50);
                   
                    // setTimeout(function(){
                    //       $("[data-dismiss=modal]").trigger({ type: "click" });
                    //     },50);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Post center berhasil dibuat'
                        });

                        get_post_center(id_akun);      
                }
            });

        });

        //Watch for closing modals
        $('.modal').on('hidden.bs.modal', function () {
            //If there are any visible
            if($(".modal:visible").length > 0) {
                //Slap the class on it (wait a moment for things to settle)
                setTimeout(function() {
                    $('body').addClass('modal-open');
                },200)
            }
        });


  });
</script>


<script>
  function autofill_anak() {
    var id_kelompok = document.getElementById('id_kelompok').value;
    $.ajax({
      url: "<?php echo base_url(); ?>Match/get_kelompok",
      data: '&id_kelompok=' + id_kelompok,
      success: function(data) {
        var hasil = JSON.parse(data);

        $.each(hasil, function(key, val) {
          document.getElementById('umur').value = val.umur;
        });
      }
    });
  }

  function autofill_mon(cb){
    var checked = cb.checked;
    var detail = cb.id;
    var value = cb.value;
    if (value == 'y' && checked == true) 
    {
     $(".on"+detail).prop("checked", true);
     $(".off"+detail).prop("checked", false);

   }
   else if(value == 't' && checked == true)
   {
     $(".off"+detail).prop("checked", true);
     $(".on"+detail).prop("checked", false);
   }

 }
 
</script>

<?php $this->load->view('tema/Footer'); ?>