<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    th,
    td {
        padding: 5px;
        font-size: xx-small;
    }



    .item1 {
        grid-column: col-start / span 2;
    }

    .item2 {
        grid-column: col-start 3 / span 2;
    }

    .item3 {
        grid-column: col-start 5 / span 2;
    }

    .item4 {
        grid-column: col-start 7 / span 2;
    }

    .wrapper {
        display: grid;
        grid-template-columns: repeat(12, [col-start] 1fr);
        gap: 20px;
    }
    
    .item1a {
        grid-column: col-start / span 2;
    }

    .item2a {
        grid-column: col-start 5 / span 2;
    }
</style>

<body>

    <!-- <h2 style="text-align: center;">Gaji & Tunjangan Orchard</h2>
    <h3 style="text-align: center;"><?= date('d-m-Y', strtotime($tgl1))  ?> ~ <?= date('d-m-Y', strtotime($tgl2))  ?></h3> -->
    <table border="1" style="border-collapse: collapse; ">
        <thead>
            <tr>
                <th>Nama</th>
                <th style="text-align: right;">Jumlah Masuk</th>
                <th style="text-align: right;">Off</th>
                <th style="text-align: right;">Rp/Hari</th>
                <th style="text-align: right;">Tunjangan Skill</th>
                <th>Type Therapis</th>
                <?php foreach ($skill as $s) : ?>
                    <th><?= $s->skill ?></th>
                <?php endforeach ?>
                <th>Posisi</th>
                <th style="text-align: right;">Tunjangan</th>
                <th style="text-align: right;">Masuk x RP/Hari</th>
                <th style="text-align: right;">Total Gaji</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $total = 0;
            foreach ($gaji as $g) :
                if (empty($g->OFF) && empty($g->M)) {
                    continue;
                } else {
                    # code...
                }

                $total += empty($g->OFF) ? 0 : ($g->M * $g->gaji) + $g->tunjangan + $g->tj_tipe;
            ?>
                <tr>
                    <td><?= strtoupper($g->nm_kry) ?></td>
                    <td style="text-align: right;"><?= $g->M ?></td>
                    <td style="text-align: right;"><?= $g->OFF ?></td>
                    <td style="text-align: right;"><?= number_format($g->gaji, 0) ?></td>
                    <td style="text-align: right;"><?= number_format($g->tj_tipe, 0) ?></td>
                    <td align="center"><?= $g->nm_tipe ?></td>
                    <?php foreach ($skill as $s) : ?>
                        <?php $skill_karyawan = $this->db->query("SELECT * FROM tb_karyawan_skill as a where a.id_karyawan = '$g->id_kry' and a.id_skill = '$s->id_skill'")->row() ?>


                        <?php if ($g->id_tipe == '5') : ?>
                            <td align="center"> -</td>
                        <?php else : ?>
                            <?php if (empty($skill_karyawan)) : ?>
                                <td align="center" style="color: red;">
                                    x
                                </td>
                            <?php else : ?>
                                <td align="center" style="color: green;">
                                    v
                                </td>
                            <?php endif ?>
                        <?php endif ?>



                    <?php endforeach ?>
                    <td align="center"><?= $g->posisi ?></td>
                    <td style="text-align: right;"><?= number_format($g->tunjangan, 0) ?></td>
                    <td style="text-align: right;"><?= number_format($g->M * $g->gaji, 0) ?></td>
                    <td style="text-align: right;">
                        <dt><?= number_format(($g->M * $g->gaji) + $g->tunjangan + $g->tj_tipe, 0) ?></dt>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="13">Total</th>
                <th style="text-align: right;"><?= number_format($total, 0) ?></th>
            </tr>
        </tfoot>
    </table>
    <br>
    <div class="wrapper">
        <div class="item1">
            <center>


                <h5>Denda </h5>
                <table border="1" style="border-collapse: collapse; float: left; margin-left: 2px;" width="100%">
                    <thead>
                        <tr>
                            <th colspan="3"><?= $tglTengah ?></th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th style="text-align: right;">Nominal</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        foreach ($denda as $d) { ?>
                            <?php
                            $total += $d->nominal;
                            $alasan = $this->db->query("SELECT alasan FROM ctt_denda WHERE nm_denda = '$d->nm_denda' AND tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY alasan")->result();
                            ?>
                            <tr>
                                <td><?= $d->nm_denda; ?></td>
                                <td style="text-align: right;"><?= number_format($d->nominal, 0); ?></td>
                                <td>
                                    <?php foreach ($alasan as $a) { ?>
                                        <?= $a->alasan; ?>,
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-bold">TOTAL</th>
                            <th colspan="2" class="text-bold"><?= number_format($total, 0); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </center>
        </div>
        <div class="item2">
            <center>
                <h5>Kasbon </h5>
                <table border="1" style="border-collapse: collapse; float: left; margin-left: 2px;" width="100%">
                    <thead>
                        <tr>
                            <th colspan="2"><?= $tglTengah ?></th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th style="text-align: right;">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        foreach ($kasbon as $d) { ?>
                            <?php
                            $total += $d->nominal;

                            ?>
                            <tr>
                                <td><?= $d->nm_kasbon; ?></td>
                                <td style="text-align: right;"><?= number_format($d->nominal, 0); ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-bold">TOTAL</th>
                            <th colspan="2" class="text-bold" style="text-align: right;"><?= number_format($total, 0); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </center>
        </div>
        <div class="item3">
            <center>
                <h5>Tips </h5>
                <table border="1" style="border-collapse: collapse; float: left; margin-left: 2px;" width="100%">
                    <thead>
                        <tr>
                            <th colspan="2"><?= $tglTengah ?></th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th style="text-align: right;">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        foreach ($tips as $d) { ?>
                            <?php
                            $total += $d->nominal;

                            ?>
                            <tr>
                                <td><?= $d->nm_tips; ?></td>
                                <td style="text-align: right;"><?= number_format($d->nominal, 0); ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-bold">TOTAL</th>
                            <th style="text-align: right;" colspan="2" class="text-bold"><?= number_format($total, 0); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </center>
        </div>
        <div class="item4">
            <center>
                <h5>Appointment </h5>
                <table border="1" style="border-collapse: collapse; float: left; margin-left: 2px;" width="100%">
                    <thead>
                        <tr>
                            <th colspan="3"><?= $tglTengah ?></th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th style="text-align: right;">Total orang</th>
                            <th style="text-align: right;">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        $ttl_org = 0;
                        foreach ($app as $d) { ?>
                            <?php
                            if ($d->nm_app == 'DINA' || $d->nm_app == 'ORCHARD') {
                                continue;
                            }
                            $total += $d->nominal;
                            $ttl_org += $d->orang;

                            ?>
                            <tr>
                                <td><?= $d->nm_app; ?></td>
                                <td style="text-align: right;"><?= $d->orang; ?></td>
                                <td style="text-align: right;"><?= number_format($d->nominal, 0); ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-bold">TOTAL</th>
                            <th style="text-align: right;" class="text-bold"><?= number_format($ttl_org, 0); ?></th>
                            <th style="text-align: right;" class="text-bold"><?= number_format($total, 0); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </center>
        </div>
    
        

    </div>
    <?php 
$dt1 = new DateTime($tgl1);
$dt2 = new DateTime($tgl2);
$beda = $dt2->diff($dt1);

?>
    <div class="wrapper">
        <div class="item1a">
            <h5 style="text-align: center;">Laporan Komisi Penjualan Orchard  <?= date('d M Y',strtotime($tgl1)) ?> -  <?= date('d M Y',strtotime($tgl2)) ?></h5>
            <table border="1" style="border-collapse: collapse; float: left;" width="100%">
            	<thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Komisi Service</th>
                            <th>Komisi Penjualan</th> 
                            <th>Komisi Request Therapish</th>
                            <th>Total Komisi</th>
                            <th>Total Komisi Target</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total_app = 0;
                    $total_penjualan = 0;
                    $total = 0;
                    $total_komisi_target = 0;
                    $total2 = 0;
                    ?>
                    <?php foreach ($komisi as $key => $value): ?>
                    <?php 
                        $names = ['T1', 'T2', 'T3','T4','T5','T6','T7','T8','T9','T10','ORCHARD'];
                        if(in_array($value->nm_kry,$names) || ($value->total_produk + $value->total_app) <= 0){
                            continue;
                        } 
                    ?>
                    
                    <?php 
                        $total_app += $value->total_app;
                        $total_penjualan += $value->total_produk;
                        $total += $value->total_app;
                        $total += $value->total_produk;
                        $total2 += $value->total_produk2;
            
            
                        if($rules_active){
                            if($rules_active->jenis == 'komisi'){
                                $target_komisi = ($rules_active->jumlah * $dt_masuk->jml_masuk) / ($beda->days + 1);
                            
                                if(($value->total_produk + $value->total_app) >= $target_komisi){
                                    
                                    $komisi_awal = (($value->total_produk + $value->total_app) * 100)/5;
                                    $komisi_target = ($komisi_awal * $rules_active->persen)/100;		
                                    
                                }else{
                                    $komisi_target = ($value->total_produk + $value->total_app);
                                }
                            }elseif($rules_active->jenis == 'pendapatan'){
                                if(($dt_sum_app->total + $dt_sum_pembelian->total - $invoice->diskon) >= $rules_active->jumlah ){
            												$komisi_awal = (($value->total_produk + $value->total_app + $value->total_produk2) * 100)/5;
            												$komisi_target = ($komisi_awal * $rules_active->persen)/100;
            											}else{
            												$komisi_target = ($value->total_produk + $value->total_app + $value->total_produk2);
            											}
            										}else{
            											$komisi_target = ($value->total_produk + $value->total_app + $value->total_produk2);
            										}
            									}else{
            										$komisi_target = ($value->total_produk + $value->total_app + $value->total_produk2);
                        }
            
                        $total_komisi_target += $komisi_target;
                    ?>
            			<tr>
            				<td><?= $key+1 ?></td>
                            <td><?= $value->nm_kry ?></td>
                            <td style="text-align: right;"><?= number_format($value->total_app) ?></td>
                            <td style="text-align: right;"><?= number_format($value->total_produk) ?></td>
                            <td style="text-align: right;"><?= number_format($value->total_produk2) ?></td>
            				<td style="text-align: right;"><?= number_format($value->total_produk + $value->total_app + $value->total_produk2) ?></td>
            				<td style="text-align: right;"><?= number_format($komisi_target) ?></td>
            			</tr>
            		<?php endforeach ?>
                    </tbody>
                    <tfoot class="bg-secondary text-light">
                        <tr>
                            <th colspan=2>Total</th>
                            <th style="text-align: right;"><?= number_format($total_app,0) ?></th>
                            <th style="text-align: right;"><?= number_format($total_penjualan,0) ?></th>
                            <th style="text-align: right;"><?= number_format($total2,0) ?></th>
                            <th style="text-align: right;"><?= number_format($total,0) ?></th>
                            <th style="text-align: right;"><?= number_format($total_komisi_target,0) ?></th>
                        </tr>
                    </tfoot>
            </table>
        </div>
        <div class="item2a">
            <h5 style="text-align: center;">Extra Time & Request </h5>
            <table border="1" style="border-collapse: collapse; float: left; margin-left: 2px;" width="100%">
                    <thead>
                        <tr>
                            <th colspan="3"><?= $tglTengah ?></th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th style="text-align: right;">Komisi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        $ttl = 0;
                        foreach ($dt_request as $k): 
                            $ttl += $k->ttl_komisi;
                            ?>
                            <tr>
                                <td><?= $k->nm_kry; ?></td>

                                <td><?= number_format($k->ttl_komisi, 0) ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>	
                            <tr>	
                                <th>TOTAL</th>
                                <th><?= number_format($ttl, 0); ?></th>
                            </tr>
                        </tfoot>
                </table>
        </div>
      
    </div>
    <br>
    <div class="wrapper">
        <div class="item1">
            <table border="1" style="border-collapse: collapse; float: left;" width="100%">
                <thead>
                    <tr>
                        <th>Type Therapish</th>
                        <th style=" text-align: right;">Rp/Hari</th>
                        <th style="text-align: right;">Tunjangan Skill</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tipe as $t) : ?>
                        <tr>
                            <td><?= $t->nm_tipe ?></td>
                            <td style="text-align: right;"><?= number_format($t->gaji, 0) ?></td>
                            <td style="text-align: right;"><?= number_format($t->tunjangan, 0) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="item2">
            <table border="1" style="border-collapse: collapse; float: left; margin-left: 2px;" width="100%">
                <thead>
                    <tr>
                        <th>Posisi</th>
                        <th style="text-align: right;">Tunjangan jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posisi as $p) : ?>
                        <tr>
                            <td><?= $p->posisi ?></td>
                            <td style="text-align: right;"><?= number_format($p->gaji, 0) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

<script>
    window.print();
</script>

</html>