
<table class="table" border="1">
	<thead>
			<th colspan="7"><?= $sort ?></th>	
	</thead>
	<thead>
		<tr>
			<th>TERAPIS</th>
			<th>CUSTOMER - SERVIS</th>
			<th>TANGGAL</th>
			<th>JAM MULAI</th>
			<th>JAM SELESAI</th>
			<th>STATUS</th>
			<th>TOTAL RP</th>
		</tr>
	</thead>
	
	<tbody style="text-align: center;">
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
<hr>	

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

