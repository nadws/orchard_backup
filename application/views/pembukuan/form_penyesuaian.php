<?php if($dt_relation && $dt_relation): ?>
    <div class="row">

        <div class="col-sm-3 col-md-3">
              <div class="form-group">
                  <label for="list_kategori">Tanggal</label>
                  <input class="form-control" type="date" name="tgl" value="<?= $tgl ?>" required>
                                  
              </div>                            
          </div>

          <div class="mt-3 ml-1">
            <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>                           
          </div>

              
              <div class="col-sm-4 col-md-4">
                  <div class="form-group">
                      <label for="list_kategori">Akun</label>
                      <input class="form-control" type="text" value="<?= $dt_relation->akun_debit ?>" disabled>
                      <input class="form-control" type="hidden" value="<?= $dt_relation->id_debit ?>" name="id_akun">
                      <!-- <select name="id_akun" id="id_akun" class="form-control select" required="">
                          <?php foreach($akun as $a): ?>    
                          <option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option>
                          <?php endforeach ?>                    
                      </select> -->
                  </div>
              </div>
              
          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                  <label for="list_kategori">Debit</label>
                  <input type="number" class="form-control total_aktiva" name="debit">                                        
              </div>                            
          </div>
          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                  <label for="list_kategori">Kredit</label>
                  <input type="number" class="form-control" readonly>                                        
              </div>                            
          </div>

          <div class="col-sm-3 col-md-3">
                                
          </div>

          <div class="mt-1">
            <p class="mt-1 ml-3 text-warning"><strong>Cr</strong></p>                           
          </div>

          <div class="col-sm-4 col-md-4">
              <div class="form-group">
                      <!-- <select name="metode" id="metode" class="form-control select" required>
                        <?php foreach($akun as $k): ?>
                        <option value="<?= $k->id_akun ?>"><?= $k->nm_akun ?></option>
                        <?php endforeach; ?>                 
                      </select> -->
                      <input class="form-control" type="text" value="<?= $dt_relation->akun_kredit ?>" disabled>
                      <input class="form-control" type="hidden" name="metode" value="<?= $dt_relation->id_kredit ?>">
                  </div>                  
          </div>

          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                  
                  <input type="number" class="form-control" readonly>                                        
              </div>                            
          </div>
          <div class="col-sm-2 col-md-2">
              <div class="form-group">
                
                  <input type="number" class="form-control total_aktiva" name="kredit">                                        
              </div>                            
          </div>

</div>
<?php else: ?>
    <p class="text-warning"><strong>Data relasi akun belum ditentukan!</strong></p>
<?php endif; ?>        
