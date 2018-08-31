<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			$.colorbox.close();
		});
		$('.select_menu').click(function(){
			if($(this).is(':checked')){
				$('.select_menu',$(this).parent().parent()).attr('checked',true);
			}else{
				$('.select_menu',$(this).parent().parent()).removeAttr('checked');
			}
		});
	});
        
        function nospaces(t){
        if(t.value.match(/\s/g)){
            alert('User ID tidak boleh mengandung spasi.');
            t.value=t.value.replace(/\s/g,'');
            }
        }

	function confirmInput(){
		var r = confirm("Apakah anda yakin dengan data yang diinput?");
		return r;
	}

	function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
	}
</script>
<style>
	ul#list-menu{
		margin: 0px;
		padding:0px;
		color: #004694;
	}
	ul#list-menu, ul#list-menu ul{
		
	}
	ul#list-menu li{
		padding:3px;
		margin-top:2px;
		list-style-type: none;
	}
</style>
<h1 class="maintitle">Create User</h1>
<?=isset($message)?$message:''?>
<?php echo form_open('user_management/create_user','id="form_create_user"');?>
<table align="center" cellpadding="3px" width="705px" cellspacing="0px" border="0" style="border-collapse:collapse">
<thead>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">USER ID</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_input(array('name'=>'txt_userid','id'=>'txt_userid','value'=>isset($userid)?$userid:'','maxlength'=>'20','style'=>'width:100%;','onkeyup'=>"nospaces(this)"));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('txt_userid','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">PN</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_input(array('name'=>'txt_pn','id'=>'txt_pn','value'=>isset($pn)?$pn:'','maxlength'=>'10','style'=>'width:100%;'));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('txt_pn','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">UNIT KERJA</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_input(array('name'=>'txt_uker','id'=>'txt_uker','value'=>isset($uker)?$uker:'','maxlength'=>'100','style'=>'width:100%;'));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('txt_uker','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">NAMA LENGKAP</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_input(array('name'=>'txt_username','id'=>'txt_username','value'=>isset($username)?$username:'','maxlength'=>'100','style'=>'width:100%;'));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('txt_username','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">JABATAN</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_input(array('name'=>'txt_jabatan','id'=>'txt_jabatan','value'=>isset($jabatan)?$jabatan:'','maxlength'=>'80','style'=>'width:100%;'));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('txt_jabatan','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">LEVEL</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_dropdown('drp_userlevel', array(''=>'','OPR'=>'Operator','SPV'=>'Supervisor'),isset($userlevel)?$userlevel:'');?></td>
        <td valign="middle" width="25px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('drp_userlevel','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">EMAIL</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_input(array('name'=>'txt_email','id'=>'txt_email','value'=>isset($email)?$email:'','maxlength'=>'100','style'=>'width:100%;'));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('txt_email','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" class="theader">TELEPON</th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_input(array('name'=>'txt_telp','id'=>'txt_telp','onkeypress'=>'return isNumberKey(event)','value'=>isset($telp)?$telp:'','maxlength'=>'20','style'=>'width:100%;'));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">*</td>
        <td valign="middle" width="150px" align="left" class="tcell"><?php echo form_error('txt_telp','<span>','</span>'); ?></td>
</tr>
<tr>
	<th valign="middle" width="250px" align="left" ><i>* = Mandatory Field</i></th>
	<td valign="middle" width="300px" align="left" class="tcell"><?=form_submit(array('name'=>'btn_save','id'=>'btn_save','value'=>'Simpan','class'=>'button','title'=>'Klik di sini untuk menyimpan data.','onclick'=>'return confirmInput()'));?></td>
        <td valign="middle" width="5px" align="middle" class="tcell">&nbsp;</td>
        <td valign="middle" width="150px" align="left" class="tcell"></td>
</tr>
</thead>
</table>
</form>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
