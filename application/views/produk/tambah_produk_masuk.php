<?php $this->load->view('tema/Header'); ?>

<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="float-left">Input Produk Masuk</h3>
            <a href="<?= base_url('match/tambah_produk') ?>" class="btn btn-info float-right">Tambah Produk</a>
        </div>
        <div class="card-body">
            <form action="<?= base_url("Match/add_produk_masuk") ?>" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl">Tanggal</label>
                            <input type="date" class="form-control" id="tgl" name="tgl" value="<?= date('Y-m-d'); ?>" >
                        </div>
                    </div>
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
                            <label for="list_kategori">Produk</label>
                            <select  name="id_produk" class="form-control select" id="list_produk" required>
										<option value="">- Pilih Produk -</option>
							</select>
                        </div>
                    </div>
                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Jumlah</label>
                        <input class="form-control" type="number" placeholder="Jumlah" name="jumlah" required>
                                        
                    </div>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Harga Beli</label>
                        <input class="form-control" type="number" placeholder="Harga Beli" name="hrg_beli" required>                          
                    </div>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Tanggal Expired</label>
                        <input class="form-control" type="date" name="tgl_expired"  required>                          
                    </div>                            
                </div>



                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right ml-2">Input</button>
            <a href="<?= base_url('match/produk_masuk') ?>" class="btn btn-warning float-right">Cancel</a>
                                                
            </form>                                
        </div>
                                            
    </div>
    </div>
</div>
    
</div>

<?php $this->load->view('tema/Footer'); ?>