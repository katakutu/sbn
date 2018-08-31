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
	<link rel="stylesheet" href="<?= base_url() ?>css/flag.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery.payment.min.js"></script>
	<link href="<?= base_url() ?>css/main.css" rel="stylesheet">
</head>
<script type="text/javascript">

	jQuery(function($) {

		$('#SIGNER_ID_CARD_EXPIRED').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			startDate: 'd',
			changeMonth: true,
			changeYear: true, 
		});

		$('#ADMIN_ID_CARD_EXPIRED').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			startDate: 'd',
			changeMonth: true,
			changeYear: true
		});
	});

	function type_business(e)
	{
		if (e)
		{
			document.getElementById("TYPE_BUSINESS").innerHTML = e.toUpperCase();
			document.getElementById("HID_TYPE_BUSINESS").value = e.toUpperCase();
		}
		else
		{
			document.getElementById("TYPE_BUSINESS").innerHTML = "BUSINESS";
			document.getElementById("HID_TYPE_BUSINESS").value = "BUSINESS";
		}
	}

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z.toUpperCase();
		}
	}

	function type_id_card(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z;
		}
	}

	$(document).ready(function(){
		$('#CARD_NUMBER').payment('formatCardNumber');
    	$("#CARD_NUMBER").keypress(function(){
	  		var cardType = $.payment.cardType($('#CARD_NUMBER').val());
	  		if (cardType != null)
	  		{
      			$('#CARD_BRAND').html('<img src="<?= base_url() ?>images/card/'+cardType+'.png" />');
      		}
      		else 
  			{	
  				$('#CARD_BRAND').html('');
		    }
		});

		$("#CHECKER_TOTAL").keyup(function(){
			// alert(document.getElementById('CHECKER_TOTAL').value);
			var cTot = Number(document.getElementById('CHECKER_TOTAL').value);
			var sTot = Number(document.getElementById('SIGNER_TOTAL').value);

			if (sTot < 1) {					
				if (cTot > sTot) {
					document.getElementById('register').disabled = true;
				} else {
					document.getElementById('register').disabled = false;
				}
			} else {
				document.getElementById('register').disabled = false;
			}
		});

		$("#SIGNER_TOTAL").keyup(function(){
			// alert(document.getElementById('CHECKER_TOTAL').value);
			var cTot = Number(document.getElementById('CHECKER_TOTAL').value);
			var sTot = Number(document.getElementById('SIGNER_TOTAL').value);

			if (sTot < 1) {					
				if (cTot > sTot) {
					document.getElementById('register').disabled = true;
				} else {
					document.getElementById('register').disabled = false;
				}
			} else {
				document.getElementById('register').disabled = false;
			}
		});
	});

</script>
<style type="text/css">
	.semifooter {
    width: 90%;
    min-height: 60px;
    margin : 0 auto;
    float: right;
    margin-bottom: 5px;
    line-height: 1.4;
	}

	.semifooter-item#new-feature {
    width: 45%;
	}
	.semifooter-item {
    min-height: 60px;
    padding: 5px 15px 5px 5px;
    float: left;
	}
    .semifooter-item h3 {
    margin-top : 11px;
    font-size: 12px;
    font-weight: 700;
    color: #144069;
    border-bottom: solid #144069 2px;
	}

	.semifooter-item p {
    font-size: 11px;
    margin: 10 0 0;
    text-align: left;
    color: gray;
	}

	@media (min-width: 768px) {
		#form_reg {
			width: 50%;
		}
	}

	.has-error input {
      border-width: 2px;
    }

    .validation.text-danger:after {
      content: 'Validation failed';
    }

    .validation.text-success:after {
      content: 'Validation passed';
    }

</style>
<body>
<header id="site-header" class="site-header">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
					<li>
						<a title="Login" target="" href="<?= base_url() ?>">
							<i class="fa fa-sign-in"></i>
							Login
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a title="<?= $this->lang->line('site_bri') ?>" target="_blank" href="http://bri.co.id">
							<i class="fa fa-building"></i>
							<?= $this->lang->line('site_bri') ?>
						</a>
					</li>
					<li>
						<a title="<?= $this->lang->line('faq_n_guide') ?>" target="" href="<?= base_url() ?>Faq.jsp/index">
							<i class="fa fa-question-circle"></i>
							<?= $this->lang->line('faq_n_guide') ?>
						</a>
					</li>
					<!-- <li>
						<a title="<?= $this->lang->line('termcond') ?>" target="" href="<?= base_url() ?>Terms.jsp/index">
							<i class="fa fa-legal"></i>
							<?= $this->lang->line('termcond') ?>
						</a>
					</li> -->
					<li>
						<a title="<?= $this->lang->line('registering') ?>" target="" href="<?= base_url() ?>Form.jsp/index">
							<i class="fa fa-folder"></i>
							<?= $this->lang->line('registering') ?>
						</a>
					</li>
					<li>
						<a title="<?= $this->lang->line('help') ?>" target="" href="<?= base_url() ?>Help.jsp/index">
							<i class="fa fa-info"></i>
							<?= $this->lang->line('help') ?>
						</a>
					</li>
					<li>
						<a title="<?= $this->lang->line('contact_us') ?>" target="" href="<?= base_url() ?>ContactUs.jsp/index">
							<i class="fa fa-phone"></i>
							<?= $this->lang->line('contact_us') ?>
						</a>
					</li>
					<li>
						<div class="dropdown">
						  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="flag-icon flag-icon-<?= $this->lang->line('language_c') ?>"></span> <?= $this->lang->line('language') ?>
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu" style="background-color: black">
							<li><a href="<?= base_url() ?>lang_id.jsp"><span class="flag-icon flag-icon-id"></span> Bahasa</a></li>
							<li><a href="<?= base_url() ?>lang_en.jsp"><span class="flag-icon flag-icon-en"></span> English</a></li>
							<!-- <li><a href="<?= base_url() ?>lang_my.jsp"><span class="flag-icon flag-icon-my"></span> Malay</a></li> -->
						  </ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<main id="site-main" class="site-main">
	<section id="main-container">
		<section class="wrapper">
			<div id="main-content">
				<div id="form_reg" class="container">
					<div class="panel panel-default reg-box">
						<div class="panel-heading">
						  <h3><i class="fa fa-feed"></i>&nbsp;<b><?= $this->lang->line('password management') ?></b></h3>
						</div>

						<div class="panel-body">
							<?php $attributes = array('name' => 'Password', 'id' => 'Password', 'target' => '_top', ); 
							echo form_open(base_url().'ForgotPassword.jsp/open', $attributes); ?>
							<!-- USER -->
							<div class="input-group input-group">
								<span class="input-group-addon" id="addon-EMAIL">
										<?= $this->lang->line('userid') ?>&nbsp;
								</span>
								<input id="USERID" name="USERID" type="text" class="form-control" placeholder="User ID" aria-describedby="addon-USERID" required="required" maxlength="50" />
							</div>
							<div>
								<span id="ERROR_USERID" style="color:red; font-size:11px"><?=form_error('USERID',' ',' ')?></span>
							</div>
							<br />												  

				      	  	<button class="btn btn-theme btn-block" title="Submit" autocomplete="off" type="submit" value="Submit" id="chg_password" name="chg_password">
							<i class="fa fa-arrow-circle-right"></i>
							Submit
					  		</button>
							</form>
						</div>
					</div>
		      	</div>
			</div>
		</section>		
	</section>
</main>
<br />
</body>
<footer class="footer-default">
	<p class="footer-text">Copyright © 2018 Bank Rakyat Indonesia (Persero) Tbk. All rights reserved.</p>
</footer>
</html>