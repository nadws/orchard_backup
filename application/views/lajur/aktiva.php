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
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Daftar Aktiva</h3>
                    <h3 class="float-left"></h3>
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
                <?php $tahun = date('Y') - 1 ?>
                <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table style="white-space: nowrap;" id="example1" class="table mt-2 table-bordered table-sm order-table" width="100%" id="">
                                    <thead style="white-space: nowrap; text-align: center;">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Aktiva</th>
                                            <th>Tahun <br> Perolehan</th>
                                            <th>Harga <br> Perolehan</th>
                                            <th>Tarif</th>
                                            <th>Akumulasi <br> Penyusutan <?= $tahun ?></th>
                                            <th>Nilai Buku <br> 31/12/<?= $tahun ?></th>
                                            <th>Beban <br> 31/12/<?= $tahun ?></th>
                                            <th>Beban <br> Penyusutan Perbulan</th>
                                            <th>Nilai Buku <br> <?= date('d/m/Y') ?></th>
                                            <th>Akumulasi <br> Penyusutan <?= date('Y') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <tr>
                                            <td></td>
                                            <td>
                                                <dt>Harta Berwujud</dt>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <!-- kelompok1 -->
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <dt>Kelompok 1</dt>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $i = 0;
                                        $harga = 0;
                                        $nilai1 = 0;
                                        $akumulasi = 0;
                                        $akumulasi2 = 0;
                                        $akumulasi3 = 0;
                                        $nilai2 = 0;
                                        $susut = 0;
                                        foreach ($aktiva as $a) :
                                            $i += 1;
                                            $harga += $a->debit_aktiva;
                                            $nilai1 += $a->debit_aktiva - $a->akumulasi2;
                                            $akumulasi += $a->akumulasi;
                                            $akumulasi2 += $a->akumulasi2;
                                            $akumulasi3 += $a->akumulasi2 + $a->akumulasi;
                                            $nilai2 += $a->debit_aktiva - ($a->akumulasi + $a->akumulasi2);
                                            $susut += $a->b_penyusutan;
                                        ?>
                                            <tr >
                                                <td></td>
                                                <td><?= $a->barang ?></td>
                                                <td><?= date('F-y', strtotime($a->tgl)) ?></td>
                                                <td><?= number_format($a->debit_aktiva, 0) ?></td>
                                                <td><?= $a->persen ?>%</td>
                                                <td><?= number_format($a->akumulasi2,0) ?></td>
                                                <td><?= number_format($a->debit_aktiva - $a->akumulasi2, 0) ?></td>
                                                <td><?= number_format($a->akumulasi, 2) ?></td>
                                                <td><?= number_format($a->b_penyusutan, 2) ?> (<?= $a->bulan ?>) </td>
                                                <td><?= number_format($a->debit_aktiva - ($a->akumulasi2 + $a->akumulasi), 2) ?></td>
                                                <td><?= number_format($a->akumulasi + $a->akumulasi2, 2) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style=" font-weight: bold;">
                                            <td></td>
                                            <td>
                                                <dt>Jumlah Kelompok 1</dt>
                                            </td>
                                            <td></td>
                                            <td><?= number_format($harga, 0) ?></td>
                                            <td></td>
                                            <td><?= number_format($akumulasi2, 2) ?> </td>
                                            <td><?= number_format($nilai1, 0) ?></td>
                                            <td><?= number_format($akumulasi, 2) ?> </td>
                                            <td><?= number_format($susut, 2) ?> </td>
                                            <td><?= number_format($nilai2, 2) ?></td>
                                            <td><?= number_format($akumulasi3, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <!-- kelompok 1 -->

                                        <!-- kelompok 2 -->
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <dt>Kelompok 2</dt>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                        
                                        </tr>
                                        <?php
                                        $i = 0;
                                        $harga = 0;
                                        $nilai1 = 0;
                                        $akumulasi = 0;
                                        $akumulasi2 = 0;
                                        $akumulasi3 = 0;
                                        $nilai2 = 0;
                                        $susut = 0;
                                        foreach ($aktiva2 as $a) :
                                            $i += 1;
                                            $harga += $a->debit_aktiva;
                                            $nilai1 += $a->debit_aktiva - $a->akumulasi2;
                                            $akumulasi += $a->akumulasi;
                                            $akumulasi2 += $a->akumulasi2;
                                            $akumulasi3 += $a->akumulasi2 + $a->akumulasi;
                                            $nilai2 += $a->debit_aktiva - ($a->akumulasi + $a->akumulasi2);
                                            $susut += $a->b_penyusutan;
                                        ?>
                                            <tr >
                                                <td></td>
                                                <td><?= $a->barang ?></td>
                                                <td><?= date('F-y', strtotime($a->tgl)) ?></td>
                                                <td><?= number_format($a->debit_aktiva, 0) ?></td>
                                                <td><?= $a->persen ?>%</td>
                                                <td><?= number_format($a->akumulasi2,0) ?></td>
                                                <td><?= number_format($a->debit_aktiva - $a->akumulasi2, 0) ?></td>
                                                <td><?= number_format($a->akumulasi, 2) ?></td>
                                                <td><?= number_format($a->b_penyusutan, 2) ?> (<?= $a->bulan ?>) </td>
                                                <td><?= number_format($a->debit_aktiva - ($a->akumulasi2 + $a->akumulasi), 2) ?></td>
                                                <td><?= number_format($a->akumulasi + $a->akumulasi2, 2) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td></td>
                                            <td>
                                                <dt>Jumlah Kelompok 2</dt>
                                            </td>
                                            <td></td>
                                            <td><?= number_format($harga, 0) ?></td>
                                            <td></td>
                                            <td><?= number_format($akumulasi2, 2) ?> </td>
                                            <td><?= number_format($nilai1, 0) ?></td>
                                            <td><?= number_format($akumulasi, 2) ?> </td>
                                            <td><?= number_format($susut, 2) ?> </td>
                                            <td><?= number_format($nilai2, 2) ?></td>
                                            <td><?= number_format($akumulasi3, 2) ?></td>
                                        </tr>
                                        <!-- Kelompok 2 -->

                                        <!-- kelompok 3 -->
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <dt>Kelompok 3</dt>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                        
                                        </tr>
                                        <?php
                                        $i = 0;
                                        $harga = 0;
                                        $nilai1 = 0;
                                        $akumulasi = 0;
                                        $akumulasi2 = 0;
                                        $akumulasi3 = 0;
                                        $nilai2 = 0;
                                        $susut = 0;
                                        foreach ($aktiva3 as $a) :
                                            $i += 1;
                                            $harga += $a->debit_aktiva;
                                            $nilai1 += $a->debit_aktiva - $a->akumulasi2;
                                            $akumulasi += $a->akumulasi;
                                            $akumulasi2 += $a->akumulasi2;
                                            $akumulasi3 += $a->akumulasi2 + $a->akumulasi;
                                            $nilai2 += $a->debit_aktiva - ($a->akumulasi + $a->akumulasi2);
                                            $susut += $a->b_penyusutan;
                                        ?>
                                            <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $a->barang ?></td>
                                                <td><?= date('F-y', strtotime($a->tgl)) ?></td>
                                                <td><?= number_format($a->debit_aktiva, 0) ?></td>
                                                <td><?= $a->persen ?>%</td>
                                                <td><?= number_format($a->akumulasi2,0) ?></td>
                                                <td><?= number_format($a->debit_aktiva - $a->akumulasi2, 0) ?></td>
                                                <td><?= number_format($a->akumulasi, 2) ?></td>
                                                <td><?= number_format($a->b_penyusutan, 2) ?> (<?= $a->bulan ?>) </td>
                                                <td><?= number_format($a->debit_aktiva - ($a->akumulasi2 + $a->akumulasi), 2) ?></td>
                                                <td><?= number_format($a->akumulasi + $a->akumulasi2, 2) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style=" font-weight: bold;">
                                            <td></td>
                                            <td>
                                                <dt>Jumlah Kelompok 3</dt>
                                            </td>
                                            <td></td>
                                            <td><?= number_format($harga, 0) ?></td>
                                            <td></td>
                                            <td><?= number_format($akumulasi2, 2) ?> </td>
                                            <td><?= number_format($nilai1, 0) ?></td>
                                            <td><?= number_format($akumulasi, 2) ?> </td>
                                            <td><?= number_format($susut, 2) ?> </td>
                                            <td><?= number_format($nilai2, 2) ?></td>
                                            <td><?= number_format($akumulasi3, 2) ?></td>
                                        </tr>
                                        <!-- Kelompok 3 -->

                                        <!-- kelompok 4 -->
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <dt>Kelompok 4</dt>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tr>
                                        <?php
                                        $i = 0;
                                        $harga = 0;
                                        $nilai1 = 0;
                                        $akumulasi = 0;
                                        $akumulasi2 = 0;
                                        $akumulasi3 = 0;
                                        $nilai2 = 0;
                                        $susut = 0;
                                        foreach ($aktiva4 as $a) :
                                            $i += 1;
                                            $harga += $a->debit_aktiva;
                                            $nilai1 += $a->debit_aktiva - $a->akumulasi2;
                                            $akumulasi += $a->akumulasi;
                                            $akumulasi2 += $a->akumulasi2;
                                            $akumulasi3 += $a->akumulasi2 + $a->akumulasi;
                                            $nilai2 += $a->debit_aktiva - ($a->akumulasi + $a->akumulasi2);
                                            $susut += $a->b_penyusutan;
                                        ?>
                                            <tr style="text-align: center;">
                                                <td></td>
                                                <td><?= $a->barang ?></td>
                                                <td><?= date('F-y', strtotime($a->tgl)) ?></td>
                                                <td><?= number_format($a->debit_aktiva, 0) ?></td>
                                                <td><?= $a->persen ?>%</td>
                                                <td><?= number_format($a->akumulasi2,0) ?></td>
                                                <td><?= number_format($a->debit_aktiva - $a->akumulasi2, 0) ?></td>
                                                <td><?= number_format($a->akumulasi, 2) ?></td>
                                                <td><?= number_format($a->b_penyusutan, 2) ?> (<?= $a->bulan ?>) </td>
                                                <td><?= number_format($a->debit_aktiva - ($a->akumulasi2 + $a->akumulasi), 2) ?></td>
                                                <td><?= number_format($a->akumulasi + $a->akumulasi2, 2) ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr style=" font-weight: bold;">
                                            <td></td>
                                            <td>
                                                <dt>Jumlah Kelompok 4</dt>
                                            </td>
                                            <td></td>
                                            <td><?= number_format($harga, 0) ?></td>
                                            <td></td>
                                            <td><?= number_format($akumulasi2, 2) ?> </td>
                                            <td><?= number_format($nilai1, 0) ?></td>
                                            <td><?= number_format($akumulasi, 2) ?> </td>
                                            <td><?= number_format($susut, 2) ?> </td>
                                            <td><?= number_format($nilai2, 2) ?></td>
                                            <td><?= number_format($akumulasi3, 2) ?></td>
                                        </tr>
                                        <!-- Kelompok 4 -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="11"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>


            </div>

        </div>
    </div>


</div>
</div>



<?php $this->load->view('tema/Footer'); ?>