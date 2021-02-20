<?php $this->load->view('tema/Header', $title); ?>


<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Clear-Data Ber-Skala</h1>
				</div>
				<div class="col-sm-6">
					
				</div>
			</div>
		</div>

		<div class="row">
			<div class="card-header">
				<div class="col-12">
					<?= $this->session->flashdata('message'); ?>
					<form action="<?= base_url('Match/trash2'); ?>" method="post">
						<div class="form-group">
							<table>
								<tr>
									<td ><label for="">Tanggal</label></td>
									<td>:</td>
									<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="trash"></td>
								</tr>
							</table>

							<input class="form-control" type="date" value="" id="trash1" name="tgl1" hidden>  
							<input class="form-control" type="date" value="" id="trash2" name="tgl2" hidden> 
						</div>
						<div class="modal-footer justify-content-between">
							<button type="submit" class="btn" style="background:#FFA07A;" onclick="return confirm('Anda Yakin Lanjut ?')">Hapus</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- ======================================================== conten ======================================================= -->



	<?php $this->load->view('tema/Footer'); ?>