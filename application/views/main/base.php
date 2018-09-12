<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->parameter_helper->header_app; ?>
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta keywords="" />
	<link rel="stylesheet" href="css/font-awesome.css">
	<script type="text/javascript">
		function sesout() {
		    alert("<?= $this->lang->line('logout-force') ?>")
		    window.open("Auth.jsp/logout", "_self");
		}
	</script>
	<link rel="stylesheet" href="css/home.css">
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/home.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" href="css/base.css">
	<style type="text/css">
		.popover{
			max-width: 800px;
		    width:300px;
    		height:150px;
		}
	</style>
</head>

<body onload="frameload();">
	<div id="wrapper">
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" style="float:right;" aria-controls="navbar" aria-expanded="false" data-target="#header_menu" data-toggle="collapse" type="button">					
					<span class="navbar-toggle-label">
				      <font color="#ffffff">Menu</font><span class="sr-only">Toggle Navigation</span>
				    </span>
				    <span class="navbar-toggle-icon">
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				    </span>
				</button>
				<a class="navbar-brand-new" href="<?= base_url() ?>Home.jsp"><img src="<?= base_url() ?>images/logo.png" alt="BRI SBN Ritel Online"></a>
			</div>
			<div id="header_menu" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<?= $header ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>					
						<a href="#" data-toggle="popover" data-html="true" data-placement="bottom" data-content="<?= $name_detail ?>" data-trigger="hover" title="<b><?= $name ?></b>" target="">
							<i class="fa fa-user"></i>
							<?= $name ?>
						</a>
					</li>
					<li>
						<a title="Logout" target="" onClick="logout();" href="#">
							<i class="fa fa-sign-out"></i>
							Logout
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Modal Logout Timeout -->
	<div id="logout-force" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Logout</h4>
		  </div>
		  <div class="modal-body">
			<p><?= $this->lang->line('logout-force') ?></p>
		  </div>
		  <div class="modal-footer">
			<a href="Auth.jsp/logout" class="btn btn-default">Close</a>
		  </div>
		</div>

	  </div>
	</div>
	<!-- Modal Logout -->
	<div id="logout" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Logout</h4>
		  </div>
		  <div class="modal-body">
			<p><?= $this->lang->line('logout') ?></p>
		  </div>
		  <div class="modal-footer">
			<a href="Auth.jsp/logout" class="btn btn-warning"><?= $this->lang->line('yes') ?></a>
			<a class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('no') ?></a>
		  </div>
		</div>
	  </div>
	</div>
	<section id="main-container">
		<div id="main-content">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-8 col-lg-3">
						<div class="panel-group" id="accordion_sidemenu" role="tablist" aria-multiselectable="true">
							<div class="panel panel-primary">
								<div class="panel-heading" role="tab" id="info1">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion_sidemenu" href="#sidemenu" aria-expanded="true" aria-controls="sidemenu">
											<center><p style="margin-bottom: 0px"><i class="fa fa-tag"></i> Menu</p></center>
										</a>
									</h4>
								</div>
								<div id="sidemenu" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="sidemenu">
									<iframe id="iframemenu"  name="menus" frameborder="0" src="Home.jsp/origin" style="width: 100%; height: 250px;" >
										&lt;p&gt;Browser anda tidak mendukung iframes.&lt;/p&gt;
									</iframe>
								</div>
							</div>
						</div>
						<div class="panel-group clock" id="accordion_clock" role="tablist" aria-multiselectable="true">
							<div class="panel panel-primary">
								<div id="clock" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="clock">
									<div class="panel-body">
										<div class="clock">
											<div id="Date"></div>
											<ul>
											    <li id="hours"></li>
											    <li id="point">:</li>
											    <li id="min"></li>
											    <li id="point">:</li>
											    <li id="sec"></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>			
					</div>
					<div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
						<iframe id="content" src="Home.jsp/main" name="content" frameborder="0" scrolling="yes" style="width: 100%;" onload="setIframeHeight(this.id)">
							&lt;p&gt;Browser anda tidak mendukung iframes.&lt;/p&gt;
						</iframe>
					</div>
				</div>
			</div>
		</div>	
	</section>
    
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
</body>
<footer class="footer-default">
	<p class="footer-text">Copyright © 2018 Bank Rakyat Indonesia (Persero) Tbk. All rights reserved.</p>
</footer>
<script type="text/javascript">
	$(function () {
		$('[data-toggle="popover"]').popover({
		    container: 'body'
		});
	});
</script>
<script type="text/javascript">
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
</html>
