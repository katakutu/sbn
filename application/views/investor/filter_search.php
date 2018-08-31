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

		function filterInvestor(){
			$(document).ready(function(){
			$.ajax({
		        url : "<?=base_url()?>Filter.jsp/show_investor_by_sid",
		        type: "post",
		        dataType: "JSON",
		        data: $('#filter').serialize(),
		        beforeSend: function() {
		        	$("table tbody").empty();
		        },
		        success: function(data) {  
		        	//alert(JSON.stringify(data));

		        	var a=document.forms["filter"]["sid"].value;
			        var b=document.forms["filter"]["fullname"].value;
			        var c=document.forms["filter"]["idcardno"].value;
			        var d=document.forms["filter"]["dateofbirth"].value;
			        if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="")
			        {
			        	if(a){
			        		if(a != data.Sid){
			        			alert("Data SID Tidak Ditemukan");
			        		}else{
			        			var new_row = "<tr><td>" + data.Sid + "</td><td>" + data.Nama + "</td><td>" + data.Status + "<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+data.Sid+"\")'>Detail</a></td>";

				        		$("table tbody").append(new_row);
			        		}
			        	}else{
				            alert("Please Fill Required Field");
				            return false;
			        	}
			        }
		        	else
		        	{
		        		if(data.hasOwnProperty('Status'))
			        	{
			        		//alert(JSON.stringify(data));

			        		var new_row = "<tr><td>" + data.Sid + "</td><td>" + data.Nama + "</td><td>" + data.Status + "<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+data.Sid+"\")'>Detail</a></td>";

				        	$("table tbody").append(new_row);

			        	}
			        	else
			        	{
			        		alert("Data Tidak Ditemukan");
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
			document.getElementById('sid').disabled = !this.checked;
		    document.getElementById('fullname').disabled = this.checked;
		    document.getElementById('idcardno').disabled = this.checked;
		    document.getElementById('dateofbirth').disabled = this.checked;
		    $('#fullname,#idcardno,#dateofbirth').val('');
			};
		}

		function checkNonSid(){
			document.getElementById('checking').onchange = function() {
		    document.getElementById('sid').disabled = this.checked;
		    document.getElementById('fullname').disabled = !this.checked;
		    document.getElementById('idcardno').disabled = !this.checked;
		    document.getElementById('dateofbirth').disabled = !this.checked;
		    $('#sid').val('');
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
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('investor') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('investor') ?></a></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>

				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'filter', 'id' => 'filter', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Filter.jsp/Filter', $attributes); ?>
				<div class="input-group input-group">

					<span class="input-group-addon" id="addon-sid"><input type="radio" name="check" id="checker" onclick="checkSid()">&nbsp;<?= $this->lang->line('sid') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" required disabled onkeypress="return briIbbiz.isAlphaNum(event)"/>
				</div>
				<div>
					<span id="SPAN_SID" style="color:red; font-size:11px"><?=form_error('SID',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-fullname"><input type="radio" name="check" id="checking" onclick="checkNonSid()"> <?= $this->lang->line('name') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('name') ?>" aria-describedby="addon-fullname" id="fullname" name="fullname" maxlength="70" required disabled/>
				</div>
				<div>
					<span id="SPAN_fullname" style="color:red; font-size:11px"><?=form_error('Full Name',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-idcardno"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('id card no') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('id card no') ?>" aria-describedby="addon-idcardno" id="idcardno" name="idcardno" maxlength="70" required disabled/>
				</div>
				<div>
					<span id="SPAN_idcardno" style="color:red; font-size:11px"><?=form_error('ID Card No',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-dateofbirth"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('date of birth') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('date of birth') ?>" aria-describedby="addon-dateofbirth" id="dateofbirth" name="dateofbirth" maxlength="70" required disabled/>
				</div>
				<div>
					<span id="SPAN_dateofbirth" style="color:red; font-size:11px"><?=form_error('Date of Birth',' ',' ')?></span>
				</div>
				<br />
					<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="filterInvestor()">
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
		            	<table class="table table-striped table-bordered table-hover" id="ListInvestor" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
			        				<th><?= $this->lang->line('sid') ?></th>
			        				<th><?= $this->lang->line('full name') ?></th>
			        				<th><?= $this->lang->line('status') ?></th>
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
	        "paging":   false,
	        "searching": false,
	        "ajax"   : {
	            url : "<?=base_url();?>Investor.jsp/query_filter",
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
	            // {
	            // 	"targets": [ -1 ],
	            // 	"defaultContent": "<button>Detail</button>",
	            // }
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
			url: "<?=base_url();?>Investor.jsp/investor_detail",		
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