       <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>

      <footer class="main-footer bg-info">
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <strong>Copyright &copy; 2019.10.23 <a href="<?= base_url('Match'); ?>" style="color: white;" >agrikagroupadm.com</a></strong>
      </footer>
    </div>
    

    <script src="<?= base_url('asset/'); ?>/plugins/jquery/jquery.min.js"></script>

    <script src="<?= base_url('asset/'); ?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('asset/'); ?>/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/dist/js/demo.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('asset/'); ?>/plugins/daterangepicker/daterangepicker.js"></script>

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
      
      $(function () {
        $("#example1").DataTable({
          "bSort": false, 
          "paging" : true,
          "stateSave" : true,
          "scrollCollapse" : true,
          "fixedHeader":true
        });
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "stateSave" : true,
          "info": true,
          "autoWidth": false,
        });
      });
    </script>
  </body>
  </html>