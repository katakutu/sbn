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
	<script type="text/javascript" src="<?= base_url() ?>js/home.js"></script>
	<link href="<?= base_url() ?>css/main.css" rel="stylesheet">
</head>
<script type="text/javascript">
	jQuery(function($) {
		$('#ADMIN_ID_CARD_EXPIRED').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			startDate: 'd',
			changeMonth: true,
			changeYear: true,
		});

		$('#ADMIN_TGLLHR').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			orientation : "bottom",
			endDate: 'd',
		});
	});

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z.toUpperCase();
		}
	}

	var briIbbiz=new Object();
	briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};
	briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};
	briIbbiz.isAlphaNum=function(e){return e.match("^[A-Za-z0-9]+$");};
	briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- ,.()]+$");};
	briIbbiz.isAddress=function(e){return e.match("^[A-Za-z0-9- /.()]+$");};

	function type_id_card(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z;
		}

		if(r == "KTP")
		{
			document.getElementById("ADMIN_ID_CARD").setAttribute("minlength", "16");
		}
		else
		{
			document.getElementById("ADMIN_ID_CARD").setAttribute("minlength", "6");
		}
	}

	function checkPassword() {
	    var pass1 = document.getElementById("ADMIN_PASSWORD").value;
	    var pass2 = document.getElementById("ADMIN_CONFIRM_PASSWORD").value;
	    var ok = true;
	    if (pass1 != pass2) {
	        document.getElementById("ADMIN_CONFIRM_PASSWORD").style.borderColor = "#E34234";
	    }
	    else{
	    	 document.getElementById("ADMIN_CONFIRM_PASSWORD").style.borderColor = "#171616";
	    }    	
	}

	$(document).ready(function(){
		function validatetab3() {
			var err = false;
    		if($('#ADMIN_NAME').val()=='') {
    			$('#ERROR_ADMIN_NAME').html('<b id="adnameerror"><?= $this->lang->line("required field") ?></b>');
    			err = true;
    		}
    		else {
    			$('#adnameerror').hide();
    		}
    		if($('#ADMIN_TGLLHR').val()=='') {
    			$('#ERROR_ADMIN_TGLLHR').html('<b id="adtgllhrerror"><?= $this->lang->line("required field") ?></b>');
    			err = true;
    		}
    		else {
    			$('#adtgllhrerror').hide();
    		}
    		if($('#ADMIN_ID_CARD').val()=='') {
    			$('#ERROR_ADMIN_ID_CARD').html('<b id="adidcarderror"><?= $this->lang->line("required field") ?></b>');
    			err = true;			
    		}
    		else {
    			$('#adidcarderror').hide();
    		}
    		// if($('#statusktp').val()=='') {
    		// 	$('#ERROR_ADMIN_ID_CARD_EXPIRED').html('<b id="adidcardexperror"><?= $this->lang->line("required field") ?></b>');
    		// 	err = true;			
    		// }else{
    		// 	$('#adidcardexperror').hide();
    		// }
    		if($('#ADMIN_NPWP').val()=='') {
    			$('#ERROR_ADMIN_NPWP').html('<b id="adnpwperror"><?= $this->lang->line("required field") ?></b>');
    			err = true;			
    		}
    		else {
    			$('#adnpwperror').hide();
    		}
    		if($('#ADMIN_ADDRESS').val()=='') {
    			$('#ERROR_ADMIN_ADDRESS').html('<b id="adaddrerror"><?= $this->lang->line("required field") ?></b>');
    			err = true;			
    		}
    		else {
    			$('#adaddrerror').hide();
    		}
    		if($('#ADMIN_HANDPHONE').val()=='') {
    			$('#ERROR_ADMIN_HANDPHONE').html('<b id="adphoneerror"><?= $this->lang->line("required field") ?></b>');
    			err = true;			
    		}
    		else {
    			$('#adphoneerror').hide();
    		}
    		if($('#ADMIN_EMAIL').val()=='') {
    			$('#ERROR_ADMIN_EMAIL').html('<b id="ademailerror"><?= $this->lang->line("required field") ?></b>');
    			err = true;			
    		}
    		else {
    			$('#ademailerror').hide();
    		}
    		
    		var mayl = $('#ADMIN_EMAIL').val();
    		if($('#ADMIN_EMAIL').val() != '') {
    			var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

				if(!pattern.test(mayl))
				{
    				$('#ERROR_ADMIN_EMAIL').html('<b id="ademailvaliderror"><?= $this->lang->line("email invalid") ?></b>');
    				err = true;				
    			}
    			else {
	    			$('#ademailvaliderror').hide();
	    		}
    		}
    		else {
    			$('#ademailvaliderror').hide();
    		}
    		if($('#ADMIN_PASSWORD').val()=='') {
    			$('#ERROR_ADMIN_PASSWORD').html('<b id="adpasserror"><?= $this->lang->line("required field") ?></b>');
    			err = true;			
    		}
    		else {
    			$('#adpasserror').hide();
    		}
    		if($('#ADMIN_CONFIRM_PASSWORD').val()=='') {
    			$('#ERROR_ADMIN_PASSWORD_CONFIRM').html('<b id="adpassconferror"><?= $this->lang->line("required field") ?></b>');
    			err = true;			
    		}
    		else {
    			$('#adpassconferror').hide();
    		}

    		return err;
		}

		function validatePassword(){
			var pass1 = document.getElementById("ADMIN_PASSWORD").value;
		    var pass2 = document.getElementById("ADMIN_CONFIRM_PASSWORD").value;
		    var err= true;
		    if (pass1 == pass2) {
		        err = false;
		    } else {
		    	$('#ERROR_ADMIN_PASSWORD_CONFIRM').html('<b id="adpassconferror">Password is not match!</b>');
		    	document.getElementById("ADMIN_CONFIRM_PASSWORD").style.borderColor = "#E34234";
		    }
		    return err;
		}

    	$('#register').click(function (e) {
			var err3 = validatetab3();
			var errpwd = validatePassword();

			if(!err3 && !errpwd){
    			//$('#Registration').submit();
    		}
    		else {
    			e.preventDefault()
    		};
    	});

		$('#Registration').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
		    e.preventDefault();
		    return false;
		  }
		});
	});

	$(document).ready(function()
		{
			var base_url = "<?= base_url() ?>";
			$("#ADMIN_ACC").change(function()
			{
				var accountno = $("#ADMIN_ACC").val();

				doInquiryAccount("Registration", base_url, accountno);
			});	
		});

	function statusKTP(elem)
	{
		if(elem.value == '2')
      		document.getElementById('ADMIN_ID_CARD_EXPIRED').style.display = "block";
      	else
      		document.getElementById('ADMIN_ID_CARD_EXPIRED').style.display = "none";
	}

</script>

<style type="text/css">
	.semifooter {width: 90%; min-height: 60px; margin : 0 auto; float: right; margin-bottom: 5px; line-height: 1.4;}
	.semifooter-item#new-feature {width: 45%;}
	.semifooter-item {min-height: 60px; padding: 5px 15px 5px 5px; float: left;}
    .semifooter-item h3 {margin-top : 11px; font-size: 12px; font-weight: 700; color: #144069; border-bottom: solid #144069 2px;}
	.semifooter-item p {font-size: 11px; margin: 10 0 0; text-align: left; color: gray; }
	.has-error input {border-width: 2px;}
    .validation.text-danger:after {content: 'Validation failed';}
    .validation.text-success:after {content: 'Validation passed';}
	@media (min-width: 768px) {
		#form_reg {width: 60%;}
	}
	.dropbtn {padding-top: 25px; padding-bottom: 25px; font-size: 12px; text-transform: uppercase; color: #fff; letter-spacing: 2px; background: none; border: none;}
	#addon-ADMIN_TGLLHR,#addon-ADMIN_ACC,#addon-ADMIN_TEMPATLAHIR,#addon-ADMIN_ID_CARD,#addon-ADMIN_ID_CARD_EXPIRED,
	#addon-ADMIN_NPWP,#addon-ADMIN_TYPEWORK,#addon-ADMIN_ADDRESS,#addon-ADMIN_PROVINCE,#addon-ADMIN_CITY,#addon-ADMIN_COUNTRY,
	#addon-ADMIN_TELEPHONE,#addon-ADMIN_HANDPHONE,#addon-ADMIN_EMAIL,#addon-ADMIN_PASSWORD,#addon-ADMIN_CONFIRM_PASSWORD{
		min-width: 200px;
	}
	
	.dropdown-toggle{
		min-width: 200px;
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
					<li class="active">
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

<main id="site-main" class="site-main">
	<section id="main-container">
		<section class="wrapper">
			<div id="main-content">
				<div id="form_reg" class="container">
					<div class="panel panel-default reg-box">
						<div class="panel-heading">
							<h3><i class="fa fa-folder"></i>&nbsp;<b><?= $this->lang->line('registers') ?></b></h3>
						</div>
						<div class="panel-body" style="padding: 20px; margin-bottom: 5%">
							<div class="form-wrap" id="form-wrap">
								<div id="message-error" class="alert alert-danger" role="alert" style="display: none">
									<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
									<span class="sr-only">Info:</span>
									<span id="pesanerror"></span>	
								</div>

								<?php $attributes = array('name' => 'Registration', 'id' => 'Registration', 'target' => '_top', ); echo form_open(base_url().'Form.jsp/open', $attributes); ?>

								<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />					
						  
								<div class="tab-content">
									<!-- ADMIN ACC -->
									<div class="input-group input-group">
								  		<span class="input-group-addon" id="addon-ADMIN_ACC">
											&nbsp;<?= $this->lang->line('account_no') ?>&nbsp;
										</span>
										<input id="ADMIN_ACC" name="ADMIN_ACC" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('account_no') ?>" aria-describedby="addon-ADMIN_ACC" required value="<?php echo (!empty($post) ? $post['adminacc'] : ""); ?>"  />
									</div>
									<div>
										<span id="ERROR_ADMIN_ACC" style="color:red; font-size:11px"><?=form_error('ADMIN_ACC',' ',' ')?></span>
									</div>
									<br />

							      	<!-- ADMIN TITLE & NAME -->
								  	<?php $admin_title_post = (!empty($post) ? $post['admintitle'] : "MR"); ?>
							      	<input id="HID_TYPE_ADMIN_TITLE" name="HID_TYPE_ADMIN_TITLE" type="hidden" value="<?php echo $admin_title_post; ?>" />
								  	<div class="input-group input-group">
										<div class="input-group-btn">
									        <button id="TYPE_ADMIN_TITLE" name="TYPE_ADMIN_TITLE" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: rgb(238, 238, 238); border-radius: 3px; color: #555;"><?= $this->lang->line(strtolower($admin_title_post)) ?>&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-angle-down"></i></button>
									        <ul class="dropdown-menu">
									          <li><a href="#" onClick="javascript:type_title('TYPE_ADMIN_TITLE', '<?= $this->lang->line('male') ?>', 'mr')"><?= $this->lang->line('male') ?></a></li>
									          <li><a href="#" onClick="javascript:type_title('TYPE_ADMIN_TITLE', '<?= $this->lang->line('female') ?>', 'mrs')"><?= $this->lang->line('female') ?></a></li>
									          <!-- <li><a href="#" onClick="javascript:type_title('TYPE_ADMIN_TITLE', '<?= $this->lang->line('ms') ?>', 'ms')"><?= $this->lang->line('ms') ?></a></li> -->
									        </ul>
						      			</div>
										<input id="ADMIN_NAME" name="ADMIN_NAME" type="text" class="form-control txtonly" placeholder="<?= $this->lang->line('full name') ?>" aria-describedby="addon-ADMIN_NAME" required maxlength="100" value="<?php echo (!empty($post) ? $post['adminname'] : ""); ?>" readonly/>
								  	</div>
									<div>
										<span id="ERROR_ADMIN_NAME" style="color:red; font-size:11px"><?=form_error('ADMIN_NAME',' ',' ')?></span>
									</div>
								  	<br />
								  	<!-- END ADMIN TITLE & NAME -->

								  	<!-- ADMIN BIRTH PLACE -->
								  	<div class="input-group input-group">
								  		<span class="input-group-addon" id="addon-ADMIN_TEMPATLAHIR">
											&nbsp;<?= $this->lang->line('place of birth') ?>&nbsp;
										</span>
										<input id="ADMIN_TEMPATLAHIR" name="ADMIN_TEMPATLAHIR" type="text" class="form-control" placeholder="<?= $this->lang->line('place of birth') ?>" aria-describedby="addon-ADMIN_TEMPATLAHIR" required value="<?php echo (!empty($post) ? $post['admintempatlahir'] : ""); ?>" maxlength="15" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_TEMPATLAHIR" style="color:red; font-size:11px"><?=form_error('ADMIN_TEMPATLAHIR',' ',' ')?></span>
								  	</div>
								  	<br />
								  	<!-- END ADMIN BIRTH PLACE -->
								 
								  	<!-- ADMIN BIRTH DATE -->
								  	<div class="input-group input-group">
								  		<span class="input-group-addon" id="addon-ADMIN_TGLLHR">
											&nbsp;<?= $this->lang->line('date of birth') ?>&nbsp;
										</span>
										<input id="ADMIN_TGLLHR" name="ADMIN_TGLLHR" type="text" class="form-control" placeholder="<?= $this->lang->line('tgl lahir') ?>" aria-describedby="addon-ADMIN_TGLLHR" required value="<?php echo (!empty($post) ? $post['admintgllhr'] : ""); ?>" maxlength="10" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_TGLLHR" style="color:red; font-size:11px"><?=form_error('ADMIN_TGLLHR',' ',' ')?></span>
								  	</div>
								  	<br />
								  	<!-- END ADMIN BIRTH DATE -->
									
									<!-- ADMIN ID CARD -->
								  	<input id="HID_TYPE_ADMIN_ID" name="HID_TYPE_ADMIN_ID" type="hidden" value="<?php echo (!empty($post) ? $post['admintypeid'] : "1"); ?>" />
									<div class="input-group input-group">
										<span class="input-group-addon" id="addon-ADMIN_ID_CARD">
											&nbsp;<?= $this->lang->line('id card ktp') ?>&nbsp;
										</span>
							      		<input id="ADMIN_ID_CARD" name="ADMIN_ID_CARD" type="text" class="form-control" placeholder="<?= $this->lang->line('id card number') ?>" aria-describedby="addon-ADMIN_ID_CARD" required onkeypress="return briIbbiz.isNumberKey(event)" minlength="15" maxlength="16" value="<?php echo (!empty($post) ? $post['adminidcard'] : ""); ?>" />
							      	</div>
									<div>
										<span id="ERROR_ADMIN_ID_CARD" style="color:red; font-size:11px"><?=form_error('ADMIN_ID_CARD',' ',' ')?></span>
									</div>
									<br />
								  	<!-- END ADMIN ID CARD -->
			  
								  	<!-- ADMIN ID CARD EXPIRED -->
								  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_ID_CARD_EXPIRED">
											&nbsp;<?= $this->lang->line('id card expiry date') ?>&nbsp;
										</span>
										<select class="form-control" name="statusktp" id="statusktp" onchange="statusKTP(this)">
											<option value="1" selected="selected"><?=$this->lang->line('lifetime');?></option>
											<option value="2"><?=$this->lang->line('expired_date');?></option>
										</select>
										<input id="ADMIN_ID_CARD_EXPIRED" name="ADMIN_ID_CARD_EXPIRED" type="text" class="form-control" style="display:none;" placeholder="<?= $this->lang->line('id card expiry date') ?>" aria-describedby="addon-ADMIN_ID_EXPIRED" value="<?php echo (!empty($post) ? $post['adminidcardexpired'] : ""); ?>" maxlength="10" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_ID_CARD_EXPIRED" style="color:red; font-size:11px"><?=form_error('ADMIN_ID_CARD_EXPIRED',' ',' ')?></span>
								  	</div>
								 	<br />
								 	<!-- END ADMIN ID CARD EXP -->

								 	<!-- ADMIN NATIONALITY -->
									<!-- <div class="input-group input-group">
								  		<span class="input-group-addon" id="addon-ADMIN_NATIONALITY">
											&nbsp;<?= $this->lang->line('nationality') ?>&nbsp;
										</span>
									<input id="nationality_name" name="nationality_name" type="text" class="form-control" placeholder="<?= $this->lang->line('nationality') ?>" aria-describedby="addon-ADMIN_NATIONALITY" required value="<?php echo (!empty($post) ? $post['adminnationality'] : ""); ?>" readonly/>
									<span class="input-group-addon">
										<a href="#">
											<i class="fa fa-search" onClick="PopupModal('<?=$this->lang->line('nationality') ?>', 'FrontPopup.jsp/KewarganegaraanDb', 'show');" id="SEARCH_ADMIN_NATIONALITY" name="SEARCH_ADMIN_NATIONALITY">
											</i>
										</a>
									</span>
								  	</div>
									<div>
										<span id="ERROR_ADMIN_NATIONALITY" style="color:red; font-size:11px"><?=form_error('ADMIN_NATIONALITY',' ',' ')?></span>
										<input type="hidden" id="nationality_code" name="nationality_code" value="<?php echo (!empty($post) ? $post['adminnationalitycode'] : ""); ?>" />
									</div>
									<br /> -->
						 
						 		  	<!-- ADMIN NPWP -->
						 		  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_NPWP">
											&nbsp;<?= $this->lang->line('npwp number') ?>&nbsp;
										</span>
										<input id="ADMIN_NPWP" name="ADMIN_NPWP" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('npwp number') ?>" aria-describedby="addon-ADMIN_NPWP" maxlength="15" value="<?php echo (!empty($post) ? $post['adminnpwp'] : ""); ?>" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_NPWP" style="color:red; font-size:11px"><?=form_error('ADMIN_NPWP',' ',' ')?></span>
								  	</div>
								  	<br />
								  	<!-- END ADMIN NPWP -->

								  	<!-- ADMIN JOB -->
									<div class="input-group input-group">
								  		<span class="input-group-addon" id="addon-ADMIN_TYPEWORK">
											&nbsp;<?= $this->lang->line('typeofwork_name') ?>&nbsp;
										</span>
										<input id="typeofwork_name" name="typeofwork_name" type="text" class="form-control" placeholder="<?= $this->lang->line('typeofwork_name') ?>" aria-describedby="addon-ADMIN_TYPEWORK" required readonly maxlength="25" value="<?php echo (!empty($post) ? $post['admintypeofworkname'] : ""); ?>"/>
										<span class="input-group-addon">
											<a href="#">
												<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('typeofwork_name') ?>', 'FrontPopup.jsp/KdJenisPekerjaanDb', 'show');" id="SEARCH_ADMIN_TYPEWORK" name="SEARCH_ADMIN_TYPEWORK">
												</i>
											</a>
										</span>
								  	</div>
									<div>
										<span id="ERROR_ADMIN_TYPEWORK" style="color:red; font-size:11px"><?=form_error('typeofwork_name',' ',' ')?></span>
										<input id="typeofwork_code" name="typeofwork_code" type="hidden" value="<?php echo (!empty($post) ? $post['admintypeofworkcode'] : ""); ?>" />
									</div>
									<br />

								  	<!-- ADMIN ADDRESS -->
								  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_ADDRESS">
											&nbsp;<?= $this->lang->line('address') ?>&nbsp;
										</span>
										<input id="ADMIN_ADDRESS" name="ADMIN_ADDRESS" type="text" class="form-control" placeholder="<?= $this->lang->line('address') ?>" aria-describedby="addon-ADMIN_ADDRESS" required maxlength="100" value="<?php echo (!empty($post) ? $post['adminaddress'] : ""); ?>" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_ADDRESS" style="color:red; font-size:11px"><?=form_error('ADMIN_ADDRESS',' ',' ')?></span>
								 	</div>
								 	<br />
								 	<!-- END ADMIN ADDRESS -->

								 	<!-- ADMIN PROVINCE -->
								  	<div class="input-group">
										<span class="input-group-addon" id="addon-ADMIN_PROVINCE">&nbsp;<?= $this->lang->line('province') ?>&nbsp;</span>
										<input type="text" class="form-control" placeholder="<?= $this->lang->line('province') ?>" aria-describedby="addon-ADMIN_PROVINCE" id="province_name" name="province_name" required readonly value="<?php echo (!empty($post) ? $post['adminprovincename'] : ""); ?>"/>
										<span class="input-group-addon">
											<a href="#">
												<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('province') ?>', 'FrontPopup.jsp/ProvinsiDb', 'show');" id="SEARCH_ADMIN_PROVINCE" name="SEARCH_ADMIN_PROVINCE">
												</i>
											</a>
										</span>
									</div>
									<div>
										<span id="ERROR_ADMIN_PROVINCE" style="color:red; font-size:11px"><?=form_error('HID_ADMIN_PROVINCE',' ',' ')?></span>
										<input type="hidden" id="province_code" name="province_code" value="<?php echo (!empty($post) ? $post['adminprovincecode'] : ""); ?>"/>
									</div>
									<br />

								  	<!-- ADMIN CITY -->
									<div class="input-group">
										<span class="input-group-addon" id="addon-ADMIN_CITY"></i>&nbsp;<?= $this->lang->line('city') ?>&nbsp;</span>
										<input type="text" class="form-control" placeholder="<?= $this->lang->line('city') ?>" aria-describedby="addon-ADMIN_CITY" id="city" name="city" required readonly value="<?php echo (!empty($post) ? $post['admincityname'] : ""); ?>"/>
										<span class="input-group-addon">
											<a href="#">
												<i class="fa fa-search" onClick="kotaDb()" id="SEARCH_ADMIN_CITY" name="SEARCH_ADMIN_CITY">
												</i>
											</a>
										</span>
									</div>
									<div>
										<span id="ERROR_ADMIN_CITY" style="color:red; font-size:11px"><?=form_error('HID_ADMIN_CITY',' ',' ')?></span>
										<input type="hidden" id="city_code" name="city_code" value="<?php echo (!empty($post) ? $post['admincitycode'] : ""); ?>"/>
									</div>

									<!-- ADMIN COUNTRY -->
								  	<div class="input-group input-group" style="display:none">
							  			<span class="input-group-addon" id="addon-ADMIN_COUNTRY">
											&nbsp;<?= $this->lang->line('country') ?>&nbsp;
										</span>
										<input id="ADMIN_COUNTRY" name="ADMIN_COUNTRY" type="hidden" class="form-control" placeholder="<?= $this->lang->line('country') ?>" aria-describedby="addon-ADMIN_COUNTRY" required readonly disabled maxlength="100" value="Indonesia" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_COUNTRY" style="color:red; font-size:11px"><?=form_error('ADMIN_COUNTRY',' ',' ')?></span>
								  	</div>
								  	<br />

								  	<!-- ADMIN TELEPHONE -->
								  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_TELEPHONE">
											&nbsp;<?= $this->lang->line('phone number') ?>&nbsp;
										</span>
										<input id="ADMIN_TELEPHONE" name="ADMIN_TELEPHONE" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('phone number') ?>" aria-describedby="addon-ADMIN_TELEPHONE" maxlength="15" value="<?php echo (!empty($post) ? $post['admintelephone'] : ""); ?>" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_TELEPHONE" style="color:red; font-size:11px"><?=form_error('ADMIN_TELEPHONE',' ',' ')?></span>
								  	</div>
								  	<br />
								  	<!-- END ADMIN TELEPHONE -->

								  	<!-- ADMIN HANDPHONE -->
								  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_HANDPHONE">
											&nbsp;<?= $this->lang->line('mobile phone number') ?>&nbsp;
										</span>
										<input id="ADMIN_HANDPHONE" name="ADMIN_HANDPHONE" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('mobile phone number') ?>" aria-describedby="addon-ADMIN_HANDPHONE" required maxlength="15" value="<?php echo (!empty($post) ? $post['adminhandphone'] : ""); ?>" />
								  	</div>
								 	<div>
										<span id="ERROR_ADMIN_HANDPHONE" style="color:red; font-size:11px"><?=form_error('ADMIN_HANDPHONE',' ',' ')?></span>
								  	</div>
								  	<br />
							  		<!-- END ADMIN TELEPHONE -->

								  	<!-- ADMIN EMAIL -->
								  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_EMAIL">
											&nbsp;<?= $this->lang->line('email') ?>&nbsp;
										</span>
										<input id="ADMIN_EMAIL" name="ADMIN_EMAIL" type="email" class="form-control" placeholder="<?= $this->lang->line('email') ?>" aria-describedby="addon-ADMIN_EMAIL" required maxlength="254" value="<?php echo (!empty($post) ? $post['adminemail'] : ""); ?>" />
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_EMAIL" style="color:red; font-size:11px"><?=form_error('ADMIN_EMAIL',' ',' ')?></span>
								  	</div>
								  	<br />
								  	<!-- END ADMIN EMAIL -->

								  	<!-- ADMIN PASSWORD -->
								  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_PASSWORD">
											&nbsp;<?= $this->lang->line('passwordreg') ?>&nbsp;
										</span>
										<input id="ADMIN_PASSWORD" name="ADMIN_PASSWORD" type="password" class="form-control" placeholder="<?= $this->lang->line('passwordreg') ?>" aria-describedby="addon-ADMIN_PASSWORD" required maxlength="100" />
										<span class="input-group-addon"><span id="ICON_ADMIN_PASSWORD"></span></span>
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_PASSWORD" style="color:red; font-size:11px"><?=form_error('ADMIN_PASSWORD',' ',' ')?></span>
								  	</div>
								  	<br />
								  	<!-- END ADMIN PASSWORD -->

								  	<!-- ADMIN CONFIRM PASSWORD -->
								  	<div class="input-group input-group">
							  			<span class="input-group-addon" id="addon-ADMIN_CONFIRM_PASSWORD">
											&nbsp;<?= $this->lang->line('password confirm') ?>&nbsp;
										</span>
										<input id="ADMIN_CONFIRM_PASSWORD" name="ADMIN_CONFIRM_PASSWORD" type="password" class="form-control" placeholder="<?= $this->lang->line('password confirm') ?>" aria-describedby="addon-ADMIN_CONFIRM_PASSWORD" required maxlength="100" />
										<span class="input-group-addon"><span id="ICON_ADMIN_PASSWORD_CONFIRM"></span></span>
								  	</div>
								  	<div>
										<span id="ERROR_ADMIN_PASSWORD_CONFIRM" style="color:red; font-size:11px"><?=form_error('ADMIN_CONFIRM_PASSWORD',' ',' ')?></span>
								  	</div>
								  	<br />
								  	<!-- END ADMIN CONFIRM PASSWORD -->

								  	<div>
							  		<span id="8char" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_8char') ?>
									<span id="ucase" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_ucase') ?>
									<span id="lcase" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_lcase') ?>
									<span id="num" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_num') ?>
									</div>

									<br />

									<div style="text-align: center">
										<input id="CB_AGREEMENT" name="CB_AGREEMENT" type="checkbox" required />
										<?= $this->lang->line('agreement_reg_term_1') ?><br/>
									</div>

									<br />

					      		  <table col="3">
					      		  	<td>
									  <div class="tab-pane">
								        <a class="btn btn-primary btnPrevious" onclick="goToRegister()"><?= $this->lang->line('back') ?></a>
								      </div>
							      	</td>
							      	<td width="80%">&nbsp;</td>
						      	  	<td>
							      	  <button class="btn btn-theme btn-block" title="Submit" autocomplete="off" id="register" name="register">
										<i class="fa fa-arrow-circle-right"></i>
										<?= $this->lang->line('send') ?>
									  </button>
								  	</td>
							  	  </table>
							    </div>

							    <!-- Modal Popup-->
								<div id="POPUP_MODAL" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="POPUP_MODAL" aria-hidden="true">
								  	<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
										  	<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 id="POPUP_MODAL_NAME" class="modal-title"></h4>
										  	</div>
										  	<div class="modal-body">
												<iframe id="POPUP_CONTENT_SRC"  class="embed-responsive-item" src="" name="POPUP_CONTENT_SRC" frameborder="0" scrolling="yes" width="100%" height="300" >
													&lt;p&gt;Browser anda tidak mendukung iframes.&lt;/p&gt;
												</iframe>
										  	</div>
										</div>
								  	</div>
								</div>
								<!-- Modal Popup -->
								</div>

							    </form>
					      	</div>
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

<script type="text/javascript">

	var token = document.getElementById('token').value;

	function doInquiryAccount(id_form, base_url, accountno)
	{
	    $.ajax(
	    {
	        type: 'post',
	        url : base_url + "Form.jsp/doInquiryAccount",
	        data: 
	        {
	            accountno : accountno,
	            <?= $this->security->get_csrf_token_name() ?> : token,
	        },
	        error: function()
	        {
	            alert("Error while request data");
	        },
	        success: function(data)
	        {
	            var arr_data = JSON.parse(data);
	            //alert(arr_data);

	            if(arr_data.statuscode == "0001")
	            {
	                document.getElementById("ADMIN_NAME").value = arr_data.accountname;
	            }
	            else
	            {
	                alert(arr_data.statusdesc);
	            }
	        }
	    });  
	}

	$(document).ready(function() {
	    $(".numonly").keydown(function (e) {
	    	if ($.inArray(e.keyCode, [46, 8, 9, 13]) !== -1 || 
             // Allow: Ctrl+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 40) ||
            // Allow : numelock number
            (e.keyCode >= 96 && e.keyCode <= 105)) {
                 // let it happen, don't do anything
                 return;
            }
            if (e.which < 48 ||  e.which > 57)
                return false;
            
            return true;
	    }); 

	    $(".txtonly").keydown(function (e) {
	    	if ($.inArray(e.keyCode, [46, 8, 9, 13]) !== -1 || 
             // Allow: Ctrl+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 40) ||
            // Allow : space
            (e.keyCode ==32)) {
                 // let it happen, don't do anything
                 return;
            }
            if (e.which < 65 ||  e.which > 90)
                return false;
            
            return true;
	    }); 

	    $("input[type=password]").keyup(function(){
				var ucase = new RegExp("[A-Z]+");
				var lcase = new RegExp("[a-z]+");
				var num = new RegExp("[0-9]+");

				var thru = false;

				if($("#ADMIN_PASSWORD").val().length >= 8){
					$("#8char").removeClass("fa fa-close");
					$("#8char").addClass("fa fa-check");
					$("#8char").css("color","#00A41E");
				}else{
					$("#8char").removeClass("fa fa-check");
					$("#8char").addClass("fa fa-close");
					$("#8char").css("color","#FF0004");
				}
				
				if(ucase.test($("#ADMIN_PASSWORD").val())){
					$("#ucase").removeClass("fa fa-close");
					$("#ucase").addClass("fa fa-check");
					$("#ucase").css("color","#00A41E");
				}else{
					$("#ucase").removeClass("fa fa-check");
					$("#ucase").addClass("fa fa-close");
					$("#ucase").css("color","#FF0004");
				}
				
				if(lcase.test($("#ADMIN_PASSWORD").val())){
					$("#lcase").removeClass("fa fa-close");
					$("#lcase").addClass("fa fa-check");
					$("#lcase").css("color","#00A41E");
				}else{
					$("#lcase").removeClass("fa fa-check");
					$("#lcase").addClass("fa fa-close");
					$("#lcase").css("color","#FF0004");
				}
				
				if(num.test($("#ADMIN_PASSWORD").val())){
					$("#num").removeClass("fa fa-close");
					$("#num").addClass("fa fa-check");
					$("#num").css("color","#00A41E");
				}else{
					$("#num").removeClass("fa fa-check");
					$("#num").addClass("fa fa-close");
					$("#num").css("color","#FF0004");
				}
				
			
				if($("#ADMIN_PASSWORD").val().length >= 8){
					if(ucase.test($("#ADMIN_PASSWORD").val())){
						if(lcase.test($("#ADMIN_PASSWORD").val())){
							if(num.test($("#ADMIN_PASSWORD").val())){
								thru = true;
							}
						}
					}
				}
				

				if (thru)
				{
					$("#ICON_ADMIN_PASSWORD").removeClass("fa fa-close");
					$("#ICON_ADMIN_PASSWORD").addClass("fa fa-check");
					$("#ICON_ADMIN_PASSWORD").css("color","#00A41E");

					if($("#ADMIN_PASSWORD").val() == $("#ADMIN_CONFIRM_PASSWORD").val()){

						$("#ICON_ADMIN_PASSWORD_CONFIRM").removeClass("fa fa-close");
						$("#ICON_ADMIN_PASSWORD_CONFIRM").addClass("fa fa-check");
						$("#ICON_ADMIN_PASSWORD_CONFIRM").css("color","#00A41E");
					}else{
						$("#ICON_ADMIN_PASSWORD_CONFIRM").removeClass("fa fa-check");
						$("#ICON_ADMIN_PASSWORD_CONFIRM").addClass("fa fa-close");
						$("#ICON_ADMIN_PASSWORD_CONFIRM").css("color","#FF0004");
					}
				}
				else
				{
					$("#ICON_ADMIN_PASSWORD").removeClass("fa fa-check");
					$("#ICON_ADMIN_PASSWORD").addClass("fa fa-close");
					$("#ICON_ADMIN_PASSWORD").css("color","#FF0004");
				}
			}); 
	});

	function maxLengthCheck(object)
	 {
	    if (object.value.length > object.maxLength)
	      object.value = object.value.slice(0, object.maxLength)
	 }

  	function goToRegister()
	{
		window.location = "<?=base_url()?>Form.jsp/index";
	}

	function kotaDb()
	{
		if(document.getElementById('province_code').value)
		{
			parent.PopupModal('<?=$this->lang->line('city') ?>', 'FrontPopupKota.jsp/' + document.getElementById('province_code').value , 'show');
		}
		else{
			alert('Please choose province first.');
		}
	}

</script>

</html>