<?php $this->load->view('tema/Header', $title); ?>
<table class="table table-striped table-bordered" width="100%">
               <tr>
                <th>Therapist</th>
                <th >CUSTOMER - SERVIS</th>
                <th >JAM MULAI</th>
                <th>JAM SELESAI</th>
                <th >AKSI</th>
              </tr>
            </table>
    
                <table class="table" width="100%">
                <?php foreach($customer as $c): ?>
                    <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center"><strong><?= $c->nama; ?></strong></td>
                    <td></td>
                    <td></td>
                    
                    <?php foreach ($d_order_all as $key => $value): ?>
                    <?php if($c->id_customer == $value->id_customer): ?>
                       
                  <tbody style="text-align: center;">
                  <!-- <form action="<?= base_url() ?>match/update_app2" method="post"> -->
                  <form action="" method="POST" class="test">
              <input type="hidden" name="tgl" value="<?= $tgl; ?>">
                    
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
                      <td ><?= $value->nm_servis ?></td>
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
                              </form>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalC<?= $value->id_order ?>">Cancel</button>
                              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalS<?= $value->id_order ?>">Selesai</button>
                            <?php endif ?>
                          </td>
                          
                        </tbody>
                      
                    <?php endif; ?>                 
                <?php endforeach ?>
                </tr>
                <?php endforeach; ?>    
                </table>
                <?php $this->load->view('tema/Footer'); ?>