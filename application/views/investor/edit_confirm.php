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

	<style type="text/css">
	.table-responsive-topdown td, .table-responsive-topdown th{
	padding:5px;
/*	color: #144069;*/
		}
	</style>

</head>
<body oncontextmenu="return false">
	<div class="panel panel-primary">
		<h3 style="text-align: right; padding-right: 25px">
			<i class="fa fa-feed"></i> <b><?= $this->lang->line('transfer bri') ?></b>
		</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('transfer') ?></a></li>
				<li><?= $this->lang->line('transfer bri') ?></li>
				<li class="active"><?= $this->lang->line('edit') ?></li>
			</ol>
			<div class="col-xs-12 col-sm-8 col-md-10">
			<div class="form-wrap" id="form-wrap">
				<?php cetak_flash_msg(); ?>
				<?php $attributes = array('name' => 'Transfer', 'id' => 'Transfer', 'class' => 'form', 'target' => 'content');
				echo form_open(base_url().'TransferBRI.jsp/confirm', $attributes); ?>

				<input type="hidden" id="DEBIT_ACCOUNT" name="DEBIT_ACCOUNT" value="<?= $debitaccount; ?>"></input>
				<input type="hidden" id="DEBIT_ACCOUNT_NAME" name="DEBIT_ACCOUNT_NAME" value="<?= $debitaccountname; ?>"></input>
				<input type="hidden" id="CREDIT_ACCOUNT" name="CREDIT_ACCOUNT" value="<?= $creditaccount; ?>"></input>
				<input type="hidden" id="CREDIT_ACCOUNTNAME" name="CREDIT_ACCOUNT_NAME" value="<?= $creditaccountname; ?>"></input>
				<input type="hidden" id="EMAIL" name="EMAIL" value="<?= $email ?>"></input>
				<input type="hidden" id="CURRENCY" name="CURRENCY" value="<?= $currency ?>"></input>
				<input type="hidden" id="AMOUNT" name="AMOUNT" value="<?= $amount ?>"></input>
				<input type="hidden" id="REMARK" name="REMARK" value="<?= $remark ?>"></input>

				<input type="hidden" id="SCHEDULE_TYPE" name="SCHEDULE_TYPE" value="<?= $scheduletype; ?>"></input>
				<input type="hidden" id="SCH_DATE" name="SCH_DATE" value="<?= $schdate;?>"></input>
				<input type="hidden" id="SCH_TIME" name="SCH_TIME" value="<?= $schtime;?>"></input>
				<input type="hidden" id="SCH_RECUR_1" name="SCH_RECUR_1" value="<?= $schrecur1;?>"></input>
				<input type="hidden" id="SCH_RECUR_2" name="SCH_RECUR_2" value="<?= $schrecur2;?>"></input>
				<input type="hidden" id="SCH_RECUR_3" name="SCH_RECUR_3" value="<?= $schrecur3;?>"></input>
				<input type="hidden" id="SCH_RECURRING_DAY" name="SCH_RECURRING_DAY" value="<?= $schrecurday;?>"></input>

				<input type="hidden" id="ACTIVITY_TYPE" name="ACTIVITY_TYPE" value="2"></input>
				<input type="hidden" id="ACTIVITY_ID" name="ACTIVITY_ID" value="<?= $id ?>"></input>
				
				<div style="padding-left:15px; font-size: 12px">
				<h4  style="color:#144069"><strong><?= $this->lang->line('confirmation_data') ?></strong></h4>
				<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
					<tbody>
						<tr>
							<th align="left" width="15px"><i class="fa fa-chevron-right"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('debit_account') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $debitaccount ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-user"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('debit_account_name') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $debitaccountname ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-chevron-right"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('credit_account') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $creditaccount ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-user"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('credit_account_name') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $creditaccountname ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-envelope"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('email') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $email ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-dollar"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('currency') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $currency ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-money"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('amount') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $amount ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-chevron-right"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('remark') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><?= $remark ?></th>
						</tr>
						<tr>
							<th align="left" width="15px"><i class="fa fa-calendar"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('schedule_type') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><span id="schedule-type"></span></th>
						</tr>
						<tr id="PANEL-SCHEDULED-DATE" style="display: none;">
							<th align="left" width="15px"><i class="fa fa-calendar-o"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('d') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><span id="scheduled-date"></span></th>
						</tr>
						<tr id="PANEL-SCHEDULED-TIME" style="display: none;">
							<th align="left" width="15px"><i class="fa fa-clock-o"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('h') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><span id="scheduled-time"></span></th>
						</tr>
						<tr id="PANEL-RECURRING-DATE-START" style="display: none;">
							<th align="left" width="15px"><i class="fa fa-calendar-o"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('d_start') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><span id="recurring-date-start"></span></th>
						</tr>
						<tr id="PANEL-RECURRING-DATE-END" style="display: none;">
							<th align="left" width="15px"><i class="fa fa-calendar-o"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('d_end') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><span id="recurring-date-end"></span></th>
						</tr>
						<tr id="PANEL-RECURRING-DATE" style="display: none;">
							<th align="left" width="15px"><i class="fa fa-calendar-o"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('d') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><span id="recurring-date"></span></th>
						</tr>
						<tr id="PANEL-RECURRING-DAY" style="display: none;">
							<th align="left" width="15px"><i class="fa fa-calendar-o"></i></th>
							<th align="left" width="200px"><?= $this->lang->line('D') ?></th>
							<th align="center" width="10px">:</th>
							<th align="left" class="td-responsive"><span id="recurring-day"></span></th>
						</tr>
					</tbody>
				</table>
				</div>

			<br />
			<button class="btn btn-theme btn-block" title="<?= $this->lang->line('confirm') ?>" type="submit" value="Submit" name="submit">
				<i class="fa fa-arrow-circle-right"></i>
				<?= $this->lang->line('confirm') ?>
			</button>
			<br />
			<button class="btn btn-theme btn-danger" title="<?= $this->lang->line('reject') ?>" type="submit" value="Submit" name="submit" onclick="javascript:change_activity();" >
				<i class="fa fa-arrow-circle-remove"></i>
				<?= $this->lang->line('reject') ?>
			</button>
			<br />
			<!-- <button class="btn btn-theme btn-default" title="<?= $this->lang->line('back') ?>" value="Back" name="back" onclick="history.go(-1); return false;" >
				<i class="fa fa-arrow-circle-left"></i>
				<?= $this->lang->line('back') ?>
			</button> -->
			<a class="btn btn-theme btn-default" title="<?= $this->lang->line('cancel') ?>" value="Cancel" name="cancel" href="<?php echo base_url('TransferBRI.jsp/edit'); ?>" >
				<i class="fa fa-arrow-circle-left"></i>
				<?= $this->lang->line('cancel') ?>
			</a>
			</form>
			</div>
			</div>
		</div>
		<div class="panel-footer"></div>
	</div>
</body>

<script type="text/javascript">

	schedule(document.getElementById('SCHEDULE_TYPE').value);

	function schedule(type)
	{
		if (type == 1) 
		{
			$(document).ready(function(){
			$("#schedule-type").html("<?= $this->lang->line('sch-immediate') ?>");
			});
		}
		else if (type == 2)
		{
			$(document).ready(function(){
			$("#schedule-type").html("<?= $this->lang->line('sch-scheduled') ?>");
			$("#scheduled-date").html("<?= $schdate ?>");
			$("#scheduled-time").html("<?= $schtime ?>");
			});
			document.getElementById('PANEL-SCHEDULED-DATE').style.display = 'table-row';
			document.getElementById('PANEL-SCHEDULED-TIME').style.display = 'table-row';
		}
		else if (type == 31)
		{
			$(document).ready(function(){
			$("#schedule-type").html("<?= $this->lang->line('sch-recurring') ?>");
			$("#recurring-date-start").html("<?= $schrecur1 ?>");
			$("#recurring-date-end").html("<?= $schrecur2 ?>");
			$("#recurring-date").html("<?= $schrecur3 ?>");
			});
			document.getElementById('PANEL-RECURRING-DATE-START').style.display = 'table-row';
			document.getElementById('PANEL-RECURRING-DATE-END').style.display = 'table-row';
			document.getElementById('PANEL-RECURRING-DATE').style.display = 'table-row';
		}
		else if (type == 32) 
		{
			$(document).ready(function(){
			$("#schedule-type").html("<?= $this->lang->line('sch-recurring') ?>");
			});
			document.getElementById('PANEL-RECURRING-DAY').style.display = 'table-row';
			var day = "<?= $schrecurday ?>";
			if (day == "1")
			{
				$(document).ready(function(){
				$("#recurring-day").html("<?= $this->lang->line('sunday') ?>");
				});
			}
			else if (day == "2")
			{
				$(document).ready(function(){
				$("#recurring-day").html("<?= $this->lang->line('monday') ?>");
				});
			}
			else if (day == "3")
			{
				$(document).ready(function(){
				$("#recurring-day").html("<?= $this->lang->line('tuesday') ?>");
				});
			}
			else if (day == "4")
			{
				$(document).ready(function(){
				$("#recurring-day").html("<?= $this->lang->line('wednesday') ?>");
				});
			}
			else if (day == "5")
			{
				$(document).ready(function(){
				$("#recurring-day").html("<?= $this->lang->line('thursday') ?>");
				});
			}
			else if (day == "6")
			{
				$(document).ready(function(){
				$("#recurring-day").html("<?= $this->lang->line('friday') ?>");
				});
			}
			else
			{
				$(document).ready(function(){
				$("#recurring-day").html("<?= $this->lang->line('saturday') ?>");
				});
			}
		}
	}

	function change_activity()
	{
		document.getElementById('ACTIVITY_TYPE').value = '5';
	}

</script>
</html>