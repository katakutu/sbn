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
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('customer statistic report') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('reporting') ?></a></li>
					<li><?= $this->lang->line('investor report') ?></li>
					<li class="active"><?= $this->lang->line('customer statistic report') ?></li>
				</ol>
				<div class="panel-body">
					<div>
						<div class="btn-group">
                             <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              Export <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url();?>InvestorReport.jsp/statistic_export_csv" target="_blank" class="dropdown-item"><i class="fa fa-file-code-o"></i> CSV</a></li>
                                <li><a href="<?php echo base_url();?>InvestorReport.jsp/statistic_export_xls" target="_blank" class="dropdown-item"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                                <li><a href="<?php echo base_url();?>InvestorReport.jsp/statistic_export_txt" target="_blank" class="dropdown-item"><i class="fa fa fa-file-text-o"></i> Txt</a></li>
                            </ul>
                        </div>
					</div>
					<div class="table table-responsive">
		            	<table class="table table-striped table-bordered table-hover" id="statistic_reporting" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                        	<th style="text-align: center;"><?= $this->lang->line('name') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('gender') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('email') ?></th>
		                        	<th style="text-align: center;"><?= ucwords($this->lang->line('id card number')) ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('npwp number') ?></th>
		                        	<th style="text-align: center;">SID</th>
		                        	<th style="text-align: center;">SUBREG</th>
		                        	<th style="text-align: center;"><?= $this->lang->line('address') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('phone number') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('mobile phone number') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('accountno') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('registration_date') ?></th>
					    		</tr>
							</thead>
		                    <tbody>
		                    	<?php
		                    	     if(count($data) > 0){
		                    	     	foreach ($data as $value) {
		                    	     		echo '<tr>
		                    	     				<td>'.$value['NAME'].'</td>
		                    	     				<td>'.$value['gender'].'</td>
		                    	     				<td>'.$value['email'].'</td>
		                    	     				<td>'.$value['idcard_no'].'</td>
		                    	     				<td>'.$value['NPWP'].'</td>
		                    	     				<td>'.$value['SID'].'</td>
		                    	     				<td>'.$value['SUBREG'].'</td>
		                    	     				<td>'.$value['address'].'</td>
		                    	     				<td>'.$value['phone_no'].'</td>
		                    	     				<td>'.$value['mobilephone_no'].'</td>
		                    	     				<td>'.$value['NOMOR_REKENING'].'</td>
		                    	     				<td style="text-align:center;">'.date('d-m-Y H:i:s', strtotime($value['creation_date'])).'</td>
		                    	     			  </tr>';
		                    	     	}
		                    	     }
		                    	?>
		                    </tbody>
		                </table>
					</div>
				</div>
            </div>
		</div>
 <bdi></bdi>	
	</body>
	<!-- DataTables JavaScript -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/Responsive-2.2.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/Buttons-1.5.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/Responsive-2.2.1/css/responsive.bootstrap.min.css">
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url();?>plugin/Responsive-2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url();?>plugin/Responsive-2.2.1/js/responsive.bootstrap.min.js"></script>
    <script src="<?=base_url();?>plugin/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url();?>plugin/Buttons-1.5.1/js/buttons.flash.min.js"></script>
    <script src="<?=base_url();?>plugin/JSZip-2.5.0/jszip.min.js"></script>
    <script src="<?=base_url();?>plugin/pdfmake-0.1.32/pdfmake.min.js"></script>
    <script src="<?=base_url();?>plugin/pdfmake-0.1.32/vfs_fonts.js"></script>
    <script src="<?=base_url();?>plugin/Buttons-1.5.1/js/buttons.html5.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">
    	$(function () {
    		$('#statistic_reporting').DataTable({
    			responsive: true,
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