<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QRX | Portal <?php echo lang('login');?></title>

    <link href="<?php echo base_url(); ?>admin-assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>admin-assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin-assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h2 class="logo-name"><img class="img-responsive" src="<?php echo base_url(); ?>admin-assets/img/logo.jpg" alt="" /></h2>

            </div>
            <h3>QRX Admin Portal</h3>
            <!-- <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.</p> -->
            <form class="m-t" role="form" method="post" action="<?php echo $this->config->item('admin_url'); ?>login_verify">
                <div class="form-group">
                    <input type="email" name="admin_email" class="form-control" placeholder="Email" required="" value="<?php echo $this->session->flashdata('admin_email');?>">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <?php if($this->session->flashdata('login_error')) { ?>
                <div class="alert alert-danger">
                  <?php echo $this->session->flashdata('login_error'); ?>
                </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary block full-width m-b"><?php echo lang('login');?></button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>admin-assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>admin-assets/js/bootstrap.min.js"></script>

</body>

</html>
