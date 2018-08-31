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
<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>

<script type="text/Javascript">

	function mainValues() {
		var value1 = document.getElementById('frmList').sid.value.trim();
		var value2 = document.getElementById('frmList').fullname.value.trim();
		var value3 = document.getElementById('frmList').idcardno.value.trim();
		var value4 = document.getElementById('frmList').dateofbirth.value.trim();
		var value5 = document.getElementById('frmList').placeofbirth.value.trim();
		var value6 = document.getElementById('frmList').gender.value.trim();
		var value7 = document.getElementById('frmList').working.value.trim();
		var value8 = document.getElementById('frmList').city.value.trim();
		var value9 = document.getElementById('frmList').province.value.trim();
		var value10 = document.getElementById('frmList').address.value.trim();
		var value11 = document.getElementById('frmList').phonenumber.value.trim();
		var value12 = document.getElementById('frmList').mobilephonenumber.value.trim();
		var value13 = document.getElementById('frmList').email.value.trim();
		var value14 = document.getElementById('frmList').status.value.trim();
		// window.opener.openPanel(1,value);
		// parent.document.getElementById('Transfer').BANK_NAME.value = value;
		// parent.document.getElementById('Transfer').BANK_CODE.value = valuex;
		// window.opener.document.getElementById('Transfer').DEBIT_ACCOUNT_NAME.value = valuex;
		// parent.PopupModal('ACCOUNT', 'hide');


		parent.PopupModal('', '', 'hide');
		parent.PushChild('FILTER_INVESTOR', 'filter', value1, value2, value3, value4, value5, value6, value7, value8, value9, value10, value11, value12, value13, value14);
	}

	function getValue(e1,e2,e3,e4,e5,e6,e7,e8,e9,e10,e11,e12,e13,e14) {
		document.getElementById('frmList').sid.value = e2;
		document.getElementById('frmList').fullname.value = e1;
		document.getElementById('frmList').idcardno.value = e3;
		document.getElementById('frmList').dateofbirth.value = e4;
		document.getElementById('frmList').placeofbirth.value = e5;
		document.getElementById('frmList').gender.value = e6;
		document.getElementById('frmList').working.value = e7;
		document.getElementById('frmList').city.value = e8;
		document.getElementById('frmList').province.value = e9;
		document.getElementById('frmList').address.value = e10;
		document.getElementById('frmList').phonenumber.value = e11;
		document.getElementById('frmList').mobilephonenumber.value = e12;
		document.getElementById('frmList').email.value = e13;
		document.getElementById('frmList').status.value = e14;
		mainValues();
	}

</script>
</head>
	<body class="container">
		<form id="frmList" method="post">
			<br />
			<div class="form-wrap" id="form-wrap">
				<div class="dataTable_wrapper table">
                	<table class="table table-striped table-bordered table-hover" id="ListBank">
	                    <thead>
	                        <tr>
		        				<th><?= $this->lang->line('sid') ?></th>
		        				<th><?= $this->lang->line('full name') ?></th>
		        				<th><?= $this->lang->line('id card number') ?></th>
		        				<th><?= $this->lang->line('date of birth') ?></th>
		        				<th><?= $this->lang->line('place of birth') ?></th>
		        				<th><?= $this->lang->line('gender') ?></th>
		        				<th><?= $this->lang->line('working') ?></th>
		        				<th><?= $this->lang->line('city') ?></th>
		        				<th><?= $this->lang->line('province') ?></th>
		        				<th><?= $this->lang->line('address') ?></th>
		        				<th><?= $this->lang->line('phone number') ?></th>
		        				<th><?= $this->lang->line('mobile phone number') ?></th>
		        				<th><?= $this->lang->line('email') ?></th>
		        				<th><?= $this->lang->line('status') ?></th>	        				
				    		</tr>
						</thead>
	                    <tbody></tbody>
	                </table>
	            </div>
			</div>
			<div style="text-align:center"></div>			
			<input type="hidden" value="" name="sid" id="sid" />
			<input type="hidden" value="" name="fullname" id="fullname" />
			<input type="hidden" value="" name="idcardno" id="idcardno" />
			<input type="hidden" value="" name="dateofbirth" id="dateofbirth" />
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
		</form>
	</body>

	<!-- DataTables JavaScript -->
    <!-- <script src="<?=base_url();?>plugin/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>plugin/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script> --><!-- <link rel="stylesheet" href="<?=base_url();?>asset/css/datatablestyle.css" type="text/css" media="screen"/> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        
        var token = document.getElementById('token').value;
        
        var postData = {
			<?= $this->security->get_csrf_token_name() ?> : token,
		};

        var table = $('#ListBank').DataTable({
            "responsive"   : true,
            "processing"   : true,
            "serverSide"   : true,
            "paging":   true,
            "searching": true,
            "ajax"   : {
                url : "<?=base_url();?>Filter.jsp/show_investor_filter",
                type: "post",
                data: postData,
                dataSrc : ''
            },
            "columns": [
		        { "data": "Sid" },
		        { "data": "Nama" },
		        { "data": "NoIdentitas" },
		        { "data": "TglLahir" },
		        { "data": "TempatLahir" },
		        { "data": "KdJenisKelamin" },
		        { "data": "KdPekerjaan" },
		        { "data": "KdKota" },
		        { "data": "province" },
		        { "data": "Alamat" },
		        { "data": "NoTelp" },
		        { "data": "NoHp" },
		        { "data": "Email" },
		        { "data": "Status" }
		    ],
            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable                    
            		"data": null,
                    "defaultContent": '<a class="btn btn-sm btn-primary btn-sm">></a>'
                },
                {
                	"targets": [ 14 ],
                	"orderable" : false,
                	"searchable" : false,
                },
            ],       	         	        
	        "language": {
	            "lengthMenu": "<?= $this->lang->line('dt_show') ?> _MENU_ <?= $this->lang->line('dt_record') ?> <?= $this->lang->line('dt_per_page') ?>",
	            "zeroRecords": "<?= $this->lang->line('dt_empty') ?>",
	            "info": "<?= $this->lang->line('dt_show') ?> <?= $this->lang->line('dt_page') ?> _PAGE_ <?= $this->lang->line('dt_of') ?> _PAGES_ <?= $this->lang->line('dt_page') ?>",
	            "infoEmpty": "<?= $this->lang->line('dt_empty') ?>",
	            "infoFiltered": "<?= $this->lang->line('dt_filtered') ?> <?= $this->lang->line('dt_of') ?> _MAX_ <?= $this->lang->line('dt_record') ?>)",
	            "search": "<?= $this->lang->line('dt_search') ?>",
	            "processing": "<?= $this->lang->line('dt_processsing') ?>",
	        }
        });  
        $('#ListBank tbody').on( 'click', 'a', function () {
       		var data = table.row( $(this).parents('tr') ).data();
       		getValue(data["Sid"],data["Nama"],data["NoIdentitas"],data["TglLahir"],data["TempatLahir"],data["KdJenisKelamin"],data["KdPekerjaan"],data["KdKota"],data["province"],data["Alamat"],data["NoTelp"],data["NoHp"],data["Email"],data["Status"]);
	    } );    
    });
    </script>
</html>