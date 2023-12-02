<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <br>
    <?php
    $date=cal_days_in_month(CAL_GREGORIAN,$month,$year); 
    
    $bulan = ['bulan','JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER']; 
    $bulan1 = (int)$month; 
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: #FADADD;">
                        <h6 style="text-align: center; font-weight: bold; color:#78909C ;">Orcahrd Beauty Studio</h6>
                        <h6 style="text-align: center; font-weight: bold; color:#78909C">Neraca Lajur</h6>
                        <h6 style="text-align: center; font-weight: bold; color:#78909C">Untuk Periode yang Berakhir <?= $date ?> <?= $bulan[$bulan1] ?> <?= $year ?></h6>
                    </div>
                    <div class="card-body">

                            <table class="table table-bordered" style="font-size: small;">
                                <thead style="font-family: Helvetica; color: #78909C; background-color: #F4F8F9; font-weight: 700; box-shadow: 0px 1px 3px 0px #cccccc; text-align: center;">
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle;">No. <br> Akun</th>
                                        <th rowspan="2" style="vertical-align: middle;">Nama Akun</th>
                                        <th colspan="2">Neraca Saldo</th>
                                        <th colspan="2">Penyesuaian</th>
                                        <th colspan="2">Neraca Saldo <br> Disesuaikan</th>
                                        <th colspan="2">Laporan <br> Laba/Rugi</th>
                                        <th colspan="2">Neraca</th>
                                    </tr>
                                    <tr>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>

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
                                    $total_neraca += $neraca;

                                     //laba lanjut
                                     $total_laba_lanjut += $laba_lanjut;

                                    
                                    
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>