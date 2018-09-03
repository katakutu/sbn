<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		BRI SBN Ritel Online
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta content="width=device-width, initial-scale=1.0maximum-scale=1, user-scalable=0" name="viewport" />
	<meta keywords="" />
	<meta http-equiv="Refresh" content="3600">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/flag.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
    <!-- Main CSS -->
    <link href="<?= base_url() ?>css/main.css" rel="stylesheet">
</head>

<script type="text/javascript">
	var check = function(){
		if ($("#corpid").val() != "" )
		{
			if ($("#userid").val() != "" )
			{
				if ($("#password").val() != "" )
				{
					if ($("#passcode").val() != "" )
					{
						waitingDialog.show();
						document.getElementById("form-login").submit();
					}
				}
			}
		}
	}
	function mouseoverPass(obj) {
	  var obj = document.getElementById('passcode');
	  obj.type = "text";
	}
	function mouseoutPass(obj) {
	  var obj = document.getElementById('passcode');
	  obj.type = "password";
	}
</script>

<style type="text/css">
	.dropbtn {
        padding-top: 25px;
		padding-bottom: 25px;
    	font-size: 12px;
    	text-transform: uppercase;
    	color: #fff;
    	letter-spacing: 2px;
    	background: none;
    	border: none;
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
					<a class="navbar-brand" href=""><img src="<?= base_url() ?>images/logo.png" alt="BRI SBN Ritel Online"></a>
				</div>
				<div id="header_menu" class="collapse navbar-collapse">
		            <ul class="nav navbar-nav navbar-left">
						<li class="active">
							<a title="Login" target="" href="">
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
							<a title="<?= $this->lang->line('contact_us') ?>" target="" href="<?= base_url() ?>ContactUs.jsp/index">
								<i class="fa fa-phone"></i>
								<?= $this->lang->line('contact_us') ?>
							</a>
						</li>
						<li>
							<div class="dropdown">

							  <button class="dropbtn" type="button" data-toggle="dropdown"><span class="flag-icon flag-icon-<?= $this->lang->line('language_c') ?>"></span> <?= $this->lang->line('language') ?>
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu" style="background-color: black">
								<li><a href="<?= base_url() ?>lang_id.jsp"><span class="flag-icon flag-icon-id"></span> Bahasa</a></li>
								<li><a href="<?= base_url() ?>lang_en.jsp"><span class="flag-icon flag-icon-en"></span> English</a></li>
							  </ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- Main jumbotron for a primary marketing message or call to action -->
    <main id="site-main" class="site-main">
        <section class="section section--login container">
        	<div class="row">
			<!-- 	<div class="col-md-8">
					<?php if ($message) { ?>
						<div class="alert alert-danger col-xs-12 col-sm-6 col-md-8 col-lg-11" role="alert">
						  <span class="fa fa-exclamation-circle" aria-hidden="true"></span>
						  <span class="sr-only">Error:</span>
						  <?= $this->lang->line($message) ?>
						</div>
					<?php } ?>
					<div class="login-img hid-div" style="height:305px;"></div>
					<div class="col-xs-12 col-sm-6 col-md-8 col-lg-11 info-box login-img" style="margin-bottom: 10px;">
		                <div class="col-md-12 info-box--content">
		                    <center><h3>INFORMASI TERKINI</h3></center>
		                    <p style="text-align: justify; text-justify: inter-word;"><?php echo $latestinfo; ?></p>
		                </div>
	              	</div>
	            </div>
 -->
				<div class="col-xs-10 col-xs-offset-1 col-md-offset-7 col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8 col-lg-3 col-lg-offset-8 login-box">
				    <h2><img class="login-img" src="<?= base_url() ?>images/logo.png" alt="IBBIZ BRI"></h2>
				    <?php $attributes = array('name' => 'form-login', 'id' => 'form-login', 'target' => '_top', ); echo form_open(base_url().'Auth.jsp/login', $attributes); ?>
				    	<div class="login-wrap">
							<div class="input-group">
								<input id="corpid" class="form-control trim required" type="hidden" rel="Corporate ID" title="Corporate ID" autocomplete="off" autofocus="autofocus" placeholder="Corporate ID" required="required" value="" name="corpid" maxlength="11">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon style-addon">
									<i class="fa fa-user"></i>
								</span>
								<input id="userid" class="form-control trim required input-oj" type="text" rel="User ID" title="User ID" autocomplete="off" placeholder="Email" required="required" value="" name="userid" maxlength="50">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon style-addon">
									<i class="fa fa-key"></i>
								</span>
								<input id="password" class="form-control trim required input-oj" type="password" rel="Password" title="Password" autocomplete="off" placeholder="Password" required="required" value="" name="password" maxlength="70">
							</div>
							<br>
							<div class="input-group">
								<div class="media">
									<div class="media-left media-middle">
							    		<img id="captcha" class="img-cap" src="<?= base_url() ?>Captcha.img" style="border-radius: 10%;">
									</div>
									<span class="input-group-addon style-addon">
										<i class="fa fa-street-view"></i>
									</span>
									<div class="media-body">
								    	<input id="passcode" class="form-control trim required input-oj" type="password" rel="Passcode" title="Passcode" autocomplete="off" placeholder="Passcode" required="required" value="" name="passcode" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" maxlength="10">
							  		</div>
								</div>
							</div>							
							<div id="forgot_pwd" style="text-align: right;">
								<a href="#" onClick="window.open('<?= base_url() ?>ForgotPassword.jsp/index')"><p><?= $this->lang->line('forgot password?') ?></p></a>
							</div>
							 <?php if ($message) { ?>
							<div class="alert alert-danger" style="padding: 10px; margin-bottom: 0px;">
						  		<span class="fa fa-exclamation-circle" aria-hidden="true"></span>
						  		<span class="sr-only">Error:</span>
						  		<?= $this->lang->line($message) ?>
							</div>
							<?php } ?>	
							<br />
							<button class="btn btn-theme btn-block" onClick="check();" title="<?= $this->lang->line('login') ?>" type="submit" value="Login" name="login">
								<i class="fa fa-lock"></i>
								Login
							</button>																		
							<div id="c-image" class="jumbotron-small">
								<table border="0" style="background-color: transparent;">
									<tr>
										<td><img src="<?= base_url() ?>images/Norton_Secure.png"></td>
							 			<td><font size="1" color="#ffffff"><p>This site choose Verisign SSL for secure e-commerce and confidental comunications</font></p></td>
						 			</tr>
					 			</table>
							</div>
						</div>
					</form>
				</div>
			</div>
        </section>
    </main>

</body>
<footer class="site-footer">
  <p>Copyright &copy; 2018 Bank Rakyat Indonesia (Persero) Tbk.</p>
</footer>
</html>
