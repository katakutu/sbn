<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = 'error/direction';
$route['translate_uri_dashes'] = FALSE;

/* routes for index */
$route['Login.jsp'] = 'login/index/id';
$route['Captcha.img'] = 'login/captcha';
$route['lang_(:any).jsp'] = 'login/index/$1';
$route['lang_(:any).jsp/(:any)'] = 'login/index/$1/$2';
$route['Terms.jsp/(:any)'] = 'front/term/$1';
$route['Faq.jsp/(:any)'] = 'front/faq/$1';
$route['Form.jsp/(:any)'] = 'front/registration/$1';
$route['ForgotPassword.jsp/(:any)'] = 'front/forgot_password/$1';
$route['Help.jsp/(:any)'] = 'front/help/$1';
$route['ContactUs.jsp/(:any)'] = 'front/contactus/$1';
$route['display.return/api/(:any)/redirect/(:any).java'] = 'front/api/validate/$1/$2';

$route['Form.jsp/FrontPopup.jsp/(:any)'] = 'front/front_popup/$1';
$route['Form.jsp/FrontPopupKota.jsp/(:any)'] = 'front/front_popup/KotaDb/$1';

/* routes for session */
$route['Auth.jsp/login'] = 'login/login';
$route['Auth.jsp/logout'] = 'login/logout';

/* routes for Popup */
$route['ListAccount.jsp/(:any)'] = 'general/popup/$1';
$route['ListDebitAccount.jsp/(:any)'] = 'general/popup/debit_account/$1';
$route['ListAccountExternal.jsp/(:any)'] = 'general/popup/credit_account/$1';
$route['ListAccountExternalInterbank.jsp/(:any)'] = 'general/popup/credit_account_interbank/$1'; /* ADD REYDIKA [20170309] UNTUK TRF ANTAR BANK */
$route['ListAccountOthers.jsp/(:any)'] = 'general/popup/others_account/$1';
$route['ListBank.jsp/(:any)'] = 'general/popup/$1';
$route['ListBIC.jsp/(:any)'] = 'general/popup/bic/$1';
$route['Token.jsp/(:any)'] = 'general/token/$1';
$route['ListLimit.jsp/(:any)'] = 'general/limit/$1';
$route['PertaminaMaterial.jsp/(:any)'] = 'general/popup/$1';
$route['PertaminaMaterial.jsp/(:any)/(:any)'] = 'general/popup/$1/$2';
$route['ListBrizzi.jsp/(:any)'] = 'general/popup/$1';
// $route['ListRekeningCredit.jsp/(:num)'] = 'general/popup/credit_account/$1'
$route['ListKdJenisPekerjaan.jsp/(:any)'] = 'general/popup/$1';;
$route['ListProvinsi.jsp/(:any)'] = 'general/popup/$1';
$route['ListKota.jsp/(:any)'] = 'general/popup/$1';;
$route['Filter.jsp/(:any)'] = 'general/popup/$1';
$route['ListKdBank.jsp/(:any)'] = 'general/popup/$1';
$route['ListKdSubreg.jsp/(:any)'] = 'general/popup/$1';
$route['ListSeriOffer.jsp/(:any)'] = 'general/popup/$1';
$route['ListFundAccount.jsp/(:any)'] = 'general/popup/$1';
$route['ListSecAccount.jsp/(:any)'] = 'general/popup/$1';
$route['ListOrder.jsp/(:any)'] = 'general/popup/$1';

/* routes for home */
$route['Home.jsp'] = 'base';
$route['Home.jsp/main'] = 'base/content';
$route['Home.jsp/main_main'] = 'base/key';
$route['Home.jsp/origin'] = 'base/sidemenu';
$route['Home.jsp/origin/(:num)'] = 'base/sidemenu/$1';
$route['Home.jsp/lang'] = 'base/getlang';
$route['default'] = 'base/default_pg';
/* routes for features */
$route['Redirect.jsp/(:any)/(:num)'] = 'general/director/route/$1/$2';

/* routes from error */
$route['Error_(:any).jsp/(:any)'] = 'error/direction/$1/$2';

/* routes for Transaction */
$route['TransferBRI.jsp/(:any)'] = 'transaction/transfer_bri/$1';
$route['TransferAntarBank.jsp/(:any)'] = 'transaction/transfer_antar_bank/$1';
$route['Kliring.jsp/(:any)'] = 'transaction/kliring/$1';
$route['Rtgs.jsp/(:any)'] = 'transaction/rtgs/$1';
$route['Information.jsp/(:any)'] = 'transaction/information/$1';
$route['Payroll.jsp/(:any)'] = 'transaction/payroll/$1';
$route['Swift.jsp/(:any)'] = 'transaction/swift/$1';

/* routes for Reporting */
$route['AccountReport.jsp/(:any)/(:any)'] = 'reporting/account/$1/$2';
$route['AccountReport.jsp/(:any)'] = 'reporting/account/$1';
$route['Brizzi.jsp/(:any)'] = 'reporting/brizzi/$1';
$route['SBNReport.jsp/(:any)'] = 'reporting/pemesanan/$1';
$route['SERI.jsp/(:any)'] = 'reporting/seri/$1';

/* routes for Administrator */
$route['UserMgt.jsp/(:any)'] = 'administrator/user_management/$1';
$route['WorkflowMgt.jsp/(:any)'] = 'administrator/workflow_management/$1';

/* routes for personalize password */
$route['Personalize.jsp/(:any)'] = 'personalize/Personalize/$1';

/* routes for Head office */
$route['ClientMgt.jsp/(:any)'] = 'headoffice/client_management/$1';

/* routes for payment */
$route['PaymentElectricity.jsp/(:any)'] = 'payment/pln/$1';
$route['PaymentCellular.jsp/(:any)'] = 'payment/cellular/$1';
$route['PaymentPertamina.jsp/(:any)'] = 'payment/pertamina/$1';
$route['PaymentMpn.jsp/(:any)'] = 'payment/mpn/$1';
$route['PaymentBriva.jsp/(:any)'] = 'payment/briva/$1';
$route['PaymentKk.jsp/(:any)'] = 'payment/kartukredit/$1';
$route['PaymentInformation.jsp/(:any)'] = 'payment/information/$1';
$route['PaymentCetakInformation.jsp/(:any)/(:any)'] = 'payment/information/$1/$2';
$route['PaymentTelephone.jsp/(:any)'] = 'payment/telkom/$1';
$route['PaymentSemen.jsp/(:any)'] = 'payment/semen/$1';
$route['PaymentPinjamanBri.jsp/(:any)'] = 'payment/pinjamanbri/$1';

/* routes for investor management */
$route['Investor.jsp/(:any)'] = 'investor/Investor/$1';
$route['Sid.jsp/(:any)'] = 'investor/Sid/$1';
$route['Subreg.jsp/(:any)'] = 'investor/Subreg/$1';
$route['Pemesanan.jsp/(:any)'] = 'transaction/Pemesanan/$1';
$route['Redemption.jsp/(:any)'] = 'transaction/Redemption/$1';

$route['Api.jsp/(:any)'] = 'api/statusbayar/$1';

/* routes for content */
$route['Content.jsp'] = 'manajemen/content/index';
$route['Content.jsp/add'] = 'manajemen/content/add';
$route['Content.jsp/update'] = 'manajemen/content/update';
$route['Content.jsp/change'] = 'manajemen/content/change';
$route['Content.jsp/delete'] = 'manajemen/content/delete';

/* routes for user */
$route['SendActivation.jsp'] = 'manajemen/users/send_activation';
$route['SendActivation.jsp/send/(:any)'] = 'manajemen/users/psend_activation/$1';
$route['UnlockUser.jsp'] = 'manajemen/users/unlock';
$route['UnlockUser.jsp/unlock/(:any)'] = 'manajemen/users/punlock/$1';

/* routes for report investor */
$route['InvestorReport.jsp/statistic'] = 'reporting/investor/statistic';
$route['InvestorReport.jsp/portofolio'] = 'reporting/investor/portofolio';

/* routes for transaction report */
$route['TransactionReport.jsp/daily'] = 'transaction/reporting/daily';
$route['TransactionReport.jsp/final'] = 'transaction/reporting/final_transaction';



