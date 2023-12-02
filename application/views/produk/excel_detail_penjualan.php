<?php
$file = "DETAIL_PENJUALAN_PRODUK_".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<thead>
		<th colspan="4"><?= $sort ?></th>	
</thead>
<table class="table" border="1">
<thead style="text-align: center;">
		<th colspan="7">SUMMARY PENJUAL PRODUK</th>	
</thead>
	<thead>
		<tr>
            <th>PRODUK</th>
			<th>PENJUAL</th>
            <th>QTY</th>
			<th>SATUAN</th>
			<th>HARGA</th>
			<th>DISKON</th>
			<th>TOTAL</th>			
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$ttl = 0;
		foreach ($detail as $k): 
			$ttl += $k->total;
			?>
			<tr>
				<td><?= $k->nm_produk; ?></td>
				<td><?= $k->nm_karyawan; ?></td>
				<td><?= $k->jumlah; ?></td>
				<td><?= $k->satuan; ?></td>
				<td>Rp. <?= number_format($k->harga, 0) ?></td>
				<td>Rp. <?= number_format($k->diskon, 0) ?></td>
                <td>Rp. <?= number_format($k->total, 0) ?></td>
                
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>	
		<tr>	
			<th colspan="6">TOTAL</th>
			<th>Rp. <?= number_format($ttl, 0); ?></th>
		</tr>
	</tfoot>
</table>