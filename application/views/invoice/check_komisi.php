<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<div class="col-sm-8">
					<h3 class="m-0 text-dark">Detail Komisi <?= $karyawan->nm_kry ?> <?= date('d M Y', strtotime($tgl1)) ?> - <?= date('d M Y', strtotime($tgl2)) ?></h3>
				</div>
				<div class="col-md-4">
                <a href="<?= base_url() ?>Match/print_komisi_perorang?id=<?= $id_kry ?>&tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>" class="btn btn-success float-right ml-2"><i class="fas fa-print"></i> Print</a>
                    <a href="<?= base_url() ?>Match/laporan_komisi?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>" class="btn btn-warning float-right">Kembali</a>
                </div>
			</div>
		</div>
		<div style="margin-top: 40px;"></div>
		<div class="row">
			<div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Detail Penjualan Produk</h3>
                    </div>    
                    <div class="card-body">
                    
						<div class="table-responsive">
							<table id="example1" class="table">
								<thead>
									<tr>
										<th>Tanggal.</th>
										<th>Produk</th>										
                                        <th>Therapist</th>
										<th>Qty</th>
                                        <th>Harga</th>
										<th>Total</th>
                                        <th>Komisi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($komisi_pembelian as $kp): ?>
										<tr>
											<td><?= date('d M Y', strtotime($kp->tgl)) ?></td>
                                            <td><?= $kp->nm_produk ?></td>
                                            
                                            <td><?= $kp->nm_karyawan ?></td>
											<td><?= $kp->jumlah ?></td>
                                            <td><?= number_format( $kp->harga,0) ?></td>
											<td><?= number_format( $kp->total,0) ?></td>
											
                                            <td><?= number_format($kp->komisi,0) ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>    
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Detail Pengerjaan Service</h3>
                    </div>    
                    <div class="card-body">
                    
						<div class="table-responsive">
							<table id="example3" class="table">
								<thead>
									<tr>
										<th>Tanggal.</th>
										<th>Service</th>
										<th>Therapist</th>
										<th>Qty</th>                                        
                                        <th>Harga</th>
										<th>Total</th>
                                        <th>Komisi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($komisi_app as $ka): ?>
										<tr>
											<td><?= date('d M Y', strtotime($ka->tgl)) ?></td>
                                            <td><?= $ka->nm_servis ?></td>
											<td><?= $ka->nm_karyawan ?></td>
                                            <td><?= $ka->qty ?></td>                                            
                                            <td><?= number_format( $ka->biaya,0) ?></td>
											<td><?= number_format( $ka->total,0) ?></td>
                                            <td><?= number_format($ka->komisi,0) ?></td>
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

	<form action="<?= base_url('Match/print_komisi_perorang'); ?>" method="post">
					<div class="modal fade" id="modal-print">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background:#FFA07A;">
									<h4 class="modal-title">View Data</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
                                <input type="hidden" name="tgl1" value="<?= $tgl1 ?>">
                                <input type="hidden" name="tgl2" value="<?= $tgl2 ?>">
                                <input type="hidden" name="id_kry" value="<?= $id_kry ?>">
									<div class="form-group">
										<table>
											<tr>
												<td ><label for="">Tanggal</label></td>
												<td>:</td>
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>"  id="picker"></td>
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

				<!-- <form action="<?= base_url('Match/summary_penjualan_produk'); ?>" method="post">
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

										<input class="form-control" type="date" value="" id="tanggal3" name="tgl_list_penjualan1" hidden>  
										<input class="form-control" type="date" value="" id="tanggal4" name="tgl_list_penjualan2" hidden> 
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn" style="background:#FFA07A;">Lanjutkan</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form> -->

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

