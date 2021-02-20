<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>
<datalist id="data_mahasiswa">
	<?php foreach ($anak->result() as $b)
	{
		echo "<option value='$b->nm_kry'>$b->id_kry</option>";
	}
	?>
</datalist>
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Form Edit Tips</h1>
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
					<table class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>TANGGAL</th>
								<th>NAMA</th>    
								<th>NOMINAL</th>
								<th>AKSES</th>
							</tr>
						</thead>
						<thead style="background-color: white;">
							<form action="<?= base_url("Match/update_tips") ?>" method="POST">
								<tr>
									<input type="hidden" name="id_tips" value="<?= $id_tips ?>">
									<input type="hidden" name="id_kry_2" id="id_kry" value="<?= $id_kry_2 ?>">
									<td></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="date" name="tanggal" value="<?= $tanggal ?>"></td>
									<td> <input style="border:none; border-bottom: solid;" list="data_mahasiswa" onchange="return autofill_anak();" class="form-control" type="input" name="nm_tips" id="nm_kry" value="<?= $nm_tips ?>" required></td>
									<td><input style="border:none; border-bottom: solid;" class="form-control" type="text" name="nominal" value="<?= $nominal ?>" required></td>								
									<td>
										<button type="submit" class="btn btn-primary btn-sm"><span class="fas fa-check"></span></button>
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