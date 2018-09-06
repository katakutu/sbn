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
		<style type="text/css">
			.panel-primary { border-color: black; }
			.modal-header {
				color: #fff;
			    padding:9px 15px;
			    border-bottom:1px solid #eee;
			    background-color: #ec971f;
			    -webkit-border-top-left-radius: 5px;
			    -webkit-border-top-right-radius: 5px;
			    -moz-border-radius-topleft: 5px;
			    -moz-border-radius-topright: 5px;
			     border-top-left-radius: 5px;
			     border-top-right-radius: 5px;
			 }
				 .rTable {
				  	display: block;
				  	width: 100%;
				  	font-size: 12px;
				}
				.rTableHeading, .rTableBody, .rTableFoot, .rTableRow{
				  	clear: both;
				}
				.rTableHead, .rTableFoot{
				  	background-color: #2339d8;
				  	font-weight: bold;
				  	color: #fff;
				}
				.rTableCell, .rTableHead {
				  	border: 1px solid #555;
				  	float: left;
				  	/*height: 17px;*/
				  	overflow: hidden;
				  	padding: 10px;
				}
				.rTable:after {
				  	 visibility: hidden;
				  	 display: block;
				  	 font-size: 0;
				  	 content: " ";
				  	 clear: both;
				  	 height: 0;
				}
		</style>
	</head>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('customer portofolio report') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('reporting') ?></a></li>
					<li><?= $this->lang->line('investor report') ?></li>
					<li class="active"><?= $this->lang->line('customer portofolio report') ?></li>
				</ol>

				
				<br>
				<div class="panel-body">
					<div>
						<div class="btn-group">
                             <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              Export <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url();?>InvestorReport.jsp/portofolio_export_xls" target="_blank" class="dropdown-item"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                            </ul>
                        </div>
					</div>
					<div class="table table-responsive">
		            	<table class="table table-striped table-bordered table-hover" id="portofolio_reporting" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                        	<th style="text-align: center;"><?= $this->lang->line('name') ?></th>
		                        	<th style="text-align: center;">SID</th>
		                        	<th style="text-align: center;"><?= $this->lang->line('subreg') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('portofolio amount') ?></th>
					    		</tr>
							</thead>
		                    <tbody>
		                    	<?php
		                    	     if(count($data) > 0){
		                    	     	$no = 1;
		                    	     	foreach ($data as $value) {
		                    	     		echo '<tr>
		                    	     				<td>'.$value['NAME'].'</td>
		                    	     				<td>'.$value['SID'].'</td>
		                    	     				<td>'.$value['SUBREG'].'</td>
		                    	     				<td style="text-align:center;"><a href="" data-toggle="modal" data-target="#detailPortofolio'.$no.'">'.$value['JUMLAH_PORTOFOLIO'].'</a></td>
		                    	     			  </tr>'; ?>
		                    	     			  <!-- Modal -->
												<div id="detailPortofolio<?=$no?>" class="modal fade" role="dialog">
												  <div class="modal-dialog">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title"><?php echo $this->lang->line('customer portofolio detail');?></h4>
												      </div>
												      <div class="modal-body">
												        	<?php
												        	      $query = $this->sbn_tambahan->get_portofolio_detail($value['uid']);
												        	      
												        	         $s = 1;
												        	         echo '<div class="rTable">
																			 <div class="rTableRow">
																			    <div class="rTableHead" style="width:8% !important;text-align:center;"><strong>No.</strong></div>
																			 	<div class="rTableHead" style="width:22% !important;text-align:center;"><strong>'.$this->lang->line('ordercode').'</strong></div>
																			 	<div class="rTableHead" style="width:18% !important;text-align:center;"><strong>'.$this->lang->line('d').'</strong></div>
																			 	<div class="rTableHead" style="width:22% !important;text-align:center;"><strong>'.$this->lang->line('amount').'</strong></div>
																			 	<div class="rTableHead" style="width:30% !important;text-align:center;"><strong>Status</strong></div>
																			 </div>';
												        	        foreach ($query as $key) {
												        	        	echo '<div class="rTableRow">
												        	              <div class="rTableCell" style="width:8% !important;">'.$s.'.</div>
												        	              <div class="rTableCell" style="width:22% !important;text-align:center;">'.$key['order_id'].'</div>
												        	              <div class="rTableCell" style="width:18% !important;text-align:center;">'.date('d-m-Y', strtotime($key['creation_date'])).'</div>
												        	              <div class="rTableCell" style="width:22% !important;text-align:right;">'.number_format($key['amount'],0,'.',',').'</div>
												        	              <div class="rTableCell" style="width:30% !important;">'.$key['status'].'</div>
												        	              </div>';
												        	              $s++;
												        	        }
												        	        echo '</div>';
												        	?>
												       
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
												      </div>
												    </div>

												  </div>
												</div>
		                    	 <?php
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
    		$('#portofolio_reporting').DataTable({
    			responsive: true,
    			language: {
			       lengthMenu: "<?= $this->lang->line('dt_show') ?> _MENU_ <?= $this->lang->line('dt_record') ?> <?= $this->lang->line('dt_per_page') ?>",
			       zeroRecords: "<?= $this->lang->line('dt_empty') ?>",
			       info: "<?= $this->lang->line('dt_show') ?> <?= $this->lang->line('dt_page') ?> _PAGE_ <?= $this->lang->line('dt_of') ?> _PAGES_ <?= $this->lang->line('dt_page') ?>",
			       infoEmpty: "<?= $this->lang->line('dt_empty') ?>",
			       infoFiltered: "<?= $this->lang->line('dt_filtered') ?> <?= $this->lang->line('dt_of') ?> _MAX_ <?= $this->lang->line('dt_record') ?>)",
			       search: "<?= $this->lang->line('dt_search') ?>",
			       processing: "<?= $this->lang->line('dt_processsing') ?>"
			    }
    		});
    	});
    </script>
</html>