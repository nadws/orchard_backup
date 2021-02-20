
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="col-lg-12">
				<div class="row mb-2 justify-content-center">

				</div><!-- /.col -->

				<!-- /.col -->
			</div><!-- /.row -->
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">

						<form action="<?= base_url('report/laporan3'); ?>" target="_blank" method="post" class="form-inline">
							<div class="form-group">

								<label for="">TANGGAL &nbsp;&nbsp;: &nbsp;&nbsp;</label>&nbsp;&nbsp;
								<input class="form-control" width="200px;" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker3">
								<input class="form-control" type="date" value="" id="tanggal9" name="tgl3" hidden>
								<input class="form-control" type="date" value="" id="tanggal10" name="tgl4" hidden>
							</div>&nbsp;&nbsp;
							<button type="submit" class="btn btn-primary" target="_blank">LANJUTKAN</button>
						</form>



					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<center>
							<h3 class="text-center mt-3">REPORT CABUT</h3>
							<a href="<?php echo base_url('report/laporan4/') . $tgl1 . '/' . $tgl2  ?>" class="no_print btn btn-success" target="_blank"><i class="fas fa-file-excel"></i> Export Excel</a>
							<a href="<?php echo base_url('report/laporan4/') . $tgl1 . '/' . $tgl2  ?>" class="no_print btn btn-info" target="_blank"><i class="fas fa-share-square"></i> Detail</a>
							<br><br>
							<table width="100%" class="table table-striped table-bordered mt-2">
								<thead>
									<tr>
										<td colspan="3" align="center"><strong>from <?= date('d.M.y', strtotime($tgl1)); ?> to <?= date('d.M.y', strtotime($tgl2)); ?></strong></td>
									</tr>
								</thead>
								<thead>
									<tr>
										<th class="text-center" style="background-color: yellow; font-size:19px;">GR AWAL</th>
										<th class="text-center" style="background-color: yellow; font-size:19px;">GR AKHIR</th>
									</tr>
								</thead>
								<?php
								$tot1= 0;
								$tot2= 0;
								foreach ($isi as $i) :
									$tot1 += $i->gram4;
									$tot2 += $i->gram5;
									?>
								<?php endforeach ?>
								<thead>
									<tr>
										<th class="text-center" style="background-color: green; color:#fff; font-size:21px;"><?= number_format($tot1, 0) ?></th>
										<th class="text-center" style="background-color: green; color:#fff; font-size:21px;"><?= number_format($tot2, 0) ?></th>

									</tr>
								</thead>
								<!--<tbody>-->
									<!--       <?php foreach ($isi as $k) :?>-->
									<!--    <tr>-->
										<!--         <td align="center"><?= $k->gram4 ?></td>-->
										<!--         <td align="center"><?= $k->gram5 ?></td>-->

										<!--       </tr>-->
										<!--         <?php endforeach ?>-->
										<!--</tbody>-->
									</table>
								</center>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<center>
									<h3 class="text-center mt-3">REPORT CETAK</h3>
									<a href="<?php echo base_url('report/laporan4/') . $tgl1 . '/' . $tgl2  ?>" class="no_print btn btn-success" target="_blank"><i class="fas fa-file-excel"></i> Export Excel</a>
									<a href="<?php echo base_url('report/laporan4/') . $tgl1 . '/' . $tgl2  ?>" class="no_print btn btn-info" target="_blank"><i class="fas fa-share-square"></i> Detail</a>
									<br><br>
									<table width="100%" class="table table-striped table-bordered mt-2">
										<thead>
											<tr>
												<td colspan="3" align="center"><strong>from <?= date('d.M.y', strtotime($tgl1)); ?> to <?= date('d.M.y', strtotime($tgl2)); ?></strong></td>
											</tr>
										</thead>
										<thead>
											<tr>
												<th class="text-center" style="background-color: yellow; font-size:19px;">GR AWAL</th>
												<th class="text-center" style="background-color: yellow; font-size:19px;">GR AKHIR</th>
											</tr>
										</thead>
										<?php
										$tot1= 0;
										$tot2= 0;
										foreach ($isi as $i) :
											$tot1 += $i->gram4;
											$tot2 += $i->gram5;
											?>
										<?php endforeach ?>
										<thead>
											<tr>
												<th class="text-center" style="background-color: green; color:#fff; font-size:21px;"><?= number_format($tot1, 0) ?></th>
												<th class="text-center" style="background-color: green; color:#fff; font-size:21px;"><?= number_format($tot2, 0) ?></th>

											</tr>
										</thead>
										<!--<tbody>-->
											<!--       <?php foreach ($isi as $k) :?>-->
											<!--    <tr>-->
												<!--         <td align="center"><?= $k->gram4 ?></td>-->
												<!--         <td align="center"><?= $k->gram5 ?></td>-->

												<!--       </tr>-->
												<!--         <?php endforeach ?>-->
												<!--</tbody>-->
											</table>
										</center>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card">
									<div class="card-body">
										<center>
											<h3 class="text-center mt-3">REPORT SORTIR</h3>
											<a href="<?php echo base_url('report/laporan4/') . $tgl1 . '/' . $tgl2  ?>" class="no_print btn btn-success" target="_blank"><i class="fas fa-file-excel"></i> Export Excel</a>
											<a href="<?php echo base_url('report/laporan4/') . $tgl1 . '/' . $tgl2  ?>" class="no_print btn btn-info" target="_blank"><i class="fas fa-share-square"></i> Detail</a>
											<br><br>
											<table width="100%" class="table table-striped table-bordered mt-2">
												<thead>
													<tr>
														<td colspan="3" align="center"><strong>from <?= date('d.M.y', strtotime($tgl1)); ?> to <?= date('d.M.y', strtotime($tgl2)); ?></strong></td>
													</tr>
												</thead>
												<thead>
													<tr>
														<th class="text-center" style="background-color: yellow; font-size:19px;">GR AWAL</th>
														<th class="text-center" style="background-color: yellow; font-size:19px;">GR AKHIR</th>
													</tr>
												</thead>
												<?php
												$tot1= 0;
												$tot2= 0;
												foreach ($isi as $i) :
													$tot1 += $i->gram4;
													$tot2 += $i->gram5;
													?>
												<?php endforeach ?>
												<thead>
													<tr>
														<th class="text-center" style="background-color: green; color:#fff; font-size:21px;"><?= number_format($tot1, 0) ?></th>
														<th class="text-center" style="background-color: green; color:#fff; font-size:21px;"><?= number_format($tot2, 0) ?></th>

													</tr>
												</thead>
												<!--<tbody>-->
													<!--       <?php foreach ($isi as $k) :?>-->
													<!--    <tr>-->
														<!--         <td align="center"><?= $k->gram4 ?></td>-->
														<!--         <td align="center"><?= $k->gram5 ?></td>-->

														<!--       </tr>-->
														<!--         <?php endforeach ?>-->
														<!--</tbody>-->
													</table>
												</center>
											</div>
										</div>
									</div>
								</div>
							</div>


							<!-- ======================================================== conten ======================================================= -->
							<form action="<?= base_url('gaji/laporan'); ?>" target="_blank" method="post">
								<div class="modal fade" id="modal-summary">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-info">
												<h4 class="modal-title">Export Nota</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<table>
														<tr>
															<td><label for="">Tanggal</label></td>
															<td>:</td>
															<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker2"></td>
														</tr>
													</table>
													<input class="form-control" type="date" value="" id="tanggal7" name="tgl3" hidden>
													<input class="form-control" type="date" value="" id="tanggal8" name="tgl4" hidden>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary" target="_blank">Lanjutkan</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<form action="<?= base_url('report/laporan3'); ?>" target="_blank" method="post">
								<div class="modal fade" id="modal-summary2">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-info">
												<h4 class="modal-title">Export Nota</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<table>
														<tr>
															<td><label for="">Tanggal</label></td>
															<td>:</td>
															<td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker3"></td>
														</tr>

													</table>

													<input class="form-control" type="date" value="" id="tanggal9" name="tgl3" hidden>
													<input class="form-control" type="date" value="" id="tanggal10" name="tgl4" hidden>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary" target="_blank">Lanjutkan</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>