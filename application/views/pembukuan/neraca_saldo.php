<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<style type="text/css">

.modal .modal-dialog-aside{
	width: 350px;
	max-width:80%; height: 500px; margin:0;
	transform: translate(0); transition: transform .2s;
}


.modal .modal-dialog-aside .modal-content{  height: inherit; border:0; border-radius: 0;}
.modal .modal-dialog-aside .modal-content .modal-body{ overflow-y: auto }
.modal.fixed-left .modal-dialog-aside{ margin-left:auto;  transform: translateX(100%); }
.modal.fixed-right .modal-dialog-aside{ margin-right:auto; transform: translateX(-100%); }

.modal.show .modal-dialog-aside{ transform: translateX(0);  }

.th {
        /* position: sticky; */
        top: 53px;
    }       

</style>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<!-- <div class="col-sm-12">
					<h1 class="m-0 text-dark">Jurnal</h1>
				</div> -->
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
            <!-- <?php 
              $bulan = ['bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
              $bulan1 = (int)$month;
              ?> -->
			</div>
			<div class="col-md-10">
      
				<div class="card">
                    <div class="card-header">
                       <h3 class="float-left">Data Neraca Saldo</h3>
                       <!-- <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> Laporan Bulanan</button> -->
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#tambah-data"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                        
                    <div class="card-body">
                    
                        <table class="table mt-2" id="neraca_saldo">
                            <thead>
                                <tr>
									                  <th class="sticky-top th">Tanggal</th>
                                    <th class="sticky-top th" >No Akun</th>
                                    <th class="sticky-top th" >Akun</th>    
                                    <th class="sticky-top th">Debit</th>
                                    <th class="sticky-top th">Kredit</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $tgl = ''; 
                            $total_debit = 0;
                            $total_kredit = 0;
                            ?>                            
                            <?php foreach($neraca_saldo as $a) : 
                              $total_debit += $a->debit_saldo;
                              $total_kredit += $a->kredit_saldo;  
                            ?>
                                                    
                            <tr>
                                <?php if($tgl != $a->tgl): ?>
                                <td><?= date('d-M-Y', strtotime($a->tgl)) ?></td>
                                <?php $tgl = $a->tgl ?>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                    <td><?= $a->no_akun ?></td>
                                    <td><?= $a->nm_akun ?></td>
                                    <td><?= number_format($a->debit_saldo,0) ?></td>
                                    <td><?= number_format($a->kredit_saldo,0) ?></td>       
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                  <tr>
                                    <th colspan="3">Total</th>
                                    <th><?= number_format($total_debit,0) ?></th>
                                    <th><?= number_format($total_kredit,0) ?></th>
                                  </tr>
                            </tfoot>
                        </table>        
					</div>  
                    </div>
				</div>					
			</div>
		</div>
	</div>

    <style>
        .modal-lg {
          max-width: 800px;
          margin: 2rem auto;
        }
  </style>

<!-- Modal View -->
<form action="" method="GET">
<div class="modal fade" id="view-periode" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">

        <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Akun</label>
                      <select name="month" class="form-control" required="">                              
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>                 
                      </select>
                  </div>
              </div>

              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Tahun</label>
                      <select name="year" class="form-control select" required="">
                          <?php foreach($tahun as $t): ?>                                
                            <?php  $tanggal = $t->tgl;
                            $explodetgl=explode('-', $tanggal); ?>
                          <option value="<?=$explodetgl[0];?>"><?=$explodetgl[0];?></option>
                          <?php endforeach; ?>
                        </select>  
                  </div>
              </div>      

      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Lihat</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal Tambah -->
<form action="<?= base_url('Match/add_neraca_saldo') ?>" method="POST">
<div class="modal fade" id="tambah-data" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Neraca Saldo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">

        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label >Tanggal</label>
                <input type="date" class="form-control" name="tgl" required>
            </div>
        </div>

        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label >Akun</label>
                <select class="form-control select" name="id_akun" required>
                <?php foreach($akun as $a): ?>
                  <option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option>
                <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label >Debit</label>
                <input type="number" class="form-control" name="debit">
            </div>
        </div>

        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label >Kredit</label>
                <input type="number" class="form-control" name="kredit">
            </div>
        </div>

      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
</form>


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

// function kodeOtomatis(akun,id_akun){
//   var tgl = $('#tgl').val();
//   var tgl1    = tgl.split("-");
//   var bulan   = tgl1[1];
//   var tahun   = tgl1[0];
//   var tahun2  = tahun.substring(2, 4)
//   var kode    = akun+bulan+tahun2;

//   $.ajax({
//                 url:"<?= base_url(); ?>Match/kode/",
//                 method:"POST",
//                 data:{id_akun:id_akun, tgl:tgl},
//                 success:function(data){
//                 $('#no_nota').val(kode+data);
                                  
//                 }

//               });

// //   
//   // alert(kode);
// }

// $('#id_akun').change(function(){

//   var kode = $(this).find("option:selected").text();
//   var id_akun = $(this).val();
//   var hurufDepan          = kode.substring(0,1);
//   var panjang = kode.length;
//   var hurufBelakang       = kode.substring(panjang-1, kode.length);
//   var hurufTengah         = kode.substring(panjang/2, (panjang/2)+1);

//   var akun2 = hurufDepan+hurufTengah+hurufBelakang;
//   var akun1 = akun2.toUpperCase();
//   var akun = akun1.replace(/\s/g, '');


//   kodeOtomatis(akun, id_akun);


// });

//         $('#debit').keyup(function(){
// 			var total = $(this).val();
//             $('#total').val(total);


//           });
		
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
