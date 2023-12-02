<?php
$file = "JURNAL_PENGELUARAN_ORCHARD_".$sort.".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
        <table class="table table-sm table-borderless">
              <thead>
                <tr class="text-center">
                  <th colspan="8">Jurnal Pengeluaran Orchard Periode <?= $sort ?></th>
                </tr>
              </thead>
            </table>
    <table class="table" border="1">
        <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Nota</th>
                <th>No Akun</th>
                <th>Nama Akun</th>
                <th>Keterangan</th>
                <th>Debit</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
            $total_debit=0;
            $total_kredit=0;
            foreach($jurnal as $p): 
            $total_debit+=$p->debit;
            $total_kredit+=$p->kredit;    
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= date('d-m-y', strtotime($p->tgl)) ?></td>
                    <td><?= $p->no_nota ?></td>
                    <td><?= $p->no_akun ?></td>
                    <td><?= $p->nm_akun ?></td>
                    <td><?= $p->ket ?></td>
                    <td style="text-align: right;"><?= number_format($p->debit, 0) ?></td>
                    <td style="text-align: right;"><?= number_format($p->kredit, 0) ?></td>
                </tr>
            <?php endforeach; ?>    
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" rowspan="2" style="text-align: center"><strong>Total</strong></td>
                    <td style="text-align: right;"><?= number_format($total_debit, 0) ?></td>
                    <td style="text-align: right;"><?= number_format($total_kredit, 0) ?></td>
                </tr>
                <tr>
                <td colspan="2" style="text-align: right;"><?= number_format($total_debit - $total_kredit, 0) ?></td>
                </tr>
            </tfoot>
    </table>


