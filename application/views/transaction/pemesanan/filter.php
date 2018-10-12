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
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datepicker.min.js"></script>
	</head>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('pemesanan') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('pemesanan') ?></a></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>
				<div class="form-wrap" id="form-wrap">
				<?php cetak_flash_msg(); ?>
				<div class="panel-body" id="form-wrap">
					<div class="dataTable_wrapper table">
		            	<table class="table table-striped table-bordered table-hover" id="ListInvestor" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                        	<th><?= $this->lang->line('creation date') ?></th>
		                        	<th><?= $this->lang->line('payment limit') ?></th>
			        				<th><?= $this->lang->line('ordercode') ?></th>
			        				<th><?= $this->lang->line('billcode') ?></th>
			        				<th><?= $this->lang->line('amount') ?></th>
			        				<th><?= $this->lang->line('status') ?></th>
			        				<th>Action</th>
					    		</tr>
							</thead>
		                    <tbody id="tbodyinves"></tbody>
		                </table>
					</div>
				</div>
				</div>
				<input type="hidden" value="" name="sid" id="sid" />
				<input type="hidden" value="" name="ordercode" id="ordercode" />
				<input type="hidden" value="" name="billcode" id="billcode" />
				<input type="hidden" value="" name="status" id="status" />
				<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
            </div>
		</div>
	</body>
	<!-- DataTables JavaScript -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
	<script src="<?=base_url();?>plugin/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/autoNumeric.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/moment.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    var token = document.getElementById('token').value;

    var postData = {
		<?= $this->security->get_csrf_token_name() ?> : token,
	};
	
	$.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>Pemesanan.jsp/query_filter',
	        data: postData,
	        dataType: 'JSON',
	        dataSrc: '',
	        success: function(response) {
	        
	            //alert(JSON.stringify(response));
	            if(response){
	                drawTableListAdmin(response);
	                // parent.setIframeHeight('content');
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
        		"data": "TglPemesanan"
        	},{ 
    			"data": "BatasPembayaran"
    		},{ 
    			"data": "KodePemesanan"
    		},{ 
				"data": "KodeBilling"
			},{ 
				"data": "Nominal"
			},{ 
				"data": "Status"
			},{
            	sortable: false,
             	"render": function ( data, type, full, meta ) {
                var orderID = full.KodePemesanan;
                var sidID = full.Sid;
                var idseriID = full.IdSeri;
                return '<a class="btn btn-sm btn-primary btn-sm" id="detail" href="javascript:getTransaction(\''+orderID+'\',\''+sidID+'\',\''+idseriID+'\')">Detail</a>';
                }
            }],

	    "columnDefs": [
	           { 
	               "targets": [ 5 ], //last column
	               "orderable": false, //set not orderable
	               "searchable" : false,
	           },
	           { 
	                "targets": 3,
	                render : function(data){
		            return decimal(data);
			        },
	            },
	            { 
	                "targets": 0,
	                "render": function ( data, type, full, meta ) {
                         return moment.utc(data).format('YYYY-MM-DD HH:mm:ss');

                    }
	            }
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
		       "infoFiltered": "<?= $this->lang->line('dt_filtered') ?> <?= $this->lang->line('dt_of') ?> _MAX_ <?= $this->lang->line('dt_record') ?>",
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

	function decimal(data)
	{
		var	reverse = data.toString().split('').reverse().join(''),
		ribuan 	= reverse.match(/\d{1,3}/g);
		ribuan	= ribuan.join(',').split('').reverse().join('')+' IDR';
		return ribuan;
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

	function getTransaction(id,sid,id_seri)
	{
		parent.waitingDialog.show();
		
		var postData = {
			'idseri' : id_seri,
			'sid': sid,
			'identifier': id,
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

		$.ajax({
			type: "POST",
			url: "<?=base_url();?>Pemesanan.jsp/order_detail",		
			data: postData,
			success: function(msg)
			{
				$("#form-wrap").html(msg);
			}
		});

		parent.waitingDialog.hide();	
	}

    </script>
</html>