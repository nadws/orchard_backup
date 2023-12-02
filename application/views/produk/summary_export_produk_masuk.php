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
<h3>SUMMARY PRODUK MASUK</h3>
<p><?= $sort ?></p>
</center>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th>KATEGORI</th>
			<th>NAMA PRODUK</th>
            <th>JUMLAH</th>
            <th>HARGA BELI</th>
            <!-- <th>HARGA JUAL</th> -->
            <th>TANGGAL</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$ttl = 0;
		foreach ($masuk as $k): 
			// $ttl += $k->total;
			?>
			<tr>
                <td><?= $k->nm_kategori; ?></td>
                <td><?= $k->nm_produk; ?></td>
                <td><?= number_format($k->jumlah, 0) ?></td>
                <td><?= number_format($k->hrg_beli, 0) ?></td>
                <!-- <td><?= number_format($k->hrg_jual, 0) ?></td> -->
                <td><?=  date('d-M-y', strtotime($k->tgl)); ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<!-- <tfoot>	
		<tr>	
			<th>TOTAL</th>
			<th><?= number_format($ttl, 0); ?></th>
			<th></th>
		</tr>
	</tfoot> -->
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
<a href="<?= base_url('Match/excel_produk_masuk/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Summary Klik Here ...</i></a>



</body>
</html>



