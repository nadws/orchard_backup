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
					<h1 class="m-0 text-dark">Record Kategori</h1>
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
				<div class="col-md-12">
					<?= $this->session->flashdata('message'); ?><br>
				</div>
				<div class="col-md-8">

					<table id="example1" class="table" width="100%">
						<thead>
							<tr>
								<th width="2%">NO.</th>
								<th>NAMA KATEGORI</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<thead style="background-color: white;">
							<form action="<?= base_url("Match/add_kategori") ?>" method="POST">
								<tr>
									<td></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" placeholder="Isi nama kategori" name="nama" required></td>
									<td>
										<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
									</td>
								</tr>
							</form>
						</thead>
						<tbody style="text-align: center;">
							<?php
							$i=1;
							foreach ($kategori as $k): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $k->nm_kategori; ?></td>
									<td>
									<a href="<?= base_url("Match/edit_kategori/"). $k->id_kategori; ?>"><div class="btn btn-warning btn-sm tomboledit"><i class="fas fa-edit"></i></div></a>
									<?php if ($this->session->userdata('id_role')=='1'): ?>   
									<a href="<?= base_url() ?>match/drop_kategori/<?= $k->id_kategori ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
									<?php endif; ?>
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