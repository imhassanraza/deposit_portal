<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo lang('deposit_type');?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li class="active">
                <strong><?php echo lang('deposit_type');?></strong>
            </li>
        </ol>
    </div>
    <?php if(get_permission('deposit_add') == 1) { ?>
        <div class="col-lg-2">
            <a href="<?php echo admin_url(); ?>bank/addDeposit" class="btn mt30 btn-primary "><?php echo lang('add_new_deposit_type');?></a>
        </div>
    <?php } ?>
</div>
<!-- Sales Table -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo lang('deposit_type');?></h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover" id="aj-table">
                        <thead>
                            <tr>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('min_investment');?></th>
                                <th><?php echo lang('max_investment');?></th>
                                <th><?php echo lang('created_at');?></th>
                                <th><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($depositTypes)){
                                foreach ($depositTypes as $dt) { ?>
                                    <tr>
                                        <td><?php echo $dt['name']; ?></td>
                                        <td><?php echo $dt['min']; ?></td>
                                        <td><?php echo $dt['max']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($dt['created_at'])); ?></td>
                                        <td>
                                            <?php if (!empty($dt['ship_no'])) { $btn_class = 'success'; }else { $btn_class = 'danger'; } ?>
                                            <!--<button class="btn btn-info btn-circle view-order" data-id="--><?php //echo $dt['id']; ?><!--" type="button" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></button>-->
                                            <?php if(get_permission('deposit_edit') == 1) { ?>
                                                <a href="<?php echo admin_url(); ?>bank/editDeposit/<?php echo $dt['id']; ?>"><button class="btn btn-warning btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-paint-brush"></i></button></a>
                                            <?php } ?>
                                            <?php if(get_permission('deposit_delete') == 1) { ?>
                                                <button class="btn btn-danger btn-circle delete-btn" data-id="<?php echo $dt['id']; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo lang('name');?></th>
                                    <th><?php echo lang('min_investment');?></th>
                                    <th><?php echo lang('max_investment');?></th>
                                    <th><?php echo lang('created_at');?></th>
                                    <th><?php echo lang('action');?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- view modal -->
        <div class="modal inmodal" id="view-modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceIn">
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Theme Cat End -->
    <?php $this->load->view('common/admin_footer'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            /* Init DataTables */
            $('#aj-table').dataTable({
                responsive: true, 
                language: {
                "sSearch": "<?php echo lang('search');?>: ",
                oPaginate: {
                    "sPrevious": "<?php echo lang('previous');?>",
                    "sNext": "<?php echo lang('next');?>"
                }
            },           
            });
            $('[data-toggle-second="tooltip"]').tooltip();
            $(document).on("click",".delete-btn",function() {
            //$('.delete-btn').click(function(){
                var current = $(this);
                var id = current.data('id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false,
                }, function () {
                    ajaxurl = '<?php echo admin_url(); ?>bank/deleteDeposit';
                    $.ajax({
                      url: ajaxurl,
                      type : 'post',
                      data: {id: id},
                      dataType: "json",
                      success: function(data ) {
                        if (data.msg == 'success') {
                            current.parents('tr').remove();
                            swal("Done!", "It was succesfully deleted!", "success");
                        }else {
                            swal("Error!", data.response, "error");
                        }
                    },
                });
                });
            });

            $('.dropdown-menu').on('click', '.status', function(e){
                e.preventDefault();
                var status = $(this).data('val');
                var currentStatus = $(this);
                var id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "You want to update status of order! Please write a comment why you are updating the status of order.",
                    type: "input",
                    inputPlaceholder: "Write comment...",
                    showCancelButton: true,
                    confirmButtonColor: "#1ab394",
                    confirmButtonText: "Yes, update it!",
                    closeOnConfirm: false
                }, function (inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("You need to write something!");
                        return false
                    }
                    ajaxurl = '<?php echo admin_url(); ?>orders/update_status'; 
                    $.ajax({
                      url: ajaxurl,
                      type : 'post',
                      data: {id: id, status: status, comment: inputValue},
                      dataType: "json",
                      success: function(data ) {
                        if (data.msg == 'success') {
                            currentStatus.parents('ul').children('li').children('.st-btn').removeClass('font-bolds');
                            currentStatus.parents('ul').children('li').children('.st-btn').addClass('status');
                            currentStatus.addClass('font-bolds');
                            currentStatus.removeClass('status');
                            swal("Done!", "It was succesfully updated!", "success");
                        }else {
                            swal("Error!", data.response, "error");
                        }
                    },
                });
                }); 
            });
            $(document).on("click",".view-order",function() {
            //$('.view-order').click(function(){
                var id = $(this).data('id');
                ajaxurl = '<?php echo admin_url(); ?>orders/view_order'; 
                $.ajax({
                  url: ajaxurl,
                  type : 'post',
                  data: {id: id},
                  dataType: "json",
                  success: function(data ) {
                    $('#view-modal .modal-body').html(data.response);
                    $('#view-modal').modal('show');
                },
            });
            });
            $(document).on("click",".shipment",function() {
                //$('.shipment').click(function(){
                    var id = $(this).data('id');
                    var shipNo = $(this).data('shipment');
                    var expect = $(this).data('expect');
                    $('#sale_id').val(id);
                    $('#ship_no').val(shipNo);
                    $('#delivery_date').val(expect);
                    $('.shipment').removeClass('current');
                    $(this).addClass('current');
                    $('#ship-modal').modal('show');
                });

            $("#ship-form").validate();
            $('#ship-form').submit(function(e) {
                if($("#ship-form").valid()){
                  e.preventDefault();
                  var formData = $('#ship-form').serialize();
                  var ajaxurl = '<?php echo admin_url().'orders/update_shipment'; ?>';
                  $.ajax({
                    url: ajaxurl,
                    type : 'post',
                    dataType: "json",
                    data: formData,
                    success: function(data ) {
                      if(data.msg =='error') {
                        toastr.error(data.response);
                    }else if(data.msg =='success') {
                        toastr.success(data.response);
                        var shipNo = $('#ship_no').val();
                        $('.current').data('shipment', shipNo);
                        var expect = $('#delivery_date').val();
                        $('.current').data('expect', expect);
                        $('.current').removeClass('btn-danger');
                        $('.current').addClass('btn-success');
                        $('.shipment').removeClass('current');
                    }
                }
            });
              }
          });
            $('.datepicker').datepicker({format:'yyyy-mm-dd', autoclose: true, container: '#ship-modal'});
        });
    </script>
</body>
</html>