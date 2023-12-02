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
					<h1 class="m-0 text-dark">Ubah Produk</h1>
					<br>
					<a href="<?= base_url() ?>match/produk_masuk" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
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
		        		<table class="table" width="100%">
						<thead>
							<tr class="text-sm">
								<th>NAMA PRODUK</th>
								<th>JUMLAH</th>    
								<th>HARGA BELI</th>
								<!-- <th>HARGA JUAL</th> -->
								<th>AKSI</th>
							</tr>
						</thead>
						<thead style="background-color: white;">
							<form action="<?= base_url("Match/update_produk_masuk") ?>" method="POST">
							<input type="hidden" name="id_produk_masuk" value="<?= $produk_masuk['id'] ?>">
								<tr>
								    <td>
								        <select  style="border:none; border-bottom: solid;" name="id_produk" class="form-control" required>
								            <option value="">- Pilih Kategori -</option>
								            	<?php foreach ($produk as $d): ?>
							                    <option value="<?= $d->id_produk ?>" <?php if($d->id_produk == $produk_masuk['id_produk']){echo "selected";} ?>><?= $d->nm_produk ?></option>
                                                <?php endforeach ?>
								        </select>
								    </td>
									<td><input style="border:none; border-bottom: solid;" value="<?= $produk_masuk['jumlah'] ?>" class="form-control" type="number" name="jumlah" required></td>
									<td><input style="border:none; border-bottom: solid;" value="<?= $produk_masuk['hrg_beli'] ?>" class="form-control" type="number" name="hrg_beli" required></td>
									<!-- <td><input style="border:none; border-bottom: solid;" value="<?= $produk_masuk['hrg_jual'] ?>" class="form-control" type="number" name="hrg_jual" required></td> -->
									<td>
										<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
									</td>
								</tr>
							</form>
						</thead>
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