<?php $this->load->view('tema/Header', $title); ?>
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">List Peraturan / Denda</h1>
				</div>
				<div class="col-sm-6">
					<!-- <a href="<?= base_url('Match/e_bumbu'); ?>"><button type="button" class="btn btn-block btn-primary">Export</button></a> -->
					<br>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="card-header">
				<div class="col-12">
					<?= $this->session->flashdata('message'); ?>
					<table id="example2" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama List</th>
								<th>Rupiah</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<?php if ($this->session->userdata('input')=='1'): ?>
							<thead style="background-color: white;">
								<form action="<?= base_url("list_denda/add") ?>" method="POST">
									<tr>
										<td></td>
										<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="nama" placeholder="Masukkan Nama List"></td>
										<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="rupiah" placeholder="Rupiah"></td>
										<td>
											<button type="submit" class="btn btn-primary btn-sm"><span class="fas fa-check"></span></button>
										</td>
									</tr>
								</form>
							</thead>
						<?php endif ?>
						<tbody style="text-align: center;">
							<?php
							$i=1;
							foreach ($list as $k):
							?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $k->nama_list; ?></td>
									<td><?= number_format($k->rupiah,0); ?></td>
									<td>
										<?php if ($this->session->userdata('input')=='1'): ?>
											<!--<a href="" data-toggle="modal" data-target="#modaledit<?= $k->id_list ?>"><div class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></div></a> -->
											<a onclick="return confirm('Yakin Hapus?')" href="<?= base_url('list_denda/hapus/').$k->id_list; ?>"><div class="btn btn-danger btn-sm tombolhps" ><i class="fas fa-trash"></i></div></a>
										<?php endif ?>
									</td>
								</tr>
								<?php $i++; endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>


		<!-- ======================================================== conten ======================================================= -->

		<!--<?php foreach ($laki  as $d): ?>-->
		<!--	<form action="<?= base_url('Match/update_kry'); ?>" method="post">-->
		<!--		<div class="modal fade" id="modaledit<?= $d->id_kry ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
		<!--			<div class="modal-dialog ">-->
		<!--				<div class="modal-content">-->
		<!--					<div class="modal-header" style="background-color: #FFA07A;">-->
		<!--						<h4 class="modal-title">Update Data</h4>-->
		<!--						<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
		<!--							<span aria-hidden="true">&times;</span>-->
		<!--						</button>-->
		<!--					</div>-->
		<!--					<div class="modal-body">-->
		<!--						<div class="form-group">-->
		<!--							<input type="hidden" name="id_kry" value="<?=  $d->id_kry ?>">-->
									
		<!--								<label>Nama</label><br>	-->
		<!--								<input class="form-control" type="text" name="nm_kry" value="<?=  $d->nm_kry ?>">	-->
									
		<!--						</div>-->
		<!--						<div class="form-group">-->
		<!--							<input type="hidden" name="id_kry" value="<?=  $d->id_kry ?>">-->
									
		<!--								<label>Tanggal masuk</label><br>	-->
		<!--								<input class="form-control" type="date" name="tgl_masuk" value="<?=  $d->tgl_masuk ?>">	-->
									
		<!--						</div>-->
		<!--						<div class="modal-footer justify-content-between">-->
		<!--							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
		<!--							<button type="submit" class="btn btn-primary">Lanjutkan</button>-->
		<!--						</div>-->
		<!--					</div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</form>-->
		<!--<?php endforeach ?>-->

		<!-- ======================================================== conten ======================================================= -->



		<?php $this->load->view('tema/Footer'); ?>