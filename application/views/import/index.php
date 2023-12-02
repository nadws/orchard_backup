<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Import</title>
  </head>
  <body>
            <!-- Begin Page Content -->    
  <div class="container-fluid">
  <div class="row">

    <div class="col-3">
        <h3>Import Cash</h3>
        <form action="<?= base_url('Import/import_cash'); ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="form-group">
            <input type="file" name="cash" id="upload" value="" class="form-control"></li>
            </div>
                    
                <button class="btn-primary" type="submit" name="preview">import</button>
                </form>
    </div>

    <div class="col-3">
        <h3>Import BCA</h3>
        <form action="<?= base_url('Import/import_bca'); ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="form-group">
            <input type="file" name="bca" value="" class="form-control"></li>
            </div>
                    
                <button class="btn-primary" type="submit" name="preview">import</button>
                </form>
    </div>

    <div class="col-3">
        <h3>Import Mandiri</h3>
        <form action="<?= base_url('Import/import_mandiri'); ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="form-group">
            <input type="file" name="mandiri" value="" class="form-control"></li>
            </div>
                    
                <button class="btn-primary" type="submit" name="preview">import</button>
                </form>
    </div>

    <div class="col-3">
        <h3>Import pengeluaran</h3>
        <form action="<?= base_url('Import/import_pengeluaran'); ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="form-group">
            <input type="file" name="pengeluaran" value="" class="form-control"></li>
            </div>
                    
                <button class="btn-primary" type="submit" name="preview">import</button>
                </form>
    </div>

    <div class="col-3">
        <h3>Import penjualan april</h3>
        <form action="<?= base_url('Import/import_penjualan_april'); ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="form-group">
            <input type="file" name="import_penjualan_april" value="" class="form-control"></li>
            </div>
                    
                <button class="btn-primary" type="submit" name="preview">import</button>
                </form>
    </div>

  </div>


    <!-- <h3>Form Import</h3>
  <div class="input-group-prepend mx-auto">
  <form action="<?= base_url('Orchard/import_data'); ?>" method="post" enctype="multipart/form-data">
  <hr>
  <ul>
    <li><label for="file">UPLOAD</label>
    <input type="file" name="orchard" id="upload" value="" class="input-group-text"></li>

    <li>
        
      <button class="btn-primary" type="submit" name="preview">import</button>
      </form>
    </li>
  </ul>


  </div>
      </div>
    </div> -->
      <!-- End of Main Content -->



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
   
  </body>
</html>
