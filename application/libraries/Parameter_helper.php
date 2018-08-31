<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parameter_helper
{
	/* var LOGGED */
	public $LOGIN 	= 1;
	public $LOGOUT	= 0;

	public $header_app = "BRI SBN Ritel Online";
	public $name_app = "BRI SBN Ritel Online";
	// public $logo_app = "<b><font size=\"6\" color=\"#ec6f24\">iBBIZ</font><font size=\"6\" color=\"#ffffff\">BRI</font></b>";
	public $logo_app = "<b><font size=\"6\" color=\"#ec6f24\">iBBIZ</font><font size=\"6\" color=\"#ffffff\">BRI</font></b>";
	public $login_header = "<b><p style=\"text-align: center; border-style: solid; border-top-color: #ec6f24; border-right-color: #ec6f24; border-left-color: #013161; border-bottom-color: #013161; background-color:#fff; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; \"><font size=\"6\" color=\"#ec6f24\">SBN Ritel Online </font><font size=\"6\" color=\"#013161\">BRI</font></p></b>";

	public $ibank_mdw 	= "http://10.35.65.191:7000/?wsdl";
	public $medalion_mdw 	= "http://10.35.65.191:5050/MedalionMiddleware.asmx?wsdl";
	public $serverid	= "10.35.65.38";

	public $kodefundaccountbri = "42";
	public $kodesecaccountbri = "398";

}
?>