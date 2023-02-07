<?php $this->load->view('common/admin_header'); ?>
<!-- Dashboard -->
<div class="wrapper wrapper-content">
    <div class="row">
    <?php if(get_permission('pending_requests') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('pending_request');?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($pendingRequest); ?></h1>
                    <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/request/pendingRequests"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('pending_request');?></small>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if(get_permission('processed_requests') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('processed_request');?></h5><br>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($processedRequest); ?></h1>
                    <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/request/processedRequests"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('processed_request');?></small>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(get_permission('completed_requests') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('confirmed_request');?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($confirmedRequest); ?></h1>
                    <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/request/confirmedRequests"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('confirmed_request');?></small>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(get_permission('declined_requests') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('declined_request');?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($declinedRequest); ?></h1>
                    <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/request/declinedRequests"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('declined_request');?></small>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(get_permission('bank_view') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('total_bank');?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($banks); ?></h1>
                    <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/bank"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('total_bank');?></small>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(get_permission('bank_view') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('active_bank');?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($activeBanks); ?></h1>
                    <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/bank?status=active"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('active_bank');?></small>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(get_permission('deposit_view') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('deposit_option');?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($depositOptions); ?></h1>
                     <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/bank/depositOptions"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('deposit_option');?></small>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(get_permission('user_view') == 1) { ?>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <h5><?php echo lang('total_user');?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($users); ?></h1>
                    <div class="stat-percent font-bold text-primary"><a href="<?php echo base_url(); ?>admin/users"><?php echo lang('view');?></a></div>
                    <small><?php echo lang('total_user');?></small>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    
</div>
<!-- End Dashboard -->
<?php $this->load->view('common/admin_footer'); ?>

</body>
</html>