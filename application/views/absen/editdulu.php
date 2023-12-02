<?php 
$this->load->view('tema/Header', $title); 
$today = date('Y-m-d');
?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Absen Orchard</h1>
				</div>
				<div class="col-sm-6">

				</div>
			</div>
		</div><br>
		<div class="container">
			<a href="<?= base_url() ?>match/absen" class="btn btn-warning"><i class="fa fa-arrow-left"></i> kembali</a><br><br>
			<div class="row mb-2">
				<div class="col-md-8">
					<?= $this->session->flashdata('message'); ?>
					<table id="example1" class="table table-striped table-bordered" width="100%">
						<thead style="font-family: Footlight MT Light;">
							<tr>
								<th>No</th>
								<th>TANGGAL</th>
								<th>NAMA</th>    
								<th>KET</th>
								<th>ADMIN</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<form method="post" action="<?= base_url('match/input_absen');?>">
									<td></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="date" name="tgl" value="<?= date('Y-m-d') ?>"></td>
									<td>
										<select style="border:none; border-bottom: solid;" data-dropdown-css-class="select2-danger" class="custom-select select2-danger" name="nm_karyawan">
											<option value=""> -- select --</option>
											<?php foreach ($d_nama as $k): ?>
												<option value="<?= $k->nm_kry; ?>"><?= $k->nm_kry; ?></option>
											<?php endforeach ?>
										</select>
									</td>
									<td>
										<select style="border:none; border-bottom: solid;" data-dropdown-css-class="select2-danger" class="custom-select select2-danger" name="ket">
											<option value=""> -- select --</option>
											<?php foreach ($komisi as $k): ?>
												<option value="<?= $k->tipe; ?>"><?= $k->tipe; ?></option>
											<?php endforeach ?>
										</select>
									</td>
									<td></td>                  
									<td><input type="submit" class="btn btn-primary"></td>
								</form>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1; 
							$dt = date('Y-m-d');
							foreach ($absen  as $d): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= date('d-M-y',strtotime($d->tgl)) ?></td>
									<td><?= $d->nm_karyawan; ?></td>
									<td><?= $d->ket; ?></td>
									<td><?= $d->admin; ?></td>
									<?php if ($d->tgl_input == date('Y-m-d')): ?>
										<td>
											<a href="" data-toggle="modal" data-target="#modaledit<?= $d->id_absen; ?>"><div class="btn btn-warning btn-sm tomboledit"><i class="fas fa-edit"></i></div></a>
											<a href="<?= base_url("match/drop_absen2/"). $d->id_absen;?>"><div class="btn btn-danger btn-sm tombolhps" onclick="return confirm('Yakin Hapus?')" ><i class="fas fa-trash"></i></div></a>    
										</td>
										<?php else: ?>
											<?php if ($this->session->userdata('id_role') == '1'): ?>
												<td>
													<a href="" data-toggle="modal" data-target="#modaledit<?= $d->id_absen; ?>"><div class="btn btn-warning btn-sm tomboledit"><i class="fas fa-edit"></i></div></a>
													<a href="<?= base_url("match/drop_absen2/"). $d->id_absen;?>"><div class="btn btn-danger btn-sm tombolhps" onclick="return confirm('Yakin Hapus?')" ><i class="fas fa-trash"></i></div></a>    
												</td>
												<?php else: ?>
													<td></td>
												<?php endif ?>
											<?php endif ?>
										</tr>
										<?php $i++; endforeach ?>
									</tbody>
									<tfoot>
										<tr>
											<th>No</th>
											<th>TANGGAL</th>
											<th>NAMA</th>    
											<th>KET</th>
											<th>ADMIN</th>
											<th>AKSI</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php foreach ($absen  as $d): ?>
					<form action="<?= base_url('match/update_absen'); ?>" method="post">
						<div class="modal fade" id="modaledit<?= $d->id_absen; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header" style="background: #FFA07A;">
										<h4 class="modal-title">Edit Data</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table class="table" width="100%">
											<thead>
												<th>TANGGAL</th>    
												<th>NAMA</th>    
												<th>KET</th>
											</thead>
											<tbody>
												<input type="hidden" name="id_absen" value="<?= $d->id_absen ?>">
												<td width="10%"><input style="border:none; border-bottom: solid;" class="form-control" type="date" name="tgl" value="<?= $d->tgl ?>"></td>
												<td width="40%">
													<select style="border:none; border-bottom: solid;" data-dropdown-css-class="select2-danger" class="custom-select select2-danger" name="nm_karyawan">
														<option value="<?= $d->nm_karyawan ?>"><?= $d->nm_karyawan ?></option>
														<?php foreach ($d_nama as $k): ?>
															<option value="<?= $k->nm_kry; ?>"><?= $k->nm_kry; ?></option>
														<?php endforeach ?>
													</select>
												</td>
												<td>
													<select style="border:none; border-bottom: solid;" data-dropdown-css-class="select2-danger" class="custom-select select2-danger" name="ket">
														<option value="<?= $d->ket ?>"><?= $d->ket ?></option>
														<option value="M">M</option>
														<option value="E">E</option>
														<option value="SP">SP</option>
														<option value="I">I</option>
														<option value="OFF">OFF</option>
														<option value="KOSONG">KOSONG</option>
													</select>
												</td>
											</tbody>
										</table>
										<div class="modal-footer justify-content-between">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button class="btn btn-primary" type="submit">Lanjutkan</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php endforeach ?>

				<!-- ======================================================== conten ======================================================= -->




				<!-- ======================================================== conten ======================================================= -->

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