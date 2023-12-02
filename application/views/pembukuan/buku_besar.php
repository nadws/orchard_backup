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
			<div class="col-10">
      <?= $this->session->flashdata('message'); ?>

      <?php 
      $bulan = ['bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
      $bulan1 = (int)$month;      
      ?>
				<div class="card">
                    <div class="card-header">
                       <h3 class="float-left">Rekapitulasi Jurnal <?= $bulan[$bulan1] ?> <?= date('Y') ?></h3>
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> Lihat Data</button>
                       <a href="<?= base_url('Match/export_buku_besar1') ?>?month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right ml-2" ><i class="fas fa-file-excel"></i> Export</a>
                       <a target="_blank" href="<?= base_url('Match/print_buku_besar1') ?>?month=<?= $month ?>&year=<?= $year ?>" type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" ><i class="fa fa-print"></i> Print</a>
                    </div>
                        <?php $i=1; ?>
                        
                    <div class="card-body">
                       <table class="table mt-2" >
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
                                $laba_ditahan = 0;  
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
                          
                          $laba_ditahan += $saldo_berjalan * -1;
                            
                            
                                $saldo = $b->debit + $b->debit_saldo + $debit_berjalan - $b->kredit - $b->kredit_saldo - $kredit_berjalan;
                                $debit = $b->debit + $b->debit_saldo + $debit_berjalan;
                                $kredit = $b->kredit + $b->kredit_saldo + $kredit_berjalan;
                                $total_debit += $debit;
                                $total_kredit += $kredit;
                                $total_saldo += $saldo;
                                if($debit == 0 and $kredit == 0){
                                  continue;
                                }
                            ?>
                                <!-- <td><?= $i++ ?></td> -->
									<!-- <td><?= date('d-m-y' , strtotime($b->tgl)) ?></td> -->
                                    <td><?= $b->no_akun ?></td>
                                    <td><a href="<?= base_url('Match/detail_buku_besar') ?>?id=<?= $b->id_akun ?>&month=<?= $month; ?>&year=<?= $year ?>"><?= $b->nm_akun ?></a></td>                                    
                                    <td><?= number_format($debit,2) ?></td>
                                    <td><?= number_format($kredit,2) ?></td>
                                    <td><?= number_format($saldo,2) ?></td>                                                            
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                              <td>3100,3</td>
                              <td>Laba Ditahan</td>
                              <?php if($laba_ditahan > 0){
                                $debit_laba_ditahan = $laba_ditahan;
                                $kredit_laba_ditahan = 0;
                              }elseif($laba_ditahan < 0){
                                $debit_laba_ditahan = 0;
                                $kredit_laba_ditahan = $laba_ditahan * -1;
                              }else{
                                $debit_laba_ditahan = 0;
                                $kredit_laba_ditahan = 0;
                              } 
                              ?>                                    
                              <td><?= number_format($debit_laba_ditahan,0) ?></td>
                              <td><?= number_format($kredit_laba_ditahan,0) ?></td>
                              <td><?= number_format($laba_ditahan,0) ?></td> 
                            </tr>
                            </tbody>
                            <tfoot>
                                <tr  style="background:#fadadd;">
                                    <td colspan="2">Total</td>
                                    <td><?= number_format($total_debit + $debit_laba_ditahan,2) ?></td>
                                    <td><?= number_format($total_kredit + $kredit_laba_ditahan,2) ?></td>
                                    <td><?= number_format($total_saldo + $laba_ditahan,2) ?></td>
                                </tr>
                            </tfoot>
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


      <div id="modal_aside_left" class="modal fixed-right fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
        <form action="<?= base_url() ?>match/penerimaan_bank" method="post">
          <div class="modal-content">
            <div class="modal-header" style="background: #FFA07A;">
              <h5 class="modal-title">Penerimaan Bank</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            <div class="form-group row">
                    <label for="jumlah" class="col-sm-4 col-form-label">Tanggal</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" id="tgl" name="tgl" required>
                    </div>
            </div>  

            <div class="form-group row">
                    <label for="bca" class="col-sm-4 col-form-label">BANK</label>
                    <div class="col-sm-8">
                    <select name="bank" id="bank" class="form-control" required="">
                    <option value="6">BCA</option>
                    <option value="7">Mandiri</option>                    
                    </select>
                    </div>
            </div>

            <div class="form-group row">
                    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
            </div>

            <div class="form-group row">
                    <label for="admin" class="col-sm-4 col-form-label">Biaya Admin</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="admin" name="admin" required>
                    </div>
            </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Input</button>
            </div>
          </div>
          </form>
        </div> <!-- modal-bialog .// -->
      </div> <!-- modal.// -->


    <!-- Modal -->
<!-- <form action="<?= base_url() ?>match/add_dp" method="post">
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Input DP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                                        
            

            <div class="form-group pilih-metode">
                <label for="">Customer</label>
                <select class="form-control" id="" required="">
                <label for=""></label>
                <option value="">- Pilih Metode -</option>
                <option value="manual">Input Manual</option>
                <option value="customer">Dari Data Customer</option>
                </select>
            </div>
            <div class="form-group data-customer">
                                        
                <select name="id_customer" id="d_customer" class="form-control data-customer id_customer" disabled>
                    <option value="">- Pilih Customer -</option>
                    <?php foreach ($customer as $key => $value): ?>
                    <option value="<?= $value->id_customer ?>"><?= $value->nama ?></option>
                    <?php endforeach ?>
                </select>
                </div>
                <div class="form-group">
                <input type="text" name="customer" class="form-control manual customer" placeholder="Isi Nama Customer" disabled>
                </div>

            <div class="form-group ">
                    <label>Jumlah DP</label>
                    <div>
                    <input type="number" name="dp" class="form-control" id="mandiri_kredit">
                    </div>
            </div>
                                        
            <div class="form-group">
            <label for="">Metode</label>
                <select name="metode" id="metode" class="form-control" required>
                    <option value="Cash">- Cash -</option>
                    <option value="BCA">- BCA -</option>
                    <option value="Mandiri">- Mandiri -</option>
                </select>
            </div>

            <div class="form-group">
            <label for="">Untuk Tanggal</label>
            <input type="date" name="tgl_dp" class="form-control" id="tgl_dp" required>
            </div>
                    
            

							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Input</button>
      </div>
    </div>
  </div>
</div>
</form> -->




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

