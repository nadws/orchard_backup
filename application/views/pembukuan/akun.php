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
		<div class="row justify-content-center">
			<div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
			</div>
			<div class="col-md-12">
      
				<div class="card">
                    <div class="card-header">
                       <h3 class="float-left">Data Akun</h3>
                       
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right mr-2" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Akun</button>
                       <a href="<?= base_url('Jurnal/export_akun') ?>" class="btn btn-sm btn-outline-secondary float-right mr-2"><i class="fa fa-file-excel"></i> Export Excel</a>
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right mr-2" data-toggle="modal" data-target="#import_akun"><i class="fa fa-file-excel"></i> Import Akun</button>

                      </div>
                        <?php $i=1; ?>
                        
                    <div class="card-body">
                    
                        <table class="table mt-2" id="example1">
                            <thead>
                                <tr>
									                <th>#</th>
                                    <th >Kategori</th>
                                    <th >Akun</th>
                                    <th>Post Center</th>                                    
                                    <th >No Akun</th>
                                    <th>Type</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            <?php foreach($akun as $a) : 
                            $dt_post = $this->db->get_where('tb_post_center',['id_akun' => $a->id_akun])->result();
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                    <td><?= $a->nm_kategori ?></td>
                                    <td><?= $a->nm_akun ?></td>
                                    <td>
                                      <?php foreach($dt_post as $p): ?>
                                        <?= $p->nm_post ?>,
                                      <?php endforeach; ?>  
                                    <br>  
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn_post_center" data-toggle="modal" data-target="#add_post_center" id_akun="<?= $a->id_akun ?>">Post Center </button></td>
                                    <td><?= $a->no_akun ?></td>
                                    <td>
                                    <form action="<?= base_url('Match/edit_type_akun') ?>" method="post">
                                    <input type="hidden" name="id_akun" value="<?= $a->id_akun ?>">
                                    <div class="form-check">
                                          <?php if($a->pl == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="pl" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="pl" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">P & L</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->neraca == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="neraca" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="neraca" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Neraca</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->penyesuaian == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="penyesuaian" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="penyesuaian" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Penyesuaian</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->neraca_saldo == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="neraca_saldo" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="neraca_saldo" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Neraca Saldo</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->penutup == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="penutup" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="penutup" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Penutup</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->aktiva_l == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="al" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="al" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Aktiva Lancar</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->aktiva_t == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="at" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="at" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Aktiva Tetap</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->ekuitas == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="ekuitas" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="ekuitas" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Ekuitas</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->pendapatan == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="pendapatan" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="pendapatan" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Laporan Pendapatan</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->pengeluaran == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="pengeluaran" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="pengeluaran" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Laporan Pengeluaran</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->biaya_fix == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="biaya_fix" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="biaya_fix" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Biaya Tetap</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->pph_hutang == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="pph_hutang" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="pph_hutang" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">PPH Terhutang</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->pendapatan_bank == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="pendapatan_bank" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="pendapatan_bank" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Pendapatan Bunga</label>
                                    </div>

                                    <div class="form-check">                            
                                        <?php if($a->akun_gantung == 'Y'): ?>          
                                          <input class="form-check-input" type="checkbox" name="akun_gantung" value="Y" checked>
                                          <?php else: ?>
                                        <input class="form-check-input" type="checkbox" name="akun_gantung" value="Y">
                                        <?php endif; ?>
                                          <label class="form-check-label">Akun Gantung</label>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-check-double"></i> Sava/Edit</button>
                                    </form>        
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#edit<?= $a->id_akun ?>"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#relation<?= $a->id_akun ?>">Relation</button>
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

    <style>
        .modal-lg {
          max-width: 800px;
          margin: 2rem auto;
        }
  </style>

<form action="<?= base_url('Jurnal/import_akun') ?>" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="import_akun" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Import Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Masukan File Excel</label>
                        <input type="file" name="data_akun" class="form-control" required>             
                    </div>                                        

                </div>

                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
    </div>
  </div>
</div>
</form>

  <!-- Modal -->
<form action="<?= base_url('Jurnal/add_post_center') ?>" method="POST">
<div class="modal fade" id="add_post_center" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Post Center</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        <input type="hidden" name="id_akun" id="id_akun_post">

          <div class="col-md-12">
              <div class="form-group">
                  <label for="list_kategori">Nama Post Center</label>
                  <input class="form-control" type="text" name="nm_post" required>             
              </div>                                          
          </div>

    
          </div>
          <div id="form_post_center"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Input</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal -->
<form action="<?= base_url('Match/add_akun') ?>" method="POST">
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">No Akun</label>
                        <input class="form-control" type="text" name="no_akun" id="no_akun" placeholder="Cth: 1200,3"  required>             
                        <small class="text-warning">Harus sesuai kode akuntant</small>
                    </div>
                                                
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Nama Akun</label>
                        <input class="form-control" type="text" name="nm_akun" id="nm_akun" required>             
                    </div>                           
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Kode Akun</label>
                        <input class="form-control" type="text" name="kd_akun" id="kd_akun" required>             
                    </div>                           
                </div>
    
                    
                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="list_kategori">Kategori Akun</label>
                            <select name="id_kategori" id="id_kategori" class="form-control select" required="">
                                <?php foreach($kategori as $k): ?>    
                                <option value="<?= $k->id_kategori ?>"><?= $k->nm_kategori ?></option>
                                <?php endforeach ?>                    
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-group col-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="pl" value="Y">
                          <label class="form-check-label">P & L</label>
                    </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="neraca" value="Y">
                          <label class="form-check-label">Neraca</label>
                    </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="penyesuaian" value="Y">
                          <label class="form-check-label">Penyesuaian</label>
                    </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="neraca_saldo" value="Y">
                          <label class="form-check-label">Neraca Saldo</label>
                    </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="penutup" value="Y">
                          <label class="form-check-label">Penutup</label>
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

<?php foreach($akun as $ak): ?>
<form action="<?= base_url('Match/edit_akun') ?>" method="POST">
<div class="modal fade" id="edit<?= $ak->id_akun ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row justify-content-center">

      <input type="hidden" name="id_akun" value="<?= $ak->id_akun ?>">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">No Akun</label>
                        <input class="form-control" type="text" name="no_akun" value="<?= $ak->no_akun ?>" required>             
                        <small class="text-warning">Harus sesuai kode akuntant</small>
                    </div>
                                                
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Kode Akun</label>
                        <input class="form-control" type="text" name="kd_akun" value="<?= $ak->kd_akun ?>" required>
                        <small class="text-warning">Kode akun berpengaruh dengan no nota</small> 
                    </div>
                                               
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="list_kategori">Nama Akun</label>
                        <input class="form-control" type="text" name="nm_akun" required value="<?= $ak->nm_akun ?>">             
                    </div>                           
                </div>
    
                    
                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="list_kategori">Kategori Akun</label>
                            <select name="id_kategori" class="form-control select" required="">
                                <?php foreach($kategori as $k): ?>
                                <?php if($k->id_kategori == $ak->id_kategori): ?>    
                                    <option value="<?= $k->id_kategori ?>" selected><?= $k->nm_kategori ?></option>
                                <?php else: ?>
                                    <option value="<?= $k->id_kategori ?>"><?= $k->nm_kategori ?></option>
                                <?php endif; ?>
                                <?php endforeach ?>                    
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-group col-md-4">
                        <div class="form-check">
                          <?php if($ak->pl == 'Y'): ?>          
                          <input class="form-check-input" type="checkbox" name="pl" value="Y" checked>
                          <?php else: ?>
                         <input class="form-check-input" type="checkbox" name="pl" value="Y">
                         <?php endif; ?>
                          <label class="form-check-label">P & L</label>
                    </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">                            
                        <?php if($ak->neraca == 'Y'): ?>          
                          <input class="form-check-input" type="checkbox" name="neraca" value="Y" checked>
                          <?php else: ?>
                         <input class="form-check-input" type="checkbox" name="neraca" value="Y">
                         <?php endif; ?>
                          <label class="form-check-label">Neraca</label>
                    </div>
                    </div>  -->

                <!-- </div> -->

                

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

<?php endforeach; ?>

<?php foreach($akun_relation as $d): ?>

<form action="<?= base_url('Jurnal/add_relation_akun') ?>" method="POST">
<div class="modal fade" id="relation<?= $d->id_akun ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Relation Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row justify-content-center">

      <input type="hidden" name="id_akun" value="<?= $d->id_akun ?>">
  
                <div class="col-12">
                    <p class="text-warning">Digunakan untuk menentukan pasangan ketika melakukan penyesuaian akun</p>
                </div>

                <div class="col-12">
                        <div class="form-group">
                            <label for="list_kategori">Akun Debit</label>
                            <select name="id_relation_debit" class="form-control select" required="">
                              <?php if(!$d->id_relation_debit): ?>
                            <option value="">-Pilih Akun-</option>
                               <?php endif; ?> 
                                <?php foreach($akun as $k): ?>                                   
                                    <option value="<?= $k->id_akun ?>" <?= $d->id_relation_debit == $k->id_akun ? 'selected' : '' ?>><?= $k->nm_akun ?></option>                                
                                <?php endforeach ?>                    
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="list_kategori">Akun kredit</label>
                            <select name="id_relation_kredit" class="form-control select" required="">
                              <?php if(!$d->id_relation_kredit): ?>
                                 <option value="">-Pilih Akun-</option>
                               <?php endif; ?> 
                                <?php foreach($akun as $k): ?>                                   
                                    <option value="<?= $k->id_akun ?>" <?= $d->id_relation_kredit == $k->id_akun ? 'selected' : '' ?>><?= $k->nm_akun ?></option>                                
                              <?php endforeach ?>                    
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

  $(document).on('click', '.btn_post_center', function() {

            var id_akun = $(this).attr("id_akun");
            $('#id_akun_post').val(id_akun);

            $.ajax({
                url:"<?= base_url(); ?>Jurnal/get_data_post_center/",
                method:"POST",
                data:{id_akun:id_akun},
                success:function(data){
                $('#form_post_center').html(data);                                  
                }
              });

        });

// function kodeOtomatis(akun,id_akun){
//   var tgl = $('#tgl').val();
//   var tgl1    = tgl.split("-");
//   var bulan   = tgl1[1];
//   var tahun   = tgl1[0];
//   var tahun2  = tahun.substring(2, 4)
//   var kode    = akun+bulan+tahun2;

//   $.ajax({
//                 url:"<?= base_url(); ?>Match/kode/",
//                 method:"POST",
//                 data:{id_akun:id_akun, tgl:tgl},
//                 success:function(data){
//                 $('#no_nota').val(kode+data);
                                  
//                 }

//               });

// //   
//   // alert(kode);
// }

// $('#id_akun').change(function(){

//   var kode = $(this).find("option:selected").text();
//   var id_akun = $(this).val();
//   var hurufDepan          = kode.substring(0,1);
//   var panjang = kode.length;
//   var hurufBelakang       = kode.substring(panjang-1, kode.length);
//   var hurufTengah         = kode.substring(panjang/2, (panjang/2)+1);

//   var akun2 = hurufDepan+hurufTengah+hurufBelakang;
//   var akun1 = akun2.toUpperCase();
//   var akun = akun1.replace(/\s/g, '');


//   kodeOtomatis(akun, id_akun);


// });

//         $('#debit').keyup(function(){
// 			var total = $(this).val();
//             $('#total').val(total);


//           });
		
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

