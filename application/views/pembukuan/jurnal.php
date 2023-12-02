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

.th{            
            top: 93px;            
        }

.acc{
  top: 60px;
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

    <?php 
    $tdebit = 0;
    $tkredit = 0;
      foreach($jurnal as $j){
        $tdebit += $j->debit;
        $tkredit += $j->kredit;
      }
    ?>        

		<div class="row justify-content-center">
			<div class="col-md-12">
				
			</div>
			<div class="col-12">
      <?= $this->session->flashdata('message'); ?>
				<div class="card">
                    <div class="card-header">
                       <h3 class="float-left">Jurnal Pemasukan</h3>
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2"  data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2"  data-toggle="modal" data-target="#input_pemasukan"><i class="fa fa-plus"></i> Pemasukan</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#export-data"><i class="fas fa-file-export"></i> Export</button>
                    </div>
                        <?php $i=1; ?>
                        
                    <div class="card-body">
                    <!-- <button type="button" class="btn btn-sm sticky-top acc" style="background : #DEE4E4;" data-toggle="modal" data-target="#modal_aside_left"><i class="fa fa-plus"></i> Penerimaan Bank</button> -->
                    
                        <table class="table mt-2" id="pengeluaran">
                            <thead >
                                <tr>
									                  <th style="color : #787878;">#</th>
                                    <th style="color : #787878;">Tanggal</th>
                                    <th style="color : #787878;">Keterangan</th>
                                    <th style="color : #787878;">No Akun</th>
                                    <th style="color : #787878;">Nama Akun</th>
                                    <th style="color : #787878;">Debit <a href="<?= base_url("Match/rekapitulasi_pemasukan?month=$month&year=$year") ?>" class="text-dark">(<strong><small><?= number_format($tdebit,0) ?></small></strong>)</a></th>
                                    <th style="color : #787878;">Kredit <a href="<?= base_url("Match/rekapitulasi_pemasukan?month=$month&year=$year") ?>" class="text-dark">(<strong><small><?= number_format($tkredit,0) ?></small></strong>)</a></th>
                                    <th style="color : #787878;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- <?php 
                            if(!empty($jurnal)){
                              $j= $jurnal[0];
                              $tgl = $j->tgl;
                            }
                            
                            ?> -->

                            
                            <?php foreach($jurnal as $p) : ?>
                            <?php $tanggal = date('d' , strtotime($p->tgl)); 
                            if($tanggal % 2 == 0 ): ?>
                              <tr style="background: #EEEEEE;">
                            
                            <?php endif; ?>                    
                                
                                    <td><?= $i++ ?></td>
                                    <!-- <td><?= $p->tgl ?></td> -->
									                    <td><?= date('d-m-y' , strtotime($p->tgl)) ?></td>
                                    <td><?= $p->ket ?></td>
                                    <td><?= $p->no_akun ?></td>
                                    <td><?= $p->nm_akun ?></td>
                                    <td><?= number_format($p->debit,2) ?></td>
                                    <td><?= number_format($p->kredit,2) ?></td>                                    
                                    <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn_edit" kd_gabungan='<?= $p->kd_gabungan ?>' data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                    <a class="btn btn-sm btn-outline-secondary" href='<?= base_url("Match/drop_pemasukan/$p->kd_gabungan/$month/$year") ?>'' onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
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

   

      <div id="modal_aside_left" class="modal fixed-right fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
        <form action="<?= base_url() ?>match/penerimaan_bank" method="post">
          <div class="modal-content">
            <div class="modal-header" style="background:#fadadd;">
              <h5 class="modal-title">Penerimaan Bank</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            <div class="form-group row">
                    <label for="jumlah" class="col-sm-4 col-form-label">Tanggal</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" id="tgl" name="tgl" required>
                    </div>
            </div>  

            <div class="form-group row">
                    <label for="bca" class="col-sm-4 col-form-label">BANK</label>
                    <div class="col-sm-8">
                    <select name="bank" id="bank" class="form-control" required="">
                    <option value="6">BCA</option>
                    <option value="7">Mandiri</option>                    
                    </select>
                    </div>
            </div>

            <div class="form-group row">
                    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control money" id="jumlah" name="jumlah" required>
                    </div>
            </div>

            <div class="form-group row">
                    <label for="admin" class="col-sm-4 col-form-label">Biaya Admin</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control money" id="admin" name="admin" required>
                    </div>
            </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Input</button>
            </div>
          </div>
          </form>
        </div> <!-- modal-bialog .// -->
      </div> <!-- modal.// -->


      <!-- Modal Eport -->
<form action="<?= base_url('Match/excel_pemasukan') ?>" method="GET">
  <div class="modal fade" id="export-data" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h5 class="modal-title" id="exampleModalLabel">Export data perperiode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="form-group col-12 col-md-6">
              <label>Dari</label>
              <input type="date" name="tgl1" class="form-control" required>
            </div>
            <div class="form-group col-12 col-md-6">
              <label>Sampai</label>
              <input type="date" name="tgl2" class="form-control" required>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Export</button>
        </div>
      </div>
    </div>
  </div>
</form>


<!-- Modal -->
<form action="<?= base_url('Match/add_pemasukan') ?>" method="POST">
  <div class="modal fade" id="input_pemasukan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h5 class="modal-title" id="exampleModalLabel">Jurnal Pemasukan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">

            <div class="col-sm-3 col-md-3">
              <div class="form-group">
                <label for="list_kategori">Tanggal</label>
                <input class="form-control" type="date" name="tgl" value="<?= date('Y-m-d') ?>" required>

              </div>
            </div>

            <!-- <div class="mt-3 ml-1">
              <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>
            </div> -->


            <div class="col-sm-3 col-md-3">
              <div class="form-group">
                <label for="list_kategori">Akun</label>
                <select name="id_akun_debit[]" class="form-control select" required="">
                  <?php foreach ($akun as $a) : ?>
                    <option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="col-sm-3 col-md-3">
              <div class="form-group">
                <label for="list_kategori">Keterangan</label>
                <input type="text" name="ket_debit[]" class="form-control" value="">
              </div>
            </div>

            <div class="col-sm-2 col-md-2">
              <div class="form-group">
                <label for="list_kategori">Debit</label>
                <input type="text" class="form-control debit" name="debit[]"required>
              </div>
            </div>
            </div>

            <div id="debit_pengeluaran">


            </div>

            <div class="row justify-content-end">

              <label align="right" class="col-md-2 col-form-label">Total Debit</label>      

              <div class="col-md-2">
                  <input type="text" class="form-control" id="ttl_debit" readonly>
      
              </div>

              <div class="col-md-1">
                <button type="button" id="tambah_debit_pengeluaran" class="btn btn-sm btn-success"><i class="fas fa-plus-square"></i></button>
              </div>
  
            </div>        
            <hr style="border: 1px solid;">
            <br>
            
            <div class="row">        
            <div class="col-sm-3 col-md-3">

            </div>

            <!-- <div class="mt-3">
              <p class="mt-3 ml-3 text-warning"><strong>Cr</strong></p>
            </div> -->

            <div class="col-sm-3 col-md-3">
              <div class="form-group">
              <label for="list_kategori">Akun</label>
                <select name="id_akun_kredit[]" class="form-control select" required>
                  <?php foreach ($akun as $k) : ?>
                    <option value="<?= $k->id_akun ?>"><?= $k->nm_akun ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-sm-3 col-md-3">
              <div class="form-group">
                <label for="list_kategori">Keterangan</label>
                <input type="text" class="form-control" name="ket_kredit[]" value="">
              </div>
            </div>

            <div class="col-sm-2 col-md-2">
              <div class="form-group">
                <label for="list_kategori">Kredit</label>
                <input type="text" class="form-control kredit" name="kredit[]" required>
              </div>
            </div>

        </div>

        <div id="kredit_pengeluaran">


        </div>

        <div class="row justify-content-end">

              <label align="right" class="col-md-2 col-form-label">Total Kredit</label>      

              <div class="col-md-2">
                <input type="text" class="form-control" id="ttl_kredit" readonly>
      
              </div>

              <div class="col-md-1">
                <button type="button" id="tambah_kredit_pengeluaran" class="btn btn-sm btn-success"><i class="fas fa-plus-square"></i></button>
              </div>    
            </div>

            <hr style="border: 1px solid;">        
            <br>        

        <div class="row justify-content-end">

          <label align="right" class="col-md-1 col-form-label">Selisih</label>        

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" class="form-control" id="ttl" readonly>
              </div>      
            </div>

            <div class="col-md-1" id="total">
            <div class="btn btn-sm btn-danger">
            <i class="fas fa-times-circle"></i>
            </div>
            
            </div>        

        </div>  

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="input" disabled>Input</button>
        </div>
      </div>
    </div>
  </div>
</form>

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

<!-- modal edit -->
<form action="<?= base_url('Match/edit_jurnal_pemasukan') ?>" method="POST" id="form-jurnal">
  <div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-lg">
    
    <input type="hidden" name="month" value="<?= $month ?>">
    <input type="hidden" name="year" value="<?= $year ?>">
      <!-- Modal content-->
      <!-- <form action="<?= base_url() ?>match/app_add_order_multiple2" method="post"> -->
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h4 class="modal-title">Edit Journal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="get_jurnal">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Save/Edit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>

</form>

    <!-- Modal -->
<!-- <form action="<?= base_url() ?>match/add_dp" method="post">
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
                    <input type="number" name="dp" class="form-control" id="mandiri_kredit">
                    </div>
            </div>
                                        
            <div class="form-group">
            <label for="">Metode</label>
                <select name="metode" id="metode" class="form-control" required>
                    <option value="Cash">- Cash -</option>
                    <option value="BCA">- BCA -</option>
                    <option value="Mandiri">- Mandiri -</option>
                </select>
            </div>

            <div class="form-group">
            <label for="">Untuk Tanggal</label>
            <input type="date" name="tgl_dp" class="form-control" id="tgl_dp" required>
            </div>
                    
            

							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Input</button>
      </div>
    </div>
  </div>
</div>
</form> -->




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
<!-- <script src="<?= base_url('asset/'); ?>plugins/simple.money.format.js"></script> -->

<script>

// $('.money').simpleMoneyFormat();

$(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })

            
            
           });

	$(document).ready(function(){

    //debit

    $("body").on( "keyup", ".debit", function(){
        // $('.rp_beli').keyup(function(){
          var debit = parseFloat($(this).val());

          // alert(debit);

            var ttl_debit = 0;
            var ttl_kredit = 0;

            $(".debit:not([disabled=disabled]").each(function(){
              ttl_debit += parseFloat($(this).val());
            });

            $('#ttl_debit').val(ttl_debit);

            $(".kredit:not([disabled=disabled]").each(function(){
              ttl_kredit += parseFloat($(this).val());
            });

            var ttl = ttl_debit - ttl_kredit;
            $('#ttl').val(ttl);

            if(ttl == 0){
              var html = '<div class="btn btn-sm btn-success"><i class="fas fa-check-square"></i></div>';
              $('#total').html(html);

              $('#input').removeAttr('disabled', 'true');
            }else{
              var html = '<div class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></div>';
              $('#total').html(html);

              $('#input').attr('disabled', 'true');
            }
            

          });
		  
    var count_debit = 1;
    $('#tambah_debit_pengeluaran').click(function(){
      count_debit = count_debit + 1;
            // var no_nota_atk = $("#no_nota_atk").val();
            var html_code = "<div class='row' id='row_debit"+count_debit+"'>";

            html_code += '<div class="col-sm-3 col-md-3"></div>';

            html_code += '<div class="col-sm-3 col-md-3"><div class="form-group"><select name="id_akun_debit[]" class="form-control select" required=""><?php foreach ($akun as $a) : ?><option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option><?php endforeach ?></select></div></div>';

            html_code += '<div class="col-sm-3 col-md-3"><div class="form-group"><input type="text" name="ket_debit[]" value="" class="form-control"></div></div>';

            html_code += '<div class="col-sm-2 col-md-2"><div class="form-group"><input type="text" class="form-control debit" name="debit[]" required></div></div>';

            html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row_debit'+count_debit+'" class="btn btn-danger btn-sm remove_debit"><i class="fas fa-minus-square"></i></button></div>';  
            

            html_code += "</div>";

            $('#debit_pengeluaran').append(html_code);
            $('.select').select2()
          });

    $(document).on('click', '.remove_debit', function(){
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();

      var ttl_debit = 0;
            var ttl_kredit = 0;

            $(".debit:not([disabled=disabled]").each(function(){
              ttl_debit += parseFloat($(this).val());
            });

            $('#ttl_debit').val(ttl_debit);

            $(".kredit:not([disabled=disabled]").each(function(){
              ttl_kredit += parseFloat($(this).val());
            });

            $('#ttl_kredit').val(ttl_kredit);

            var ttl = ttl_debit - ttl_kredit;
            $('#ttl').val(ttl);

            if(ttl == 0){
              var html = '<div class="btn btn-sm btn-success"><i class="fas fa-check-square"></i></div>';
              $('#total').html(html);

              $('#input').removeAttr('disabled', 'true');
            }else{
              var html = '<div class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></div>';
              $('#total').html(html);

              $('#input').attr('disabled', 'true');
            }
    });

    //kredit

    $("body").on( "keyup", ".kredit", function(){
        // $('.rp_beli').keyup(function(){
          var kredit = parseFloat($(this).val());

          // alert(kredit);

            var ttl_kredit = 0;
            var ttl_debit = 0;

            $(".kredit:not([disabled=disabled]").each(function(){
              ttl_kredit += parseFloat($(this).val());
            });
            $('#ttl_kredit').val(ttl_kredit);

            $(".debit:not([disabled=disabled]").each(function(){
              ttl_debit += parseFloat($(this).val());
            });

            var ttl= ttl_debit - ttl_kredit;
            $('#ttl').val(ttl);

            if(ttl == 0){
              var html = '<div class="btn btn-sm btn-success"><i class="fas fa-check-square"></i></div>';
              $('#total').html(html);

              $('#input').removeAttr('disabled', 'true');
            }else{
              var html = '<div class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></div>';
              $('#total').html(html);

              $('#input').attr('disabled', 'true');
            }

          });

    var count_kredit = 1;
    $('#tambah_kredit_pengeluaran').click(function(){
      count_kredit = count_kredit + 1;
            // var no_nota_atk = $("#no_nota_atk").val();
            var html_code = "<div class='row' id='row_kredit"+count_kredit+"'>";

            html_code += '<div class="col-sm-3 col-md-3"></div>';

            html_code += '<div class="col-sm-3 col-md-3"><div class="form-group"><select name="id_akun_kredit[]" class="form-control select" required><?php foreach ($akun as $k) : ?><option value="<?= $k->id_akun ?>"><?= $k->nm_akun ?></option><?php endforeach; ?></select></div></div>';

            html_code += '<div class="col-sm-3 col-md-3"><div class="form-group"><input type="text" name="ket_kredit[]" value="" class="form-control"></div></div>';

            html_code += '<div class="col-sm-2 col-md-2"><div class="form-group"><input type="text" class="form-control kredit" name="kredit[]" required></div></div>';

            html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row_kredit'+count_kredit+'" class="btn btn-danger btn-sm remove_kredit"><i class="fas fa-minus-square"></i></button></div>';  
            

            html_code += "</div>";

            $('#kredit_pengeluaran').append(html_code);
            $('.select').select2()
          });

    $(document).on('click', '.remove_kredit', function(){
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();

        var ttl_debit = 0;
            var ttl_kredit = 0;

            $(".debit:not([disabled=disabled]").each(function(){
              ttl_debit += parseFloat($(this).val());
            });

            $('#ttl_debit').val(ttl_debit);

            $(".kredit:not([disabled=disabled]").each(function(){
              ttl_kredit += parseFloat($(this).val());
            });

            $('#ttl_kredit').val(ttl_kredit);

            var ttl = ttl_debit - ttl_kredit;
            $('#ttl').val(ttl);

            if(ttl == 0){
              var html = '<div class="btn btn-sm btn-success"><i class="fas fa-check-square"></i></div>';
              $('#total').html(html);

              $('#input').removeAttr('disabled', 'true');
            }else{
              var html = '<div class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></div>';
              $('#total').html(html);

              $('#input').attr('disabled', 'true');
            }
    });

    //edit jurnal

    $('.btn_edit').click(function() {
      var kd_gabungan = $(this).attr("kd_gabungan");

      $.ajax({
        url: "<?= base_url(); ?>Match/get_jurnal/",
        method: "POST",
        data: {
          kd_gabungan: kd_gabungan
        },
        success: function(data) {
          $('#get_jurnal').html(data);
        }
      });

    });
    

  });


</script>




	<?php $this->load->view('tema/Footer'); ?>

