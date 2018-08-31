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

		$('#dateofbirth').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			startDate: '-100y',
			changeMonth: true,
			changeYear: true, 
		});
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

	$(document).ready(function()
		{
			var base_url = "<?= base_url() ?>";
			$("#accountno").change(function()
			{
				var accountno = $("#accountno").val();
				parent.doInquiryAccount("Investor", base_url, accountno);
			});	
		});

	</script>

				<div class="panel-body">
				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Investor.jsp/edit_fundaccount2', $attributes); ?>
				
				<input type="hidden" id="id_rek" name="id_rek" value="<?= $id_rek; ?>"></input>
				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-sid"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('sid') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" value="<?= $sid ?>" required readonly='true'/>
				</div>
				<div>
					<span id="span_sid" style="color:red; font-size:11px"><?=form_error('sid',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-bankname"><i class="fa fa-bank"></i> <?= $this->lang->line('bankname') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('bankname') ?>" aria-describedby="addon-bankname" id="bankname" name="bankname" required="required" value="<?php if(isset($bank_name))echo $bank_name;?>" readonly='true' />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('bankname') ?>', 'ListKdBank.jsp/KdBank', 'show');" id="SEARCH_bankname" name="SEARCH_bankname">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="span_bankname" style="color:red; font-size:11px"><?=form_error('hid_bankname',' ',' ')?></span>
					<input type="hidden" id="bankid" name="bankid" value="<?php if(isset($bank_id))echo $bank_id;?>" />
				</div>
				<br />

			  	<div class="input-group input-group">
		  			<span class="input-group-addon" id="addon-accountno">
						<i class="fa fa-chevron-right"></i>&nbsp;<?= $this->lang->line('accountno') ?>&nbsp;
					</span>
					<input id="accountno" name="accountno" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('accountno') ?>" aria-describedby="addon-accountno" required="required" maxlength="15"  value="<?php if(isset($account_no))echo $account_no;?>" />
			  	</div>
			  	<div>
					<span id="span_accountno" style="color:red; font-size:11px"><?=form_error('accountno',' ',' ')?></span>
			  	</div>
			  	<br />

			  	<div class="input-group input-group">
					<span class="input-group-addon" id="addon-accountname"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('accountname') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('accountname') ?>" aria-describedby="addon-accountname" id="accountname" name="accountname" maxlength="70" value="<?php if(isset($account_name))echo $account_name;?>"  required />
				</div>
				<div>
					<span id="SPAN_accountname" style="color:red; font-size:11px"><?=form_error('accountname',' ',' ')?></span>
				</div>
				<br />
					<button class="btn btn-theme btn-block" title="Submit" autocomplete="off" type="submit" value="Submit" name="submit" id="submit">
						<i class="fa fa-arrow-circle-right"></i>
						Submit
					</button>
					<br>
					<button class="btn btn-danger" title="Delete" autocomplete="off" type="submit" value="Delete" name="delete" id="delete" Onclick="ConfirmDelete(event)">
						<i class="fa fa-arrows-alt"></i>
						Delete
					</button>
					</form>
				</div>

	<script type="text/javascript">
		(function blink() { 
    		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
		})();	

	    parent.setIframeHeight('content');
		parent.waitingDialog.hide();

	</script>

	
</html>