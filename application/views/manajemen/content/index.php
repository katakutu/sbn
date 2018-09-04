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
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>plugin/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<style>
		th { font-size: 11px; }
		td { font-size: 11px; }
		.panel-primary { border-color: black; }
		.modal-header {
			color: #fff;
		    padding:9px 15px;
		    border-bottom:1px solid #eee;
		    background-color: #ec971f;
		    -webkit-border-top-left-radius: 5px;
		    -webkit-border-top-right-radius: 5px;
		    -moz-border-radius-topleft: 5px;
		    -moz-border-radius-topright: 5px;
		     border-top-left-radius: 5px;
		     border-top-right-radius: 5px;
		 }

	</style>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('manajemen_content_data') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('manajemen') ?></a></li>
					<li class="active"><?= $this->lang->line('manajemen_content') ?></li>
					<li class="active"><?= $this->lang->line('manajemen_content_data') ?></li>
				</ol>

				
				<br>
				<div class="panel-body">
					<div><button class="btn btn-primary" data-toggle="modal" data-target="#addContent"><i class="fa fa-plus"></i> <?php echo $this->lang->line('manajemen_content_add');?></button></div>
					<div class="table table-responsive">
		            	<table class="table table-striped table-bordered table-hover" id="manajemen_content" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                        	<th style="text-align: center;">No.</th>
		                        	<th style="text-align: center;"><?= $this->lang->line('title') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('status') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('upload_date') ?></th>
		                        	<th style="text-align: center;"><?= $this->lang->line('last_update') ?></th>
			        				<th style="text-align: center;">Action</th>
					    		</tr>
							</thead>
		                    <tbody>
		                    	<?php
		                    	     $no = 1;
		                    	     if(count($data) > 0){
		                    	     	foreach($data as $value) {
			                    	     	echo '<tr>
			                    	     	       <td>'.$no.'.</td>
			                    	     	       <td>'.$value['judul'].'.</td>
			                    	     	       <td style="text-align:center;">'.(($value['status'] == 1) ? $this->lang->line('publish') : $this->lang->line('no_publish')).'</td>
			                    	     	       <td style="text-align: center;">'.(($value['tgl_upload'] != NULL || $value['tgl_upload'] != '0000-00-00') ? date('d/m/Y H:i:s', strtotime($value['tgl_upload'])) : '').'</td>
			                    	     	       <td style="text-align: center;">'.(($value['last_update'] != NULL || $value['last_update'] != '0000-00-00') ? date('d/m/Y H:i:s', strtotime($value['last_update'])) : '').'</td>
			                    	     	       <td><a href="#" data-toggle="modal" data-target="#changeContent'.$no.'"><i class="fa fa-image"></i></a> &nbsp;&nbsp; <a href="#" data-toggle="modal" data-target="#updateContent'.$no.'"><i class="fa fa-edit"></i></a> &nbsp;&nbsp; <a href="#" data-toggle="modal" data-target="#deleteContent'.$no.'"><i class="fa fa-trash"></i></a></td>
			                    	     		  </tr>';
			                    	     		  ?>
			                    	     		    <!-- Modal -->
													<div id="updateContent<?=$no?>" class="modal fade" role="dialog">
													  <div class="modal-dialog">

													    <!-- Modal content-->
													    <div class="modal-content">
													      <form action="<?php echo base_url();?>Content.jsp/update" method="post" enctype="multipart/form-data">
													      	<input type="hidden" name="id" value="<?php echo $value['id'];?>">
													      <div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													        <h4 class="modal-title"><?php echo $this->lang->line('manajemen_content_form_update');?></h4>
													      </div>
													      <div class="modal-body">
													        
													        	<div class="form-group">
																    <label for="title" class="col-md-3"><?php echo $this->lang->line('title');?></label>
																    <div class="col-md-9">
																       <input type="text" name="judul" class="form-control" value="<?php echo $value['judul'];?>" required="required">
																    </div>
																</div>
																<div class="form-group">
																    <label for="status" class="col-md-3"><?php echo $this->lang->line('status');?></label>
																    <div class="col-md-4">
																    	<select name="status" class="form-control">
																    		<option value="1" <?php echo $value['status'] == '1' ? 'selected' : '' ?>><?php echo $this->lang->line('publish');?></option>
																    		<option value="0" <?php echo $value['status'] == '0' ? 'selected' : '' ?>><?php echo $this->lang->line('no_publish');?></option>
																    	</select>
																    </div>
																</div>
													       
													      </div>
													      <div class="modal-footer">
													      	<button type="submit" class="btn btn-warning"><?php echo $this->lang->line('save_button');?></button> &nbsp;
													        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
													      </div>
													       </form>
													    </div>

													  </div>
													</div>
													<!-- Modal -->
													<div id="deleteContent<?=$no?>" class="modal fade" role="dialog">
													  <div class="modal-dialog">

													    <!-- Modal content-->
													    <div class="modal-content">
													      <form action="<?php echo base_url();?>Content.jsp/delete" method="post" enctype="multipart/form-data">
													      	<input type="hidden" name="id" value="<?php echo $value['id'];?>">
													      <div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													        <h4 class="modal-title"><?php echo $this->lang->line('delete_content');?></h4>
													      </div>
													      <div class="modal-body">
													        
													       <?php echo $this->lang->line('confirm_delete_content');?>
													       
													      </div>
													      <div class="modal-footer">
													      	<button type="submit" class="btn btn-warning"><?php echo $this->lang->line('yes');?></button> &nbsp;
													        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
													      </div>
													       </form>
													    </div>

													  </div>
													</div>
			                    	     		  <?php
			                    	     		  $no++;
			                    	     }
		                    	     }
		                    	     
		                    	?>
		                    </tbody>
		                </table>
					</div>
				</div>
            </div>
		</div>

		<!-- Modal -->
		<div id="addContent" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <form action="<?php echo base_url();?>Content.jsp/add" method="post" enctype="multipart/form-data">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><?php echo $this->lang->line('manajemen_content_add');?></h4>
		      </div>
		      <div class="modal-body">
		        
		        	<div class="form-group">
					    <label for="title" class="col-md-3"><?php echo $this->lang->line('title');?></label>
					    <div class="col-md-9">
					       <input type="text" name="judul" class="form-control" required="required">
					    </div>
					</div>
					<div class="form-group">
					    <label for="file" class="col-md-3"><?php echo $this->lang->line('image_content');?></label>
					    <div class="col-md-9">
					    	<input type="file" name="path_gambar" class="form-control" required="required">	
					    </div>
					</div>
					<div class="form-group">
					    <label for="status" class="col-md-3"><?php echo $this->lang->line('status');?></label>
					    <div class="col-md-4">
					    	<select name="status" class="form-control">
					    		<option value="1"><?php echo $this->lang->line('publish');?></option>
					    		<option value="0"><?php echo $this->lang->line('no_publish');?></option>
					    	</select>
					    </div>
					</div>
		       
		      </div>
		      <div class="modal-footer">
		      	<button type="submit" class="btn btn-warning"><?php echo $this->lang->line('save_button');?></button> &nbsp;
		        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
		      </div>
		       </form>
		    </div>

		  </div>
		</div>

		<!-- Modal -->
		<div id="contentMessage" class="modal" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><?php echo $this->lang->line('message');?></h4>
		      </div>
		      <div class="modal-body">
		        
		        	<?php echo $this->session->flashdata('message');?>
		        	<?php echo $this->session->flashdata('error');?>
		       
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
		      </div>
		       </form>
		    </div>

		  </div>
		</div>
	</body>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>plugin/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/responsive.bootstrap.min.css">
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>plugin/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url();?>js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url();?>js/responsive.bootstrap.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">
    	$(function () {
    		$('#manajemen_content').DataTable();
    		var message = '<?=$this->session->flashdata("message")?>';
    		var error = '<?=$this->session->flashdata("error")?>';
    		if(message!=''){
    			$('#contentMessage').modal('show');
    		}

    		if(error!=''){
    			$('#contentMessage').modal('show');
    		}
    	});
    </script>
</html>