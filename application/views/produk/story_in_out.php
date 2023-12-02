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
					<h1 class="m-0 text-dark">Rincian Produk - <?= $produk->nm_produk ?></h1>
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
				<a href="<?= base_url("Match/produk") ?>" class="btn btn-warning mb-2 "><i class="fa fa-arrow-left"></i> Kembali</a>
				<hr>
				<table id="produk" class="table text-sm" width="100%">
					
					<thead>
						<tr class="text-center">
							<th >Tanggal</th>
							<th >Kategori</th>
							<th >Satuan</th>
							<th >SKU</th>
							<th >Product</th>    
							<!-- <th>Harga Modal</th> -->
							<th >Harga Beli</th>
							<th >Debit</th>
							<th >Kredit</th>
							
						</tr>
					</thead>
					<tbody style="text-align: center;">
						<?php $i=1; ?>
						<?php foreach ($detail as $k): ?>
							
							<tr>
								<td><?= date('d F Y', strtotime($k->tgl)) ?></td>
								<td><?= $k->nm_kategori; ?></td>
								<td><?= $k->satuan; ?></td>
								<td><?= $k->sku; ?></td>
								<td><a href="<?= base_url() ?>match/story_in_out/<?= $k->id_produk ?>" class="font-weight-bold" style="color: #787878;"><u><?= $k->nm_produk; ?> </u></a></td>
								<!-- <td>Rp. <?= number_format($k->harga_modal); ?></td> -->
								<td>Rp. <?= number_format($k->rp_beli); ?></td>	
								<td><?= number_format($k->qty); ?></td>	
								<?php  
								$kredit = $this->db->select('SUM(jumlah) as tot')->get_where('tb_pembelian', array('id_produk' => $k->id_produk, 'tanggal' => $k->tgl))->row();
								?>
								<td><?= $kredit->tot ?></td>
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