<?php $this->load->view('tema/Header', $title); ?>
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Pemakai</h1>
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
								<th>LOKASI</th>
								<th>KETERANGAN</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<?php if ($this->session->userdata('i_grade')=='1'): ?>
							<thead style="background-color: white;"> 
								<form action="<?= base_url("Match/input_loc") ?>" method="POST">
									<tr>
										<td></td>
										<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="lokasi" placeholder="Masukkan Lokasi"></td>
										<td><input style="border:none; border-bottom: solid;" class="form-control" type="ket" name="ket"></td>
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
							foreach ($lokasi as $k): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $k->lokasi; ?></td>
									<td><?= $k->ket ?></td>
									<td>
										<?php if ($this->session->userdata('i_grade')=='1'): ?>
											<a href="" data-toggle="modal" data-target="#modaledit<?= $k->id_loc ?>"><div class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></div></a> &nbsp;
											<a onclick="return confirm('Yakin Hapus?')" href="<?= base_url('Match/drop_loc/').$k->id_loc; ?>"><div class="btn btn-danger btn-sm tombolhps" ><i class="fas fa-trash"></i></div></a>
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

		<?php foreach ($lokasi  as $d): ?>
			<form action="<?= base_url('Match/update_loc'); ?>" method="post">
				<div class="modal fade" id="modaledit<?= $d->id_loc ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-green">
								<h4 class="modal-title">Update Harga</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group" style="font-size: 20px;">
									<input type="hidden" name="id_loc" value="<?=  $d->id_loc ?>">
									<label>Lokasi</label><br>
									<input style="border:none; border-bottom: solid;" class="form-control" type="text" name="lokasi" value="<?=  $d->lokasi ?>"><hr>
									<label>Ket</label><br>
									<input style="border:none; border-bottom: solid;" class="form-control" type="text" name="ket" value="<?=  $d->ket ?>"><hr>
								</div>
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Lanjutkan</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		<?php endforeach ?>

		<!-- ======================================================== conten ======================================================= -->



		<?php $this->load->view('tema/Footer'); ?>