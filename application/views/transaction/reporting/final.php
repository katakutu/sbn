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
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('final transaction report') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('reporting') ?></a></li>
					<li><?= $this->lang->line('transaction report') ?></li>
					<li class="active"><?= $this->lang->line('final transaction report') ?></li>
				</ol>

				
				<br>
				<div class="panel-body">
					<div style="width: 100%;">
						<form method="post" action="<?php echo base_url();?>TransactionReport.jsp/final">
						
									<div style="width: 10%;float:left;margin-top: 10px;">Tanggal</div>
									<div style="width: 20%;float:left;">
										<input type="text" name="tgl" class="form-control datepicker">
									</div>
									<div style="width: 20%;float:left;">
										&nbsp;&nbsp; <button type="reset" class="btn btn-default">Reset</button> &nbsp;
										<input type="submit" name="cari" value="Search" class="btn btn-success">
									</div>
									<div style="width: 50%;float:left;"></div>
						</form>
					</div>
					<div class="table table-responsive">
		            	<table class="table table-striped table-bordered table-hover" id="final_reporting" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                        	<th style="text-align: center;"><?= $this->lang->line('ordercode') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('billcode') ?></th>
		                        	<th style="text-align: center;">NTPN</th>
		                        	<th style="text-align: center;">NTB</th>
		                        	<th style="text-align: center;"><?= $this->lang->line('order status') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('seri') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('distribution partner') ?></th>
		                        	<th style="text-align: center;">SID</th>
		                        	<th style="text-align: center;"><?= $this->lang->line('name') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('amount') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('accountno') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('id card no') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('place of birth') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('date of birth') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('gender') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('working') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('working') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('address') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('city_code') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('province_code') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('phone number') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('mobile phone number') ?></th>
		                        	<th style="text-align: center;">Email</th>
		                        	<th style="text-align: center;"><?= $this->lang->line('orderdate') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('securities accountno') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('bankid') ?></th>
		                        	<th style="text-align: center;">Kustodian</th>
					    		</tr>
							</thead>
		                    <tbody>
		                    	<?php
		                    	     if(count($data) > 0){
		                    	     	foreach ($data as $value) {
		                    	     		echo '<tr>
		                    	     				<td>'.$value['order_id'].'</td>
		                    	     				<td>'.$value['billing_code'].'</td>
		                    	     				<td>'.$value['ntpn'].'</td>
		                    	     				<td>'.$value['ntb'].'</td>
		                    	     				<td>'.$value['status'].'</td>
		                    	     				<td>'.$value['seri_name'].'</td>
		                    	     				<td>'.$value['created_by'].'</td>
		                    	     				<td>'.$value['sid'].'</td>
		                    	     				<td>'.$value['NAME'].'</td>
		                    	     				<td>'.$value['amount'].'</td>
		                    	     				<td>'.$value['NOMOR_REKENING'].'</td>
		                    	     				<td>'.$value['NOMOR_KTP'].'</td>
		                    	     				<td>'.$value['TEMPAT_LAHIR'].'</td>
		                    	     				<td>'.date('d-m-Y', strtotime($value['TANGGAL_LAHIR'])).'</td>
		                    	     				<td>'.$value['GENDER'].'</td>
		                    	     				<td>'.$value['PEKERJAAN'].'</td>
		                    	     				<td>'.$value['ALAMAT'].'</td>
		                    	     				<td>'.$value['KODE_KOTA'].'</td>
		                    	     				<td>'.$value['KODE_PROVINSI'].'</td>
		                    	     				<td>'.$value['NOMOR_TELEPON'].'</td>
		                    	     				<td>'.$value['NOMOR_HANDPHONE'].'</td>
		                    	     				<td>'.$value['EMAIL'].'</td>
		                    	     				<td>'.date('d-m-Y H:i:s', strtotime($value['creation_date'])).'</td>
		                    	     				<td>'.$value['sec_account_no'].'</td>
		                    	     				<td>'.$value['KODE_BANK'].'</td>
		                    	     				<td>'.$value['subreg_name'].'</td>
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
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/Responsive-2.2.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/Buttons-1.5.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/Responsive-2.2.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/bootstrap-datepicker.min.css">
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
    <script src="<?=base_url();?>js/bootstrap-datepicker.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">
    	$(function () {
    		$('.datepicker').datepicker({
    			format: 'yyyy-mm-dd',
    			autoclose: true
    		});
    		$('#final_reporting').DataTable({
    			responsive: true,
    			dom: 'lBfrtip',
    			buttons: [
    			     {
		                  text    : '<i class="fa fa-download"></i> XLS',
		                  extend  : 'excel'
		              },
		              {
		                  text    : '<i class="fa fa-download"></i> PDF',
		                  extend  : 'pdfHtml5',
		                  orientation: 'landscape',
		                  pageSize: 'LEGAL',
		              },
		              {
		                  text    : '<i class="fa fa-download"></i> CSV',
		                  extend  : 'csv'
		              }
    			]
    		});
    	});
    </script>
</html>