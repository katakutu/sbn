<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			iBBIZ BRI
		</title>
		<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<meta keywords="" />
		<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
		<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
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

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('password management') ?></b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('personalize') ?></a></li>
					<li class="active"><?= $this->lang->line('password management') ?></li>
				</ol>
				<?php if ($message) { ?>
					<div id="message" class="alert alert-<?= $msg_type ?>" role="alert">
						 <span class="glyphicon glyphicon-<?= $msg_icon ?>" aria-hidden="true"></span>
						 <span class="sr-only">Info:</span>
						 <?= $this->lang->line($message)?>. <?php if ($addition) { ?><?= $this->lang->line($addition) ?><?php } ?>
					</div>
				<?php } ?>
				<?php if ($alert) { ?>
					<div id="alert" class="alert alert-<?= $alert_type ?>" role="alert">
						 <span class="fa fa-<?= $alert_icon ?> blink_me" aria-hidden="true"></span>
						 <span class="sr-only">Info:</span>
						 <?= $alert ?>
					</div>
				<?php } ?>
				<?php cetak_flash_msg(); ?>
				<div class="form-wrap" id="form-wrap">
					<?php $attributes = array('name' => 'Personalize', 'id' => 'Personalize', 'class' => 'form', 'target' => 'content');
					echo form_open(base_url().'Personalize.jsp/change_password', $attributes); ?>
					<input type="hidden" id="ACTIVITY_ID" name="ACTIVITY_ID" value="1" />
					<input type="hidden" id="exppass" name="exppass" value="<?php $final = date("Y-m-d h:i:s", strtotime("+1 month")); echo $final;?>" />
					<!-- Old Password -->
					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-OLD_PASSWORD"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('old password') ?>&nbsp;</span>
						<input type="password" class="form-control" placeholder="<?= $this->lang->line('old password') ?>" aria-describedby="addon-OLD_PASSWORD" id="OLD_PASSWORD" name="OLD_PASSWORD" maxlength="70" required />
					</div>
					<div>
						<span id="SPAN_OLD_PASSWORD" style="color:red; font-size:11px"><?=form_error('OLD_PASSWORD',' ',' ')?></span>
					</div>
					<br />

					<!-- New Password -->
					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-NEW_PASSWORD"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('new password') ?>&nbsp;</span>
						<input type="password" class="form-control" placeholder="<?= $this->lang->line('new password') ?>" aria-describedby="addon-NEW_PASSWORD" id="NEW_PASSWORD" name="NEW_PASSWORD" maxlength="70" required />
						<span class="input-group-addon"><span id="ICON_NEW_PASSWORD"></span></span>
					</div>
					<div>
						<span id="SPAN_NEW_PASSWORD" style="color:red; font-size:11px"><?=form_error('NEW_PASSWORD',' ',' ')?></span>
					</div>
					<br />

					<!-- New Password confirm -->
					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-NEW_PASSWORD_CONFIRMATION"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('new password confirmation') ?>&nbsp;</span>
						<input type="password" class="form-control" placeholder="<?= $this->lang->line('new password confirmation') ?>" aria-describedby="addon-NEW_PASSWORD_CONFIRMATION" id="NEW_PASSWORD_CONFIRMATION" name="NEW_PASSWORD_CONFIRMATION" maxlength="70" required />
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
		</div>
	</body>
	<script type="text/javascript">
		(function blink() { 
    		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
		})();

		<?php if ($message) { ?>
			$("#message").fadeTo(2000, 500).slideUp(500, function(){
		       $("#message").slideUp(500);
		    });
	    <?php } ?>
	</script>
</html>