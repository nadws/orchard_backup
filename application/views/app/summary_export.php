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
	<h3>SUMMARY APPOINTMENT</h3>
</center>
<table class="table text-center" width="100%">
	<thead>
		<th colspan="7"><?= $sort ?></th>	
	</thead>
	<thead >
		<tr >
			<th>TERAPIS</th>
			<th>CUSTOMER - SERVIS</th>
			<th>TANGGAL</th>
			<th>JAM MULAI</th>
			<th>JAM SELESAI</th>
			<th>STATUS</th>
			<th>TOTAL RP</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$total = 0;
		?>
		<?php	foreach ($app as $k): ?>
			<?php
			$total += $k->total;
			?>
			<tr>
				<td><?= $k->nama_t; ?></td>
				<td><?= $k->nama; ?> - <?= $k->nm_servis; ?></td>
				<td><?= date('d-M-Y', strtotime($k->tanggal)) ?></td>
				<td><?= date('H:i', strtotime($k->start)) ?></td>
				<td><?= date('H:i', strtotime($k->end)) ?></td>
				<td><?= $k->status; ?></td>
				<td>Rp. <?= number_format($k->total); ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="6">TOTAL</th>
			<th>Rp. <?= number_format($total); ?></th>
		</tr>
	</tfoot>
</table>

<br><br>
<center>
	<h3>SUMMARY PENJUALAN PRODUK</h3>
</center>
<table class="table text-center" width="100%">
	<thead>
		<th colspan="12"><?= $sort ?></th>	
	</thead>
	<thead>
		<tr>
			<th>NO.</th>
			<th>PENJUAL</th>
			<th>TANGGAL</th>
			<th>PRODUK</th>
			<th>JUMLAH</th>
			<th>SANTUAN</th>
			<th>HARGA</th>
			<th>DISKON</th>
			<th>TOTAL</th>
			<th>PEMBAYARAN</th>
			<th>CATATAN</th>
			<th>ADMIN</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		$total = 0;
		?>
		<?php foreach ($penjualan as $key => $value): ?>
			<?php  
			$total  += $value->total;
			?>
			<tr>
				<td><?= $key+1 ?></td>
				<td><?= $value->nm_kry ?></td>
				<td><?= date('D-m-Y', strtotime($value->tanggal)) ?></td>
				<td><?= $value->nm_produk ?></td>
				<td><?= $value->jumlah ?></td>
				<td><?= $value->satuan ?></td>
				<td><?= number_format($value->harga) ?></td>
				<td><?= number_format($value->diskon) ?></td>
				<td><?= number_format($value->total) ?></td>
				<td><?= $value->metode ?></td>
				<td><?= $value->catatan ?></td>
				<td><?= $value->admin ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="8">TOTAL</th>
			<th colspan="4">Rp. <?= number_format($total); ?></th>
		</tr>
	</tfoot>
</table>
<hr>

<br>
<br>
<center>
	<h3>SUMMARY KOMISI PENJUALAN</h3>
</center>
<table class="table text-center" width="100%">
	<thead>
		<th colspan="7"><?= $sort ?></th>	
	</thead>
	<thead>
		<tr>
			<th>KARYAWAN</th>
			<th>JUMLAH KOMISI</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$tk = 0;
		?>
		<?php	foreach ($komisi as $k): ?>
			<?php
			$tk += $k->komisi;
			?>
			<tr>
				<td><?= $k->nm_kry; ?></td>
				<td><?= $k->komisi; ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th >TOTAL</th>
			<th>Rp. <?= number_format($tk); ?></th>
		</tr>
	</tfoot>
</table>

<br>
<br>
<center>
	<h3>SUMMARY KOMISI THERAPIST</h3>
</center>
<table class="table text-center" width="100%">
	<thead>
		<th colspan="7"><?= $sort ?></th>	
	</thead>
	<thead>
		<tr>
			<th>KARYAWAN</th>
			<th>JUMLAH KOMISI</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
		<?php
		$tk = 0;
		?>
		<?php	foreach ($komisi_app as $k): ?>
			<?php
			$tk += $k->komisi;
			?>
			<tr>
				<td><?= $k->nm_kry; ?></td>
				<td><?= $k->komisi; ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th >TOTAL</th>
			<th>Rp. <?= number_format($tk); ?></th>
		</tr>
	</tfoot>
</table>

<style>
	@media print {

		.no_print,
		.no-print * {
			display: none !important;
		}
	}
</style>

<!--<a href="<?= base_url('Match/excel_app_sum/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Summary Klik Here ...</i></a><br>-->
<!--<a href="<?= base_url('Match/excel_app_det/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Detail Klik Here ...</i></a>-->


</body>
</html>