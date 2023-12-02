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
            $bulan = ['bulan', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $bulan1 = (int)$month;
            ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Laporan Neraca <?= $bulan[$bulan1] ?> <?= $year ?></h3>
                    <h3 class="float-left"></h3>
                    <button type="button" class="btn btn-sm btn-outline-secondary float-right" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> Laporan Bulanan</button>
                    <a href="<?= base_url('Lajur/print_neraca') ?>?month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fas fa-print"></i> Print</a>
                    <a href="<?= base_url('Lajur/excel_neraca') ?>?month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fas fa-file-export"></i> Export</a>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table mt-2 table-sm table-bordered" width="100%" id="">
                                <thead>
                                    <tr>
                                        <th style="width: 50%; text-align: center;" colspan="2">Aktiva</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">
                                            <dt>Aktiva Lancar</dt>
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $debit = 0;
                                    foreach ($neraca as $n) :
                                        $neraca = $n->debit_neraca_saldo + $n->debit_neraca + $n->debit_lanjut - $n->kredit_neraca - $n->kredit_neraca_saldo - $n->kredit_lanjut;
                                        if ($n->aktiva_l == "Y") {
                                            $debit += $neraca;
                                        }
                                    ?>
                                        <?php if ($n->aktiva_l == "Y") : ?>
                                            <tr>
                                                <td><?= $n->nm_akun ?></td>
                                                <td>Rp. <?= number_format($neraca, 0) ?></td>
                                            </tr>
                                        <?php else : ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Jumlah Aktiva Lancar</dt>
                                        </td>
                                        <td>
                                            <dt>Rp. <?= number_format($debit, 0) ?></dt>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Aktiva Tetap</dt>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    $debit1 = 0;
                                    foreach ($neraca1 as $n) :
                                        $neraca1 = $n->debit_neraca_saldo + $n->debit_neraca + $n->debit_lanjut - $n->kredit_neraca - $n->kredit_neraca_saldo - $n->kredit_lanjut;
                                        if ($n->aktiva_t == "Y") {
                                            $debit1 += $neraca1;
                                        }
                                    ?>
                                        <?php if ($n->aktiva_t == "Y") : ?>
                                            <tr>
                                                <td><?= $n->nm_akun ?></td>
                                                <td> Rp.<?= number_format($neraca1, 0) ?></td>
                                            </tr>
                                        <?php else : ?>
                                        <?php endif ?>
                                    <?php endforeach ?>

                                    <tr>
                                        <td>Total Aktiva</td>
                                        <td>Rp. <?= number_format($debit1, 0) ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Nilai Buku</dt>
                                        </td>
                                        <td>
                                            <dt>Rp. <?= number_format($debit1, 0) ?></dt>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Jumlah Aktiva</dt>
                                        </td>
                                        <td>
                                            <dt>Rp. <?= number_format($debit + $debit1, 0) ?></dt>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table mt-2 table-sm table-bordered" width="100%" id="">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;" colspan="2">Pasiva</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Hutang</dt>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    $hutang1 = 0;
                                    foreach ($hutang as $h) :
                                        $neraca = $h->debit_neraca_saldo + $h->debit_neraca + $h->debit_lanjut - $h->kredit_neraca - $h->kredit_neraca_saldo - $h->kredit_lanjut;
                                        if ($h->id_kategori == '5') {
                                            $hutang1 += $neraca;
                                        }
                                    ?>
                                        <?php if ($h->id_kategori == '5') : ?>
                                            <tr>
                                                <td><?= $h->nm_akun ?></td>
                                                <td>Rp. <?= number_format($neraca * -1, 0) ?></td>
                                            </tr>
                                        <?php else : ?>

                                        <?php endif ?>
                                    <?php endforeach ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Total Kewajiban Lancar</dt>
                                        </td>
                                        <td>
                                            <dt>Rp. <?= number_format($hutang1 * -1, 0) ?></dt>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Ekuitas</dt>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    $hutang2 = 0;
                                    $debit_laba=0;
                                    $kredit_laba=0;
                                    $total_laba = 0;
                                    $total_neraca = 0;
                                    $laba_tahun_berjalan = 0;
                                    
                                    //p&l
                                    foreach($laba as $ht){
                                        $laba = $ht->debit_laba - $ht->kredit_laba;
                                        $total_laba += $laba;
                                    }

                                    foreach ($hutang as $h) :
                                        ?>
                                        <?php if ( $h->ekuitas == "Y" ) : ?>
                                            <?php if($h->id_akun == '58'):
                                                $ltb = $h->debit_neraca_saldo + $h->debit_neraca + $h->debit_lanjut - $h->kredit_neraca_saldo - $h->kredit_neraca - $h->kredit_lanjut;
                                                $ltb2 = $ltb*-1;  
                                                $laba_tahun_berjalan += $ltb2;    
                                            ?>
                                            <?php else: ?>
                                                <?php 
                                                     $neraca = $h->debit_neraca_saldo + $h->debit_neraca + $h->debit_lanjut - $h->kredit_neraca - $h->kredit_neraca_saldo - $h->kredit_lanjut;
                                                     $hutang2 += $neraca;    
                                                ?>
                                            <tr>
                                                <td><?= $h->nm_akun ?></td>
                                                <td>Rp. <?= number_format($neraca * -1, 0) ?></td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php else : ?>

                                        <?php endif ?>
                                    <?php endforeach ?>
                                    <tr>
                                    <?php $ttl_laba_berjalan = $total_laba * -1 + $laba_tahun_berjalan; 
                                        $ttl_ekuitas = $ttl_laba_berjalan + ($hutang2 * -1);
                                    ?>
                                       <td>Laba Tahun Berjalan</td>
                                       <td>Rp.<?=  number_format($ttl_laba_berjalan,0) ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Total Ekuitas</dt>
                                        </td>
                                        <td>
                                            <dt>Rp.<?= number_format($ttl_ekuitas,0) ?></dt>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <dt>Jumlah Pasiva</dt>
                                        </td>
                                        <td>
                                            <dt>Rp. <?= number_format($ttl_ekuitas + ($hutang1 * -1), 0) ?></dt>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>


            </div>

        </div>

        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Laporan Neraca Saldo Penutup <?= $bulan[$bulan1] ?> <?= $year ?></h3>                        
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>No Akun</th>
                        <th>Nama Akun</th>
                        <th>Debit</th>
                        <th>Kredit</th>                    
                    </tr>                                            
                    </thead>
                    <tbody>
                    <?php
                    $ttl_debit_p = 0;
                    $ttl_kredit_p = 0;
                    foreach($penutup as $nc): ?>
                    <?php if($nc->id_akun == 58){
                        continue;
                    } ?>
                    <?php 
                    $nilai = $nc->debit_neraca_saldo + $nc->debit_neraca + $nc->debit_lanjut - $nc->kredit_neraca - $nc->kredit_neraca_saldo - $nc->kredit_lanjut;
                    if($nilai > 0){
                        $debit_p = $nilai;
                        $kredit_p = 0;
                        $ttl_debit_p += $nilai;
                    }elseif($nilai < 0){
                        $debit_p = 0;
                        $kredit_p = $nilai * -1;
                        $ttl_kredit_p += $nilai * -1;
                    }else{
                        continue;
                    }
                    ?>
                    <tr>
                        <td><?= $nc->no_akun; ?></td>
                        <td><?= $nc->nm_akun ?></td>
                        <td><?= number_format($debit_p,0) ?></td>
                        <td><?= number_format($kredit_p,0) ?></td>                    
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>3100,2</td>
                        <td>Laba tahun berjalan</td>
                        <?php if($ttl_laba_berjalan < 0): 
                            $ttl_debit_p += $ttl_laba_berjalan * -1;
                            ?>
                        <td><?= number_format($ttl_laba_berjalan * -1 ,0) ?></td>
                        <td>0</td>
                        <?php else: 
                            $ttl_kredit_p += $ttl_laba_berjalan;
                            ?>
                        <td>0</td>
                        <td><?= number_format($ttl_laba_berjalan,0) ?></td>
                        <?php endif; ?>
                    </tr>                   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong><?= number_format($ttl_debit_p) ?></strong></td>
                            <td><strong><?= number_format($ttl_kredit_p) ?></strong></td>
                        </tr>    
                    </tfoot>
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
                                <label for="list_kategori">Akun</label>
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