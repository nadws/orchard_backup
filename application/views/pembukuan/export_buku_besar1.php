<!doctype html>
<?php
$file = "BUKU_BESAR_.xls";
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$file");
?>
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
    <title>Buku Besar</title>
  </head>
  <body>
  <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
          <!-- <?php $i = 1; ?> -->
          <table class="table" border="1">
                  <thead>
                    <tr>
								        <th class="sticky-top th" >No Akun</th>
                                    <th class="sticky-top th" >Nama Akun</th>
                                    <th class="sticky-top th" >Debit</th>
                                    <th class="sticky-top th" >Kredit</th>
                                    <th class="sticky-top th" >Saldo</th>
                                    
                                </tr>
                  </thead>
                  <tbody> 
                            <?php $total_debit = 0;
                                $total_kredit = 0;
                                $total_saldo = 0;
                            ?>                       
                            <?php foreach($buku as $b) : ?>
                            <tr>
                            <?php
                            $saldo_berjalan = $b->debit_lanjut - $b->kredit_lanjut;
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
                            
                            
                                $saldo = $b->debit + $b->debit_saldo + $debit_berjalan - $b->kredit - $b->kredit_saldo - $kredit_berjalan;
                                $debit = $b->debit + $b->debit_saldo + $debit_berjalan;
                                $kredit = $b->kredit + $b->kredit_saldo + $kredit_berjalan;
                                $total_debit += $debit;
                                $total_kredit += $kredit;
                                $total_saldo += $saldo;
                                
                            ?>
                                <!-- <td><?= $i++ ?></td> -->
									<!-- <td><?= date('d-m-y' , strtotime($b->tgl)) ?></td> -->
                                    <td><?= $b->no_akun ?></td>
                                    <td><?= $b->nm_akun ?></td>                                    
                                    <td><?= number_format($debit,2) ?></td>
                                    <td><?= number_format($kredit,2) ?></td>
                                    <td><?= number_format($saldo,2) ?></td>                                                            
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                  <tfoot>
                                <tr  >
                                    <th colspan="2">Total</th>
                                    <th><?= number_format($total_debit,2) ?></th>
                                    <th><?= number_format($total_kredit,2) ?></th>
                                    <th><?= number_format($total_saldo,2) ?></th>
                                </tr>
                            </tfoot>
                </table>
          </div>                    
        </div>
      </div>
    </div>

  </body>
</html>