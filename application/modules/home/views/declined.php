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
					<img src="<?php echo base_url() ?>assets/images/declined.png">
					<h5><?php echo lang('request_decline_by_admin');?></h5>
					<p><?php echo lang('you_cannot_proceed');?></p>
					<h5><?php echo lang('decline_reason');?> </h5>
					<p><?php echo $reqInfo['decline_reason']; ?></p>
					<p class="text-center"><a href="<?php echo base_url() ?>"><i class="fa fa-home" style="color:#54419e;"></i>  <?php echo lang('back_to_home_page');?></a></p>
				</div>

			</div>
		</div>
	</div>

	<?php $this->load->view('common/footer'); ?>

</body>
</html>