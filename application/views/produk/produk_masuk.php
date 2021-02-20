<?php $this->load->view('tema/Header'); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Produk Masuk</h1>
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
				<button data-toggle="modal" data-target="#filter_tgl" class="btn btn-success"><i class="fas fa-eye"></i> View</button><br><br>
				<table id="produkmasuk" class="table text-sm" width="100%">
					<thead>
						<tr>
							<th width="8%">#</th>
							<th>KATEGORI</th>
                            <th>NAMA PRODUK</th>
                            <th>JUMLAH</th>    
							<th>HARGA BELI</th>
                            <th>HARGA JUAL</th>
                            <th>TANGGAL</th>
                            <th>AKSI</th>
						</tr>
					</thead>
					<thead style="background-color: white;">
                        <form action="<?= base_url("Match/add_produk_masuk") ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?>">
							<tr>
							<td colspan="2">
									<select  style="border:none; border-bottom: solid;" name="id_kategori" id="list_kategori" class="form-control" required>
										<option value="">- Pilih kategori -</option>
										<?php foreach ($kategori as $kategori): ?>
											<option value="<?= $kategori->id_kategori ?>"><?= $kategori->nm_kategori ?></option>
										<?php endforeach ?>
									</select>
                                </td>
								<td>
									<select  style="border:none; border-bottom: solid;" name="id_produk" class="form-control" id="list_produk" required>
										<option value="">- Pilih Produk -</option>
									</select>
                                </td>
                                <td><input style="border:none; border-bottom: solid;" class="form-control" type="number" placeholder="Jumlah" name="jumlah" required></td>
								<td><input style="border:none; border-bottom: solid;" class="form-control" type="number" placeholder="Harga Beli" name="hrg_beli" required></td>
								<td><input style="border:none; border-bottom: solid;" class="form-control" type="number" placeholder="Harga Jual" name="hrg_jual" required></td>
                                <!-- <td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="tgl" value="<?= date('Y-m-d'); ?>" required></td> -->
                                <td><p><?= date('Y-m-d'); ?></p></td>
								<td>
									<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
								</td>
							</tr>
						</form>
					</thead>
					<tbody style="text-align: center;">
					<?php $i=1; ?>
						<?php foreach ($produk_masuk as $k): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $k->nm_kategori; ?> </td>
                                <td><?= $k->nm_produk; ?> </td>
                                <td><?= $k->jumlah; ?> </td>
                                <td>Rp. <?= number_format($k->hrg_beli); ?></td>
                                <td>Rp. <?= number_format($k->hrg_jual); ?></td>
                                <td><?= $k->tgl; ?> </td>
									<td>
										<a href="<?= base_url() ?>match/edit_produk_masuk/<?= $k->id ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
										<a href="<?= base_url() ?>match/drop_produk_masuk/<?= $k->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<form action="<?= base_url('Match/produk_masuk'); ?>" method="post">
					<div class="modal fade" id="filter_tgl">
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
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker"></td>
											</tr>
										</table>

										<input class="form-control" type="date" value="" id="tanggal1" name="tgl1" hidden>  
										<input class="form-control" type="date" value="" id="tanggal2" name="tgl2" hidden> 
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