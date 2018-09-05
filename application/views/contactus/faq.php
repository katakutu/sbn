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
		<style type="text/css">
			.accordion .card-header:after {
	    		font-family: 'FontAwesome';  
	    		content: "\f068";
	    		float: right; 
			}
			.accordion .card-header.collapsed:after {
	    		/* symbol for "collapsed" panels */
	    		content: "\f067"; 
			}
		</style>
	</head>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b>FAQ</b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('contact_us') ?></a></li>
					<li class="active">FAQ</li>
				</ol>
				<br>
				<div class="panel-body" style="height: 240px !important;">

					<div class="panel-group" id="faqAccordion">
				        <div class="panel panel-default ">
				            <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
				                 <h4 class="panel-title">
				                    <a href="#" class="ing">Q: Surat Utang Negara (SUN)?</a>
				              </h4>

				            </div>
				            <div id="question0" class="panel-collapse collapse" style="height: 0px;">
				                <div class="panel-body">
				                     <h5><span class="label label-primary">Answer</span></h5>
				                    <p>
				                    	Surat berharga yang berupa surat pengakuan utang dalam mata uang Rupiah maupun valuta asing yang dijamin pembayaran bunga dan pokoknya dijamin oleh Negara Republik Indonesia, sesuai dengan masa berlakunya, sebagaimana dimaksud dalam Undang-Undang Nomor 24 Tahun 2002 tentang Surat Utang Negara. 
				                    </p>
				                </div>
				            </div>
				        </div>
				        <div class="panel panel-default ">
				            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
				                 <h4 class="panel-title">
				                    <a href="#" class="ing">Q: Apa yang dimaksud dengan Saving Bonds Ritel (SBR) ?</a>
				              </h4>

				            </div>
				            <div id="question1" class="panel-collapse collapse" style="height: 0px;">
				                <div class="panel-body">
				                     <h5><span class="label label-primary">Answer</span></h5>

				                    <p>Obligasi Negara yang dijual kepada individu perseorangan Warga Negara Indonesia melalui Mitra Distribusi di Pasar Perdana domestik yang tidak dapat diperdagangkan di pasar sekunder.</p>
				                </div>
				            </div>
				        </div>
				        
				    </div>
				    <!--/panel-group -->

				</div>
            </div>
		</div>
	</body>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
</html>