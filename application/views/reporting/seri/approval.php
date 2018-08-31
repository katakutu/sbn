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
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap-datepicker.min.css">
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>plugin/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datepicker.min.js"></script>
	</head>
	<script type="text/javascript">
	jQuery(function($) {

		$('#min').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		});

		$('#max').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		});
	});

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('edit pekerja') ?></b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('edit pekerja') ?></a></li>
					<li class="active"><?= $this->lang->line('approval maintain') ?></li>
				</ol>
				<?php cetak_flash_msg(); ?>
				<div class="table-responsive" id="datatable" style="display:none;">
				<table align="center" width="100%" id="detail" cellspacing="0" class="table table-striped table-bordered table-hover">
					<thead>
			            <tr>
							<th><?= $this->lang->line('full name') ?></th>
			            	<th><?= $this->lang->line('nip') ?></th>
			            	<th><?= $this->lang->line('nomor peserta') ?></th>
							<th><?= $this->lang->line('branch') ?></th>
							<th><?= $this->lang->line('iuran') ?></th>
							<th><?= $this->lang->line('description') ?></th>
							<th><?= $this->lang->line('last update') ?></th>
			    		</tr>
					</thead>
			        <tbody id="tbodyinves"></tbody>
				</table>
				<br>
				<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="gotoQuery();">
					<a href="#" type="button" name="back" style="color: white;" id="Back">
						<i class="fa fa-check" >
						</i>
						OK
					</a>
				</span>
				</div>
				<div class="dataTable_wrapper table" id="form-wrap">
					<!-- <table cellspacing="5" cellpadding="5" border="0">
				        <tbody><tr>
				            <td>Minimum age:</td>
				            	<td><input id="min" name="min" type="text"></td>
					        </tr>
					        <tr>
					            <td>Maximum age:</td>
					            <td><input id="max" name="max" type="text"></td>
					        </tr>
				    	</tbody>
				    </table> -->
	            	<table class="table table-striped table-bordered table-hover" id="ListInvestor" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>
		        				<th><?= $this->lang->line('id_glo') ?></th>
		        				<th><?= $this->lang->line('full name') ?></th>
		        				<th><?= $this->lang->line('nomor briva') ?></th>
		        				<th><?= $this->lang->line('creation date') ?></th>
		        				<th><?= $this->lang->line('status') ?></th>
		        				<th>Action</th>
				    		</tr>
						</thead>
	                    <tbody id="tbodyinves"></tbody>
	                </table>
				</div>
				<input type="hidden" value="" name="placeofbirth" id="placeofbirth" />
				<input type="hidden" value="" name="gender" id="gender" />
				<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
			</div>
		</div>
	</body>
	<!-- DataTables JavaScript -->	
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/jquery.dataTables.min.js"></script><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    	var token = document.getElementById('token').value;
   
	     $.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>SERI.jsp/show_seri_id',
	        data: $('#filter').serialize(),
	        dataType: 'JSON',
	        dataSrc: '',
	        beforeSend: function() {
	        	$("div#form-wrap").show();
	        },
	        success: function(response) {
	        
	            alert(JSON.stringify(response));
	            if(response){
	                drawTableListAdmin(response);
	                parent.setIframeHeight('content');
	            }
	            
	        },
	        error: function(xhr, status, error) {
	        	// console.log(status);
	            alert('Error get data from ajax');  
	     		// var err = eval("(" + xhr.responseText + ")");
  				// alert(err.Message);                 
	        },
	    });

	     function drawTableListAdmin(response){
        var myTable = $('#ListInvestor').DataTable({
        "aaData": response,
        "columns": [{ 
        		"data": "Id"
        	},{ 
    			"data": "Seri"
    		},{ 
				"data": "TingkatKupon"
			},{ 
				"data": "JenisKupon"
			},{ 
				"data": "TglJatuhTempo"
			},{
            	sortable: false,
             	"render": function ( data, type, full, meta ) {
                var ID = full.Id;
                return '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\''+ID+'\')">Detail</a>';
                }
            }],

	    "columnDefs": [
	           { 
	               "targets": [ 5 ], //last column
	               "orderable": false, //set not orderable
	               "searchable" : false,
	           },
	       ],
	    // "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
	    // "iDisplayLength"    : -1,
	    "bDestroy": true,
	    "bPaginate": true,
	    "bInfo": true,
	    "bLengthChange": true,
	    "bFilter": true,
	    "bAutoWidth": true,
	    "bSort": true,
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
	}

	function getTransaction(id)
	{
		parent.waitingDialog.show();

		var postData = {
			// 'user_validator' : user_validator,
			'identifier': id,
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

		$.ajax({
			type: "POST",
			url: "<?=base_url() ?>Maintain.jsp/approve_detail",		
			data: postData,
			success: function(msg)
			{
				$("#form-wrap").html(msg);
			}
		});

		parent.waitingDialog.hide();
	}

	 function formatDate(date) {
	    var d = new Date(date),
	        month = '' + (d.getMonth() + 1),
	        day = '' + d.getDate(),
	        year = d.getFullYear();

	    if (month.length < 2) month = '0' + month;
	    if (day.length < 2) day = '0' + day;

	    return [year, month, day].join('-');
	}

	function getApprove(id, status, briva)
	{
		parent.waitingDialog.show();

		var postData = {
			'briva' : briva,
			'identifier': status,
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

		$.ajax({
			type: "POST",
			url: "<?=base_url() ?>Maintain.jsp/approval_maintain",		
			data: postData,
			success: function()
			{
				alert("Approved!");
				window.location.reload();
				$('#reject').setAttribute("disabled");
			}
		});

		parent.waitingDialog.hide();
	}

	function getReject(id)
	{
		parent.waitingDialog.show();

		var postData = {
			// 'user_validator' : user_validator,
			'identifier': id,
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

		$.ajax({
			type: "POST",
			url: "<?=base_url() ?>Maintain.jsp/reject_maintain",		
			data: postData,
			success: function(msg)
			{
				$("#form-wrap").html(msg);
			},
			error: function(xhr, status, error) {
	        	// console.log(status);
	            alert('Error get data from ajax');  
	     		// var err = eval("(" + xhr.responseText + ")");
  				// alert(err.Message);                 
	        },
		});

		parent.waitingDialog.hide();
	}

	function gotoQuery()
	{
		window.location = "<?=base_url()?>Maintain.jsp/approval_maintain_view";
	}

	$('html, body').animate({ scrollTop: 0 }, 'slow');

    </script>
</html>