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
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-clockpicker.min.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-clockpicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/moment.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/autoNumeric.js"></script>
</head>
<style type="text/css">

	@media (max-width: 768px) {
		#rightform {
			display: none;
		}
	}

</style>
<script type="text/javascript">
	jQuery(function($) {		
		$('#amount').autoNumeric({mDec: '0',vMin: 0, vMax: 100000000000000});
	});
		
	var briIbbiz=new Object();briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};briIbbiz.isAlphaNum=function(e){return e.match("^[A-Za-z0-9]+$");};briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- .,()]+$");};
		
	window.history.forward();
    function noBack() { window.history.forward(); }
	
	
	function replaceAll(str, find, replace) {
		return str.replace(new RegExp(find, 'g'), replace);
	}
	
</script>
<body oncontextmenu="return false" onload="window.history.forward();" onpageshow="if (event.persisted) noBack();">
	<div class="panel panel-primary">
		<h3 style="text-align: right; padding-right: 25px">
			<i class="fa fa-feed"></i> <b><?= $this->lang->line('redemption') ?></b>
		</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('redemption') ?></li>
				<li class="active"><?= $this->lang->line('add') ?></li>
			</ol>

			<div class="col-xs-12 col-sm-8 col-md-10">
			<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Redemption', 'id' => 'Redemption', 'class' => 'form', 'target' => 'content');
				echo form_open(base_url().'Redemption.jsp/add_confirm', $attributes); ?>
				<?php cetak_flash_msg(); ?>
				<div style="display: none;" id="frm1hidden">
					<input id="couponrate" name="couponrate" value="" type="hidden" />
					<input id="val_min" name="val_min" value="" type="hidden" />
					<input id="val_max" name="val_max" value="" type="hidden" />
					<input id="seriid" name="seriid" value="" type="hidden" />
				</div>

				<div class="input-group">
					<span class="input-group-addon" id="addon-sid"><?= $this->lang->line('sid') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" value='<?php if(isset($sid))echo $sid;?>' required readonly='true'/>
				</div>
				<div>
					<span id="span_sid" style="color:red; font-size:11px"><?=form_error('sid',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group">
					<span class="input-group-addon" id="addon-orderno"><?= $this->lang->line('orderno') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('orderno') ?>" aria-describedby="addon-orderno" id="orderno" name="orderno" required="required" value="<?php if(isset($orderno))echo $orderno;?>" />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('orderno') ?>', 'ListOrder.jsp/OrderRedemption', 'show');" id="SEARCH_orderno" name="SEARCH_orderno">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="span_orderno" style="color:red; font-size:11px"><?=form_error('hid_fundaccountno',' ',' ')?></span>
				</div>
				<br />

				<div id="panel-red" class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title" align="center" style="font-size: 12px;"><?= $this->lang->line('seridetail') ?></h5>
					</div>
					<br/>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-maxred"><?= $this->lang->line('maxred') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('maxred') ?>" aria-describedby="addon-maxred" id="maxred" name="maxred" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-multredem"><?= $this->lang->line('multredem') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('multredem') ?>" aria-describedby="addon-multredem" id="multredem" name="multredem" value="<?php if(isset($multredem))echo $multredem;?>" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-sisakepemilikan"><?= $this->lang->line('sisakepemilikan') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('sisakepemilikan') ?>" aria-describedby="addon-sisakepemilikan" id="sisakepemilikan" name="sisakepemilikan" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
				</div>

				<div class="input-group">
					<span class="input-group-addon" id="addon-amount"><?= $this->lang->line('amount') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('amount') ?>" aria-describedby="addon-amount" id="amount" name="amount" required="required" value="<?php echo (!empty($post) ? (($post['amount'] <= $max_amount) ? $post['amount'] : 0) : ""); ?>" maxlength="30" />
					<span class="input-group-addon">
						IDR
					</span>
				</div>
				<div>
					<span id="span_amount" style="color:red; font-size:11px"><?=form_error('amount',' ',' ')?></span>
				</div>
				<br />

				<button class="btn btn-theme btn-block" title="Submit" type="submit" value="Submit" name="submit">
					<i class="fa fa-arrow-circle-right"></i>
					Submit
				</button>
				
				</form>
			</div>
			</div>
		</div>		
	</div>
</body>
</html>