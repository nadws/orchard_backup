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
	<p><strong>Laporan item penjualan <?= $sort ?></strong></p>
</center>
<br>

<div class="container">
<div class="row justify-content-center">
    <div class="col-12">
    <p><strong>Summary Service</strong></p>

        <table class="table table-sm" width="100%">
            <thead class="thead-light" >
                <tr >
                    <th>Service</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $total_servis = 0;
                $qty_servis = 0;
                ?>
                <?php	foreach ($servis as $k): ?>
                    <?php
                    $total_servis += $k->total;
                    $qty_servis += $k->qty;
                    ?>
                    <tr>
                        <td><?= $k->nm_servis; ?></td>
                        <td><?= $k->qty; ?></td>
                        <td>Rp. <?= number_format($k->total); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <hr><hr>
    </div>

    <div class="col-12">
    <p><strong>Summary Penjualan Produk</strong></p>
    <table class="table table-sm">
        <thead class="thead-light">
            <tr>
                <th>Kategori</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            $ttl = 0;
            $qty_produk = 0;
            foreach ($penjualan as $k): 
                $ttl += $k->total;
                $qty_produk += $k->jumlah;
                ?>
                <tr>
                    <td><?= $k->nm_kategori; ?></td>
                    <td><?= $k->nm_produk; ?></td>
                    <td><?= $k->jumlah ?></td>
                    <td>Rp. <?= number_format($k->total, 0) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>
    <hr><hr>
    </div>            
</div>

<div class="row">
    <div class="col-6">
    <table class="table table-sm">
    <thead class="thead-light text-center">
        <tr>
        <th colspan="2">Total Pemasukan</th>
        </tr>        
    </thead>
        <tbody>
            <tr>
                <td><?= $qty_servis ?> Servis</td>
                <td>Rp. <?= number_format($total_servis,0) ?></td> 
            </tr>
            <tr>
                <td><?= $qty_produk ?> Produk</td>
                <td>Rp. <?= number_format($ttl,0)  ?></td>
            </tr>
        </tbody>
        <tfoot class="bg-secondary text-light">
            <tr>
                <td>Total Pendapatan: </td>
                <td>Rp. <?= number_format($total_servis + $ttl , 0) ?></td>
            </tr>
            
            <tr>
                <td> Voucher</td>
                <td>Rp. <?= number_format($invoice->nominal_voucher,0)  ?></td>
            </tr>

            <tr>
                <td>Diskon</td>
                <td>Rp. <?= number_format($invoice->diskon,0)  ?></td>
            </tr>
            
            
            
            <?php 
            $ttl_dp = 0;

            foreach($dp as $d){
                if($d->pakai == 'Terpakai'){
                    continue;
                }
                $ttl_dp += $d->jumlah_dp;
            }
            ?>
            
            <tr>
                <td> DP</td>
                <td>Rp. <?= number_format($ttl_dp,0)  ?></td>
            </tr>
             <tr>
                <td>Total Pendapatan - Diskon - Voucher + DP</td>
                <td>Rp. <?= number_format(($total_servis + $ttl + $ttl_dp) - $invoice->diskon - $invoice->nominal_voucher,0)  ?></td>
            </tr>  
        </tfoot>        
    </table>
    </div>            

</div>

</div>


	


	

</body>
</html>