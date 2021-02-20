<?php $this->load->view('tema/Header'); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

        <div class="content-header">
          <div class="container">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Record Appoiment | Tanggal : <?= date('d-M-Y', strtotime($tgl)) ?></h1>
              </div>
              <div class="col-sm-6">
                <?php if ($this->session->userdata('edit_hapus')=='1'): ?>
                  <!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
                  <!--   <button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button> -->

                  <!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
                <?php endif ?>
              </div>
            </div>
          </div>


        </div>

        <div class="row">
          <div style="margin-left: 60px"></div>
          <div class="col-11">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Terapis</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalA"><i class="fa fa-plus"></i> Appointment</button>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalK"><i class="fa fa-edit"></i> Kelola</button>
            <button data-toggle="modal" data-target="#modal-app" class="btn btn-dark"><i class="fas fa-calendar"></i> Appointment / Priode</button>
            <button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button><br><br>
            <?= $this->session->flashdata('message'); ?>
            <center>
              <div class="card">
                <div class="card-header">
                  <div class="card-body">
                    <hr>
                    <div id="sked2"></div>
                  </div>
                </div>
              </div>
            </center>
          </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
          <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
          </div>
        </aside>

        <footer class="main-footer shadow" style=" background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);">
          <div class="float-right d-none d-sm-inline" style="color: white;" >
            Anything you want
          </div>
          <strong style="color: white;" >Copyright &copy; 2020.09.29 <a href="<?= 'https:www.putrirembulan.com'; ?>" target="" style="color: white;" >putrirembulan.com</a></strong>
        </footer>
      </div>
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <form action="<?= base_url() ?>match/app_add_terapis2" method="post">
            <div class="modal-content">
              <div class="modal-header" style="background: #FFA07A;">
                <h4 class="modal-title">Tambah Terapis</h4>
                <input type="hidden" name="tgl" value="<?= $tgl; ?>">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Terapis</label>
                  <select name="terapis" id="terapis" class="form-control select2" required="">
                    <option value="">- Pilih Terapis -</option>
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
      <style>
        .modal-lg {
          max-width: 1300px;
          margin: 2rem auto;
        }
      </style>
      <div class="modal fade" id="myModalK" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #FFA07A;">
              <h4 class="modal-title">Kelola Appointment</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
             <table class="table table-striped table-bordered" width="100%">
               <tr>
                <th width="15%">TERAPIS</th>
                <th width="25%">CUSTOMER - SERVIS</th>
                <th width="21%">JAM MULAI</th>
                <th>JAM SELESAI</th>
                <th width="18%">AKSI</th>
              </tr>
            </table>
            <?php foreach ($d_order_all as $key => $value): ?>
              <form action="<?= base_url() ?>match/update_app1" method="post">
                <table class="table table-striped table-bordered" width="100%">


                  <tbody style="text-align: center;">


                    <tr>
                      <td width="15%"><?= $value->nama_t ?></td>
                      <input type="hidden" name="id_order" value="<?= $value->id_order ?>">
                      <td width="25%"><?= $value->nama ?> - <?= $value->nm_servis ?></td>
                      <td width="21%">
                        <?php if ($value->status=="Selesai"): ?>
                          <input type="time" name="start" class="form-control" value="<?= $value->start ?>" readonly>
                          <?php else: ?>
                            <input type="time" name="start" class="form-control" value="<?= $value->start ?>">
                          <?php endif ?>
                        </td>
                        <td>
                         <?php if ($value->status=="Selesai"): ?>
                           <input type="time" name="end" class="form-control" value="<?= $value->end ?>" readonly>
                           <?php else: ?>
                             <input type="time" name="end" class="form-control" value="<?= $value->end ?>">
                           <?php endif ?>

                         </td>
                         <td width="18%">
                          <?php if ($value->status=="Selesai"): ?>
                            <span class="badge badge-success"><i class="fa fa-check"></i></span>
                            <?php else: ?>
                              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalC<?= $value->id_order ?>">Cancel</button>
                              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalS<?= $value->id_order ?>">Selesai</button>
                            <?php endif ?>
                          </td>
                        </tr>


                      </tbody>

                    </table>
                  </form>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>



        <form action="<?= base_url('Match/summary_app1'); ?>" method="post">
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
              <td ><label for="">Tanggal</label></td>
              <td>:</td>
              <td> <input style="width: 350px;" class="form-control" type="input" value="<?= date("Y-m-d"); ?>" name="tanggal" id="picker"></td>
            </tr>
          </table>

          <input class="form-control" type="date" value="" id="tanggal1" name="tgl1" hidden>  
          <input class="form-control" type="date" value="" id="tanggal2" name="tgl2" hidden>  
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="bg-info btn">Lanjutkan</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
  <form action="<?= base_url('Match/app_priode'); ?>" method="get" target="blank">
         <div class="modal fade" id="modal-app">
          <div class="modal-dialog">
           <div class="modal-content">
            <div class="modal-header" style="background:#FFA07A;">
             <h4 class="modal-title">Appointment / Priode</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <div class="form-group">
           <input type="date" name="tgl" class="form-control" required>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="bg-info btn">Lanjutkan</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<div class="modal fade" id="myModalA" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="<?= base_url() ?>match/app_add_order_2" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Input Appointment</h4>
          <input type="hidden" name="tgl" value="<?= $tgl; ?>">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="">Terapis</label>
            <select name="id_terapis" id="" class="form-control select2" required="">
              <option value="">- Pilih Terapis -</option>
              <?php foreach ($terapis as $key => $value): ?>
                <option value="<?= $value->id_terapis?>"><?= $value->nama_t ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Customer</label>
            <select class="form-control" required="">
              <label for=""></label>
              <option value="">- Pilih Metode Penginputan -</option>
              <option value="red">Input Manual</option>
              <option value="green">Dari Data Customer</option>
            </select>
          </div>
          <div class="green box">
            <div class="form-group">
              <select name="id_customer" id="" class="form-control select2">
                <option value="">- Pilih Customer -</option>
                <?php foreach ($customer as $key => $value): ?>
                  <option value="<?= $value->id_customer ?>"><?= $value->nama ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="red box">
            <div class="form-group">
              <input type="text" name="customer" class="form-control" placeholder="Isi Nama Customer">
            </div>
          </div>
          
          <div class="form-group">
            <label for="">Servis</label>
            <select name="id_servis" id="" class="form-control select2" required="">
              <option value="">- Pilih Servis -</option>
              <?php foreach ($servis as $key => $value): ?>

                <option value="<?= $value->id_servis ?>"><?= $value->nm_servis ?> | <?= $value->durasi ?> Jam - <?= $value->menit ?> menit</option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Jam Mulai</label>
            <input type="time" class="form-control" name="jam_mulai" required="">
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

<?php foreach ($d_order_all as $key => $value): ?>
  <div id="myModalS<?= $value->id_order ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Selesai</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="<?= base_url() ?>match/selesai_app" method="post">
          <div class="modal-body">
            <table class="table table-striped">
              <tr>
                <th width="50%">Terapis</th>
                <th width="5%">:</th>
                <th><?= $value->nama_t ?></th>
              </tr>
              <tr>
                <th>Customer</th>
                <th>:</th>
                <th><?= $value->nama ?></th>
              </tr>
              <tr>
                <th>Servis</th>
                <th>:</th>
                <th><?= $value->nm_servis ?></th>
              </tr>
              <tr>
                <th>Jam Mulai s/d Jam Selesai</th>
                <th>:</th>
                <th><?= date('H:i', strtotime($value->start)) ?> s/d <?= date('H:i', strtotime($value->end)) ?></th>
              </tr>
            </table>
            <div class="form-group">
              <label>Total Rp</label>
              <input type="number" name="total" class="form-control" placeholder="Total Rp" required>
              <input type="hidden" name="id_order" class="form-control" value="<?= $value->id_order ?>">
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
<?php endforeach ?>

<?php foreach ($d_order_all as $key => $value): ?>
  <div id="myModalC<?= $value->id_order ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Cancel</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="<?= base_url() ?>match/drop_app1" method="post">
          <div class="modal-body">
            <table class="table table-striped">
              <tr>
                <th width="50%">Terapis</th>
                <th width="5%">:</th>
                <th><?= $value->nama_t ?></th>
              </tr>
              <tr>
                <th>Customer</th>
                <th>:</th>
                <th><?= $value->nama ?></th>
              </tr>
              <tr>
                <th>Servis</th>
                <th>:</th>
                <th><?= $value->nm_servis ?></th>
              </tr>
              <tr>
                <th>Jam Mulai s/d Jam Selesai</th>
                <th>:</th>
                <th><?= date('H:i', strtotime($value->start)) ?> s/d <?= date('H:i', strtotime($value->end)) ?></th>
              </tr>
            </table>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="ket" class="form-control" placeholder="Keterangan" required>
              <input type="hidden" name="id_order" class="form-control" value="<?= $value->id_order ?>">
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
<?php endforeach ?>
<style>
  .box { 
    color: #202020; 
    padding: 20px 10px; 
    display: none; 
    margin-top: 10px;  
  } 
  
  .red { 
    background: #DDDDDD; 
  } 
  
  .green { 
    background: #DDDDDD; 
  } 

</style>

<?php
$awal  = date_create($tgl);
$akhir = date_create();
$diff  = date_diff( $awal, $akhir );
$hari = $diff->d;
$jam = $diff->h;
$convert_jam = $hari*24;
?>

<input type='hidden' id='jam' value='<?= $convert_jam ?>'>

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
  $(document).ready(function () {
    $(".sked-tape__event").each(function(index) {
      var colorR = Math.floor((Math.random() * 256));
      var colorG = Math.floor((Math.random() * 256));
      var colorB = Math.floor((Math.random() * 256));
      $(this).css("background-color", "rgb(" + colorR + "," + colorG + "," + colorB + ")");
    });
  })
</script>
<?php  
$d_o = array();
foreach ($d_order as $key => $value) 
{
  $d = array(
    'id'  => $value['id_terapis'],
    'name'  => $value['nama_t'],
    'tzOffset'  => $value['tzoffset'],
  );
  $d_o[] = $d;
}
$data = array();
foreach ($d_order_d as $key => $value) 
{
  $d = array(
    'name'  => $value['nama'].' - '.$value['nm_servis'],
    'location'  => $value['location'],
    'start'  => $value['start_t'],
    'end'  => $value['end_t'],
  );
  $data[] = $d;
}
// $start2 = date('H:i:s', strtotime($start));
//     $end2 = date('H:i:s', strtotime($end));
    
//     $start_t = date('D M d Y ').$start2.' GMT+0800 (Central Indonesia Time)';
//     $end_t = date('D M d Y ').$end2.' GMT+0800 (Central Indonesia Time)';
// $tglc = 

?>

    
<script type="text/javascript">
// console.log(new Date());
            // --------------------------- Data --------------------------------

            var locations = <?php echo json_encode($d_o); ?>;
            var events = <?php echo json_encode($data); ?>;
            // -------------------------- Helpers ------------------------------
            function today(hours, minutes) {
              var date = new Date();
              date.setHours(hours, minutes, 0, 0);
              return date;
            }

            function custom(hours, minutes) {
              var hour = document.getElementById("jam").value;
              var a = parseInt(hour);
              var date = today(hours, minutes);
              date.setTime(date.getTime() - a * 60 * 60 * 1000);
              return date;
            }

            function yesterday(hours, minutes) {
              var date = today(hours, minutes);
              date.setTime(date.getTime() - 24 * 60 * 60 * 1000);
              return date;
            }
            function tomorrow(hours, minutes) {
              var date = today(hours, minutes);
              date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
              return date;
            }
            // --------------------------- Example 2 ---------------------------
            var sked2Config = {
              caption: 'Terapis',
              start: custom(10, 0),
              end: custom(18, 0),
              showEventTime: true,
              showEventDuration: true,
              locations: locations.map(function(location) {
                var newLocation = $.extend({}, location);
                delete newLocation.tzOffset;
                return newLocation;
              }),
              events: events.slice(),
              tzOffset: 0,
              sorting: true,
              orderBy: 'name',
            };
            var $sked2 = $.skedTape(sked2Config);
            $sked2.appendTo('#sked2').skedTape('render');
			//$sked2.skedTape('destroy');
      $sked2.skedTape(sked2Config);
            // --------------------------- Example 3 ---------------------------
            $('#modal1').on('shown.bs.modal', function() {
              $('#sked3').skedTape(sked2Config);
            });
            $('#modal1').on('hidden.bs.modal', function() {
                // This is not necessary, but it always a good idea to do not
                // take processing time for elements that don't show.
                $('#sked3').skedTape('destroy');
              });

            var $skedTabBtn = $('a[data-toggle="tab"][href="#sked-tab"]');
            $skedTabBtn.on('shown.bs.tab', function(e) {
              $('#sked4').skedTape(sked2Config);
            });
            $skedTabBtn.on('hidden.bs.tab', function(e) {
              $('#sked4').skedTape('destroy');
            });
          </script>
          <script>
            $(function () {
             $('.select2').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });

            $(function () {
              $("#example1").DataTable({ 

                "responsive": true,
                "bSort": true,
        // "scrollX": true,
        "paging" : true,
        "stateSave" : true,
        "scrollCollapse" : true
      });
            });
            $(function() {
              $("input[name='picker']").daterangepicker({
                opens: 'center',
                drops: 'up'
              }, function(start, end, label) {

              });
              $('#picker').daterangepicker();
              $('#picker').on('apply.daterangepicker', function(ev, picker) {

                document.getElementById("tanggal1").value = picker.startDate.format('YYYY-MM-DD');
                document.getElementById("tanggal2").value = picker.endDate.format('YYYY-MM-DD');
              });
            });

            $(document).ready(function () { 
              $("select").change(function () { 
                $(this).find("option:selected") 
                .each(function () { 
                  var optionValue = $(this).attr("value"); 
                  if (optionValue) { 
                    $(".box").not("." + optionValue).hide(); 
                    $("." + optionValue).show(); 
                  } else { 
                    $(".box").hide(); 
                  } 
                }); 
              }).change(); 
            }); 
          </script> 
        </script>
<?php $this->load->view('tema/Footer'); ?>