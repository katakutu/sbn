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
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>plugin/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datepicker.min.js"></script>
	</head>
	<script type="text/javascript">
		 var briIbbiz=new Object();
		briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};
		briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};
		briIbbiz.isAlphaNum=function(e){return /^[A-Z0-9]+$/i.test(e.key);};
		briIbbiz.isAlphaNumSpasi=function(e){return /^[A-Z0-9 ]+$/i.test(e.key);};
		briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- .,()]+$");};
	</script>
	<style type="text/css">
	.form-wrap{
		padding:10px;
		border-left:1px solid #DDD;
		border-bottom:1px solid #DDD;
		border-right:1px solid #DDD;
	}
	section .panel-body{
		display:none;
	}

	th { font-size: 11px; }
	td { font-size: 11px; }
	.panel-primary { border-color: black; }
		
	</style>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('monitoring') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('reporting') ?></a></li>
					<li class="active"><?= $this->lang->line('seri') ?></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>

				<div class="form-wrap" id="form-wrap">
					  <input id="tab1" type="radio" name="tabs" checked>
					  <label for="tab1"><?= $this->lang->line('pemesanan') ?></label>
					    
					  <input id="tab2" type="radio" name="tabs" onclick="redemseri();">
					  <label for="tab2"><?= $this->lang->line('redemption') ?></label>
					    
					  <section id="content1">
					    <div class="panel-body" id="form-wraps">
							<div class="dataTable_wrapper table">
				            	<table class="table table-striped table-bordered table-hover" id="order" cellspacing="0" width="100%">
				                    <thead>
				                        <tr>
				                        	<th><?= $this->lang->line('seriname') ?></th>
					        				<th><?= $this->lang->line('couponrate') ?></th>
					        				<th><?= $this->lang->line('startorders') ?></th>
					        				<th><?= $this->lang->line('endorders') ?></th>
					        				<th>Action</th>
							    		</tr>
									</thead>
				                    <tbody></tbody>
				                </table>
							</div>
						</div>
					  </section>
					    
					  <section id="content2">
					    <div class="panel-body" id="form-wrapss">
							<div class="dataTable_wrapper table">
				            	<table class="table table-striped table-bordered table-hover" id="orders" cellspacing="0" width="100%">
				                    <thead>
				                        <tr>
				                        	<th><?= $this->lang->line('seriname') ?></th>
					        				<th><?= $this->lang->line('couponrate') ?></th>
					        				<th><?= $this->lang->line('startredem') ?></th>
					        				<th><?= $this->lang->line('endredem') ?></th>
					        				<th>Action</th>
							    		</tr>
									</thead>
				                    <tbody></tbody>
				                </table>
							</div>
						</div>
					  </section>
				</div>
				<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
            </div>
		</div>
	</body>
	
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
	<script src="<?=base_url();?>plugin/DataTables-1.10.16/js/jquery.dataTables.min.js"></script><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
	 	var token = document.getElementById('token').value;
		
		$.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>SERI.jsp/show_seri_order',
	        data: $('#invesdetail').serialize(),
	        dataType: 'JSON',
	        dataSrc: '',
	        beforeSend: function(){
	        	$('div#form-wraps').show();
	        },
	        success: function(response) {
	        
	            // alert(JSON.stringify(response));
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

	    function formatDate(date) {
		    var d = new Date(date),
		        month = '' + (d.getMonth() + 1),
		        day = '' + d.getDate(),
		        year = d.getFullYear();

		    if (month.length < 2) month = '0' + month;
		    if (day.length < 2) day = '0' + day;

		    return [year, month, day].join('-');
		}

		 function redemseri()
		 {
		 	$.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>SERI.jsp/show_seri_redem',
	        data: $('#invesdetail').serialize(),
	        dataType: 'JSON',
	        dataSrc: '',
	        beforeSend: function(){
	        	$('div#form-wrapss').show();
	        },
	        success: function(response) {
	        
	            // alert(JSON.stringify(response));
	            if(response){
	                drawTableRedemSeri(response);
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
		 }
	     function drawTableListAdmin(response){
        var myTable = $('#order').DataTable({
        "aaData": response,
        "columns": [{ 
        		data: "Seri"
        	},{ 
    			data: "TingkatKupon"
    		},{ 
				data: "TglMulaiPemesanan"
			},{ 
				data: "TglAkhirPemesanan"
			},{
            	sortable: false,
             	render: function ( data, type, full, meta ) {
                var orderID = full.Id;
                return '<a class="btn btn-sm btn-primary btn-sm" id="detail" href="javascript:getTransaction(\''+orderID+'\')">Detail</a>';
                }
            }],

	    "columnDefs": [
	           { 
	               "targets": [ 4 ], //last column
	               "orderable": false, //set not orderable
	               "searchable" : false,
	           },
	           {
			    	"targets" : [ 2,3 ],
			        render : function(data){
		            return formatDate(data);
			        }
			    },
	          //  { 
	          //       "targets": 3,
	          //       render : function(data){
		         //    return decimal(data);
			        // },
	          //   }
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

	function drawTableRedemSeri(response){
        var myTable = $('#orders').DataTable({
        "aaData": response,
        "columns": [{ 
        		data: "Seri"
        	},{ 
    			data: "MaxPcent"
    		},{ 
				data: "TglMulaiRedeem"
			},{ 
				data: "TglAkhirRedeem"
			},{
            	sortable: false,
             	render: function ( data, type, full, meta ) {
                var orderID = full.Id;
                return '<a class="btn btn-sm btn-primary btn-sm" id="detail" href="javascript:getRedem(\''+orderID+'\')">Detail</a>';
                }
            }],

	    "columnDefs": [
	           { 
	               "targets": [ 4 ], //last column
	               "orderable": false, //set not orderable
	               "searchable" : false,
	           },
	           {
			    	"targets" : [ 2,3 ],
			        render : function(data){
		            return formatDate(data);
			        }
			    },
	          //  { 
	          //       "targets": 3,
	          //       render : function(data){
		         //    return decimal(data);
			        // },
	          //   }
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
				<?= $this->security->get_csrf_token_name() ?> : token
			};

			$.ajax({
				type: "POST",
				url: "<?=base_url();?>SERI.jsp/query_detail",		
				data: postData,
				success: function(msg)
				{
					$("#invesdetail").html(msg);
				}
			});

			parent.waitingDialog.hide();
		}

		function getRedem(id)
		{

			parent.waitingDialog.show();
			
			var postData = {
				// 'user_validator' : user_validator,
				'identifier': id,
				<?= $this->security->get_csrf_token_name() ?> : token
			};

			$.ajax({
				type: "POST",
				url: "<?=base_url();?>SERI.jsp/query_detail_redem",		
				data: postData,
				success: function(msg)
				{
					$("#invesdetail").html(msg);
				}
			});

			parent.waitingDialog.hide();
		}

    </script>
</html>