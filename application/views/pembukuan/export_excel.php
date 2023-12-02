<?php
$file = "DETAIL_AKUN_".$akun->nm_akun.".xls";
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$file");
?>

<table class="table" border="1">
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
                                    <th >Debit</th>
                                    <th >Kredit</th>
                                    <th>Saldo</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                            <?php $total_debit = 0;
                                $total_kredit = 0;
                                $total_saldo = 0;
                            ?>                       
                            <?php foreach($buku as $b) : ?>
                            <tr>
                            <?php 
                                $saldo = $b->debit - $b->kredit;
                                $total_debit += $b->debit;
                                $total_kredit += $b->kredit;
                                $total_saldo += $saldo;
                            ?>
									<td><?= date('d/m/Y' , strtotime($b->tgl)) ?></td>
                                    <td><?= $b->ket ?></td>                               
                                    <td><?= $b->debit ?></td>
                                    <td><?= $b->kredit ?></td>
                                    <td><?= $b->debit - $b->kredit ?></td>                                                            
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                            <tfoot class="bg-secondary text-light">
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td><?= $total_debit ?></td>
                                    <td><?= $total_kredit ?></td>
                                    <td><?= $total_saldo ?></td>
                                </tr>
                            </tfoot>
            </table>