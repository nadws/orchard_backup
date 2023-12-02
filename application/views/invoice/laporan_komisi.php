<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<style>
	.modal-md-max{
		max-width: 550px;
	}
</style>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	
	<div class="content-header">
		<div class="row">
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<?php 
			// $cart =	$this->cart->contents(); 
			$total = 0;
			?>

<?php 
$dt1 = new DateTime($tgl1);
$dt2 = new DateTime($tgl2);
$beda = $dt2->diff($dt1);


?>
			<div class="col-sm-12">
				<!-- <a href="<?= base_url() ?>match/order" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a> -->
				<button data-toggle="modal" data-target="#modal-view" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> View</button>
				<!-- <button data-toggle="modal" data-target="#modal-summary" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Summary</button> -->
				<a href="<?= base_url('Match/excel_komisi') ?>?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Excel</a>
				<!-- <button data-toggle="modal" data-target="#modal-excel" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Excel</button> -->
				<button data-toggle="modal" data-target="#rules" class="btn btn-sm btn-success"><i class="fas fa-cog"></i> Setting</button>
				<br><br>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<center><h5>Laporan Komisi Penjualan Orchard  <?= date('d M Y',strtotime($tgl1)) ?> -  <?= date('d M Y',strtotime($tgl2)) ?></h5></center>
							<table id="example1" class="table">
							<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Komisi Service</th>
										<th>Komisi Penjualan</th>
										<th>Komisi Request Therapish</th>
										<th>Total Komisi</th>
										<th>Total Komisi Target</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$total_app = 0;
								$total_penjualan = 0;
								$total = 0;
								$total2 = 0;
								$total_komisi_target = 0;
								?>
								<?php foreach ($komisi as $key => $value): ?>
								<?php 
									$names = ['T1', 'T2', 'T3','T4','T5','T6','T7','T8','T9','T10','ORCHARD'];
									if(in_array($value->nm_kry,$names) || ($value->total_produk + $value->total_app) <= 0){
										continue;
									} 
								?>
								
								<?php 
									$total_app += $value->total_app;
									$total_penjualan += $value->total_produk;
									$total += $value->total_app;
									$total += $value->total_produk;
									$total2 += $value->total_produk2;


									if($rules_active){
										if($rules_active->jenis == 'komisi'){
											$target_komisi = ($rules_active->jumlah * $dt_masuk->jml_masuk) / ($beda->days + 1);
	
											if(($value->total_produk + $value->total_app) >= $target_komisi){
												
												$komisi_awal = (($value->total_produk + $value->total_app) * 100)/5;
												$komisi_target = ($komisi_awal * $rules_active->persen)/100;											
												
											}else{
												$komisi_target = ($value->total_produk + $value->total_app);
											}
										}elseif($rules_active->jenis == 'pendapatan'){
											if(($dt_sum_app->total + $dt_sum_pembelian->total - $invoice->diskon) >= $rules_active->jumlah ){
												$komisi_awal = (($value->total_produk + $value->total_app + $value->total_produk2) * 100)/5;
												$komisi_target = ($komisi_awal * $rules_active->persen)/100;
											}else{
												$komisi_target = ($value->total_produk + $value->total_app + $value->total_produk2);
											}
										}else{
											$komisi_target = ($value->total_produk + $value->total_app + $value->total_produk2);
										}
									}else{
										$komisi_target = ($value->total_produk + $value->total_app + $value->total_produk2);
									}

									$total_komisi_target += $komisi_target;
								?>
									<tr>
										<td><?= $key+1 ?></td>
										<td><a href="<?= base_url(); ?>Match/check_komisi?id=<?= $value->id_kry ?>&tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>"><?= $value->nm_kry ?></a></td>
										<td style="text-align: right;"><?= number_format($value->total_app) ?></td>
										<td style="text-align: right;"><?= number_format($value->total_produk) ?></td>
										<td style="text-align: right;"><?= number_format($value->total_produk2) ?></td>
										<td style="text-align: right;"><?= number_format($value->total_produk + $value->total_app + $value->total_produk2) ?></td>
										<td style="text-align: right;"><?= number_format($komisi_target) ?> 
										<!--<?= number_format($dt_sum_app->total + $dt_sum_pembelian->total - $invoice->diskon,0) ?>-->
										
										</td>
									</tr>
								<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan=2>Total</th>
										<th style="text-align: right;"><?= number_format($total_app,0) ?></th>
										<th style="text-align: right;"><?= number_format($total_penjualan,0) ?></th>
										<th style="text-align: right;"><?= number_format($total2,0) ?></th>
										<th style="text-align: right;"><?= number_format($total,0) ?></th>
										<th style="text-align: right;"><?= number_format($total_komisi_target,0) ?></th>
									</tr>
								</tfoot>
						</table>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="<?= base_url('Match/edit_rules_komisi'); ?>" method="post">
					<div class="modal fade" id="rules">
						<div class="modal-dialog modal-md-max">
							<div class="modal-content">
								<div class="modal-header" style="background:#FFA07A;">
									<h4 class="modal-title">Setting Target Komisi</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									<div class="modal-body">
										<input type="hidden" name="tgl1" value="<?= $tgl1 ?>">
										<input type="hidden" name="tgl2" value="<?= $tgl2 ?>">

									<?php
									$pendapatan = 0;
									$komisi = 0; 
									foreach($dt_rules as $d){
										if($d->status == 1){
											if($d->jenis == 'komisi'){
												$komisi ++;
											}else{
												$pendapatan++;
											}
										}
									} ?>

										<div class="row justify-content-center">
											 <div class="col-5 form-group">											
												<div class="form-check">
													<!-- <input class="form-check-input" type="radio" name="rules[]" value="" checked> -->
													<input class="form-check-input pilih_rules" type="radio" name="rules" value="komisi" lawan="pendapatan" <?= $komisi >= 1 ? 'checked' : '' ?>>												
													<label class="form-check-label"><strong>Komisi</strong></label>
												</div>
											 </div>
											 <div class="col-5 form-group">
											 	<div class="form-check">
													<!-- <input class="form-check-input" type="radio" name="rules[]" value="" checked> -->
													<input class="form-check-input pilih_rules" type="radio" name="rules" value="pendapatan" lawan="komisi" <?= $pendapatan >= 1 ? 'checked' : '' ?>>												
													<label class="form-check-label"><strong>Pendapatan</strong></label>
												</div>
											 </div>
										 </div>

										 <div class="row justify-content-center">
											 <div class="col-12">
												 <hr>
											 </div>
										 </div>

										 <div class="row justify-content-center">

											<div class="col-5">
												<?php foreach($dt_rules as $d): 
												if($d->jenis != 'komisi'){continue;}	
												?>
												<div class="form-check">
													<!-- <input class="form-check-input" type="radio" name="permission[]" value="" checked> -->
													<input class="form-check-input komisi" type="radio" name="komisi" value="<?= $d->id_rules ?>" <?= $d->status == 1 ? 'checked required' : '' ?>>												
													<label class="form-check-label"><strong><?= number_format($d->jumlah,0) ?> = <?= $d->persen ?>%</strong></label>
												</div>
												<?php endforeach; ?>
											</div>

											<div class="col-5">
											<?php foreach($dt_rules as $d): 
												if($d->jenis != 'pendapatan'){continue;}	
												?>
												<div class="form-check">
													<!-- <input class="form-check-input" type="radio" name="permission[]" value="" checked> -->
													<input class="form-check-input pendapatan" type="radio" name="komisi" value="<?= $d->id_rules ?>" <?= $d->status == 1 ? 'checked required' : '' ?>>												
													<label class="form-check-label"><strong><?= number_format($d->jumlah,0) ?> = <?= $d->persen ?>%</strong></label>
												</div>
												<?php endforeach; ?>
											</div>

										 </div>

										<button class="btn btn-sm btn-primary mt-2 float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
										<i class="fas fa-chevron-down"></i>
										</button>
										<br><br>

										<div class="mt-2 collapse" id="collapseExample">
											<div class="card">
												<div class="card-header">
													<strong>Edit</strong>
												</div>
												<div class="card-body">

													<div class="row">
														<div class="col-4">
															<div class="form-group">
																<label for="">Jenis</label>
															</div>
														</div>
														<div class="col-4">
															<div class="form-group">
																<label for="">Nominal</label>
															</div>
														</div>
														<div class="col-4">
															<div class="form-group">
																<label for="">Persen</label>
															</div>
														</div>
													</div>

													<?php foreach($dt_rules as $d): ?>
													<div class="row">
														<input type="hidden" name="id_rules[]" value="<?= $d->id_rules ?>">
														<div class="col-4">
															<div class="form-group">
																<select class="form-control" name="jenis[]">
																	<option value="komisi" <?= $d->jenis == 'komisi' ? 'selected' : '' ?>>Komisi</option>
																	<option value="pendapatan" <?= $d->jenis == 'pendapatan' ? 'selected' : '' ?>>Pendapatan</option>
																</select>
															</div>
														</div>
														<div class="col-4">
															<div class="form-group">
																<input type="number" class="form-control" name="jumlah[]" value="<?= $d->jumlah ?>" required>
															</div>
														</div>
														<div class="col-3">
															<div class="input-group">
																<input type="number" class="form-control" name="persen[]" value="<?= $d->persen ?>" required>
																<div class="input-group-prepend">
																	<div class="input-group-text">%</div>
																</div>
															</div>
														</div>

														<div class="col-1">
															<?php if($d->status != 1): ?>
															<a href="<?= base_url('Match/drop_rules/').$d->id_rules ?>?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>" onclick="return confirm('Apakah anda yakin');" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
															<?php else: ?>
															<button class="btn btn-xs btn-success" type="button" aria-readonly=""><i class="fas fa-check-circle"></i></button>
															<?php endif; ?>	
														</div>

													</div>
													<?php endforeach; ?>

												</div>
											</div>

											<div class="card">
												<div class="card-header">
													<strong>Tambah</strong>
												</div>
												<div class="card-body">

													<div class="row">
													
														<div class="col-4">
															<div class="form-group">
																<label for="">Jenis</label>
																<select class="form-control" name="jenis_tambah">
																	<option value="">- Pilih jenis -</option>
																	<option value="komisi" >Komisi</option>
																	<option value="pendapatan" >Pendapatan</option>
																</select>
															</div>
														</div>
														<div class="col-4">
															<div class="form-group">
																<label for="">Nominal</label>
																<input type="number" class="form-control" name="jumlah_tambah">
															</div>
														</div>
														<div class="col-4">

															<div class="form-group">
															<label for="">Persen</label>
															<div class="input-group">
																
																<input type="number" class="form-control" name="persen_tambah">
																<div class="input-group-prepend">
																	<div class="input-group-text">%</div>
																</div>
															</div>
															</div>
															
														</div>

													</div>

												</div>
											</div>

										</div>

									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn" style="background:#FFA07A;">Edit/Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>

	<form action="<?= base_url('Match/laporan_komisi'); ?>" method="get">
					<div class="modal fade" id="modal-view">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background:#FFA07A;">
									<h4 class="modal-title">View Data</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<table>
											<tr>
												<td ><label for="">Tanggal</label></td>
												<td>:</td>
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" id="picker"></td>
											</tr>
										</table>

										<input class="form-control" type="date"  id="tanggal1" name="tgl1" hidden>  
										<input class="form-control" type="date"  id="tanggal2" name="tgl2" hidden> 
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn" style="background:#FFA07A;">Lanjutkan</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>

				<form action="<?= base_url('Match/summary_laporan_komisi'); ?>" method="post">
					<div class="modal fade" id="modal-summary">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background:#FFA07A;">
									<h4 class="modal-title">Export Summary</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<table>
											<tr>
												<td ><label for="">Tanggal</label></td>
												<td>:</td>
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker2"></td>
											</tr>
										</table>

										<input class="form-control" type="date" value="" id="tanggal3" name="tgl3" hidden>  
										<input class="form-control" type="date" value="" id="tanggal4" name="tgl4" hidden> 
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn" style="background:#FFA07A;">Lanjutkan</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>

				<form action="<?= base_url('Match/excel_komisi'); ?>" method="post">
					<div class="modal fade" id="modal-excel">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background:#FFA07A;">
									<h4 class="modal-title">Export Data</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<table>
											<tr>
												<td ><label for="">Tanggal</label></td>
												<td>:</td>
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" id="picker_excel"></td>
											</tr>
										</table>

										<input class="form-control" type="date"  id="tgl1" name="tgl1" hidden>  
										<input class="form-control" type="date"  id="tgl2" name="tgl2" hidden> 
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn" style="background:#FFA07A;">Lanjutkan</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
	$(document).ready(function(){
		

		function cek_rules(){
			var komisi = <?=$komisi?>;
			var pendapatan = <?=$pendapatan?>;
			if(komisi >= 1){
				$('.pendapatan').attr('disabled', 'true');
			}else if(pendapatan >= 1){
				$('.komisi').attr('disabled', 'true');
			}
		}

		cek_rules();

		$(document).on('click', '.pilih_rules', function(){
			var jenis = $(this).val();
			var lawan = $(this).attr('lawan');

			$('.'+lawan).attr('disabled', 'true');
			$('.'+jenis).removeAttr('disabled', 'true');
		});

	});
</script>

	<?php $this->load->view('tema/Footer'); ?>

