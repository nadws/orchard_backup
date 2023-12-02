<?php $this->load->view('tema/Header', $title); ?>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
<div class="content-header">
    <div id="gaji"></div>
</div>

<form id="History_gaji">
    <div class="modal fade" id="view-periode" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #FFA07A;">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat data perperiode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Dari</label>
                            <input type="date" class="form-control tgl1">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Sampai</label>
                            <input type="date" class="form-control tgl2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Lihat</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- ======================================================== conten ======================================================= -->

<!-- ======================================================== conten ======================================================= -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        load_gaji();

        function load_gaji() {
            $.ajax({
                method: "GET",
                url: "<?= base_url('Gaji/gaji_load') ?>",
                dataType: "html",
                success: function(hasil) {
                    $('#gaji').html(hasil);
                }
            });

        }
        $("#History_gaji").submit(function(e) {
            e.preventDefault();
            var tgl1 = $(".tgl1").val();
            var tgl2 = $(".tgl2").val();

            $.ajax({
                method: "GET",
                url: "<?= base_url('Gaji/gaji_load') ?>?tgl1=" + tgl1 + '&tgl2=' + tgl2,
                dataType: "html",
                success: function(hasil) {
                    $('#gaji').html(hasil);
                    $('#view-periode').modal('hide');
                }
            });
        });


        $(document).on('click', '.save_tbh', function() {
            var id_karyawan = $(this).attr('id_karyawan');
            var id_skill = $(this).attr('id_skill');
            var tgl1 = $(this).attr('tgl1');
            var tgl2 = $(this).attr('tgl2');


            $.ajax({
                method: "GET",
                url: "<?= base_url('Gaji/tbh_skill?id_karyawan=') ?>" + id_karyawan + "&id_skill=" + id_skill,
                dataType: "html",
                success: function(hasil) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Skill berhasil ditambahkan'
                    });
                    $.ajax({
                        method: "GET",
                        url: "<?= base_url('Gaji/gaji_load') ?>?tgl1=" + tgl1 + '&tgl2=' + tgl2,
                        dataType: "html",
                        success: function(hasil) {
                            $('#gaji').html(hasil);
                        }
                    });
                }
            });
        });
        $(document).on('click', '.delete_tbh', function() {
            var id_karyawan = $(this).attr('id_karyawan');
            var id_skill = $(this).attr('id_skill');
            var tgl1 = $(this).attr('tgl1');
            var tgl2 = $(this).attr('tgl2');


            $.ajax({
                method: "GET",
                url: "<?= base_url('Gaji/delete_skill?id_karyawan=') ?>" + id_karyawan + "&id_skill=" + id_skill,
                dataType: "html",
                success: function(hasil) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Cancel skill berhasil'
                    });
                    $.ajax({
                        method: "GET",
                        url: "<?= base_url('Gaji/gaji_load') ?>?tgl1=" + tgl1 + '&tgl2=' + tgl2,
                        dataType: "html",
                        success: function(hasil) {
                            $('#gaji').html(hasil);
                        }
                    });
                }
            });
        });
    });
</script>



<?php $this->load->view('tema/Footer'); ?>