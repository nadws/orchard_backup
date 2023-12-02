<?php $this->load->view('tema/Header', $title); ?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


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

    .th-atas {
        /* position: sticky; */
        top: 53px;
    }

    .th-bawah {
        /* position: sticky; */
        top: 109px;
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
    <div class="row justify-content-center">
        <div class="col-md-12">

        </div>
        <div class="col-12">
            <?= $this->session->flashdata('message'); ?>
            <?php 
            $bulan = ['bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
            $bulan1 = (int)$month;      
            ?>
            <div class="card">
                <div class="card-header">
                <h3 class="float-left">Neraca Lajur <?= $bulan[$bulan1] ?> <?= $year ?></h3>
                    <h3 class="float-left"></h3>
                    <button type="button" class="btn btn-sm btn-outline-secondary float-right" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> Laporan Bulanan</button>

                    <a href="<?= base_url('lajur/print') ?>?month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fas fa-print"></i> Print</a>
                </div>

                <style>
                    .card-body>.table>thead>tr>th {
                        border-top-width: 1px;
                    }

                    .table-bordered thead th {
                        border-bottom-width: 1px;
                    }

                    .table thead th {
                        vertical-align: bottom;
                        border-bottom: 1px solid #9B9B9F;
                    }


                    .table-bordered th {
                        border: 1px solid #9B9B9F;
                    }

                    .table-sm td,
                    .table-sm th {
                        padding: .3rem;
                    }
                </style>
                <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                        <table class="table mt-2 table-sm table-bordered" style="text-align: center;" width="100%" id="">
                            <thead>
                                <tr>
                                    <th class="sticky-top th-atas"  rowspan="2" style="vertical-align: middle;">No. <br> Akun</th>
                                    <th class="sticky-top th-atas" rowspan="2" style="vertical-align: middle;">Nama Akun</th>
                                    <th class="sticky-top th-atas" colspan="2">Neraca Saldo</th>
                                    <th class="sticky-top th-atas" colspan="2">Penyesuaian</th>
                                    <th class="sticky-top th-atas" colspan="2">Neraca Saldo <br> Disesuaikan</th>
                                    <th class="sticky-top th-atas" colspan="2">Laporan <br> Laba/Rugi</th>
                                    <th class="sticky-top th-atas" colspan="2">Neraca</th>
                                </tr>
                                <tr>
                                    <th class="sticky-top th-bawah">Debit</th>
                                    <th class="sticky-top th-bawah">Kredit</th>
                                    <th class="sticky-top th-bawah">Debit</th>
                                    <th class="sticky-top th-bawah">Kredit</th>
                                    <th class="sticky-top th-bawah">Debit</th>
                                    <th class="sticky-top th-bawah">Kredit</th>
                                    <th class="sticky-top th-bawah">Debit</th>
                                    <th class="sticky-top th-bawah">Kredit</th>
                                    <th class="sticky-top th-bawah">Debit</th>
                                    <th class="sticky-top th-bawah">Kredit</th>

                                </tr>
                            </thead>
                            <tbody style="color: #787878; font-family:  Helvetica;">
                                <?php 
                                $debit_penyesuaian = 0;
                                $kredit_penyesuaian = 0;
                                $saldo_disesuaikan_debit = 0;
                                $saldo_disesuaikan_kredit = 0;
                                $debit_laba = 0;
                                $kredit_laba = 0;
                                $debit_laba_lanjut = 0;
                                $kredit_laba_lanjut = 0;
                                $debit_neraca = 0;
                                $kredit_neraca = 0;
                                $total_laba = 0;
                                $total_laba_lanjut = 0;
                                $total_neraca = 0;
                                $neraca_saldo_debit = 0;
                                $neraca_saldo_kredit = 0; 
                                ?>
                                <?php foreach($neraca as $n): ?>
                                <?php
                                    // $lanjut = $n->debit_lanjut - $n->kredit_lanjut;
                                    // if($lanjut > 0){
                                    //     $debit_lanjut = $lanjut;
                                    //     $kredit_lanjut = 0;
                                    // }elseif($lanjut < 0){
                                    //     $debit_lanjut = 0;
                                    //     $kredit_lanjut = $lanjut * -1;
                                    // }else {
                                    //     $debit_lanjut = 0;
                                    //     $kredit_lanjut = 0;
                                    // } 
                                    // $debit = $n->debit_saldo + $n->debit_neraca_saldo + $debit_lanjut;
                                    // $kredit = $n->kredit_saldo + $n->kredit_neraca_saldo + $kredit_lanjut;
                                    $saldo_awal = $n->debit_saldo + $n->debit_neraca_saldo + $n->debit_lanjut - $n->kredit_saldo - $n->kredit_neraca_saldo - $n->kredit_lanjut;
                                    if($saldo_awal > 0){
                                        $debit = $saldo_awal;
                                        $kredit = 0;
                                    }elseif ($saldo_awal < 0) {
                                        $debit = 0;
                                        $kredit = $saldo_awal * -1;
                                    }else{
                                        $debit = 0;
                                        $kredit = 0;
                                    }


                                    $saldo = $debit - $kredit;

                                    
                                      $penyesuaiaan = $n->debit_penyesuaian - $n->kredit_penyesuaian;
                                      $saldo_penyesuaian = $saldo + $penyesuaiaan;
                                      $laba = $n->debit_laba - $n->kredit_laba;
                                      $neraca = $n->debit_neraca_saldo + $n->debit_neraca +  $n->debit_lanjut + $n->debit_laba_lanjut - $n->kredit_neraca - $n->kredit_neraca_saldo - $n->kredit_lanjut - $n->kredit_laba_lanjut;
                                      
                                      
                                      //laba lanjut
                                      
                                      $laba_lanjut = $n->debit_laba_lanjut - $n->kredit_laba_lanjut;
                                      if($n->id_akun == 58){
                                          $laba_lanjut += $debit - $kredit;
                                      }  

                                      //nerca saldo
                                      $ceker = $n->debit_saldo + $n->debit_neraca_saldo - $n->kredit_saldo - $n->kredit_neraca_saldo;
                                      if($ceker == 0){
                                        $neraca_saldo_debit += 0;
                                        $neraca_saldo_kredit += 0;
                                      }else{
                                        $neraca_saldo_debit += $debit;
                                        $neraca_saldo_kredit += $kredit;
                                      }
                                      
                                      
                                      //penyesuaian
                                      $debit_penyesuaian += $n->debit_penyesuaian;
                                      $kredit_penyesuaian += $n->kredit_penyesuaian;

                                      //neraca disesuaikan
                                    if($saldo_penyesuaian >= 0){
                                        $saldo_disesuaikan_debit += $saldo_penyesuaian;
                                    }else{
                                        $saldo_disesuaikan_kredit += $saldo_penyesuaian;
                                    }

                                    // $saldo_disesuaikan_debit += $n->debit_lanjut;

                                    // $saldo_disesuaikan_kredit += $n->kredit_lanjut;
                                    
                                    //laba
                                    if($laba >= 0){
                                        $debit_laba += $laba;
                                    }else{
                                        $kredit_laba += $laba;
                                    }
                                    // $debit_laba += $n->debit_laba;
                                    // $kredit_laba += $n->kredit_laba;

                                   
                                    //neraca
                                    if($neraca >= 0){
                                        $debit_neraca += $neraca;
                                    }else{
                                        $kredit_neraca += $neraca;
                                    }
                                    // $debit_neraca += $n->debit_neraca;
                                    // $kredit_neraca += $n->kredit_neraca;

                                    $total_laba += $laba;
                                    

                                     //laba lanjut
                                     $total_laba_lanjut += $laba_lanjut;

                                     if($n->id_akun == 58){
                                        continue;
                                     }
                                        $total_neraca += $neraca;

                                    
                                    
                                ?>
                                <tr>
                                    <td><?= $n->no_akun ?></td>
                                    <td><?= $n->nm_akun ?></td>
                                    <td><?= number_format($debit,0) ?></td>
                                    <td><?= number_format($kredit,0) ?></td>
                                    <td><?= number_format($n->debit_penyesuaian,0) ?></td>
                                    <td><?= number_format($n->kredit_penyesuaian,0) ?></td>
                                    <?php if($saldo_penyesuaian > 0): ?>
                                    <td><?= number_format($saldo_penyesuaian,0); ?></td>
                                    <td>0</td>
                                    <?php elseif($saldo_penyesuaian < 0): ?>
                                    <td>0</td>
                                    <td><?= number_format($saldo_penyesuaian * -1,0) ?></td>
                                    <?php else: ?>
                                    <td>0</td>
                                    <td>0</td>
                                    <?php endif; ?>

                                    <?php if($laba > 0): ?>
                                    <td><?= number_format($laba,0); ?></td>
                                    <td>0</td>
                                    <?php elseif($laba < 0): ?>
                                    <td>0</td>
                                    <td><?= number_format($laba * -1,0) ?></td>
                                    <?php else: ?>
                                    <td>0</td>
                                    <td>0</td>
                                    <?php endif; ?>

                                    <?php if($neraca > 0): ?>
                                    <td><?= number_format($neraca,0); ?></td>
                                    <td>0</td>
                                    <?php elseif($neraca < 0): ?>
                                    <td>0</td>
                                    <td><?= number_format($neraca * -1,0) ?></td>
                                    <?php else: ?>
                                    <td>0</td>
                                    <td>0</td>
                                    <?php endif; ?>
                                    
                                </tr>
                                <?php endforeach; ?>

                                <?php if($total_laba_lanjut > 0){
                                    $debit_l = $total_laba_lanjut;
                                    $kredit_l = 0;
                                }elseif($total_laba_lanjut < 0){
                                    $debit_l = 0;
                                    $kredit_l = $total_laba_lanjut * -1;
                                }else{
                                    $debit_l = 0;
                                    $kredit_l = 0;
                                } ?>
                
                                <tr>
                                    <td>3100,2</td>
                                    <td>Laba tahun berjalan</td>
                                    <td><?= number_format($debit_l,0) ?></td>
                                    <td><?= number_format($kredit_l,0) ?></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td><?= number_format($debit_l,0) ?></td>
                                    <td><?= number_format($kredit_l,0) ?></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td><?= number_format($debit_l,0) ?></td>
                                    <td><?= number_format($kredit_l,0) ?></td>

                                    
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th colspan="2">Total</th>
                                <th><?= number_format($neraca_saldo_debit + $debit_l,0)?></th>
                                <th><?= number_format($neraca_saldo_kredit + $kredit_l,0)?></th>
                                <th><?= number_format($debit_penyesuaian,0)?></th>
                                <th><?= number_format($kredit_penyesuaian,0)?></th>
                                <th><?= number_format($saldo_disesuaikan_debit + $debit_l,0); ?></th>
                                <th><?= number_format(($saldo_disesuaikan_kredit * -1) + $kredit_l,0); ?></th>
                                <th><?= number_format($debit_laba,0) ?></th>
                                <th><?= number_format($kredit_laba * -1,0) ?></th>
                                <th><?= number_format($debit_neraca + $debit_l,0) ?></th>
                                <th><?= number_format(($kredit_neraca * -1) + $kredit_l,0) ?></th>
                                </tr>
                                <tr>
                                   <th colspan="8">Laba Bersih</th>
                                   <?php if($total_laba < 0): ?>
                                   <?php 
                                    $total_laba_debit = $total_laba * -1;
                                    $total_laba_kredit = 0; ?>
                                   <th style="background-color : #FFC439; color:black;"><?= number_format($total_laba * -1,0) ?></th>
                                   <th></th>
                                   <?php else: ?>
                                   <?php 
                                    $total_laba_debit = 0;
                                    $total_laba_kredit = $total_laba;    
                                    ?>                                    
                                   <th></th>
                                   <th style="background-color : #FFC439; color:black;"><?= number_format($total_laba) ?></th>
                                   <?php endif; ?>

                                   <?php if($total_neraca < 0): ?>
                                   <?php 
                                   $total_neraca_debit = $total_neraca * -1;
                                   $total_neraca_kredit = 0;
                                    ?>
                                   <th style="background-color : #FFC439; color:black;"><?= number_format($total_neraca * -1,0) ?></th>
                                   <th></th>
                                   <?php else: ?>
                                    <?php 
                                   $total_neraca_debit =  0;
                                   $total_neraca_kredit = $total_neraca;
                                    ?>                                    
                                   <th></th>
                                   <th style="background-color : #FFC439; color:black;"><?= number_format($total_neraca) ?></th>
                                   <?php endif; ?>     
                                </tr>

                                <tr>
                                    <th colspan="8"></th>
                                    <th><?= number_format($total_laba_debit + $debit_laba, 0) ?></th>
                                    <th><?= number_format( $total_laba_kredit + $kredit_laba * -1,0) ?></th>
                                    <th><?= number_format($total_neraca_debit + $debit_neraca, 0) ?></th>
                                    <th><?= number_format( $total_neraca_kredit + $kredit_neraca * -1,0) ?></th>
                                </tr>        
                            </tfoot>
                        </table>

                    <!-- </div> -->
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

<!-- Modal View -->
<form action="" method="GET">
<div class="modal fade" id="view-periode" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">

        <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Bulan</label>
                      <select name="month" class="form-control" required="">                              
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>                 
                      </select>
                  </div>
              </div>

              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Tahun</label>
                      <select name="year" class="form-control select" required="">
                          <?php foreach($tahun as $t): ?>                                
                            <?php  $tanggal = $t->tgl;
                            $explodetgl=explode('-', $tanggal); ?>
                          <option value="<?=$explodetgl[0];?>"><?=$explodetgl[0];?></option>
                          <?php endforeach; ?>
                        </select>  
                  </div>
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


<script>
    function autofill_anak() {
        var nm_kry = document.getElementById('nm_kry').value;
        $.ajax({
            url: "<?php echo base_url(); ?>Match/cari_anak",
            data: '&nm_kry=' + nm_kry,
            success: function(data) {
                var hasil = JSON.parse(data);

                $.each(hasil, function(key, val) {
                    document.getElementById('id_kry').value = val.id_kry;
                    document.getElementById('nm_kry').value = val.nm_kry;
                });
            }
        });
    }
</script>

<?php $this->load->view('tema/Footer'); ?>