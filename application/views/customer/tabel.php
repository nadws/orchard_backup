<?php 
$this->load->view('tema/Header', $title); 
$today = date('Y-m-d');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Record Customer</h1>
				</div>
				<div class="col-sm-6">
					<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
				</div>
			</div>
		</div><br>
		<div class="row">
		    <div class="col-md-12">
<form action="<?= base_url() ?>Match/f_customer" class="form-inline" method="get">
  <div class="form-group col-sm-1">
   Urutkan :
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Password</label>
    <select name="abj" class="form-control">
        <option value="">- Pilih Abjad -</option>
        <option value="semua">Semua</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
        <option value="I">I</option>
        <option value="J">J</option>
        <option value="K">K</option>
        <option value="L">L</option>
        <option value="M">M</option>
        <option value="N">N</option>
        <option value="O">O</option>
        <option value="P">P</option>
        <option value="Q">Q</option>
        <option value="R">R</option>
        <option value="S">S</option>
        <option value="T">T</option>
        <option value="U">U</option>
        <option value="V">V</option>
        <option value="W">W</option>
        <option value="X">X</option>
        <option value="Y">Y</option>
        <option value="Z">Z</option>
    </select>
  </div>
  <button type="submit" class="btn btn-warning mb-2" style="background:#FFA07A;border-color:#FFA07A;"> Submit</button>
</form><br>
			<table class="table" id="example1">
				<thead>
					<tr>
						<th>No. </th>
						<th>Nama Lengkap</th>
						<th>Tgl. Lahir</th>
						<th>Email</th>
						<th>No. Telp</th>
						<th>Alamat Lengkap</th>
						<th width="5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<form action="<?= base_url() ?>match/add_customer" method="post">
							<td>#</td>
							<td>
								<input type="text" class="form-control" name="nama" placeholder="Isi Nama" required="">
							</td>
							<td>
								<input type="date" class="form-control" name="tgl_lahir" required="">
							</td>
								<td>
							    <input type="email" class="form-control" name="email" placeholder="Email">
							</td>
							<td>
							    <input type="number" class="form-control" name="telp" placeholder="Cth : 081212345678" required="">
							</td>
							
							<td>
								<input type="text" class="form-control" name="alamat" placeholder="Alamat">
							</td>
							<td>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</td>
						</form>
					</tr>
					<?php foreach ($data as $key => $value): ?>
						<tr>
							<td width="4%"><?= $key+1 ?></td>
							<td width="17%"><?= $value->nama ?></td>
							<td width="14%"><?=  date('D, d-M-y', strtotime($value->tanggal_lahir)) ?></td>
								<td><?= $value->email ?></td>
							<td width="17%">
							    <?php if (empty($value->telepon)): ?>
                                    -
                                    <?php else: ?>
                                    <?= $value->telepon ?>
                                <?php endif ?>
							    
							    </td>
							<td><?= $value->alamat ?></td>
							<td width="12%">
								<a href="<?= base_url() ?>match/edit_cus/<?= $value->id_customer ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
								<a href="<?= base_url() ?>match/del_customer/<?= $value->id_customer ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<form action="<?= base_url('Match/summary_cancel'); ?>" method="post">
		<div class="modal fade" id="modal-summary">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background:#FFA07A;">
						<h4 class="modal-title">Export Summary</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<table>
								<tr>
									<td ><label for="">Nama Customer</label></td>
									<td>:</td>
									<td>
										<select name="nama" id="" class="form-control select2" required="">
											<option value="">- Pilih Customer -</option>
											<?php foreach ($summary as $key => $value): ?>
												<option value="<?= $value->nama ?>"><?= $value->nama ?></option>
											<?php endforeach ?>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn" style="background:#FFA07A;">Lanjutkan</button>
						</div>
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
	
	<div style="margin-top:20px;"></div>

	<?php $this->load->view('tema/Footer'); ?>