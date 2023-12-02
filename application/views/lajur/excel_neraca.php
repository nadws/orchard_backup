<?php
$date=cal_days_in_month(CAL_GREGORIAN,$month,$year); 
    
$bulan = ['bulan','JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER']; 
$bulan1 = (int)$month;

$file = "LAPORAN_NERACA_ORCHARD_".$bulan[$bulan1]."_".$year.".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
        <table class="table table-sm table-borderless">
              <tbody>
                <tr class="text-center">
                  <th colspan="3">ORCHARD</th>
                </tr>
                <tr class="text-center">
                  <th colspan="3">NERACA</th>
                </tr>
                <tr class="text-center">
                  <th colspan="3">PER <?= $date ?> <?= $bulan[$bulan1] ?> <?= $year ?></th>
                </tr>
              </tbody>
            </table>
<table class="table" border="1">
<tbody>
                    <tr>
                        <td colspan="3"><strong>AKTIVA</strong></td>
                    </tr>    
                </tbody>
                <tbody>
                <tr>
                    <td colspan="3">AKTIVA LANCAR</td>
                </tr>
                <?php
                    $debit = 0;
                    $setara_kas = 0;
                    foreach($neraca as $s){
                        if($neraca > 0 and  $s->id_kategori == 1){
                            $kas = $s->debit_neraca_saldo + $s->debit_neraca + $s->debit_lanjut - $s->kredit_neraca - $s->kredit_neraca_saldo - $s->kredit_lanjut;
                            $setara_kas += $kas;
                        }
                    }
                    ?>
                    <tr>
                        <td width="60%">KAS & SETARA KAS</td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><?= number_format($setara_kas, 0) ?></td>
                    </tr>
                <?php    
                    foreach ($neraca as $n) :
                        $neraca = $n->debit_neraca_saldo + $n->debit_neraca + $n->debit_lanjut - $n->kredit_neraca - $n->kredit_neraca_saldo - $n->kredit_lanjut;
                        if ($neraca > 0 and $n->aktiva_l == "Y") {
                            if($n->id_kategori == 1){
                                continue;
                            }else{
                                $debit += $neraca;
                            }
                            
                        }
                ?>

                <?php
                
                 if ($neraca > 0 and $n->aktiva_l == "Y") : ?>
                 <?php if($n->id_kategori == 1){
                     continue;
                 } ?>
                    <tr>
                        <td width="60%"><?= $n->nm_akun ?></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><?= number_format($neraca, 0) ?></td>
                    </tr>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php endforeach; ?>    

                    <tr>
                        <td width="60%"><strong>JUMLAH AKTIVA LANCAR</strong></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><strong><?= number_format($debit + $setara_kas, 0) ?></strong></td>
                    </tr>

                </tbody>
                <tbody>
                <tr>
                    <td colspan="3">AKTIVA TETAP</td>
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
                        <td width="60%"><?= $n->nm_akun ?></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><?= number_format($neraca1, 0) ?></td>
                    </tr>
                    <?php else : ?>
                    <?php endif ?>
                    <?php endforeach ?>    

                    <tr>
                        <td width="60%">TOTAL AKTIVA</td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><?= number_format($debit1, 0) ?></td>
                    </tr>

                </tbody>
                <tbody>
                    <tr>
                        <td width="60%"><strong>NILAI BUKU</strong></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><strong><?= number_format($debit1, 0) ?></strong></td>
                    </tr>

                    <tr>
                        <td width="60%"><strong></strong></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><strong><?= number_format($debit + $debit1 + $setara_kas, 0) ?></strong></td>
                    </tr>
                </tbody>
</table>

<table>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
</table>

<table class="table" border="1">
                <tbody>
                    <tr>
                        <td colspan="3"><strong>PASIVA</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Hutang
                        </td>
                    </tr>
                </tbody>
                <tbody>

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
                        <td width="60%"><?= $h->nm_akun ?></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><?= number_format($neraca * -1, 0) ?></td>
                    </tr>
                    <?php else : ?>

                    <?php endif ?>
                    <?php endforeach ?>    

                    <tr>
                        <td width="60%"><strong>TOTAL KEWAJIBAN LANCAR</strong></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><strong><?= number_format($hutang1 * -1, 0) ?></strong></td>
                    </tr>

                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
                <tbody>
                <tr>
                    <td colspan="3">EKUITAS</td>
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
                       $ltb = $h->debit_neraca_saldo - $h->kredit_neraca_saldo;
                       $ltb2 = $ltb*-1;  
                       $laba_tahun_berjalan += $ltb2;    
                   ?>
                   <?php else: ?>
                       <?php 
                            $neraca = $h->debit_neraca_saldo + $h->debit_neraca + $h->debit_lanjut - $h->kredit_neraca - $h->kredit_neraca_saldo - $h->kredit_lanjut;
                            $hutang2 += $neraca;    
                       ?>
                    <tr>
                        <td width="60%"><?= $h->nm_akun ?></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><?= number_format($neraca * -1, 0) ?></td>
                    </tr>
                    <?php endif; ?>
                        <?php else : ?>

                        <?php endif ?>
                    <?php endforeach ?>    

                    <?php $ttl_laba_berjalan = $total_laba * -1 + $laba_tahun_berjalan; 
                         $ttl_ekuitas = $ttl_laba_berjalan + ($hutang2 * -1);
                    ?>   

                    <tr>
                        <td width="60%">LABA TAHUN BERJALAN</td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><?=  number_format($ttl_laba_berjalan,0) ?></td>
                    </tr>

                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td width="60%"><strong>TOTAL EKUITAS</strong></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><strong><?= number_format($ttl_ekuitas,0) ?></strong></td>
                    </tr>

                    <tr>
                        <td colspan="3"></td>
                    </tr>

                    <tr>
                        <td width="60%"><strong>JUMLAH PASIVA</strong></td>
                        <td width="10%">RP</td>
                        <td width="30%" style="text-align: right; mso-number-format:\@;"><strong><?= number_format($ttl_ekuitas + ($hutang1 * -1), 0) ?></strong></td>
                    </tr>
                </tbody>
            </table>


