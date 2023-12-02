<div class="row">
    <div class="col-lg-12">
        <div class="card">


            <div class="card-header">
                <h5 class="float-left">Gaji & Tunjangan ~ <?= date('d-m-Y', strtotime($tgl1)) ?> - <?= date('d-m-Y', strtotime($tgl2)) ?></h5>
                <a href="" class="btn float-right btn-success" data-toggle="modal" data-target="#view-periode"><i class="fas fa-calendar-alt"></i> View</a>
                <a href="<?= base_url("Gaji/Print_gaji?tgl1=$tgl1&tgl2=$tgl2") ?>" target="_blank" class="btn float-right btn-success mr-2"><i class="fas fa-print"></i> Print</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah Masuk</th>
                                <th>Off</th>
                                <th>Rp/Hari</th>
                                <th>Tunjangan Skill</th>
                                <th>Type Therapis</th>
                                <?php foreach ($skill as $s) : ?>
                                    <th><?= $s->skill ?></th>
                                <?php endforeach ?>
                                <th>Posisi</th>
                                <th>Tunjangan</th>
                                <th>Masuk x RP/Hari</th>
                                <th>Total Gaji</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gaji as $g) :
                                if (empty($g->OFF) && empty($g->M)) {
                                    continue;
                                } else {
                                    # code...
                                }
                            ?>
                                <tr>
                                    <td><?= $g->nm_kry ?></td>
                                    <td><?= $g->M ?></td>
                                    <td><?= $g->OFF ?></td>
                                    <td><?= number_format($g->gaji, 0) ?></td>
                                    <td><?= number_format($g->tj_tipe, 0) ?></td>
                                    <td><?= $g->nm_tipe ?></td>
                                    <?php foreach ($skill as $s) : ?>
                                        <?php $skill_karyawan = $this->db->query("SELECT * FROM tb_karyawan_skill as a where a.id_karyawan = '$g->id_kry' and a.id_skill = '$s->id_skill'")->row() ?>

                                        <td align="center">
                                            <?php if ($g->id_tipe == '5') : ?>
                                                -
                                            <?php else : ?>
                                                <?php if (empty($skill_karyawan)) : ?>
                                                    <a href="javascript:void(0)" class="save_tbh" id_karyawan="<?= $g->id_kry  ?>" id_skill="<?= $s->id_skill ?>" tgl1="<?= $tgl1 ?>" tgl2="<?= $tgl2 ?>"><i class="fas fa-times-circle fa-2x text-danger"></i></i></a>
                                                <?php else : ?>
                                                    <a href="javascript:void(0)" class="delete_tbh" id_karyawan="<?= $g->id_kry  ?>" id_skill="<?= $s->id_skill ?>" tgl1="<?= $tgl1 ?>" tgl2="<?= $tgl2 ?>"><i class="fas fa-check-circle fa-2x text-success"></i></a>
                                                <?php endif ?>
                                            <?php endif ?>


                                        </td>
                                    <?php endforeach ?>
                                    <td><?= $g->posisi ?></td>
                                    <td><?= number_format($g->tunjangan, 0) ?></td>
                                    <td><?= number_format($g->M * $g->gaji, 0) ?></td>
                                    <td>
                                        <dt><?= number_format(($g->M * $g->gaji) + $g->tunjangan + $g->tj_tipe, 0) ?></dt>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type Therapish</th>
                            <th style="text-align: right;">Rp/Hari</th>
                            <th style="text-align: right;">Tunjangan Skill</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tipe as $t) : ?>
                            <tr>
                                <td><?= $t->nm_tipe ?></td>
                                <td style="text-align: right;"><?= number_format($t->gaji, 0) ?></td>
                                <td style="text-align: right;"><?= number_format($t->tunjangan, 0) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Posisi</th>
                            <th style="text-align: right;">Tunjangan jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posisi as $p) : ?>
                            <tr>
                                <td><?= $p->posisi ?></td>
                                <td style="text-align: right;"><?= number_format($p->gaji, 0) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Denda Orchad ~ <?= $tglTengah; ?></h5>
                <!-- <a href="<?= base_url("GajiController/export/$tgl1/$tgl2/denda"); ?>"  class="btn btn-success btn-sm float-right"><i class="fa fa-print"></i> Export</a> -->
            </div>
            <div class="card-body">
                <table class="table" id="" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        foreach ($denda as $d) { ?>
                            <?php
                            $total += $d->nominal;
                            $alasan = $this->db->query("SELECT alasan FROM ctt_denda WHERE nm_denda = '$d->nm_denda' AND tanggal BETWEEN '$tgl1' AND '$tgl2' GROUP BY alasan")->result();
                            ?>
                            <tr>
                                <td><?= $d->nm_denda; ?></td>
                                <td><?= number_format($d->nominal, 0); ?></td>
                                <td>
                                    <?php foreach ($alasan as $a) { ?>
                                        <?= $a->alasan; ?>,
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-bold">TOTAL</td>
                            <td colspan="2" class="text-bold"><?= number_format($total, 0); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Kasbon Orchad ~ <?= $tglTengah; ?></h5>
                <!-- <a href="<?= base_url("GajiController/export/$tgl1/$tgl2/kasbon"); ?>"  class="btn btn-success btn-sm float-right"><i class="fa fa-print"></i> Export</a> -->
            </div>
            <div class="card-body">
                <table class="table" id="" width="100%">
                    <thead>

                        <tr>
                            <th>Nama</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        foreach ($kasbon as $d) { ?>
                            <?php
                            $total += $d->nominal;

                            ?>
                            <tr>
                                <td><?= $d->nm_kasbon; ?></td>
                                <td><?= number_format($d->nominal, 0); ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-bold">TOTAL</td>
                            <td colspan="2" class="text-bold"><?= number_format($total, 0); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Tips Orchad ~ <?= $tglTengah; ?></h5>
                <!-- <a href="<?= base_url("GajiController/export/$tgl1/$tgl2/tips"); ?>"  class="btn btn-success btn-sm float-right"><i class="fa fa-print"></i> Export</a> -->
            </div>
            <div class="card-body">
                <table class="table" id="" width="100%">
                    <thead>

                        <tr>
                            <th>Nama</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        foreach ($tips as $d) { ?>
                            <?php
                            $total += $d->nominal;

                            ?>
                            <tr>
                                <td><?= $d->nm_tips; ?></td>
                                <td><?= number_format($d->nominal, 0); ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-bold">TOTAL</td>
                            <td colspan="2" class="text-bold"><?= number_format($total, 0); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Appointment Orchad ~ <?= $tglTengah; ?></h5>
                <!-- <a href="<?= base_url("GajiController/export/$tgl1/$tgl2/app"); ?>"  class="btn btn-success btn-sm float-right"><i class="fa fa-print"></i> Export</a> -->
            </div>
            <div class="card-body">
                <table class="table" id="" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>TTL_ORG</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $total = 0;
                        $ttl_org = 0;
                        foreach ($app as $d) { ?>
                            <?php
                            if ($d->nm_app == 'DINA' || $d->nm_app == 'ORCHARD') {
                                continue;
                            }
                            $total += $d->nominal;
                            $ttl_org += $d->orang;

                            ?>
                            <tr>
                                <td><?= $d->nm_app; ?></td>
                                <td><?= $d->orang; ?></td>
                                <td><?= number_format($d->nominal, 0); ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-bold">TOTAL</td>
                            <td class="text-bold"><?= number_format($ttl_org, 0); ?></td>
                            <td class="text-bold"><?= number_format($total, 0); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>




<script src="<?= base_url('asset/'); ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
    $('#setor').DataTable({
        "paging": false,
        "pageLength": 100,
        "scrollY": "400px",
        "lengthChange": false,
        // "ordering": false,
        "info": false,
        "stateSave": true,
        "autoWidth": true,
        // "order": [ 5, 'DESC' ],
        "searching": true,
    });
</script>