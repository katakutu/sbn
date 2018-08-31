<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends CI_Model 
{
        

    var $Log = "log_api";
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function update_bayar($data=array())
    {
        try
        {
			$KodePemesanan = $this->db->escape($data['KodePemesanan']);
			$KodeBilling = $this->db->escape($data['KodeBilling']);
			$NTPN = $this->db->escape($data['NTPN']);
            $NTB = $this->db->escape($data['NTB']);
			$TglJamPembayaran = $this->db->escape($data['TglJamPembayaran']);
			$TglJamPembayaran = str_replace('T', ' ', $TglJamPembayaran);
			$TglJamPembayaran = str_replace('Z', '', $TglJamPembayaran);
			$BankPersepsi = $this->db->escape($data['BankPersepsi']);
			$ChannelPembayaran = $this->db->escape($data['ChannelPembayaran']);
			$ModifiedAt = $this->db->escape($data['ModifiedAt']);
            $ModifiedAt = str_replace('T', ' ', $ModifiedAt);
            $ModifiedAt = str_replace('Z', '', $ModifiedAt);
			$ModifiedBy = $this->db->escape($data['ModifiedBy']);
            $Status = "'Completed Order'";
            $IdStatus = "'4'";
			
			$qstr = "UPDATE orders SET ntpn = $NTPN, ntb = $NTB, payment_date = $TglJamPembayaran, bank_persepsi = $BankPersepsi, payment_channel = $ChannelPembayaran, modification_date = $ModifiedAt, modified_by = $ModifiedBy, status = $Status,
                id_status = $IdStatus WHERE order_id = $KodePemesanan AND billing_code = $KodeBilling";
            $query = $this->db->query($qstr);
            if(!$query)
            {       
            	return false;
            }
            else if ($this->db->affected_rows() == 0)
            {
            	return false;
            }
            else
            {
        		return true;
        	}
        }
        catch(Exception $e)
        {
			return false;
        }
    }

    function SaveLog($data)
    {
        $this->db->trans_begin();
        $this->db->insert($this->Log, $data);
        if($this->db->trans_status() === FALSE)
        {
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }
	
	
}
