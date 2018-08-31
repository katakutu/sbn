<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->parameter_helper->header_app ?>
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta keywords="" />
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
</head>
<style type="text/css">
	
	@media (max-width: 767px) {		
		#td_img_person {
			display: none;
		}
	}
	
	#header_app {
		font-family: "Lucida Console";
	}

</style>
<body oncontextmenu="return false">
	<?= $this->parameter_helper->login_header ?>
	<table  style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; background-color: #fff; border: 1px; box-shadow: 1px 1px 10px #888888; width: 100%; padding: 20px">
		<td id="td_img_person" style="width: 200px">
			<img id="img_person" src="<?= base_url() ?>images/user/<?= $img ?>.png" alt="person" class="img-responsive">
		</td>
		<td>
			<h3>
				<p><?= $this->lang->line('welcome') ?>,&nbsp;<?= $title ?>&nbsp;<b><?= $name ?></b></p>
			</h3>
			<table class="table table-striped table-responsive">
				<tbody>
					<tr>
				    	<td style="width: 25%">
				    		<?= $this->lang->line('full name') ?>
	        			</td>
	        			<td>
				    		:
	        			</td>
	        			<td>
	        				<?= $full_name ?>
        				</td>
        			</tr>
        			<tr>
				    	<td style="width: 15%">
				    		<?= $this->lang->line('sid') ?>
	        			</td>
	        			<td style="width: 5%">
				    		:
	        			</td>
	        			<td>
	        				<?php if(isset($sid))echo $sid;?>
        				</td>
        			</tr>
        			<tr>
				    	<td style="width: 15%">
				    		<?= $this->lang->line('subreg') ?>
	        			</td>
	        			<td style="width: 5%">
				    		:
	        			</td>
	        			<td>
	        				<?php if(isset($subreg))echo $subreg;?>
        				</td>
        			</tr>
        			<tr>
				    	<td style="width: 15%">
				    		<?= $this->lang->line('mobile phone number') ?>
	        			</td>
	        			<td style="width: 5%">
				    		:
	        			</td>
	        			<td>
	        				<?= $handphone ?>
        				</td>
        			</tr>
        			<tr>
				    	<td style="width: 15%">
				    		<?= $this->lang->line('email') ?>
	        			</td>
	        			<td style="width: 5%">
				    		:
	        			</td>
	        			<td>
	        				<?= $email ?>
        				</td>
        			</tr>
			    </tbody>
		    </table>
		</td>
	</table>
	<br>
	<?php if ($notification) { ?>
	<div class="panel panel-danger">
		<div class="panel-heading"><h5><b><?= $this->lang->line('transaction in process') ?></b></h5></div>
		<div class="panel-body">
		<?php if ($transfer) { ?>
			<?= $transfer ?>
		<?php } ?>
		<?php if ($payment) { ?>
			<?= $payment ?>
		<?php } ?>
		</div>
	</div>
	<?php } ?>
</body>

<script>

function jump(link)
{
	waitingDialog.show();
	frames['content'].location.href = link;
	waitingDialog.hide();

	if(window.innerWidth <= 768) {
		$('#sidemenu').collapse("toggle");
	}
}

</script>
</html>