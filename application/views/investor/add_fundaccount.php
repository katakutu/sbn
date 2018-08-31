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
		<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
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

			$('form').submit(function () {
		    // Bail out if the form contains validation errors
		    if ($.validator && !$(this).valid()) return;

		    var form = $(this);
		    $(this).find('input[type="submit"], button[type="submit"]').each(function (index) {
		        // Create a disabled clone of the submit button
		        $(this).clone(false).removeAttr('id').prop('disabled', true).insertBefore($(this));

		        // Hide the actual submit button and move it to the beginning of the form
		        $(this).hide();
		        form.prepend($(this));
		    });
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
	<style type="text/css">
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
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('fund account') ?></b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('fund account') ?></a></li>
					<li class="active"><?= $this->lang->line('add') ?></li>
				</ol>
				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Investor.jsp/add_fundaccount', $attributes); ?>
				<?php cetak_flash_msg(); ?>
					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-sid"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('sid') ?>&nbsp;</span>
						<input class="form-control" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" value='<?php if(isset($sid))echo $sid;?>' required readonly='true'/>
					</div>
					<div>
						<span id="span_sid" style="color:red; font-size:11px"><?=form_error('sid',' ',' ')?></span>
					</div>
					<br />
					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-bankname"><i class="fa fa-bank"></i> <?= $this->lang->line('bankname') ?>&nbsp;</span>
						<input type="text" class="form-control" placeholder="<?= $this->lang->line('bankname') ?>" aria-describedby="addon-bankname" id="bankname" name="bankname" required="required" readonly='true' value="PT. Bank Rakyat Indonesia (Persero) Tbk" readonly/>
					</div>
					<div>
						<span id="span_bankname" style="color:red; font-size:11px"><?=form_error('hid_bankname',' ',' ')?></span>
						<input type="hidden" id="bankid" name="bankid" value="42" />
					</div>
					<br />

				  	<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-accountno">
							<i class="fa fa-chevron-right"></i>&nbsp;<?= $this->lang->line('accountno') ?>&nbsp;
						</span>
						<input id="accountno" name="accountno" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('accountno') ?>" aria-describedby="addon-accountno" required="required" maxlength="15" value="<?php if(isset($NoRek))echo $NoRek;?>" />
				  	</div>
				  	<div>
						<span id="span_accountno" style="color:red; font-size:11px"><?=form_error('accountno',' ',' ')?></span>
				  	</div>
				  	<br />

				  	<div class="input-group input-group">
						<span class="input-group-addon" id="addon-accountname"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('accountname') ?>&nbsp;</span>
						<input class="form-control" placeholder="<?= $this->lang->line('accountname') ?>" aria-describedby="addon-accountname" id="accountname" name="accountname" maxlength="70" value='<?php if(isset($Nama))echo $Nama;?>' required/>
					</div>
					<div>
						<span id="SPAN_accountname" style="color:red; font-size:11px"><?=form_error('accountname',' ',' ')?></span>
					</div>
					<div class="col-xs-20 col-sm-12 col-md-15">
						<div class="disclaimer-order">
							<p style="text-transform: uppercase; text-align: center"><?= $this->lang->line('confirmation') ?></p>
				            <p><?= $this->lang->line('disclaimerinvestor') ?></p>
				            <div class="checkbox">
								<label class="checkbox">
									<input id="CB_AGREEMENT" name="CB_AGREEMENT" type="checkbox" required="required" /><?= $this->lang->line('i agree investor') ?>
								</label>
							</div>	
				        </div>
				        <br>
					</div>

					<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />

					<button class="btn btn-theme btn-block" title="Submit" autocomplete="off" type="submit" value="Submit" name="submit" id="submit">
						<i class="fa fa-arrow-circle-right"></i>
						Submit
					</button>
					</form>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		(function blink() { 
    		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
		})();

		$(document).ready(function() {
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