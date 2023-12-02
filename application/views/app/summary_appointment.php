<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
<br>
<center>
	<p><strong>SUMMARY APPOINTMENT</strong></p>
</center>
<table class="table text-center" width="100%">
	<thead>
		<th colspan="8"><?= $sort ?></th>	
	</thead>
	<thead class="thead-light" >
		<tr >
			<th>SERVIS</th>
			<th>JUMLAH</th>
			<th>TOTAL</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$total_servis = 0;
		?>
		<?php	foreach ($servis as $k): ?>
			<?php
			$total_servis += $k->total;
			?>
			<tr>
                <td><?= $k->nm_servis; ?></td>
				<td><?= $k->qty; ?></td>
				<td>Rp. <?= number_format($k->total); ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot class="bg-secondary">
		<tr>
			<th colspan="2">TOTAL</th>
			<th>Rp. <?= number_format($total_servis); ?></th>
		</tr>
	</tfoot>
</table>

<center>
	<p><strong>DETAIL SUMMARY APPOINTMENT</strong></p>
</center>
<table class="table text-center" width="100%">
	<thead class="thead-light">
		<tr >
			<th>NO NOTA</th>
			<th>CUSTOMER - SERVIS</th>
			<th>QTY</th>
			<th>THERAPIST</th>
			<th>TANGGAL</th>
			<th>JAM MULAI s/d JAM SELESAI</th>
			<th>BIAYA</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$total = 0;
		?>
		<?php	foreach ($appointment as $k): ?>
			<?php
			$total += $k->total;
			?>
			<tr>
				<td><?= $k->no_nota; ?></td>
                <td><?= $k->nama; ?> - <?= $k->nm_servis; ?></td>
                <td><?= $k->qty; ?></td>
				<td><?= $k->nm_karyawan; ?></td>
				<td><?= date('d-M-Y', strtotime($k->tgl)) ?></td>
				<td><?= date('H:i', strtotime($k->start)) ?> s/d <?= date('H:i', strtotime($k->end)) ?></td>
				<td>Rp. <?= number_format($k->total); ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot class="bg-secondary">
		<tr>
			<th colspan="6">TOTAL</th>
			<th>Rp. <?= number_format($total); ?></th>
		</tr>
	</tfoot>
</table>

</body>
</html>