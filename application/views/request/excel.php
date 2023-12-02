<?php
$file = "Komisi_Extra_Time_dan_Request".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<table class="table" border="1">
	<thead>
			<th colspan="2">Laporan Komisi <?= date('d M y',strtotime($tgl1)) ?> - <?= date('d M y',strtotime($tgl2)) ?></th>	
	</thead>
	<thead>
		<tr>
			<th>THERAPIST</th>
			<th>KOMISI</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$ttl = 0;
		foreach ($dt_request as $k): 
			$ttl += $k->ttl_komisi;
			?>
			<tr>
				<td><?= $k->nm_kry; ?></td>

				<td><?= number_format($k->ttl_komisi, 0) ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>	
			<tr>	
				<th>TOTAL</th>
				<th><?= number_format($ttl, 0); ?></th>
			</tr>
		</tfoot>
	</table>