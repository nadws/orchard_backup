<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	
<div class="row">
	<div class="col-8">
	<table class="table text-center" >
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
			if($k->nm_app == 'DINA' || $k->nm_app == 'ORCHARD'){
				continue;
			} 
			$ttl += $k->total;
			$ttl_b += $k->ttl_app;
			?>
			<tr>
				<td><?= $k->nm_app; ?></td>
				<td><?= $k->ttl_app; ?></td>
				<td><?= number_format($k->total, 0) ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>	
			<tr>	
				<th>TOTAL</th>
				<th><?= number_format($ttl_b, 0); ?></th>
				<th><?= number_format($ttl, 0); ?></th>
			</tr>
		</tfoot>
	</table>
	</div>
</div>
<hr>	

<style>
    @media print {

        .no_print,
        .no-print * {
            display: none !important;
        }
    }
</style>

<a href="<?= base_url('Match/excel_app_sum/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Summary Klik Here ...</i></a><br>
<a href="<?= base_url('Match/excel_app_det/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Detail Klik Here ...</i></a>


</body>
</html>