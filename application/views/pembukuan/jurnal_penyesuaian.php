<?php $this->load->view('tema/Header', $title); ?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


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
		<div class="row justify-content-center">
			<div class="col-md-12">
				
			</div>
			<div class="col-12">
      <?= $this->session->flashdata('message'); ?>

      <?php 
      $bulan = ['bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
      $bulan1 = (int)$month;      
      ?>
				<div class="card">
                    <div class="card-header">
                       <h4 class="float-left">Jurnal Penyesuaian <?= $bulan[$bulan1] ?> <?= $year ?></h4>
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> View Periode</button>
                       <a href="<?= base_url('Match/print_penyesuaian') ?>?month=<?= $month ?>&year=<?= $year ?>" class="btn btn-sm btn-outline-secondary float-right ml-2"><i class="fas fa-print"></i> Print</a>
                       <!-- <button type="button" class="btn btn-sm btn-outline-secondary float-right" data-toggle="modal" data-target="#view-data"><i class="fa fa-eye"></i> View</button> -->
                    </div>
                        
                    <div class="card-body">
                        
                    <table class="table mt-2" id="pengeluaran">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th >Tanggal</th>
                                    <th >No Nota</th>                                    
                                    <th >No Akun</th>                                    
                                    <th >Nama Akun</th>
                                    <th >Keterangan</th>                                    
                                    <th >Debit</th>
                                    <th >Kredit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if(!empty($jurnal)){
                                $jurnal1 = $jurnal[0];
                            $tgl = $jurnal1->tgl;
                            $kd_gabungan1 = $jurnal1->kd_gabungan;
                            $no = 0;
                            $i = 1; 
                            }
                            
                            foreach($jurnal as $p) : ?>
                            
                              <?php if($kd_gabungan1 != $p->kd_gabungan){
                              $no += 1;
                              $kd_gabungan1 = $p->kd_gabungan;
                              $tgl = $p->tgl;
                            }  
                            if($no % 2 == 0 ): ?>
                              <tr style="background: #EEEEEE;">
                            
                            <?php endif; ?>
                                    <td><?= $i++ ?></td>
                                    <?php if($tgl != ''): ?>
                                    <td><?= date('d-m-y' , strtotime($tgl)) ?></td>
                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>
                                    <td><?= $p->no_nota ?></td>
                                    <td><?= $p->no_akun ?></td>                                    
                                    <td><?= $p->nm_akun ?></td>
                                    <td><?= $p->ket ?></td>                                    
                                    <td><?= number_format($p->debit,0) ?> </td>
                                    <td><?= number_format($p->kredit,0) ?></td>
                                    <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn_edit" kd_gabungan='<?= $p->kd_gabungan ?>' data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                    <a class="btn btn-sm btn-outline-secondary" href="<?= base_url("Match/drop_penyesuaian/$p->kd_gabungan/$month/$year") ?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
                                    </td>                                   
                                </tr>
                                <?php  if($kd_gabungan1 == $p->kd_gabungan){
                                  $tgl = '';
                                } ?>
                            <?php endforeach; ?>    
                            </tbody>
                        </table>
                         
					</div>        
                                    

                    </div>
					
				</div>					
			</div>
			
			
		</div>
	</div>

    <style>
        .modal-lg {
          max-width: 900px;
          margin: 2rem auto;
        }
  </style>

<!-- Modal -->
<form action="" method="POST" id="form-jurnal">
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#fadadd;">
        <h5 class="modal-title" id="exampleModalLabel">Jurnal Penyesuaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <div class="row">

      <div class="col-sm-3 col-md-3">
              <div class="form-group">
                  <label for="list_kategori">Tanggal</label>
                  <input class="form-control" type="date" name="tgl" id="tgl" value="<?= date('Y-m-d') ?>" required>
                                  
              </div>                            
          </div>

          <div class="mt-3 ml-1">
            <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>                           
          </div>

              
              <div class="col-sm-4 col-md-4">
                  <div class="form-group">
                      <label for="list_kategori">Akun</label>
                      <select name="id_akun" id="id_akun" class="form-control select" required="">
                          <?php foreach($akun as $a): ?>    
                          <option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option>
                          <?php endforeach ?>                    
                      </select>
                  </div>
              </div>
              
          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                  <label for="list_kategori">Debit</label>
                  <input type="number" class="form-control total" id="total" name="total" readonly>                                        
              </div>                            
          </div>
          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                  <label for="list_kategori">Kredit</label>
                  <input type="number" class="form-control" readonly>                                        
              </div>                            
          </div>

          <div class="col-sm-3 col-md-3">
                                
          </div>

          <div class="mt-1">
            <p class="mt-1 ml-3 text-warning"><strong>Cr</strong></p>                           
          </div>

          <div class="col-sm-4 col-md-4">
              <div class="form-group">
                      <select name="metode" id="metode" class="form-control select" required>
                        <?php foreach($akun as $k): ?>
                        <option value="<?= $k->id_akun ?>"><?= $k->nm_akun ?></option>
                        <?php endforeach; ?>                 
                      </select>
                  </div>                  
          </div>

          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                  
                  <input type="number" class="form-control" readonly>                                        
              </div>                            
          </div>
          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                
                  <input type="number" class="form-control total" readonly>                                        
              </div>                            
          </div>

               

             

     </div>

     <!-- monitoring ///////////-->

    <div id="monitoring" class="detail">
    <hr>  
        
    <div class="row">

          <div class="col-md-4">
                    <div class="form-group">
                        <label for="list_kategori">Barang</label>
                        <select name="barang[]" class="form-control select input_detail input_monitoring barang" detail="1" required>
                               <option>- Pilih Barang -</option> 
                               <?php foreach($barang as $b): ?>
                               <option value="<?= $b->nota ?>"><?= $b->barang ?> - <?= $b->nota ?></option>
                               <?php endforeach; ?>                 
                        </select> 
                                        
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="list_kategori">Total Penyesuaian</label>
                        <input type="text" class="form-control  input_detail input_monitoring total_penyesuaian total_penyesuaian1" name="total_penyesuaian[]" total_penyesuaian="1" id="ttlp1" required>                                        
                    </div>                            
                </div>

            </div>

            <div id="detail_monitoring">
            
            </div> 

            <div align="right" class="mt-2">
            <button type="button" id="tambah_monitoring" class="btn-sm btn-success">Tambah</button>
            </div>

    </div>

    <!-- non-monitoring -->

    <div id="non_monitoring" class="detail">
    <hr>  
        
    <div class="row">

        <div class="col-md-4">
                    <div class="form-group">
                        <label for="list_kategori">Keterangan</label>
                        <input type="text" class="form-control input_detail input_non_monitoring" name="ket" required>                                        
                    </div>                            
        </div>                        

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="list_kategori">Total</label>
                        <input type="text" class="form-control input_detail input_non_monitoring total_penyesuaian" name="total" required>                                        
                    </div>                            
                </div>

            </div>
            


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


<!-- modal edit -->
<form action="<?= base_url('Match/edit_jurnal_penyesuaian') ?>" method="POST">
<div class="modal fade" id="edit" role="dialog">
  <div class="modal-dialog modal-lg">

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
<script src="<?= base_url('asset/'); ?>plugins/simple.money.format.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>

$(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });


$(document).ready(function(){

  hide_default();

function hide_default() {
  $('.detail').hide();
  $('.input_detail').attr('disabled','true');
}


$('#id_akun').change(function(){
            var id_akun = $(this).val();
            
            var monitoring = ['37','38'];

            if(monitoring.includes(id_akun)){
              hide_default();
              $('#monitoring').show();
        	    $('.input_monitoring').removeAttr('disabled','true');
              $("#form-jurnal").attr("action", "<?=base_url()?>Match/add_penyesuaian_aktiva");
            }else{
              hide_default();
              $('#non_monitoring').show();
        	    $('.input_non_monitoring').removeAttr('disabled','true');
              $("#form-jurnal").attr("action", "<?=base_url()?>Match/add_penyesuaian");
            }
            
		        });

      //////////////////////Monitoring/////////////////////////////////
      $("body").on("change", ".barang", function() {
      // $('.barang').change(function(){
      var nota = $(this).val();
      var detail = $(this).attr('detail');

      // alert(detail);

      $.ajax({
        url: "<?= base_url(); ?>match/get_bpenyusutan/",
        method: "POST",
        data: {
          nota:nota
        },
        dataType: "json",
        success: function(data) {

          // alert(data.b_penyusutan);
          //   $('#cancel').modal('show');
          var bp = parseFloat(data.b_penyusutan);

          $('#ttlp' + detail).val(bp.toFixed(2));

          var debit = 0;
        
            $(".total_penyesuaian:not([disabled=disabled]").each(function(){
            debit += parseFloat($(this).val());
          });
          $('.total').val(debit.toFixed(2));
        }

      });
    });      

      var count_monitoring = 1;
        $('#tambah_monitoring').click(function(){
        count_monitoring = count_monitoring + 1;
        // var no_nota_atk = $("#no_nota_atk").val();
        var html_code = "<div class='row' id='row_monitoring"+count_monitoring+"'>";

        html_code += '<div class="col-md-4"><div class="form-group"><select name="barang[]" class="form-control select input_detail input_monitoring barang" detail="'+count_monitoring+'" required><option>- Pilih Barang -</option><?php foreach($barang as $b): ?><option value="<?= $b->nota ?>"><?= $b->barang ?>'+' - '+'<?= $b->nota ?></option><?php endforeach; ?></select></div></div>';

        html_code += '<div class="col-md-3"><div class="form-group"><input type="text" class="form-control  input_detail input_monitoring total_penyesuaian total_penyesuaian1" id="ttlp'+count_monitoring+'" name="total_penyesuaian[]" total_penyesuaian="1" required></div></div>';

        html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row_monitoring'+count_monitoring+'" class="btn btn-danger btn-sm remove_monitoring">-</button></div>';  
        

        html_code += "</div>";

        $('#detail_monitoring').append(html_code);
        $('.select').select2()
        });

      $(document).on('click', '.remove_monitoring', function(){
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();

        var debit = 0;
        
            $(".total_penyesuaian:not([disabled=disabled]").each(function(){
            debit += parseFloat($(this).val());
          });
          $('.total').val(debit);
      });


      //////////////////////Non Monitoring/////////////////////////////

    $("body").on( "keyup", ".total_penyesuaian", function(){
        //   $('.rp_pajak').keyup(function(){
            var debit = 0;
        
            $(".total_penyesuaian:not([disabled=disabled]").each(function(){
            debit += parseFloat($(this).val());
          });
          $('.total').val(debit);
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

