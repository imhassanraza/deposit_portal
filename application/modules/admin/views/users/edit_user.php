<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?php echo lang('user');?></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo admin_url(); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo admin_url(); ?>users"><?php echo lang('user');?> List</a>
                </li>
                <li class="active">
                    <strong>Edit User</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <a href="<?php echo admin_url(); ?>users" class="btn mt30 btn-primary "><?php echo lang('back_to_user');?></a>
        </div>
    </div>

    <!-- Theme Categories Table -->
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit User</h5>
                </div>
                <div class="ibox-content">
                    <form id="edit_user_form" class="form-horizontal">
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $users['userid'];?>" >
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('name');?></label>

                            <div class="col-sm-10"><input type="text" name="name" id="name" value="<?php echo $users['username'];?>" class="form-control" required="required" placeholder="<?php echo lang('please_enter_your_name');?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10"><input type="email" name="email" id="email" value="<?php echo $users['email'];?>" class="form-control" readonly placeholder="<?php echo lang('please_enter_your_email');?>"></div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('password');?>
                        </label>
                        <div class="col-sm-10"><input type="password" name="password" id="password"  class="form-control" placeholder="Leave blank if you do not want to update password"></div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Mobile</label>

                            <div class="col-sm-10"><input type="text" name="mobile" id="mobile" value="<?php echo $users['phone'];?>" class="form-control" required="required" placeholder="03451234567"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('address');?></label>

                            <div class="col-sm-10"><input type="text" name="address" id="address" value="<?php echo $users['address'];?>" class="form-control" required="required" placeholder="<?php echo lang('enter_address');?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><h2 class="col-sm-2"><?php echo lang('permission');?></h2></div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                        </div>

                        <div class="col-sm-12" style="padding:0px;">
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center"><?php echo lang('view');?></th>
                                    <th class="text-center"><?php echo lang('add');?></th>
                                    <th class="text-center"><?php echo lang('edit');?></th>
                                    <th class="text-center"><?php echo lang('delete');?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('pending_request');?></label></th>
                                    <td><input type="checkbox" name="pending_requests" id="address" <?php if($users['pending_requests'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('processed_request');?></label></th>
                                    <td><input type="checkbox" name="processed_requests" id="address" <?php if($users['processed_requests'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('confirmed_request');?></label></th>
                                    <td><input type="checkbox" name="completed_requests" id="address" <?php if($users['completed_requests'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('declined_request');?></label></th>
                                    <td><input type="checkbox" name="declined_requests" id="address" <?php if($users['declined_requests'] == 1 ) { ?> checked <?php } ?>  class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('deposit_type');?></label></th>
                                    <td><input type="checkbox" name="deposit_view" id="address" <?php if($users['deposit_view'] == 1 ) { ?> checked <?php } ?>  class="form-control"></td>
                                    <td><input type="checkbox" name="deposit_add" id="address" <?php if($users['deposit_add'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="deposit_edit" id="address" <?php if($users['deposit_edit'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="deposit_delete" id="address" <?php if($users['deposit_delete'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                </tr>

                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('banks');?></label></th>
                                    <td><input type="checkbox" name="bank_view" id="address" <?php if($users['bank_view'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="bank_add" id="address" <?php if($users['bank_add'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="bank_edit" id="address" <?php if($users['bank_edit'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="bank_delete" id="address" <?php if($users['bank_delete'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('user');?></label></th>
                                    <td><input type="checkbox" name="users_view" id="address" <?php if($users['user_view'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="users_add" id="address" <?php if($users['user_add'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="users_edit" id="address" <?php if($users['user_edit'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td><input type="checkbox" name="users_delete" id="address" <?php if($users['user_delete'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label class="control-label"><?php echo lang('reports');?></label></th>
                                    <td><input type="checkbox" name="report_view" id="address" <?php if($users['reports'] == 1 ) { ?> checked <?php } ?> class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <th scope="row"><label class="control-label">Admin Logs</label></th>
                                    <td><input type="checkbox" name="admin_logs_view" id="admin_logs_view" class="form-control" <?php if($users['admin_logs_view'] == 1 ) { ?> checked <?php } ?>></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>


                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-white" id="cancel_btn" data-url="<?php echo admin_url(); ?>users"><?php echo lang('cancel');?></button>
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
    $("#edit_user_form").validate();
    $('#edit_user_form').submit(function(e) {
    if($("#edit_user_form").valid()){
      e.preventDefault();
      var formData = $('#edit_user_form').serialize();
      var ajaxurl = '<?php echo admin_url().'users/update_user'; ?>';
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
</script>
</body>
</html>