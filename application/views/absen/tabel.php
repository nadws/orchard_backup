<?php 
$this->load->view('tema/Header', $title); 

?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Absen Orchard - <?= date('D, d-M-y', strtotime($today)) ?></h1>
				</div>
				<div class="col-sm-6">

				</div>
			</div>
		</div>
		<div class="container">
			<?php if ($this->session->userdata('id_role')=="3"): ?>
				<?php else: ?>
				<br>
					<a href="<?= base_url() ?>match/absen2" class="btn btn-success"><i class="fa fa-edit"></i> Add / Edit</a>
					<a href="<?= base_url() ?>match/absen3" class="btn btn-info"><i class="fa fa-share-square"></i> Detail</a>
				<?php endif ?>
				<a href="#" data-toggle="modal" data-target="#view" class="btn btn-success"><i class="fas fa-calendar-week"></i> View</a>

				<br><br>
				<div class="row mb-2">
					<div class="col-md-8">
						<?= $this->session->flashdata('message'); ?>
						<table id="example2" class="table table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<th>NAMA</th>
									<th>M</th>
									<th>E</th>
									<th>SP</th>
									<th>OFF</th>
								</thead>
								<?php 
								date_default_timezone_set('Asia/Makassar');
								?>
								<tbody>
									<?php foreach ($anak as $key => $value): ?>
										<form method="post" action="<?= base_url('match/input_absen');?>">
											<tr>
												<td><?= $value->nm_kry ?></td>
												<?php 
												$ac = $this->db->get_where("tb_absen where nm_karyawan = '$value->nm_kry' and tgl = '$today' ")->row();
												?>
												<?php foreach ($komisi as $km): ?>
													<?php if (!empty($ac)): ?>
														<?php if ($ac->ket == $km->tipe): ?>
															<td><a href="<?= base_url("match/drop_absen3/").$ac->id_absen.'/'.$today; ?>" class="btn btn-danger"><?= $km->tipe; ?></a></td>
															<?php else: ?>
																<td><a href="<?= base_url("match/update_absen3/").$ac->id_absen.'/'.$km->tipe.'/'.$today; ?>" class="btn btn-secondary"><?= $km->tipe; ?></a></td>
															<?php endif ?>
															<?php else: ?>

																<td><a href="<?= base_url("match/input_absen3/").$value->nm_kry.'/'.$km->tipe.'/'.$today; ?>" class="btn btn-secondary"><?= $km->tipe; ?></a></td>


															<?php endif ?>
														<?php endforeach ?>
													</tr>
												<?php endforeach ?>
											</form>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<form method="get" action="">
					<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Pilih Tanggal</label>
                                    <input type="date" class="form-control" name="tgl">
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Search</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>

					<!-- ======================================================== conten ======================================================= -->




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