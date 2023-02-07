<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Profile</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo admin_url(); ?>">Home</a>
                </li>
                <!-- <li>
                    <a href="<?php //echo admin_url(); ?>profile">Profile</a>
                </li> -->
                <li class="active">
                    <strong><?php echo lang('change_password');?></strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <a href="<?php echo admin_url(); ?>" class="btn mt30 btn-primary "><?php echo lang('back_to_home_page');?></a>
        </div>
    </div>

    <!-- Theme Categories Table -->
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo lang('change_password');?></h5>
                    <!-- <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div> -->
                    
                </div>
                <div class="ibox-content">
                    <form id="change-password-form" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-3 control-label">Old Password</label>

                            <div class="col-sm-9"><input type="password" name="old_password" id="old_password" class="form-control" required="required" placeholder=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-3 control-label">New Password</label>

                            <div class="col-sm-9"><input type="password" name="password" id="password" class="form-control" required="required" placeholder=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-3 control-label">Confirm Password</label>

                            <div class="col-sm-9"><input type="password" name="password_confirm" id="password_confirm" class="form-control" required="required" placeholder=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-white" id="cancel_btn" data-url="<?php echo admin_url(); ?>dashboard"><?php echo lang('cancel');?></button>
                                <button class="btn btn-primary" type="submit"><?php echo lang('save_change');?></button>
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
    $.extend($.validator.messages, { 
        equalTo: "Password and confirm password doesn't match.",
    });
    $("#change-password-form").validate({
        rules : {
            password_confirm : {
                equalTo : "#password"
            }
        }
    });
    $('#change-password-form').submit(function(e) {
        if($("#change-password-form").valid()){
          e.preventDefault();
          var formData = $('#change-password-form').serialize();
          var ajaxurl = '<?php echo admin_url().'profile/update_password'; ?>';
          $.ajax({
            url: ajaxurl,
            type : 'post',
            dataType: "json",
            data: formData,
            success: function(data ) {
              if(data.msg =='error') {
                toastr.error(data.response);
                jQuery('#old_password').val('');
              }else if(data.msg =='success') {
                toastr.success(data.response);
                jQuery('#change-password-form')[0].reset();
              }
            }
          });
        }
    });
</script>
</body>
</html>