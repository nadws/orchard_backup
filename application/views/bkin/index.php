<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

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
			<div class="col-10">
      <?= $this->session->flashdata('message'); ?>
				<div class="card">
                    <div class="card-header">
                       <h4 class="float-left">Pembayaran Bk-in</h4>
                       <!-- <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#view-periode"><i class="fa fa-eye"></i> Lihat Data</button> -->
                       <a href="<?= base_url("Match/pengeluaran") ?>" class="btn btn-sm btn-outline-secondary float-right ml-2"><i class="fas fa-arrow-left"></i> Kembali</a>
                      </div>
                        
                    <div class="card-body">
                        <table class="table table-sm table-sm table-bordered" id="pengeluaran">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No Nota</th>
                                    <th>Jumlah</th>
                                    <th>Terbayar</th>
                                    <th>Sisa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            foreach($bkin as $bk): 
                            $sisa = $bk->jml_kredit - $bk->jml_debit;
                            if($sisa <= 0){
                              continue;
                            }
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= date('d-M-Y' , strtotime($bk->tgl)) ?></td>
                                <td><?= $bk->no_bkin ?></td>
                                <td><?= $bk->jml_kredit ?></td>
                                <td><?= $bk->jml_debit ?></td>
                                <td><?= $sisa ?></td>
                                <td class="text-center">
                                <button type="button" id="<?= $bk->kd_gabungan ?>" no_bkin="<?= $bk->no_bkin ?>" class="btn btn-sm btn-success btn_pembayaran"   data-toggle="modal" data-target="#pembayaran"><i class="fas fa-money-bill-wave"></i></button>
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

   
  
<div class="modal fade" id="pembayaran" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <!-- <form action="<?= base_url() ?>match/app_add_order_multiple2" method="post"> -->
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Pembayaran BKIN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="no_bkin" id="d_no_bkin">
        <input type="hidden" name="kd_gabungan" id="d_kd_gabungan">        

        <div id="input_pembayaran">
        
        
        </div>
          
        </div>
        <div class="modal-footer">
          <!-- <button type="submit" class="btn btn-info">Simpan</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>
      



  





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

    function get_bkin(kd_gabungan, no_bkin){

      $.ajax({  
                        url:"<?= base_url(); ?>Match/get_pembayaran_bkin/",  
                        method:"POST",
                        data:{kd_gabungan:kd_gabungan, no_bkin:no_bkin},  
                        success:function(data)  
                        {
                            // console.log(data); 
                        $('#input_pembayaran').html(data); 
                        }  
                    });
    }
		  
        $(document).on('click', '.btn_pembayaran', function(){

            var kd_gabungan = $(this).attr('id');
            var no_bkin = $(this).attr('no_bkin');

            $('#d_no_bkin').val(no_bkin);
            $('#d_kd_gabungan').val(kd_gabungan);

            // alert(kd_gabungan);

            // $('input[name="kd_faktur"]:checked').each(function(){
            //     kd_faktur.push($(this).attr("value"))
            // });


                get_bkin(kd_gabungan,no_bkin);

            });

        $("body").on( "keyup", ".rp_beli", function(){
        // $('.rp_beli').keyup(function(){
          var rp_beli = parseInt($(this).val());
          var detail = $(this).attr('rp_beli');

          var qty = parseFloat($('.qty'+detail).val());

          var ttl_harga = rp_beli * qty;
          var rp_pajak = ttl_harga * 10 / 100;
          var total = ttl_harga + rp_pajak;
            // console.log(total);
            $('.ppn'+detail).val(rp_pajak);
            $('.ttl_rp'+detail).val(total);

            var hutang = 0;

            $(".ttl_rp").each(function(){
              hutang += parseFloat($(this).val());
            });
            $('#jml_hutang').val(hutang);
          });

           //edit ppn
    $("body").on( "keyup", ".ppn", function(){
        // $('.rp_beli').keyup(function(){
          var ppn = parseInt($(this).val());
          var detail = $(this).attr('ppn');

          var qty = parseInt($('.qty'+detail).val());

          var rp_beli = parseInt($('.rp_beli'+detail).val());

          if(isNaN(ppn)){
            var total = rp_beli * qty;
          }else{
            var total = rp_beli * qty + ppn;
          }
            $('.ttl_rp'+detail).val(total);

            var hutang = 0;

            $(".ttl_rp").each(function(){
              hutang += parseFloat($(this).val());
            });
            $('#jml_hutang').val(hutang);
          });

      $(document).on('submit', '#edit_bkin', function(event){  
           event.preventDefault();
		   var kd_gabungan = $('#d_kd_gabungan').val();
       var no_bkin = $('#d_no_bkin').val();
		   
              $.ajax({  
                     url:"<?php echo base_url('match/edit_bkin'); ?>",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {
                       if(data == 'success'){
                        Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Data Berhasil diubah'
                      });
                      get_bkin(kd_gabungan,no_bkin);
                       }else{
                      //   Swal.fire({
                      //   toast: true,
                      //   position: 'top-end',
                      //   showConfirmButton: false,
                      //   timer: 3000,
                      //   icon: 'error',
                      //   title: 'Gagal'
                      // });
                      console.log(data);
                       }

						
                     }  
                });        
            });      

  });


</script>




	<?php $this->load->view('tema/Footer'); ?>

