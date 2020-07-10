<!-- </div>
</div>
<footer class="sticky-footer bg-white mt-3">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Application Version 1.0
            </span>
        </div>
    </div>
</footer>

</div>
</div>


<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="<?php echo base_url('assets/admin/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/myscript.min.js') ?>"></script>




<script src="<?php echo base_url('assets/template/js/chosen.jquery.min.js'); ?>"></script>


<script src="<?php echo base_url('assets/admin/js/autocomplete/jquery-3.3.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/autocomplete/jquery-ui.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#donatur_name').autocomplete({
            source: "<?php echo base_url('admin/home/get_autocomplete'); ?>",

            select: function(event, ui) {
                $('[name="donatur_name"]').val(ui.item.label);
                $('[name="donatur_phone"]').val(ui.item.donatur_phone);
            }
        });

    });
</script>


<link href="<?php echo base_url('assets/admin/js/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/admin/js/summernote/summernote-lite.min.js'); ?>"></script>
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


<script src="<?php echo base_url('assets/admin/vendor/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            
        });
        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            
        });
        $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            
        });
    });
</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); 
        }
    }

    $("#customFile").change(function() {
        readURL(this);
    });
</script>


<script type="text/javascript">
    function printDiv(printableArea) {
        var printContents = document.getElementById(printableArea).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>





</body>

</html> -->


















<!-- 


</div>
</div>
       
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved.</p>
            </div>
        </footer>
       
    </div>
  
    
    
    <script src="<?php echo base_url('assets/template/admin/js/vendor/jquery-2.2.4.min.js');?>"></script>
  
    <script src="<?php echo base_url('assets/template/admin/js/popper.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/owl.carousel.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/metisMenu.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/jquery.slimscroll.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/jquery.slicknav.min.js');?>"></script>

  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
   
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
   
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

    <script src="<?php echo base_url('assets/template/admin/js/line-chart.js');?>"></script>
    
    <script src="<?php echo base_url('assets/template/admin/js/pie-chart.js');?>"></script>
    
    <script src="<?php echo base_url('assets/template/admin/js/bar-chart.js');?>"></script>
  
    <script src="<?php echo base_url('assets/template/admin/js/maps.js');?>"></script>
    
    <script src="<?php echo base_url('assets/template/admin/js/plugins.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/scripts.js');?>"></script>



<script src="<?php echo base_url('assets/template/admin/js/autocomplete/jquery-3.3.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/admin/js/autocomplete/jquery-ui.js'); ?>"></script>
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

    });
</script>



</body>

</html> -->





</div>
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0 Beta 
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
<script src="<?php echo base_url('assets/template/admin2/plugins/moment/moment.min.js');?>"></script>
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

<script src="<?php echo base_url('assets/template/admin2/dist/js/autocomplete/jquery-3.3.1.js'); ?>"></script>
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

    });
</script>

</body>
</html>