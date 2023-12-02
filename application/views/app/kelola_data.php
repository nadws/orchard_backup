<?php $this->load->view('tema/Header', $title); ?>


<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-12">
					<h1 class="m-0 text-dark">Kelola Data <?= $customer['nama']; ?> | Tanggal : <?= date('d-M-Y', strtotime($tgl)) ?></h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="card-header">
				<div class="col-12">
					<?= $this->session->flashdata('message'); ?>
				</div>				
			</div>
		</div>
		<div class="row">
			<div class="col-12">
			<table class="table" width="100%">
			<thead>
			<tr>
                <th >THERAPIST</th>
                <th >SERVIS</th>
                <th >JAM MULAI</th>
                <th>JAM SELESAI</th>
                <th >AKSI</th>
              </tr>
			</thead>
           
                
				<tbody style="text-align: center;">
				  <?php foreach ($d_order_all as $key => $value): ?>
              <form action="<?= base_url() ?>match/update_app_order" method="post">
                    <tr>
                      <td>
                      <select class="form-control" required="" name="id_terapis">
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
                      <!-- <td width="15%"><?= $value->nama_t ?></td> -->
					  <input type="hidden" name="id_order" value="<?= $value->id_order ?>">
					  <input type="hidden" name="tgl" value="<?= $tgl ?>">
					  <input type="hidden" name="id_customer" value="<?= $id_customer ?>">
                      <td >
					  <select class="form-control" required="" name="id_servis">
						<label for=""></label>
						<option value="">--Pilih Service--</option>
                        <?php foreach($servis as $s): ?>
                          <?php if($value->id_servis == $s->id_servis): ?>
                        <option value="<?= $s->id_servis; ?>" selected><?= $s->nm_servis; ?> | <?= $s->durasi; ?> Jam - <?= $s->menit; ?> Menit</option>
                          <?php else: ?>
                            <option value="<?= $s->id_servis; ?>" ><?= $s->nm_servis; ?> | <?= $s->durasi; ?> Jam - <?= $s->menit; ?> Menit</option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
					  </td>
                      <td >
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
                         <td >
                          <?php if ($value->status=="Selesai"): ?>
                            <span class="badge badge-success"><i class="fa fa-check"></i></span>
                            <?php else: ?>
                              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalC<?= $value->id_order ?>">Cancel</button>
                              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalS<?= $value->id_order ?>">Selesai</button>
                            <?php endif ?>
                          </td>
                        </tr>
						</form>
						<?php endforeach ?>
                      </tbody>

                    </table>
                  
               
			</div>
		</div>
	</div>


	<!-- ======================================================== conten ======================================================= -->



	<?php $this->load->view('tema/Footer'); ?>