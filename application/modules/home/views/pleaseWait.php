<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>

    <div class="container">
        <form id="depositForm">
            <div class="row">
                <div class="col-md-12">
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
                                                <input type="hidden" name="trans_no" id="trans_no" value="<?php echo $reqInfo['trans_id'] ?>">
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-sm-4 col-12 text-right">
                                            <h4>
                                                <?php echo lang('amount');?>
                                            </h4>
                                            <p>
                                                <storng id="reqAmount"><?php echo $reqInfo['deposit_amount']; ?></storng> TRY
                                            </p>
                                        </div>
                                    </div>
                                </header>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h4 class="select-txt"><?php echo lang('please_wait');?></h4>
                                        <hr>
                                        <p class="sms-txt"><?php echo lang('please_do_not_close_this_page');?></p>
                                    </div>
                                </div>
                            </div>
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


            setInterval(function(){ checkProTNOstatus(); }, 10000);
            function checkProTNOstatus(){
                var transid = $('#trans_no').val();
                var ajaxurl = '<?php echo base_url(); ?>home/checkProTNOstatus';
                var feedback = $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: {id: transid,status:2},
                    dataType: "json",
                    async: false,
                    success: function(data){
                        //console.log(data);
                        if(data.msg =='error') {
                            //setTimeout(function(){checkProTNOstatus();}, 10000);
                        }else if(data.msg =='success') {
                            window.location.href = '<?php echo base_url() ?>bankInfo/'+transid;
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
        });

    </script>
</body>
</html>