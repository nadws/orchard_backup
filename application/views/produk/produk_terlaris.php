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
					<h1 class="m-0 text-dark">Produk Terlaris</h1>
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
				<a href="<?= base_url() ?>Match/produk" class="btn btn-warning mb-2">Kembali</a>
				<table id="produkterlaris" class="table" width="100%">
					<thead>
						<tr>
                            <th>#</th>
							<th>NAMA PRODUK</th>    
							<th width="15%">HARGA</th>
                            <th width="22%">FOTO</th>
                            <th width="10%">TERJUAL</th>
                            
						</tr>
					</thead>
                    <tbody style="text-align: center;">
                    <?php $i = 1; ?>
						<?php foreach ($produk as $k): ?>
							<tr>
                                <td><?= $i++; ?></td>
								<td><?= $k->nm_produk; ?> </td>
								<td>Rp. <?= number_format($k->harga); ?></td>
								<td>
									<?php if (empty($k->foto)): ?>
										<img class="img-thumbnail" width="80" src="<?= base_url() ?>upload/produk/not_found.png" alt="">
										<?php else: ?>
											<img class="img-thumbnail" width="80" src="<?= base_url() ?>upload/produk/<?= $k->foto ?>" alt="">
											<img src="" alt="">
										<?php endif ?>

                                    </td>
                                    <td><?= $k->jumlah; ?> </td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
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