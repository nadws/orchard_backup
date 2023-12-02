<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Komisi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
<?php 
$dt1 = new DateTime($tgl1);
$dt2 = new DateTime($tgl2);
$beda = $dt2->diff($dt1);

$target_komisi = (400000 * $dt_masuk->jml_masuk) / ($beda->days + 1); 
?>

<div class="container">
<div class="row">
    <div class="col-6">
        <h3>Laporan Komisi</h3>
    </div>
    <div class="col-6">
       <strong><p class="float-right">Periode : <?= date('d M Y', strtotime($tgl1)) ?> - <?= date('d M Y', strtotime($tgl2)) ?></p></strong>
        
    </div>
    <div class="col-12">
    <hr>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Komisi Service</th>
                <th>Komisi Penjualan</th>
                <th>Total Komisi</th>
                <th>Total Komisi Target</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total_app = 0;
        $total_penjualan = 0;
        $total = 0;
        $total_komisi_target = 0;
        ?>
        <?php foreach ($komisi as $key => $value): ?>
        <?php 
            $names = ['T1', 'T2', 'T3','T4','T5','T6','T7','T8','T9','T10','ORCHARD'];
            if(in_array($value->nm_kry,$names)){
                continue;
            } 
        ?>
        
        <?php 
            $total_app += $value->total_app;
            $total_penjualan += $value->total_produk;
            $total += $value->total_app;
            $total += $value->total_produk;
             if(($value->total_produk + $value->total_app) >= $target_komisi){
                if(($dt_sum_app->total + $dt_sum_pembelian->total - $invoice->diskon) >= 100000000){
                $komisi_awal = (($value->total_produk + $value->total_app) * 100)/5;
                $komisi_target = ($komisi_awal * 10)/100;
                }else {
                $komisi_awal = (($value->total_produk + $value->total_app) * 100)/5;
                $komisi_target = ($komisi_awal * 8)/100;
                }
                
            }else{
                $komisi_target = ($value->total_produk + $value->total_app);
            }
            $total_komisi_target += $komisi_target;
        ?>
			<tr>
				<td><?= $key+1 ?></td>
                <td><?= $value->nm_kry ?></td>
                <td>Rp. <?= number_format($value->total_app) ?></td>
                <td>Rp. <?= number_format($value->total_produk) ?></td>
				<td>Rp. <?= number_format($value->total_produk + $value->total_app) ?></td>
				<td>Rp. <?= number_format($komisi_target,0) ?></td>
			</tr>
		<?php endforeach ?>
        </tbody>
        <tfoot class="bg-secondary text-light">
            <tr>
                <td colspan=2>Total</td>
                <td>RP. <?= number_format($total_app,0) ?></td>
                <td>RP. <?= number_format($total_penjualan,0) ?></td>
                <td>RP. <?= number_format($total,0) ?></td>
                <td>RP. <?= number_format($total_komisi_target,0) ?></td>
            </tr>
        </tfoot>
    </table>
    
    </div>
</div>
</div>
    

</body>
</html>