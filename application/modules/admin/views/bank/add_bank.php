<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo lang('add_bank');?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo admin_url(); ?>bank"><?php echo lang('banks');?></a>
            </li>
            <li class="active">
                <strong><?php echo lang('add_bank');?></strong>
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
                    <h5><?php echo lang('add_new_bank');?></h5>
                </div>
                <div class="ibox-content">
                    <form id="add_bank_form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group"><label class="col-sm-2 control-label">Logo</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" id="logo" class="form-control" required="required" title = "<?php echo lang('no_file_chosen');?>">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('deposit_type');?></label>
                            <div class="col-sm-10">
                                <select class="pr-select form-control" name="deposit_type" id="deposit_type">
                                    <option value="" data-discount="0" data-max-qty="0"><?php echo lang('select_deposit_type');?></option>
                                    <?php foreach ($despositTypes as $dT) { ?>
                                    <option value="<?php echo $dT['id']; ?>"><?php echo $dT['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('name');?></label>
                            <div class="col-sm-10"><input type="text" name="bank_name" id="bank_name" class="form-control" required="required" placeholder="Please Enter Your Bank Name"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">SMS 1</label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="sms1" class="onoffswitch-checkbox" id="collapsemenu">
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
                                        <input type="checkbox" name="sms2" class="onoffswitch-checkbox" id="collapsemenusms">
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
                                        <input type="checkbox" name="tc_no" class="onoffswitch-checkbox" id="collapsemenutc">
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
                                        <input type="checkbox" name="bank_customer_no" class="onoffswitch-checkbox" id="collapsemenubcn">
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
                                        <input type="checkbox" name="bank_customer_password" class="onoffswitch-checkbox" id="collapsemenubcp">
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
                                        <input type="checkbox" name="bank_card_no" class="onoffswitch-checkbox" id="collapsemenubcardn">
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
                                        <input type="checkbox" name="bank_card_password" class="onoffswitch-checkbox" id="collapsemenubcardp">
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
                                <textarea name="note" id="note" cols="100" rows="10"></textarea>
                                <!--                                <input type="text" name="customer_mobile" id="mobile" class="form-control" required="required" placeholder="03451234567">-->
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('publish_status');?></label>

                            <div class="col-sm-10">
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="status" class="onoffswitch-checkbox" id="collapsemenustatus">
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
                                <button class="btn btn-primary" type="button" id="add_bank_btn"><?php echo lang('add_bank');?></button>
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
        $('#add_bank_btn').click(function(e) {
            if($("#add_bank_form").valid()){
                e.preventDefault();
                var formData = new FormData($("#add_bank_form")[0]);
                var ajaxurl = '<?php echo admin_url() ?>bank/submit_bank';
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
                            $('#add_bank_form')[0].reset();
                        }
                    },
                });
            }
        });
    });  
</script>
</body>
</html>