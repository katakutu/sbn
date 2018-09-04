<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="keyword">
<meta name="Description" content="description">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
	<head>
		<title>
			<?= $this->parameter_helper->header_app ?>
		</title>
		<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<meta keywords="" />
		<link rel="stylesheet" href="<?=base_url();?>css/font-awesome.css">
		<link rel="stylesheet" href="<?=base_url();?>plugin/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=base_url();?>plugin/tabmenu/style.css">
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>plugin/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('contact_us') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li class="active"><?= $this->lang->line('contact_us') ?></a></li>
				</ol>
				<br>
				<div class="panel-body">
						<div class="row">
				        	<div class="col-lg-6 col-sm-7">
				        		<table style="width: 100%">
				        			<tr>
				        				<td style="vertical-align: top !important;"><h4><i class="fa fa-map-marker"></i> Address</h4><br><br><br><br><br></td>
				        				<td style="width: 10px;vertical-align: top;text-align: center;"><h4>:</h4><br><br><br><br><br></td>
				        				<td>
				        					PT. Bank Rakyat Indonesia (Persero) Tbk.<br> Kantor Pusat<br> Gedung BRI 1<br> Jl. Jenderal Sudirman Kav.44-46<br> Jakarta 10210<br> Indonesia
				        				</td>
				        			</tr>
				        			<tr>
				        				<td style="vertical-align: top;"><h4><i class="fa fa-phone"></i> Phone</h4><br><br></td>
				        				<td style="width: 10px;vertical-align: top;text-align: center;"><h4>:</h4><br><br></td>
				        				<td>
				        					(62-21) 2510244, 2510254,<br>2510264, 2510269, 2510279<br>(021) 5751966
				        				</td>
				        			</tr>
				        			<tr>
				        				<td style="vertical-align: top;"><h4><i class="fa fa-phone"></i> Email</h4></td>
				        				<td style="width: 10px;vertical-align: top;text-align: center;"><h4>:</h4></td>
				        				<td>
				        				    mg.pbo@corp.bri.co.id
				        				</td>
				        			</tr>
				        			<tr>
				        				<td colspan="3">
				        					<div style="margin-top: 20px;">
							                	<a href="https://www.twitter.com/BANKBRI_ID" target="_blank" style="color: #555;"><i class="fa fa-twitter" style="font-size: 24px;"></i></a> &nbsp;&nbsp;
							                    <a href="https://www.instagram.com/BANKBRI_ID" target="_blank" style="color: #555;"><i class="fa fa-instagram" style="font-size: 24px;"></i></a> &nbsp;&nbsp;
							                    <a href="https://www.facebook.com/BRIofficialpage/" target="_blank" style="color: #555;"><i class="fa fa-facebook" style="font-size: 24px;"></i></a>
							                </div>
				        				</td>
				        			</tr>
				        		</table>
				                
				            </div>
				        	<div class="col-lg-6 col-sm-5">
				            	<div class="form">
				                	
				                    <!-- <div id="sendmessage" style="color:white">Your message has been sent. Thank you!</div> -->
				                    <div id="errormessage"></div>
				                    <form action="<?=base_url();?>ContactUsBackend.jsp/send" method="post" role="form" class="contactForm">
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
				                        
				                        <div class="text-center"><button type="submit" class="btn btn-primary">Send Message</button></div>
				                    </form>
				                </div>	
				            </div>
				        </div>
				</div>
            </div>
		</div>
	</body>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/responsive.bootstrap.min.css">
    <script src="<?=base_url();?>js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript">
	var briIbbiz=new Object();
		briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};
		briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};
		briIbbiz.isAlphaNum=function(e){return /^[A-Z0-9]+$/i.test(e.key);};
		briIbbiz.isAlphaNumSpasi=function(e){return /^[A-Z0-9 ]+$/i.test(e.key);};
		briIbbiz.isAlphaSpasi=function(e){return /^[A-Z ]+$/i.test(e.key);};
		briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- .,()]+$");};	
</script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
</html>