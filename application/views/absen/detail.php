<?php 
date_default_timezone_set("Asia/Makassar");
$kalender = CAL_GREGORIAN;
$bulan = date('m');
$bln2  = $bulan - 1;
$bln   = date('m', strtotime($bulan.'-1 month'));
$tahun = date('Y');
$hari  = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$this->load->view('tema/Header', $title); 
$today = date('Y-m-d');
?>

<?php
if ($hari == 28) {
	$cek = $this->db->get_where("tb_tgl where tgl not in ('29','30','31') ")->result();
}elseif ($hari == 29) {
	$cek = $this->db->get_where("tb_tgl where tgl not in ('30','31') ")->result();
}elseif ($hari == 30) {
	$cek = $this->db->get_where("tb_tgl where tgl not in ('31') ")->result();
}elseif ($hari == 31) {
	$cek = $this->db->get("tb_tgl ")->result();
}
$karyawan = $this->db->query("select * from tb_karyawan")->result();

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
					<h1 class="m-0 text-dark">Absen Orchard - <?= date('M') ?></h1>
				</div>
				<div class="col-sm-6">
					
				</div>
			</div>
		</div><br>

		<a href="<?= base_url() ?>match/absen" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
		<br><br>
		<div class="row mb-2">
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
				<table class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th rowspan="2">NAMA</th>
						</tr>
						<tr>
							<?php 
							$dt1 = date('Y-m-31');
							$dt2 = date('Y-m-26');
							$dt3 = date('Y-m-d', strtotime($dt2.'-1 month'));
							?>
							<?php foreach ($cek as $key => $value): ?>
								<th><?= $value->tgl ?></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($karyawan as $kry): ?>
							<tr>
								<td><strong><?= $kry->nm_kry ?></strong></td>
								<?php
								$dt_a = date('Y-m-31');
								$dt_b = date('Y-m-26');
								$dt_c = date('Y-m-d', strtotime($dt_b.'-1 month'));
								$ket = $this->db->get_where(" tb_absen where nm_karyawan = '$kry->nm_kry' and tgl BETWEEN '$dt_c' AND '$dt_a' order by tgl ASC, nm_karyawan ")->result();
								?>
								<?php foreach ($ket as $sp): ?>
									<?php  
									$cek2 = $this->db->get_where(" tb_tgl where tgl = '$sp->tgl' ")->row();
									?>
									<?php if (!empty($cek2)): ?>
										<td style='background-color:red;'> X </td>
										<?php else: ?>
											<?php if ($sp->ket=="OFF"): ?>
												<td style='background-color:#EA6357;'><?= $sp->ket ?></td>
												<?php elseif ($sp->ket=="M"): ?>
												<td style='background-color:#87CCC5;'><?= $sp->ket ?></td>
												<?php elseif ($sp->ket=="E"): ?>
												<td style='background-color:#EECE71;'><?= $sp->ket ?></td>
													<?php else: ?>
														<td style='background-color:#418674;'><?= $sp->ket ?></td>
													<?php endif ?>
												<?php endif ?>
											<?php endforeach ?>
										</tr>

									<?php endforeach ?>
								</tbody> 
							</table>
						</div>
					</div>
					<div class="container">

					</div>
				</div>

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