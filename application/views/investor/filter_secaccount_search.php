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
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.4.min.js"></script>
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

		function filterInvestor(){
			$(document).ready(function(){
			$.ajax({
		        url : "<?=base_url()?>Filter.jsp/show_secaccount_filter",
		        type: "post",
		        dataType: "JSON",
		        data: $('#filter').serialize(),
		        beforeSend: function() {
		        	$("table tbody").empty();
		        },
		        success: function(data) {

		        	var a=document.forms["filter"]["id_reksb"].value;
		        	var b=document.forms["filter"]["sid"].value;
		        	if(a==null || a=="",b==null || b=="",((a==null || a=="") && (b==null || b=="")))
		        	{
		        		alert("Please Fill Required Field");
				        return false;
		        	}		        
		        	else if (a)
		        	{
		        		if(data[0].hasOwnProperty('Message'))
			        	{
			        		alert(data[0].Message);
			        	}
			        	else
			        	{
			        		var new_row;
				        	for(var i=0;i<data.length;i++){
				        		var obj = data[i];
							    new_row += "<tr>" + 
							    		"<td>" + obj.Id + "</td>" + 
							    		"<td>" + obj.Nama + "</td>" + 
							    		"<td>" + obj.NoRek + "</td>" + 
							    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.Id+"\")'>Detail</a></td>" + 
							    		"</tr>";
					        	// $("table tbody").show(new_row); <a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(" + obj.Sid + ")>Detail</a></td>
				        	}

				        	$("table tbody").append(new_row);
			
		        		}
		        	}
		        	else if (b)
		        	{
		        		if(data.hasOwnProperty('Message'))
			        	{
			        		alert(data.Message);
			        	}
			        	else
			        	{
			        		var new_row;
				        	for(var i=0;i<data.length;i++){
				        		var obj = data[i];
							    new_row += "<tr>" + 
							    		"<td>" + obj.Id + "</td>" + 
							    		"<td>" + obj.Nama + "</td>" + 
							    		"<td>" + obj.NoRek + "</td>" + 
							    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.Id+"\")'>Detail</a></td>" + 
							    		"</tr>";
					        	// $("table tbody").show(new_row); <a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(" + obj.Sid + ")>Detail</a></td>
				        	}

				        	$("table tbody").append(new_row);
		        		}
		        	}
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });
		    });
		 }

		function checkSid(){
			document.getElementById('checker').onchange = function() {
			document.getElementById('id_reksb').disabled = !this.checked;
		    document.getElementById('sid').disabled = this.checked;
		    $('#sid').val('');
			};
		}

		function checkNonSid(){
			document.getElementById('checking').onchange = function() {
		    document.getElementById('id_reksb').disabled = this.checked;
		    document.getElementById('sid').disabled = !this.checked;
		    $('#id_reksb').val('');
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
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('securities account') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('securities account') ?></a></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>
				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'filter', 'id' => 'filter', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Filter.jsp/Filter', $attributes); ?>

				<!--<?php echo form_open('user_management/create_user','id="form_create_user"');?>-->

				<div class="input-group input-group">

					<span class="input-group-addon" id="addon-id_reksb"><input type="radio" name="check" id="checker" onclick="checkSid()">&nbsp;<?= $this->lang->line('id_rek') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('id_rek') ?>" aria-describedby="addon-id_reksb" id="id_reksb" name="id_reksb" maxlength="70" required disabled onkeypress="return briIbbiz.isNumberKey(event)"/>
				</div>
				<div>
					<span id="SPAN_ID_REKSB" style="color:red; font-size:11px"><?=form_error('ID_REKSB',' ',' ')?></span>
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
					<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="filterInvestor()">
						<a href="#" type="button" name="cari" style="color: white;" id="Cari">
							<i class="fa fa-search" >
							</i>
							Find
						</a>
					</span>

					<!--<h5><?= $this->lang->line('message') ?>:</h5>-->
				</form>
				<?php cetak_flash_msg(); ?>
				<div class="panel-body" id="form-wrap">
					<div class="dataTable_wrapper table">
		            	<table class="table table-striped table-bordered table-hover" id="ListSecaccount" cellspacing="0" width="100%">
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

	    var table = $('#ListSecaccount').DataTable({
	        "responsive"   : true,
	        "processing"   : true,
	        "serverSide"   : true,
	        "paging":   false,
	        "searching": false,
	        "ajax"   : {
	            url : "<?=base_url();?>Investor.jsp/query_filter_secaccount",
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
	            	"orderable" : false,
	            },
	        ],        
	        "language": {
	            "lengthMenu": "<?= $this->lang->line('dt_show') ?> _MENU_ <?= $this->lang->line('dt_record') ?> <?= $this->lang->line('dt_per_page') ?>",
	            "zeroRecords": "<?= $this->lang->line('dt_empty') ?>",
	            // "info": "<?= $this->lang->line('dt_show') ?> <?= $this->lang->line('dt_page') ?> _PAGE_ <?= $this->lang->line('dt_of') ?> _PAGES_ <?= $this->lang->line('dt_page') ?>",
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

		$('#ListSecaccount tbody').on( 'click', 'button', function () {
	        var data = table.row( $(this).parents('tr') ).data();
	        window.location.href = "<?=base_url();?>Investor.jsp/secaccount_detail";
	    } );

	});

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
			url: "<?=base_url();?>Investor.jsp/secaccount_detail",		
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