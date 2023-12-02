
<?php $this->load->view('tema/Header', $title); ?>
<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-8">
          <h1 class="m-0 text-dark float-left"> Data User</h1>
          <button type="button" class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#tambah_user"><i class="fa fa-plus"></i>Tambah User</button>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <!-- <a href="" data-toggle="modal" data-target="#modal-akses"><div class="btn bg-pink btn-block"> Hak Akses</div></a> -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div>

    <div class="content" style="background-color: white;" >
      <div class="row">
        <div class="card-header">
          <?= $this->session->flashdata('message'); ?>
          <!-- <div class="col-12"> -->
            <!-- <table style="margin-left: -10px;" class="table">
              <thead>
                <tr style="border-bottom: solid;">
                  <div style="border-right: solid;">
                    <th>NAMA</th> 
                    <th>USERNAME</th>
                    <th>PASSWORD</th>    
                    <th>ROLE</th> 
                    <th>STATUS</th> 
                    <th>AKSI</th>
                  </div>
                </tr>
              </thead>
              <div style="border:none;">
                <tr>
                  <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('Match/input_user'); ?>">
                    <td><input style="border:none; border-bottom: solid;" type="text" class="form-control" name="nm_user" placeholder="Masukan Nama" required></td>
                    <td><input style="border:none; border-bottom: solid;" type="text" class="form-control" name="username" placeholder="Nama Pengguna" required></td>
                    <td><input style="border:none; border-bottom: solid;" type="password" class="form-control" name="password" placeholder="Masukan PASSWORD" required></td>
                    <td>
                      <select style="border:none; border-bottom: solid; width: 110px;" class="form-control" name="id_role" required>
                        <option value="2">Select...</option>
                        <?php foreach ($hak as $r): ?>
                          <option value="<?= $r->id_role ?>"><?= $r->nm_role ?></option>
                        <?php endforeach ?>
                      </select>
                    </td>
                    <td>
                      <select style="border:none; border-bottom: solid; width: 110px;" class="form-control" name="aktif" required>
                        <option value="0">Select...</option>
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                      </select>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-primary btn-sm"><span class="fas fa-check"></span></button>
                    </td>
                  </tr>
                </form>
              </div>
            </table> -->
          <!-- </div> -->
          <br>

          <div class="card-header">
          
          <div class="col-12">
            <table id="example1" class="table table-striped" width="100%">
              <thead style="background-color: white;">
                <tr>
                  <th>#</th> 
                  <th>NAMA</th> 
                  <th>USERNAME</th>
                  <th>ROLE</th> 
                  <th>JOIN</th> 
                  <th>STATUS</th> 
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $i=1; foreach ($user as $d): ?>
                  <td><?= $i; ?></td>
                  <td><?= $d->nm_user; ?></td>
                  <td><?= $d->username; ?></td>
                  <td><?= $d->nm_role; ?></td>
                  <td><?= $d->tgl_masuk; ?></td>
                  <td><?php switch ($d->aktif) {
                    case '1':
                    echo "AKTIF";
                    break;

                    default:
                    echo "NON-AKTIF";
                    break;
                  } ?>
                </td>
                <td>
                  <!-- <a href="<?= base_url("Match/edit_user/"). $d->kd_user; ?>"><div class="btn btn-warning btn-sm tomboledit"><i class="fas fa-edit"></i></div></a> -->
                  <button type="button" class="btn btn-sm btn-warning permission" id_user="<?= $d->kd_user ?>" data-toggle="modal" data-target="#akses">
                    <i class="fa fa-key"></i></button>
                  </button>
                  <!-- <button type="button" id_user="<?= $d->kd_user ?>" class="btn btn-sm btn-warning permission" data-toggle="modal" data-target="#permision"><i class="fa fa-key"></i></button> -->
                  <button type="button" id="<?= $d->kd_user ?>" class="btn btn-sm btn-info edit_user" data-toggle="modal" data-target="#edit<?= $d->kd_user ?>"><i class="fa fa-edit"></i></button>
                  <a onclick="return confirm('Yakin Hapus?')" href="<?= base_url('Match/drop_user/'). $d->kd_user;?>"><div class="btn btn-danger btn-sm tombolhps"><i class="fas fa-trash"></i></div></a>
                </td> 
              </tr>
              <?php $i++; endforeach ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ======================================================== conten ======================================================= -->

<form action="<?= base_url('Match/input_user') ?>" method="POST">
<div class="modal fade" id="tambah_user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Nama</label>
                        <input class="form-control" type="text" name="nm_user" id="nm_user"  required>             
                    </div>
                                                
                </div>    
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Username</label>
                        <input class="form-control" type="text" name="username" id="username"  required>             
                    </div>
                                                
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                                                
                </div>

                <div class="col-md-12">
                        <div class="form-group">
                            <label for="list_kategori">Role</label>
                            <select name="id_role" id="id_role" class="form-control" required="">                                
                                <?php foreach($hak as $h): ?>
                                  <option value="<?= $h->id_role ?>"><?= $h->nm_role ?></option>
                                <?php endforeach; ?>  
                                <!-- <option value="3">Admin Orchard</option>
                                <option value="2">Admin</option>
                                <option value="1">Presiden</option>                   -->
                            </select>
                        </div>
                </div>

                </div>

      <div class="row justify-content-center">
          <div class="form-group col-md-3">
            <label for="list_kategori">Permission</label>
          </div>  
                
      </div>

       <div class="row">
      <?php foreach($menu as $mn): ?>
       <div class="form-group col-md-12">
       <label class="form-check-label"><strong><?= $mn->menu ?></label></strong>
        </div>
       <?php foreach($sub_menu as $smn): ?>
        <?php if($mn->id_menu == $smn->id_menu): ?>              
       <div class="form-group col-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="permission[]" value="<?= $smn->id_sub_menu ?>">
                          <label class="form-check-label"><?= $smn->sub_menu ?></label>
                    </div>
                </div>
        <?php endif; ?>
       <?php endforeach; ?>        
        <br><br><br>
      <?php endforeach; ?>  
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

<?php foreach($user as $ak): ?>
<form action="<?= base_url('Match/update_user') ?>" method="POST">
<div class="modal fade" id="edit<?= $ak->kd_user ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">

      <input type="hidden" name="kd_user" value="<?= $ak->kd_user ?>">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Nama</label>
                        <input class="form-control" type="text" name="nm_user" value="<?= $ak->nm_user ?>" required>             
                    </div>
                                                
                </div>
                    
                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="list_kategori">Role</label>
                            <select name="id_role" class="form-control" required>
                              <?php foreach($hak as $h): ?>
                                <?php if($ak->id_role == $h->id_role): ?>
                                <option value="<?= $h->id_role ?>" selected><?= $h->nm_role ?></option>
                                <?php else: ?>
                                  <option value="<?= $h->id_role ?>"><?= $h->nm_role ?></option>
                                <?php endif; ?>  
                              <?php endforeach; ?>
                                <!-- <?php if($ak->id_role == 1): ?>
                                <option value="1" selected>Presiden</option>
                                <option value="2">Admin</option>
                                <option value="3">Admin Orchard</option>
                                <?php elseif($ak->id_role == 2): ?>
                                <option value="1" >Presiden</option>
                                <option value="2" selected>Admin</option>
                                <option value="3">Admin Orchard</option>
                                <?php else: ?>
                                <option value="1" >Presiden</option>
                                <option value="2" >Admin</option>
                                <option value="3" selected>Admin Orchard</option>
                                <?php endif; ?>                   -->
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="list_kategori">Status</label>
                            <select name="aktif" class="form-control" required>
                                <?php if($ak->aktif == 1): ?>
                                <option value="1" selected>Aktif</option>
                                <option value="2">Non Aktif</option>
                                <?php else: ?>
                                <option value="1">Aktif</option>
                                <option value="2" selected>Non Aktif</option>
                                <?php endif; ?>                  
                            </select>
                        </div>
                    </div>

                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
    </div>
  </div>
</div>
</form>   
<?php endforeach; ?>

<form action="<?= base_url('Match/update_permission') ?>" method="post">
    <!-- Modal -->
    <div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Permission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <input type="hidden" name="kd_user" id="id_user">
          
            <div class="row justify-content-center">
                  <div class="form-group col-md-3">
                    <label for="list_kategori">Permission</label>
                  </div>
                </div>

                <div class="row data_permission">
                   
              </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save/Edit</button>
          </div>
        </div>
      </div>
    </div>

</form>


<!-- ==================================== -->
<div class="modal fade" id="modal-akses">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background:#FFA07A;">
        <h4 class="modal-title">Data Hak Akses </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
         <table class="table table-bordered" > 
           <thead>  
            <tr>  
              <th>NAMA</th>
              <th data-toggle="modal" data-target="#modal_i_edit">Akses 1 <i class="fas fa-info-circle"></i></th>
              <th data-toggle="modal" data-target="#modal_i_edit">Akses 2 <i class="fas fa-info-circle"></i></th>
              <th data-toggle="modal" data-target="#modal_i_edit">Akses 3 <i class="fas fa-info-circle"></i></th>
              <th data-toggle="modal" data-target="#modal_i_edit">Akses 4 <i class="fas fa-info-circle"></i></th>
              <th data-toggle="modal" data-target="#modal_i_edit">Akses 5 <i class="fas fa-info-circle"></i></th>
            </tr>
          </thead>
          <tbody>  
            <?php foreach ($hak as $d): ?>
              <tr>  
                <td><?= $d->nm_role ?></td>

                <?php if ($d->edit_hapus == '1'): ?>
                  <td ><a href="<?= base_url('Match/hak_edit/').$d->id_role; ?>"><i class="fas fa-check-circle fa-2x"></i></a></td>
                  <?php else: ?>  
                    <td><a href="<?= base_url('Match/hak_edit/').$d->id_role; ?>"><i class="fas fa-times fa-2x"> </i></a></td>
                  <?php endif ?>

                  <?php if ($d->input == '1'): ?>
                    <td ><a href="<?= base_url('Match/hak_input/').$d->id_role; ?>"><i class="fas fa-check-circle fa-2x"></i></a></td>
                    <?php else: ?>  
                      <td><a href="<?= base_url('Match/hak_input/').$d->id_role; ?>"><i class="fas fa-times fa-2x"> </i></a></td>
                    <?php endif ?>

                    <?php if ($d->i_grade == '1'): ?>
                      <td ><a href="<?= base_url('Match/hak_edit2/').$d->id_role; ?>"><i class="fas fa-check-circle fa-2x"></i></a></td>
                      <?php else: ?>  
                        <td><a href="<?= base_url('Match/hak_edit2/').$d->id_role; ?>"><i class="fas fa-times fa-2x"> </i></a></td>
                      <?php endif ?>

                      <?php if ($d->e_grade == '1'): ?>
                        <td ><a href="<?= base_url('Match/hak_input2/').$d->id_role; ?>"><i class="fas fa-check-circle fa-2x"></i></a></td>
                        <?php else: ?>  
                          <td><a href="<?= base_url('Match/hak_input2/').$d->id_role; ?>"><i class="fas fa-times fa-2x"> </i></a></td>
                        <?php endif ?>

                        <?php if ($d->gudang == '1'): ?>
                          <td ><a href="<?= base_url('Match/hak_gudang/').$d->id_role; ?>"><i class="fas fa-check-circle fa-2x"></i></a></td>
                          <?php else: ?>  
                            <td><a href="<?= base_url('Match/hak_gudang/').$d->id_role; ?>"><i class="fas fa-times fa-2x"> </i></a></td>
                          <?php endif ?>

                        </tr>
                      <?php endforeach ?>
                    </tbody> 
                  </table>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button data-toggle="modal" data-target="#modal-tambah" class="btn bg-pink"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal_i_edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background:#FFA07A;">
                <h4 class="modal-title">INFO !!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <h4>Akses 1 :</h4>
                  <p>Tampilkan <b>EXPORT DAN DELETE</b> pada halaman <b>Utama</b></p>
                  <h4>Akses 2 :</h4>
                  <p>Bisa Menginput-edit-hapus <b>Karyawan Baru</b> baru pada halaman <b>TB-Karyawan</b></p>
                  <h4>Akses 3 :</h4>
                  <p>Bisa Menginput-edit-hapus <b>Pemakai Baru</b> baru pada halaman <b>TB-Pemakai</b></p>
                  <h4>Akses 4 :</h4>
                  <p>Bisa Menginput-edit-hapus <b>Shift Baru</b> baru pada halaman <b>TB-Shift</b></p>
                </h4>
                <h4>Akses 5 :</h4>
                <p>ini <b>Belum</b></p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>


      <form action="<?= base_url("Match/input_role"); ?>" method="POST">
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background:#FFA07A;">
                <h4 class="modal-title">Tambah Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <h4>Nama Role :</h4>
                  <input style="border:none; border-bottom: solid;" class="form-control" type="text" name="nm_role" placeholder="Isi Disini !!">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn bg-pink">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  
  <script>      

      $(document).ready(function(){
        $('.permission').click(function(){
          var kd_user = $(this).attr('id_user');
          $('#id_user').val(kd_user);

          $.ajax({  
                     url:"<?= base_url(); ?>Match/get_permission",  
                     method:"POST",
                     data:{kd_user:kd_user},  
                     success:function(data)  
                     {  
                      $('.data_permission').html(data); 
                     }  
                });

        });
      });

  </script>


      <?php $this->load->view('tema/Footer'); ?>