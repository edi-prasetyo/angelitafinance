

  </div>
  </section>
</div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0 Beta
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/template/admin2/plugins/jquery/jquery.min.js');?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/template/admin2/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/template/admin2/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/template/admin2/plugins/chart.js/Chart.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/template/admin2/plugins/sparklines/sparkline.js');?>"></script>
<!-- JQVMap -->


<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/template/admin2/plugins/jquery-knob/jquery.knob.min.js');?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/template/admin2/plugins/moment/moment-with-locales.min.js');?>"></script>

<script src="<?php echo base_url('assets/template/admin2/plugins/daterangepicker/daterangepicker.js');?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/template/admin2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js');?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/template/admin2/plugins/summernote/summernote-bs4.min.js');?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/template/admin2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/template/admin2/dist/js/adminlte.js');?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/template/admin2/dist/js/pages/dashboard.js');?>"></script>
<!-- jquery-validation -->
<script src="<?php echo base_url('assets/template/admin2/plugins/jquery-validation/jquery.validate.min.js');?>"></script>

<!-- <script src="<?php echo base_url('assets/template/admin2/dist/js/autocomplete/jquery-3.3.1.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/template/admin2/dist/js/autocomplete/jquery-ui.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#user_phone').autocomplete({
            source: "<?php echo base_url('admin/pelanggan/get_autocomplete'); ?>",

            select: function(event, ui) {
                $('[name="user_phone"]').val(ui.item.label);
                $('[name="user_name"]').val(ui.item.user_name);
                $('[name="user_address"]').val(ui.item.user_address);
            }
        });

        $('#user_phone2').autocomplete({
            source: "<?php echo base_url('admin/pelanggan/get_autocomplete'); ?>",

            select: function(event, ui) {
                $('[name="user_phone"]').val(ui.item.label);
                $('[name="user_name"]').val(ui.item.user_name);
                $('[name="user_address"]').val(ui.item.user_address);
            }
        });

    });
</script>


<link href="<?php echo base_url('assets/template/admin2/js/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/template/admin2/js/summernote/summernote-lite.min.js'); ?>"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Keterangan ..',
        tabsize: 2,
        height: 130,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>


<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    locale: 'id',
                });
                $('#datetimepicker2').datetimepicker({
                    locale: 'id',
                });
            });
        </script>








</body>
</html>
