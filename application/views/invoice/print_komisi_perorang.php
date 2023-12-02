<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $karyawan->nm_kry ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-6">
        <h3>Laporan Komisi <?= $karyawan->nm_kry ?></h3>
    </div>
    <div class="col-6">
       <strong><p class="float-right">Periode : <?= date('d M Y', strtotime($tgl1)) ?> - <?= date('d M Y', strtotime($tgl2)) ?></p></strong>
        
    </div>
    <div class="col-12">
    <hr>
    <p>Detail Penjualan Produk</p>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Therapist</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Komisi</th>
            </tr>
        </thead>
        <tbody>
        <?php $total_produk = 0; ?>
        <?php foreach ($komisi_pembelian as $kp): ?>
        <?php $total_produk += $kp->komisi  ?>
			<tr>
				<td><?= date('d M Y', strtotime($kp->tgl)) ?></td>
                <td><?= $kp->nm_produk ?></td>
                <td><?= $kp->nm_karyawan ?></td>
                <td><?= $kp->jumlah ?></td>                
                <td><?= number_format($kp->harga,0) ?></td>
                <td><?= number_format($kp->total,0) ?></td>
                <td><?= number_format($kp->komisi,0) ?></td>
			</tr>
		<?php endforeach ?>
        </tbody>
        <tfoot class="bg-secondary text-light">
            <tr>
                <td colspan="6">Total</td>
                <td><?= number_format($total_produk,0) ?></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <br>
    <table class="table" width="100%">
        <thead class="thead-light">
            <tr>
                <th>Tanggal</th>
                <th>Service</th>
                <th>Therapist</th>
                <th>Qty</th>                
                <th>Harga</th>
                <th>Total</th>
                <th>Komisi</th>
            </tr>
        </thead>
        <tbody>
        <?php $total_servis = 0; ?>
        <?php foreach ($komisi_app as $ka): ?>
        <?php $total_servis += $ka->komisi ?>
			<tr>
				<td><?= date('d M Y', strtotime($ka->tgl)) ?></td>
                <td><?= $ka->nm_servis ?></td>
                <td><?= $ka->nm_karyawan ?></td>
                <td><?= $ka->qty ?></td>                
                <td><?= number_format( $ka->biaya,0) ?></td>
                <td><?= number_format( $ka->total,0) ?></td>
                <td><?= number_format($ka->komisi,0) ?></td>
			</tr>
		<?php endforeach ?>
        </tbody>
        <tfoot class="bg-secondary text-light">
            <tr>
                <td colspan="6">Total</td>
                <td><?= number_format($total_servis,0) ?></td>
            </tr>
        </tfoot>
    </table>
    </div>
</div>
</div>
    

</body>
</html>