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
					<h1 class="m-0 text-dark">Record Produk</h1>
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
			<div class="container-fluid">
				<div class="col-md-12">
					<?= $this->session->flashdata('message'); ?><br>
				</div>
				<?php if ($this->session->userdata('id_role')=='1'): ?>
				<!-- <a href="<?= base_url("Match/produk_terlaris") ?>" class="btn btn-success mb-2 ">Produk Terlaris</a>
				
				<a href="<?= base_url("Match/tambah_produk2") ?>" class="btn btn-info mb-2 ">Tambah Produk</a>

				<a href="<?= base_url("Excel/export") ?>" class="btn btn-info mb-2 ml-2 float-right"><i class="fas fa-file-download"></i> Export</a>		
				<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#import">
				<i class="fas fa-file-upload"></i> Import
				</button> -->
				<?php endif; ?>
				<table id="produk" class="table text-sm" width="100%">
					
					<thead>
						<tr>
							<th >No</th>
							<th >Kategori</th>
							<th >Satuan</th>
							<th >SKU</th>
							<th>Product</th>    
							<!-- <th>Harga Modal</th> -->
							<th>Harga Jual</th>
							<th>Stok</th>
							<th>Diskon</th>
							<th>Foto</th>
							<?php if ($this->session->userdata('id_role')=='1'): ?>
							<th>Aksi</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody style="text-align: center;">
					<?php $i=1; ?>
						<?php foreach ($produk as $k): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $k->nm_kategori; ?></td>
								<td><?= $k->satuan; ?></td>
								<td><?= $k->sku; ?></td>
								<td><?= $k->nm_produk; ?> </td>
								<!-- <td>Rp. <?= number_format($k->harga_modal); ?></td> -->
								<td><?= number_format($k->harga); ?></td>
								<td><?= $k->stok; ?> </td>
								<?php if(!empty($k->diskon)) : ?>
								<td><?= $k->diskon; ?>% </td>
								<?php else: ?>
									<td>0%</td>	
								<?php endif; ?>
								<td>
									<?php if (empty($k->foto)): ?>
										<img class="img-thumbnail" width="80" src="<?= base_url() ?>upload/produk/not_found.png" alt="">
										<?php else: ?>
											<img class="img-thumbnail" width="80" src="<?= base_url() ?>upload/produk/<?= $k->foto ?>" alt="">
											<img src="" alt="">
										<?php endif ?>

									</td>
									<?php if ($this->session->userdata('id_role')=='1'): ?>
									<td width="10%">
										<a href="<?= base_url() ?>match/edit_produk/<?= $k->id_produk ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
										<a href="<?= base_url() ?>match/drop_produk/<?= $k->id_produk ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
									</td>
									<?php endif; ?>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

<form action="<?= base_url('Excel/import_data'); ?>" method="post" enctype="multipart/form-data">									
		<div class="modal fade" id="import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header" style="background: #FFA07A;">
				<h5 class="modal-title" id="exampleModalLabel">Import</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<div class="form-group">
				<label for="upload">Import Produk</label>				
				<input type="file" name="produk" id="upload" value="" class="form-control">
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Import</button>
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