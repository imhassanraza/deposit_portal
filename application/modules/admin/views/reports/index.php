<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2><?php echo lang('reports');?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo admin_url(); ?>">Home</a>
            </li>
            <li class="active">
                <strong><?php echo lang('reports');?></strong>
            </li>
        </ol>
        <div class="hr-line-dashed"></div>
    </div>
    <div class="col-lg-12">
        <form id="reports_form" class="form-horizontal" method="post" action="<?php echo admin_url() ?>reports" enctype="multipart/form-data">
            <div class="col-lg-4 col-sm-offset-3">
                <div class="form-group" id="data_5">
                    <label class="font-normal"><?php echo lang('select_date_range');?></label>
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="form-control-sm form-control" name="start" value="<?php echo date("Y-m-d")?>"/>
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control-sm form-control" name="end" value="<?php echo date("Y-m-d")?>" />
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <div class="col-sm-4">
                        <button class="btn btn-primary" type="submit" style="margin-top: 22px;"><?php echo lang('search'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- employees Table -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo lang('reports');?></h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover" id="aj-table">
                        <thead>
                            <tr>
                                <th><?php echo lang('name');?></th>
                                <th>Email</th>
                                <th><?php echo lang('number_of_confirmation');?></th>
                                <th><?php echo lang('total_confirmed_amount');?></th>
                                <th><?php echo lang('number_of_decline');?></th>
                                <th><?php echo lang('total_declined_amount');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($reports)) {
                                foreach ($reports as $report) {
                                    ?>
                                    <tr>

                                        <td><?php echo $report['user']['username']; ?></td>
                                        <td><?php echo $report['user']['email']; ?></td>
                                        <td><?php echo $report['totalConfirmed']; ?></td>
                                        <td><?php echo $report['totalConfirmedAmount']->confirmDeposit ? $report['totalConfirmedAmount']->confirmDeposit : 0 ; ?></td>
                                        <td><?php echo $report['totalDeclined']; ?></td>
                                        <td><?php echo $report['totalDeclinedAmount']->deposit_amount ? $report['totalDeclinedAmount']->deposit_amount : 0; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo lang('name');?></th>
                                <th>Email</th>
                                <th><?php echo lang('number_of_confirmation');?></th>
                                <th><?php echo lang('total_confirmed_amount');?></th>
                                <th><?php echo lang('number_of_decline');?></th>
                                <th><?php echo lang('total_declined_amount');?></th>
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
    $(document).ready(function () { 

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


    });
</script>
</body>
</html>