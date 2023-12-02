<div class="row">
    <div class="col-5"></div>
    <div class="col-5"></div>
    <div class="col-2">
    <label class="float-left"><input type="search" class="form-control form-control-sm" placeholder="Search.." id="search_detail_jurnal"></label>
    </div>
</div>
<table class="table table-sm" style="font-size: 14px;">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>No Nota</th>
            <th>Post Center</th>
            <th>Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Pasangan</th>
            <th>Admin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tb_detail_jurnal">
        <?php foreach($dt_detail as $d): ?>
        <tr>
            <td><?= date('d-M-Y', strtotime($d->tgl)) ?></td>
            <td><?= $d->no_nota ?></td>
            <td><?= $d->nm_post ?></td>
            <td><?= $d->ket ?></td>
            <td><?= number_format($d->debit,2) ?></td>
            <td><?= number_format($d->kredit,2) ?></td>
            <td><?= $d->pasangan ?></td>
            <td><?= $d->admin ?></td>
            <td>
                <button type="button" class="btn btn-xs btn-outline-secondary btn_edit" kd_gabungan='<?= $d->kd_gabungan ?>' data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                    <a class="btn btn-xs btn-outline-secondary" href="<?= base_url('Jurnal/drop_pengeluaran/') ?><?= $d->kd_gabungan ?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> -->

<!-- <script>
    	$(document).ready(function(){
            
        });
</script> -->