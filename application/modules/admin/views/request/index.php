<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo lang('pending_request');?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li class="active">
                <strong><?php echo lang('pending_request');?></strong>
            </li>
        </ol>
        <div class="hr-line-dashed"></div>
    </div>
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
    <div class="ibox-content">
        <div class="pendingTable">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="aj-table">
                <thead>
                    <tr>
                        <th><?php echo lang('user_name');?></th>
                        <th><?php echo lang('transaction_no');?></th>
                        <th><?php echo lang('deposit_type');?></th>
                        <th><?php echo lang('bank_name');?></th>
                        <th><?php echo lang('deposit_amount');?></th>
                        <th><?php echo lang('submitted_at');?></th>
                        <th><?php echo lang('action');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pendingreqests = "";
                    if (!empty($pendingRequests)){
                        foreach ($pendingRequests as $pR) { (empty($pendingreqests)) ? $pendingreqests = $pR['id'] : $pendingreqests .= ",".$pR['id'];   ?>
                        <tr>
                            <td><?php echo $pR['username']; ?></td>
                            <td><?php echo $pR['trans_id']; ?></td>
                            <td><?php echo $pR['depositName']; ?></td>
                            <td><?php echo $pR['bankName']; ?></td>
                            <td><?php echo $pR['deposit_amount']; ?></td>
                            <td><?php echo $pR['created_at']; ?></td>
                            <td>
                                <a href="<?php echo admin_url(); ?>request/process/<?php echo $pR['id']; ?>"><button class="btn btn-success btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="Processed"><i class="fa fa-flag"></i></button></a>
                                <button class="btn btn-danger btn-circle decline_request" type="button" data-toggle="tooltip" data-placement="top" title="Decline" data-id="<?php echo $pR['id']; ?>"><i class="fa fa-ban"></i></button>

                            </td>
                        </tr>
                    <?php } } ?>

                    
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th><?php echo lang('user_name');?></th>
                        <th><?php echo lang('transaction_no');?></th>
                        <th><?php echo lang('deposit_type');?></th>
                        <th><?php echo lang('bank_name');?></th>
                        <th><?php echo lang('deposit_amount');?></th>
                        <th><?php echo lang('submitted_at');?></th>
                        <th><?php echo lang('action');?></th>
                    </tr>
                </tfoot>
            </table>

            <input type="hidden" id="requests" value="<?php echo $pendingreqests; ?>">
        </div>

    </div>
</div>
</div>
</div>
</div>



<div class="modal inmodal" id="decline_request_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('close'); ?></span></button>
                <i class="fa fa-times modal-icon"></i>
                <h4 class="modal-title"><?php echo lang('decline_request');?>?</h4>
            </div>
            <div class="modal-body">
                <form id="decline_request_form">
                    <input type="hidden" name="request_id" id="request_id">
                    <div class="form-group"><label><?php echo lang('decline_reason');?></label><textarea placeholder="<?php echo lang('enter_decline_request_reason');?>" name="decline_reason" id="decline_reason" class="form-control"></textarea></div> 
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button type="button" class="btn btn-primary" id="decline_request_btn"><?php echo lang('decline');?></button>
            </div>
        </div>
    </div>
</div>


<audio id="my_audio" src="<?php echo base_url(); ?>admin-assets/ping_sound.mp3"></audio>

<!-- Theme Cat End -->
<?php $this->load->view('common/admin_footer'); ?>
<script type="text/javascript">
    $(document).ready(function() {

        /* Init DataTables */
        setInterval(function(){getPendingRequests();}, 10000);

        function getPendingRequests()
        {
            var requests = $("#requests").val();
            $.ajax({
                url:'<?php echo admin_url(); ?>request/search_pending',
                type:'post',
                data: { requests : requests  },
                dataType:'json',

                success:function(status){
                    if(status.msg=='success'){
                        $(".pendingTable").html(status.response);

                        if(status.beepalert == 1) {
                             $("#my_audio").get(0).play();
                        }
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
        $('#aj-table').dataTable({
            "bInfo":false,
            "ordering": false,
            "responsive": true,
            "oLanguage": {
                "sSearch": "<?php echo lang('search');?>: ",
                "oPaginate": {
                    "sPrevious": "<?php echo lang('previous');?>",
                    "sNext": "<?php echo lang('next');?>"
                }
            },
           
            "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
            ]
        });

        $(document).on('click', ".decline_request", function(){
            var request_id = $(this).attr("data-id");
            $("#request_id").val(request_id);
            $("#decline_request_modal").modal('show');
        });


        $(document).on('click', "#decline_request_btn", function(){
            var value = $("#decline_request_form").serialize();

            if($("#decline_reason").val() == '') {
                toastr.error("<?php echo lang('decline_reason_field_is_required'); ?>", "Error");
                return false;
            }

            $.ajax({
                url: "<?php echo admin_url(); ?>request/declined",
                type : 'post',
                data:value,
                dataType: "json",
                success: function(status) {
                    if (status.msg == 'success') {
                        swal({title: "Done!", text: status.response, type: "success"},
                           function(){ 
                             location.reload();
                         });

                    }else {
                        swal("Error!", status.response, "error");
                    }
                },
            });
        });


        $(document).on('click', ".delete-btn", function(){
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
                ajaxurl = '<?php echo admin_url(); ?>requests/delete';
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