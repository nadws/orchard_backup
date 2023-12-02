<?php
$file = "PENJUALAN_PRODUK_".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<thead>
		<th colspan="4"><?= $sort ?></th>	
</thead>
<table class="table" border="1">
<thead style="text-align: center;">
		<th colspan="4">SUMMARY PENJUAL PRODUKi</th>	
</thead>
	<thead>
		<tr>
            <th>KATEGORI</th>
			<th>NAMA PRODUK</th>
            <th>QTY</th>
            <th>TOTAL</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$ttl = 0;
		foreach ($penjualan as $k): 
			$ttl += $k->total;
			?>
			<tr>
                <td><?= $k->nm_kategori; ?></td>
                <td><?= $k->nm_produk; ?></td>
                <td><?= $k->jumlah; ?></td>
                <td><?= $k->total; ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>	
		<tr>	
			<th colspan="3">TOTAL</th>
			<th><?= $ttl; ?></th>
		</tr>
	</tfoot>
</table>


