        <div class="footer">
            <div>
                <strong>Copyright</strong> QRX &copy; 2019
            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>admin-assets/js/jquery-2.1.1.js"></script>
<!-- jQuery UI -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>



<!-- Peity -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/demo/peity-demo.js"></script>

<!-- Range Date Picker -->
<script src="<?php echo base_url(); ?>admin-assets/js/daterangepicker.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>admin-assets/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/pace/pace.min.js"></script>

<!-- Jvectormap -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?php echo base_url(); ?>admin-assets/js/demo/sparkline-demo.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/jeditable/jquery.jeditable.js"></script>
<!-- Data Tables -->


<script src="<?php echo base_url(); ?>admin-assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/datatable/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/datatable/responsive.bootstrap4.min.js"></script>


<!-- Jquery Validate -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/validate/jquery.validate.min.js"></script>
<!-- Sweet alert -->
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>admin-assets/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/pace/pace.min.js"></script>
<script src="<?php echo base_url(); ?>admin-assets/js/plugins/toastr/toastr.min.js"></script>

<script>
    /*tooltip*/
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
  })
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('.datepicker').on('click', function(e) {
         e.preventDefault();
         $(this).attr("autocomplete", "off");  
     });

        /*form cancel button*/
        $('#cancel_btn').click(function(e){
            e.preventDefault();
            var url = $(this).data('url');
            window.location.href =  url;
        });
        /* Init DataTables */
            // $('#ts-table').dataTable({
            //     responsive: true,            
            // });
        });
    </script>
    <script type="text/javascript">
        /*$(document).ready(function() {
            var config = {
                '.chosen-select' : {},
                '.chosen-select-deselect' : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width' : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        });*/
        jQuery.extend(jQuery.validator.messages, {
        required: "<?php echo lang('this_field_is_required');?>",
        remote: "Please fix this field."
    });
    </script>
