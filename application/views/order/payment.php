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
					<h1 class="m-0 text-dark">Rincian Order & Pembayaran</h1>
				</div>
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
						<!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
						<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
				</div>
			</div>
		</div>
		<div style="margin-top: 40px;"></div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<?php 
			$cart =	$this->cart->contents(); 
			$total = 0;
			?>
			<div class="col-sm-8">
				<div class="card">
					<div class="card-body">
						<h3 class="text-center">Rincian Order</h3>
						<hr>
						<div class="row">
							<?php  
							$subtotal = 0;
							$jumlah = 0;
							?>
							<?php foreach ($cart as $key => $value): ?>
								<?php  
								$subtotal += $value['price']*$value['qty'];
								$jumlah += $value['qty'];
								?>
								<div class="col-md-10">
									<span class="badge badge-secondary"><?= $value['nm_karyawan'] ?></span> | <span class="badge badge-info"><?= $value['satuan'] ?></span><br><br>
									<img width="80" class="img-thumbnail" src="<?= base_url() ?>upload/produk/<?= $value['picture'] ?>" alt="">
									<span style="margin-left: 20px;"><?= $value['name'] ?></span>
									
								</div>

								<div class="col-md-2">
									<p style="margin-top: 55px;"><?= $value['qty'] ?> x <strong>Rp.<?= number_format($value['price']) ?></strong> </p>
								</div>
								<div class="col-md-12">
									<hr>
								</div>
							<?php endforeach ?>
							<div class="container">
								<strong>Subtotal <?= $jumlah ?> produk</strong> <strong style="float: right;">Rp. <?= number_format($subtotal) ?></strong>
								<hr>
								<strong style="font-size: 20px;">Total</strong> <strong style="float: right; font-size: 22px;">Rp. <?= number_format($subtotal) ?></strong>
							</div>

						</div>
					</div>
				</div>

			</div>
			
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form action="<?= base_url() ?>match/checkout" method="post">
							<h3 class="text-center">Pembayaran</h3>
							<hr>
							<h6>Metode Pembayaran</h6>
							<div class="buying-selling-group" id="buying-selling-group" data-toggle="buttons">
								<label class="btn btn-default buying-selling">
									<input type="radio" name="metode" value="CASH" id="option1" autocomplete="off">
									<span class="radio-dot"></span>
									<span class="buying-selling-word">CASH</span>
								</label>
								<label class="btn btn-default buying-selling">
									<input type="radio" name="metode" value="MANDIRI" id="option1" autocomplete="off">
									<span class="radio-dot"></span>
									<span class="buying-selling-word">MANDIRI</span>
								</label>
								<label class="btn btn-default buying-selling">
									<input type="radio" name="metode" value="BCA" id="option1" autocomplete="off">
									<span class="radio-dot"></span>
									<span class="buying-selling-word">BCA</span>
								</label>
							</div>
							<hr>
							<button class="btn btn-primary btn-block" style="background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%); border-color: #F7889D; font-weight: bold; color: #fff;">PROSES BAYAR <i class="fa fa-chevron-right" style="float: right;"></i></button>
						</form>
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

