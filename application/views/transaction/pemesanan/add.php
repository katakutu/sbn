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
	<link rel="stylesheet" href="<?= base_url() ?>plugin/select2/select2.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-clockpicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/moment.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/autoNumeric.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>plugin/select2/select2.min.js"></script>
	<script type="text/javascript">
		 $(function () {
                  $('.select2').select2();
                  $('#getseriname').change(function(){
                  	   var MaxPemesanan,MinPemesanan,KelipatanPemesanan,KuotaInvestor,KuotaNasional;
                  	   $('#minorder').val();
                  	   $('#maxorder').val();
                  	   $('#multorder').val();
                  	   $('#seriname').val();
                  	   $('#seriid').val();
                  	   $('#quotorder').val();
                  	   $('#quotordernat').val();
                  	   $('#totorder').val();
                  	   var seri = $(this).val();
                  	   var pisah = seri.split("-");
                  	   <?php
                  	         foreach ($get_offer_seri as $key) { ?>
                  	         	var Seri = '<?php echo $key['Seri'];?>';
                  	         	
                  	         	if(Seri == pisah[0]){
                  	         		MaxPemesanan = '<?php echo $key['MaxPemesanan'];?>';
                  	         	    MinPemesanan = '<?php echo $key['MinPemesanan'];?>'; 
                  	         	    KelipatanPemesanan = '<?php echo $key['KelipatanPemesanan'];?>'; 
                  	         	} 
                  	    <?php      	
                  	         } 
                  	   ?>
                  	   var postData = {
					        'idseri': seri
					    };
                  	   $.ajax({
					        type: 'POST',
					        url: '<?=base_url()?>transaction/pemesanan/get_kuota_seri',
					        data: postData,
					        dataType: 'JSON',     
					        success: function(response)
					        {
					        	  KuotaInvestor = response["KuotaInvestor"];
					        	  KuotaNasional = response["KuotaNasional"];
					        	  $('#quotorder').val(KuotaInvestor);
                  	              $('#quotordernat').val(KuotaNasional);
					        	   
					        },
					        error: function(xhr) {
					        }
					    });
                  	    $.ajax({
					        type: 'POST',
					        url: '<?=base_url()?>transaction/pemesanan/count_total',
					        data: postData,
					        dataType: 'JSON',     
					        success: function(response)
					        {
					        	  $('#totorder').val(response);
					        	   
					        },
					        error: function(xhr) {
					        }
					    });
                  	   $('#seriname').val(pisah[0]);
                  	   $('#seriid').val(pisah[1]);
                  	   $('#minorder').val(MinPemesanan);
                  	   $('#maxorder').val(MaxPemesanan);
                  	   $('#multorder').val(KelipatanPemesanan);
                  	   
                  });
          });
	</script>
</head>

<style type="text/css">
	@media (max-width: 768px) {
		#rightform {
			display: none;
		}
	}
</style>

<script>
    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
</script>

<body oncontextmenu="return false" onload="window.history.forward();" onpageshow="if (event.persisted) noBack();">
	<div class="panel panel-primary">
		<h3 style="text-align: right; padding-right: 25px">
			<i class="fa fa-feed"></i> <b><?= $this->lang->line('pemesanan') ?></b>
		</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('pemesanan') ?></li>
				<li class="active"><?= $this->lang->line('add') ?></li>
			</ol>

			<div class="col-xs-12 col-sm-8 col-md-10">
			<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Pemesanan', 'id' => 'Pemesanan', 'class' => 'form', 'target' => 'content');
				echo form_open(base_url().'Pemesanan.jsp/add_confirm', $attributes); ?>
				
				<?php cetak_flash_msg(); ?>
				<div style="display: none;" id="frm1hidden">
					<input id="couponrate" name="couponrate" value="" type="hidden" />
					<input id="val_min" name="val_min" value="<?php if(isset($val_min))echo $val_min;?>" type="hidden" />
					<input id="val_max" name="val_max" value="<?php if(isset($val_max))echo $val_max;?>" type="hidden" />
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
					<span class="input-group-addon" id="addon-secaccountno"><?= $this->lang->line('secaccountno') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('secaccountno') ?>" aria-describedby="addon-secaccountno" id="secaccountno" name="secaccountno" required="required" value="<?php if(isset($secaccountno))echo $secaccountno;?>" readonly />
				</div>
				<div>
					
					<input type="hidden" id="secaccountid" name="secaccountid" value="<?php if(isset($secaccountid))echo $secaccountid;?>" />
					<span id="span_secaccountid" style="color:red; font-size:11px"><?=form_error('secaccountid',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group">
					<span class="input-group-addon" id="addon-fundaccountno"><?= $this->lang->line('fundaccountno') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('fundaccountno') ?>" aria-describedby="addon-fundaccountno" id="fundaccountno" name="fundaccountno" required="required" value="<?php if(isset($fundaccountno))echo $fundaccountno;?>" readonly />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('fundaccountno') ?>', 'ListFundAccount.jsp/FundAccount', 'show');" id="SEARCH_fundaccountno" name="SEARCH_fundaccountno">
							</i>
						</a>
					</span>
				</div>
				<div>

					<input type="hidden" id="fundaccountid" name="fundaccountid" value="<?php if(isset($fundaccountid))echo $fundaccountid;?>" />
					<input type="hidden" id="fundaccountname" name="fundaccountname" value="<?php if(isset($fundaccountname))echo $fundaccountname;?>" />
					<span id="span_fundaccountid" style="color:red; font-size:11px"><?=form_error('fundaccountid',' ',' ')?></span>
				</div>
				<br />
				<?php
				        //       echo '<pre>';
						      // print_r($get_offer_seri);
						      // echo '</pre>';
						      // exit();
			    ?>
				<div class="input-group">
					<span class="input-group-addon" id="addon-seriname"><?= $this->lang->line('seriname') ?>&nbsp;</span>
					<select id="getseriname" class="form-control select2">
						<option value=""><?=$this->lang->line('selected_option')?></option>
						<?php

						      foreach ($get_offer_seri as $key) {
						       	  echo '<option value="'.$key['Seri'].'-'.$key['Id'].'">'.$key['Seri'].'</option>';
						      } 
						?>
					</select>
					<!-- <input type="text" class="form-control" placeholder="<?= $this->lang->line('seriname') ?>" aria-describedby="addon-seriname" id="seriname" name="seriname" required value="<?php if(isset($seriname))echo $seriname;?>" onkeypress="return false;" autocomplete="off"/>
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('seriname') ?>', 'ListSeriOffer.jsp/SeriOffer', 'show');" id="SEARCH_seriname" name="SEARCH_seriname">
							</i>
						</a>
					</span> -->
				</div>
				<div>
					<span id="span_seriname" style="color:red; font-size:11px"><?=form_error('seriname',' ',' ')?></span>
					<input type="hidden" id="seriid" name="seriid" value="<?php if(isset($seriid))echo $seriid;?>" />
					<input type="hidden" class="form-control" id="seriname" name="seriname"/>
				</div>
				<br />

				<div id="panel-seri" class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title" align="center" style="font-size: 12px;"><?= $this->lang->line('seridetail') ?></h5>
					</div>
					<br/>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-minorder"><?= $this->lang->line('minorder') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('minorder') ?>" aria-describedby="addon-minorder" id="minorder" name="minorder" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-maxorder"><?= $this->lang->line('maxorder') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('maxorder') ?>" aria-describedby="addon-maxorder" id="maxorder" name="maxorder" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-multorder"><?= $this->lang->line('multorder') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('multorder') ?>" aria-describedby="addon-multorder" id="multorder" name="multorder" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-totorder"><?= $this->lang->line('totorder') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('totorder') ?>" aria-describedby="addon-totorder" id="totorder" name="totorder" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-quotorder"><?= $this->lang->line('quotorder') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('quotorder') ?>" aria-describedby="addon-quotorder" id="quotorder" name="quotorder" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
					<div class="panel-body">
						<div class="input-group input-group-sm">
							<span class="input-group-addon" id="addon-quotordernat"><?= $this->lang->line('quotordernat') ?>&nbsp;</span>
							<input type="text" class="form-control" placeholder="<?= $this->lang->line('quotordernat') ?>" aria-describedby="addon-quotordernat" id="quotordernat" name="quotordernat" readonly />
							<span class="input-group-addon">
								IDR
							</span>
						</div>
					</div>
				</div>
				
				<div class="input-group">
					<span class="input-group-addon" id="addon-amount"><?= $this->lang->line('amount') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('amount') ?>" aria-describedby="addon-amount" id="amount" name="amount" required value="<?php echo (!empty($post) ? (($post['amount'] <= $max_amount) ? $post['amount'] : 0) : ""); ?>" maxlength="30" />
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

<script type="text/javascript">
	jQuery(function($) {		
		$('#amount').autoNumeric({mDec: '0',vMin: 0, vMax: 100000000000000});
	});
	// var mpn = document.getElementById('mpngen'); 
	// $(document).ready(function(){
	// 	$("#testing").click(function(e) {
	// 		if(mpn.style.display === 'none'){
	// 	    	$("#mpngen").show();
	// 		}else{
	// 			$("#mpngen").hide();
	// 		}
	// 	    e.preventDefault();
	// 	    parent.setIframeHeight('content');
	// 	});
	// });
	window.history.forward();

    function noBack() { window.history.forward(); }

</script>

</html>