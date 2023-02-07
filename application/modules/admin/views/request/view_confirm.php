<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo lang('view_processed_requests');?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo admin_url(); ?>request/processedRequests"><?php echo lang('processed_requests');?></a>
            </li>
            <li class="active">
                <strong><?php echo lang('confirm_request');?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="<?php echo admin_url(); ?>request/processedRequests" class="btn mt30 btn-primary "><?php echo lang('back_to_processed_requests');?></a>
    </div>
</div>

<!-- Theme Categories Table -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo lang('confirm_request');?></h5>
                </div>
                <div class="ibox-content">
                    <form id="complete_request" class="form-horizontal" method="post" action="">
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('deposit_amount');?></label>
                            <input type="hidden" id="trans_id" name="trans_id" value="<?php echo $request['trans_id'] ?>">
                            <input type="hidden" id="re_id" name="re_id" value="<?php echo $request['id'] ?>">
                            <div class="col-sm-10"><input type="number" class="form-control" name="confirmDeposit" id="confirmDeposit" value="<?php echo $request['deposit_amount'] ?>" min="1"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white decline_request" type="button" data-id="<?php echo $request['id']; ?>"><?php echo lang('cancel');?></button>
                                <button class="btn btn-primary" type="button" id="confirmDepositbtn"><?php echo lang('confirm_request');?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="decline_request_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('close');?></span></button>
                <i class="fa fa-times modal-icon"></i>
                <h4 class="modal-title"><?php echo lang('decline_request');?>?</h4>
            </div>
            <div class="modal-body">
                <form id="decline_request_form">
                    <input type="hidden" name="request_id" id="request_id">
                    <div class="form-group"><label><?php echo lang('decline_reason');?></label><textarea placeholder="Enter request decline reason" name="decline_reason" id="decline_reason" class="form-control"></textarea></div> 
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo lang('close');?></button>
                <button type="button" class="btn btn-primary" id="decline_request_btn"><?php echo lang('decline');?></button>
            </div>
        </div>
    </div>
</div>
<!-- Theme Cat End -->
<?php $this->load->view('common/admin_footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){


        $(document).on('click', ".decline_request", function(){
            var request_id = $(this).attr("data-id");
            $("#request_id").val(request_id);
            $("#decline_request_modal").modal('show');
        });
        $(document).on('click', "#decline_request_btn", function(){
            var value = $("#decline_request_form").serialize();

            if($("#decline_reason").val() == '') {
                toastr.error("Decline reason field is required.", "Error");
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
                             window.location.href = '<?php echo admin_url() ?>request/processedRequests';
                         });

                    }else {
                        swal("Error!", status.response, "error");
                    }
                },
            });
        });
        

        $(document).on('click', "#confirmDepositbtn", function(){

            var value = $("#complete_request").serialize();

            if($("#confirmDeposit").val() == '') {
                toastr.error("Deposit Amount is required.", "Error");
                return false;
            }

            $.ajax({
                url: "<?php echo admin_url(); ?>request/completed",
                type : 'post',
                data:value,
                dataType: "json",
                success: function(status) {
                    if (status.msg == 'success') {
                        swal({title: "Done!", text: status.response, type: "success"},
                           function(){ 
                             window.location.href = '<?php echo admin_url() ?>request/processedRequests';
                         });

                    }else {
                        swal("Error!", status.response, "error");
                    }
                },
            });
        });




    });
</script>
</body>
</html>