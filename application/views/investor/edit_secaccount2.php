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
		<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/moment.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/autoNumeric.js"></script>

	<script type="text/javascript">
	jQuery(function($) {
		$('.secaccountname').tooltip({'trigger':'focus', 'title': '<?= $this->lang->line("secaccountname_rule_message") ?>'});
	});

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z;
		}
	}

	function ConfirmDelete(e)
	{
	  var x = confirm("<?= $this->lang->line('confirmdelete') ?>");
    	if (!x){ 
        e.preventDefault();
        return false;
    	}	
	}
</script>

<div class="panel-body">
	<div class="form-wrap" id="form-wrap">
		<?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');		
			echo form_open(base_url().'#', $attributes); ?>
				
			<input type="hidden" id="id_reksb" name="id_reksb" value="<?= $id_reksb; ?>"></input>	
			<div class="input-group input-group">
				<span class="input-group-addon" id="addon-sid"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('sid') ?>&nbsp;</span>
				<input class="form-control" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" value="<?= $sid ?>" required readonly='true'/>
			</div>
			<div>
				<span id="span_sid" style="color:red; font-size:11px"><?=form_error('sid',' ',' ')?></span>
			</div>
			<br />

			<div class="input-group input-group">
				<span class="input-group-addon" id="addon-secaccountname"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('secaccountname') ?>&nbsp;</span>
				<input class="form-control secaccountname" placeholder="<?= $this->lang->line('secaccountname') ?>" aria-describedby="addon-secaccountname" id="secaccountname" name="secaccountname" maxlength="70" value="<?php if(isset($sec_account_name))echo $sec_account_name;?>" required readonly='true'/>
			</div>
			<div>
				<span id="SPAN_secaccountname" style="color:red; font-size:11px"><?=form_error('secaccountname',' ',' ')?></span>
			</div>
			<br />

			<div class="input-group input-group">
				<span class="input-group-addon" id="addon-subregname"><i class="fa fa-bank"></i> <?= $this->lang->line('subregname') ?>&nbsp;</span>
				<input type="text" class="form-control" placeholder="<?= $this->lang->line('subregname') ?>" aria-describedby="addon-subregname" id="subregname" name="subregname" required="required" value="<?php if(isset($subreg_name))echo $subreg_name;?>" readonly='true' />
				<span class="input-group-addon">
					<a href="#">
						<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('subregname') ?>', 'ListKdSubreg.jsp/KdSubreg', 'show');" id="SEARCH_subregname" name="SEARCH_subregname">
						</i>
					</a>
				</span>
			</div>
			<div>
				<span id="span_subregname" style="color:red; font-size:11px"><?=form_error('hid_subregname',' ',' ')?></span>
				<input type="hidden" id="subregid" name="subregid" value="<?php if(isset($subreg_id))echo $subreg_id;?>" />
			</div>
			<br />
				
			<div class="input-group input-group">
	  			<span class="input-group-addon" id="addon-secaccountno">
					<i class="fa fa-chevron-right"></i>&nbsp;<?= $this->lang->line('secaccountno') ?>&nbsp;
				</span>
				<input id="secaccountno" name="secaccountno" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('secaccountno') ?>" aria-describedby="addon-secaccountno" required="required" maxlength="15" value="<?php if(isset($sec_account_no))echo $sec_account_no;?>" readonly='true'/>
		  	</div>
		  	<div>
				<span id="span_secaccountno" style="color:red; font-size:11px"><?=form_error('secaccountno',' ',' ')?></span>
		  	</div>
		  	<br />

			<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="gotoQuery();">
				<a href="#" type="button" name="back" style="color: white;" id="Back">
					<i class="fa fa-check" >
					</i>
					Back
				</a>
			</span>
			<br>
			<button class="btn btn-danger" title="Delete" autocomplete="off" type="submit" value="Delete" name="delete" id="delete" Onclick="ConfirmDelete(event)">
				<i class="fa fa-arrows-alt"></i>
				Delete
			</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	(function blink() { 
		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
	})();

	function gotoQuery()
	{
		window.location = "<?=base_url()?>Investor.jsp/edit_secaccount";
	}

	parent.setIframeHeight('content');
	parent.waitingDialog.hide();
	
</script>

</html>