<?php
$file = "PRODUK_MASUK_".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<table class="table" border="1">
	<thead>
		<th colspan="5"><?= $sort ?></th>	
	</thead>
	<thead>
		<tr>
			<th>KATEGORI</th>
			<th>NAMA PRODUK</th>
            <th>JUMLAH</th>
            <th>HARGA BELI</th>
            <th>TANGGAL</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$ttl = 0;
		foreach ($masuk as $k): 
			// $ttl += $k->total;
			?>
			<tr>
                <td><?= $k->nm_kategori; ?></td>
                <td><?= $k->nm_produk; ?></td>
                <td><?= $k->jumlah ?></td>
                <td><?= $k->hrg_beli ?></td>
                <td><?=  date('d-M-y', strtotime($k->tgl)); ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<!-- <tfoot>	
		<tr>	
			<th>TOTAL</th>
			<th><?= $ttl; ?></th>
			<th></th>
		</tr>
	</tfoot> -->
</table>