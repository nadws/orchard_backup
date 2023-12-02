<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Summary_absen.xls");
?>
<center>
	<div style="margin-top: 50px;"></div>
	<h3>SUMMARY CUSTOMER CANCEL</h3>
	<table class="table" border="1" width="60%">
		<thead>
			<tr>
				<th>NO.</th>
				<th>TANGGAL</th>
				<th>NAMA CUSTOMER</th>
				<th>NO. TELP</th>
				<th>KETERANGAN</th>
			</tr>
		</thead>

		<tbody style="text-align: center;">
			<?php foreach ($data as $key => $value): ?>
				<tr>
					<td><?= $key+1 ?></td>
					<td><?=  date('D, d-M-y', strtotime($value->tgl)) ?></td>
					<td><?= $value->nama ?></td>
					<td>
					     <?php if (empty($value->telepon)): ?>
                                    -
                                    <?php else: ?>
                                    <?= $value->telepon ?>
                                <?php endif ?>
					</td>
					<td><?= $value->ket ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>

	</table>
</center>

