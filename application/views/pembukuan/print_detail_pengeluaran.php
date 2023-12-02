<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <script>
        window.print();
        </script>
    <title>Detail Pengeluaran</title>
  </head>
  <body>
  <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
          <!-- <?php $i = 1; ?> -->
          <table class="table mt-2" >
          <thead>
                <tr>
                    <th width="25%">Nama Akun : </th>
                    <th colspan="2"><?= $akun->nm_akun ?></th>
                    <th width="25%">No Akun : </th>
                    <th width="20%"><?= $akun->no_akun ?></th>
                </tr>
            </thead>
                    <thead class="bg-secondary text-light">
                                <tr>
								    <th>Tanggal</th>
                                    <th >Keterangan</th>
                                    <th >Debit</th>
                                    <th >Kredit</th>
                                    <th>Saldo</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                            <?php $total_debit = 0;
                                $total_kredit = 0;
                                $total_saldo = 0;
                                $saldo1=0;
                            ?>
                             

                            <?php foreach($buku as $b) : ?>
                            <tr>
                            <?php
                                
                                $saldo = $b->debit - $b->kredit;
                                $saldo1 += $saldo;
                                $total_debit += $b->debit;
                                $total_kredit += $b->kredit;
                                // $total_saldo += $saldo;
                            ?>
									<td><?= date('d/m/Y' , strtotime($b->tgl)) ?></td>
                                    <td><?= $b->ket ?></td>                               
                                    <td><?= number_format($b->debit,0) ?></td>
                                    <td><?= number_format($b->kredit,0) ?></td>
                                    <!--<td><?= number_format($b->debit - $b->kredit,0) ?></td>-->
                                    <td><?= number_format($saldo1,0) ?></td>
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                            <tfoot class="bg-secondary text-light">
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td><?= number_format($total_debit,0) ?></td>
                                    <td><?= number_format($total_kredit,0) ?></td>
                                    <td><?= number_format($saldo1,0) ?></td>
                                </tr>
                            </tfoot>
            </table>
          </div>                    
        </div>
      </div>
    </div>

  </body>
</html>