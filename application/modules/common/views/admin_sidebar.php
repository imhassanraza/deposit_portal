<?php 

$r_class = $this->router->fetch_class();

$r_method = $this->router->fetch_method();

?>

<nav class="navbar-default navbar-static-side" role="navigation">

    <div class="sidebar-collapse">

        <ul class="nav" id="side-menu">

            <li class="nav-header">

                <?php $permissions =  $this->session->userdata('permissions'); ?>

                <div class="dropdown profile-element"> <span>

                        <img alt="image" width="48" class="img-circle" src="<?php echo base_url(); ?>admin-assets/img/logo.jpg" />

                         </span>

                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('admin_username'); ?></strong>

                         </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>

                    <ul class="dropdown-menu animated fadeInRight m-t-xs">

                        <!-- <li><a href="profile.html">Profile</a></li> -->

                        <li><a href="<?php echo admin_url(); ?>profile/password"><?php echo lang('change_password'); ?></a></li>

                        <!-- <li><a href="contacts.html">Contacts</a></li>

                        <li><a href="mailbox.html">Mailbox</a></li> -->

                        <!-- <li class="divider"></li> -->

                        <li><a href="login.html"> <?php echo lang('logout'); ?></a></li>

                    </ul>

                </div>

                <div class="logo-element">

                     <img alt="image" width="48" class="img-circle" src="<?php echo base_url(); ?>admin-assets/img/logo.png" />

                </div>

            </li>

            <li class="<?php if ($r_class == 'admin' && $r_method == 'dashboard') { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>dashboard"><i class="fa fa-th-large"></i> <span class="nav-label"><?php echo lang('dashboard'); ?></span></a>

            </li>



            <?php if (get_session('user_type') ||  $permissions->pending_requests){ ?>

            <li class="<?php if ($r_class == 'request' && $r_method == 'pendingRequests' || $r_method == 'searchRequest' && @$type == "Pending" ) { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>request/pendingRequests"><i class="fa fa-diamond"></i> <span class="nav-label"><?php echo lang('pending_request'); ?></span></a>

            </li>

            <?php }?>



            <?php if (get_session('user_type') ||  $permissions->processed_requests){ ?>

            <li class="<?php if ($r_class == 'request' && $r_method == 'processedRequests' || $r_method == 'searchRequest' && @$type == "Proccess") { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>request/processedRequests"><i class="fa fa-flag"></i> <span class="nav-label"><?php echo lang('processed_request'); ?></span></a>

            </li>

            <?php }?>



            <?php if (get_session('user_type') ||  $permissions->completed_requests){ ?>

            <li class="<?php if ($r_class == 'request' && $r_method == 'confirmedRequests' || $r_method == 'searchRequest' && @$type == "Confirmed" ) { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>request/confirmedRequests"><i class="fa fa-check-circle"></i><span class="nav-label"><?php echo lang('confirmed_request'); ?></span> </a>

            </li>

            <?php }?>



            <?php if (get_session('user_type') ||  $permissions->declined_requests){ ?>

            <li class="<?php if ($r_class == 'request' && $r_method == 'declinedRequests' || $r_method == 'searchRequest' && @$type == "Declined") { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>request/declinedRequests"><i class="fa fa-ban"></i> <span class="nav-label"><?php echo lang('declined_request'); ?></span> </a>

            </li>

            <?php }?>
            
            <?php if (get_session('user_type') ||  $permissions->deposit_view){ ?>

            <li class="<?php if ($r_class == 'bank' && $r_method == 'depositOptions' || $r_method == 'addDeposit' || $r_method == 'editDeposit') { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>bank/depositOptions"><i class="fa fa-money"></i> <span class="nav-label"><?php echo lang('deposit_option');?></span> </a>

            </li>

            <?php }?>
            <?php if (get_session('user_type') ||  $permissions->bank_view){ ?>
            <li class="<?php if ($r_class == 'bank' && $r_method == 'index' || $r_method == 'add' || $r_method == 'edit') { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>bank"><i class="fa fa-bank"></i> <span class="nav-label"><?php echo lang('banks');?></span> </a>

            </li>
            <?php }?>
            <?php if (get_session('user_type') ||  $permissions->user_view){ ?>
            <li class="<?php if ($r_class == 'users' && $r_method == 'index' || $r_method == 'addUser' || $r_method == 'editUser') { ?> active <?php } ?>">

                <a href="<?php echo admin_url(); ?>users"><i class=" fa fa-users"></i> <span class="nav-label"><?php echo lang('user');?></span> </a>

            </li>
            <?php }?>
            <?php if (get_session('user_type') ||  $permissions->reports){ ?>
                <li class="<?php if ($r_class == 'reports' && $r_method == 'index') { ?> active <?php } ?>">

                    <a href="<?php echo admin_url(); ?>reports"><i class=" fa fa-bar-chart"></i> <span class="nav-label"><?php echo lang('reports');?></span> </a>
                </li>
            <?php }?>

            <?php if (get_session('user_type') ||  $permissions->admin_logs_view){ ?>
                <li class="<?php if ($r_class == 'reports' && $r_method == 'logsReport') { ?> active <?php } ?>">

                    <a href="<?php echo admin_url(); ?>reports/logsReport"><i class=" fa fa-history"></i> <span class="nav-label">Admin Logs</span> </a>
                </li>
            <?php }?>
        </ul>
    </div>

</nav>