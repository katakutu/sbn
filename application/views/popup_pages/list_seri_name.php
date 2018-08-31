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
<script type="text/javascript" src="<?= base_url() ?>js/autoNumeric.js"></script>

<script type="text/Javascript">

	function mainValues() {
		var value1 = document.getElementById('frmList').seriname.value.trim();
		var value2 = document.getElementById('frmList').seriid.value.trim();
		var value3 = document.getElementById('frmList').couponrate.value.trim();
		var value4 = document.getElementById('frmList').val_min.value.trim();
		var value5 = document.getElementById('frmList').val_max.value.trim();
		var value6 = document.getElementById('frmList').status.value.trim();

		parent.PopupModal('', '', 'hide');
		parent.PushChild('SERI_ALL', 'filter', value1, value2, value3, value4, value5, value6);
	}

	function getValue(e1,e2,e3,e4,e5,e6) {
		
		document.getElementById('frmList').seriname.value = e2;
		document.getElementById('frmList').seriid.value = e1;
		document.getElementById('frmList').couponrate.value = e3;
		document.getElementById('frmList').val_min.value = e4;
		document.getElementById('frmList').val_max.value = e5;
		document.getElementById('frmList').status.value = e6;
		mainValues();
	}


</script>
</head>
	<body class="container">
		<form id="frmList" method="post">
			<div class="form-wrap" id="form-wrap">
					<div class="dataTable_wrapper table">
                    	<table class="table table-striped table-bordered table-hover" id="ListSeriOffer">
		                    <thead>
		                        <tr>
			        				<th><?= $this->lang->line('seriid') ?></th>
			        				<th><?= $this->lang->line('seriname') ?></th>
			        				<th><?= $this->lang->line('couponrate') ?></th>
			        				<th></th>        				
					    		</tr>
							</thead>
		                    <tbody></tbody>
		                </table>
		            </div>
			</div>
			<div style="text-align:center"></div>			
			<input type="hidden" value="" name="seriname" id="seriname" />
			<input type="hidden" value="" name="seriid" id="seriid" />
			<input type="hidden" value="" name="couponrate" id="couponrate" />
			<input type="hidden" value="" name="val_min" id="val_min" />
			<input type="hidden" value="" name="val_max" id="val_max" />
			<input type="hidden" value="" name="status" id="status" />
			<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
		</form>
	</body>

	<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>plugin/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        
        $.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>ListSeriOffer.jsp/show_all_seri',
	        data: {},
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
	        var myTable = $('#ListSeriOffer').DataTable({
	        "aaData": response,
	        "columns": [{ "data": "Id" },
			        { "data": "Seri" },
			        { "data": "TingkatKupon" }
			        ],

		    "columnDefs": [
		           {
		           	   "targets": [ 0 ], //last column
		               "visible": false, //set not orderable
		           },
		           { 
		               "targets": [ 3 ], //last column
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
			$('#ListSeriOffer tbody').on( 'click', 'a', function () {
       		var data = myTable.row( $(this).parents('tr') ).data();
       		getValue(data["Id"],data["Seri"],data["TingkatKupon"],data["MinPemesanan"],data["MaxPemesanan"],data["Status"]);
	    } );
		}
            
    });
    </script>
</html>