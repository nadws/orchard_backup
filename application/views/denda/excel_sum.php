<?php
$file = "DENDA_".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<table class="table" border="1">
	<thead>
		<th colspan="3"><?= $sort ?></th>	
	</thead>
	<thead>
		<tr>
			<th>NAMA</th>
			<th>NOMINAL</th>
			<th>ALASAN</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$ttl = 0;
		foreach ($denda as $k): 
			$ttl += $k->total;
			?>
			<tr>
				<td><?= $k->nm_denda; ?></td>
				<td><?= number_format($k->total, 0) ?></td>
				<td style="width: 150px;"><?= $k->alasan ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>	
		<tr>	
			<th>TOTAL</th>
			<th><?= number_format($ttl, 0); ?></th>
			<th></th>
		</tr>
	</tfoot>
</table>