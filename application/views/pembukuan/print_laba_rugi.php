<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <?php
    $date=cal_days_in_month(CAL_GREGORIAN,$month,$year); 
    
    $bulan = ['bulan','JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER']; 
    $bulan1 = (int)$month; 
    ?>
    <title>Laporan Laba Rugi</title>
  </head>
  <body>
      <!-- <div class="container">
          <h5>KEMENTRIAN KEUANGAN INDONESIA</h5>
          <h5>KANTOR WILAYAH DJP</h5>
          <h5>KALIMANTAN SELATAN</h5>
          <h5>KANTOR PELAYANAN PAJAK PRAMATA BANJARMASIN</h5>
          <br>
          <h5 class="text-center">ORCHRAD BEAUTY STUDIO</h5>
          <h5 class="text-center">LAPORAN LABA RUGI</h5>
          <h5 class="text-center">ORCHRAD BEAUTY STUDIO</h5>
          <h5 class="text-center">PER <?= $date ?> <?= $bulan[$bulan1] ?> <?= $year ?></h5>
      </div>
      <br> -->
    <div class="container">
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
            <table class="table table-sm table-sm table-bordered">
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
                                    <td colspan="2" style="text-align: right;"><?= number_format($l->kredit_laba - $l->debit_laba,0) ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($l->id_akun == 56){
                                  $total_pendapatan_bunga += $l->kredit_laba - $l->debit_laba;
                                } ?>
                                <?php endforeach ;?>
                                <tr style="border-bottom: 2px solid black;">
                                    <td width="10%"></td>
                                    <td colspan="2"><strong>TOTAL PENDAPATAN</strong></td>
                                    <td>Rp</td>
                                    <td style="text-align: right;"><strong><?= number_format($total_pendapatan,0) ?></strong></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="5"><strong>BIAYA-BIAYA</strong></td>
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
                                $total_biaya += $l->debit_laba -  $l->kredit_laba?>
                                <tr>
                                    <td width="10%"></td>
                                    <td colspan="2"><?= $l->nm_akun ?></td>
                                    <td width="5%">Rp</td>
                                    <td style="text-align: right;"><?= number_format($l->debit_laba - $l->kredit_laba,0) ?></td>
                                </tr>
                                <?php endforeach ;?>
                                <tr style="border-bottom: 2px solid black;">
                                    <td width="10%"></td>
                                    <td colspan="2"><strong>TOTAL BIAYA-BIAYA</strong></td>
                                    <td>Rp</td>
                                    <td style="text-align: right;"><strong><?= number_format($total_biaya,0) ?></strong></td>
                                </tr>
                            </tbody>
                           <tbody>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH SEBELUM PAJAK</strong></td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya,0) ?></strong></td>
                                </tr>
                                <tr>
                                  <td colspan="3">PPH TERHUTANG (-)</td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><?= number_format($pph,0) ?></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH SETELAH PAJAK</strong></td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya -$pph,0) ?></strong></td>
                                </tr>
                                <tr>
                                  <td colspan="3">PENDAPATAN BANK (+)</td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><?= number_format($total_pendapatan_bunga,0) ?></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH</strong></td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya - $pph + $total_pendapatan_bunga,0) ?></strong></td>
                                </tr>
                           </tbody>
                           
                        </table>


    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>