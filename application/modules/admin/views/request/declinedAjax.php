<table class="table table-striped table-bordered dt-responsive nowrap" id="tttt">
    <thead>
        <tr>
            <th><?php echo lang('user_name');?></th>
            <th><?php echo lang('transaction_no');?></th>
            <th><?php echo lang('deposit_type');?></th>
            <th><?php echo lang('bank_name');?></th>
            <th><?php echo lang('deposit_amount');?></th>
            <th><?php echo lang('decline_by');?></th>
            <th><?php echo lang('decline_reason');?></th>
            <th><?php echo lang('submitted_at');?></th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($pendingRequests)){
            foreach ($pendingRequests as $pR) { ?>
                <tr>
                    <td><?php echo $pR['username']; ?></td>
                    <td><?php echo $pR['trans_id']; ?></td>
                    <td><?php echo $pR['depositName']; ?></td>
                    <td><?php echo $pR['bankName']; ?></td>
                    <td><?php echo $pR['deposit_amount']; ?></td>
                    <td><?php echo get_admin_name($pR['user_id']); ?></td>
                    <td><?php echo $pR['decline_reason']; ?></td>
                    <td><?php echo $pR['created_at']; ?></td>

                </tr>
            <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
                <th><?php echo lang('user_name');?></th>
                <th><?php echo lang('transaction_no');?></th>
                <th><?php echo lang('deposit_type');?></th>
                <th><?php echo lang('bank_name');?></th>
                <th><?php echo lang('deposit_amount');?></th>
                <th><?php echo lang('decline_by');?></th>
                <th><?php echo lang('decline_reason');?></th>
                <th><?php echo lang('submitted_at');?></th>
            </tr>
        </tfoot>
    </table>

    <script>
       var table = $('#tttt').DataTable( { lengthChange: false, ordering: false, language: {
                "sSearch": "<?php echo lang('search');?>: ",
                oPaginate: {
                    "sPrevious": "<?php echo lang('previous');?>",
                    "sNext": "<?php echo lang('next');?>"
                }
            },

        buttons: [
        {
            extend: 'excelHtml5',
            title: 'Confirmed Requests'
        },
        {
            extend: 'pdfHtml5',
            title: 'Confirmed Requests'
        }
        ] } ); table.buttons().container() .appendTo( '#tttt_wrapper .col-md-6:eq(0)' );
    </script>