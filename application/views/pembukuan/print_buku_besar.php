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
    <title>Kas Besar</title>
  </head>
  <body>
  <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
          <!-- <?php $i = 1; ?> -->
          <table class="table">
            <thead>
                <tr>
                    <th width="25%">Nama Akun : </th>
                    <th colspan="2"><?= $akun->nm_akun ?></th>
                    <th width="25%">No Akun : </th>
                    <th width="20%"><?= $akun->no_akun ?></th>
                </tr>
            </thead>
          </table>
          <table class="table" >
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
                            <?php foreach($neraca_saldo as $ns) : ?>
                            <?php $saldo_neraca = $ns->debit_saldo - $ns->kredit_saldo;
                                $saldo1 += $saldo_neraca;
                                $total_debit += $ns->debit_saldo;
                                $total_kredit += $ns->kredit_saldo;
                            ?>
                            <tr>
                            <td><?= date('d/m/Y' , strtotime($ns->tgl)) ?></td>
                                    <td>Neraca saldo</td>                               
                                    <td><?= number_format($ns->debit_saldo,2) ?></td>
                                    <td><?= number_format($ns->kredit_saldo,2) ?></td>
                                    <!--<td><?= number_format($ns->debit - $b->kredit,2) ?></td>-->
                                    <td><?= number_format($saldo1,2) ?></td>
                            </tr>
                            <?php endforeach; ?>

                            <?php foreach($lanjut as $l) : ?>
                            <?php $saldo_berjalan = $l->debit - $l->kredit;
                                $saldo1 += $saldo_berjalan;

                                if($saldo_berjalan > 0){
                                    $debit_berjalan = $saldo_berjalan;
                                    $kredit_berjalan = 0;
                                }elseif($saldo_berjalan < 0){
                                    $debit_berjalan = 0;
                                    $kredit_berjalan = $saldo_berjalan * -1;
                                }else{
                                    $debit_berjalan = 0;
                                    $kredit_berjalan = 0;
                                }

                                $total_debit += $debit_berjalan;
                                $total_kredit += $kredit_berjalan;
                            ?>
                            <tr>
                            <td></td>
                                    <td>Saldo Berjalan</td>
                                    <td><?= number_format($debit_berjalan,2) ?></td>
                                    <td><?= number_format($kredit_berjalan,2) ?></td>    
                                    <td><?= number_format($saldo1,2) ?></td>
                            </tr>
                            <?php endforeach; ?> 

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
                                    <td><?= number_format($b->debit,2) ?></td>
                                    <td><?= number_format($b->kredit,2) ?></td>
                                    <!--<td><?= number_format($b->debit - $b->kredit,2) ?></td>-->
                                    <td><?= number_format($saldo1,2) ?></td>
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                            <tfoot class="bg-secondary text-light">
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td><?= number_format($total_debit,2) ?></td>
                                    <td><?= number_format($total_kredit,2) ?></td>
                                    <td><?= number_format($saldo1,2) ?></td>
                                </tr>
                            </tfoot>
            </table>
          </div>                    
        </div>
      </div>
    </div>

  </body>
</html>