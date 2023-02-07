<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Deposit Type</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo admin_url(); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo admin_url(); ?>bank/depositOptions">Deposit Types</a>
                </li>
                <li class="active">
                    <strong><?php echo lang('edit_deposit');?></strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <a href="<?php echo admin_url(); ?>bank/depositOptions" class="btn mt30 btn-primary "><?php echo lang('back_to_depoist_type');?></a>
        </div>
    </div>

    <!-- Theme Categories Table -->
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Deposit</h5>
                </div>
                <div class="ibox-content">
                    <form id="edit_order_form" class="form-horizontal">
                        <input type="hidden" name="id" value="<?php echo $deposit['id']; ?>" id="id" class="form-control">
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('name');?></label>
                            <div class="col-sm-10"><input type="text" name="name" value="<?php echo $deposit['name']; ?>" id="name" class="form-control" required="required"></div>
                        </div>            
<!--                        <input type="hidden" name="sulg" value="--><?php //echo $deposit['slug']; ?><!--">-->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('slug');?></label>

                            <div class="col-sm-10"><input type="text" name="slug" value="<?php echo $deposit['slug']; ?>" id="slug" class="form-control" required="required"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('min_investment');?></label>

                            <div class="col-sm-10"><input type="number" name="min" value="<?php echo $deposit['min']; ?>" id="min" min="1" class="form-control" required="required" ></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('max_investment');?></label>

                            <div class="col-sm-10"><input type="number" name="max" value="<?php echo $deposit['max']; ?>" id="max" class="form-control" min="1" required="required" ></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" id="cancel_btn" data-url="<?php echo admin_url(); ?>bank/depositOptions"><?php echo lang('cancel');?></button>
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
$(document).ready(function(){



    $("#edit_order_form").validate();
    $('#edit_order_form').submit(function(e) {
    if($("#edit_order_form").valid()){
      e.preventDefault();
      var formData = $('#edit_order_form').serialize();
      var ajaxurl = '<?php echo admin_url() ?>bank/update_deposit';
      $.ajax({
        url: ajaxurl,
        type : 'post',
        dataType: "json",
        data: formData,
        success: function(data ) {
          if(data.msg =='error') {
            toastr.error(data.response);
          }else if(data.msg =='success') {
            toastr.success(data.response);
          }
        }
      });
    }
    });


    $('.datepicker').datepicker({format:'yyyy-mm-dd', autoclose: true});
});  
</script>
</body>
</html>