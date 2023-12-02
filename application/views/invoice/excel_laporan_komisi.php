<?php
$file = "Laporan Komisi Penjualan Orchard ".date('d M Y',strtotime($tgl1))." - ".date('d M Y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>

<?php 
$dt1 = new DateTime($tgl1);
$dt2 = new DateTime($tgl2);
$beda = $dt2->diff($dt1);

?>

<table class="table" border="1">
	<thead>
		<th colspan="6">Laporan Komisi Penjualan Orchard  <?= date('d M Y',strtotime($tgl1)) ?> -  <?= date('d M Y',strtotime($tgl2)) ?></th>	
	</thead>
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