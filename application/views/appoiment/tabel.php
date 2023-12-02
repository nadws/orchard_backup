<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>
<datalist id="data_mahasiswa">
	<?php foreach ($anak->result() as $b)
	{
		echo "<option value='$b->nm_kry'>$b->id_kry</option>";
	}
	?>
</datalist>
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Record Appointment </h1>
				</div>
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>
						<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>
						<!-- <button data-toggle="modal" data-target="#modal-excel" class="btn btn-success"><i class="fas fa-download"></i> Excel</button> -->
						<!-- <a href="<?= base_url('Match/rekap_app'); ?>"><button class="btn btn-success">Rekap Data</button></a> -->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="card-header">
				<div class="col-12">
					<?= $this->session->flashdata('message'); ?>
					<table id="example2" class="table" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>TANGGAL</th>
								<!-- <th>No. APPOINTMENT</th> -->
								<!-- <th>JAM</th> -->
								<th>RESEPSIONIS</th>    
								<th>TTL_APPOIMENT(ORG)</th>
								<th>NOMINAL</th>
								<th>AKSI</th>
								<th>ADMIN</th>
							</tr>
						</thead>
						<?php 
						date_default_timezone_set('Asia/Makassar');
						?>
						<thead style="background-color: white;">
							<form action="<?= base_url("Match/input_app") ?>" method="POST">
								<tr>
									<input type="hidden" name="id_kry_2" id="id_kry"  required>
									<td></td>
									<td><input style="border:none; border-bottom: solid; width: 180px;" class="form-control" type="date" name="tanggal" value="<?= date('Y-m-d') ?>"></td>
									<!-- <td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="kd_app" required></td> -->
									<td> <input style="border:none; border-bottom: solid; width: 140px;" list="data_mahasiswa" onchange="return autofill_anak();" class="form-control" type="input" name="nm_app" id="nm_kry" placeholder="Nama" required></td>
									
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="number" name="org" required></td>
									<td></td>
									<td>
										<button type="submit" class="btn btn-primary btn-sm"><span class="fas fa-check"></span></button>
									</td>
									<td></td>
								</tr>
							</form>
						</thead>
						<tbody style="text-align: center;">
							<?php
							$i=1;
							foreach ($app as $k): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= date('d-M-y',strtotime($k->tgl)) ?></td>
									<!-- <td><?= $k->kd_app; ?></td> -->
									<!-- <td><?= date('H:i',strtotime($k->jam)) ?></td> -->
									<td><?= $k->nm_app; ?></td>
									<td><?= $k->org; ?></td>
									<td><?= number_format($k->nominal, 0) ?></td>
									<td>
										<a href="<?= base_url('Match/edit_app/').$k->id_app; ?>"><div class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></div></a>
										<a onclick="return confirm('Yakin Hapus?')" href="<?= base_url('Match/drop_app/').$k->id_app; ?>"><div class="btn btn-danger btn-sm tombolhps" ><i class="fas fa-trash"></i></div></a>
									</td>
									<td><?= $k->admin ?></td>									
								</tr>
								<?php $i++; endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- ======================================================== conten ======================================================= -->
		<form action="<?= base_url('Match/summary_app'); ?>" method="post">
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
										<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker"></td>
									</tr>
								</table>

								<input class="form-control" type="date" value="" id="tanggal1" name="tgl1" hidden>  
								<input class="form-control" type="date" value="" id="tanggal2" name="tgl2" hidden>  
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="bg-pink btn">Lanjutkan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

		<form action="<?= base_url('Match/appoiment2'); ?>" method="post">
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
										<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker2"></td>
									</tr>
								</table>

								<input class="form-control" type="date" value="" id="tanggal3" name="tgl1" hidden>  
								<input class="form-control" type="date" value="" id="tanggal4" name="tgl2" hidden> 
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

		<form action="<?= base_url('Match/excel_app'); ?>" method="post">
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
										<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="excel"></td>
									</tr>
								</table>

								<input class="form-control" type="date" value="" id="excel1" name="tgl1" hidden>  
								<input class="form-control" type="date" value="" id="excel2" name="tgl2" hidden> 
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