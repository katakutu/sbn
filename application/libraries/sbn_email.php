<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sbn_email {
	var $CI;

	function __construct() {
		$this->CI =& get_instance();
	}

	function email_setup(){

		$config['protocol']		= "smtp";
		$config['smtp_host']	= "131.100.55.166";
		$config['smtp_port']	= "25";
		$config['smtp_timeout'] = '60';
		$config['mailtype'] 	= "html";
		$config['useragent'] = 'BRI';

		$this->CI->load->library('email',$config);
    // $this->CI->email->initialize($config); 
	}

	function email_register($to_email, $name){
		$this->email_setup();

		$data = array(
       		'name'=> $name,
       		'email' => $to_email,
        );

        $this->CI->email->set_newline("\r\n");
		$this->CI->email->from("sbnro@bri.co.id", 'SBN RETAIL ONLINE'); 
        $this->CI->email->to($to_email);
        $this->CI->email->subject('Registration Information'); 
        $body = $this->CI->load->view('emails/process_register.php', $data, TRUE);
        $this->CI->email->message($body);
        //$this->CI->email->send();
        if (!$this->CI->email->send()) {  
        	return false;
		}else{  
			return true;   
		} 
	}

	function email_register_fail_dukcapil($to_email, $name){
		$this->email_setup();

		$data = array(
       		'name'=> $name,
       		'email' => $to_email,
        );

        $this->CI->email->set_newline("\r\n");
		$this->CI->email->from("sbnro@bri.co.id", 'SBN RETAIL ONLINE'); 
        $this->CI->email->to($to_email);
        $this->CI->email->subject('Registration Information'); 
        $body = $this->CI->load->view('emails/failed_register.php', $data, TRUE);
        $this->CI->email->message($body);
        //$this->CI->email->send();
        if (!$this->CI->email->send()) {  
        	return false;
		}else{  
			return true;   
		} 
	}

  function email_contact($email, $name, $handphone, $message){
    $this->email_setup();

    $data = array(
      'email' => $email,
          'name'=> $name,
          'handphone' => $handphone,
          'message' => $message,
        );

        // $this->CI->email->set_newline("\r\n");
        $this->CI->email->from("sbnro@bri.co.id", 'SBN RITEL ONLINE'); 
        $this->CI->email->to($email);
        $this->CI->email->subject('Reply Message'); 
        $body = $this->CI->load->view('emails/contactus.php', $data, TRUE);
        $this->CI->email->message($body);
        //$this->CI->email->send();
        if (!$this->CI->email->send()) {  
          return false;
        }else{  
          return true;
        } 
  }

	function email_order($to_email, $billing, $limit, $orderid, $amount)
	{
		$this->email_setup();

		$limit_formatted = date("d-m-Y H:i:s", strtotime($limit));

		$data = array(
       		'billing'=> $billing,
       		'email' => $to_email,
       		'limit' => $limit_formatted,
       		'orderid' => $orderid,
       		'amount' => number_format($amount),
        );

        $this->CI->email->set_newline("\r\n");
		$this->CI->email->from("sbnro@bri.co.id", 'SBN RETAIL ONLINE'); 
        $this->CI->email->to($to_email);
        $this->CI->email->subject('Oder Notification - ' .$orderid); 
        $body = $this->CI->load->view('emails/order_notification.php', $data, TRUE);
        $this->CI->email->message($body);
        if (!$this->CI->email->send()) {  
        	return false;
		}else{  
			return true;   
		} 
	}

  function email_redeem($to_email, $redemptionid, $orderid, $amount, $tglredeem)
  {
    $this->email_setup();

    $data = array(
          'email' => $to_email,
          'redemptionid' => $redemptionid,
          'orderid' => $orderid,
          'amount' => number_format($amount),
          'redemdate' => $tglredeem,
        );

        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from("sbnro@bri.co.id", 'SBN RETAIL ONLINE'); 
        $this->CI->email->to($to_email);
        $this->CI->email->subject('Redemption Notification - ' .$orderid); 
        $body = $this->CI->load->view('emails/redeem_notification.php', $data, TRUE);
        $this->CI->email->message($body);
        if (!$this->CI->email->send()) {  
          return false;
    }else{  
      return true;   
    } 
  }

	function email_reset_password($to_email, $passcode, $name, $userid){
		$this->email_setup();

		$data = array(
       		'passcode'=> $passcode,
       		'email' => $to_email,
       		'name' => $name,
       		'userid' => $userid,
        );

        $this->CI->email->set_newline("\r\n");
		$this->CI->email->from("sbnro@bri.co.id", 'SBN RETAIL ONLINE'); 
        $this->CI->email->to($to_email);
        $this->CI->email->subject('Forget password'); 
        $body = $this->CI->load->view('emails/forget_password.php', $data, TRUE);
        $this->CI->email->message($body);
        //$this->CI->email->send();
        if (!$this->CI->email->send()) {  
        	return false;
		}else{  
			return true;   
		} 
	}
}

?>