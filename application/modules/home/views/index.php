<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('common/header'); ?>
</head>
<body>

<div class="container">

    <form id="depositForm">
        <div class="user-info">
            <div class="login">
                <div class="wrap">
                    <!-- TOGGLE -->
                    <div id="toggle-wrap">
                        <div id="toggle-terms">
                            <div id="cross">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <!-- TERMS -->
                    <div class="terms">
                        <h2><?php echo lang('instruction_head');?> </h2>
                        <p><?php echo lang('instruction_title');?></p>
                        <p><?php echo lang('instruction1');?></p>
                        <p><?php echo lang('instruction2');?></p>
                        <p><?php echo lang('instruction3');?></p>
                        <p><?php echo lang('instruction4');?></p>
                        <p><?php echo lang('instruction5');?></p>
                        <p><?php echo lang('instruction6');?></p>
                        <p><?php echo lang('instruction7');?></p>
                        <p><?php echo lang('instruction8');?></p>
                        <p><?php echo lang('instruction_note');?></p>
                    </div>


                    <!-- SLIDER -->
                    <div class="content">
                        <!-- LOGO -->
                        <div class="row padd-25">

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control soflow-color" id="depositType" name="depositType">
                                    <option value="0"><?php echo lang('select_deposit_type');?></option>
                                    <?php foreach ($depositTypes as $dT) { ?>
                                        <option value="<?php echo $dT['id'] ?>"><?php echo $dT['name'] ;?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-8 text-right money-deposit">
                                <h5 id="depositName"><?= lang('homeDeposit') ?></h5>
                                <p id="depositLimit">Min 20 TRY / MAX 4000 TRY</p>
                            </div>

                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <i class="fa-fw fa fa-warning"></i>
                                    <strong><?php echo lang('attention');?></strong>
                                    <?php echo lang('attention_message');?>
                                </div>
                                <div class="help-action">
                                    <button class="agree"> <?php echo lang('instruction_message');?></button>
                                </div>
                            </div>

                        </div>

                        <!-- SLIDESHOW -->
                        <div class="row img-block-outer">
                            <div  class="col-md-12 scrollbar" id="style-1">
                                <div class="row" style="margin-top: -6px;">
                                    <?php foreach ($banks as $bank) { ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="img-block">
                                                <img src="<?php echo base_url() ?>uploads/<?php echo $bank['logo'] ?>" alt="bank-logo">
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LOGIN FORM -->
                    <div class="user">
                        <div class="form-wrap">
                            <div class="tabs-content">
                                <!-- TABS CONTENT LOGIN -->
                                <div class="active">
                                    <div class="login-form">
                                        <div class="text-center">
                                            <img src="assets/images/logo.png" alt="logo">
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                                            <input class="input100" type="text" id="username" name="username" placeholder="<?php echo lang('user_name');?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="25">
                                            <input type="hidden" name="deposit_min" id="deposit_min">
                                            <input type="hidden" name="deposit_max" id="deposit_max">
                                            <input type="hidden" name="deposit_id" id="deposit_id">
                                            <input type="hidden" name="trans_no" id="trans_no" value="<?php echo uniqid(rand()); ?>">
                                            <span class="focus-input100" data-symbol=""></span>
                                        </div>
                                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                                            <input class="input100" type="text" id="amount" name="amount" placeholder="<?php echo lang('investment_amount');?>">
                                            <span class="focus-input100 amount-icon" data-symbol=""></span>
                                        </div>

                                        <div class="mt-20">
                                            <input type="checkbox" class="checkbox" checked id="remember_me">
                                            <label for="remember_me"><?php echo lang('want_bonus');?></label>
                                        </div>
                                        <input type="submit" class="button" id="submitBtn" value="<?php echo lang('submit');?>">
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

        //Deposit Type DropDown Code
        $('#depositType').on('change', function() {
            if (this.value == 0)
            {
                $.toaster({ message : 'Please Select Deposit Type', title : 'Deposit Type: ', priority : 'danger',  timeout: 30000 });
            }
            else
            {
                var ajaxurl = '<?php echo base_url(); ?>home/getBankByDepositId';
                var depositId = this.value;
                $.ajax({
                    url: ajaxurl,
                    type : 'post',
                    data: {id: depositId},
                    dataType: "json",
                    success: function(data ) {
                        if (data.msg == 'success') {

                            //Deposit Name And Min & Max Limit
                            var limit = 'Min '+ data.response[0].minDeposit + ' TRY / Max '+ data.response[0].maxDeposit + ' TRY';
                            $('#depositName').html(data.response[0].depositName);
                            $('#depositLimit').html(limit);


                            $('#deposit_id').val(depositId);
                            $('#deposit_min').val(data.response[0].minDeposit);
                            $('#deposit_max').val(data.response[0].maxDeposit);

                            //List All the available banks
                            $('.img-block-outer').empty();
                            var div = $(".img-block-outer");
                            $.each(data.response, function(index, value){
                                var url = "<?php echo base_url()?>";
                                url = url + 'uploads/' + value.logo;
                                var elem = "<div class='col-lg-4 col-md-6 col-sm-6'><div class='img-block'><img class='img-responsive' src="+url+" alt='bank-logo'></div></div>";
                                div.append(elem);
                            });
                            $('#formSubmit').removeAttr('disabled');
                        }else {
                            $.toaster({ message : 'No Bank Found Against Deposit Type', title : 'Deposit Type', priority : 'warning',  timeout: 30000 });
                            var limit = 'Min 0 TRY / Max 0 TRY';
                            $('#depositName').html('No Bank Found');
                            $('#depositLimit').html(limit);

                            $('.img-block-outer').empty();
                            var div = $(".img-block-outer");
                            var elem = "<div class='col-lg-4 col-md-6 col-sm-6'><div class ='alert alert-danger'>No bank found</div></div>";
                            div.append(elem);
                        }
                    },
                });
            }
        });

        //Submit Deposit Form
        $("#depositForm").validate();
        $('#depositForm').submit(function(e) {
            if($("#depositForm").valid()){
                e.preventDefault();
                var formData = $('#depositForm').serialize();
                //Check valid Investment Amount & Deposit Type & username
                var depId = $('#deposit_id').val();
                var username = $('#username').val();
                if (depId == '')
                {
                    $.toaster({ message : '<?php echo lang('select_deposit_type');?>', title : 'Deposit Type: ', priority : 'danger' ,  timeout: 50000});
                }
                else if (username == '')
                {
                    $.toaster({ message : '<?php echo lang('please_enter_username');?>', title : 'Valid Username: ', priority : 'danger',  timeout: 30000 });
                }
                else
                {
                    var minDeposit = parseInt($('#deposit_min').val());
                    var maxDeposit = parseInt($('#deposit_max').val());
                    var amount = parseInt($('#amount').val());
                    var transId = $('#trans_no').val();

                    if (amount >= minDeposit && amount <= maxDeposit){
                        var ajaxurl = '<?php echo base_url().'home/submit_deposit'; ?>';
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
                                    window.location.href = '<?php echo base_url() ?>selectBank/'+transId;
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }else{
                        $.toaster({ message : '<?php echo lang('please_enter_valide_amount');?>', title : 'Invalid Amount: ', priority : 'danger', timeout: 30000 });
                        $.toaster({ message : '<?php echo lang('amount_greater_than');?> '+minDeposit+' & <?php echo lang('amount_less_than');?> '+maxDeposit+' ', title : 'Valid Amount: ', priority : 'success', timeout: 30000 });
                    }
                }
            }
        });

    });

</script>
</body>
</html>