<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title><?= $this->lang->line('beneficiary_bank') ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="keyword">
<meta name="Description" content="description">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<!-- DataTables JavaScript -->
<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>

<script type="text/Javascript">

	function mainValues() {
		var value1 = document.getElementById('frmList').typeofwork_name.value.trim();
		var value2 = document.getElementById('frmList').typeofwork_code.value.trim();
		// window.opener.openPanel(1,value);
		// parent.document.getElementById('Transfer').BANK_NAME.value = value;
		// parent.document.getElementById('Transfer').BANK_CODE.value = valuex;
		// window.opener.document.getElementById('Transfer').DEBIT_ACCOUNT_NAME.value = valuex;
		// parent.PopupModal('ACCOUNT', 'hide');


		parent.PopupModal('', '', 'hide');
		parent.PushChild('KODE_KERJA', 'Investor', value1, value2);
	}

	function getValue(e1,e2) {
		document.getElementById('frmList').typeofwork_name.value = e2;
		document.getElementById('frmList').typeofwork_code.value = e1;
		mainValues();
	}

</script>
</head>
	<body class="container">
		<form id="frmList" method="post">
			<div class="form-wrap" id="form-wrap">
					<div class="dataTable_wrapper table">
                    	<table class="table table-striped table-bordered table-hover" id="ListBank">
		                    <thead>
		                        <tr>
			        				<th><?= $this->lang->line('typeofwork_code') ?></th>
			        				<th><?= $this->lang->line('typeofwork_name') ?></th>
			        				<th></th>        				
					    		</tr>
							</thead>
		                    <tbody></tbody>
		                </table>
		            </div>
			</div>
			<div style="text-align:center"></div>			
			<input type="hidden" value="" name="typeofwork_name" id="typeofwork_name" />
			<input type="hidden" value="" name="typeofwork_code" id="typeofwork_code" />
			<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
		</form>
	</body>

	<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>plugin/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {

    	var token = document.getElementById('token').value;

    	var postData = {
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

        
        $.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>ListKdJenisPekerjaan.jsp/show_kode_pekerjaan',
	        data: postData,
	        dataType: 'JSON',
	        dataSrc: '',
	        beforeSend: function() {
	        	$("div#form-wrap").show();
	        },
	        success: function(response) {
	        
	            //alert(JSON.stringify(response));
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
	        var myTable = $('#ListBank').DataTable({
	        "aaData": response,
	        "columns": [
		        		  { "data": "Id" },
			        	  { "data": "Nama" },
			           ],

		    "columnDefs": [
		           { 
		               "targets": [ 2 ], //last column
		               "orderable": false, //set not orderable
		               "data": null,
                       "defaultContent": '<a class="btn btn-sm btn-primary btn-sm">></a>',
		               "searchable" : false,
		           },
		       ],
		    // "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		    // "iDisplayLength"    : -1,
		    "paging": false,
		    "bDestroy": true,
		    "bPaginate": true,
		    "bInfo": false,
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

			$('#ListBank tbody').on( 'click', 'a', function () {
	       		var data = myTable.row( $(this).parents('tr') ).data();
	       		getValue(data["Id"],data["Nama"]);
		    } );
		}
    });
    </script>
</html>