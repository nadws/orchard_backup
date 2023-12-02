<?php $this->load->view('tema/Header'); ?>

<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="float-left">Tambah Produk</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url("Match/add_produk2") ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="list_kategori">Kategori</label>
                            <select  name="id_kategori" id="list_kategori" class="form-control select" required>
										<option value="">- Pilih kategori -</option>
										<?php foreach ($kategori as $kategori): ?>
											<option value="<?= $kategori->id_kategori ?>"><?= $kategori->nm_kategori ?></option>
										<?php endforeach ?>
									</select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="list_kategori">Satuan</label>
                            <select  name="id_satuan" class="form-control select" required>
										<option value="">- Pilih Satuan -</option>
										<?php foreach ($satuan as $satuan): ?>
											<option value="<?= $satuan->id_satuan ?>"><?= $satuan->satuan ?></option>
										<?php endforeach ?>
									</select>
                        </div>
                    </div>
                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Nama Produk</label>
                        <input class="form-control" type="text" placeholder="Isi nama produk" name="nama" required>
                                        
                    </div>                            
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Stok</label>
                        <input class="form-control" type="number" placeholder="Cth : 1" name="stok" required>                          
                    </div>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Harga Modal</label>
                        <input class="form-control" type="number" placeholder="Cth : 50000" name="harga_modal" required>                          
                    </div>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Harga Jual</label>
                        <input class="form-control" type="number" placeholder="Cth : 50000" name="harga" required>                          
                    </div>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Foto</label>
                        <input class="form-control" type="file" name="foto">                          
                    </div>                            
                </div>



                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right ml-2">Input</button>
            <a href="<?= base_url('match/tambah_produk_masuk') ?>" class="btn btn-warning float-right">Cancel</a>
                                                
            </form>                                
        </div>
                                            
    </div>
    </div>
</div>
    
</div>

<?php $this->load->view('tema/Footer'); ?>