<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<div class="col-sm-12">
					<h1 class="m-0 text-dark">Data Diskon Servis</h1>
				</div>
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
						<!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
						<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
				</div>
				<!-- <div class="col-5 mt-2">
					<a href="<?= base_url('match/order'); ?>" class="btn btn-warning">Kembali</a>
				</div> -->
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-6">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<div class="col-8">
				<div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Input
                        </button>   
                    </div>
                        <?php $i=1; ?>
                        
                    <div class="card-body">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <!-- <th>Tanggal</th> -->
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($diskon as $d) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <!-- <td><?= date('d-m-y', strtotime($d->tgl)) ?></td> -->
                                    <?php if($d->jenis == 1) : ?>
                                    <td>Rp</td>
                                    <td>Rp. <?= number_format($d->jumlah,0) ?></td>
                                    <?php else : ?>
                                    <td>Persen</td>
                                    <td><?= $d->jumlah ?>%</td>
                                    <?php endif; ?>
                                    <td>
									    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $d->id_diskon ?>"><i class="fa fa-edit"></i></button>
									    <a href="<?= base_url() ?>match/drop_diskon_servis/<?= $d->id_diskon ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
									</td>

                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                        </table>        
					</div>        
                                    

                    </div>
					
				</div>					
			</div>
			
			
		</div>
	</div>


    <!-- Modal -->
<form action="<?= base_url() ?>match/add_diskon_servis" method="post">
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Input Diskon Servis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                                                                  

            <div class="form-group pilih-metode">
                <label for="">Jenis Diskon</label>
                <select class="form-control" id="" required="" name="jenis">
                <label for=""></label>
                <option value="1">Rp</option>
                <option value="2">Persen</option>
                </select>
            </div>
            

            <div class="form-group ">
                    <label>Jumlah Diskon</label>
                    <div>
                    <input type="text" name="jumlah" class="form-control" required>
                    </div>
                    <small class="text-warning">Jika jenis rp (cth: 70000)</small>
                    <small class="text-warning">Jika jenis persen (cth: 10)</small>
            </div>
                                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Input</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php foreach($diskon as $ds): ?>

    <form action="<?= base_url() ?>match/edit_diskon_servis" method="post">
        <div class="modal fade" id="edit<?= $ds->id_diskon ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background: #FFA07A;">
                <h5 class="modal-title" id="exampleModalLabel">Edit Diskon Servis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <input type="hidden" name="id_diskon" value="<?= $ds->id_diskon ?>">
                                                                          

                    <div class="form-group pilih-metode">
                        <label for="">Jenis Diskon</label>
                        <select class="form-control" id="" required="" name="jenis">
                        <?php if($ds->jenis == 1): ?>
                        <option value="1" selected>Rp</option>
                        <option value="2">Persen</option>
                        <?php else: ?>
                        <option value="1">Rp</option>
                        <option value="2" selected>Persen</option>
                        <?php endif; ?>
                        </select>
                    </div>
                    

                    <div class="form-group ">
                            <label>Jumlah Diskon</label>
                            <div>
                            <input type="text" name="jumlah" class="form-control" value="<?= $ds->jumlah ?>">
                            </div>
                            <small class="text-warning">Jika jenis rp (cth: 70000)</small>
                            <small class="text-warning">Jika jenis persen (cth: 10)</small>
                    </div>

                    
                                                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
            </div>
        </div>
        </div>
        </form>

<?php endforeach; ?>



	<style>
		.buying-selling.active {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		#option1
		{
			display: none;
		}

		.buying-selling {
			width: 100%; 
			padding: 10px;
			position: relative;
		}

		.buying-selling-word {
			font-size: 15px;
			font-weight: 600;
			margin-left: 35px;
		}

		.radio-dot:before, .radio-dot:after {
			content: "";
			display: block;
			position: absolute;
			background: #fff;
			border-radius: 100%;
		}

		.radio-dot:before {
			width: 20px;
			height: 20px;
			border: 1px solid #ccc;
			top: 10px;
			left: 16px;
		}

		.radio-dot:after {
			width: 12px;
			height: 12px;
			border-radius: 100%;
			top: 14px;
			left: 20px;
		}

		.buying-selling.active .buying-selling-word {
			color: #fff;
		}

		.buying-selling.active .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		.buying-selling.active .radio-dot:before {
			background: #fff;
			border-color: #699D17;
		}

		.buying-selling:hover .radio-dot:before {
			border-color: #adadad;
		}

		.buying-selling.active:hover .radio-dot:before {
			border-color: #699D17;
		}


		.buying-selling.active .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		.buying-selling:hover .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);
		}

		.buying-selling.active:hover .radio-dot:after {
			background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);

		}

		@media (max-width: 400px) {

			.mobile-br {
				display: none;   
			}

			.buying-selling {
				width: 49%;
				padding: 10px;
				position: relative;
			}

		}
	</style>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
<script src="<?= base_url() ?>asset/time/jquery.skedTape.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/daterangepicker/daterangepicker.js"></script>

<script>

$(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });

	$(document).ready(function(){
		

        });


</script>


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

