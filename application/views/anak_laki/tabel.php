<?php $this->load->view('tema/Header', $title); ?>
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<div class="col-lg-8">
				<div class="card">
					<div class="card-header">
						<h5 class="float-left">Data Karyawan</h5>
						<a href="" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#plus"><i class="fas fa-plus"></i> Karyawan</a>
					</div>
					<div class="card-body">
						<table id="tb_akun" class="table" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA</th>
									<th>Tanggal Masuk</th>
									<th>Posisi</th>
									<th>Tipe</th>
									<th>AKSI</th>
								</tr>
							</thead>
							<tbody style="text-align: center;">
								<?php
								$i = 1;
								foreach ($karyawan as $k) :
									$tgl_masuk    = new DateTime($k->tgl_masuk);
									$today        = new DateTime();
									$lama_kerja = $today->diff($tgl_masuk);
								?>
									<tr>
										<td><?= $i; ?></td>
										<td><?= $k->nm_kry; ?></td>
										<td><?= date('d-M-Y', strtotime($k->tgl_masuk)); ?> (<?= $lama_kerja->y ?> Tahun)</td>
										<td><?= $k->posisi ?></td>
										<td><?= $k->nm_tipe ?></td>
										<td>
											<?php if ($this->session->userdata('input') == '1') : ?>
												<a href="#" data-toggle="modal" data-target="#modaledit" class="btn edit btn-warning btn-sm" id_karyawan="<?= $k->id_kry ?>">
													<i class="fas fa-edit"></i>
												</a>
												<a onclick="return confirm('Yakin Hapus?')" href="<?= base_url('Match/drop_kry/') . $k->id_kry; ?>">
													<div class="btn btn-danger btn-sm tombolhps"><i class="fas fa-trash"></i></div>
												</a>
											<?php endif ?>
										</td>
									</tr>
								<?php $i++;
								endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>


		</div>
	</div>


</div>

<form action="<?= base_url("Match/tambah_karywan_new") ?>" method="post">
	<div class="modal fade" id="plus" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background: #FFA07A;">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-4">
							<label for="">Tanggal Masuk</label>
							<input type="date" class="form-control" name="tgl">
						</div>
						<div class="col-lg-4">
							<label for="">Nama</label>
							<input type="text" class="form-control " name="nama">
						</div>
						<div class="col-lg-4">
							<label for="">Posisi</label>
							<select name="id_posisi" class="form-control select2">
								<option value="0">-Pilih Posisi-</option>
								<?php foreach ($posisi as $p) : ?>
									<option value="<?= $p->id_posisi ?>"><?= $p->posisi ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit/Save</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form action="<?= base_url("Match/edit_karywan_new") ?>" method="post">
	<div class="modal fade" id="modaledit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background: #FFA07A;">
					<h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="get_edit"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit/Save</button>
				</div>
			</div>
		</div>
	</div>
</form>


<!-- ======================================================== conten ======================================================= -->



<!-- ======================================================== conten ======================================================= -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
	$(document).ready(function() {
		$(document).on('click', '.edit', function() {
			var id_karyawan = $(this).attr('id_karyawan');
			$.ajax({
				method: "GET",
				url: "<?= base_url('Match/get_edit_karywan') ?>?id_karyawan=" + id_karyawan,
				dataType: "html",
				success: function(hasil) {
					$('#get_edit').html(hasil);
				}
			});

		});
	});
</script>



<?php $this->load->view('tema/Footer'); ?>