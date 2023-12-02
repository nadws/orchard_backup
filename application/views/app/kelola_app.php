<?php $this->load->view('tema/Header', $title); ?>

<div class="card">
    <div class="card-header">
        <h3>Kelola Appointment</h3>
        <?php if($tgl == date('Y-m-d')): ?>
        <a href="<?= base_url(); ?>match/app" class="btn btn-warning">Kembali</a>
        <?php else: ?>
          <a href="<?= base_url(); ?>match/app_priode?tgl=<?= $tgl; ?>" class="btn btn-warning">Kembali</a>
        <?php endif; ?>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Therapist</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#input2"><i class="fa fa-plus"></i> Appointment</button>
    </div>
    <div class="card-body">
    <div id="get_kelola">    
    </div>
    </div>
</div>

<style>
        .modal-lg {
          max-width: 600px;
          margin: 2rem auto;
        }
      </style>


<div class="modal fade" id="input2" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <!-- <form action="<?= base_url() ?>match/app_add_order_multiple2" method="post"> -->
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Input Appointment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="tgl" value="<?= $tgl; ?>">
          <div class="form-group data-customer">
              <select name="id_customer" id="" class="form-control select data-customer id_customer">
                <option value="">- Pilih Customer -</option>
                <?php foreach ($customer as $key => $value): ?>
                  <option value="<?= $value->id_customer ?>"><?= $value->nama ?></option>
                <?php endforeach ?>
              </select>
            </div>
          <div class="table-responsive">
          <table class="table" id="crud_table">
          <tr>
            <th width="35%">Therapist</th>
            <th width="45%">Servis</th>
            <th width="20%">Jam</th>
          </tr>
          <tr>
            <td class="terapis" width="35%">
            <select name="id_terapis" id="" class="form-control select" required="">
              <option value="">- Pilih Therapist -</option>
              <?php foreach ($terapis as $key => $value): ?>
                <option value="<?= $value->id_terapis?>"><?= $value->nama_t ?></option>
              <?php endforeach ?>
            </select>
            </td>
            <td class="servis" width="45%">
            <select name="id_servis" id="" class="form-control select" required="">
              <option value="">- Pilih Servis -</option>
              <?php foreach ($servis as $key => $value): ?>

                <option value="<?= $value->id_servis ?>"><?= $value->nm_servis ?></option>
              <?php endforeach ?>
            </select>
            </td>
            <td class="" width="20%">
            <input type="time" class="form-control jam_mulai" name="jam_mulai" required="" id="jam_mulai">
            </td>
            <!-- <td></td> -->
          </tr>
          </table>
          </div>
          <div align="right" class="mt-2">
          <button type="button" name="addappointment" id="addappointment" class="btn-sm btn-success">Tambah</button>
          </div>     

            
        
          <!-- <div class="form-group">
            <label for="">Therapist</label>
            <select name="id_terapis" id="" class="form-control select" required="">
              <option value="">- Pilih Therapist -</option>
              <?php foreach ($terapis as $key => $value): ?>
                <option value="<?= $value->id_terapis?>"><?= $value->nama_t ?></option>
              <?php endforeach ?>
            </select>
          </div>
          
            <div class="form-group">
            <label for="">Servis</label>
            <select name="id_servis" id="" class="form-control select" required="">
              <option value="">- Pilih Servis -</option>
              <?php foreach ($servis as $key => $value): ?>

                <option value="<?= $value->id_servis ?>"><?= $value->nm_servis ?> | <?= $value->durasi ?> Jam - <?= $value->menit ?> menit</option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Jam Mulai</label>
            <input type="time" class="form-control" name="jam_mulai" required="">
          </div> -->
        </div>
        <div class="modal-footer">
          <button id="cobai" class="btn btn-info">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    <!-- </form> -->
  </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <form action="<?= base_url() ?>match/add_terapis_kelola" method="post">
            <div class="modal-content">
              <div class="modal-header" style="background: #FFA07A;">
                <h4 class="modal-title">Tambah Therapist</h4>
                <input type="hidden" name="tgl" value="<?= $tgl ?>">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label for="">Therapist</label>
                  <select name="terapis[]" id="terapis" class="form-control select" required="" multiple="multiple">
                    <option value="">- Pilih Therapist -</option>
                    <?php foreach ($anak as $key => $value): ?>
                      <option value="<?= $value->nm_kry ?>"><?= $value->nm_kry ?></option>
                    <?php endforeach ?>
                  </select>
                  <input type="hidden" name="tzoffset" value="-10 * 60">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-info">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </form>
        </div>
      </div>


<!-- EXAMPLE 3 - MODAL -->


  <div id="selesai" class="modal fade modal_selesai">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Selesai</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="<?= base_url() ?>match/selesai_app1" method="post" class="form_selesai">
        <input type="hidden" name="tgl" value="<?= $tgl; ?>">
          <div class="modal-body">
            <table class="table table-striped" id="table_selesai">
            <tr>
                <th width="50%">Therapist</th>
                <th width="5%">:</th>
                <th><input type="text" name="" class="form-control" id="nama_t_selesai" disabled></th>
              </tr>
              <tr>
                <th>Customer</th>
                <th>:</th>
                <th><input type="text" name="" class="form-control" id="nama_selesai" disabled></th>
              </tr>
              <tr>
                <th>Servis</th>
                <th>:</th>
                <th><input type="text" name="" class="form-control" id="nm_servis_selesai" disabled></th>
              </tr>
              <tr>
                <th>Jam Mulai s/d Jam Selesai</th>
                <th>:</th>
                <th><input type="text" name="" class="form-control" id="start_selesai" disabled> s/d <input type="text" name="" class="form-control" id="end_selesai" disabled></th>
              </tr>
              <tr>
                <th>Total Waktu Pengerjaan</th>
                <th>:</th>
                <th><input type="text" name="" class="form-control" id="total_waktu" disabled></th>
              </tr>
            </table>
            <div class="form-group">
              <label>Total Rp</label>
              <input type="number" name="total" class="form-control total" id="biaya"   required readonly>
              <input type="hidden" name="id_order" class="form-control id_order" id="id_order_selesai">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info">Kirim</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <!-- <button type="button" id="test" class="btn btn-default" >test</button> -->
          </div>
        </form>
      </div>

    </div>
  </div>




  <div id="cancel" class="modal fade modal_cancel" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Cancel</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" class="form_cancel">
          <div class="modal-body">
            <table class="table table-striped">
            <tr>
                <th width="50%">Therapist</th>
                <th width="5%">:</th>
                <th><input type="text" name="" class="form-control" id="nama_t_cancel" disabled></th>
              </tr>
              <tr>
                <th>Customer</th>
                <th>:</th>
                <th><input type="text" name="" class="form-control" id="nama_cancel" disabled></th>
              </tr>
              <tr>
                <th>Servis</th>
                <th>:</th>
                <th><input type="text" name="" class="form-control" id="nm_servis_cancel" disabled></th>
              </tr>
              <tr>
                <th>Jam Mulai s/d Jam Selesai</th>
                <th>:</th>
                <th><input type="text" name="" class="form-control" id="start_cancel" disabled> s/d <input type="text" name="" class="form-control" id="end_cancel" disabled></th>
              </tr>
            </table>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="ket" class="form-control ket" placeholder="Keterangan" required>
              <input type="hidden" name="id_order" class="form-control id_order" id="id_order_cancel">
              <input type="hidden" name="tgl" class="form-control tgl" value="<?= $tgl ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info">Kirim</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </form>
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
//kelola appointment

// $(function () {
//              $('.select').select2()

//              $('.select2bs4').select2({
//               theme: 'bootstrap4'
//             })
//            });





$(document).ready(function(){
  
  load_kelola();
          function load_kelola(){
            var tgl = <?php echo json_encode($tgl); ?>;
            $.ajax({
              method:"POST",
              url:"<?php echo base_url() ?>match/get_kelola/",
              data: {tgl:tgl},
              success:function(hasil)
              {
                $(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });

                $('#get_kelola').html(hasil);
                
              }
            });
          }

        //   $(document).on('click','.tombol_kelola', function(event){
           
        //     $('#modal_kelola').modal('show');
        //     load_kelola();
            
        //   });

        $(document).on('click','.unpaid',function(event){

            if (confirm('Apakah anda yakin?')) {
              var id_order = $(this).attr("id_order");
                
                $.ajax({
                  url:"<?= base_url(); ?>match/unpaid/",
                  method:"POST",
                  data:{id_order:id_order},
                  success:function(data){
                    
                    load_kelola();
                    
                    Swal.fire({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          icon: 'success',
                          title: 'Unpaid berhasil'
                        });
                    
                  }

                });
            } else {
                false;
            }

              
            });


          $(document).on('click','.update_app', function(event){
            var id_order = $(this).attr("id");
           var tgl = $("#tgl_"+id_order).val();
           var id_terapis = $("#id_terapis_"+id_order).val();
           var start = $("#start_"+id_order).val();
           var end = $("#end_"+id_order).val();
           var id_servis = $("#id_servis_"+id_order).val();
          // alert(tgl);
          if(start > end){
            Swal.fire({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          icon: 'error',
                          title: 'gagal karena waktu jam tidak sesuai'
                        });
          }else{
            $.ajax({  
                     url:"<?= base_url(); ?>match/update_app_order/",  
                     method:"POST",
                     data:{id_order:id_order, tgl:tgl, id_terapis:id_terapis, start:start, end:end, id_servis:id_servis},  
                     success:function(data)  
                     {  
                      $('#cart_session').html(data);
                      if(data == "berhasil"){
                          Swal.fire({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          icon: 'success',
                          title: 'data berhasil diupdate'
                        }); 
                      }else{
                        Swal.fire({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          icon: 'error',
                          title: 'gagal karena jadwal tabrakan'
                        });
                      }                      
                      load_kelola(); 

                      // alert(data);
                     }  
                });
          }
           
                });

        $(document).on('submit', '.form_selesai', function(event){  
           event.preventDefault();
           var id_order = $("#id_order_selesai").val();
           var total = $("#biaya").val();
           var tgl = $(".tgl").val();
              $.ajax({  
                     url:"<?= base_url() ?>match/selesai_app1",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {  
                      if(data){
                        Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Servis selesai'
                      });
                      }
                      $('.modal_selesai').hide();
                        setTimeout(function(){
                          $("[data-dismiss=modal]").trigger({ type: "click" });
                        },50)
                        
                      load_kelola();
                     }  
                });        
            });


            $(document).on('submit', '.form_cancel', function(event){  
           event.preventDefault();
           var id_order = $("#id_order_selesai").val();
           var ket = $(".ket").val();
           var tgl = $(".tgl").val();
              $.ajax({  
                     url:"<?= base_url() ?>match/drop_app2",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {  
                      if(data){
                        Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Servis Dicancel'
                      });
                      }
                        $('.modal_cancel').hide();
                        setTimeout(function(){
                          $("[data-dismiss=modal]").trigger({ type: "click" });
                        },50)
                      load_kelola();
                     }  
                });        
            });


            // $(document).on('click','#test', function(event){
            //     // $('.modal_selesai').modal('hide');
            //     $(".modal_selesai").removeClass("in");
            //     $(".modal-backdrop").remove();
            //     $('body').removeClass('modal-open');
            //     $('body').css('padding-right', '');
            //     $('.modal_selesai').hide();
            // });

            $(document).on('click','.selesai',function(event){
              var id_order = $(this).attr("id");
              
              $.ajax({
                url:"<?= base_url(); ?>match/get_selesai/",
                method:"POST",
                data:{id_order:id_order},
                dataType:"json",
                success:function(data){
                  
                  // alert(data.biaya);
                  $('#selesai').modal('show');
                  
                  $('#id_order_selesai').val(data.id_order);
                  $('#nama_selesai').val(data.nama);
                  $('#nama_t_selesai').val(data.nama_t);
                  $('#nm_servis_selesai').val(data.nm_servis);
                  $('#start_selesai').val(data.start);
                  $('#end_selesai').val(data.end);
                  $('#biaya').val(data.biaya);
                  $('#total_waktu').val(data.total_waktu);
                  // $('#table_selesai').html(data);
                  
                }

              });
            });

            $(document).on('click','.batal',function(event){
              var id_order = $(this).attr("id");
              
              $.ajax({
                url:"<?= base_url(); ?>match/batal_selesai/",
                method:"POST",
                data:{id_order:id_order},
                success:function(data){
                  
                  load_kelola();
                  
                  Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Status berhasil diubah'
                      });
                  
                }

              });
            });

            $(document).on('click','.cancel',function(event){
              var id_order = $(this).attr("id_order");
              
              $.ajax({
                url:"<?= base_url(); ?>match/get_selesai/",
                method:"POST",
                data:{id_order:id_order},
                dataType:"json",
                success:function(data){
                  
                  // alert(data.biaya);
                  $('#cancel').modal('show');
                  
                  $('#id_order_cancel').val(data.id_order);
                  $('#nama_cancel').val(data.nama);
                  $('#nama_t_cancel').val(data.nama_t);
                  $('#nm_servis_cancel').val(data.nm_servis);
                  $('#start_cancel').val(data.start);
                  $('#end_cancel').val(data.end);
                  // $('#table_selesai').html(data);
                  
                }

              });
            });


            // Service

  var count = 1;
      $('#addappointment').click(function(){
        count = count + 1;
        var jam_mulai = $("#jam_mulai").val();
        var html_code = "<tr id='row"+count+"'>";

        html_code += "<td class='terapis' width='35%'> <select name='id_terapis' id='' class='form-control select' required=''><option value=''>- Pilih Therapist -</option><?php foreach ($terapis as $key => $value): ?><option value='<?= $value->id_terapis?>'><?= $value->nama_t ?></option><?php endforeach ?></select></td>";

        html_code += "<td  class='servis' width='45%'> <select name='id_servis' id='' class='form-control select' required=''><option value=''>- Pilih Servis -</option><?php foreach ($servis as $key => $value): ?><option value='<?= $value->id_servis ?>'><?= $value->nm_servis ?></option><?php endforeach ?></select></td>";

        html_code += "<td  class='' width='20%'><input type='time' class='form-control jam_mulai' name='jam_mulai' value='"+jam_mulai+"' required=''></td></td>";

        html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
        html_code += "</tr>";

        $('#crud_table').append(html_code);
        $('.select').select2()
      });
      
      $(document).on('click', '.remove', function(){
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
      });
      
      $('#cobai').click(function(){
        var id_customer = $(".id_customer").val();
        var customer = $(".customer").val();
        var tgl = $(".tgl").val();
        var terapis = [];
        var servis = [];
        var jam_mulai = [];

        $(".terapis").find("option:selected").each(function(){
            terapis.push($(this).attr("value"))
          });
          
        $(".servis").find("option:selected").each(function(){
            servis.push($(this).attr("value"))
          });

        $('.jam_mulai').each(function(){
        jam_mulai.push($(this).val());
        });

        var ct = terapis.includes("");
        var cs = servis.includes("");
        var cj = jam_mulai.includes("");

        if(id_customer == ''){
          Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Data customer tidak boleh kosong!'
                      });
        }else if(ct || cs || cj){
          Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Ada data yang kosong!'
                      });
        }else{
          $.ajax({
        url:"<?php echo site_url() ?>match/app_add_order_multiple2",
        method:"POST",
        data:{terapis:terapis, servis:servis, jam_mulai:jam_mulai, id_customer:id_customer, customer:customer, tgl:tgl},
        success:function(data){
         
          if(data == "gagal"){
            Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'error',
                        title: 'Ada jadwal yang tabrakan'
                      });
                              
                  
          } else{
            Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Data jadwal berhasil dibuat'
                      });
                      setTimeout("window.location.href='<?= base_url(); ?>match/kelola_app?tgl=<?= $tgl; ?>'", 700);
                                  
          }         
        }
        });
        }  
        
        
      });
      
      // function fetch_item_data()
      // {
      //   $.ajax({
      //   url:"fetch.php",
      //   method:"POST",
      //   success:function(data)
      //   {
      //     $('#inserted_item_data').html(data);
      //   }
      //   })
      // }
      // fetch_item_data();            
          
});



    
</script>   

<?php $this->load->view('tema/Footer'); ?>