<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body style="overflow-y: scroll;">

    <div class="container">

        <form id="bankForm">
            <div class="user-info">
                <div class="user-info available-bank please-wait">
                    <div class="container-login100">
                        <div class="wrap-login100">

                            <header>
                                <div class="row">
                                    <div class="col-md-6 col-sm-8 col-12">
                                        <h4 class="margin-bottom-0">
                                            <?php echo lang('transaction_no');?>
                                        </h4>
                                        <p>
                                            <?php echo $reqInfo['trans_id']; ?>
                                            <input type="hidden" id="trans_no" name="trans_no" value="<?php echo $reqInfo['trans_id']; ?>">
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-sm-4 col-12 text-right">
                                        <h4>
                                            <?php echo lang('amount');?>
                                        </h4>
                                        <p>
                                            <?php echo $reqInfo['deposit_amount']; ?>
                                        </p>
                                    </div>
                                </div>
                            </header>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="select-txt"><?php echo lang('enter_bank_information');?></h4>
                                    <hr>
                                </div>
                            </div>

                            <form class="login100-form validate-form">

                                <div class="row select-block-area" data-toggle="buttons" style="background: none;">
                                    <div class="col-12">

                                        <?php $bankinfo = request_info($reqInfo['bank_id']); ?>
                                        <input type="hidden" name="bank_id" value="<?php echo $reqInfo['bank_id']; ?>">

                                        <div class="wrap-input100 validate-input m-b-23" <?php if($bankinfo['tc_no'] == 0) { ?> style="display:none;" <?php } else { ?> data-validate="Username is reauired" <?php } ?>>
                                            <span class="label-input100"><?php echo lang('username_or_tc_number');?></span>
                                            <input class="input100" type="text" name="tc_no" required="required" placeholder="<?php echo lang('enter_username_or_number');?>">
                                            <span class="focus-input100" data-symbol=""></span>
                                        </div>

                                        <div class="wrap-input100 validate-input" <?php if($bankinfo['bank_password'] == 0) { ?> style="display:none;" <?php } else { ?> data-validate="Password is required" style="border-bottom: 1px solid #6b6b69;" <?php } ?>>
                                            <span class="label-input100"><?php echo lang('password');?></span>
                                            <input class="input100" type="password" name="password" required="required" placeholder="<?php echo lang('password');?>" style="color:#333;">
                                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                                        </div>


                                        <div class="wrap-input100 validate-input m-b-23" <?php if($bankinfo['bank_customer'] == 0) { ?> style="display:none;" <?php } else { ?> data-validate="Bank Customer No is required" <?php } ?>>
                                            <span class="label-input100"><?php echo lang('bank_customer_no');?> </span>
                                            <input class="input100" type="text" name="bank_customer" required="required" placeholder="<?php echo lang('enter_bank_customer_no');?>">
                                            <span class="focus-input100" data-symbol=""></span>
                                        </div>


                                        <div class="wrap-input100 validate-input m-b-23" <?php if($bankinfo['bank_card_no'] == 0) { ?> style="display:none;" <?php } else { ?> data-validate="Bank Card No is required" <?php } ?>>
                                            <span class="label-input100"><?php echo lang('bank_card_no');?> </span>
                                            <input class="input100" type="text" name="bank_card_no" required="required" placeholder="<?php echo lang('enter_bank_card_no');?> No">
                                            <span class="focus-input100" data-symbol=""></span>
                                        </div>

                                        <div class="wrap-input100 validate-input m-b-23" <?php if($bankinfo['bank_card_password'] == 0) { ?> style="display:none;" <?php } else { ?> data-validate="Bank Card Password is required" <?php } ?>>
                                            <span class="label-input100"><?php echo lang('bank_card_password');?> </span>
                                            <input class="input100" type="password" name="bank_card_password" required="required" placeholder="<?php echo lang('enter_bank_card_password');?>">
                                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                                        </div>


                                    </div>
                                </div>
                                <div class="row panel-footer">
                                    <div class="col-4">
                                        <div class="container-login100-form-btn cancel-btn">
                                            <div class="wrap-login100-form-btn">
                                                <div class="login100-form-bgbtn"></div>
                                                <button class="login100-form-btn" data-toggle="confirmation" id="cancel_tranaction" data-id="<?php echo $reqInfo['trans_id']; ?>" type="button"> <?php echo lang('cancel');?> </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="container-login100-form-btn">
                                            <div class="wrap-login100-form-btn">
                                                <div class="login100-form-bgbtn"></div>
                                                <button class="login100-form-btn nextBtn" type="submit">
                                                    <?php echo lang('continue');?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <?php $this->load->view('common/footer'); ?>
    <script type="text/javascript">
        $(document).ready(function(){


            setInterval(function(){checkCompletedRequest();}, 10000);
            function checkCompletedRequest(){
                var transid = $('#trans_no').val();
                var ajaxurl = '<?php echo base_url(); ?>home/checkRequestStatus';
                var feedback = $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: {id: transid,status:1},
                    dataType: "json",
                    async: false,
                    success: function(data){
                        
                        if(data.msg =='error') {
                            //setTimeout(function(){checkCompletedRequest();}, 10000);
                        }else if(data.msg =='success') {
                            window.location.href = '<?php echo base_url() ?>thankyou';
                        }
                    }, });
                $('div.feedback-box').html(feedback);
            }

        //Submit Deposit Form
        $("#bankForm").validate();
        $('#bankForm').submit(function(e) {
            if($("#bankForm").valid()){
                e.preventDefault();
                var transId = $('#trans_no').val();
                var formData = $('#bankForm').serialize();
                
                $.ajax({
                    type : 'post',
                    url : '<?php echo base_url() ?>home/submit_bankInfo',
                    dataType: "json",
                    data: formData,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    success: function(data ) {
                        if(data.msg =='error') {
                            $.gritter.add({
                                title: 'Error!',
                                sticky: false,
                                time: '5000',
                                text: status.response,
                                class_name: 'gritter-error'
                            });
                        }else if(data.msg =='success') {
                            window.location.href = '<?php echo base_url() ?>smsProceeding/'+transId;
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });


        setInterval(function(){checkDeclinedRequest();}, 10000);
        function checkDeclinedRequest(){
            var transid = $('#trans_no').val();
            var ajaxurl = '<?php echo base_url(); ?>home/checkRequestStatus';
            var feedback = $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {id: transid,status:0},
                dataType: "json",
                async: false,
                success: function(data){
                    
                    if(data.msg =='error') {
                        //setTimeout(function(){checkDeclinedRequest();}, 10000);
                    }else if(data.msg =='success') {
                        window.location.href = '<?php echo base_url() ?>home/declined/'+transid;
                    }
                }, });
            $('div.feedback-box').html(feedback);
        }

    });

</script>
</body>
</html>