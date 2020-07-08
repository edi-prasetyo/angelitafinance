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





















</div>
</div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    
    <!-- jquery latest version -->
    <script src="<?php echo base_url('assets/template/admin/js/vendor/jquery-2.2.4.min.js');?>"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo base_url('assets/template/admin/js/popper.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/owl.carousel.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/metisMenu.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/jquery.slimscroll.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/jquery.slicknav.min.js');?>"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="<?php echo base_url('assets/template/admin/js/line-chart.js');?>"></script>
    <!-- all pie chart -->
    <script src="<?php echo base_url('assets/template/admin/js/pie-chart.js');?>"></script>
    <!-- all bar chart -->
    <script src="<?php echo base_url('assets/template/admin/js/bar-chart.js');?>"></script>
    <!-- all map chart -->
    <script src="<?php echo base_url('assets/template/admin/js/maps.js');?>"></script>
    <!-- others plugins -->
    <script src="<?php echo base_url('assets/template/admin/js/plugins.js');?>"></script>
    <script src="<?php echo base_url('assets/template/admin/js/scripts.js');?>"></script>


<!-- AUTOCOMPLETE -->
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

</html>
