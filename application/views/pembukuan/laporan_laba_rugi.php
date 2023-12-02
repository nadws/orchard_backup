<?php $this->load->view('tema/Header', $title); ?>

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

.th{            
            top: 54px;            
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
			<div class="col-8">
      <?= $this->session->flashdata('message'); ?>

      <?php 
      $bulan = ['bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
      $bulan1 = (int)$month;      
      ?>
				<div class="card">
                    <div class="card-header">
                       <h4 class="float-left">Laporan Laba / Rugi <?= $bulan[$bulan1] ?> <?= $year ?></h4>
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> Lihat Data</button>
                       <a href="<?= base_url('Match/print_laba_rugi') ?>?month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fas fa-print"></i> Print</a> 
                       <a href="<?= base_url('Match/excel_laba_rugi') ?>?month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fas fa-file-export"></i> Export</a> 
                      </div>
                        <?php $i=1; ?>
                        
                    <div class="card-body">
                    <table class="table table-sm table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="6"><strong>URAIAN</strong></td>
                                </tr>
                                <tr style="border-top: 2px solid black;">
                                    <td colspan="6"><strong>PEREDARAN USAHA</strong></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <?php 
                                $total_pendapatan = 0;
                                $total_pendapatan_bunga = 0;
                                foreach($laba as $l): ?>
                                <?php if($l->kredit_laba == 0){
                                  continue;
                                }
                                
                                if($l->id_akun == 4):?>
                                <?php
                                $total_pendapatan += $l->kredit_laba - $l->debit_laba ?>
                                <tr>
                                    <td width="10%"></td>
                                    <td colspan="2"><?= $l->nm_akun ?></td>
                                    <td width="5%">RP</td>
                                    <td colspan="2" style="text-align: right;"><?= number_format($l->kredit_laba - $l->debit_laba,0) ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($l->id_akun == 56){
                                  $total_pendapatan_bunga += $l->kredit_laba - $l->debit_laba;
                                } ?>
                                <?php endforeach ;?>
                                <tr style="border-bottom: 2px solid black;">
                                    <td width="10%"></td>
                                    <td colspan="2"><strong>TOTAL PENDAPATAN</strong></td>
                                    <td>Rp</td>
                                    <td style="text-align: right;"><strong><?= number_format($total_pendapatan,0) ?></strong></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="5"><strong>BIAYA-BIAYA</strong></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <?php 
                                $total_biaya = 0;
                                $pph = 0;
                                foreach($laba as $l): ?>
                                <?php $cek = ['4','5','56']; 
                                if(in_array($l->id_akun,$cek) || $l->debit_laba == 0){
                                    continue;
                                }elseif($l->id_akun == 50){
                                  $pph += $l->debit_laba - $l->kredit_laba;
                                  continue;
                                }
                                  ?>
                                <?php
                                $total_biaya += $l->debit_laba -  $l->kredit_laba?>
                                <tr>
                                    <td width="10%"></td>
                                    <td colspan="2"><?= $l->nm_akun ?></td>
                                    <td width="5%">Rp</td>
                                    <td style="text-align: right;"><?= number_format($l->debit_laba - $l->kredit_laba,0) ?></td>
                                </tr>
                                <?php endforeach ;?>
                                <tr style="border-bottom: 2px solid black;">
                                    <td width="10%"></td>
                                    <td colspan="2"><strong>TOTAL BIAYA-BIAYA</strong></td>
                                    <td>Rp</td>
                                    <td style="text-align: right;"><strong><?= number_format($total_biaya,0) ?></strong></td>
                                </tr>
                            </tbody>
                           <tbody>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH SEBELUM PAJAK</strong></td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya,0) ?></strong></td>
                                </tr>
                                <tr>
                                  <td colspan="3">PPH TERHUTANG (-)</td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><?= number_format($pph,0) ?></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH SETELAH PAJAK</strong></td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya -$pph,0) ?></strong></td>
                                </tr>
                                <tr>
                                  <td colspan="3">PENDAPATAN BANK (+)</td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><?= number_format($total_pendapatan_bunga,0) ?></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><strong>LABA BERSIH</strong></td>
                                  <td>Rp</td>
                                  <td style="text-align: right;"><strong><?= number_format($total_pendapatan - $total_biaya - $pph + $total_pendapatan_bunga,0) ?></strong></td>
                                </tr>
                           </tbody>
                           
                        </table>
					</div>        
                                    

                    </div>
					
				</div>					
			</div>
			
			
		</div>
	</div>

   
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

<script>

$(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });

	$(document).ready(function(){
		  
  });


</script>




	<?php $this->load->view('tema/Footer'); ?>

