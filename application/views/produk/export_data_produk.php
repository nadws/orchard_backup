<?php
$file = "DATA PRODUK ORCHARD.xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<table class="table" border="1">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th>SKU</th>
            <th>Harga Modal</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Total</th>

        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($produk as $p) :
        ?>
            <tr>
                <td><?= $p->nm_produk; ?></td>
                <td><?= $p->nm_kategori; ?></td>
                <?php if ($p->id_kategori == '20' || $p->id_kategori == '24') : ?>
                    <td>Bahan</td>
                <?php elseif ($p->id_kategori == '12') : ?>
                    <td>Service</td>
                <?php else : ?>
                    <td>Product Jual</td>
                <?php endif ?>

                <td><?= $p->sku; ?></td>
                <td><?= $p->harga_modal; ?></td>
                <td><?= $p->harga; ?></td>
                <td><?= $p->stok; ?></td>
                <td><?= $p->satuan; ?></td>
                <td><?= $p->harga * $p->stok; ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>