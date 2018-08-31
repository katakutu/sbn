<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<script type="text/javascript">
	jQuery(function($) {

		$('#dateofbirth').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy'
		});
	});

		function checkSid(){
			document.getElementById('checker').onchange = function() {
			document.getElementById('id_rek').disabled = !this.checked;
		    document.getElementById('sid').disabled = this.checked;
		    $('#sid').val('');
			};
		}

		function checkNonSid(){
			document.getElementById('checking').onchange = function() {
		    document.getElementById('id_rek').disabled = this.checked;
		    document.getElementById('sid').disabled = !this.checked;
		    $('#id_rek').val('');
			};
		}

		var briIbbiz=new Object();
		briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};
		briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};
		briIbbiz.isAlphaNum=function(e){return /^[A-Z0-9]+$/i.test(e.key);};
		briIbbiz.isAlphaNumSpasi=function(e){return /^[A-Z0-9 ]+$/i.test(e.key);};
		briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- .,()]+$");};

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('fund account') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('fund account') ?></a></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>
				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'filter', 'id' => 'filter', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Filter.jsp/Filter', $attributes); ?>

				<div class="input-group input-group">

					<span class="input-group-addon" id="addon-id_rek"><input type="radio" name="check" id="checker" onclick="checkSid()">&nbsp;<?= $this->lang->line('id_rek') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('id_rek') ?>" aria-describedby="addon-id_rek" id="id_rek" name="id_rek" maxlength="70" required disabled onkeypress="return briIbbiz.isNumberKey(event)"/>
				</div>
				<div>
					<span id="SPAN_ID_REK" style="color:red; font-size:11px"><?=form_error('ID_REK',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-sid"><input type="radio" name="check" id="checking" onclick="checkNonSid()"> <?= $this->lang->line('sid') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" required disabled onkeypress="return briIbbiz.isAlphaNum(event)"/>
				</div>
				<div>
					<span id="SPAN_sid" style="color:red; font-size:11px"><?=form_error('sid',' ',' ')?></span>
				</div>
				<br />
					<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="initUserAdmin()">
						<a href="#" type="button" name="cari" style="color: white;" id="Cari">
							<i class="fa fa-search" >
							</i>
							Find
						</a>
					</span>
				</form>
				
				<?php cetak_flash_msg(); ?>
				<div class="panel-body" id="form-wrap">
					<div class="dataTable_wrapper table">
		            	<table class="table table-striped table-bordered table-hover" id="ListFundaccount" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
			        				<th><?= $this->lang->line('id_rek') ?></th>
			        				<th><?= $this->lang->line('full name') ?></th>
			        				<th><?= $this->lang->line('accountno') ?></th>
			        				<th>Action</th>       				
					    		</tr>
							</thead>
		                    <tbody></tbody>
		                </table>
					</div>
				</div>
				</div>
				<input type="hidden" value="" name="accountno" id="accountno" />
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

	    var table = $('#ListFundaccount').DataTable({
	        "responsive"   : true,
	        "processing"   : true,
	        "serverSide"   : true,
	        "paging":   true,
	        "searching": false,
	        "ajax"   : {
	            url : "<?=base_url();?>Investor.jsp/query_filter_fundaccount",
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
	            	"targets": [ 3 ],
	            	"visible": false,
	            	"orderable" : false,
	            },
	        ],
	        "lengthMenu": [5, 10, 25, 50],        
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

		$('#ListFundaccount tbody').on( 'click', 'button', function () {
	        var data = table.row( $(this).parents('tr') ).data();
	        window.location.href = "<?=base_url();?>Investor.jsp/fundaccount_detail";
	    } );

	});

    function initUserAdmin(){
	    $.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>Filter.jsp/show_fundaccount_filter',
	        data: $('#filter').serialize(),
	        dataType: 'JSON',
	        dataSrc: '',
	        success: function(response) {
	        	
	            //alert(JSON.stringify(response));
	                
		        	var a=document.forms["filter"]["id_rek"].value;
		        	var b=document.forms["filter"]["sid"].value;
		        	if(a==null || a=="",b==null || b=="",((a==null || a=="") && (b==null || b=="")))
		        	{
		        		alert("Please Fill Required Field");
				        return false;
		        	}		        
		        	else if (a)
		        	{
		        		if(response[0].hasOwnProperty('Message'))
			        	{
			        		alert(response[0].Message);
			        	}
			        	else
			        	{
			        		drawTableListAdmin(response);
			
		        		}
		        	}
		        	else if (b)
		        	{
		        		if(response.hasOwnProperty('Message'))
			        	{
			        		alert(response.Message);
			        	}
			        	else
			        	{
			        		drawTableListAdmin(response);
		        		}
		        	}
		        	 	
		       //  	if(a==null || a=="",b==null || b=="")
		       //  	{
				    	// alert("Please Fill Required Field");	
				   
		       //  	}
		      //   	else if(!response){
		      //   		alert(JSON.stringify(response[0].Message));
				    //     // return false;
				    // }else{
		      //   		alert(response.Message);
		      //   		drawTableListAdmin(response);
		      //           $("table tbody").append(response);
		      //           // alert(JSON.stringify(response));
		      //           parent.setIframeHeight('content');
		      //   	}
	            
	            
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
        var myTable = $('#ListFundaccount').DataTable({
        "aaData": response,
        "columns": [{ 
        		"data": "Id"
        	},{ 
    			"data": "Nama"
    		},{ 
				"data": "NoRek"
			},{
            	sortable: false,
             	"render": function ( data, type, full, meta ) {
                var buttonID = full.Id;
                return '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\''+buttonID+'\')">Detail</a>';
                }
            }],

	    "columnDefs": [
	           { 
	               "targets": [ 3 ], //last column
	               "orderable": false, //set not orderable
	               "searchable" : false,
	           },
	       ],
	    "lengthMenu": [5, 10, 25, 50],
	    // "iDisplayLength"    : -1,
	    "searching": false,
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
			url: "<?=base_url();?>Investor.jsp/fundaccount_detail",		
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