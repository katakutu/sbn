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

  function email_send_activation($to_email, $name){
    $this->email_setup();
    $link = $this->generate_link($to_email);
    $query = $this->datauser($to_email);
    foreach ($query as $key) {
      $sid = $key['SID'];
      $user_id = $key['ID'];
      $subreg = $key['SUBREG'];
    }
    $data = array(
          'name'=> $name,
          'email' => $to_email,
          'ref_id' => $link,
          'user_id' =>$user_id,
          'subreg' =>$subreg,
          'sid' =>$sid 
        );

        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from("sbnro@bri.co.id", 'SBN RETAIL ONLINE'); 
        $this->CI->email->to($to_email);
        $this->CI->email->subject('Resend Link Activation'); 
        $body = $this->CI->load->view('emails/activation_register.php', $data, TRUE);
        $this->CI->email->message($body);
        //$this->CI->email->send();
        if (!$this->CI->email->send()) {  
          return false;
    }else{  
      $this->CI->load->library('audit_website');
      $this->CI->audit_website->write(0, 900002, 'RESEND LINK ACTIVATION', $to_email, date("Y-m-d H:i:s"));
      return true;   
    } 
  }

  function datauser($id){
    $this->CI->db->select('ID,SUBREG,SID');
    $this->CI->db->from('user');
    $this->CI->db->where('EMAIL', $id);
    $query = $this->CI->db->get('');
    return $query->result_array();
  }


  function generate_link($email)
  {
    $this->CI->load->model('Regis');
    $now = new Datetime ('NOW');
    $date = $now->format('HisdmY');

    $code = $email . $date;
    $code_encrypt = substr(hash('sha256', $code), 0, 45);

    $data['REF_ID'] = $code_encrypt;
    $data['REFDATE'] = $now->format('Y-m-d H:i:s');
    $data['LASTUPDATE'] = $now->format('Y-m-d H:i:s');;
    $data['ACTIVITY'] = 'RESEND LINK ACTIVATION';
    $data['DATA'] = 'RESEND LINK ACTIVATION|' . $email;
    $data['STATUS'] = '1';
    $data['DESCRIPTION'] = 'ACTIVE';

    $query_insert = $this->CI->Regis->insert_api($data);
    if($query_insert)
    {
      return $code_encrypt;
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