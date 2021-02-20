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
					<h1 class="m-0 text-dark">Record Servis</h1>
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
		    <div class="container">
				<div class="col-12">
					<?= $this->session->flashdata('message'); ?><br>
					<table id="example2" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th width="6%">No</th>
								<th>NAMA SERVIS</th>
								<th width="15%">JAM</th>    
								<th width="15%">MENIT</th>
								<th width="10%">AKSI</th>
							</tr>
						</thead>
						<thead style="background-color: white;">
							<form action="<?= base_url("Match/add_servis") ?>" method="POST">
								<tr>
									<td></td>
								    <td><input style="border:none; border-bottom: solid;" class="form-control" type="text" placeholder="Isi Nama Servis" name="servis" required></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="number" placeholder="Cth : 1" name="jam" required></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="number" placeholder="Cth : 30" name="menit" required></td>
									<td>
										<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
									</td>
								</tr>
							</form>
						</thead>
						<tbody style="text-align: center;">
							<?php
							$i=1;
							foreach ($kasbon as $k): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $k->nm_servis; ?></td>
									<td><?= $k->durasi; ?> Jam</td>
									<td><?= $k->menit; ?> Menit</td>
									<td>
									    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?= $k->id_servis ?>"><i class="fa fa-edit"></i></button>
									    <a href="<?= base_url() ?>match/drop_servis/<?= $k->id_servis ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php $i++; endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
		    </div>
		</div>

		<!-- ======================================================== conten ======================================================= -->
		<form action="<?= base_url('Match/kasbon2'); ?>" method="post">
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
											<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker3"></td>
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
			
			
	<?php foreach ($kasbon as $key => $value): ?>
		<div id="myModal<?= $value->id_servis ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Ubah Servis</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        	<table id="example2" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th>NAMA SERVIS</th>
								<th width="15%">JAM</th>    
								<th width="15%">MENIT</th>
								<th width="10%">AKSI</th>
							</tr>
						</thead>
						<thead style="background-color: white;">
							<form action="<?= base_url("Match/edit_servis") ?>" method="POST">
								<tr>
								 <input style="border:none; border-bottom: solid;" class="form-control" value="<?= $value->id_servis ?>" type="hidden" name="id_servis" required>
								    <td><input style="border:none; border-bottom: solid;" class="form-control" value="<?= $value->nm_servis ?>" type="text" placeholder="Isi Nama Servis" name="servis" required></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" value="<?= $value->durasi ?>" type="number" placeholder="Cth : 1" name="jam" required></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" value="<?= $value->menit ?>" type="number" placeholder="Cth : 30" name="menit" required></td>
									<td>
										<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
									</td>
								</tr>
							</form>
						</thead>
						</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	<?php endforeach ?>

		<form action="<?= base_url('Match/summary_kasbon'); ?>" method="post">
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
										<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="pickerkas"></td>
									</tr>
								</table>

								<input class="form-control" type="date" value="" id="tanggalkas1" name="tgl3" hidden>  
								<input class="form-control" type="date" value="" id="tanggalkas2" name="tgl4" hidden> 
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

		<form action="<?= base_url('Match/drop_kasbon_skala'); ?>" method="post">
			<div class="modal fade" id="modal-delete">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-red">
							<h4 class="modal-title">Delete Skala Besar</h4>
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
										<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker_drop"></td>
									</tr>
								</table>

								<input class="form-control" type="date" value="" id="tanggal5" name="tgl5" hidden>  
								<input class="form-control" type="date" value="" id="tanggal6" name="tgl6" hidden> 
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger">Lanjutkan</button>
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