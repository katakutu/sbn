<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="keyword">
<meta name="Description" content="description">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
	<head>
		<title>
			<?= $this->parameter_helper->header_app ?>
		</title>
		<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<meta keywords="" />
		<link rel="stylesheet" href="<?=base_url();?>css/font-awesome.css">
		<link rel="stylesheet" href="<?=base_url();?>plugin/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=base_url();?>plugin/tabmenu/style.css">
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap-datepicker.min.css">
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>plugin/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('manajemen_user_reactivation_link') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('manajemen') ?></a></li>
					<li class="active"><?= $this->lang->line('manajemen_user') ?></li>
					<li class="active"><?= $this->lang->line('manajemen_user_reactivation_link') ?></li>
				</ol>
				
				<div class="panel-body" style="margin-top: -20px;">
					<?php if ($this->session->flashdata('message') != '') { ?>
						<div id="message" class="alert alert-success" role="alert">
							 <span class="fa fa-check-circle" aria-hidden="true"></span>
							 <span class="sr-only">Info:</span>
							 <?= $this->session->flashdata('message') ?>
					   </div>
					<?php } ?>
					<?php if ($this->session->flashdata('error') != '') { ?>
						<div id="message" class="alert alert-danger" role="alert">
							 <span class="fa fa-warning" aria-hidden="true"></span>
							 <span class="sr-only">Info:</span>
							 <?= $this->session->flashdata('error') ?>
					   </div>
					<?php } ?>
					<div class="table table-responsive">
		            	<table class="table table-striped table-bordered table-hover" id="manajemen_activation" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                        	<th style="text-align: center;">No.</th>
		                        	<th style="text-align: center;">SID</th>
		                        	<th style="text-align: center;"><?= $this->lang->line('name') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('email') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('status') ?></th>
			        				<th style="text-align: center;">Action</th>
					    		</tr>
							</thead>
		                    <tbody>
		                    	<?php
		                    	     if(count($data) > 0){
		                    	     	$no = 1;
		                    	     	foreach ($data as $value) {
		                    	     		echo '<tr>
		                    	     				<td>'.$no.'.</td>
		                    	     				<td style="text-align:center;">'.$value['SID'].'</td>
		                    	     				<td>'.$value['TITLE'].' '.$value['NAME'].'</td>
		                    	     				<td>'.$value['EMAIL'].'</td>
		                    	     				<td style="text-align:center;">'.(($value['STATUS'] == 1) ? 'ACTIVE' : 'INACTIVE').'</td>
		                    	     				<td style="text-align:center;"><a href="'.base_url().'SendActivation.jsp/send/'.$value['ID'].'" class="btn btn-success"><i class="fa fa-paper-plane"></i> '.$this->lang->line('send_link_activation').'</a></td>
		                    	     			  </tr>';
		                    	     		$no++;
		                    	     	}
		                    	     }
		                    	?>
		                    </tbody>
		                </table>
					</div>
				</div>
            </div>
		</div>
	</body>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/responsive.bootstrap.min.css">
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url();?>js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url();?>js/responsive.bootstrap.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">
    	$(function () {
    		$('#manajemen_activation').DataTable({
    			language: {
			       lengthMenu: "<?= $this->lang->line('dt_show') ?> _MENU_ <?= $this->lang->line('dt_record') ?> <?= $this->lang->line('dt_per_page') ?>",
			       zeroRecords: "<?= $this->lang->line('dt_empty') ?>",
			       info: "<?= $this->lang->line('dt_show') ?> <?= $this->lang->line('dt_page') ?> _PAGE_ <?= $this->lang->line('dt_of') ?> _PAGES_ <?= $this->lang->line('dt_page') ?>",
			       infoEmpty: "<?= $this->lang->line('dt_empty') ?>",
			       infoFiltered: "<?= $this->lang->line('dt_filtered') ?> <?= $this->lang->line('dt_of') ?> _MAX_ <?= $this->lang->line('dt_record') ?>)",
			       search: "<?= $this->lang->line('dt_search') ?>",
			       processing: "<?= $this->lang->line('dt_processsing') ?>",
			       paginate:{
			       	  previous: "<?= $this->lang->line('dt_previous') ?>",
			       	  next: "<?= $this->lang->line('dt_next') ?>"
			       }
			   }
    		});
    	});
    </script>
</html>