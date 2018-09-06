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
						<?php 
	                            $kunci = isset($_POST['tgl']) && $_POST['tgl'] !='' ? '/'.$_POST['tgl'] : '/';
	                    ?>
						<form method="post" action="<?php echo base_url();?>TransactionReport.jsp/final">
									<div style="width: 10%;float:left;margin-top: 10px;"><?=$this->lang->line('d')?></div>
									<div style="width: 20%;float:left;">
										<input type="text" name="tgl" class="form-control datepicker" value="<?php echo isset($_POST['tgl']) && $_POST['tgl']!='' ? $_POST['tgl'] : ''?>">
									</div>
									<div style="width: 20%;float:left;">
										&nbsp;&nbsp; <a href="<?php echo base_url();?>TransactionReport.jsp/final" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a> &nbsp;
										<input type="submit" name="cari" value="<?=$this->lang->line('search')?>" class="btn btn-success">
									</div>
									<div style="width: 50%;float:left;">
										<div class="btn-group" style="float: right;">
                                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            Export <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo base_url();?>TransactionReport.jsp/final_transaction_export_csv<?=$kunci?>" target="_blank" class="dropdown-item"><i class="fa fa-file-code-o"></i> CSV</a></li>
                                            <li><a href="<?php echo base_url();?>TransactionReport.jsp/final_transaction_export_xls<?=$kunci?>" target="_blank" class="dropdown-item"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                                            <li><a href="<?php echo base_url();?>TransactionReport.jsp/final_transaction_export_txt<?=$kunci?>" target="_blank" class="dropdown-item"><i class="fa fa fa-file-text-o"></i> Txt</a></li>
                                          </ul>
                                        </div>
									</div>
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
		                    	     				<td style"text-align:center;">'.$value['billing_code'].'</td>
		                    	     				<td>'.$value['ntpn'].'</td>
		                    	     				<td>'.$value['ntb'].'</td>
		                    	     				<td>'.$value['status'].'</td>
		                    	     				<td style"text-align:center;">'.$value['seri_name'].'</td>
		                    	     				<td>'.$value['created_by'].'</td>
		                    	     				<td>'.$value['sid'].'</td>
		                    	     				<td>'.$value['NAME'].'</td>
		                    	     				<td style"text-align:right;">'.number_format($value['amount'],0,'.',',').'</td>
		                    	     				<td>'.$value['NOMOR_REKENING'].'</td>
		                    	     				<td>'.$value['NOMOR_KTP'].'</td>
		                    	     				<td>'.$value['TEMPAT_LAHIR'].'</td>
		                    	     				<td style"text-align:center;">'.date('d-m-Y', strtotime($value['TANGGAL_LAHIR'])).'</td>
		                    	     				<td>'.(($value['GENDER'] == 1) ? 'Laki-laki' : 'Perempuan').'</td>
		                    	     				<td>'.$value['PEKERJAAN'].'</td>
		                    	     				<td>'.$value['ALAMAT'].'</td>
		                    	     				<td style"text-align:center;">'.$value['KODE_KOTA'].'</td>
		                    	     				<td style"text-align:center;">'.$value['KODE_PROVINSI'].'</td>
		                    	     				<td>'.$value['NOMOR_TELEPON'].'</td>
		                    	     				<td>'.$value['NOMOR_HANDPHONE'].'</td>
		                    	     				<td>'.$value['EMAIL'].'</td>
		                    	     				<td style"text-align:center;">'.date('d-m-Y H:i:s', strtotime($value['creation_date'])).'</td>
		                    	     				<td>'.$value['sec_account_no'].'</td>
		                    	     				<td style"text-align:center;">'.$value['KODE_BANK'].'</td>
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