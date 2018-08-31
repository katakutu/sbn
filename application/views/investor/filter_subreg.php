<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="keyword">
<meta name="Description" content="description">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
	<head>
		<title>
			iBBIZ BRI
		</title>
		<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<meta keywords="" />
		<link rel="stylesheet" href="<?=base_url();?>css/font-awesome.css">
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap.css">
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap-datepicker.min.css">
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datepicker.min.js"></script>
	</head>
	<script type="text/javascript">
	jQuery(function($) {

		$('#dateofbirth').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		});
	});

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('subreg') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('subreg') ?></a></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>
				<?php cetak_flash_msg(); ?>
				<div class="panel-body" id="form-wrap">
					<div class="dataTable_wrapper table">
		            	<table class="table table-striped table-bordered table-hover" id="ListInvestor" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
			        				<th><?= $this->lang->line('sid_subreg') ?></th>
			        				<th><?= $this->lang->line('full name') ?></th>
			        				<th><?= $this->lang->line('subregid') ?></th>
			        				<th>Action</th>
					    		</tr>
							</thead>
		                    <tbody id="tbodyinves"></tbody>
		                </table>
					</div>
				</div>
				</div>
				<input type="hidden" value="" name="placeofbirth" id="placeofbirth" />
				<input type="hidden" value="" name="gender" id="gender" />
				<input type="hidden" value="" name="working" id="working" />
				<input type="hidden" value="" name="city" id="city" />
				<input type="hidden" value="" name="province" id="province" />
				<input type="hidden" value="" name="address" id="address" />
				<input type="hidden" value="" name="phonenumber" id="phonenumber" />
				<input type="hidden" value="" name="mobilephonenumber" id="mobilephonenumber" />
				<input type="hidden" value="" name="email" id="email" />
				<input type="hidden" value="" name="status" id="status" />
				<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
            </div>
		</div>
	</body>
	<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>plugin/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    var token = document.getElementById('token').value;
    $(document).ready(function() {
        
	    var postData = {
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

	    var table = $('#ListInvestor').DataTable({
	        "responsive"   : true,
	        "processing"   : true,
	        "serverSide"   : true,
	        "paging":   true,
	        "searching": true,
	        "ajax"   : {
	            url : "<?=base_url();?>Subreg.jsp/query_filter",
	            type: "post",
	            data: postData
	        },
	        //Set column definition initialisation properties.
	        "columnDefs": [
	        	{ 
	                "targets": [ 0,1,2,3 ],
	                "visible"	: true,
	            },
	            { 
	                "targets": [ 0 ], //last column
	                "orderable": false, //set not orderable
	                "searchable" : false,
	            },
	            { 
	                "targets": [ -2 ],
	                "orderable": false,
	                "visible"	: false,
	            }
	        ],        
	        "language": {
	            "lengthMenu": "<?= $this->lang->line('dt_show') ?> _MENU_ <?= $this->lang->line('dt_record') ?> <?= $this->lang->line('dt_per_page') ?>",
	            "zeroRecords": "<?= $this->lang->line('dt_empty') ?>",
	            "info": "<?= $this->lang->line('dt_show') ?> <?= $this->lang->line('dt_page') ?> _PAGE_ <?= $this->lang->line('dt_of') ?> _PAGES_ <?= $this->lang->line('dt_page') ?>",
	            "infoEmpty": "<?= $this->lang->line('dt_empty') ?>",
	            "infoFiltered": "<?= $this->lang->line('dt_filtered') ?> <?= $this->lang->line('dt_of') ?> _MAX_ <?= $this->lang->line('dt_record') ?>)",
	            "search": "<?= $this->lang->line('dt_search') ?>",
	            "processing": "<?= $this->lang->line('dt_processsing') ?>",
	        },
	        "initComplete": function( oSettings ) {
		    	parent.setIframeHeight('content');
		    },
	        "drawCallback": function( oSettings ) {
		    	parent.setIframeHeight('content');
		    },
	    });
	});

	function getTransaction(user_validator, id)
	{
		parent.waitingDialog.show();

		var postData = {
			'user_validator' : user_validator,
			'identifier': id,
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

		$.ajax({
			type: "POST",
			url: "<?=base_url() ?>Subreg.jsp/subreg_detail",		
			data: postData,
			success: function(msg)
			{
				$("#form-wrap").html(msg);
			}
		});

		parent.waitingDialog.hide();
	}

	$('html, body').animate({ scrollTop: 0 }, 'slow');

    </script>
</html>