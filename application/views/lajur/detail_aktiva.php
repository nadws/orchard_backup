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
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Akumulasi Aktiva</h3>
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
                <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <table class="table mt-2  " id="example1" width="100%" id="">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Nama Barang</th>
                                        <th>Depresiasi</th>
                                        <th>Akumulasi Depresiasi</th>
                                        <th>Nilai Buku</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    $i = 0;
                                    $akumulasi = 0;
                                    $nilai = 0;
                                    $tgl = -1;
                                    foreach ($aktiva as $a) :
                                        $akumulasi += $a->kredit_aktiva;
                                        $nilai += $a->debit_aktiva - $a->kredit_aktiva;
                                        $i += 1;
                                        $tgl += 1;
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $tgl ?></td>
                                            <td><?= $a->barang ?></td>
                                            <td><?= number_format($a->kredit_aktiva, 0) ?></td>
                                            <td><?= number_format($akumulasi, 0) ?></td>
                                            <td><?= number_format($nilai, 0) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
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