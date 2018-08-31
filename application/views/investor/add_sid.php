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
</head>
<style type="text/css">
	
	.table-responsive-topdown td, .table-responsive-topdown th{
		padding:5px;
	/*	color: #144069;*/
	}

</style>
<script type="text/javascript">

	$(document).ready(function(){
		gender();
	})
	
	jQuery(function($) {
		$('#USER_BIRTHDATE').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			startDate: '-100y',
			endDate: 'd',
			changeMonth: true,
			changeYear: true, 
		});
	});

	function type_business(e)
	{
		if (e)
		{
			document.getElementById("TYPE_BUSINESS").innerHTML = e.toUpperCase();
			document.getElementById("HID_TYPE_BUSINESS").value = e.toUpperCase();
		}
		else
		{
			document.getElementById("TYPE_BUSINESS").innerHTML = "BUSINESS";
			document.getElementById("HID_TYPE_BUSINESS").value = "BUSINESS";
		}
	}

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z.toUpperCase();
		}
	}

	function gender()
	{
		if(document.getElementById("HID_USER_INVESTOR_GENDER").value == '1')
		{
			document.getElementById('USER_INVESTOR_GENDER').value = '1';
		}
		else
		{
			document.getElementById('USER_INVESTOR_GENDER').value = '2';
		}
	}

	var briIbbiz=new Object();
	briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};
	briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};
	briIbbiz.isAlphaNum=function(e){return /^[A-Z0-9]+$/i.test(e.key);};
	briIbbiz.isAlphaNumSpasi=function(e){return /^[A-Z0-9 ]+$/i.test(e.key);};
	briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- .,()]+$");};

</script>

<body oncontextmenu="return false">
	<div class="panel panel-primary">
	<h3 style="text-align: right; padding-right: 25px">
		<i class="fa fa-feed"></i> <b><?= $this->lang->line('add_sid') ?></b>
	</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('sid') ?></a></li>
				<li class="active"><?= $this->lang->line('add_sid') ?></li>
			</ol>

            <?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');
			echo form_open(base_url().'Sid.jsp/insert_sid', $attributes); ?>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-wrap" id="form-wrap">

				<?php cetak_flash_msg(); ?>

				<!-- USER BK -->
				<div class="input-group input-group">
			  		<span class="input-group-addon" id="addon-USER_HANDPHONE">
						&nbsp;<?= $this->lang->line('kode_bank_kustodian') ?>&nbsp;
					</span>
				<input id="USER_BK" name="USER_BK" type="text" class="form-control" placeholder="<?= $this->lang->line('kode_bank_kustodian') ?>" aria-describedby="addon-USER_BK" required='required' value="BRI01" disabled readonly />
			  	</div>
				<div>
					<span id="ERROR_USER_BK" style="color:red; font-size:11px"><?=form_error('USER_BK',' ',' ')?></span>
				</div>
				<br />

				<!-- USER ACC -->
				<div class="input-group input-group">
			  		<span class="input-group-addon" id="addon-USER_ACC">
						&nbsp;<?= $this->lang->line('account_no') ?>&nbsp;
					</span>
					<input id="USER_ACC" name="USER_ACC" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('account_no') ?>" aria-describedby="addon-USER_ACC" required value="<?php echo (!empty($post) ? $post['NOMOR_REKENING'] : ""); ?>"  />
				</div>
				<div>
					<span id="ERROR_USER_ACC" style="color:red; font-size:11px"><?=form_error('USER_ACC',' ',' ')?></span>
				</div>
				<br />

				<!-- USER NAME -->
				<input id="HID_TYPE_USER_TITLE" name="HID_TYPE_USER_TITLE" type="hidden" value="MR" />
				<div class="input-group input-group">
					<div class="input-group-btn">
				        <button id="TYPE_USER_TITLE" name="TYPE_USER_TITLE" type="button" class="btn btn-default dropdown-toggle"><?= $this->lang->line('mr') ?></button>
				        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&nbsp;<span class="caret"></span>&nbsp;</button>
				        <ul class="dropdown-menu">
				          <li><a href="#" onClick="javascript:type_title('TYPE_USER_TITLE', '<?= $this->lang->line('mr') ?>', 'mr')"><?= $this->lang->line('mr') ?></a></li>
				          <li><a href="#" onClick="javascript:type_title('TYPE_USER_TITLE', '<?= $this->lang->line('mrs') ?>', 'mrs')"><?= $this->lang->line('mrs') ?></a></li>
				          <li><a href="#" onClick="javascript:type_title('TYPE_USER_TITLE', '<?= $this->lang->line('ms') ?>', 'ms')"><?= $this->lang->line('ms') ?></a></li>
				        </ul>
			      	</div>
					<input id="USER_NAME" name="USER_NAME" type="text" class="form-control" placeholder="<?= $this->lang->line('full name') ?>" aria-describedby="addon-USER_NAME" required maxlength="100" value="<?php echo $username; ?>" />
				</div>
				<div>
					<span id="ERROR_USER_NAME" style="color:red; font-size:11px"><?=form_error('USER_NAME',' ',' ')?></span>
				</div>
				<br />

				<!-- INVESTOR GENDER -->
				<div class="input-group input-group">
					<input id="HID_USER_INVESTOR_GENDER" name="HID_USER_INVESTOR_GENDER" type="hidden" value="<?php echo $gender ?>" />
			  		<span class="input-group-addon" id="addon-USER_INVESTOR_GENDER">
						&nbsp;<?= $this->lang->line('gender') ?>&nbsp;
					</span>
					<select id="USER_INVESTOR_GENDER" name="USER_INVESTOR_GENDER" class="form-control" aria-describedby="addon-USER_INVESTOR_GENDER" required>
						<option value="1"><?= $this->lang->line('male') ?></option>
					  	<option value="2"><?= $this->lang->line('female') ?></option>
					</select>
			  	</div>
				<div>
					<span id="ERROR_USER_INVESTOR_GENDER" style="color:red; font-size:11px"><?=form_error('USER_INVESTOR_GENDER',' ',' ')?></span>
				</div>
				<br />

				<!-- USER ID CARD -->
				<div class="input-group input-group">
			    <span class="input-group-addon" id="addon-USER_ID_CARD">
					&nbsp;<?= $this->lang->line('id card ktp') ?>&nbsp;
				</span>
		      	<input id="USER_ID_CARD" name="USER_ID_CARD" type="text" class="form-control" placeholder="<?= $this->lang->line('id card number') ?>" aria-describedby="addon-USER_ID_CARD" onkeypress="return briIbbiz.isNumberKey(event)" required minlength="15" maxlength="20" value="<?php echo $useridcard; ?>" />
		      	</div>
				<div>
					<span id="ERROR_USER_ID_CARD" style="color:red; font-size:11px"><?=form_error('USER_ID_CARD',' ',' ')?></span>
				</div>
				<br />

				<!-- NPWP -->
			  	<div class="input-group input-group">
		  		<span class="input-group-addon" id="addon-USER_NPWP">
					&nbsp;<?= $this->lang->line('npwp number') ?>&nbsp;
				</span>
					<input id="USER_NPWP" name="USER_NPWP" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('npwp number') ?>" aria-describedby="addon-USER_NPWP" onkeypress="return briIbbiz.isNumberKey(event)" minlength="15" maxlength="20" value="<?php echo $npwp; ?>" required/>
			  	</div>
			  	<div>
					<span id="ERROR_USER_NPWP" style="color:red; font-size:11px"><?=form_error('USER_NPWP',' ',' ')?></span>
			  	</div>
			  	<br />

			  	<!-- USER BIRTH PLACE -->
				<div class="input-group input-group">
			  		<span class="input-group-addon" id="addon-USER_BIRTHPLACE">
						&nbsp;<?= $this->lang->line('place of birth') ?>&nbsp;
					</span>
				<input id="USER_BIRTHPLACE" name="USER_BIRTHPLACE" type="text" class="form-control" placeholder="<?= $this->lang->line('place of birth') ?>" aria-describedby="addon-USER_BIRTHPLACE" required value="<?php echo (!empty($post) ? $post['TEMPAT_LAHIR'] : ""); ?>" />
			  	</div>
				<div>
					<span id="ERROR_USER_BIRTHPLACE" style="color:red; font-size:11px"><?=form_error('USER_BIRTHPLACE',' ',' ')?></span>
				</div>
				<br />

			  	<!-- USER BIRTH DATE -->
			  	<div class="input-group input-group">
		  		<span class="input-group-addon" id="addon-USER_BIRTHDATE">
					&nbsp;<?= $this->lang->line('tgl lahir') ?>&nbsp;
				</span>
				<input id="USER_BIRTHDATE" name="USER_BIRTHDATE" type="text" class="form-control" placeholder="<?= $this->lang->line('tgl lahir') ?>" aria-describedby="addon-USER_BIRTHDATE" required maxlength="100" value="<?php if(isset($userbirthdate))echo $userbirthdate;?>" />
			  	</div>
			  	<div>
					<span id="ERROR_USER_BIRTHDATE" style="color:red; font-size:11px"><?=form_error('USER_BIRTHDATE',' ',' ')?></span>
			  	</div>
			  	<br />
			  	
			  	<!-- USER NATIONALITY -->
				<div class="input-group input-group">
			  		<span class="input-group-addon" id="addon-USER_NATIONALITY">
						&nbsp;<?= $this->lang->line('nationality') ?>&nbsp;
					</span>
				<input id="nationality_name" name="nationality_name" type="text" class="form-control" placeholder="<?= $this->lang->line('nationality') ?>" aria-describedby="addon-USER_NATIONALITY" required value="" readonly/>
				<span class="input-group-addon">
					<a href="#">
						<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('nationality') ?>', 'ListProvinsi.jsp/KewarganegaraanDb', 'show');" id="SEARCH_USER_NATIONALITY" name="SEARCH_USER_NATIONALITY">
						</i>
					</a>
				</span>
			  	</div>
				<div>
					<span id="ERROR_USER_NATIONALITY" style="color:red; font-size:11px"><?=form_error('USER_NATIONALITY',' ',' ')?></span>
					<input type="hidden" id="nationality_code" name="nationality_code" value="<?php echo (!empty($post) ? $post['KEWARGANEGARAAN'] : ""); ?>" />
				</div>
				<br />

				<!-- INVESTOR TYPE -->
				<div class="input-group input-group">
			  		<span class="input-group-addon" id="addon-USER_INVESTOR_TYPE">
						&nbsp;<?= $this->lang->line('tipe_investor') ?>&nbsp;
					</span>
				<input id="USER_INVESTOR_TYPE" name="USER_INVESTOR_TYPE" type="text" class="form-control" placeholder="<?= $this->lang->line('tipe_investor') ?>" aria-describedby="addon-USER_INVESTOR_TYPE" required value="Individual" disabled readonly/>
			  	</div>
				<div>
					<span id="ERROR_USER_INVESTOR_TYPE" style="color:red; font-size:11px"><?=form_error('USER_INVESTOR_TYPE',' ',' ')?></span>
				</div>
				<br />

				<!-- INVESTOR JOB -->
				<div class="input-group input-group">
			  		<span class="input-group-addon" id="addon-typeofwork_name">
						&nbsp;<?= $this->lang->line('typeofwork_name') ?>&nbsp;
					</span>
					<input id="typeofwork_name" name="typeofwork_name" type="text" class="form-control" placeholder="<?= $this->lang->line('typeofwork_name') ?>" aria-describedby="addon-typeofwork_name" required readonly maxlength="25" value="<?php echo (!empty($post) ? $post['JENIS_PEKERJAAN'] : ""); ?>" />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('typeofwork_name') ?>', 'ListKdJenisPekerjaan.jsp/KdJenisPekerjaanDb', 'show');" id="SEARCH_typeofwork_name" name="SEARCH_typeofwork_name">
							</i>
						</a>
					</span>
			  	</div>
				<div>
					<span id="ERROR_typeofwork_name" style="color:red; font-size:11px"><?=form_error('typeofwork_name',' ',' ')?></span>
					<input id="typeofwork_code" name="typeofwork_code" type="hidden" value="<?php echo (!empty($post) ? $post['KODE_JENIS_PEKERJAAN'] : ""); ?>" />
				</div>
				<br />

				<!-- USER ADDRESS -->
			  	<div class="input-group input-group">
		  			<span class="input-group-addon" id="addon-USER_ADDRESS">
						&nbsp;<?= $this->lang->line('address') ?>&nbsp;
					</span>
					<input id="USER_ADDRESS" name="USER_ADDRESS" type="text" class="form-control" placeholder="<?= $this->lang->line('address') ?>" aria-describedby="addon-USER_ADDRESS" required maxlength="100" value="<?php echo $useraddress; ?>" />
			  	</div>
			  	<div>
					<span id="ERROR_USER_ADDRESS" style="color:red; font-size:11px"><?=form_error('USER_ADDRESS',' ',' ')?></span>
			  	</div>
			  	<br />	

				<!-- USER COUNTRY -->
			 <!--  	<div class="input-group input-group">
		  			<span class="input-group-addon" id="addon-USER_COUNTRY">
						&nbsp;<?= $this->lang->line('country') ?>&nbsp;
					</span>
					<input id="USER_COUNTRY" name="USER_COUNTRY" type="text" class="form-control" placeholder="<?= $this->lang->line('country') ?>" aria-describedby="addon-USER_COUNTRY" required readonly disabled maxlength="100" value="ID" />
			  	</div>
			  	<div>
					<span id="ERROR_USER_COUNTRY" style="color:red; font-size:11px"><?=form_error('USER_COUNTRY',' ',' ')?></span>
			  	</div>
			  	<br /> -->

			  	<!-- USER PROVINCE -->
			  	<div class="input-group">
					<span class="input-group-addon" id="addon-province">&nbsp;<?= $this->lang->line('province') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('province') ?>" aria-describedby="addon-province" id="province_name" name="province" required readonly value="<?php echo (!empty($post) ? $post['PROVINSI'] : ""); ?>" />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('province') ?>', 'ListProvinsi.jsp/ProvinsiDb', 'show');" id="SEARCH_province" name="SEARCH_province">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="ERROR_province" style="color:red; font-size:11px"><?=form_error('HID_province',' ',' ')?></span>
					<input type="hidden" id="province_code" name="province_code" value="<?php echo (!empty($post) ? $post['KODE_PROVINSI'] : ""); ?>" />
				</div>
				<br />

			  	<!-- INVESTOR CITY -->
				<div class="input-group">
					<span class="input-group-addon" id="addon-city"></i>&nbsp;<?= $this->lang->line('city') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('city') ?>" aria-describedby="addon-city" id="city" name="city" required value="<?php echo (!empty($post) ? $post['KOTA'] : ""); ?>" readonly />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('city') ?>', 'ListKota.jsp/KotaDb', 'show');" id="SEARCH_city" name="SEARCH_city">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="ERROR_city" style="color:red; font-size:11px"><?=form_error('HID_city',' ',' ')?></span>
					<input type="hidden" id="city_code" name="city_code" value="<?php echo (!empty($post) ? $post['KODE_KOTA'] : ""); ?>" />
				</div>
				<br />

			  	<!-- USER TELEPHONE -->
			  	<div class="input-group input-group">
		  			<span class="input-group-addon" id="addon-USER_TELEPHONE">
						&nbsp;<?= $this->lang->line('phone number') ?>&nbsp;
					</span>
					<input id="USER_TELEPHONE" name="USER_TELEPHONE" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('phone number') ?>" aria-describedby="addon-USER_TELEPHONE" onkeypress="return briIbbiz.isNumberKey(event)" maxlength="15" value="<?php echo $usertelephone; ?>" required />
			  	</div>
			 	<div>
					<span id="ERROR_USER_TELEPHONE" style="color:red; font-size:11px"><?=form_error('USER_TELEPHONE',' ',' ')?></span>
			  	</div>
			  	<br />

			  	<!-- USER HANDPHONE -->
			  	<div class="input-group input-group">
		  			<span class="input-group-addon" id="addon-USER_HANDPHONE">
						&nbsp;<?= $this->lang->line('mobile phone number') ?>&nbsp;
					</span>
					<input id="USER_HANDPHONE" name="USER_HANDPHONE" type="text" class="form-control numonly" placeholder="<?= $this->lang->line('mobile phone number') ?>" aria-describedby="addon-USER_HANDPHONE" required='required' value="<?php echo $userhandphone; ?>" required/>
			  	</div>
			  	<div>
					<span id="ERROR_USER_HANDPHONE" style="color:red; font-size:11px"><?=form_error('USER_HANDPHONE',' ',' ')?></span>
			  	</div>
			  	<br />

			  	<!-- USER EMAIL -->
			  	<div class="input-group input-group">
		  			<span class="input-group-addon" id="addon-USER_EMAIL">
						&nbsp;<?= $this->lang->line('email') ?>&nbsp;
					</span>
					<input id="USER_EMAIL" name="USER_EMAIL" type="email" class="form-control email" placeholder="<?= $this->lang->line('email') ?>" aria-describedby="addon-USER_EMAIL" required maxlength="254" value="<?php echo $useremail; ?>" />
			  	</div>
			  	<div>
					<span id="ERROR_USER_EMAIL" style="color:red; font-size:11px"><?=form_error('USER_EMAIL',' ',' ')?></span>
			  	</div>
				</div>
			  	<br />
			  
			  	<button class="btn btn-theme btn-block" title="Submit" type="submit" value="Submit" name="submit">
			  	<i class="fa fa-arrow-circle-right"></i>
				  	Submit
			  	</button>
			</form>
		</div>
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
		document.getElementById('USER_NAME').value = '<?= $username ?>';
		document.getElementById('USER_ID_CARD').value = '<?= $useridcard ?>';
		document.getElementById('USER_ADDRESS').value = '<?= $useraddress ?>';
		document.getElementById('USER_TELEPHONE').value = '<?= $usertelephone ?>';
		document.getElementById('USER_HANDPHONE').value = '<?= $userhandphone ?>';
		document.getElementById('USER_EMAIL').value = '<?= $useremail ?>';
		
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