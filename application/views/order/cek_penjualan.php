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
					<h1 class="m-0 text-dark">Rincian Penjualan</h1>
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
		<div class="row">
			<div class="col-md-12">
                <?= $this->session->flashdata('message'); ?>
                <a href="<?= base_url('match/daftar_komisi'); ?>" class="btn btn-warning mb-2">Kembali</a>
			</div>
			<div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Rincian Penjualan</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Tanggal : <?= date('D-m-Y', strtotime($penjualan->tanggal)) ?></strong></p>
                                <hr>
                            </div>
                                
                                    <div class="col-md-8">
                                    <p><strong>Nama Barang : </strong><?= $penjualan->nm_produk; ?></p>
                                    <p><strong>Qty : </strong><?= $penjualan->jumlah; ?> x <?= $penjualan->harga; ?></p>
                                    </div>
                                
                                
                                    <div class="col-md-4">
                                        <!-- <p><strong><?= $penjualan->metode; ?></strong></p> -->
                                        <p><strong>Rp. <?= number_format($penjualan->total) ?></strong></p>
                                    </div>
                                
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Penjual</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($karyawan as $key => $t): ?>
                            <div class="col-md-12">
                                <p><strong><?= $key+1; ?> <?= $t->nm_kry; ?></strong></p>
                            </div>
                            <?php endforeach; ?>                     
                            
                        </div>
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

