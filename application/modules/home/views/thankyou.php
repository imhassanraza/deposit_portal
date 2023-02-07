<!DOCTYPE html>
<html lang="en">
<head>

    <?php $this->load->view('common/header'); ?>

</head>
<body>
	
	<div class="deposit-confirmed">
		<div class="container-login100">
			<div class="wrap-login100" style="padding: 35px 15px; width:530px;">
				<div class="col-12 text-center">
					<img src="assets/images/ok.png">
					<h5><?php echo lang('your_operations_approved');?></h5>
					<p><?php echo lang('your_deposit_will_be_transfer_to_your_account');?> </p>
                    <p class="text-center"><a href="<?php echo base_url() ?>"><i class="fa fa-home" style="color:#54419e;"></i>  <?php echo lang('back_to_home_page');?></a></p>
				</div>

			</div>
		</div>
	</div>

    <?php $this->load->view('common/footer'); ?>

</body>
</html>