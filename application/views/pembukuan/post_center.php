<table class="table">
    <thead>
        <tr>
            <th>Post Center</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($post_center as $p): ?>
        <tr>
            <td><?= $p->nm_post ?></td>
            <td><a href="<?= base_url('Jurnal/drop_post_center/') ?><?= $p->id_post ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>