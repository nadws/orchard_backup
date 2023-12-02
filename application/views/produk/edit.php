<?php $this->load->view('tema/Header'); ?>

<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="float-left">Edit Produk</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url("Match/update_produk") ?>" method="POST">
                <div class="row">
                    <input type="hidden" name="id_produk" value="<?= $produk->id_produk ?>">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="list_kategori">Kategori</label>
                            <select  name="id_kategori" class="form-control" required>
								            <option value="">- Pilih Kategori -</option>
								            	<?php foreach ($kategori as $kategori): ?>
							                    <option value="<?= $kategori->id_kategori ?>" <?php if($kategori->id_kategori==$produk->id_kategori){echo "selected";} ?>><?= $kategori->nm_kategori ?></option>
                                                <?php endforeach ?>
							</select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="list_kategori">Satuan</label>
                            <select name="id_satuan" class="form-control" required>
								            <option value="">- Pilih Satuan -</option>
								            	<?php foreach ($satuan as $satuan): ?>
							                    <option value="<?= $satuan->id_satuan ?>" <?php if($satuan->id_satuan==$produk->id_satuan){echo "selected";} ?>><?= $satuan->satuan ?></option>
                                                <?php endforeach ?>
							</select>
                        </div>
                    </div>
                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Nama Produk</label>
                        <input value="<?= $produk->nm_produk ?>" class="form-control" type="text" placeholder="Isi nama produk" name="nama" required>
                                        
                    </div>                            
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Stok</label>
                        <input value="<?= $produk->stok ?>" class="form-control" type="number" placeholder="Cth : 1" name="stok" required>                          
                    </div>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Harga Modal</label>
                        <input value="<?= $produk->harga_modal ?>" class="form-control" type="number" placeholder="Cth : 50000" name="harga_modal" >                          
                    </div>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Harga Jual</label>
                        <input value="<?= $produk->harga ?>" class="form-control" type="number" placeholder="Cth : 50000" name="harga" required>                          
                    </div>                            
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Komisi %</label>
                        <input value="<?= $produk->komisi ?>" class="form-control" type="text" name="komisi" >                          
                    </div>
                    <small class="text-warning">Dihitung berdasarkan persen, Cth: 10</small>                            
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Diskon %</label>
                        <input value="<?= $produk->diskon ?>" class="form-control" type="text" name="diskon" >                          
                    </div>
                    <small class="text-warning">Dihitung berdasarkan persen, Cth: 10</small>                            
                </div>

                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="list_kategori">Foto</label>
                        <input class="form-control" type="file" name="foto">                          
                    </div>                            
                </div> -->



                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right ml-2">Edit</button>
            <a href="<?= base_url() ?>match/produk" class="btn btn-warning float-right">Cancel</a>
                                                
            </form>                                
        </div>
                                            
    </div>
    </div>
</div>
    
</div>

<?php $this->load->view('tema/Footer'); ?>