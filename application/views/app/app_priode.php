<?php $this->load->view('tema/Header'); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

        <div class="content-header">
          <div class="container">
            <div class="row mb-2">
              <div class="col-sm-10">
                <h1 class="m-0 text-dark">Record Appointment | Tanggal : <?= date('d-M-Y', strtotime($tgl)) ?></h1>
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
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Therapist</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#generate"><i class="fa fa-plus"></i> Generate</button>
            
            <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalA"><i class="fa fa-plus"></i> Appointment</button> -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#input2"><i class="fa fa-plus"></i> Appointment</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus_terapis"><i class="fas fa-trash"></i> Hapus Terapis</button>
            <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalK"><i class="fa fa-edit"></i> Kelola</button> -->
            <!-- <button type="button" class="btn btn-warning tombol_kelola" ><i class="fa fa-edit"></i> Kelola</button> -->
            <a href="<?= base_url(); ?>/match/kelola_app?tgl=<?= $tgl; ?>" class="btn btn-warning"><i class="fas fa-tasks"></i> Kelola</a>
            <button data-toggle="modal" data-target="#modal-app" class="btn btn-dark"><i class="fas fa-calendar"></i> Appointment / Periode</button>
            <button data-toggle="modal" data-target="#list_appointment" class="btn btn-success"><i class="fas fa-list-ul"></i></i> List Appointment</button>
            <!-- <a href="<?= base_url(); ?>match/list_appointment?tgl=<?= $tgl; ?>" class="btn btn-success"><i class="fas fa-list-ul"></i> List Appointment</a> -->
            <!-- <button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button><br><br> -->
            
            <?= $this->session->flashdata('message'); ?>
            <center>
              <div class="card">
                <div class="card-header">
                  <div class="card-body">
                    <hr>
                    <div id="sked2"></div>
                    <!-- <div id="sked3"></div> -->
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

        <footer class="main-footer shadow" style=" background:#fadadd;">
          <div class="float-right d-none d-sm-inline" >
            Anything you want
          </div>
          <strong >Copyright &copy; 2020.09.29 <a href="<?= 'https:www.putrirembulan.com'; ?>" target="" style="color: #787878;" >putrirembulan.com</a></strong>
        </footer>
      </div>


      <div class="modal fade" id="generate" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <form action="<?= base_url() ?>match/generate_terapis" method="post">
            <div class="modal-content">
              <div class="modal-header" style="background: #FFA07A;">
                <h4 class="modal-title">Generate Therapist</h4>
                <input type="hidden" name="tgl" value="<?= $tgl; ?>">
                <input type="hidden" name="tzoffset" value="-10 * 60">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <p>Generate 10 data therapist</p>
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-info">Generate</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <style>
        .modal-lg {
          max-width: 600px;
          margin: 2rem auto;
        }
      </style>

<form action="<?= base_url('Match/list_appointment'); ?>" method="get">
					<div class="modal fade" id="list_appointment">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background:#FFA07A;">
									<h4 class="modal-title">List Appointment</h4>
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
												<td> <input style="width: 350px;" class="form-control" type="input" id="picker"></td>
											</tr>
										</table>

										<input class="form-control" type="date" value="" id="tanggal1" name="tgl1" hidden>  
										<input class="form-control" type="date" value="" id="tanggal2" name="tgl2" hidden> 
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

      <!-- <div class="modal fade" id="myModalK" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #FFA07A;">
              <h4 class="modal-title">Kelola Appointment</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
             <table class="table table-striped table-bordered" width="100%">
               <tr>
                <th width="15%">Therapist</th>
                <th width="25%">CUSTOMER - SERVIS</th>
                <th width="21%">JAM MULAI</th>
                <th>JAM SELESAI</th>
                <th width="18%">AKSI</th>
              </tr>
            </table>
            <?php foreach ($d_order_all as $key => $value): ?>
              <form action="<?= base_url() ?>match/update_app2" method="post">
              <input type="hidden" name="tgle" value="<?= $tgl; ?>">
                <table class="table table-striped table-bordered" width="100%">


                  <tbody style="text-align: center;">


                    <tr>
                    <td>
                      <select class="form-control" required="" name="id_t">
                        <label for=""></label>
                        <?php foreach($terapis as $tr): ?>
                          <?php if($value->id_terapis == $tr->id_terapis): ?>
                        <option value="<?= $tr->id_terapis; ?>" selected><?= $tr->nama_t; ?></option>
                          <?php else: ?>
                            <option value="<?= $tr->id_terapis; ?>" ><?= $tr->nama_t; ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                      </td>
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
        </div> -->

        <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <form action="<?= base_url() ?>match/app_add_terapis2" method="post">
            <div class="modal-content">
              <div class="modal-header" style="background: #FFA07A;">
                <h4 class="modal-title">Tambah Therapist</h4>
                <input type="hidden" name="tgl" value="<?= $tgl ?>">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label for="">Therapist</label>
                  <select name="terapis[]" id="terapis1" class="form-control select" required="" multiple="multiple">
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


      <div class="modal fade" id="hapus_terapis" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <form action="<?= base_url() ?>match/hapus_terapis2" method="post">
            <div class="modal-content">
              <div class="modal-header" style="background: #FFA07A;">
                <h4 class="modal-title">Hapus Therapist</h4>
                <input type="hidden" name="tgl" value="<?= $tgl ?>">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label for="">Therapist</label>
                  <select name="id_terapis[]" id="terapis" class="form-control select" required="" multiple="multiple">
                    <option value="">- Pilih Therapist -</option>
                    <?php foreach ($terapis as $key => $value): ?>
                <option value="<?= $value->id_terapis?>"><?= $value->nama_t ?></option>
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

      
        
        <!-- <div class="modal fade modal_kelola" id="modal_kelola" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: #FFA07A;">
              <h4 class="modal-title">Kelola Appointment2</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="get_kelola">
            <form action="post" class="coba-form">                  
             
              </div>
            </div>
          </div>
        </div>  -->



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
  <form action="<?= base_url('Match/app_priode'); ?>" method="get">
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


<!-- <div class="modal fade" id="myModalA" role="dialog">
  <div class="modal-dialog"> -->

    <!-- Modal content-->
    <!-- <form action="<?= base_url() ?>match/app_add_order_multiple2" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background: #FFA07A;">
          <h4 class="modal-title">Input Appointment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="tgl" value="<?= $tgl; ?>">        
          <div class="form-group">
            <label for="">Therapist</label>
            <select name="id_terapis[]" id="" multiple="multiple" class="form-control select" required="">
              <option value="">- Pilih Therapist -</option>
              <?php foreach ($terapis as $key => $value): ?>
                <option value="<?= $value->id_terapis?>"><?= $value->nama_t ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group pilih-metode">
            <label for="">Customer</label>
            <select class="form-control" id="" required="">
              <label for=""></label>
              <option value="manual">Input Manual</option>
              <option value="customer">Dari Data Customer</option>
            </select>
          </div>
            <div class="form-group data-customer">
              <select name="id_customer" id="" class="form-control select data-customer" disabled>
                <option value="">- Pilih Customer -</option>
                <?php foreach ($customer as $key => $value): ?>
                  <option value="<?= $value->id_customer ?>"><?= $value->nama ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="customer" class="form-control manual" placeholder="Isi Nama Customer" disabled>
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
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div> -->

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
              <select name="id_customer" id="d_customer" class="form-control  data-customer id_customer" disabled>
                <option value="">- Pilih Customer -</option>
                <?php foreach ($customer as $key => $value): ?>
                  <option value="<?= $value->id_customer ?>"><?= $value->nama ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="customer" class="form-control manual customer" placeholder="Isi Nama Customer" disabled>
              <input type="hidden" name="" class="tgl" value="<?= $tgl; ?>">
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
        <form action="<?= base_url() ?>match/selesai_app1" method="post">
        <input type="hidden" name="tgl" value="<?= $tgl; ?>">
          <div class="modal-body">
            <table class="table table-striped">
              <tr>
                <th width="50%">Therapist</th>
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
              <input type="number" name="total" class="form-control" placeholder="Total Rp" value="<?= $value->biaya; ?>" readonly required>
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
        <form action="<?= base_url() ?>match/drop_app2" method="post">
          <div class="modal-body">
            <table class="table table-striped">
              <tr>
                <th width="50%">Therapist</th>
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
              <input type="hidden" name="tgl" class="form-control" value="<?= $tgl ?>">
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
// $tgl2 = date('Y-m-d', strtotime('+1 days', strtotime($tgl)));
$awal  = date_create($tgl);
$akhir = date_create();
$diff  = date_diff( $awal, $akhir );
// $hari = $diff->d;
// $jam = $diff->h;
$convert_jam = $diff->days*24;
// $convert_jam = $hari;
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
    // data_diagram();
    // function data_diagram()
    //   {
    //     var tgl = <?php echo json_encode($tgl); ?>;
    //     $.ajax({
    //     method:"POST",
    //     url:"<?php echo base_url() ?>match/get_diagram/",
    //     data: {tgl:tgl},
    //     dataType:"json",
    //     success:function(hasil)
    //       {
            // var y = JSON.parse(hasil);
            // alert(hasil.name)
          //   function besok(hours, minutes) {
          //     var hour = document.getElementById("jam").value;
          //     var a = parseInt(hour);
          //     var date = today(hours, minutes);
          //     date.setTime(date.getTime() + a * 60 * 60 * 1000);
          //     return date;
          //   }
          //   var sked2Config = {
          //     caption: 'Therapist',
          //     start: besok(10, 0),
          //     end: besok(18, 0),
          //     showEventTime: true,
          //     showEventDuration: true,
          //     locations: hasil.map(function(location) {
          //       var newLocation = $.extend({}, location);
          //       delete newLocation.tzOffset;
          //       return newLocation;
          //     }),
          //     events: hasil.d_l.slice(),
          //     tzOffset: 0,
          //     sorting: true,
          //     orderBy: 'name',
          //     formatters: {
          //         date: function (date) {
          //           return $.fn.skedTape.format.date(date, "l", ".");
          //         },
          //         duration: function (ms, opts) {
          //           return $.fn.skedTape.format.duration(ms, {
          //             hrs: " jam.",
          //             min: " menit."
          //           });
          //         },
          //       },
          //  postRenderEvent: function($el, event)
          // {
                        
          //   if(event.url == 'Selesai'){
          //   $el.prepend('<i class="fas fa-thumbs-up"></i> ');
          // }else{
          //   $el.prepend('<i class="fas fa-times-circle"></i>');
          // }
          // }            
          // };
          // var $sked2 = $.skedTape(sked2Config);
          //   $sked2.appendTo('#sked3').skedTape('render');
      //     }
      //   })
      // }
      

  });
</script>
<?php  
$d_o = array();

if ($this->session->userdata('id_role')=='1'){
  foreach ($d_order as $key => $value) 
    {
      $nama_t =  $value['nama_t'];
      $total = number_format($value['total']) ;
      $d = array(
        'id'  => $value['id_terapis'],
        'name'  => "$nama_t ($total)",
        'tzOffset'  => $value['tzoffset'],
      );
      $d_o[] = $d;
    }
}else{
  foreach ($d_order as $key => $value) 
    {

      $d = array(
        'id'  => $value['id_terapis'],
        'name'  => $value['nama_t'],
        'tzOffset'  => $value['tzoffset'],
      );
      $d_o[] = $d;
    }
}

$data = array();
foreach ($d_order_d as $key => $value) 
{
  $d = array(
    'name'  => $value['nama'].' - '.$value['nm_servis'],
    'location'  => $value['location'],
    'start'  => $value['start_t'],
    'end'  => $value['end_t'],
    'url'  => $value['status'],
    'className' => $value['bayar']
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

            function besok(hours, minutes) {
              var hour = document.getElementById("jam").value;
              var a = parseInt(hour);
              var date = today(hours, minutes);
              date.setTime(date.getTime() + a * 60 * 60 * 1000);
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
              caption: 'Therapist',
              start: custom(8, 0),
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
              formatters: {
                  date: function (date) {
                    return $.fn.skedTape.format.date(date, "l", ".");
                  },
                  duration: function (ms, opts) {
                    return $.fn.skedTape.format.duration(ms, {
                      hrs: " jam.",
                      min: " menit."
                    });
                  },
                },
            //     postRenderLocation: function ($el, location, canAdd) {
            //   this.constructor.prototype.postRenderLocation($el, location, canAdd);
            //   $el.prepend('<i class="fas fa-plus"></i> ');
            // },
            postRenderEvent: function($el, event)
          {
            
            if(event.className == 'Y'){
              $el.prepend('<span class="text-warning"><strong>PAID</strong></span> ');
            }else{
              if(event.url == 'Selesai'){
            $el.prepend('<i class="fas fa-thumbs-up"></i> ');
            }else{
              $el.prepend('<i class="fas fa-times-circle"></i>');
            }
            }

            


          }            
          };
            var $sked2 = $.skedTape(sked2Config);
            $sked2.appendTo('#sked2').skedTape('render');
			//$sked2.skedTape('destroy');
      // $sked2.skedTape(sked2Config);
            // --------------------------- Example 3 ---------------------------
            // $('#modal1').on('shown.bs.modal', function() {
            //   $('#sked3').skedTape(sked2Config);
            // });
           

            // var $skedTabBtn = $('a[data-toggle="tab"][href="#sked-tab"]');
            // $skedTabBtn.on('shown.bs.tab', function(e) {
            //   $('#sked4').skedTape(sked2Config);
            // });
            // $skedTabBtn.on('hidden.bs.tab', function(e) {
            //   $('#sked4').skedTape('destroy');
            // });
          </script>
          <script>
            $(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });


             //Customer Not Found
    $(document).ready(function() {
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


            //appointment
      $(document).ready(function(){
      var count = 1;
      $('#addappointment').click(function(){
        count = count + 1;
        var html_code = "<tr id='row"+count+"'>";
        var jam_mulai = $("#jam_mulai").val();

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

        if(id_customer == '' && customer == ''){
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
          setTimeout("window.location.href='<?= base_url(); ?>match/app_priode?tgl=<?= $tgl; ?>'", 700);          
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

//kelola appointment
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
                $('#get_kelola').html(hasil);
              }
            });
          }

          $(document).on('click','.tombol_kelola', function(event){
           
            $('#modal_kelola').modal('show');
            load_kelola();
            
          });

          $(document).on('click','.update_app', function(event){
            var id_order = $(this).attr("id");
           var tgl = $("#tgl_"+id_order).val();
           var id_terapis = $("#id_terapis_"+id_order).val();
           var start = $("#start_"+id_order).val();
           var end = $("#end_"+id_order).val();
           var id_servis = $("#id_servis_"+id_order).val();
          // alert(tgl);
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
           
           
         });

          

          
          
});
          </script> 
        </script>
<?php $this->load->view('tema/Footer'); ?>