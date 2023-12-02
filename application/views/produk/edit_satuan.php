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
					<h1 class="m-0 text-dark">Record Satuan</h1>
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
				<div class="col-md-6">

					<table id="example1" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th>NAMA SATUAN</th>
								<th width="10%">AKSI</th>
							</tr>
						</thead>
						<thead style="background-color: white;">
                            <form action="<?= base_url("Match/update_satuan") ?>" method="POST">
                            <input type="hidden" name="id_satuan" value="<?= $satuan->id_satuan; ?>">
								<tr>
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" placeholder="Ubah nama satuan" name="satuan" value="<?= $satuan->satuan; ?>" required></td>
									<td>
										<button type="submit" class="btn btn-primary btn-sm">Update</button>
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