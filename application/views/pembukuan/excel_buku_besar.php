<?php
$date=cal_days_in_month(CAL_GREGORIAN,$month,$year); 
    
$bulan = ['bulan','JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER']; 
$bulan1 = (int)$month;

$file = "BUKU_BESAR_".$akun->nm_akun."_".$bulan[$bulan1]."_".$year.".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
        <table class="table">
            <thead>
                <tr>
                    <th width="25%">Nama Akun : </th>
                    <th colspan="2"><?= $akun->nm_akun ?></th>
                    <th width="25%">No Akun : </th>
                    <th width="20%"><?= $akun->no_akun ?></th>
                </tr>
            </thead>
          </table>
          <table class="table" border="1">
                        <thead class="bg-secondary text-light">
                                <tr>
								    <th>Tanggal</th>
                                    <th >Keterangan</th>
                                    <th >Akun2</th>
                                    <th >Post Center</th>
                                    <th >Debit</th>
                                    <th >Kredit</th>
                                    <th>Saldo</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                            <?php $total_debit = 0;
                                $total_kredit = 0;
                                $total_saldo = 0;
                                $saldo1=0;
                            ?>
                            <?php foreach($neraca_saldo as $ns) : ?>
                            <?php $saldo_neraca = $ns->debit_saldo - $ns->kredit_saldo;
                                $saldo1 += $saldo_neraca;
                                $total_debit += $ns->debit_saldo;
                                $total_kredit += $ns->kredit_saldo;
                            ?>
                            <tr>
                            <td><?= date('d/m/Y' , strtotime($ns->tgl)) ?></td>
                                    <td>Neraca saldo</td>     
                                    <td></td>
                                    <td><?= number_format($ns->debit_saldo,0) ?></td>
                                    <td><?= number_format($ns->kredit_saldo,0) ?></td>
                                    <!--<td><?= number_format($ns->debit - $b->kredit,0) ?></td>-->
                                    <td><?= number_format($saldo1,0) ?></td>
                            </tr>
                            <?php endforeach; ?>

                            <?php foreach($lanjut as $l) : ?>
                            <?php $saldo_berjalan = $l->debit - $l->kredit;
                                $saldo1 += $saldo_berjalan;

                                if($saldo_berjalan > 0){
                                    $debit_berjalan = $saldo_berjalan;
                                    $kredit_berjalan = 0;
                                }elseif($saldo_berjalan < 0){
                                    $debit_berjalan = 0;
                                    $kredit_berjalan = $saldo_berjalan * -1;
                                }else{
                                    $debit_berjalan = 0;
                                    $kredit_berjalan = 0;
                                }

                                $total_debit += $debit_berjalan;
                                $total_kredit += $kredit_berjalan;
                            ?>
                            <tr>
                                    <td></td>
                                    <td>Saldo Berjalan</td>
                                    <td></td>
                                    <td></td>
                                    <td><?= number_format($debit_berjalan,0) ?></td>
                                    <td><?= number_format($kredit_berjalan,0) ?></td>    
                                    <td><?= number_format($saldo1,0) ?></td>
                            </tr>
                            <?php endforeach; ?> 

                            <?php foreach($buku as $b) : ?>
                            <tr>
                            <?php
                                
                                $saldo = $b->debit - $b->kredit;
                                $saldo1 += $saldo;
                                $total_debit += $b->debit;
                                $total_kredit += $b->kredit;
                                // $total_saldo += $saldo;
                            ?>
									<td><?= date('d/m/Y' , strtotime($b->tgl)) ?></td>
                                    <td><?= $b->ket ?></td>                               
                                    <td><?= $b->ket3 ?></td>                               
                                    <td><?= $b->nm_post ?></td>                               
                                    <td><?= number_format($b->debit,0) ?></td>
                                    <td><?= number_format($b->kredit,0) ?></td>
                                    <!--<td><?= number_format($b->debit - $b->kredit,0) ?></td>-->
                                    <td><?= number_format($saldo1,0) ?></td>
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                            <tfoot class="bg-secondary text-light">
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td><?= number_format($total_debit,0) ?></td>
                                    <td><?= number_format($total_kredit,0) ?></td>
                                    <td><?= number_format($saldo1,0) ?></td>
                                </tr>
                            </tfoot>
            </table>


