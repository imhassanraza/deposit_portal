    <div class="row">
        <div class="col-lg-12">
            <div class="m-b-md">
                <button type="button" class="close pull-right" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('close');?></span></button>
                <a href="<?php admin_url(); ?>bank/edit/<?php echo $bank['id']; ?>" class="btn btn-danger btn-xs pull-right me-btn">Edit Bank</a>
                <h2>Bank Details</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="">
                <p><b><?php echo lang('bank_name');?>:</b> <?php echo $bank['name']; ?></p>
                <p><b><?php echo lang('deposit_type');?> <span class="text-navy"> <?php echo $bank['depositName']; ?></span> </p>
                </div>
            </div>
            <div class="col-sm-6" id="cluster_info">
                <div class="">
                    <p><b>SMS 1:</b> <?php echo ($bank['sms1'] == 1) ? "Yes" : "NO" ?> </p>
                    <p><b>SMS 2:</b> <?php echo ($bank['sms2'] == 1) ? "Yes" : "NO" ?> </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p><b>TC NO:</b> <?php echo ($bank['tc_no'] == 1) ? "Yes" : "NO" ?> </p>
                <p><b>Bank Customer:</b> <?php echo ($bank['bank_customer'] == 1) ? "Yes" : "NO" ?> </p>
                <p><b><?php echo lang('bank_card_password');?>:</b> <?php echo ($bank['bank_card_password'] == 1) ? "Yes" : "NO" ?> </p>
                <p><b><?php echo lang('status');?>:</b> <?php echo ($bank['status'] == 1) ? "Yes" : "NO" ?> </p>
            </div>
            <div class="col-sm-6">
                <p><b>Bank Password:</b> <?php echo ($bank['bank_password'] == 1) ? "Yes" : "NO" ?> </p>
                <p><b><?php echo lang('bank_card_no');?>:</b> <?php echo ($bank['bank_card_no'] == 1) ? "Yes" : "NO" ?> </p>
                <p><b><?php echo lang('note');?>:</b> <?php echo $bank['note'] ?> </p>
                <p><b><?php echo lang('created_at');?>:</b> <?php echo date('d-m-Y', strtotime($bank['created_at'])) ?> </p>
            </div>
        </div>
