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
				<div class="card">
                    <div class="card-header">
                       <h3 class="float-left">Detail Pemasukan</h3>
                       
                       <a href="<?= base_url('Match/rekapitulasi_pemasukan') ?>?month=<?= $month; ?>&year=<?= $year ?>" class="btn btn-sm  btn-outline-secondary float-right ml-2"><i class="fas fa-arrow-left"></i></i> Kembali</a> 
                       
                    </div>
                        
                    <div class="card-body">
                    <table class="table mt-2" >
            <thead>
                <tr>
                    <th style="background: #FFFFFF;" width="25%">Nama Akun : </th>
                    <th style="background: #FFFFFF;" colspan="2"><?= $akun->nm_akun ?></th>
                    <th style="background: #FFFFFF;" width="25%">No Akun : </th>
                    <th style="background: #FFFFFF;" width="20%"><?= $akun->no_akun ?></th>
                </tr>
            </thead>
                        <thead >
                                <tr>
								    <th class="sticky-top th" style="color : #787878;">Tanggal</th>
                                    <th class="sticky-top th" style="color : #787878;">Keterangan</th>
                                    <th class="sticky-top th" style="color : #787878;">Debit</th>
                                    <th class="sticky-top th" style="color : #787878;">Kredit</th>
                                    <th class="sticky-top th" style="color : #787878;">Saldo</th>
                                    
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
                                    <td><?= number_format($b->debit,2) ?></td>
                                    <td><?= number_format($b->kredit,2) ?></td>
                                    <!--<td><?= number_format($b->debit - $b->kredit,2) ?></td>-->
                                    <td><?= number_format($saldo1,2) ?></td>
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                            <tfoot>
                                <tr  style="background:#fadadd;">
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
			
			
		</div>
	</div>

   

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

