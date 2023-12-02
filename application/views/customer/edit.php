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
					<h1 class="m-0 text-dark">Edit Customer</h1>
				</div>
				<div class="col-sm-6">
					<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
				</div>
			</div>
		</div><br>
		<div class="row">
		    <div class="col-md-12">
		        <a href="<?= base_url() ?>match/customer" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
		   <hr>
			<table class="table table-bordered table-striped" id="example1">
				<thead>
					<tr>
						<th>No. </th>
						<th>Nama</th>
						<th>Tgl. Lahir</th>
						<th>Email</th>
						<th>No. Telp</th>
						<th>Alamat</th>
						<th width="5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<form action="<?= base_url() ?>match/edit_customer" method="post">
							<td>#</td>
							<td>
								<input type="text" class="form-control" name="nama" value="<?= $detail->nama ?>"  placeholder="Isi Nama" required="">
								<input type="hidden" class="form-control" name="id_customer" value="<?= $detail->id_customer ?>" required="">
							</td>
							<td>
								<input type="date" class="form-control" name="tgl_lahir" value="<?= $detail->tanggal_lahir ?>" required="">
							</td>
								<td>
							    <input type="email" class="form-control" name="email" value="<?= $detail->email ?>" placeholder="Email" required="">
							</td>
							<td>
							    <input type="number" class="form-control" name="telp" value="<?= $detail->telepon ?>" placeholder="Cth : 081212345678" required="">
							</td>
							<td>
								<input type="text" class="form-control" name="alamat" value="<?= $detail->alamat ?>" placeholder="Alamat" required="">
							</td>
							<td>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</td>
						</form>
					</tr>
					
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<form action="<?= base_url('Match/summary_cancel'); ?>" method="post">
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
									<td ><label for="">Nama Customer</label></td>
									<td>:</td>
									<td>
										<select name="nama" id="" class="form-control select2" required="">
											<option value="">- Pilih Customer -</option>
											<?php foreach ($summary as $key => $value): ?>
												<option value="<?= $value->nama ?>"><?= $value->nama ?></option>
											<?php endforeach ?>
										</select>
									</td>
								</tr>
							</table>
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
	
	<div style="margin-top:20px;"></div>

	<?php $this->load->view('tema/Footer'); ?>