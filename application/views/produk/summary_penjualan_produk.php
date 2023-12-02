<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<center>
<h3>SUMMARY PENJUALAN PRODUK</h3>
<p><?= $sort ?></p>
</center>

<table class="table">
	<thead class="thead-light">
		<tr>
            <th>KATEGORI</th>
			<th>NAMA PRODUK</th>
            <th>QTY</th>
            <th>TOTAL</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$ttl = 0;
		foreach ($penjualan as $k): 
			$ttl += $k->total;
			?>
			<tr>
                <td><?= $k->nm_kategori; ?></td>
                <td><?= $k->nm_produk; ?></td>
                <td><?= number_format($k->jumlah, 0) ?></td>
                <td><?= number_format($k->total, 0) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot class="bg-secondary text-light">	
		<tr>	
			<th colspan="3">TOTAL</th>
			<th><?= number_format($ttl, 0); ?></th>
		</tr>
	</tfoot>
</table>
<br><br>

<center>
<h3>DETAIL PENJUALAN PRODUK</h3>
</center>

<table class="table">
	<thead class="thead-light">
		<tr>
            <th>PRODUK</th>
			<th>PENJUAL</th>
            <th>QTY</th>
			<th>SATUAN</th>
			<th>HARGA</th>
			<th>DISKON</th>
			<th>TOTAL</th>			
		</tr>
	</thead>
	
	<tbody>
		<?php
		$ttl = 0;
		foreach ($detail as $k): 
			$ttl += $k->total;
			?>
			<tr>
				<td><?= $k->nm_produk; ?></td>
				<td><?= $k->nm_karyawan; ?></td>
				<td><?= $k->jumlah; ?></td>
				<td><?= $k->satuan; ?></td>
				<td>Rp. <?= number_format($k->harga, 0) ?></td>
				<td> <?= number_format($k->diskon, 0) ?>%</td>
                <td>Rp. <?= number_format($k->total, 0) ?></td>
                
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot class="bg-secondary text-light">	
		<tr>	
			<th colspan="6">TOTAL</th>
			<th><?= number_format($ttl, 0); ?></th>
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
<hr>	
<a href="<?= base_url('Match/excel_penjualan_produk/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Summary_PENJUALAN_PRODUK Klik Here ...</i></a>
<br>
<a href="<?= base_url('Match/excel_detail_penjualan_produk/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Detail_PENJUALAN_PRODUK Klik Here ...</i></a>



</body>
</html>