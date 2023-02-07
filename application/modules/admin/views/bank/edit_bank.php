<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Bank</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo admin_url(); ?>bank"><?php echo lang('banks');?></a>
            </li>
            <li class="active">
                <strong>Edit Bank</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="<?php echo admin_url(); ?>bank" class="btn mt30 btn-primary "><?php echo lang('back_to_banks');?></a>
    </div>
</div>
<!-- Theme Categories Table -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Bank</h5>
                </div>
                <div class="ibox-content">
                    <form id="add_bank_form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id" value="<?php echo $bank['id']; ?>">
                        <div class="form-group"><label class="col-sm-2 control-label">Logo</label>
                            <div class="col-sm-10">
                                <div class="col-sm-2">
                                    <img src="<?php echo base_url()?>uploads/<?php echo $bank['logo'] ?>" alt="Bank Logo" class="img-responsive img-thumbnail">
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" name="logo" id="logo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('deposit_type');?></label>
                            <div class="col-sm-10">
                                <select class="pr-select form-control" name="deposit_type" id="deposit_type">
                                    <option value="" data-discount="0" data-max-qty="0"><?php echo lang('select_deposit_type');?></option>
                                    <?php foreach ($despositTypes as $dT): ?>
                                        <?php if ($dT['id'] == $bank['deposit_id']): ?>
                                            <option selected value="<?php echo $dT['id']; ?>"><?php echo $dT['name']; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $dT['id']; ?>"><?php echo $dT['name']; ?></option>
                                        <?php endif; ?>                        
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('name');?></label>
                            <div class="col-sm-10"><input type="text" name="bank_name" id="bank_name" value="<?php echo $bank['name']; ?>" class="form-control" required="required" placeholder="Please Enter Your Bank Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">SMS 1</label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="sms1" class="onoffswitch-checkbox" id="collapsemenu" <?php if($bank['sms1'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">SMS 2</label>
                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="sms2" class="onoffswitch-checkbox" id="collapsemenusms" <?php if($bank['sms2'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenusms">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">TC No</label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="tc_no" class="onoffswitch-checkbox" id="collapsemenutc" <?php if($bank['tc_no'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenutc">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('bank_customer_no');?></label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="bank_customer_no" class="onoffswitch-checkbox" id="collapsemenubcn" <?php if($bank['bank_customer'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenubcn">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('bank_customer_password');?></label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="bank_customer_password" class="onoffswitch-checkbox" id="collapsemenubcp" <?php if($bank['bank_password'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenubcp">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('bank_card_no');?></label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="bank_card_no" class="onoffswitch-checkbox" id="collapsemenubcardn" <?php if($bank['bank_card_no'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenubcardn">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('bank_card_password');?></label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="bank_card_password" class="onoffswitch-checkbox" id="collapsemenubcardp" <?php if($bank['bank_card_password'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenubcardp">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('note');?></label>

                            <div class="col-sm-10">
                                <textarea name="note" id="note" cols="100" rows="10"><?php echo $bank['note']; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('publish_status');?></label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="status" class="onoffswitch-checkbox" id="collapsemenustatus" <?php if($bank['status'] == 1 ) { ?> checked <?php } ?>>
                                        <label class="onoffswitch-label" for="collapsemenustatus">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" id="cancel_btn" data-url="<?php echo admin_url(); ?>bank"><?php echo lang('cancel');?></button>
                                <button class="btn btn-primary" type="button" id="update_bank_btn"> <?php echo lang('save_change');?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Theme Cat End -->
<?php $this->load->view('common/admin_footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#add_bank_form").validate();
        $('#update_bank_btn').click(function(e) {
            if($("#add_bank_form").valid()){
                e.preventDefault();
                var formData = new FormData($("#add_bank_form")[0]);
                var ajaxurl = '<?php echo admin_url() ?>bank/update_bank';
                $.ajax({
                    url: ajaxurl,
                    type : 'POST',
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data ) {
                        if(data.msg =='error') {
                            toastr.error(data.response , "Error");
                        } else if(data.msg =='success') {
                            toastr.success(data.response , "Success");
                        }
                    },
                });
            }
        });
    });  
</script>
</body>
</html>