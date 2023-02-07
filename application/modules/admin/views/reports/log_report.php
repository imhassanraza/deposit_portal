<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Admin Logs <?php echo lang('reports');?></h2>
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
                                <th><?php echo lang('login');?></th>
                                <th><?php echo lang('logout');?></th>
                                <th><?php echo lang('last_login_ip');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($login_log)) {
                                foreach ($login_log as $log) {
                                    ?>
                                    <tr>

                                        <td><?php echo $log['username']; ?></td>
                                        <td><?php echo $log['login_time']; ?></td>
                                        <td>
                                            <?php if ($log['logout_time'] != '0000-00-00 00:00:00') {
                                                echo $log['logout_time'];
                                            } else { 
                                                echo "-"; 
                                            } ?>

                                        </td>
                                        <td><?php echo $log['ip']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('login');?></th>
                                <th><?php echo lang('logout');?></th>
                                <th><?php echo lang('last_login_ip');?></th>
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