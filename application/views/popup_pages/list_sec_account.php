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
		var value1 = document.getElementById('frmList').secaccountid.value.trim();
		var value2 = document.getElementById('frmList').secaccountno.value.trim();

		parent.PopupModal('', '', 'hide');
		parent.PushChild('SEC_ACCOUNT', 'Pemesanan', value1, value2);
	}

	function getValue(e1, e2)
	{
		document.getElementById('frmList').secaccountid.value = e1;
		document.getElementById('frmList').secaccountno.value = e2;
		mainValues();
	}

</script>
</head>
	<body class="container">
		<form id="frmList" method="post">
			<div class="form-wrap" id="form-wrap">
					<div class="dataTable_wrapper table">
                    	<table class="table table-striped table-bordered table-hover" id="ListSecAccount">
		                    <thead>
		                        <tr>
		                        	<th><?= $this->lang->line('secaccountid') ?></th>
		                        	<th><?= $this->lang->line('secaccountno') ?></th>
			        				<th><?= $this->lang->line('secaccountname') ?></th>        				
			        				<th></th>	        				
					    		</tr>
							</thead>
		                    <tbody></tbody>
		                </table>
		            </div>
			</div>
			<div style="text-align:center"></div>			
			<input type="hidden" value="" name="secaccountno" id="secaccountno" />
			<input type="hidden" value="" name="secaccountid" id="secaccountid" />
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

        $('#ListSecAccount').DataTable(
        {
            "responsive"   : true,
            "processing"   : true,
            "serverSide"   : true,
            "paging":   false,
            "searching": true,
            "ajax"   : {
                url : "<?=base_url();?>ListSecAccount.jsp/show_sec_account",
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