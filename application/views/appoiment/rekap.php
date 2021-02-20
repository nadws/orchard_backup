<?php $this->load->view('tema/Header', $title); ?>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Rekap Appointment</h1>
				</div>
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
						<!-- <button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-download"></i> Summary</button> -->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
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
								<th>No</th>
								<th>RESEPSIONIS</th>    
								<th>26</th>
								<th>27</th>
								<th>28</th>
								<th>29</th>
								<th>30</th>
								<th>31</th>
								<?php for ($i=1; $i < 31; $i++) { ?>
									<th><?= $i; ?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody style="text-align: center;">
							<?php
							$i=1;
							foreach ($salon as $k): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $k->nm_kry; ?></td>
									<?php 
									$app = $this->M_salon->rkp_app();
									foreach ($app as $a) { ?>
										<?php if ($a->nm_app == $k->nm_kry): ?>
											<td><?= $a->qty; ?></td>
										<?php endif ?>
									<?php } ?>
								</tr>
								<?php $i++; endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- ======================================================== conten ======================================================= -->
		<!-- ======================================================== conten ======================================================= -->



		<?php $this->load->view('tema/Footer'); ?>