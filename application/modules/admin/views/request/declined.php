<?php $this->load->view('common/admin_header'); ?>
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css" rel="stylesheet"> 
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo lang('declined_request'); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li class="active">
                <strong><?php echo lang('declined_request'); ?></strong>
            </li>
        </ol>
        <div class="hr-line-dashed"></div>
    </div>
    <div class="col-lg-12">
        <form id="add_bank_form" class="form-horizontal" method="post" action="<?php echo admin_url() ?>request/searchRequest">
            <div class="col-lg-6">
                <input type="hidden" name="requestType" value="Declined">
                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('deposit_type'); ?></label>
                    <div class="col-sm-10">
                        <select class="pr-select form-control" name="deposit_type" id="deposit_type">
                            <option value="" data-discount="0" data-max-qty="0"><?php echo lang('select_deposit_type'); ?></option>
                            <?php foreach ($despositTypes as $dT) { ?>
                                <option value="<?php echo $dT['id']; ?>"><?php echo $dT['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('bank_name'); ?></label>
                    <div class="col-sm-10">
                        <select class="pr-select form-control" name="bank" id="bank">
                            <option value="" data-discount="0" data-max-qty="0"><?php echo lang('requests');?></option>
                            <?php foreach ($banks as $bnk) { ?>
                                <option value="<?php echo $bnk['id']; ?>"><?php echo $bnk['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('deposit_amount'); ?></label>
                    <div class="col-sm-10"><input type="text" name="deposit_amount" id="deposit_amount" class="form-control" placeholder="Please Enter Deposit Amount"></div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-lg-6">
                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('confirm_by'); ?></label>
                    <div class="col-sm-10">
                        <select class="pr-select form-control" name="user_id" id="user_id">
                            <option value="" data-discount="0" data-max-qty="0"><?php echo lang('select_user');?></option>
                            <?php foreach ($users as $us) { ?>
                                <option value="<?php echo $us['userid']; ?>"><?php echo $us['username']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="data_5">
                    <label class="col-sm-2 control-label font-normal"><?php echo lang('select_date_range');?></label>
                    <div class="col-sm-10">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control-sm form-control" name="start" value="<?php echo date("Y-m-d")?>"/>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="form-control-sm form-control" name="end" value="<?php echo date("Y-m-d")?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit"><?php echo lang('search'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--    <div class="col-lg-2">-->
        <!--        <a href="--><?php //echo admin_url(); ?><!--request/add" class="btn mt30 btn-primary ">Add New Request</a>-->
        <!--    </div>-->
    </div>
    <!-- Products Table -->
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo lang('requests');?></h5>
                    <!-- <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div> -->
                </div>
                <div class="ibox-content declinedTable">
                    <table class="table table-striped table-bordered dt-responsive nowrap" id="tttt">
                        <thead>
                            <tr>
                                <th><?php echo lang('user_name');?></th>
                                <th><?php echo lang('transaction_no');?></th>
                                <th><?php echo lang('deposit_type');?></th>
                                <th><?php echo lang('bank_name');?></th>
                                <th><?php echo lang('deposit_amount');?></th>
                                <th><?php echo lang('decline_by');?></th>
                                <th><?php echo lang('decline_reason');?></th>
                                <th><?php echo lang('submitted_at');?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($pendingRequests)){
                                foreach ($pendingRequests as $pR) { ?>
                                    <tr>
                                        <td><?php echo $pR['username']; ?></td>
                                        <td><?php echo $pR['trans_id']; ?></td>
                                        <td><?php echo $pR['depositName']; ?></td>
                                        <td><?php echo $pR['bankName']; ?></td>
                                        <td><?php echo $pR['deposit_amount']; ?></td>
                                        <td><?php echo get_admin_name($pR['user_id']); ?></td>
                                        <td><?php echo $pR['decline_reason']; ?></td>
                                        <td><?php echo $pR['created_at']; ?></td>
                                        
                                    </tr>
                                <?php }} ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo lang('user_name');?></th>
                                    <th><?php echo lang('transaction_no');?></th>
                                    <th><?php echo lang('deposit_type');?></th>
                                    <th><?php echo lang('bank_name');?></th>
                                    <th><?php echo lang('deposit_amount');?></th>
                                    <th><?php echo lang('decline_by');?></th>
                                    <th><?php echo lang('decline_reason');?></th>
                                    <th><?php echo lang('submitted_at');?></th>
                                    
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Theme Cat End -->
    <?php $this->load->view('common/admin_footer'); ?>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

    <script>
     var table = $('#tttt').DataTable( { lengthChange: false, ordering: false, language: {
        "sSearch": "<?php echo lang('search');?>: ",
        oPaginate: {
            "sPrevious": "<?php echo lang('previous');?>",
            "sNext": "<?php echo lang('next');?>"
        }
    },
    buttons: [
    {
        extend: 'excelHtml5',
        title: 'Confirmed Requests'
    },
    {
        extend: 'pdfHtml5',
        title: 'Confirmed Requests'
    }
    ] } ); table.buttons().container() .appendTo( '#tttt_wrapper .col-md-6:eq(0)' );
</script>

<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function(){getDeclinedRequests();}, 10000);

        function getDeclinedRequests()
        {
            $.ajax({
                url:'<?php echo admin_url(); ?>request/search_declined',
                type:'post',
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        $(".declinedTable").html(status.response);
                    }
                    else if(status.msg == 'error'){
                        $.gritter.add({
                            title: 'Error!',
                            sticky: false,
                            time: '5000',
                            text: status.response,
                            class_name: 'gritter-error'
                        });
                    }
                }
            });
        }
        /* Init DataTables */
        // $('#aj-table').dataTable({
        //     responsive: true,
        //     "columns": [
        //         null,
        //         null,
        //         null,
        //         null,
        //         null,
        //         null,
        //         { "width": "64px" },
        //     ]
        // });
        $('.delete-btn').click(function(){
            var current = $(this);
            var id = current.data('id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                ajaxurl = '<?php echo admin_url(); ?>products/delete';
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
    });
</script>
</body>
</html>