<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QRX Admin Protal</title>

    <link href="<?php echo base_url(); ?>admin-assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo base_url(); ?>admin-assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url(); ?>admin-assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<!-- datatable -->
    <link href="<?php echo base_url(); ?>admin-assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>admin-assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet"> 

    
    <link href="<?php echo base_url(); ?>admin-assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>admin-assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/css/daterangepicker-bs3.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
    <?php $this->load->view('common/admin_sidebar'); ?> 
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
<!--             <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form> -->
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"><?php echo lang('welcome')?></span>
                </li>
                <li>
                    <?php if($this->session->userdata('site_lang') == 'english'){ ?>
                    <a href="<?php echo base_url('languageswitcher/switchlang/turkish') ?>">
                        <i class="fa fa-language "></i>Turkish
                    </a>
                    <?php }else{ ?>
                    <a href="<?php echo base_url('languageswitcher/switchlang/english') ?>">
                        <i class="fa fa-language "></i>English
                    </a>
                    <?php } ?>
                </li>
                <li>
                    <a href="<?php echo admin_url(); ?>logout">
                        <i class="fa fa-sign-out"></i> <?php echo lang('logout'); ?>
                    </a>
                </li>
            </ul>
        </nav>
    </div>