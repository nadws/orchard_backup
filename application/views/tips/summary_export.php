<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Summary_absen.xls");
?>
<table class="table" border="1">
	<thead>
			<th colspan="3"><?= $sort ?></th>	
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
				<td><?= number_format($k->total, 0) ?></td>
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

<style>
    @media print {

        .no_print,
        .no-print * {
            display: none !important;
        }
    }
</style>
<hr>	
<a href="<?= base_url('Match/excel_tips_sum/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Summary Klik Here ...</i></a><br>
<a href="<?= base_url('Match/excel_tips_det/').$tgl1.'/'.$tgl2; ?>" class="no_print" target="_blank"><i>Excel_Detail Klik Here ...</i></a>
