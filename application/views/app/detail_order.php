<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Rincian Service & Pembayaran</h1>
				</div>
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
						<!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
						<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
				</div>
				<div class="col-5 mt-2">
					<?php if($tgl == date('Y-m-d')): ?>	
                    <a href="<?= base_url(); ?>match/kelola_app2?tgl=<?= $tgl ?>" class="btn btn-warning">Kembali</a>
					<?php else: ?>
						<a href="<?= base_url(); ?>match/kelola_app?tgl=<?= $tgl ?>" class="btn btn-warning">Kembali</a>
					<?php endif; ?>
                    <form class="d-inline" action="<?= base_url('match/cart_order'); ?>" method="POST">
                    <input type="hidden" name="tgl" value="<?= $tgl; ?>">
                    <input type="hidden" name="id_customer" value="<?= $id_customer; ?>">
                </form>
				</div>
			</div>
		</div>
		<div style="margin-top: 20px;"></div>
		<div class="row justify-content-center">
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<div class="col-sm-5">
				<div class="card">
				<div class="card-header">
				<h5 class="float-left"> <strong><?= ucwords($customer['nama']); ?></strong></h5>
						<h5 class="float-right"><?= date('d-M-Y', strtotime($tgl)) ?></h5>
						<hr class="float-left">
				</div>
					<div class="card-body">
						
						<div class="row">
							<!-- <?php $subtotal = 0;?> -->
							<?php foreach ($service as $key => $value): ?>
								<?php  
								// $subtotal += $value->biaya;
								// $jumlah += $value['qty'];
								?>
								<div class="col-md-6">
								<?php if($value->status == 'Selesai'): ?>
								<p class="float-left" ><?= $value->nm_servis ?> <i class="fas fa-thumbs-up text-success"></i></p>
								<?php else: ?>
									<p class="float-left"><?= $value->nm_servis ?> <i class="fas fa-times-circle text-danger"></i></p>
								<?php endif; ?>
								</div>
								<div class="col-md-6">
									<p class="float-right">Rp.<?= number_format($value->biaya) ?> </p>
								</div>
								<div class="col-md-12">
									<hr>
								</div>
							<?php endforeach ?>
							<div class="container">
								<strong style="font-size: 20px;">Total</strong> <strong style="float: right; font-size: 22px;">Rp. <?= number_format($total_servis) ?></strong>
							</div>

						</div>
					</div>
					<div class="card-footer">
					<?php if($cek_servis == 0 ) :?>
						<form class="d-inline" action="<?= base_url('match/cart_order'); ?>" method="POST">
                    <input type="hidden" name="tgl" value="<?= $tgl; ?>">
                    <input type="hidden" name="id_customer" value="<?= $id_customer; ?>">
                    <button class="btn btn-success float-right" type="submit">Lanjut</button>
                </form>
					<?php else: ?>
						<button class="btn btn-success float-right" type="button" disabled>Lanjut</button>
					<?php endif; ?>			
					</div>
				</div>

			</div>
			
		</div>
	</div>



	<style>
		.buying-selling.active {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		#option1
		{
			display: none;
		}

		.buying-selling {
			width: 100%; 
			padding: 10px;
			position: relative;
		}

		.buying-selling-word {
			font-size: 15px;
			font-weight: 600;
			margin-left: 35px;
		}

		.radio-dot:before, .radio-dot:after {
			content: "";
			display: block;
			position: absolute;
			background: #fff;
			border-radius: 100%;
		}

		.radio-dot:before {
			width: 20px;
			height: 20px;
			border: 1px solid #ccc;
			top: 10px;
			left: 16px;
		}

		.radio-dot:after {
			width: 12px;
			height: 12px;
			border-radius: 100%;
			top: 14px;
			left: 20px;
		}

		.buying-selling.active .buying-selling-word {
			color: #fff;
		}

		.buying-selling.active .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		.buying-selling.active .radio-dot:before {
			background: #fff;
			border-color: #699D17;
		}

		.buying-selling:hover .radio-dot:before {
			border-color: #adadad;
		}

		.buying-selling.active:hover .radio-dot:before {
			border-color: #699D17;
		}


		.buying-selling.active .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		.buying-selling:hover .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		.buying-selling.active:hover .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);

		}

		@media (max-width: 400px) {

			.mobile-br {
				display: none;   
			}

			.buying-selling {
				width: 49%;
				padding: 10px;
				position: relative;
			}

		}
	</style>
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

