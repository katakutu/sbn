<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function insert_email_order($to_email, $billing, $limit, $orderid, $amount, $uid)
	{
		$limit_formatted = date("d-m-Y H:i:s", strtotime($limit));

		$data_email = array(
       		'billing'=> $billing,
       		'email' => $to_email,
       		'limit' => $limit_formatted,
       		'orderid' => $orderid,
       		'amount' => number_format($amount),
        );

    $data['TRXID'] = $orderid;
    $data['CLIENTID'] = $uid;
    $data['TIPE'] = '1';
    $data['SUBJECT'] = 'Oder Notification - ' .$orderid;
    $data['RECEIVER'] = $to_email;
    $data['CONTENT'] = $this->load->view('emails/order_notification.php', $data_email, TRUE);
    $data['STATUS'] = '0';
    $data['CREATEDTIME'] = date("Y-m-d H:i:s");
    $data['LASTUPDATE'] = date("Y-m-d H:i:s");
    $data['RESEND'] = '0';

    $this->db->insert('email',$data);
		if($this->db->affected_rows() > 0)
		{
		    return true;
		}

		return false;
	}

  function insert_email_redeem($to_email, $koderedeem, $kodepemesanan, $nominal, $tglredeem, $uid)
  {

    $data_email = array(
          'redemptionid'=> $koderedeem,
          'email' => $to_email,
          'orderid' => $kodepemesanan,
          'redemdate' => $tglredeem,
          'amount' => number_format($nominal),
        );

    $data['TRXID'] = $koderedeem;
    $data['CLIENTID'] = $uid;
    $data['TIPE'] = '1';
    $data['SUBJECT'] = 'Redeem Notification - ' .$koderedeem;
    $data['RECEIVER'] = $to_email;
    $data['CONTENT'] = $this->load->view('emails/redeem_notification.php', $data_email, TRUE);
    $data['STATUS'] = '0';
    $data['CREATEDTIME'] = date("Y-m-d H:i:s");
    $data['LASTUPDATE'] = date("Y-m-d H:i:s");
    $data['RESEND'] = '0';

    $this->db->insert('email',$data);
    if($this->db->affected_rows() > 0)
    {
        return true;
    }

    return false;
  }


  function insert_email_token($to_email, $token, $uid)
  {
    $data_email = array(
          'token'=> $token,
          'email' => $to_email,
        );

    $data['TRXID'] = $uid;
    $data['CLIENTID'] = $uid;
    $data['TIPE'] = '1';
    $data['SUBJECT'] = 'Verification Code Notification';
    $data['RECEIVER'] = $to_email;
    $data['CONTENT'] = $this->load->view('emails/token_notification.php', $data_email, TRUE);
    $data['STATUS'] = '0';
    $data['CREATEDTIME'] = date("Y-m-d H:i:s");
    $data['LASTUPDATE'] = date("Y-m-d H:i:s");
    $data['RESEND'] = '0';

    $this->db->insert('email',$data);
    if($this->db->affected_rows() > 0)
    {
        return true;
    }

    return false;
  }

  function insert_email_contactus($email, $name,$handphone,$message)
  {
    $data_email = array(
          'email' => $email,
          'name'=> $name,
          'handphone' => $handphone,
          'message' => $message,
        );

    $data['TRXID'] = '911';
    $data['CLIENTID'] = "911";
    $data['TIPE'] = '1';
    $data['SUBJECT'] = 'Reply Message';
    $data['RECEIVER'] = $email;
    $data['CONTENT'] = $this->load->view('emails/contactus.php', $data_email, TRUE);
    $data['STATUS'] = '0';
    $data['CREATEDTIME'] = date("Y-m-d H:i:s");
    $data['LASTUPDATE'] = date("Y-m-d H:i:s");
    $data['RESEND'] = '0';

    $this->db->insert('email',$data);
    if($this->db->affected_rows() > 0)
    {
        return true;
    }

    return false;
  }
}
?>