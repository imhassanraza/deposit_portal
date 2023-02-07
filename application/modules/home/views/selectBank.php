<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>

<div class="container">

    <form id="selectBankForm">

        <div class="user-info available-bank">
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
                            <h4 class="select-txt"><?php echo lang('select_your_bank');?></h4>
                            <hr>
                        </div>
                    </div>
                    <div class="login100-form">
                        <div class="row select-block-area" data-toggle="buttons">
                            <div  class="col-md-12 scrollbar" id="style-1">
                                <div class="row image-second-div">
                                    <?php foreach ($bank as $bnk) { ?>
                                        <div class="col-md-4 col-sm-6">
                                            <div class='select-block btn' for='option1'>
                                                <img src="<?php echo base_url() ?>uploads/<?php echo $bnk['logo'] ?>" alt="bank-logo">
                                                <input type='radio' required="required" value="<?php echo $bnk['id'] ?>" name='bank_id' id='option1' autocomplete='off'>
                                                <br>
                                                <label>

                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">


    $(document).ready(function(){

        $('#option1').click(function(){
            if ($(this).is(':checked'))
            {
                alert($(this).val());
            }
        });

        //Submit Deposit Form
        $("#selectBankForm").validate();
        $('#selectBankForm').submit(function(e) {
            if($("#selectBankForm").valid()){
                e.preventDefault();
                var bank = $("input[name='bank_id']:checked").val();
                var transId = $('#trans_no').val();
                if(typeof bank == 'undefined')
                {
                    $.toaster({ message : 'Please Select Bank To proceed', title : 'Bank', priority : 'danger',  timeout: 30000 });
                }
                else
                {
                    var formData = $('#selectBankForm').serialize();
                    var ajaxurl = '<?php echo base_url().'home/submit_trans_bank'; ?>';
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
                                window.location.href = '<?php echo base_url() ?>proceeding/'+transId;
                                //checkProcessedRequest();
                                // Make Ajax call by interval
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }
            }
        });


        $(document).on("click", ".delete-btn", function(){
            var current = $(this);
            var id = current.data('id');
            ajaxurl = '<?php echo base_url(); ?>home/cancel_tranaction';
            $.ajax({
              url: ajaxurl,
              type : 'post',
              data: {id: id},
              dataType: "json",
              success: function(data ) {
                if (data.msg == 'success'){
                    window.location.href = '<?php echo base_url(); ?>';
                }
              },
            });
        });


    });

</script>
</body>
</html>