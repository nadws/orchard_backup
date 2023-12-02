<?php
$file = "APPOINTMENT_DETAIL".date('d_M_y',strtotime($tgl1))."_sd_".date('d_M_y',strtotime($tgl2)).".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<table border="1" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>TANGGAL</th>
			<th>RESEPSIONIS</th>    
			<th>TTL_APPOIMENT(ORG)</th>
			<th>NOMINAL</th>
			<th>ADMIN</th>
		</tr>
	</thead>

	<tbody style="text-align: center;">
		<?php
		$i=1;
		foreach ($app as $k): ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= date('d-M-y',strtotime($k->tgl)) ?></td>
				<td><?= $k->nm_app; ?></td>
				<td><?= $k->org; ?></td>
				<td><?= number_format($k->nominal, 0, "", "") ?></td>
				<td><?= $k->admin ?></td>									
			</tr>
			<?php $i++; endforeach ?>
		</tbody>
	</table>