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
					<h1 class="m-0 text-dark">Data DP</h1>
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
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<div class="col-12">
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
                                    <th>Tanggal</th>
                                    <th>Tanggal Pakai</th>
                                    <th>KD DP</th>
                                    <th>Customer</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Admin</th>
                                    <th>Status/Print</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($dp as $dp) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= date('d-m-y', strtotime($dp->tgl_dp)) ?></td>
                                    <td class="text-center"><?= $dp->tgl_jam ? date('d-m-y', strtotime($dp->tgl_jam)) : '-' ?></td>
                                    <td><?= $dp->kd_dp ?></td>
                                    <td><?= $dp->nama ?></td>
                                    <td><?= number_format($dp->jumlah_dp,2) ?></td>
                                    <td><?= $dp->metode ?></td>
                                    <td><?= $dp->admin ?></td>
                                    <td class="text-center">
                                    <?php if($dp->status == 2) : ?>
                                    <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                    <?php else: ?>
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i></span>    
                                    <?php endif; ?>
                                    
                                    <a href="<?= base_url('Match/print_dp?kd_dp=') ?><?= $dp->kd_dp ?>" class="btn btn-xs btn-warning"><i class="fas fa-file-invoice"></i></a>
                                    
                                    <?php if($dp->status == 2) : ?>
                                    <?php else: ?>
                                    <?php if ($this->session->userdata('id_role') == '1') : ?>
                                    <a href="<?= base_url('Match/delete_dp?kd_dp=') ?><?= $dp->kd_dp ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    <?php else: ?>
                                    <?php endif ?>
                                    
                                    <?php endif; ?>
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
<form action="<?= base_url() ?>match/add_dp" method="post">
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Input DP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                                        
            

            <div class="form-group pilih-metode">
                <label for="">Customer</label>
                <select class="form-control" id="" required="">
                <label for=""></label>
                <option value="">- Pilih Metode -</option>
                <option value="manual">Input Manual</option>
                <option value="customer">Dari Data Customer</option>
                </select>
            </div>
            <div class="form-group data-customer">
                                        
                <select name="id_customer" id="d_customer" class="form-control data-customer id_customer" disabled>
                    <option value="">- Pilih Customer -</option>
                    <?php foreach ($customer as $key => $value): ?>
                    <option value="<?= $value->id_customer ?>"><?= $value->nama ?></option>
                    <?php endforeach ?>
                </select>
                </div>
                <div class="form-group">
                <input type="text" name="customer" class="form-control manual customer" placeholder="Isi Nama Customer" disabled>
                </div>

            <div class="form-group ">
                    <label>Jumlah DP</label>
                    <div>
                    <input type="text" name="dp" class="form-control" id="mandiri_kredit">
                    </div>
            </div>
                                        
            <div class="form-group">
            <label for="">Metode</label>
                <select name="metode" id="metode" class="form-control" required>
                    <!-- <?php foreach($kas as $k): ?>
                        <option value="<?= $k->id_akun ?>">- <?= $k->nm_akun ?> -</option>
                    <?php endforeach; ?>     -->
                    <option value="Cash">- Cash -</option>
                    <option value="BCA">- BCA -</option>
                    <option value="Mandiri">- Mandiri -</option>
                </select>
            </div>

            <div class="form-group">
            <label for="">Tanggal</label>
            <input type="date" name="tgl_dp" class="form-control" id="tgl_dp" required>
            </div>

            <div class="form-group">
            <label for="">Keterangan</label>
            <input type="text" name="ket" class="form-control" id="ket">
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
		// $('#cash').on('change blur',function(){
		// 	if($(this).val().trim().length === 0){
		// 		$(this).val(0);
		// 	}
		// 	});
		// $('#mandiri_kredit').on('change blur',function(){
		// 	if($(this).val().trim().length === 0){
		// 		$(this).val(0);
		// 	}
		// 	});
		// $('#mandiri_debit').on('change blur',function(){
		// 	if($(this).val().trim().length === 0){
		// 		$(this).val(0);
		// 	}
		// 	});
		// $('#bca_kredit').on('change blur',function(){
		// 	if($(this).val().trim().length === 0){
		// 		$(this).val(0);
		// 	}
		// 	});
		// $('#bca_debit').on('change blur',function(){
		// 	if($(this).val().trim().length === 0){
		// 		$(this).val(0);
		// 	}
		// 	});


		// $('.pembayaran').keyup(function(){
        //     var cash = parseInt($("#cash").val());
        //     var mandiri_kredit = parseInt($("#mandiri_kredit").val());
		// 	var mandiri_debit = parseInt($("#mandiri_debit").val());
		// 	var bca_kredit = parseInt($("#bca_kredit").val());
		// 	var bca_debit = parseInt($("#bca_debit").val());
		// 	var total = parseInt($("#total").val());
        //     var bayar = mandiri_kredit + mandiri_debit + cash + bca_kredit + bca_debit;
		// 	if(total <= bayar){
		// 		$('#btn_bayar').removeAttr('disabled');
		// 	}else{
		// 		$('#btn_bayar').attr('disabled','true');
		// 	}


        //   });


        $('#d_customer').select2({
            width: '100%',
            language: {
            noResults: function() {
                return '<button class="btn btn-sm btn-primary" id="no-results-btn" onclick="noResultsButtonClicked()">No Result Found</a>';
            },
            },
            escapeMarkup: function(markup) {
            return markup;
            },
        }); 

        });
        function noResultsButtonClicked() {
        $('.manual').removeAttr('disabled');
        $('.manual').show();
        $('.data-customer').attr('disabled','true');
        $('.data-customer').hide();
        // $(".pilih-metode").val("manual");
        $('.pilih-metode option[value=manual]').attr('selected','selected');
        }

        $(document).ready(function () { 
              // $(".pilih_customer").change(function () { 
              //   $(this).find("option:selected") 
              //   .each(function () { 
              //     var optionValue = $(this).attr("value"); 
              //     if (optionValue) { 
              //       $(".box").not("." + optionValue).hide(); 
              //       $("." + optionValue).show(); 
              //     } else { 
              //       $(".box").hide(); 
              //     } 
              //   }); 
              // }).change();

               $(".pilih-metode").change(function(){
                $(this).find("option:selected") 
                .each(function () { 
                  var metode = $(this).attr("value"); 
                  if (metode == "manual") { 
                    $('.manual').removeAttr('disabled');
                    $('.manual').show();
                   $('.data-customer').attr('disabled','true');
                   $('.data-customer').hide(); 
                  } else{ 
                    $('.data-customer').removeAttr('disabled');
                    $('.data-customer').show();
                   $('.manual').attr('disabled','true'); 
                   $('.manual').hide();
                  }
                              
                }); 


                //  var metode = $(this).attr("value")
                //  if( metode == "manual"){
                //    $('.manual').removeAttr('disabled');
                //    $('.data-customer').attr('disabled','true');
                //  }else{
                //   $('.data-customer').removeAttr('disabled');
                //    $('.manual').attr('disabled','true');
                //  }
                 
                });
                $('.manual').hide();
                    $('.manual').attr('disabled','true');
                    $('.data-customer').hide();
                    $('.data-customer').attr('disabled','true');  
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

