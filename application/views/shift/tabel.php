<?php $this->load->view('tema/Header', $title); ?>
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Anak Laki</h1>
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
								<th>JENIS</th>
								<th>KETERANGAN</th>
								<th>KATEGORI</th>
								<th>KOMISI</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<?php if ($this->session->userdata('e_grade')=='1'): ?>
							<thead style="background-color: white;">
								<form action="<?= base_url("Match/input_shift") ?>" method="POST">
									<tr>
										<td></td>
										<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="jenis" placeholder="Jenis Shift"></td>
										<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="ket" placeholder="Keterangan"></td>
										<td>
											<select style="border:none; border-bottom: solid;" class="form-control" name="kategori">
												<option value="HARIAN">HARIAN</option>
												<option value="LEMBUR">LEMBUR</option>
												<option value="NGINAP">NGINAP</option>
											</select>
										</td>
										<td><input style="border:none; border-bottom: solid;" class="form-control" type="number" name="komisi" placeholder="Rp ......"></td>
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
							foreach ($shift as $k): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $k->jenis; ?></td>
									<td><?= $k->ket ?></td>
									<td><?= $k->kategori ?></td>
									<td><?= number_format($k->komisi, 0) ?></td>
									<td>
										<?php if ($this->session->userdata('e_grade')=='1'): ?>
											<a href="" data-toggle="modal" data-target="#modaledit<?= $k->id_shift ?>"><div class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></div></a> &nbsp;
											<a onclick="return confirm('Yakin Hapus?')" href="<?= base_url('Match/drop_shift/').$k->id_shift; ?>"><div class="btn btn-danger btn-sm tombolhps" ><i class="fas fa-trash"></i></div></a>
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

		<?php foreach ($shift  as $d): ?>
			<form action="<?= base_url('Match/update_shift'); ?>" method="post">
				<div class="modal fade" id="modaledit<?= $d->id_shift ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-green">
								<h4 class="modal-title">Update Data</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group" style="font-size: 20px;">
									<input type="hidden" name="id_shift" value="<?=  $d->id_shift ?>">
									<label>Jenis</label>
									<input style="border:none; border-bottom: solid;" class="form-control" type="text" name="jenis" value="<?=  $d->jenis ?>"><hr>
									<label>Ket</label>
									<input style="border:none; border-bottom: solid;" class="form-control" type="text" name="ket" value="<?=  $d->ket ?>"><hr>
									<label>Ket</label>
									<select style="border:none; border-bottom: solid;" class="form-control" name="kategori">
										<option value="<?= $d->kategori ?>"><?= $d->kategori ?></option>
										<option value="HARIAN">HARIAN</option>
										<option value="LEMBUR">LEMBUR</option>
										<option value="NGINAP">NGINAP</option>
									</select><hr>
									<label>Komisi</label>
									<input style="border:none; border-bottom: solid;" class="form-control" type="number" name="komisi" placeholder="Rp ......"><hr>
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