<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		iBBIZ BRI
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
</head>
<style type="text/css">
	
	.table-responsive-topdown td, .table-responsive-topdown th{
		padding:5px;
	/*	color: #144069;*/
	}

</style>
<script type="text/javascript">

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z.toUpperCase();
		}
	}

</script>

<body oncontextmenu="return false">
	<div class="panel panel-primary">
	<h3 style="text-align: right; padding-right: 25px">
		<i class="fa fa-feed"></i> <b><?= $this->lang->line('profile management') ?></b>
	</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('home') ?></a></li>
				<li><?= $this->lang->line('personalize') ?></li>
				<li class="active"><?= $this->lang->line('profile management') ?></li>
			</ol>
			<?php if ($message) { ?>
            <div id="message" class="alert alert-<?= $msg_type ?>" role="alert">
	            <span class="glyphicon glyphicon-<?= $msg_icon ?>" aria-hidden="true"></span>
	            <span class="sr-only">Info:</span>
	            <?= $this->lang->line($message) ?>.&nbsp;<?= $this->lang->line($additional) ?>
            </div>
            <?php } ?>
            <?php cetak_flash_msg(); ?>
            <?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');
			echo form_open(base_url().'Personalize.jsp/confirm_profile', $attributes); ?>

			<div class="col-xs-12 col-sm-8 col-md-10">
				<div class="form-wrap" id="form-wrap">
					<!-- USER NAME -->
				  	<input id="HID_TYPE_USER_TITLE" name="HID_TYPE_USER_TITLE" type="hidden" value="MR" />
					<div class="input-group input-group">
						<span class="input-group-addon" id="TYPE_USER_TITLE"></span>
						<input id="USER_NAME" name="USER_NAME" type="text" class="form-control" placeholder="<?= $this->lang->line('full name') ?>" aria-describedby="addon-USER_NAME" required="required" maxlength="100" value="<?php echo $username; ?>" readonly />
					</div>
					<div>
						<span id="ERROR_USER_NAME" style="color:red; font-size:11px"><?=form_error('USER_NAME',' ',' ')?></span>
					</div>
					<br />

					<!-- USER BIRTH PLACE -->
				  	<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-USER_BIRTHPLACE">
							<?= $this->lang->line('place of birth') ?>&nbsp;
						</span>
						<input id="USER_BIRTHPLACE" name="USER_BIRTHPLACE" type="text" class="form-control" placeholder="<?= $this->lang->line('place of birth') ?>" aria-describedby="addon-USER_BIRTHPLACE" required="required" maxlength="100" value="<?php if(isset($userbirthplace))echo $userbirthplace;?>" readonly/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_BIRTHPLACE" style="color:red; font-size:11px"><?=form_error('USER_BIRTHPLACE',' ',' ')?></span>
				  	</div>
				  	<br />

				  	<!-- USER BIRTH DATE -->
				  	<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-USER_BIRTHDATE">
							<?= $this->lang->line('tgl lahir') ?>&nbsp;
						</span>
						<input id="USER_BIRTHDATE" name="USER_BIRTHDATE" type="text" class="form-control" placeholder="<?= $this->lang->line('tgl lahir') ?>" aria-describedby="addon-USER_BIRTHDATE" required="required" maxlength="100" value="<?php if(isset($userbirthdate))echo $userbirthdate;?>" readonly/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_BIRTHDATE" style="color:red; font-size:11px"><?=form_error('USER_BIRTHDATE',' ',' ')?></span>
				  	</div>
				  	<br />

				  	<!-- USER ID CARD -->
				  	<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-USER_ID_CARD">
							<?= $this->lang->line('id card ktp') ?>&nbsp;
						</span>
						<input id="USER_ID_CARD" name="USER_ID_CARD" type="text" class="form-control" placeholder="<?= $this->lang->line('id card ktp') ?>" aria-describedby="addon-USER_ID_CARD" required="required" readonly maxlength="16" value="<?php if(isset($useridcard))echo $useridcard;?>"/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_ID_CARD" style="color:red; font-size:11px"><?=form_error('USER_ID_CARD',' ',' ')?></span>
				  	</div>
				  	<br />

				  	<!-- USER ID CARD EXPIRED -->
					<div class="input-group input-group">
				  		<span class="input-group-addon" id="addon-USER_ID_CARD_EXPIRED">
							<?= $this->lang->line('id card expiry date') ?>&nbsp;
						</span>
						<input id="USER_ID_CARD_EXPIRED" name="USER_ID_CARD_EXPIRED" type="text" class="form-control" placeholder="<?= $this->lang->line('id card expiry date') ?>" aria-describedby="addon-USER_ID_EXPIRED" required="required" value="<?php if(isset($useridcardexpired))echo $useridcardexpired;?>" readonly/>
					</div>
					<div>
						<span id="ERROR_USER_ID_CARD_EXPIRED" style="color:red; font-size:11px"><?=form_error('USER_ID_CARD_EXPIRED',' ',' ')?></span>
					</div>
					<br />

					<!-- USER NATIONALITY -->
					<div class="input-group input-group">
				  		<span class="input-group-addon" id="addon-USER_NATIONALITY">
							&nbsp;<?= $this->lang->line('nationality') ?>&nbsp;
						</span>
					<input id="nationality_name" name="nationality_name" type="text" class="form-control" placeholder="<?= $this->lang->line('nationality') ?>" aria-describedby="addon-USER_NATIONALITY" required value="<?php if(isset($usernationality))echo $usernationality;?>" readonly/>
				  	</div>
					<div>
						<span id="ERROR_USER_NATIONALITY" style="color:red; font-size:11px"><?=form_error('USER_NATIONALITY',' ',' ')?></span>
					</div>
					<br />

					<!-- NPWP -->
				  	<div class="input-group input-group">
			  		<span class="input-group-addon" id="addon-USER_NPWP">
						&nbsp;<?= $this->lang->line('npwp number') ?>&nbsp;
					</span>
						<input id="USER_NPWP" name="USER_NPWP" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('npwp number') ?>" aria-describedby="addon-USER_NPWP" onkeypress="return briIbbiz.isNumberKey(event)" minlength="15" maxlength="20" value="<?php if(isset($usernpwp))echo $usernpwp;?>" required readonly/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_NPWP" style="color:red; font-size:11px"><?=form_error('USER_NPWP',' ',' ')?></span>
				  	</div>
				  	<br />

				  	<!-- INVESTOR JOB -->
					<div class="input-group input-group">
				  		<span class="input-group-addon" id="addon-typeofwork_name">
							&nbsp;<?= $this->lang->line('typeofwork_name') ?>&nbsp;
						</span>
						<input id="typeofwork_name" name="typeofwork_name" type="text" class="form-control" placeholder="<?= $this->lang->line('typeofwork_name') ?>" readonly aria-describedby="addon-typeofwork_name" required maxlength="25" value="<?php if(isset($userposition))echo $userposition;?>" />
						<span class="input-group-addon">
							<a href="#">
								<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('typeofwork_name') ?>', 'ListKdJenisPekerjaan.jsp/KdJenisPekerjaan', 'show');" id="SEARCH_typeofwork_name" name="SEARCH_typeofwork_name">
								</i>
							</a>
						</span>
				  	</div>
					<div>
						<span id="ERROR_typeofwork_name" style="color:red; font-size:11px"><?=form_error('typeofwork_name',' ',' ')?></span>
					</div>
					<br />

				  	<!-- USER ADDRESS -->
			  		<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-USER_ADDRESS">
							<?= $this->lang->line('address') ?>&nbsp;
						</span>
						<input id="USER_ADDRESS" name="USER_ADDRESS" type="text" class="form-control" placeholder="<?= $this->lang->line('address') ?>" aria-describedby="addon-USER_ADDRESS" required="required" maxlength="100" value="<?php echo $useraddress; ?>"/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_ADDRESS" style="color:red; font-size:11px"><?=form_error('USER_ADDRESS',' ',' ')?></span>
				  	</div>
				  	<br />
						
				  	<!-- USER TELEPHONE -->
				  	<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-USER_TELEPHONE">
							<?= $this->lang->line('phone number') ?>&nbsp;
						</span>
						<input id="USER_TELEPHONE" name="USER_TELEPHONE" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('phone number') ?>" aria-describedby="addon-USER_TELEPHONE" onkeypress="return briIbbiz.isNumberKey(event)" maxlength="15" value="<?php echo $usertelephone; ?>"/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_TELEPHONE" style="color:red; font-size:11px"><?=form_error('USER_TELEPHONE',' ',' ')?></span>
				  	</div>
				  	<br />

				  	<!-- USER HANDPHONE -->
				  	<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-USER_HANDPHONE">
							<?= $this->lang->line('mobile phone number') ?>&nbsp;
						</span>
						<input id="USER_HANDPHONE" name="USER_HANDPHONE" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('mobile phone number') ?>" aria-describedby="addon-USER_HANDPHONE" required='required' value="<?php echo $userhandphone; ?>"/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_HANDPHONE" style="color:red; font-size:11px"><?=form_error('USER_HANDPHONE',' ',' ')?></span>
				  	</div>
				  	<br />

				  	<!-- USER EMAIL -->
				  	<div class="input-group input-group">
			  			<span class="input-group-addon" id="addon-USER_EMAIL">
							<?= $this->lang->line('email') ?>&nbsp;
						</span>
						<input id="USER_EMAIL" name="USER_EMAIL" type="email" class="form-control email" placeholder="<?= $this->lang->line('email') ?>" aria-describedby="addon-USER_EMAIL" required="required" maxlength="254" value="<?php echo $useremail; ?>"/>
				  	</div>
				  	<div>
						<span id="ERROR_USER_EMAIL" style="color:red; font-size:11px"><?=form_error('USER_EMAIL',' ',' ')?></span>
				  	</div>
					</div>
					<br>
				</div>
			<div class="col-xs-12 col-sm-8 col-md-10">
			  <br />
			  <button class="btn btn-theme btn-block" title="Submit" type="submit" value="Submit" name="submit">
			  <i class="fa fa-arrow-circle-right"></i>
				  Submit
			  </button>
			</div>
			</form>
		</div>
		<div class="panel-footer"></div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		    $(".numonly").keydown(function (e) {
		    	if ($.inArray(e.keyCode, [46, 8, 9, 13]) !== -1 || 
                 // Allow: Ctrl+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 40) ||
                // Allow : numelock number
                (e.keyCode >= 96 && e.keyCode <= 105)) {
                     // let it happen, don't do anything
                     return;
	            }
	            if (e.which < 48 ||  e.which > 57)
	                return false;
	            
	            return true;
		    });  
			});
	</script>

	<script type="text/javascript">
		type_title('TYPE_USER_TITLE', '<?= $this->lang->line(strtolower($usertitle)) ?>', '<?= strtolower($usertitle) ?>');

		<?php if ($message) { ?>
		    $("#message").fadeTo(10000, 10000).slideUp(1000, function(){
		       $("#message").slideUp(1000);
		    });
		<?php } ?>

		$('#popoverToken').popover();
		
	</script>

</body>
</html>