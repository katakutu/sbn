<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->parameter_helper->header_app ?>
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta content="width=device-width, initial-scale=1.0maximum-scale=1, user-scalable=0" name="viewport" />
	<meta keywords="" />
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		$("input[type=password]").keyup(function(){
			var ucase = new RegExp("[A-Z]+");
			var lcase = new RegExp("[a-z]+");
			var num = new RegExp("[0-9]+");

			var thru = false;

			if($("#NEW_PASSWORD").val().length >= 8){
				$("#8char").removeClass("fa fa-close");
				$("#8char").addClass("fa fa-check");
				$("#8char").css("color","#00A41E");
			}else{
				$("#8char").removeClass("fa fa-check");
				$("#8char").addClass("fa fa-close");
				$("#8char").css("color","#FF0004");
			}
			
			if(ucase.test($("#NEW_PASSWORD").val())){
				$("#ucase").removeClass("fa fa-close");
				$("#ucase").addClass("fa fa-check");
				$("#ucase").css("color","#00A41E");
			}else{
				$("#ucase").removeClass("fa fa-check");
				$("#ucase").addClass("fa fa-close");
				$("#ucase").css("color","#FF0004");
			}
			
			if(lcase.test($("#NEW_PASSWORD").val())){
				$("#lcase").removeClass("fa fa-close");
				$("#lcase").addClass("fa fa-check");
				$("#lcase").css("color","#00A41E");
			}else{
				$("#lcase").removeClass("fa fa-check");
				$("#lcase").addClass("fa fa-close");
				$("#lcase").css("color","#FF0004");
			}
			
			if(num.test($("#NEW_PASSWORD").val())){
				$("#num").removeClass("fa fa-close");
				$("#num").addClass("fa fa-check");
				$("#num").css("color","#00A41E");
			}else{
				$("#num").removeClass("fa fa-check");
				$("#num").addClass("fa fa-close");
				$("#num").css("color","#FF0004");
			}
			
			if($("#OLD_PASSWORD").val() != $("#NEW_PASSWORD").val()){
				if($("#NEW_PASSWORD").val().length >= 8){
					if(ucase.test($("#NEW_PASSWORD").val())){
						if(lcase.test($("#NEW_PASSWORD").val())){
							if(num.test($("#NEW_PASSWORD").val())){
								thru = true;
							}
						}
					}
				}
			}

			if (thru)
			{
				$("#ICON_NEW_PASSWORD").removeClass("fa fa-close");
				$("#ICON_NEW_PASSWORD").addClass("fa fa-check");
				$("#ICON_NEW_PASSWORD").css("color","#00A41E");

				if($("#NEW_PASSWORD").val() == $("#NEW_PASSWORD_CONFIRMATION").val()){

					$("#ICON_NEW_PASSWORD_CONFIRMATION").removeClass("fa fa-close");
					$("#ICON_NEW_PASSWORD_CONFIRMATION").addClass("fa fa-check");
					$("#ICON_NEW_PASSWORD_CONFIRMATION").css("color","#00A41E");
					document.getElementById("submit").disabled = false;
				}else{
					$("#ICON_NEW_PASSWORD_CONFIRMATION").removeClass("fa fa-check");
					$("#ICON_NEW_PASSWORD_CONFIRMATION").addClass("fa fa-close");
					$("#ICON_NEW_PASSWORD_CONFIRMATION").css("color","#FF0004");
					document.getElementById("submit").disabled = true;
				}
			}
			else
			{
				$("#ICON_NEW_PASSWORD").removeClass("fa fa-check");
				$("#ICON_NEW_PASSWORD").addClass("fa fa-close");
				$("#ICON_NEW_PASSWORD").css("color","#FF0004");
				document.getElementById("submit").disabled = true;
			}
		});
	});

	var waitingDialog = waitingDialog || (function ($) {
		'use strict';

		// Creating modal dialog's DOM
		var $dialog = $(
			'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
			'<div class="modal-dialog modal-m">' +
			'<div class="modal-content">' +
				'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
				'<div class="modal-body">' +
					'<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
				'</div>' +
			'</div></div></div>');

		return {
			/**
			 * Opens our dialog
			 * @param message Custom message
			 * @param options Custom options:
			 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
			 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
			 */
			show: function (message, options) {
				// Assigning defaults
				if (typeof options === 'undefined') {
					options = {};
				}
				if (typeof message === 'undefined') {
					message = 'Loading';
				}
				var settings = $.extend({
					dialogSize: 'm',
					progressType: '',
					onHide: null // This callback runs after the dialog was hidden
				}, options);

				// Configuring dialog
				$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
				$dialog.find('.progress-bar').attr('class', 'progress-bar');
				if (settings.progressType) {
					$dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
				}
				$dialog.find('h3').text(message);
				// Adding callbacks
				if (typeof settings.onHide === 'function') {
					$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
						settings.onHide.call($dialog);
					});
				}
				// Opening dialog
				$dialog.modal();
			},
			/**
			 * Closes dialog
			 */
			hide: function () {
				$dialog.modal('hide');
			}
		};

	})(jQuery);

</script>
<style type="text/css">

	@media (min-width: 768px) {
		#form_reg {
			width: 50%;
		}
	}

</style>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" style="float:right;" aria-controls="navbar" aria-expanded="false" data-target="#header_menu" data-toggle="collapse" type="button">
					<span class="navbar-toggle-label">
				      <font color="#ffffff"><?= $this->lang->line('option') ?></font><span class="sr-only">Toggle Navigation</span>
				    </span>
				    <span class="navbar-toggle-icon">
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				    </span>
				</button>
				<a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url() ?>images/logo.png" alt="IBBIZ BRI"></a>		
			</div>
			<div id="header_menu" class="collapse navbar-collapse">
	            <ul class="nav navbar-nav navbar-left">
					<li class="active">
						<a title="Login" target="" href="<?= base_url() ?>">
							<i class="fa fa-sign-in"></i>
							Login
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<section id="main-container">
		<section class="wrapper">
			<div id="main-content">
				<div id="form_reg" class="container">
					<div class="panel panel-primary">
						<h3 style="text-align: right; padding-right: 25px">
							<i class="fa fa-feed"></i> <b><?= $this->lang->line('password management') ?></b>
						</h3>
						<div class="panel-body">
						<?php if ($message) { ?>
							<div id="message" class="alert alert-<?= $msg_type ?>" role="alert">
								 <span class="glyphicon glyphicon-<?= $msg_icon ?>" aria-hidden="true"></span>
								 <span class="sr-only">Info:</span>
								 <?= $this->lang->line($message) ?>
								 <?php if ($message == 'msg_success') { ?>
								 	<script>
								 		waitingDialog.show();
								 		window.setTimeout(function(){
									        window.location.href = "<?= base_url() ?>/Home.jsp";
									    }, 3000);
								 	</script>
							 	<?php } ?>
							</div>
						<?php } ?>
						  <div class="form-wrap" id="form-wrap">
						  <?php $attributes = array('name' => 'First_Login', 'id' => 'First_Login', 'target' => '_top', ); echo form_open(base_url().'Personalize.jsp/change_password', $attributes); ?>
						  	<input type="hidden" id="ACTIVITY_ID" name="ACTIVITY_ID" value="0" />
							<blockquote class="blockquote">
						  		<p class="mb-0"><?= $this->lang->line('msg_first_login') ?></p>
						  		<footer class="blockquote-footer">Administrator</footer>
					  		</blockquote>
						  	<!-- Old Password -->
							<div class="input-group input-group">
								<span class="input-group-addon" id="addon-OLD_PASSWORD"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('old password') ?>&nbsp;</span>
								<input type="password" class="form-control" placeholder="<?= $this->lang->line('old password') ?>" aria-describedby="addon-OLD_PASSWORD" id="OLD_PASSWORD" name="OLD_PASSWORD" required />
							</div>
							<div>
								<span id="SPAN_OLD_PASSWORD" style="color:red; font-size:11px"><?=form_error('OLD_PASSWORD',' ',' ')?></span>
							</div>
							<br />

							<!-- New Password -->
							<div class="input-group input-group">
								<span class="input-group-addon" id="addon-NEW_PASSWORD"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('new password') ?>&nbsp;</span>
								<input type="password" class="form-control" placeholder="<?= $this->lang->line('new password') ?>" aria-describedby="addon-NEW_PASSWORD" id="NEW_PASSWORD" name="NEW_PASSWORD" required />
								<span class="input-group-addon"><span id="ICON_NEW_PASSWORD"></span></span>
							</div>
							<div>
								<span id="SPAN_NEW_PASSWORD" style="color:red; font-size:11px"><?=form_error('NEW_PASSWORD',' ',' ')?></span>
							</div>
							<br />

							<!-- New Password confirm -->
							<div class="input-group input-group">
								<span class="input-group-addon" id="addon-NEW_PASSWORD_CONFIRMATION"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('new password confirmation') ?>&nbsp;</span>
								<input type="password" class="form-control" placeholder="<?= $this->lang->line('new password confirmation') ?>" aria-describedby="addon-NEW_PASSWORD_CONFIRMATION" id="NEW_PASSWORD_CONFIRMATION" name="NEW_PASSWORD_CONFIRMATION" required />
								<span class="input-group-addon"><span id="ICON_NEW_PASSWORD_CONFIRMATION"></span></span>
							</div>
							<div>
								<span id="SPAN_NEW_PASSWORD_CONFIRMATION" style="color:red; font-size:11px"><?=form_error('NEW_PASSWORD_CONFIRMATION',' ',' ')?></span>
							</div>
							<br />
						  	
				      	  <button class="btn btn-theme btn-block" title="Submit" autocomplete="off" type="submit" value="Submit" name="submit" id="submit" disabled="disabled">
							<i class="fa fa-arrow-circle-right"></i>
							Submit
						  </button>

						  	<h5><?= $this->lang->line('termcond') ?>:</h5>
					  		<span id="8char" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_8char') ?>
							<span id="ucase" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_ucase') ?>
							<span id="lcase" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_lcase') ?>
							<span id="num" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_num') ?>
						  </form>
						  </div>
				      	</div>
				      	<div class="panel-footer"></div>
					</div>
				</div>
			</div>
		</section>	
	</section>
</body>
<footer class="footer-default">
	<p class="footer-text">Copyright © 2018 Bank Rakyat Indonesia (Persero) Tbk. All rights reserved.</p>
</footer>
</html>