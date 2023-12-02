
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Edit User</h1>
        </div><!-- /.col -->
      </div>

      <div class="content" style="background-color: white;" >
        <div class="row">
          <div class="card-header">
            <div class="col-12">
              <table style="margin-left: -10px;" class="table">
                <thead>
                  <tr style="border-bottom: solid;">
                    <div style="border-right: solid;">
                      <th>NAMA</th> 
                      <th>USERNAME</th>
                      <!-- <th>PASSWORD</th>     -->
                      <th>ROLE</th> 
                      <th>STATUS</th> 
                      <th>TANGGAL</th> 
                      <th>AKSI</th>
                    </div>
                  </tr>
                </thead>
                <div style="border:none;">
                  <tr>
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('Match/update_user'); ?>">
                      <input type="hidden" name="kd_user" value="<?= $kd_user; ?>">
                      <td><input style="border:none; border-bottom: solid;" type="text" class="form-control" name="nm_user" value="<?= $nm_user; ?>"></td>
                      <td><input style="border:none; border-bottom: solid;" type="text" class="form-control" name="username" value="<?= $username; ?>"></td>
                      <!-- <td><input style="border:none; border-bottom: solid;" type="password" class="form-control" name="password" value="<?= $password; ?>"></td> -->
                      <td>
                        <select style="border:none; border-bottom: solid; width: 110px;" class="form-control" name="id_role" >
                          <option value="<?= $id_role; ?>" ><?= $nm_role; ?></option>
                          <?php foreach ($role as $r): ?>
                            <option value="<?= $r->id_role ?>"><?= $r->nm_role ?></option>
                          <?php endforeach ?>
                        </select>
                      </td>
                      <td>
                        <select style="border:none; border-bottom: solid; width: 110px;" class="form-control" name="aktif">
                          <option value="<?= $aktif; ?>"><?= $aktif;   ?></option>
                          <option value="1">Aktif</option>
                          <option value="0">Non-Aktif</option>
                        </select>
                      </td>
                      <td><input style="border:none; border-bottom: solid;" type="date" class="form-control" name="tgl_masuk" value="<?= $tgl_masuk; ?>"></td>
                      <td><input type="submit" class="btn btn-primary"></td>
                    </tr>
                  </div>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- ======================================================== conten ======================================================= -->
