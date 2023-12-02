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
				<?php if ($this->session->userdata('edit_hapus') == '1') : ?>
					<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
					<!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
					<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
					<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
				<?php endif ?>
			</div>
			<div class="col-5 mt-2">
				<a href="<?= base_url('match/order'); ?>" class="btn btn-warning">Kembali</a>
			</div>
		</div>
	</div>
	<div style="margin-top: 20px;"></div>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<?= $this->session->flashdata('message'); ?>
		</div>
		<?php
		$cart =	$this->cart->contents();

		?>
		<div class="col-sm-7">
			<div class="card">
				<div class="card-body">
					<h3 class="text-center">Rincian Product</h3>
					<hr>
					<div class="row">
						<?php
						$subtotal_produk = 0;
						$jumlah_produk = 0;
						?>
						<?php foreach ($cart as $key => $value) : ?>
							<?php
							if ($value['type'] == 'barang') :
								$subtotal_produk += $value['price'] * $value['qty'];
								$jumlah_produk += $value['qty'];
							?>
								<div class="col-md-8">
									<?php foreach ($value['nm_karyawan'] as $nm_karyawan) : ?>
										<span class="badge badge-secondary mr-1"><?= $nm_karyawan ?></span>
									<?php endforeach; ?>
									| <span class="badge badge-info"><?= $value['satuan'] ?></span><br><br>
									<img width="80" class="img-thumbnail" src="<?= base_url() ?>upload/produk/<?= $value['picture'] ?>" alt="">
									<span style="margin-left: 20px;"><?= $value['name'] ?></span>

								</div>

								<div class="col-md-4">
									<p style="margin-top: 55px;" class="float-right"><?= $value['qty'] ?> x <strong>Rp.<?= number_format($value['price']) ?></strong> </p>
								</div>
							<?php endif; ?>
						<?php endforeach ?>
						<div class="container">
							<strong>Subtotal <?= $jumlah_produk ?> produk</strong> <strong style="float: right;">Rp. <?= number_format($subtotal_produk) ?></strong>
							<hr>
							<!-- <strong style="font-size: 20px;">Total</strong> <strong style="float: right; font-size: 22px;">Rp. <?= number_format($subtotal) ?></strong> -->
						</div>
						<div class="col-12">
							<div class="container">
								<h3 class="text-center">Rincian Service</h3>
								<hr>
							</div>
						</div>
						<hr>
						<?php
						$subtotal_order = 0;
						$jumlah_servis = 0;
						?>

						<?php foreach ($cart as $key => $value) : ?>
							<?php


							// $jumlah += $value['qty'];
							if ($value['type'] == 'order') :
								$jumlah_servis += $value['qty'];
								$subtotal_order += $value['price'] * $value['qty'];
							?>
								<div class="col-md-8">
									<?php foreach ($value['terapis'] as $terapis) : ?>
										<span class="badge badge-secondary mr-1"><?= $terapis ?></span>
									<?php endforeach; ?> <br><br>
									<span style="margin-left: 20px;"><?= $value['name'] ?></span>

								</div>

								<div class="col-md-4">
									<p style="margin-top: 55px;" class="float-right"><?= $value['qty'] ?> x <strong>Rp.<?= number_format($value['price'] * $value['qty']) ?></strong> </p>
								</div>
							<?php endif; ?>
						<?php endforeach ?>
						<div class="container">
							<strong>Subtotal Appointment</strong> <strong style="float: right;">Rp. <?= number_format($subtotal_order) ?></strong>
							<hr>
							<!-- <strong style="font-size: 20px;">Total</strong> <strong style="float: right; font-size: 22px;">Rp. <?= number_format($subtotal) ?></strong> -->
						</div>

						<div class="container">
							<strong style="font-size: 20px;">Total</strong> <strong style="float: right; font-size: 22px;">Rp. <?= number_format($subtotal_produk + $subtotal_order) ?></strong>
						</div>

						<?php $total = $subtotal_produk + $subtotal_order ?>
						<div class="container">
							<hr>
							<h3 class="text-center mb-4">Pembayaran</h3>
							<hr>
							<div class="row">

								<div class="col-4">
									<div class="form-group">
										<div class="custom-control custom-switch custom-switch-off-warning custom-switch-on-success">
											<input type="checkbox" class="custom-control-input" id="cb_dp">
											<label class="custom-control-label" for="cb_dp">DP</label>
										</div>
									</div>
								</div>

								<div class="col-6 d_dp_input">
									<div class="form-group">
										<select id="data_dp" class="form-control select select_dp" disabled>
											<option value="">- Pilih DP -</option>
											<?php foreach ($dp as $dp) : ?>
												<option value="<?= $dp->id_dp ?>"><?= $dp->kd_dp ?> | <?= $dp->nama ?> | <?= $dp->ket ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>


							</div>

							<form id="form_vcr_inv">
								<div class="row">
									<div class="col-4">
										<div class="form-group">
											<div class="custom-control custom-switch custom-switch-off-warning custom-switch-on-success">
												<input type="checkbox" class="custom-control-input" id="vcr_inv">
												<label class="custom-control-label" for="vcr_inv">Voucher</label>
											</div>
										</div>
									</div>

									<div class="col-5 vcr_inv">
										<div class="form-group">
											<input type="text" id="data_vcr_inv" name="no_voucher" class="form-control select_vcr_inv" placeholder="Masukan kode voucher" required>
										</div>
									</div>

									<div class="col-1 vcr_inv">
										<button type="submit" class="btn btn-sm mt-1 btn-primary select_vcr_inv">Cek</button>
									</div>
								</div>
							</form>


							<form action="<?= base_url() ?>match/checkout" method="post">

								<div class="form-group row d_dp_input">
									<label for="staticEmail" class="col-md-4 col-form-label">DP</label>
									<div class="col-md-6">
										<input type="number" id="debit" name="debit" class="form-control pembayaran select_dp" value="0" readonly>
										<!--<input type="hidden" id="id_customer" name="id_customer" class="form-control pembayaran select_dp" >-->
										<input type="hidden" id="tgl_dp" name="tgl_dp" class="form-control pembayaran select_dp">
										<input type="hidden" id="kd_dp" name="kd_dp" class="form-control pembayaran select_dp">
										<input type="hidden" id="metode" name="metode" class="form-control pembayaran select_dp">
									</div>
								</div>

								<div class="form-group row vcr_inv">
									<label for="staticEmail" class="col-md-4 col-form-label">Voucher </label>
									<div class="col-md-6">
										<input type="text" id="nominal_voucher" name="nominal_voucher" class="form-control pembayaran select_vcr_inv" value="0" readonly>
										<input type="hidden" id="id_voucher" name="id_voucher" class="form-control pembayaran select_vcr_inv">
									</div>
								</div>


								<?php if (!empty($diskon)) : ?>
									<?php $total = $subtotal_produk + $subtotal_order ?>


									<div class="form-group row">
										<label for="staticEmail" class="col-md-4 col-form-label">Diskon</label>
										<select id="data_diskon" class="form-control select col-3">
											<option value="">- Pilih Diskon -</option>
											<?php foreach ($diskon as $diskon) : ?>
												<option value="<?= $diskon->id_diskon ?>"><?= $diskon->nm_diskon ?></option>
											<?php endforeach; ?>
										</select>
										<input type="text" name="diskon[]" class="form-control pembayaran diskon col-3 ml-1" value="0" readonly>
										<input type="hidden" name="id_diskon" class="form-control col-3 ml-1" id="id_diskon">
									</div>




								<?php else : ?>
									<input type="hidden" name="diskon[]" class="form-control pembayaran diskon" value="0">
								<?php endif; ?>
								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">Customer</label>
									<div class="col-md-6">
										<select class="select" name="id_customer">
											<option value="">-Pilih Customer-</option>
											<?php foreach ($customer as $c) : ?>
												<option value="<?= $c->id_customer ?>"><?= $c->nama ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">Cash</label>
									<div class="col-md-6">
										<input type="number" name="cash" class="form-control pembayaran" value="0" id="cash">
									</div>
								</div>

								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">Mandiri Kredit</label>
									<div class="col-md-6">
										<input type="number" name="mandiri_kredit" value="0" class="form-control pembayaran" id="mandiri_kredit">
									</div>
								</div>

								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">Mandiri Debit</label>
									<div class="col-md-6">
										<input type="number" name="mandiri_debit" value="0" class="form-control pembayaran" id="mandiri_debit">
									</div>
								</div>

								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">BCA Kredit</label>
									<div class="col-md-6">
										<input type="number" name="bca_kredit" class="form-control pembayaran" value="0" id="bca_kredit">
									</div>
								</div>

								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">BCA Debit</label>
									<div class="col-md-6">
										<input type="number" name="bca_debit" class="form-control pembayaran" value="0" id="bca_debit">
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">Shoope</label>
									<div class="col-md-6">
										<input type="number" name="shoope" class="form-control pembayaran" value="0" id="shoope">
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-md-4 col-form-label">Tokopedia</label>
									<div class="col-md-6">
										<input type="number" name="tokopedia" class="form-control pembayaran" value="0" id="tokopedia">
									</div>
								</div>

								<input type="hidden" name="total" id="total" value="<?= $total; ?>">
								<button class="btn btn-primary btn-block" style="background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%); border-color: #F7889D; font-weight: bold; color: #fff;" id="btn_bayar" disabled>PROSES BAYAR <i class="fas fa-money-check-alt"></i> <i class="fa fa-chevron-right" style="float: right;"></i></button>
							</form>

						</div>
					</div>
				</div>
			</div>
			<?php $total = $subtotal_produk + $subtotal_order ?>
		</div>


	</div>
</div>



<style>
	.buying-selling.active {
		background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
	}

	#option1 {
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

	.radio-dot:before,
	.radio-dot:after {
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
<script src="<?= base_url('asset/adminlte/js/'); ?>sweetalert2.min.js"></script>

<script>
	$(document).ready(function() {

		$('.d_dp_input').hide();
		$('.select_dp').attr('disabled', 'true');

		$('.vcr_inv').hide();
		$('.select_vcr_inv').attr('disabled', 'true');

		function bayar_default() {
			var diskon = 0;
			$(".diskon").each(function() {
				diskon += parseInt($(this).val());
			});

			var voucher = parseInt($("#nominal_voucher").val());

			var dp = parseInt($("#debit").val());
			// var diskon = parseInt($("#diskon").val());
			var cash = parseInt($("#cash").val());
			var mandiri_kredit = parseInt($("#mandiri_kredit").val());
			var mandiri_debit = parseInt($("#mandiri_debit").val());
			var bca_kredit = parseInt($("#bca_kredit").val());
			var bca_debit = parseInt($("#bca_debit").val());
			var shoope = parseInt($("#shoope").val());
			var tokopedia = parseInt($("#tokopedia").val());



			var total = parseInt($("#total").val());
			var bayar = mandiri_kredit + mandiri_debit + cash + bca_kredit + bca_debit + shoope + tokopedia + dp + diskon + voucher;
			if (total <= bayar) {
				$('#btn_bayar').removeAttr('disabled');
			} else {
				$('#btn_bayar').attr('disabled', 'true');
			}
		}

		bayar_default();



		$('#cb_dp').change(function() {
			if ($(this).is(':checked')) {
				$('.d_dp_input').show();
				$('.select_dp').removeAttr('disabled', 'true');
			} else {
				$('.d_dp_input').hide();
				$('.select_dp').attr('disabled', 'true');
				$("#debit").val(0);
				$("#kd_dp").val('');
			}


		});


		$('#data_dp').change(function() {
			var id_dp = $("#data_dp").val();
			$.ajax({
				url: "<?= base_url(); ?>match/get_dp/",
				method: "POST",
				data: {
					id_dp: id_dp
				},
				dataType: "json",
				success: function(data) {
					$("#debit").val(data.kredit);
					$("#id_customer").val(data.id_customer);
					$("#kd_dp").val(data.kd_dp);
					$("#tgl_dp").val(data.tgl_dp);
					$("#metode").val(data.metode);

					bayar_default();

				}
			});
		});

		$('#vcr_inv').change(function() {
			if ($(this).is(':checked')) {
				$('.vcr_inv').show();
				$('.select_vcr_inv').removeAttr('disabled', 'true');
			} else {
				$('.vcr_inv').hide();
				$('.select_vcr_inv').attr('disabled', 'true');
			}
			$("#nominal_voucher").val('');
			$("#id_voucher").val('');
			bayar_default();
		});

		$(document).on('submit', '#form_vcr_inv', function(event) {
			event.preventDefault();
			// var no_voucher = $(this).serializeArray();
			// console.log(no_voucher[0].value);
			$("#nominal_voucher").val('');
			$("#id_voucher").val('');
			$.ajax({
				url: "<?php echo base_url('Match/cek_vcr_inv'); ?>",
				method: 'POST',
				data: new FormData(this),
				contentType: false,
				processData: false,
				dataType: 'JSON',
				success: function(data) {
					// console.log(data.status);

					if (data.status == 'ada') {
						if (data.jenis == 1) {
							$("#nominal_voucher").val(data.jumlah);
							$("#id_voucher").val(data.id_voucher);
						} else {
							var jumlah = parseInt($("#total").val()) > 0 ? parseInt($("#total").val()) * parseInt(data.jumlah) / 100 : 0;
							$("#nominal_voucher").val(jumlah);
							$("#id_voucher").val(data.id_voucher);
						}
						Swal.fire({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							icon: 'success',
							title: ' Voucher tersedia'
						});

					} else if (data.status == 'terpakai') {
						Swal.fire({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							icon: 'error',
							title: ' Voucher sudah terpakai'
						});
					} else if (data.status == 'expired') {
						Swal.fire({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							icon: 'error',
							title: ' Voucher expired'
						});
					} else if (data.status == 'kosong') {
						Swal.fire({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							icon: 'error',
							title: ' Voucher tidak tersedia'
						});
					}
					bayar_default();
				}
			});

		});


		$('#data_diskon').change(function() {
			var id_diskon = $(this).val();

			$.ajax({
				url: "<?= base_url(); ?>match/get_diskon/",
				method: "POST",
				data: {
					id_diskon: id_diskon
				},
				dataType: "json",
				success: function(data) {
					if (data.jenis == 1) {
						$(".diskon").val(data.jumlah);
					} else {
						var jumlah = parseInt($("#total").val()) * parseInt(data.jumlah) / 100;
						$(".diskon").val(jumlah);
					}
					$("#id_diskon").val(data.id_diskon);
				}
			});




		});



		$('#cash').on('change blur', function() {
			if ($(this).val().trim().length === 0) {
				$(this).val(0);
			}
		});
		$('#mandiri_kredit').on('change blur', function() {
			if ($(this).val().trim().length === 0) {
				$(this).val(0);
			}
		});
		$('#mandiri_debit').on('change blur', function() {
			if ($(this).val().trim().length === 0) {
				$(this).val(0);
			}
		});
		$('#bca_kredit').on('change blur', function() {
			if ($(this).val().trim().length === 0) {
				$(this).val(0);
			}
		});
		$('#bca_debit').on('change blur', function() {
			if ($(this).val().trim().length === 0) {
				$(this).val(0);
			}
		});



		$('.pembayaran').keyup(function() {
			var diskon = 0;
			$(".diskon").each(function() {
				diskon += parseInt($(this).val());
			});

			var dp = parseInt($("#debit").val());
			// var diskon = parseInt($("#diskon").val());
			var cash = parseInt($("#cash").val());
			var mandiri_kredit = parseInt($("#mandiri_kredit").val());
			var mandiri_debit = parseInt($("#mandiri_debit").val());
			var bca_kredit = parseInt($("#bca_kredit").val());
			var bca_debit = parseInt($("#bca_debit").val());
			var shoope = parseInt($("#shoope").val());
			var tokopedia = parseInt($("#tokopedia").val());
			var total = parseInt($("#total").val());
			var nominal_voucher = parseInt($("#nominal_voucher").val());
			var bayar = mandiri_kredit + mandiri_debit + cash + bca_kredit + bca_debit + shoope + tokopedia + dp + diskon + nominal_voucher;
			if (total <= bayar) {
				$('#btn_bayar').removeAttr('disabled');
			} else {
				$('#btn_bayar').attr('disabled', 'true');
			}


		});
	});
</script>


<script>
	function autofill_anak() {
		var nm_kry = document.getElementById('nm_kry').value;
		$.ajax({
			url: "<?php echo base_url(); ?>Match/cari_anak",
			data: '&nm_kry=' + nm_kry,
			success: function(data) {
				var hasil = JSON.parse(data);

				$.each(hasil, function(key, val) {
					document.getElementById('id_kry').value = val.id_kry;
					document.getElementById('nm_kry').value = val.nm_kry;
				});
			}
		});
	}
</script>

<?php $this->load->view('tema/Footer'); ?>