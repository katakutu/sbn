<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CI_Nusoap_lib
{
   function CI_Nusoap_lib()
   {
       require_once(BASEPATH.'libraries/Nusoap/nusoap.php');
	   require_once(BASEPATH.'libraries/Nusoap/class.wsdlcache.php');
   }
}
?>