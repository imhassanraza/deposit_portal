<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo lang('user');?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li class="active">
                <strong><?php echo lang('user');?></strong>
            </li>
        </ol>
    </div>
    <?php if(get_permission('user_add') == 1) { ?>
        <div class="col-lg-2">
            <a href="<?php echo admin_url(); ?>users/addUser" class="btn mt30 btn-primary "><?php echo lang('add_new_user');?></a>
        </div>
    <?php } ?>
</div>
<!-- employees Table -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo lang('user');?></h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover" id="aj-table">
                        <thead>
                            <tr>
                                <th><?php echo lang('name');?></th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th><?php echo lang('last_login_ip');?></th>
                                <th><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($users)){
                                foreach ($users as $user) { ?>
                                    <tr>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['phone']; ?></td>
                                        <td><?php echo $user['login_ip']; ?></td>
                                        <td>
                                            <!-- <a href="<?php// echo admin_url(); ?>admin/userDetail/<?php// echo $user['userid']; ?>"><button class="btn btn-success btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></button></a> -->
                                            <?php if(get_permission('user_edit') == 1) { ?>
                                                <a href="<?php echo admin_url(); ?>users/editUser/<?php echo $user['userid']; ?>"><button class="btn btn-warning btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-paint-brush"></i></button></a>
                                            <?php } ?>

                                            <?php if(get_permission('user_delete') == 1) { ?>
                                                <button class="btn btn-danger btn-circle delete-btn" data-id="<?php echo $user['userid']; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo lang('name');?></th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th><?php echo lang('last_login_ip');?></th>
                                    <th><?php echo lang('action');?></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Theme Cat End -->
    <?php $this->load->view('common/admin_footer'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            /* Init DataTables */


            $('#aj-table').dataTable({
                "bInfo":false,
                "ordering": false,
                "responsive": true,
                "language": {
                "sSearch": "<?php echo lang('search');?>: ",
                "oPaginate": {
                    "sPrevious": "<?php echo lang('previous');?>",
                    "sNext": "<?php echo lang('next');?>"
                }
            },
                "columnDefs": [
                { "responsivePriority": 1, "targets": 0 },
                { "responsivePriority": 2, "targets": -1 }
                ]
            });


    // $('.delete-btn').click(function(){
        $(document).on("click",".delete-btn",function() {
            var current = $(this);
            var id = current.data('id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                ajaxurl = '<?php echo admin_url(); ?>users/deleteUser';
                $.ajax({
                  url: ajaxurl,
                  type : 'post',
                  data: {id: id},
                  dataType: "json",
                  success: function(data ) {
                    if (data.msg == 'success') {
                        current.parents('tr').remove();
                        swal("Done!", "It was succesfully deleted!", "success");
                    }else {
                        swal("Error!", data.response, "error");
                    }
                },
            });
            });
        });

    });
</script>
</body>
</html>