<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2> <?php echo lang('request_declined');?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo admin_url(); ?>">Home</a>
			</li>
			<li class="active">
				<strong><?php echo lang('request_declined');?></strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">
		<a href="<?php echo admin_url(); ?>request/pendingRequests" class="btn mt30 btn-primary "><?php echo lang('back_to_pending_request');?></a>
	</div>
</div>

<!-- Theme Categories Table -->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?php echo lang('request_declined');?></h5>
				</div>
				<div class="ibox-content">
					<h2><?php echo lang('request_declined_by_client');?></h2>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Theme Cat End -->
<?php $this->load->view('common/admin_footer'); ?>
</body>
</html>