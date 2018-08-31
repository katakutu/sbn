<?php


function succ_msg($param){
	$CI =& get_instance();
  	return '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <strong><h5>'.$CI->lang->line('success').'.</h5></strong>  <h5>'.$param.'</h5></div>';
}

function warn_msg($param){
	$CI =& get_instance();
  	return '<div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <strong>'.$CI->lang->line('warning').'.</strong>  '.$param.'</div>';
}

function err_msg($param){
	$CI =& get_instance();
    return '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <strong>'.$CI->lang->line('error').'.</strong>  '.$param.'</div>'; 
}

function err_msg_2($param){
	$CI =& get_instance();
    return '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            '.$param.'</div>'; 
}

function info_msg($param){
	$CI =& get_instance();
  	return '<div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <strong>Info.</strong>  '.$param.'</div>';
}

function flash_succ($msg="")
{
  $CI =& get_instance();
  $msg = succ_msg($msg);
  $CI->session->set_flashdata('message',$msg);
}

function flash_warn($msg="")
{
  $CI =& get_instance();
  $msg = warn_msg($msg);
  $CI->session->set_flashdata('message',$msg);
}

function flash_info($msg="")
{
  $CI =& get_instance();
  $msg = info_msg($msg);
  $CI->session->set_flashdata('message',$msg);
}

function flash_err($msg="")
{
  $CI =& get_instance();
  $msg = err_msg($msg);
  $CI->session->set_flashdata('message',$msg);
}

function flash_err_2($msg="")
{
  $CI =& get_instance();
  $msg = err_msg_2($msg);
  $CI->session->set_flashdata('message',$msg);
}

function cetak_flash_msg()
{
  $CI =& get_instance();
  echo $CI->session->flashdata('message');
}	

function is_direct()
{
  return(empty($_SERVER['HTTP_REFERER']))?true:false;
}

?>