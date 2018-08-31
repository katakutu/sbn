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
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap.css">
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap-datepicker.min.css">
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datepicker.min.js"></script>
	</head>
	<script type="text/javascript">
		jQuery(function($) {

		$('#orderdate,#orderdate2,#orderdate3').datepicker({
				autoclose: true,
				format: 'yyyy-mm-dd',
				orientation: 'auto top',
			});

		$('a[href="#Cari"]').click(function(){
		  alert('Sign new href executed.'); 
		}); 

		});

		function checkSid(){
			document.getElementById('checker').onchange = function() {
			document.getElementById('orderdate').disabled = !this.checked;
		    document.getElementById('orderdate2').disabled = this.checked;
		    document.getElementById('orderdate3').disabled = this.checked;
		    $('#orderdate2,#orderdate3').val('');
			};
		}

		function checkNonSid(){
			document.getElementById('check').onchange = function() {
		    document.getElementById('orderdate').disabled = this.checked;
		    document.getElementById('orderdate2').disabled = !this.checked;
		    document.getElementById('orderdate3').disabled = !this.checked;
		    $('#orderdate').val('');
			};
		}

		$(document).ready(function() {
		    $("#Clear").click(function(){
		       $("#seriname").val("");
		       $("#seriid").val("");
		       $("#stats").val("");
		       $("#orderdate").val("");
		       $("#orderdate2").val("");
		       $("#orderdate3").val("");
		    }); 
		});

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('monitoring') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('reporting') ?></a></li>
					<li class="active"><?= $this->lang->line('monitoring') ?></li>
					<li class="active"><?= $this->lang->line('pemesanan') ?></li>
				</ol>

				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'filter', 'id' => 'filter', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'', $attributes); ?>
				<input type="hidden" value="<?php if(isset($halaman))echo $halaman;?>" name="pagesize" id="pagesize" />
				<input type="hidden" value="<?php if(isset($nohal))echo $nohal;?>" name="pagenumber" id="pagenumber" />
				<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
				<div class="input-group">
					<span class="input-group-addon" id="addon-seriname"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('seriname') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('seriname') ?>" aria-describedby="addon-seriname" id="seriname" name="seriname" required="required" value="<?php if(isset($seriname))echo $seriname;?>" readonly='true'/>
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('seriname') ?>', 'ListSeriOffer.jsp/SeriName', 'show');" id="SEARCH_seriname" name="SEARCH_seriname">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="span_seriname" style="color:red; font-size:11px"><?=form_error('hid_seriname',' ',' ')?></span>
					<input type="hidden" id="seriid" name="seriid" value="" />
				</div>
				<br />

				<div class="input-group">
					<span class="input-group-addon" id="addon-status"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('status') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('status') ?>" aria-describedby="addon-status" id="stats" name="stats" required="required" value="<?php if(isset($idstatus))echo $idstatus;?>" readonly='true'/>
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('status') ?>', 'ListSeriOffer.jsp/StatusName', 'show');" id="SEARCH_status" name="SEARCH_status">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="span_status" style="color:red; font-size:11px"><?=form_error('hid_status',' ',' ')?></span>
					<input type="hidden" id="statid" name="statid" value="" />
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-orderdate"><input type="radio" name="check" id="checker" onclick="checkSid()"> <?= $this->lang->line('orderdate3') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('orderdate3') ?>" aria-describedby="addon-orderdate" id="orderdate" name="orderdate" maxlength="70" required disabled/>
				</div>
				<div>
					<span id="SPAN_orderdate" style="color:red; font-size:11px"><?=form_error('orderdate',' ',' ')?></span>
				</div>
				<br />
				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-orderdate2"><input type="radio" name="check" id="check" onclick="checkNonSid()"> <?= $this->lang->line('orderdate2') ?>&nbsp;</span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('orderdate2') ?>" aria-describedby="addon-orderdate2" id="orderdate2" name="orderdate2" maxlength="70" required disabled/>
					<span class="input-group-addon" id="addon-orderdate3"> - </span>
					<input class="form-control" type="text" placeholder="<?= $this->lang->line('orderdate2') ?>" aria-describedby="addon-orderdate3" id="orderdate3" name="orderdate3" maxlength="70" required disabled/>
				</div>
				<div>
					<span id="SPAN_orderdate2" style="color:red; font-size:11px"><?=form_error('orderdate2',' ',' ')?></span>
				</div>
				<br />
					<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="initUserAdmin()">
						<a href="#Cari" type="button" name="cari" style="color: white;" id="Cari">
							<i class="fa fa-search" >
							</i>
							Find
						</a>
					</span>
					<span class="btn btn-theme btn-block" style="background-color: #ff0000;">
						<a href="#" type="button" name="clear" style="color: white;" id="Clear">
							<i class="fa fa-refresh" >
							</i>
							Clear
						</a>
					</span>
				</form>
				<?php cetak_flash_msg(); ?>
				<div class="panel-body" id="form-wrap" style="display:none">
					<div class="dataTable_wrapper table">
		            	<table class="table table-striped table-bordered table-hover" id="orders" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                        	<th><?= $this->lang->line('secaccountname') ?></th>
			        				<th><?= $this->lang->line('ordercode') ?></th>
			        				<th><?= $this->lang->line('seriname') ?></th>
			        				<th><?= $this->lang->line('sid_subreg') ?></th>
			        				<th><?= $this->lang->line('billcode') ?></th>
			        				<th><?= $this->lang->line('amount') ?></th>
			        				<th><?= $this->lang->line('status') ?></th>
			        				<th><?= $this->lang->line('orderdate') ?></th>
			        				<th><?= $this->lang->line('ntpn') ?></th>
			        				<th>Action</th>
					    		</tr>
							</thead>
		                    <tbody id="tbodyinves"></tbody>
		                </table>
					</div>
				</div>
				</div>
            </div>
		</div>
	</body>
	
    <script src="<?=base_url();?>plugin/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">

	var token = document.getElementById('token').value;

    function formatDate(date) {
		    var d = new Date(date),
		        month = '' + (d.getMonth() + 1),
		        day = '' + d.getDate(),
		        year = d.getFullYear();

		    if (month.length < 2) month = '0' + month;
		    if (day.length < 2) day = '0' + day;

		    return [year, month, day].join('-');
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
			url: "<?=base_url();?>SBNReport.jsp/order_detail",		
			data: postData,
			success: function(msg)
			{
				$("#form-wrap").html(msg);
			}
		});

		parent.waitingDialog.hide();	
	}

	function initUserAdmin(){
	    $.ajax({
	        type: 'POST',
	        url: '<?=base_url();?>SBNReport.jsp/show_order_report',
	        data: $('#filter').serialize(),
	        dataType: 'JSON',
	        dataSrc: '',
	        beforeSend: function() {
	        	$("div#form-wrap").show();
	        },
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
	}

	function drawTableListAdmin(response){
        var myTable = $('#orders').DataTable({
        "aaData": response,
        "columns": [{ 
        		"data": "NamaInvestor"
        	},{ 
    			"data": "KodePemesanan"
    		},{ 
				"data": "Seri"
			},{ 
				"data": "Sid"
			},{ 
				"data": "KodeBilling"
			},{ 
				"data": "Nominal"
			},{ 
				"data": "Status"
			},{ 
				"data": "TglPemesanan"
			},{ 
				"data": "NTPN"
			},{
            	sortable: false,
             	"render": function ( data, type, full, meta ) {
                var buttonID = full.KodePemesanan;
                return '<a class="btn btn-sm btn-primary btn-sm" href="javascript:getTransaction(\''+buttonID+'\')">Detail</a>';
                }
            }],

	    "columnDefs": [
	           { 
	               "targets": [ 9 ], //last column
	               "orderable": false, //set not orderable
	               "searchable" : false,
	           },
	           {
			    	"targets" : 7,
			        render : function(data){
		            //Here you should call the date format function:
		            return formatDate(data);
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
	}

    </script>
</html>