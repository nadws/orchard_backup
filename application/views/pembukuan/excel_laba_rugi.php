<?php
$date=cal_days_in_month(CAL_GREGORIAN,$month,$year); 
    
$bulan = ['bulan','JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER']; 
$bulan1 = (int)$month;

$file = "LAPORAN_LABA_RUGI_ORCHARD_".$bulan[$bulan1]."_".$year.".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
        <table class="table table-sm table-borderless">
              <tbody>
                <tr class="text-center">
                  <th></th>
                  <th colspan="3">ORCHARD</th>
                  <th colspan="2"></th>
                </tr>
                <tr class="text-center">
                  <th></th>
                  <th colspan="3">LAPORAN LABA RUGI</th>
                  <th colspan="2"></th>
                </tr>
                <tr class="text-center">
                  <th></th>
                  <th colspan="3">PER <?= $date ?> <?= $bulan[$bulan1] ?> <?= $year ?></th>
                  <th colspan="2"></th>
                </tr>
              </tbody>
            </table>
<table class="table" border="1">
<tbody>
                                <tr>
                                    <td colspan="6"><strong>URAIAN</strong></td>
                                </tr>
                                <tr style="border-top: 2px solid black;">
                                    <td colspan="6"><strong>PEREDARAN USAHA</strong></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <?php 
                                $total_pendapatan = 0;
                                $total_pendapatan_bunga = 0;
                                foreach($laba as $l): ?>
                                <?php if($l->kredit_laba == 0){
                                  continue;
                                }
                                
                                if($l->id_akun == 4):?>
                                <?php
                                $total_pendapatan += $l->kredit_laba - $l->debit_laba ?>
                                <tr>
                                    <td width="10%"></td>
                                    <td colspan="2"><?= $l->nm_akun ?></td>
                                    <td width="5%">RP</td>
                                    <td colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($l->kredit_laba - $l->debit_laba,0) ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($l->id_akun == 56){
                                  $total_pendapatan_bunga += $l->kredit_laba - $l->debit_laba;
                                } ?>
                                <?php endforeach ;?>
                                <tr style="border-bottom: 2px solid black;">
                                    <td width="10%"></td> 
                                    <td colspan="2"><strong>TOTAL PENDAPATAN</strong></td>
                                    <td>RP</td>
                                    <td colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($total_pendapatan,0) ?></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="6"><strong>BIAYA-BIAYA</strong></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <?php 
                                $total_biaya = 0;
                                $pph = 0;
                                foreach($laba as $l): ?>
                                <?php $cek = ['4','5','56']; 
                                if(in_array($l->id_akun,$cek) || $l->debit_laba == 0){
                                    continue;
                                }elseif($l->id_akun == 50){
                                  $pph += $l->debit_laba - $l->kredit_laba;
                                  continue;
                                }
                                  ?>
                                <?php
                                $total_biaya += $l->debit_laba - $l->kredit_laba?>
                                <tr>
                                    <td width="10%"></td>
                                    <td colspan="2"><?= $l->nm_akun ?></td>
                                    <td width="5%">RP</td>
                                    <td colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($l->debit_laba - $l->kredit_laba,0) ?></td>
                                </tr>
                                <?php endforeach ;?>
                                <tr style="border-bottom: 2px solid black;">
                                    <td width="10%"></td>
                                    <td colspan="2"><strong>TOTAL BIAYA-BIAYA</strong></td>
                                    <td>RP</td>
                                    <td colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($total_biaya,0) ?></td>
                                </tr>
                            </tbody>
                           <tbody>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH SEBELUM PAJAK</strong></td>
                                  <td>RP</td>
                                  <th colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($total_pendapatan - $total_biaya,0) ?></th>
                                </tr>
                                <tr>
                                  <td colspan="3">PPH TERHUTANG (-)</td>
                                  <td>RP</td>
                                  <td colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($pph,0) ?></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH SETELAH PAJAK</strong></td>
                                  <td>RP</td>
                                  <th colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($total_pendapatan - $total_biaya -$pph,0) ?></th>
                                </tr>
                                <tr>
                                  <td colspan="3">PENDAPATAN BANK (+)</td>
                                  <td>RP</td>
                                  <td colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($total_pendapatan_bunga,0) ?></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH</strong></td>
                                  <td>RP</td>
                                  <th colspan="2" style="text-align: right; mso-number-format:\@;"><?= number_format($total_pendapatan - $total_biaya - $pph + $total_pendapatan_bunga,0) ?></th>
                                </tr>
                           </tbody>
</table>


