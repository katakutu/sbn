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
		        url : "<?=base_url()?>Redemption.jsp/show_redem_filter",
		        type: "post",
		        dataType: "JSON",
		        data: $('#filter').serialize(),
		        beforeSend: function() {
		        	$("table tbody").empty();
		        },
		        success: function(data) {

		        	var a=document.forms["filter"]["sid2"].value;
		        	var b=document.forms["filter"]["seriname"].value;
		        	var c=document.forms["filter"]["redemcode"].value;
		        	if(a==null || a=="",b==null || b=="",c==null || c=="",((a==null || a=="")&& (b==null || b=="") && (c==null || c=="")))
		        	{
		        		alert("Please Fill Required Field");
		        	}
		        	else if(a&&b)
		        	{
		        		if(!a&&!b)
		        		{
		        			alert('Data tidak ditemukan');
		        		}else{
		        			var new_row;
				        	for(var i=0;i<data.length;i++){
				        		var obj = data[i];
							    new_row += "<tr>" + 
							    		"<td>" + obj.KodePemesanan + "</td>" + 
							    		"<td>" + obj.KodeRedeem + "</td>" + 
							    		"<td>" + obj.Nominal + "</td>" + 
							    		"<td>" + obj.Status + "</td>" + 
							    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.KodeRedeem+"\")'>Detail</a></td>" + 
							    		"</tr>";
				        	}
				        	$("table tbody").append(new_row);
		        		}
		        	}else{
		        		// alert(JSON.stringify(data));
		        		// alert(data.Message); 
						if(data[0].hasOwnProperty('KodeRedeem'))
				        {	
					       var new_row;
				        	for(var i=0;i<data.length;i++){
				        		var obj = data[i];
							    new_row += "<tr>" + 
							    		"<td>" + obj.KodePemesanan + "</td>" + 
							    		"<td>" + obj.KodeRedeem + "</td>" + 
							    		"<td>" + obj.Nominal + "</td>" + 
							    		"<td>" + obj.Status + "</td>" + 
							    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.KodeRedeem+"\")'>Detail</a></td>" + 
							    		"</tr>";
				        	}
				        	$("table tbody").append(new_row);
				        }
			        	else
			        	{
			        		alert(data[0].Message);
			        		// alert(data.Message);
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

		function checkRedeem(){
			document.getElementById('check').onchange = function() {
		    document.getElementById('sid2').disabled = this.checked;
		    document.getElementById('redemcode').disabled = !this.checked;
		    $('#sid2,#seriname').val('');
			};
		}

		function checkSidSeri(){
			document.getElementById('checks').onchange = function() {
		    document.getElementById('redemcode').disabled = this.checked;
		    document.getElementById('sid2').disabled = !this.checked;
		    $('#redemcode').val('');
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
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('redemption') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('redemption') ?></a></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>

				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'filter', 'id' => 'filter', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Filter.jsp/Filter', $attributes); ?>

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-seriname"><input type="radio" name="check" id="checks" onclick="checkSidSeri()"> <?= $this->lang->line('sid_subreg') ?> & <?= $this->lang->line('seriname') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('sid_subreg') ?>" aria-describedby="addon-sid" id="sid2" name="sid2" maxlength="70" required disabled onkeypress="return briIbbiz.isAlphaNum(event)"/>
					<span class="input-group-addon">
					</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('seriname') ?>" aria-describedby="addon-seriname" id="seriname" name="seriname" maxlength="70" required disabled/>
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('seriname') ?>', 'ListSeriOffer.jsp/SeriName', 'show');" id="SEARCH_seriname" name="SEARCH_seriname">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="SPAN_seriid" style="color:red; font-size:11px"><?=form_error('seriid',' ',' ')?></span>
					<input type="hidden" value="" name="seriid" id="seriid" />
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-redemcode"><input type="radio" name="check" id="check" onclick="checkRedeem()"> <?= $this->lang->line('redem_code') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('redem_code') ?>" aria-describedby="addon-redemcode" id="redemcode" name="redemcode" maxlength="70" required disabled onkeypress="return briIbbiz.isNumberKey(event)"/>
				</div>
				<div>
					<span id="SPAN_redemcode" style="color:red; font-size:11px"><?=form_error('redemcode',' ',' ')?></span>
				</div>
				<br />
				<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="filterInvestor()">
					<a href="#" type="button" name="cari" style="color: white;" id="Cari">
						<i class="fa fa-search" >
						</i>
						Find
					</a>
				</span>

				<input type="hidden" value="" name="couponrate" id="couponrate" />
				<input type="hidden" value="" name="val_min" id="val_min" />
				<input type="hidden" value="" name="val_max" id="val_max" />
				<input type="hidden" value="" name="status" id="status" />
				</form>
				<?php cetak_flash_msg(); ?>
				<div class="panel-body" id="form-wrap">
					<div class="dataTable_wrapper table">
		            	<table class="table table-striped table-bordered table-hover" id="ListInvestor" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
			        				<th><?= $this->lang->line('ordercode') ?></th>
			        				<th><?= $this->lang->line('redem_code') ?></th>
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
				<input type="hidden" value="" name="idseri" id="idseri" />
				<input type="hidden" value="" name="redemcode" id="redemcode" />
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
	            url : "<?=base_url();?>Redemption.jsp/query_filter",
	            type: "post",
	            data: postData
	        },
	        //Set column definition initialisation properties.
	        "columnDefs": [
	        	{ 
	                "targets": [ 0,1,2,3, 4 ],
	                "visible"	: true,
	            },
	            { 
	                "targets": [ 0 ], //last column
	                "orderable": true, //set not orderable
	                "searchable" : false,
	            },
	            { 
	                "targets": [ -2 ],
	                "orderable": true,
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
			url: "<?=base_url();?>Redemption.jsp/redemption_detail",		
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