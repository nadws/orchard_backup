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
					<h4 class="m-0 text-dark">Daftar Komisi <?= date('d-M-Y', strtotime($tgl1)) ?> - <?= date('d-M-Y', strtotime($tgl2)) ?> </h4>
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
		<div style="margin-top: 40px;"></div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<?php 
			// $cart =	$this->cart->contents(); 
			$total = 0;
			?>
			<div class="col-sm-12">
				<!-- <a href="<?= base_url() ?>match/order" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a> -->
				<!-- <button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>
				<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>
				<button data-toggle="modal" data-target="#modal-excel" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button> -->
				<a href="<?= base_url() ?>Laporan/laporan_target?tgl1=<?= date('Y-m-01') ?>&tgl2=<?= date('Y-m-10') ?>" class="btn btn-info mb-2"><i class="fas fa-search"></i> 10</a>
                <a href="<?= base_url() ?>Laporan/laporan_target?tgl1=<?= date('Y-m-01') ?>&tgl2=<?= date('Y-m-20') ?>" class="btn btn-info mb-2"><i class="fas fa-search"></i> 20</a>
				<br>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table">
								<thead>
									<tr>
										<th>NO</th>
										<th>NAMA</th>
										<th>KOMISI SERVICE</th>
										<th>KOMISI PRODUCT</th>
									
                                        <th>TOTAL KOMISI</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($komisi as $key => $value): ?>
									<?php
										$names = ['T1', 'T2', 'T3','T4','T5','T6','T7','T8','T9','T10'];
										 if(in_array($value->nm_kry,$names)){
											 continue;
										 } ?>
										<tr>
											<td><?= $key+1 ?></td>
                                            <td><?= $value->nm_kry ?></td>
                                            <td>Rp. <?= number_format($value->total_app) ?></td>
                                            <td>Rp. <?= number_format($value->total_produk) ?></td>
                                            
											<td>Rp. <?= number_format($value->total_produk + $value->total_app ) ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="<?= base_url('Match/laporan_komisi'); ?>" method="get">
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
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" id="picker"></td>
											</tr>
										</table>

										<input class="form-control" type="date"  id="tanggal1" name="tgl1" hidden>  
										<input class="form-control" type="date"  id="tanggal2" name="tgl2" hidden> 
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

				<form action="<?= base_url('Match/summary_laporan_komisi'); ?>" method="post">
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
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker2"></td>
											</tr>
										</table>

										<input class="form-control" type="date" value="" id="tanggal3" name="tgl3" hidden>  
										<input class="form-control" type="date" value="" id="tanggal4" name="tgl4" hidden> 
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

				<form action="<?= base_url('Match/excel_komisi'); ?>" method="post">
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
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" id="picker_excel"></td>
											</tr>
										</table>

										<input class="form-control" type="date"  id="tgl1" name="tgl1" hidden>  
										<input class="form-control" type="date"  id="tgl2" name="tgl2" hidden> 
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

