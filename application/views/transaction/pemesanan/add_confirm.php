<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->parameter_helper->header_app ?>
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta keywords="" />
	<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
	<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/moment.min.js"></script>

	<script type="text/javascript">
		jQuery(function($) {
			$(document).ready(function() {
				$("form").submit(function() {
					 $(':input[type="submit"]').prop('disabled', true);
					$('#PANEL_LOADING_SUBMIT').show();
			    });    
			});
		});              

	</script>

	<style type="text/css">
		td {
		    padding-top: .5em;
		    padding-bottom: .5em;
		}

		.disclaimer-order{
		    padding: 10px;
		    border: 1px solid transparent;
		    border-radius: 4px;
		    border-color: #585656;
		    margin-top: 20px;
		    font-weight: 800;
		    font-size: 12px;
		} 
	</style>

</head>
<body oncontextmenu="return false">
	<div class="panel panel-primary">
		<h3 style="text-align: right; padding-right: 25px">
			<i class="fa fa-feed"></i> <b><?= $this->lang->line('pemesanan') ?></b>
		</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('pemesanan') ?></li>
				<li class="active"><?= $this->lang->line('add') ?></li>
			</ol>

			<?php $attributes = array('name' => 'Pemesanan', 'id' => 'Pemesanan', 'class' => 'form', 'target' => 'content');
					echo form_open(base_url().'Pemesanan.jsp/confirm', $attributes); ?>

			<div class="col-xs-12 col-sm-12 col-md-10">
				<input type="hidden" id="sid" name="sid" value="<?= $sid; ?>"></input>
				<input type="hidden" id="seriid" name="seriid" value="<?= $seriid; ?>"></input>
				<input type="hidden" id="amount" name="amount" value="<?= $amount; ?>"></input>
				<input type="hidden" id="fundaccountid" name="fundaccountid" value="<?= $fundaccountid; ?>"></input>
				<input type="hidden" id="secaccountid" name="secaccountid" value="<?= $secaccountid; ?>"></input>
				
				<div>
				<h4  style="color:#144069"><strong><?= $this->lang->line('confirmation_order') ?></strong></h4>
				<!--<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">-->
				<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
					<tbody>
						<tr>
							<td align="left" width="250px"><?= $this->lang->line('sid') ?></td>
							<td align="center" width="10px">:</td>
							<td align="left" class="td-responsive"><?= $sid ?></td>
						</tr>
						<tr>
							<td align="left" width="250px"><?= $this->lang->line('seriname') ?></td>
							<td align="center" width="10px">:</td>
							<td align="left" class="td-responsive"><?= $seriname ?></td>
						</tr>
						<tr>
							<td align="left" width="250px"><?= $this->lang->line('amount') ?></td>
							<td align="center" width="10px">:</td>
							<td align="left" class="td-responsive"><?= number_format($amount) ?> IDR</td>
						</tr>
						<tr>
							<td align="left" width="250px"><?= $this->lang->line('fundaccountno') ?></td>
							<td align="center" width="10px">:</td>
							<td align="left" class="td-responsive"><?= $fundaccountno ?></td>
						</tr>
						<tr>
							<td align="left" width="250px"><?= $this->lang->line('secaccountno') ?></td>
							<td align="center" width="10px">:</td>
							<td align="left" class="td-responsive"><?= $secaccountno ?></td>
						</tr>
						<tr>
							<td align="left" width="250px"><?= $this->lang->line('verif_code') ?></td>
							<td align="center" width="10px">:</td>
							<td align="left" class="td-responsive"><input type="text" id="token" name="token" placeholder="<?= $this->lang->line('verif_code') ?>" title="<?= $this->lang->line('cek_token') ?>" maxlength="6" required></td>
						</tr>
					</tbody>
				</table>
				</div>
			</div>

			<div class="col-xs-12 col-sm-8 col-md-10">
				<div class="disclaimer-order">
					<p style="text-transform: uppercase; text-align: center"><?= $this->lang->line('confirmation') ?></p>
		            <p><?= $this->lang->line('disclaimerorder') ?></p>
		            <div class="checkbox">
						<label class="checkbox">
							<input id="CB_AGREEMENT" name="CB_AGREEMENT" type="checkbox" required="required" /><?= $this->lang->line('i agree pemesanan') ?>
						</label>
					</div>	
		        </div>
			</div>

			<div class="col-xs-12 col-sm-8 col-md-10">
				<br />
				<button class="btn btn-theme btn-block" title="<?= $this->lang->line('confirm') ?>" type="submit" value="Submit" name="submit">
					<i class="fa fa-arrow-circle-right"></i>
					<?= $this->lang->line('confirm') ?>
				</button>
				<br />
				<a class="btn btn-theme btn-default" title="<?= $this->lang->line('cancel') ?>" value="Cancel" name="cancel" href="<?php echo base_url('Pemesanan.jsp/add'); ?>" >
					<i class="fa fa-arrow-circle-left"></i>
					<?= $this->lang->line('cancel') ?>
				</a>
				<br />
				<div id="PANEL_LOADING_SUBMIT" style="display: none;" >
					<center><i class="fa fa-spinner fa-pulse"></i> &nbsp; <?php echo $this->lang->line('dt_processing'); ?></center>
				</div>
			</div>
			</form>
		</div>
	</div>
</body>
<script language="javascript" type="text/javascript">
  $(document).ready(function() {
  	// var fileName = "login.pdf";
    $('#addClientPop').click(function(){
      $("#dialog").dialog({
      	modal: true,
                title: "Memorandum Informasi",
                width: 900,
                height: 600,
                buttons: {
                    Close: function () {
                        $(this).dialog('close');
                    }
                },
      });
    }); 
  });                  
</script>
</html>