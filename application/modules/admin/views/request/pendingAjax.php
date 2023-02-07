<table class="table table-striped table-bordered dt-responsive nowrap" id="aj-table">
    <thead>
        <tr>
            <th><?php echo lang('user_name');?></th>
            <th><?php echo lang('transaction_no');?></th>
            <th><?php echo lang('deposit_type');?></th>
            <th><?php echo lang('bank_name');?></th>
            <th><?php echo lang('deposit_amount');?></th>
            <th><?php echo lang('submitted_at');?></th>
            <th><?php echo lang('action');?></th>
        </tr>
    </thead>
    <tbody>

        
        <?php $pendingreqests = "";  if (!empty($pendingRequests)) { ?>
        <?php foreach ($pendingRequests as $pR) { (empty($pendingreqests)) ? $pendingreqests = $pR['id'] : $pendingreqests .= ",".$pR['id']; ?>
        <tr>
            <td><?php echo $pR['username']; ?></td>
            <td><?php echo $pR['trans_id']; ?></td>
            <td><?php echo $pR['depositName']; ?></td>
            <td><?php echo $pR['bankName']; ?></td>
            <td><?php echo $pR['deposit_amount']; ?></td>
            <td><?php echo $pR['created_at']; ?></td>
            <td>
                <?php if(get_permission('pending_requests') == 1) { ?>
                
                <a href="<?php echo admin_url(); ?>request/process/<?php echo $pR['id']; ?>">
                    <button class="btn btn-success btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="Processed">
                        <i class="fa fa-flag"></i>
                    </button>
                </a>
                
                <button class="btn btn-danger btn-circle decline_request" type="button" data-toggle="tooltip" data-placement="top" title="Decline" data-id="<?php echo $pR['id']; ?>">
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
            <th><?php echo lang('submitted_at');?></th>
            <th><?php echo lang('action');?></th>
        </tr>
    </tfoot>
</table>

<input type="hidden" id="requests" value="<?php echo $pendingreqests; ?>">

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
