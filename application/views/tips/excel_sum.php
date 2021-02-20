<?php
$file = "TIPS_SUMMARY_".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<table class="table" border="1">
	<thead>
		<th colspan="2"><?= $sort ?></th>	
	</thead>
	<thead>
		<tr>
			<th>NAMA</th>
			<th>NOMINAL</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$ttl = 0;
		foreach ($tips as $k): 
			$ttl += $k->total;
			?>
			<tr>
				<td><?= $k->nm_tips; ?></td>
				<td><?= number_format($k->total, 0, "", "") ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>	
		<tr>	
			<th>TOTAL</th>
			<th><?= number_format($ttl, 0, "", ""); ?></th>
		</tr>
	</tfoot>
</table>