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
					<h1 class="m-0 text-dark">Penjualan Produk</h1>
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
		<!-- <div class="row">
			<div class="col-12 text-sm">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="shampo-tab" data-toggle="pill" href="#semua" role="tab" aria-controls="shampo" aria-selected="true">Semua</a>
				</li>
				<?php foreach($kategori as $kt): ?>
				<li class="nav-item" role="presentation">
					<a class="nav-link" data-toggle="pill" href="#<?= $kt->kode; ?>" role="tab"  aria-selected="false"><?= $kt->nm_kategori; ?></a>
				</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
				<div id="cart_session"></div>
			</div>
			<?php 
			$cart =	$this->cart->contents(); 
			$total = 0;
			?>
			<div class="col-sm-4 col-4">
				<div class="card">
					<div class="card-body">
					<select name="kategori" id="kategori" class="form-control">
						<?php foreach($kategori as $k): ?>
						<option value="<?= $k->id_kategori; ?>"><?= $k->nm_kategori; ?></option>
						<?php endforeach; ?>
					</select>
					</div>					
				</div>
			</div>
			<div class="col-sm-4 col-4">
				<div class="card">
					<div class="card-body">
						<input type="text" id="keyword" name="keyword" class="form-control" placeholder="Cari Produk . .">
					</div>
				</div>
				
			</div>
			<div class="col-sm-4 col-4">
				<a href="<?= base_url() ?>match/list_penjualan">
					<div class="card bg-gradient">
						<div class="card-body">
							<h6 class="text-center"><strong><i class="fa fa-cubes"></i> List Penjualan Produk</strong></h6>
						</div>
					</div>
				</a>
			</div>
			<!-- <div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="pills-home-tab"> -->
				<div class="col-sm-8 col-md-8">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="pills-home-tab">
								<div class="data-produk">
								
								</div>
							</div>
					
							<!-- <div class="tab-pane fade show" id="SHP" role="tabpanel" aria-labelledby="pills-home-tab">
								<div class="row">
									<?php foreach($kategori_shp as $d): ?>
										<div class="col-md-3">
										<a type="button" data-toggle="modal" data-target="#myModal<?=$d->id_produk;?>">
											<div class="card">
												<div class="card-body">
													<img class="img-thumbnail" width="170" src="<?= base_url() ?>upload/produk/<?= $d->foto; ?>" alt="">
													<h6 class="mt-2"><?= word_limiter($d->nm_produk, 5); ?></h6>
													<h6 style="font-weight: bold;">Rp. <?= number_format($d->harga); ?></h6>
												</div>
											</div>
										</a>
										</div>
									<?php endforeach; ?>
								</div>
							</div>				 -->
				
				</div>
				</div>
			<!-- </div>
			</div> -->
			
			<div class="col-sm-4 col-md-4" id="cart">
				
				</div>
			</div>
		</div>

		<!-- voucher -->
		<div class="modal fade" id="voucher" tabindex="-1" aria-labelledby="voucher" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Voucher</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form action="" method="post" id='form-check-voucher'>							
					<div class="row">
						<div class="col-10">
							<div class="form-group">
								<label>No Voucher</label>
								<input type="text" class="form-control" name="no_voucher"  placeholder="Masukan no voucher" required>
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<label>Check</label>
								<button type="submit" class="btn btn-success"> <i class="fas fa-sync-alt"></i></button>
							</div>
						</div>
					</div>
				</form>

				<form method="post" id="form_voucher">

				<input type="hidden" name="id_cart" value="" id="id_cart">
				<input type="hidden" name="price_cart" value="" id="price_cart">
				

				<div id="data_voucher">
					<!-- <div class="row">
						<div class="col-4">
							<label>No Vocher</label>
							<p>VC006</p>			
						</div>
						<div class="col-4">
							<label>Diskon</label>
							<p>20%</p>			
						</div>
						<div class="col-4">
							<label>Keterangan</label>
							<p>Voucher</p>			
						</div>				
					</div>					 -->
				</div>						
								
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" id="save-voucher" class="btn btn-primary">Save</button>
			</div>
			</form>
			</div>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="discon_servis" tabindex="-1" aria-labelledby="discon_servis" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Diskon Servis</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="diskon_servis">

				<!-- <input type="hidden" name="id_cart" value="" id="id_cart">
				<input type="hidden" name="price_cart" value="" id="price_cart"> -->
					
				<div class="buying-selling-group" data-toggle="buttons">
										<div class="row">
										<?php foreach ($diskon_servis as $key => $value): ?>
											<div class="col-lg-2 col-4 mr-5">
											<label class="btn btn-default buying-selling">
											<div class="checkbox-group required">
											<!-- <input type="text"  name="id_diskon" value="<?= $value->id_diskon ?>"> -->
												<input type="radio"  name="id_diskon" value="<?= $value->id_diskon ?>" id="option1" autocomplete="off" class="" required>
											</div>	
												<span class="radio-dot"></span>
												<?php if($value->jenis == 1): ?>
												<span class="buying-selling-word">Rp. <?= $value->jumlah ?></span>
												<?php else: ?>
													<span class="buying-selling-word"><?= $value->jumlah ?>%</span>
												<?php endif; ?>	
											</label>
											</div>
										<?php endforeach ?>
										</div>

									</div>					

				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
			</div>
			</div>
		</div>



		<?php foreach ($produk as $key => $value): ?>
			
				<div class="modal fade modal-cart" id="myModal<?= $value->id_produk ?>">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h5 class="modal-title">Detail Produk</h5>
								<form method="post" class="input_cart">
								<button type="submit" class="btn btn-primary"> SIMPAN</button>
							</div>
							<!-- Modal body -->
							<div class="modal-body">
							
								<div class="row">
									<div class="col-sm-4 col-md-4">
									
										<?php if (empty($value->foto)): ?>
											<img src="" alt="">
											<?php else: ?>
												<img class="img-thumbnail" width="270" src="<?= base_url() ?>upload/produk/<?= $value->foto ?>" alt="">
											<?php endif ?>

										</div>
										<div class="col-sm-8 col-md-8">
											<h6 class="mt-2"><?= $value->nm_produk ?></h6>
											<h6 style="font-weight: bold; color: #FA778E; font-size: 20px;">Rp. <?= number_format($value->harga) ?></h6>
											<p>Tersedia <?= $value->stok ?> Stok Barang</p>
											<div class="row">
												<div class="col-sm-6 col-md-6">
													<div class="form-group">
														<label for="">Jumlah *</label>
														<input type="number" min="1" max="<?= $value->stok ?>" name="jumlah" id="cart_jumlah" class="form-control" value="1" required="">
														<input id="cart_sku" type="hidden" name="sku" value="<?= $value->sku ?>">
														<input id="cart_id_produk" type="hidden" name="id_produk" value="<?= $value->id_produk ?>">
													</div>
												</div>
												<div class="col-sm-6 col-md-6">
													<div class="form-group">
														<label for="">Satuan</label>
														<input id="cart_satuan" type="text" name="satuan" value="<?= $value->satuan ?>" class="form-control"  readonly>
													</div>
												</div>
												<div class="col-sm-12 col-md-12">
													<div class="form-group">
														<?php if(!empty($value->diskon)) : ?>
														<label for="">Diskon <?= $value->diskon ?>%</label>
														<?php else: ?>
														<label for="">Diskon 0%</label>
														<?php endif;?>	
														<!-- <input type="text" id="diskon" name="diskon" class="form-control" value="<?= $value->diskon ?>%" disabled> -->
														<input type="hidden" id="cart_catatan" name="catatan" class="form-control" placeholder="Catatan Tambahan">
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<h5 style="font-size: 1rem;">DILAYANI OLEH</h5>
									<div class="buying-selling-group" id="buying-selling-group" data-toggle="buttons">
										<div class="row">
										<?php foreach ($karyawan as $key => $value): ?>
											<div class="col-lg-2 col-4">
											<label class="btn btn-default buying-selling">
											<div class="checkbox-group required">
												<input type="checkbox"  name="id_karyawan[]" value="<?= $value->id_kry ?>" id="option1" autocomplete="off" class="cart_id_karyawan">
											</div>	
												<span class="radio-dot"></span>
												<span class="buying-selling-word"><?= $value->nm_kry ?></span>
											</label>
											</div>
										<?php endforeach ?>
										</div>

									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				
			<?php endforeach ?>

			<div class="modal" id="myModalp">
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						

						<!-- Modal body -->
						<div class="modal-body">
							<center><br>
								<img width="120" src="<?= base_url() ?>upload/icon/payment.png" alt="">
							</center><br>
							<h5 class="text-center"> Apakah anda yakin ?</h5>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<a href="<?= base_url() ?>match/payment" class="btn btn-primary"> Lanjutkan</a>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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
					width: 123px; 
					padding: 10px;
					position: relative;
				}

				.buying-selling-word {
					font-size: 10px;
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

			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="<?= base_url('asset/adminlte/js/'); ?>sweetalert2.min.js"></script>

			<script>
				$(document).ready(function(){

					hide_default();

					function hide_default() {
						$('#data_voucher').hide();
						$('#save-voucher').hide();
						$('#save-voucher').attr('disabled','true');
					}

					function load_cart(){
						$.ajax({
						method:"POST",
						url:"<?php echo site_url() ?>match/get_cart",
						success:function(hasil)
						{
							$('#cart').html(hasil);
						}
						});
					}

					$(document).on('click','.voucher', function(event){
						var rowid = $(this).attr("id_cart");
						var price_cart = $(this).attr("price_cart");

						$('#id_cart').val(rowid);
						$('#price_cart').val(price_cart);
					});

					$(document).on('submit', '#form-check-voucher', function(event){  
						event.preventDefault();
							$.ajax({  
									url:"<?php echo base_url('match/check_voucher'); ?>",  
									method:'POST',  
									data:new FormData(this),  
									contentType:false,  
									processData:false,  
									success:function(data)  
									{  
									if(data == 'gagal'){
										Swal.fire({
										toast: true,
										position: 'top-end',
										showConfirmButton: false,
										timer: 3000,
										icon: 'error',
										title: ' Voucher tidak tersedia'
										});
										hide_default();
										// $('#id_voucher').attr('disabled','true');
									}else{
										$('#data_voucher').show();

										$('#save-voucher').show();
        	    						$('#save-voucher').removeAttr('disabled','true');

										$('#data_voucher').html(data);

									}
									}  
								});        
							});


							$(document).on('submit', '#form_voucher', function(event){  
						event.preventDefault();
							$.ajax({  
									url:"<?php echo base_url('match/claim_voucher'); ?>",  
									method:'POST',  
									data:new FormData(this),  
									contentType:false,  
									processData:false,  
									success:function(data)  
									{ 
										// alert(data); 
									if(data == 'gagal'){
										Swal.fire({
										toast: true,
										position: 'top-end',
										showConfirmButton: false,
										timer: 3000,
										icon: 'error',
										title: ' Voucher gagal di claim'
										});
										
									}else{
										Swal.fire({
										toast: true,
										position: 'top-end',
										showConfirmButton: false,
										timer: 3000,
										icon: 'success',
										title: ' Voucher sukses di claim'
										});
										hide_default();
										$('#form-check-voucher').closest('form').find("input[type=text]").val("");
										$('#voucher').modal('hide');
										load_cart();
									}
									}  
								});        
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

