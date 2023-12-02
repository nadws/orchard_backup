<div class="row">
    <div class="col-lg-4">
        <label for="">Tanggal Masuk</label>
        <input type="date" class="form-control" name="tgl" value="<?= $karywan->tgl_masuk ?>">
        <input type="hidden" name="id_kry" value="<?= $karywan->id_kry ?>">
    </div>
    <div class="col-lg-4">
        <label for="">Nama</label>
        <input type="text" class="form-control " name="nama" value="<?= $karywan->nm_kry ?>">
    </div>
    <div class="col-lg-4">
        <label for="">Posisi</label>
        <select name="id_posisi" class="form-control select2">
            <option value="0">-Pilih Posisi-</option>
            <?php foreach ($posisi as $p) : ?>
                <option value="<?= $p->id_posisi ?>" <?= $karywan->id_posisi == $p->id_posisi ? 'selected' : '' ?>> <?= $p->posisi ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>