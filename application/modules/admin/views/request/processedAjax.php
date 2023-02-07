<table class="table table-striped table-bordered dt-responsive nowrap" id="aj-table">
    <thead>
        <tr>
            <th><?php echo lang('user_name'); ?></th>
            <th><?php echo lang('transaction_no'); ?></th>
            <th><?php echo lang('deposit_type'); ?></th>
            <th><?php echo lang('bank_name'); ?></th>
            <th><?php echo lang('deposit_amount'); ?></th>
            <th><?php echo lang('processing_by');?></th>
            <th><?php echo lang('submitted_at'); ?></th>
            <th><?php echo lang('action'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($pendingRequests)){ ?>

        <?php foreach ($pendingRequests as $pR) { ?>
        <tr>
            <td><?php echo $pR['username']; ?></td>
            <td><?php echo $pR['trans_id']; ?></td>
            <td><?php echo $pR['depositName']; ?></td>
            <td><?php echo $pR['bankName']; ?></td>
            <td><?php echo $pR['deposit_amount']; ?></td>
            <td><?php echo get_admin_name($pR['user_id']); ?></td>
            <td><?php echo $pR['created_at']; ?></td>
            <td>

                <?php if (get_session('admin_id') === $pR['user_id']) { ?>
                <a href="<?php echo admin_url(); ?>request/viewProcess/<?php echo $pR['request_id']; ?>">
                    <button class="btn btn-success btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="View Process">
                        <i class="fa fa-eye"></i>
                    </button>
                </a>

                <button class="btn btn-danger btn-circle decline_request" type="button" data-toggle="tooltip" data-placement="top" title="Decline" data-id="<?php echo $pR['request_id']; ?>">
                    <i class="fa fa-ban"></i>
                </button>

                <?php } ?>

            </td>
        </tr>
        <?php } ?> 

        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th><?php echo lang('user_name');?></th>
            <th><?php echo lang('transaction_no');?></th>
            <th><?php echo lang('deposit_type');?></th>
            <th><?php echo lang('bank_name');?></th>
            <th><?php echo lang('deposit_amount');?></th>
            <th><?php echo lang('processing_by');?></th>
            <th><?php echo lang('submitted_at');?></th>
            <th><?php echo lang('action');?></th>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    $('#aj-table').dataTable({

        "bInfo":false,
        "ordering": false,
        "responsive": true,
        "oLanguage": {
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
</script>