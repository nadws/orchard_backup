<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <?php    
    $bulan = ['bulan','JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER']; 
    $bulan1 = (int)$month; 
    ?>
    <title>Laporan Peneyesuaian</title>
  </head>
  <body>
      <!-- <div class="container">
          <h5>KEMENTRIAN KEUANGAN INDONESIA</h5>
          <h5>KANTOR WILAYAH DJP</h5>
          <h5>KALIMANTAN SELATAN</h5>
          <h5>KANTOR PELAYANAN PAJAK PRAMATA BANJARMASIN</h5>
          <br>
          <h5 class="text-center">ORCHRAD BEAUTY STUDIO</h5>
          <h5 class="text-center">LAPORAN LABA RUGI</h5>
          <h5 class="text-center">ORCHRAD BEAUTY STUDIO</h5>
          <h5 class="text-center">PER <?= $date ?> <?= $bulan[$bulan1] ?> <?= $year ?></h5>
      </div>
      <br> -->
    <div class="container">
    <h3 class="text-center">Laporan Penyesuaian <?= $bulan[$bulan1] ?> <?= $year ?></h3>
    <table class="table mt-2" id="pengeluaran">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th >Tanggal</th>
                                    <th >No Nota</th>                                    
                                    <th >No Akun</th>                                    
                                    <th >Nama Akun</th>
                                    <th >Keterangan</th>                                    
                                    <th >Debit</th>
                                    <th >Kredit</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if(!empty($jurnal)){
                                $jurnal1 = $jurnal[0];
                            $tgl = $jurnal1->tgl;
                            $kd_gabungan1 = $jurnal1->kd_gabungan;
                            $no = 0;
                            $i = 1; 
                            }
                            
                            foreach($jurnal as $p) : ?>
                            
                              <?php if($kd_gabungan1 != $p->kd_gabungan){
                              $no += 1;
                              $kd_gabungan1 = $p->kd_gabungan;
                              $tgl = $p->tgl;
                            }  
                            if($no % 2 == 0 ): ?>
                              <tr style="background: #EEEEEE;">
                            
                            <?php endif; ?>
                                    <td><?= $i++ ?></td>
                                    <?php if($tgl != ''): ?>
                                    <td><?= date('d-m-y' , strtotime($tgl)) ?></td>
                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>
                                    <td><?= $p->no_nota ?></td>
                                    <td><?= $p->no_akun ?></td>                                    
                                    <td><?= $p->nm_akun ?></td>
                                    <td><?= $p->ket ?></td>                                    
                                    <td><?= number_format($p->debit,0) ?> </td>
                                    <td><?= number_format($p->kredit,0) ?></td>
                                    <!-- <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn_edit" kd_gabungan='<?= $p->kd_gabungan ?>' data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
										<a href="<?= base_url() ?>match/drop_jurnal/<?= $p->id_jurnal ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
									</td>                                     -->
                                </tr>
                                <?php  if($kd_gabungan1 == $p->kd_gabungan){
                                  $tgl = '';
                                } ?>
                            <?php endforeach; ?>    
                            </tbody>
                        </table>


    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>