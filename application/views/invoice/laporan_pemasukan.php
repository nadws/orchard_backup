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
					<h1 class="m-0 text-dark">Laporan Penjualan</h1>
				</div>
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
						<!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
						<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
					<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>
					<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>
				</div>
			</div>
		</div>
		<div style="margin-top: 40px;"></div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<?php 
			$total = 0;
			?>
			<div class="col-sm-12">
				<!-- <a href="<?= base_url() ?>match/order" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a> -->
				
				<!-- <button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button><br><br> -->
				<div class="card">
				    <div class="card-body">
                            <table class="table" width="100%">
                                <thead class="thead-light" >
                                    <tr >
                                        <th>SERVIS</th>
                                        <th>JUMLAH</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    $total_servis = 0;
                                    ?>
                                    <?php	foreach ($servis as $k): ?>
                                        <?php
                                        $total_servis += $k->total;
                                        ?>
                                        <tr>
                                            <td><?= $k->nm_servis; ?></td>
                                            <td><?= $k->qty; ?></td>
                                            <td>Rp. <?= number_format($k->total); ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot class="bg-secondary text-light">
                                    <tr>
                                        <td colspan="2">TOTAL</td>
                                        <td>Rp. <?= number_format($total_servis); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
						
					</div>
				<!-- test -->
                <div class="card">
				    <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>KATEGORI</th>
                                <th>NAMA PRODUK</th>
                                <th>QTY</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            $ttl = 0;
                            foreach ($penjualan as $k): 
                                $ttl += $k->total;
                                ?>
                                <tr>
                                    <td><?= $k->nm_kategori; ?></td>
                                    <td><?= $k->nm_produk; ?></td>
                                    <td><?= number_format($k->jumlah, 0) ?></td>
                                    <td><?= number_format($k->total, 0) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot class="bg-secondary text-light">	
                            <tr>	
                                <td colspan="3">TOTAL</td>
                                <td><?= number_format($ttl, 0); ?></td>
                            </tr>
                        </tfoot>
                    </table>
						
					</div>                    

                </div>
			
            </div>


		</div>
	</div>

	<form action="<?= base_url('Match/laporan_pemasukan'); ?>" method="post">
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

				<form action="<?= base_url('Match/summary_laporan_pemasukan'); ?>" method="get">
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
												<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" id="picker2"></td>
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

