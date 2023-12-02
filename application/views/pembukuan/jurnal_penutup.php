<?php $this->load->view('tema/Header', $title); ?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<style type="text/css">

.modal .modal-dialog-aside{
	width: 350px;
	max-width:80%; height: 500px; margin:0;
	transform: translate(0); transition: transform .2s;
}


.modal .modal-dialog-aside .modal-content{  height: inherit; border:0; border-radius: 0;}
.modal .modal-dialog-aside .modal-content .modal-body{ overflow-y: auto }
.modal.fixed-left .modal-dialog-aside{ margin-left:auto;  transform: translateX(100%); }
.modal.fixed-right .modal-dialog-aside{ margin-right:auto; transform: translateX(-100%); }

.modal.show .modal-dialog-aside{ transform: translateX(0);  }

.th {
        /* position: sticky; */
        top: 53px;
    }     

</style>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<!-- <div class="col-sm-12">
					<h1 class="m-0 text-dark">Jurnal</h1>
				</div> -->
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
						<!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
						<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
				</div>
				<!-- <div class="col-5 mt-2">
					<a href="<?= base_url('match/order'); ?>" class="btn btn-warning">Kembali</a>
				</div> -->
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-12">
				
			</div>
			<div class="col-10">
      <?= $this->session->flashdata('message'); ?>
      <?php 
      $bulan = ['bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
      $bulan1 = (int)$month;

      if(!empty($penjualan)){
        $status1 = $penjualan[0];
        $status = $status1->status;
        
      }else{
        $status = 'kosong';
      }
      

      
      ?>
            <!-- <form method="POST" action="<?= base_url('Match/tutup_buku') ?>">     -->
				<div class="card">
                    <div class="card-header">
                       <h3 class="float-left">Jurnal Penutup <?= $bulan[$bulan1] ?> <?= $year ?></h3>
                       <!-- <?php if($status == 'Y'): ?>
                       <button type="submit" class="btn btn-sm btn-outline-secondary float-right ml-2" onclick="return confirm('Apakah anda yakin ingin menutup buku ?')"><i class="fas fa-save"></i> Save</button>
                       <?php elseif($status == 'kosong'): ?>
                       <?php else: ?>
                       <br><br>
                        <h5 class="float-left text-warning"> (Buku sudah ditutup!)</h5>
                      <?php endif; ?>   -->
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> View Periode</button>
                       <!-- <button type="button" class="btn btn-sm btn-outline-secondary float-right" data-toggle="modal" data-target="#view-data"><i class="fa fa-eye"></i> View</button> -->
                    </div>
                        
                    <div class="card-body">
                    <?php 
                    $total_biaya = 0;
                    $debit = 0;
                    $kredit = 0;
                    foreach($penutup as $pp){
                        $total_biaya += $pp->debit-$pp->kredit;

                    } ?>

                    <?php $total_laba = 0;
                      foreach($laba as $l){
                        $laba = $l->kredit_laba + $l->kredit_neraca_saldo - $l->debit_laba - $l->debit_neraca_saldo;
                        $total_laba += $laba;
                        $debit += $laba;
                        $kredit += $laba;
                      }
                    ?>
                    <input type="hidden" name="month" value="<?= $month ?>">
                    <input type="hidden" name="ikhtisar_debit" value="<?= $total_biaya ?>">   
                    <input type="hidden" name="total_laba" value="<?= $total_laba ?>">
                    <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th class="sticky-top th" >Nama Akun</th>
                                    <th class="sticky-top th" >No Akun</th>                                      
                                    <th class="sticky-top th" >Debit</th>
                                    <th class="sticky-top th" >Kredit</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php $total_penjualan = 0; ?>
                            <?php foreach($penjualan as $p) : 
                                 $total_penjualan += $p->kredit - $p->debit;                                 
                                 $debit += $p->kredit - $p->debit;
                                 $kredit += $p->kredit - $p->debit;
                                 ?>
                            <tr style="background: #EEEEEE;">
                                <td><?= $p->nm_akun ?></td>
                                <td><?= $p->no_akun ?></td>
                                <td><?= number_format($p->kredit - $p->debit,0) ?></td>
                                <td>0</td>
                            </tr>                            
                             <?php endforeach; ?>    
                             <tr style="background: #EEEEEE;">
                                <td> &nbsp; &nbsp; &nbsp; Iktisar laba/rugi</td>
                                <td>1300,3</td>
                                <td>0</td>
                                <td><?= number_format($total_penjualan,0) ?></td>
                                <input type="hidden" name="ikhtisar_kredit" value="<?= $total_penjualan ?>">

                                <input type="hidden" name="penjualan" value="<?= $total_penjualan ?>">
                                
                             </tr>
                             <tr >
                                <td>Iktisar laba/rugi</td>
                                <td>1300,3</td>
                                
                                <td><?= number_format($total_biaya,0) ?></td>
                                <td>0</td>
                                
                             </tr>
                             <?php foreach($penutup as $pp): 
                                $debit += $pp->debit - $pp->kredit;
                                $kredit += $pp->debit - $pp->kredit;

                                $nilai_b = $pp->debit - $pp->kredit;

                                if($nilai_b > 0){
                                  $kredit_b = $nilai_b;
                                  $debit_b = 0;
                                }else{
                                  $kredit_b = 0;
                                  $debit_b = $nilai_b * -1;
                                }
                              ?>
                             <tr>
                             <td> &nbsp; &nbsp; &nbsp; <?= $pp->nm_akun ?></td>
                                <td><?= $pp->no_akun ?></td>
                                <td><?= number_format($debit_b,0) ?></td>
                                <td><?= number_format($kredit_b,0) ?></td>
                             </tr>
                             <input type="hidden" name="id_biaya[]" value="<?= $pp->id_akun ?>">
                             <input type="hidden" name="biaya[]" value="<?= $pp->debit ?>">
                             <?php endforeach; ?>
                             <tr style="background: #EEEEEE;">
                             <td>Iktisar laba/rugi</td>
                                <td>1300,3</td>
                                
                                <td><?= number_format($total_laba,0) ?></td>
                                <td>0</td> 
                             </tr>
                             <tr style="background: #EEEEEE;">
                             <td> &nbsp; &nbsp; &nbsp; Laba tahun berjalan</td>
                                <td>3100,2</td>
                                <td>0</td>
                                <td><?= number_format($total_laba,0) ?></td>
                             </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="2">Total</td>
                                <td><?= number_format($debit,0) ?></td>
                                <td><?= number_format($kredit,0) ?></td>
                              </tr>
                            </tfoot>  
                            
                        </table>
                         
					</div>        
                                    

                    </div>
					
				</div>
                <!-- </form>				 -->
			</div>
			
			
		</div>
	</div>

    <style>
        .modal-lg {
          max-width: 900px;
          margin: 2rem auto;
        }
  </style>

    <!-- Modal View -->
<form action="" method="GET">
<div class="modal fade" id="view-periode" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">

        <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Akun</label>
                      <select name="month" class="form-control" required="">                              
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>                 
                      </select>
                  </div>
              </div>

              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Tahun</label>
                      <select name="year" class="form-control select" required="">
                          <?php foreach($tahun as $t): ?>                                
                            <?php  $tanggal = $t->tgl;
                            $explodetgl=explode('-', $tanggal); ?>
                          <option value="<?=$explodetgl[0];?>"><?=$explodetgl[0];?></option>
                          <?php endforeach; ?>
                        </select>  
                  </div>
              </div>

      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Lihat</button>
      </div>
    </div>
  </div>
</div>
</form>






<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
<script src="<?= base_url() ?>asset/time/jquery.skedTape.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('asset/'); ?>plugins/simple.money.format.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>

$(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });


$(document).ready(function(){


      //////////////////////Non Monitoring/////////////////////////////

    $("body").on( "keyup", ".total_penyesuaian", function(){
        //   $('.rp_pajak').keyup(function(){
            var debit = 0;
        
            $(".total_penyesuaian:not([disabled=disabled]").each(function(){
            debit += parseInt($(this).val());
          });
          $('.total').val(debit);
          });


    });


</script>


	<script>
		function autofill_anak(){
			var nm_kry = document.getElementById('nm_kry').value;
			$.ajax({
				url:"<?php echo base_url();?>Match/cari_anak",
				data:'&nm_kry='+nm_kry,
				success:function(data){
					var hasil = JSON.parse(data);  

					$.each(hasil, function(key,val){ 
						document.getElementById('id_kry').value=val.id_kry;
						document.getElementById('nm_kry').value=val.nm_kry;  
					});
				}
			});                   
		}

	</script>

	<?php $this->load->view('tema/Footer'); ?>

