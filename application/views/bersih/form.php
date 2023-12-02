<?php $this->load->view('tema/Header', $title); ?>


<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Clear-Data Ber-Skala</h1>
				</div>
				<div class="col-sm-6">
					
				</div>
			</div>
		</div>

		<div class="row">
			<div class="card-header">
				<div class="col-8">
					<?= $this->session->flashdata('message'); ?>
					<form action="<?= base_url('Match/trash2'); ?>" method="post">

                        <div class="form-group">
                            <label for="list_kategori">DB</label>
                            <select  name="db[]" id="list_kategori" class="form-control select" multiple="multiple" required>
								<option value="tb_appoiment|tgl"> App </option>
								<option value="tb_cancel|tgl"> Cancel </option>
								<option value="tb_order|tanggal"> Appointment </option>
								<option value="tb_terapis|tanggal"> Therapist </option>
								<option value="ctt_denda|tanggal"> Denda </option>
								<option value="ctt_kasbon|tanggal"> Kasbon </option>
								<option value="ctt_tips|tanggal"> Tips </option>
								<option value="tb_komisi_app|tgl"> Komisi Appointment </option>
								<option value="komisi|tgl"> Komisi Penjualan </option>
								<option value="tb_jurnal|tgl"> Jurnal </option>
								<option value="tb_neraca_saldo|tgl"> Neraca Saldo </option>
																	
							</select>
                        </div>
                    
						<div class="form-group">
						<label for="list_kategori">Tanggal</label>
							<input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="trash">
							<input class="form-control" type="date" value="" id="trash1" name="tgl1" hidden>  
							<input class="form-control" type="date" value="" id="trash2" name="tgl2" hidden> 
						</div>

						<div class="modal-footer justify-content-between">
							<button type="submit" class="btn" style="background:#FFA07A;" onclick="return confirm('Anda Yakin Lanjut ?')">Hapus</button>
						</div>
					</form>
				</div>
				<div class="col-12">
					<p class="text-warning"><strong>PERHATIAN!!!</strong></p>
					<p>Backup data terlebih dahulu sebelum melakukan aksi clear data.</p>
					<p>Terutama untuk data-data penting / entitas kuat pada program.</p>
					<p>Data yang sudah dihapus / clear tidak bisa dikembalikan lagi!</p>
				</div>
			</div>
		</div>
	</div>


	<!-- ======================================================== conten ======================================================= -->



	<?php $this->load->view('tema/Footer'); ?>