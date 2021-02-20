<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Detail_absen.xls");
?>
<table class="table" border="1">
	<thead>
		<tr>
			<th>#</th>
			<th>TANGGAL</th>
			<th>NAMA</th>
			<th>PEMAKAI</th>
			<th>SHIFT</th>
			<th>KETERANGAN</th>
			<th>JAM_AWAL</th>
			<th>JAM_AKHIR</th>
			<th>JAM_KERJA</th>
			<th>PANEN</th>
			<th>ADMIN</th>
		</tr>
	</thead>
	<tbody style="text-align: center;">
		<?php
		$i=1;
		foreach ($absen as $k): ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= date('d-M-y',strtotime($k->tanggal)) ?></td>
				<td><?= $k->nm_laki; ?></td>
				<td><?= $k->pemakai ?></td>
				<td><?= $k->shift ?></td>
				<td><?= $k->ket ?></td>
				<td><?= date('H:i', strtotime($k->jam_awal)); ?></td>
				<td><?= date('H:i', strtotime($k->jam_akhir)); ?></td>
				<?php if (!empty($k->jam_awal)): ?>
					<td><?= number_format($k->selisih/60) ?></td>
					<?php else: ?>
						<td></td>
					<?php endif ?>
					<td><?= $k->panen ?></td>
					<td><?= $k->admin ?></td>
				</tr>
				<?php $i++; endforeach ?>
			</tbody>
		</table>