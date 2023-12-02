        <!-- // "dom": '<"top"lf>t<"bottom"ip><"clear">', -->
        <aside class="control-sidebar control-sidebar-dark">
          <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
          </div>
        </aside>

        <footer class="main-footer shadow" style=" background-image: linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%);">
          <div class="float-right d-none d-sm-inline" style="color: white;" >
            Anything you want
          </div>
          <strong style="color: white;" >Copyright &copy; 2020.09.29 <a href="<?= 'https:www.putrirembulan.com'; ?>" target="" style="color: white;" >putrirembulan.com</a></strong>
        </footer>
      </div>



      <!-- <script src="<?= base_url('asset/'); ?>loading.js"></script> -->
      <script src="<?= base_url('asset/'); ?>/plugins/jquery/jquery.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/select2/js/select2.full.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/datatables/jquery.dataTables.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
      <script src="<?= base_url('asset/'); ?>/dist/js/adminlte.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/dist/js/demo.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/moment/moment.min.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
      <script src="<?= base_url('asset/'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
      <script>
        $(document).ready(function(){
          load_data();
          function load_data(keyword, kategori)
          {
            $.ajax({
              method:"POST",
              url:"<?php echo site_url() ?>match/search_produk",
              data: {keyword:keyword, kategori:kategori},
              success:function(hasil)
              {
                $('.data-produk').html(hasil);
              }
            });
          }
          $('#keyword').keyup(function(){
            var keyword = $("#keyword").val();
            var kategori = $("#kategori").val();
            load_data(keyword, kategori);
          });
          $('#kategori').change(function(){
            var keyword = $("#keyword").val();
            var kategori = $("#kategori").val();
            load_data(keyword,kategori);
		        });
            
        });

        $(document).ready(function(){
        $('#list_kategori').on('change', function(){
          var id = $('#list_kategori').val();
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url('Match/get_produk'); ?>',
              data: { 'id' : id },
            success: function(data){
                $("#list_produk").html(data);
            }
            
          })
        })
      });

        // $(document).ready(function(){
        //   load_data();
        //   function load_data(kategori, keyword)
        //   {
        //     $.ajax({
        //       method:"POST",
        //       url:"<?php echo site_url() ?>match/search_produk",
        //       data: {kategori: kategori, keyword:keyword},
        //       success:function(hasil)
        //       {
        //         $('.data-produk').html(hasil);
        //       }
        //     });
        //   }
        //   $('#keyword').keyup(function(){
        //     var kategori = $("#kategori").val();
        //       var keyword = $("#keyword").val();
        //     load_data(kategori, keyword);
        //   });
        //   $('#kategori').change(function(){
        //     var kategori = $("#kategori").val();
        //       var keyword = $("#keyword").val();
        //     load_data(kategori, keyword);
        //   });
        // });

        $(window).resize(function() {
          if ($(window).width() <= 600) {
            $('#prop-type-group').removeClass('btn-group');
            $('#prop-type-group').addClass('btn-group-vertical');
          } else {
            $('#prop-type-group').addClass('btn-group');
            $('#prop-type-group').removeClass('btn-group-vertical');
          }
        });

      </script>
      <script>

        $(function() {
          $("input[name='picker']").daterangepicker({
            opens: 'center',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#picker').daterangepicker();
          $('#picker').on('apply.daterangepicker', function(ev, picker) {

            document.getElementById("tanggal1").value = picker.startDate.format('YYYY-MM-DD');
            document.getElementById("tanggal2").value = picker.endDate.format('YYYY-MM-DD');
          });
        });

        $(function() {
          $("input[name='pickerkas']").daterangepicker({
            opens: 'center',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#pickerkas').daterangepicker();
          $('#pickerkas').on('apply.daterangepicker', function(ev, pickerkas) {

            document.getElementById("tanggalkas1").value = pickerkas.startDate.format('YYYY-MM-DD');
            document.getElementById("tanggalkas2").value = pickerkas.endDate.format('YYYY-MM-DD');
          });
        });

        $(function() {
          $("input[name='picker2']").daterangepicker({
            opens: 'center',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#picker2').daterangepicker();
          $('#picker2').on('apply.daterangepicker', function(ev, picker2) {

            document.getElementById("tanggal3").value = picker2.startDate.format('YYYY-MM-DD');
            document.getElementById("tanggal4").value = picker2.endDate.format('YYYY-MM-DD');
          });
        });

        $(function() {
          $("input[name='picker3']").daterangepicker({
            opens: 'center',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#picker3').daterangepicker();
          $('#picker3').on('apply.daterangepicker', function(ev, picker3) {

            document.getElementById("tanggal3").value = picker3.startDate.format('YYYY-MM-DD');
            document.getElementById("tanggal4").value = picker3.endDate.format('YYYY-MM-DD');
          });
        });

        $(function() {
          $("input[name='picker_drop']").daterangepicker({
            opens: 'center',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#picker_drop').daterangepicker();
          $('#picker_drop').on('apply.daterangepicker', function(ev, picker_drop) {

            document.getElementById("tanggal5").value = picker_drop.startDate.format('YYYY-MM-DD');
            document.getElementById("tanggal6").value = picker_drop.endDate.format('YYYY-MM-DD');
          });
        });

        $(function() {
          $("input[name='global']").daterangepicker({
            opens: 'up',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#global').daterangepicker();
          $('#global').on('apply.daterangepicker', function(ev, global) {

            document.getElementById("global1").value = global.startDate.format('YYYY-MM-DD');
            document.getElementById("global2").value = global.endDate.format('YYYY-MM-DD');
          });
        });

        $(function() {
          $("input[name='trash']").daterangepicker({
            opens: 'up',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#trash').daterangepicker();
          $('#trash').on('apply.daterangepicker', function(ev, trash) {

            document.getElementById("trash1").value = trash.startDate.format('YYYY-MM-DD');
            document.getElementById("trash2").value = trash.endDate.format('YYYY-MM-DD');
          });
        });

        $(function() {
          $("input[name='excel']").daterangepicker({
            opens: 'up',
            drops: 'up'
          }, function(start, end, label) {

          });
          $('#excel').daterangepicker();
          $('#excel').on('apply.daterangepicker', function(ev, excel) {

            document.getElementById("excel1").value = excel.startDate.format('YYYY-MM-DD');
            document.getElementById("excel2").value = excel.endDate.format('YYYY-MM-DD');
          });
        });

        $(function () {
          $("#example1").DataTable({ 

            "responsive": true,
            "bSort": true,
        // "scrollX": true,
        "paging" : true,
        "stateSave" : true,
        "scrollCollapse" : true
      });

          $('#produkmasuk').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "stateSave" : true,
            "autoWidth": true,
        // "order": [ 5, 'DESC' ],
        // "searching": false,
      });

      $('#produk').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "stateSave" : true,
            "autoWidth": true,
        // "order": [ 5, 'DESC' ],
        // "searching": false,
      });

          $('#example3').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "stateSave" : true,
            "info": true,
        // "order": [ 5, 'DESC' ],
        // "searching": false,
        "autoWidth": true,
      });

      $('#kelolaproduk').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "stateSave" : true,
            "autoWidth": true,
        "order": [ 4, 'DESC' ],
        // "searching": false,
      });
      $('#produkterlaris').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "stateSave" : true,
            "autoWidth": true,
        // "order": [ 4, 'ASC' ],
        // "searching": false,
      });


        });

      </script>
    </body>
    </html>