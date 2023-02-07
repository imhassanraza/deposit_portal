<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo lang('banks');?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li class="active">
                <strong><?php echo lang('banks');?></strong>
            </li>
        </ol>
    </div>
    <?php if(get_permission('bank_add') == 1) { ?>
        <div class="col-lg-2">
            <a href="<?php echo admin_url(); ?>bank/add" class="btn mt30 btn-primary "><?php echo lang('add_new_bank');?></a>
        </div>
    <?php } ?>
</div>
<!-- Sales Table -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Banks</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover" id="aj-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('deposit_type');?></th>
                                <th>SMS 1</th>
                                <th>SMS 2</th>
                                <th><?php echo lang('status');?></th>
                                <th><?php echo lang('note');?></th>
                                <th><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($banks)){
                                foreach ($banks as $bank) { ?>
                                    <?php if(!empty($_GET['status'])) {

                                        if($_GET['status'] == 'active') 
                                        {
                                            if($bank['status'] == 0)
                                                continue;
                                        }


                                    } ?>
                                    <tr id="bank_row_<?php echo $bank['id']; ?>">
                                        <td><?php echo $bank['id']; ?></td>
                                        <td><?php echo $bank['name']; ?></td>
                                        <td><?php echo $bank['depositName']; ?></td>
                                        <td><?php if ($bank['sms1'] == 1) { echo 'Enabled'; }else { echo 'Disabled'; } ?></td>
                                        <td><?php if ($bank['sms2'] == 1) { echo 'Enabled'; }else { echo 'Disabled'; } ?></td>
                                        <td>
                                            <?php if($bank['status'] == 1 ) { ?>
                                              <span class="label label-info pull-right">Active</span>
                                          <?php } else { ?>
                                            <span class="label label-danger pull-right">De-Ative</span>
                                        <?php } ?>

                                    </td>
                                    <td><?php echo wordwrap($bank['note'], 60, "<br>", TRUE); ?></td>
                                    <td>
                                        <?php if(get_permission('bank_view') == 1) { ?>
                                            <button class="btn btn-info btn-circle view-bank" data-id="<?php echo $bank['id']; ?>" type="button" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></button>
                                        <?php } ?>
                                        <?php if(get_permission('bank_edit') == 1) { ?>
                                            <a href="<?php echo admin_url(); ?>bank/edit/<?php echo $bank['id']; ?>"><button class="btn btn-warning btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-paint-brush"></i></button></a>
                                        <?php } ?>
                                        <?php if(get_permission('bank_delete') == 1) { ?>
                                            <button class="btn btn-danger btn-circle delete-btn" data-id="<?php echo $bank['id']; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('deposit_type');?></th>
                                <th>SMS 1</th>
                                <th>SMS 2</th>
                                <th><?php echo lang('status');?></th>
                                <th><?php echo lang('note');?></th>
                                <th><?php echo lang('action');?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- view modal -->
    <div class="modal inmodal" id="view-modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceIn">
                <div class="modal-body">

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
            responsive: true, 
            language: {
                "sSearch": "<?php echo lang('search');?>: ",
                oPaginate: {
                    "sPrevious": "<?php echo lang('previous');?>",
                    "sNext": "<?php echo lang('next');?>"
                }
            },          
        });


        $('[data-toggle-second="tooltip"]').tooltip();
        $(document).on("click",".delete-btn",function() {
    //$('.delete-btn').click(function(){
        var current = $(this);
        var id = current.data('id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
        }, function () {
            ajaxurl = '<?php echo admin_url(); ?>bank/delete';
            $.ajax({
              url: ajaxurl,
              type : 'post',
              data: {id: id},
              dataType: "json",
              success: function(data ) {
                if (data.msg == 'success') {
                    $('#bank_row_'+id).remove();
                    swal("Done!", "It was succesfully deleted!", "success");
                }else {
                    swal("Error!", data.response, "error");
                }
            },
        });
        });
    });

        $('.dropdown-menu').on('click', '.status', function(e){
            e.preventDefault();
            var status = $(this).data('val');
            var currentStatus = $(this);
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "You want to update status of order! Please write a comment why you are updating the status of order.",
                type: "input",
                inputPlaceholder: "Write comment...",
                showCancelButton: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: "Yes, update it!",
                closeOnConfirm: false
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                ajaxurl = '<?php echo admin_url(); ?>orders/update_status'; 
                $.ajax({
                  url: ajaxurl,
                  type : 'post',
                  data: {id: id, status: status, comment: inputValue},
                  dataType: "json",
                  success: function(data ) {
                    if (data.msg == 'success') {
                        currentStatus.parents('ul').children('li').children('.st-btn').removeClass('font-bolds');
                        currentStatus.parents('ul').children('li').children('.st-btn').addClass('status');
                        currentStatus.addClass('font-bolds');
                        currentStatus.removeClass('status');
                        swal("Done!", "It was succesfully updated!", "success");
                    }else {
                        swal("Error!", data.response, "error");
                    }
                },
            });
            }); 
        });
        $(document).on("click",".view-bank",function() {
    //$('.view-order').click(function(){
        var id = $(this).data('id');
        ajaxurl = '<?php echo admin_url(); ?>bank/view_bank';
        $.ajax({
          url: ajaxurl,
          type : 'post',
          data: {id: id},
          dataType: "json",
          success: function(data ) {
            $('#view-modal .modal-body').html(data.response);
            $('#view-modal').modal('show');
        },
    });
    });
    });
</script>
</body>
</html>