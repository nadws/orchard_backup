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
					<h1 class="m-0 text-dark">Extra Time & Request </h1>
				</div>
				<div class="col-sm-6">
					
                        <button data-toggle="modal" data-target="#add" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
						<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>
                        <?php if ($this->session->userdata('id_role') == 1): ?>
						<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>
                        <?php endif; ?>
				</div>
			</div>
		</div>

		<div class="row">

				<div class="col-12">
					<?= $this->session->flashdata('message'); ?>
					<table id="example1" class="table" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>TANGGAL</th>
								<th>SERVICE</th>    
								<th>THERAPIST</th>
								<th>KOMISI</th>
								<th>AKSI</th>
								<th>ADMIN</th>
							</tr>
						</thead>
						
						<tbody style="text-align: center;">
							<?php
							$i=1;
							foreach ($req as $d): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= date('d-M-y',strtotime($d->tgl)) ?></td>
									<td><?= $d->nm_service; ?></td>
									<td><?= $d->nm_kry; ?></td>
									<td><?= number_format($d->komisi, 0) ?></td>
									<td>
                                    <?php if ($this->session->userdata('id_role') != 1 && date('Y-m-d') != $d->tgl): ?>
										
									<?php else: ?>
                                        <a onclick="return confirm('Yakin Hapus?')" href="<?= base_url('Request/drop_request/').$d->kd_gabungan; ?>"><div class="btn btn-danger btn-sm tombolhps" ><i class="fas fa-trash"></i></div></a>
                                    <?php endif; ?>
                                    </td>
									<td><?= $d->admin ?></td>									
								</tr>
								<?php $i++; endforeach ?>
							</tbody>
						</table>
					</div>
				
			</div>
		</div>

		<!-- ======================================================== conten ======================================================= -->
		
        <form action="<?= base_url('Request/add_request'); ?>" method="post">
			<div class="modal fade" id="add">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background:#FFA07A;">
							<h4 class="modal-title">Tambah Data</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input type="date" class="form-control" name="tgl" value="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>

                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Service</label>
                                        <select name="id_service" class="form-control select" required>
                                            <option value="">-Pilih-</option>
                                            <?php foreach($service as $s): ?>
                                            <option value="<?= $s->id_service ?>"><?= $s->nm_service ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Therapist</label>
                                        <select name="id_kry[]" class="form-control select" required multiple="multiple">
                                            <option value="">-Pilih-</option>
                                            <?php foreach($kry as $k): ?>
                                            <option value="<?= $k->id_kry ?>"><?= $k->nm_kry ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>							
						</div>
                        <div class="modal-footer justify-content-between">
								
								<button type="submit" class="bg-primary btn">Save/Edit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
        
        <form action="<?= base_url('Request/summary_request'); ?>" method="get">
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
										<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" id="picker"></td>
									</tr>
								</table>

								<input class="form-control" type="date" value="" id="tanggal1" name="tgl1" hidden>  
								<input class="form-control" type="date" value="" id="tanggal2" name="tgl2" hidden>  
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="bg-pink btn">Lanjutkan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

		<form action="<?= base_url('Request'); ?>" method="get">
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

		<form action="<?= base_url('Match/excel_app'); ?>" method="post">
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
										<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="excel"></td>
									</tr>
								</table>

								<input class="form-control" type="date" value="" id="excel1" name="tgl1" hidden>  
								<input class="form-control" type="date" value="" id="excel2" name="tgl2" hidden> 
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