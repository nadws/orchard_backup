<?php
$file = "APPOINTMENT_SUMMARY".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
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
			<th>TTL_ORG</th>
			<th>NOMINAL</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$ttl = 0;
		$ttl_b = 0;
		foreach ($app as $k): 
			$ttl += $k->total;
			$ttl_b += $k->ttl_app;
			?>
			<tr>
				<td><?= $k->nm_app; ?></td>
				<td><?= $k->ttl_app; ?></td>
				<td><?= number_format($k->total, 0, "", "") ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>	
			<tr>	
				<th>TOTAL</th>
				<th><?= number_format($ttl_b, 0, "", ""); ?></th>
				<th><?= number_format($ttl, 0, "", ""); ?></th>
			</tr>
		</tfoot>
	</table>