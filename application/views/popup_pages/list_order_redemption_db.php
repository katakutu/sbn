<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title><?= $this->lang->line('beneficiary_bank') ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="keyword">
<meta name="Description" content="description">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>

<script type="text/Javascript">
	
	function mainValues()
	{
		var value1 = document.getElementById('frmList').orderno.value.trim();
		var value2 = document.getElementById('frmList').idseri.value.trim();
		var value3 = document.getElementById('frmList').amount.value.trim();

		parent.PopupModal('', '', 'hide');
		parent.countMaxRedeem(value2, value3);
		parent.countSisaKepemilikan(value2, value3);
		parent.PushChild('ORDER', 'Redemption', value1);
	}

	function getValue(e1, e2, e3)
	{
		document.getElementById('frmList').orderno.value = e1;
		document.getElementById('frmList').idseri.value = e2;
		document.getElementById('frmList').amount.value = e3;
		mainValues();
	}

</script>
</head>
	<body class="container">
		<form id="frmList" method="post">
			<div class="form-wrap" id="form-wrap">
					<div class="dataTable_wrapper table">
                    	<table class="table table-striped table-bordered table-hover" id="ListOrder">
		                    <thead>
		                        <tr>
		                        	<th><?= $this->lang->line('orderno') ?></th>
		                        	<th><?= $this->lang->line('seriname') ?></th>
			        				<th><?= $this->lang->line('amount') ?></th> 
			        				<th><?= $this->lang->line('status') ?></th>
			        				<th>id seri</th>        				
			        				<th></th>	        				
					    		</tr>
							</thead>
		                    <tbody></tbody>
		                </table>
		            </div>
			</div>
			<div style="text-align:center"></div>			
			<input type="hidden" value="" name="orderno" id="orderno" />
			<input type="hidden" value="" name="amount" id="amount" />
			<input type="hidden" value="" name="idseri" id="idseri" />
			<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
		</form>
		</div>
	</body>

	<!-- DataTables JavaScript -->
    <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<!-- DataTables JavaScript -->
    <script src="<?=base_url();?>plugin/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function()
    {    
    	var token = document.getElementById('token').value;
        
        var postData = {
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

        $('#ListOrder').DataTable(
        {
            "responsive"   : true,
            "processing"   : true,
            "serverSide"   : true,
            "paging":   false,
            "searching": true,
            "info": false,
            "ajax"   : {
                url : "<?=base_url();?>ListOrder.jsp/show_order_redemption",
                type: "post",
                data: postData
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                	"targets":[4],
                	"visible":false,
                },
                {
                	"targets": [ -1 ],
                	"orderable" : false,
                	"searchable" : false,
                },
            ],            	        
	        "language":
	        {
	            "lengthMenu": "<?= $this->lang->line('dt_show') ?> _MENU_ <?= $this->lang->line('dt_record') ?> <?= $this->lang->line('dt_per_page') ?>",
	            "zeroRecords": "<?= $this->lang->line('dt_empty') ?>",
	            "info": "<?= $this->lang->line('dt_show') ?> <?= $this->lang->line('dt_page') ?> _PAGE_ <?= $this->lang->line('dt_of') ?> _PAGES_ <?= $this->lang->line('dt_page') ?>",
	            "infoEmpty": "<?= $this->lang->line('dt_empty') ?>",
	            "infoFiltered": "<?= $this->lang->line('dt_filtered') ?> <?= $this->lang->line('dt_of') ?> _MAX_ <?= $this->lang->line('dt_record') ?>)",
	            "search": "<?= $this->lang->line('dt_search') ?>",
	            "processing": "<?= $this->lang->line('dt_processsing') ?>",
	        }
        });     
    });
    </script>
</html>