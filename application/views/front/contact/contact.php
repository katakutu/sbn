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
	<link rel="stylesheet" href="<?= base_url() ?>plugin/css/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url() ?>plugin/css/responsive.css">
	<link rel="stylesheet" href="<?= base_url() ?>plugin/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/flag.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery.payment.min.js"></script>
	<!--<script type="text/javascript" src="<?= base_url() ?>js/side.js"></script>-->
	<link href="<?= base_url() ?>css/main.css" rel="stylesheet">
</head>
<script type="text/javascript">

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

	.input-text {
		color:#292929;
	}

	.input-text:focus {
		border: 1px solid #255d8f;
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
						<li class="active">
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
	<main id="site-main" class="site-main" style="padding-bottom:50px">
	<section id="main-container">
		<div class="container info-box">
		<br>
			<div class="row">
        	<div class="col-lg-6 col-sm-7" style="color:white">
            	<div class="contact-info-box address clearfix">
                	<h3 style="color:white"><i style="color:white;" class="fa-map-marker"></i>Address:</h3>
                	<span>PT. Bank Rakyat Indonesia (Persero) Tbk.<br> Kantor Pusat<br> Gedung BRI 1<br> Jl. Jenderal Sudirman Kav.44-46<br> Jakarta 10210<br> Indonesia</span>
                </div>
                <div class="contact-info-box phone clearfix">
                	<h3 style="color:white"><i style="color:white;" class="fa-phone"></i>Phone:</h3>
                	<span>(62-21) 2510244, 2510254,<br>2510264, 2510269, 2510279<br>(021) 5751966</span>
                </div>
                <div class="contact-info-box email clearfix">
                	<h3 style="color:white"><i style="color:white;" class="fa-pencil"></i>Email:</h3>
                	<span>wmg.pbo@corp.bri.co.id</span>
                </div>
                <ul class="social-link">
                	<li class="twitter"><a href="https://www.twitter.com/BANKBRI_ID" target="_blank"><i class="fa-twitter"></i></a></li>
                    <li class="instagram"><a href="https://www.instagram.com/BANKBRI_ID" target="_blank"><i class="fa-instagram"></i></a></li>
                    <li class="facebook"><a href="https://www.facebook.com/BRIofficialpage/" target="_blank"><i class="fa-facebook"></i></a></li>
                </ul>
            </div>
        	<div class="col-lg-6 col-sm-5">
            	<div class="form">
                	
                    <!-- <div id="sendmessage" style="color:white">Your message has been sent. Thank you!</div> -->
                    <div id="errormessage"></div>
                    <form action="<?=base_url();?>ContactUs.jsp/sendmail" method="post" role="form" class="contactForm">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-text" id="name" placeholder="Your Name" required onkeypress="return briIbbiz.isAlphaSpasi(event)" data-rule="minlen:4" minlength="4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-text" name="email" id="email" placeholder="Your Email" required data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-text" name="handphone" id="handphone" placeholder="No.HP" required onkeypress="return briIbbiz.isNumberKey(event)" data-rule="minlen:6" minlength="6" data-msg="Please enter at least 6 number" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control input-text text-area" id="message" name="message" rows="5" placeholder="Message" required></textarea>
                            <div class="validation"></div>
                        </div>
                        
                        <div class="text-center"><button type="submit" class="input-btn" style="background-color:#337ab7">Send Message</button></div>
                    </form>
                </div>	
            </div>
        </div>
		</div>
	</section>
	</main>
	<br />
<script type="text/javascript">
	var briIbbiz=new Object();
		briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};
		briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};
		briIbbiz.isAlphaNum=function(e){return /^[A-Z0-9]+$/i.test(e.key);};
		briIbbiz.isAlphaNumSpasi=function(e){return /^[A-Z0-9 ]+$/i.test(e.key);};
		briIbbiz.isAlphaSpasi=function(e){return /^[A-Z ]+$/i.test(e.key);};
		briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- .,()]+$");};	
</script>
</body>
<footer class="site-footer">
  <p>Copyright &copy; 2018 Bank Rakyat Indonesia (Persero) Tbk.</p>
</footer>
</html>