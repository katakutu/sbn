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
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
</head>
<body oncontextmenu="return false">
	<div class="panel panel-primary">
		<h3 style="text-align: right; padding-right: 25px">
			<i class="fa fa-feed"></i> <b><?= $this->lang->line('fund account') ?></b>
		</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('fund account') ?></a></li>
				<li class="active"><?= $this->lang->line('edit') ?></li>
			</ol>
			<div class="panel-body" id="form-wrap" style="padding-left:15px; font-size: 13px">
				<?php cetak_flash_msg(); ?>
				<div class="dataTable_wrapper table">
                	<table class="table table-striped table-bordered table-hover" id="ListFundAccount" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>
		        				<th><?= $this->lang->line('fundaccountid') ?></th>
		        				<th><?= $this->lang->line('accountname') ?></th>
		        				<th><?= $this->lang->line('accountno') ?></th>
		        				<th></th>
				    		</tr>
						</thead>
	                    <tbody></tbody>
	                </table>
	            </div>
	            <input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
			</div>
		</div>
		<div class="panel-footer"></div>
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

    $('#ListFundAccount').DataTable({
        "responsive"   : true,
        "processing"   : true,
        "serverSide"   : true,
        "paging":   true,
        "searching": true,
        "ajax"   : {
            url : "<?=base_url();?>Investor.jsp/list_edit_fundaccount",
            type: "post",
            data: postData
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        	{ 
                "targets": [ 0,1,2,3],
                "visible"	: true,
            },
            { 
                "targets": [ -1 ], //last column
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
		url: "<?=base_url() ?>Investor.jsp/edit_fundaccount_detail",		
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