<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting extends CI_Controller {
	var $sess;
	var $sessLang;

	/*
	* method constructor untuk class login.
	*/
	function __construct()
	{
		parent::__construct();
		$this->ibank_session->checking_session();
		$this->sess = $this->session->userdata('session');
		$this->sessLang = $this->session->userdata('session_lang');
		$this->load->model(array('reportingtransaction_model'));
	}

	function daily()
	{
		if(isset($_POST['cari'])){
		  if(isset($_POST['seri']) && $_POST['seri']!=''){
		    $data['data'] = $this->reportingtransaction_model->get_daily($_POST['seri']);	
		  } else {
		    $data['data'] = array();	
		  }
		  	
		} else {
		  $data['data'] = array();
		}
		
		$this->load->view('transaction/reporting/daily', $data);
	}

	function daily_export_csv($id)
	{
		ob_clean();
		$filename = 'daily_export'.date('dmYHis').'.csv';
		header('Content-Transfer-Encoding: UTF-8');
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Pragma: no-cache');
        header('Expires: 0');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'wb');

		// output the column headings
		// fputcsv($output, array('NAMA', 'TANGGAL TRANSAKSI', 'NOMOR ORDER', 'STATUS TRANSAKSI'));
		if($id!=''){
		  
		    $data = $this->reportingtransaction_model->get_daily($id);
		    foreach ($data as $key) {
	            fputcsv($output, array_values($key));
		    }
		  	
		} 
		fclose($output);
		ob_flush();
	}

	function daily_export_xls($id)
	{
		ob_clean();
		$filename = 'daily_export'.date('dmYHis').'.xls';
        header('Content-Disposition: attacment;filename='.$filename);
		echo '<table style="border-collapse: collapse;" border="1">
                  <thead>
                       <tr>
                           <th style="text-align: center;border:0px solid #000;" colspan="4">LAPORAN DATA PENJUALAN HARIAN</th>
                       </tr>
                       <tr>
                           <th style="background-color: #FF8C00;height:5px;border:0px solid #000;" colspan="4"></th>
                       </tr>
                       <tr>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NAMA</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">TANGGAL TRANSAKSI</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NOMOR ORDER</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">STATUS TRANSAKSI</th>
                      </tr>
                  </thead>
                  <tbody>';
                  if($id!=''){
                  	$data = $this->reportingtransaction_model->get_daily($id);
					foreach ($data as $key) {
					    echo '<tr>
                                 <td>
                                 '.$key['NAME'].'
                                 </td>
                                 <td style="text-align: center;mso-number-format:\@;">
                                 '.date('d-m-Y H:i:s', strtotime($key['creation_date'])).'
                                 </td>
                                 <td style="text-align: center;mso-number-format:\@;">
                                 '.$key['order_id'].'
                                 </td>
                                 <td style="text-align: center;">
                                 '.$key['status'].'
                                 </td>
                              </tr>'; 	
					}
                  }
       echo '	  </tbody>
            </table>';
       ob_flush();
	}

	function daily_export_txt($id)
	{
		ob_clean();
		$separator = ",";
		$filename = 'daily_export'.date('dmYHis').'.txt';
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename='.$filename);
		// echo 'NAMA'.$separator.'TANGGAl TRANSAKSI'.$separator.'NOMOR ORDER'.$separator."STATUS TRANSAKSI\r\n";
		if($id!=''){
		   $data = $this->reportingtransaction_model->get_daily($id);
		   foreach($data as $key) {
			 echo $key['NAME'].$separator.date('Y-m-d H:i:s', strtotime($key['creation_date'])).$separator.$key['order_id'].$separator.$key['status']."\r\n";
		   }
		}
		ob_flush();
	}

	function final_transaction()
	{
		if(isset($_POST['cari'])){
		  if(isset($_POST['seri']) && $_POST['seri']!=''){
			$data['data'] = $this->reportingtransaction_model->get_final_transaction_all($_POST['seri']);
		  } else {
		  	$data['data'] = array();
		  }
		} else {
			$data['data'] = array();
		}
		$this->load->view('transaction/reporting/final', $data);
		// var_dump($data['data']);
		// exit();
	}

	function final_transaction_export_csv($id)
	{
		ob_clean();
		$filename = 'final_transaction_export'.date('dmYHis').'.csv';
		header('Content-Transfer-Encoding: UTF-8');
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Pragma: no-cache');
        header('Expires: 0');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'wb');

		// output the column headings
		// fputcsv($output, array('KODE PEMESANAN', 'KODE BILLING', 'NTPN', 'NTB', 'STATUS PEMESANAN', 'SERI', 'MITRA DISTRIBUSI', 'SID', 'NAMA', 'AMOUNT', 'NOMOR REKENING', 'NOMOR IDENTITAS', 'TEMPAT LAHIR', 'TANGGAL LAHIR', 'JENIS KELAMIN', 'PEKERJAAN', 'ALAMAT', 'KODE KOTA', 'KODE PROVINSI', 'NOMOR TELEPON', 'NOMOR HANDPHONE', 'EMAIL', 'TANGGAL PEMESANAN', 'NOMOR REKENING SECURITIES', 'KODE BANK', 'KUSTODIAN'));
		if($id!=''){
		  
		    $data = $this->reportingtransaction_model->get_final_transaction_all($id);
		    foreach ($data as $value) {
		    	$gender = (($value['GENDER'] == 1) ? 'Laki-laki' : 'Perempuan');
		    	fputcsv($output, array($value['order_id'],$value['billing_code'],$value['ntpn'],$value['ntb'],$value['status'],$value['seri_name'],$value['created_by'],$value['sid'],$value['NAME'],$value['amount'],$value['NOMOR_REKENING'],$value['NOMOR_KTP'],$value['TEMPAT_LAHIR'],date('Y-m-d', strtotime($value['TANGGAL_LAHIR'])),$gender,$value['PEKERJAAN'],$value['ALAMAT'],$value['KODE_KOTA'],$value['KODE_PROVINSI'],$value['NOMOR_TELEPON'],$value['NOMOR_HANDPHONE'],$value['EMAIL'],$value['creation_date'],$value['sec_account_no'],$value['KODE_BANK'],$value['subreg_name']));	
		    }
		  	
		} 
		ob_flush();
	}

	function final_transaction_export_xls($id)
	{
		ob_clean();
		$filename = 'final_transaction_export'.date('dmYHis').'.xls';
        header('Content-Disposition: attacment;filename='.$filename);
		echo '<table style="border-collapse: collapse;" border="1">
                  <thead>
                       <tr>
                           <th style="text-align: center;border:0px solid #000;" colspan="26">Laporan Akhir Transaksi</th>
                       </tr>
                       <tr>
                           <th style="background-color: #FF8C00;height:5px;border:0px solid #000;" colspan="26"></th>
                       </tr>
                       <tr>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">KODE PEMESANAN</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">KODE BILLING</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NTPN</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NTB</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">STATUS PEMESANAN</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">SERI</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">MITRA DISTRIBUSI</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">SID</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NAMA</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">AMOUNT</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NOMOR REKENING</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NOMOR IDENTITAS</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">TEMPAT LAHIR</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">TANGGAL LAHIR</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">JENIS KELAMIN</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">PEKERJAAN</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">ALAMAT</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">KODE KOTA</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">KODE PROVINSI</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NOMOR TELEPON</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NOMOR HANDPHONE</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">EMAIL</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">TANGGAL PEMESANAN</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">NOMOR REKENING SECURITIES</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">KODE BANK</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;height:27px;">KUSTODIAN</th>
                      </tr>
                  </thead>
                  <tbody>';
                  if($id!=''){
                  	$data = $this->reportingtransaction_model->get_final_transaction_all($id);
					foreach ($data as $value) {
					    echo '<tr>
                                 <td style="text-align: center;mso-number-format:\@;">'.$value['order_id'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$value['billing_code'].'</td>
		                    	 <td>'.$value['ntpn'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$value['ntb'].'</td>
		                    	 <td style="text-align:center;">'.$value['status'].'</td>
		                    	 <td>'.$value['seri_name'].'</td>
		                    	 <td>'.$value['created_by'].'</td>
		                    	 <td>'.$value['sid'].'</td>
		                    	 <td>'.$value['NAME'].'</td>
		                    	 <td style="text-align:right;mso-number-format:\@;">'.number_format($value['amount'],0,'.',',').'</td>
		                    	 <td style="mso-number-format:\@;">'.$value['NOMOR_REKENING'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$value['NOMOR_KTP'].'</td>
		                    	 <td>'.$value['TEMPAT_LAHIR'].'</td>
		                    	 <td style="text-align: center;mso-number-format:\@;">'.date('d-m-Y', strtotime($value['TANGGAL_LAHIR'])).'</td>
		                    	 <td>'.(($value['GENDER'] == 1) ? 'Laki-laki' : 'Perempuan').'</td>
		                    	 <td>'.$value['PEKERJAAN'].'</td>
		                    	 <td>'.$value['ALAMAT'].'</td>
		                    	 <td style="text-align: center;mso-number-format:\@;">'.$value['KODE_KOTA'].'</td>
		                    	 <td style="text-align: center;mso-number-format:\@;">'.$value['KODE_PROVINSI'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$value['NOMOR_TELEPON'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$value['NOMOR_HANDPHONE'].'</td>
		                    	 <td>'.$value['EMAIL'].'</td>
		                    	 <td style="text-align:center;mso-number-format:\@;">'.date('d-m-Y H:i:s', strtotime($value['creation_date'])).'</td>
		                    	 <td style="mso-number-format:\@;">'.$value['sec_account_no'].'</td>
		                    	 <td style="text-align: center;mso-number-format:\@;">'.$value['KODE_BANK'].'</td>
		                    	 <td>'.$value['subreg_name'].'</td>
                              </tr>'; 	
					}
                  }
       echo '	  </tbody>
            </table>';
       ob_flush();
	}

	function final_transaction_export_txt($id)
	{
		ob_clean();
		$separator = ",";
		$filename = 'final_transaction_export'.date('dmYHis').'.txt';
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename='.$filename);
		// echo "KODE PEMESANAN".$separator."KODE BILLING".$separator."NTPN".$separator."NTB".$separator."STATUS PEMESANAN".$separator."SERI".$separator."MITRA DISTRIBUSI".$separator."SID".$separator."NAMA".$separator."AMOUNT".$separator."NOMOR REKENING".$separator."NOMOR IDENTITAS".$separator."TEMPAT LAHIR".$separator."TANGGAL LAHIR".$separator."JENIS KELAMIN".$separator."PEKERJAAN".$separator."ALAMAT".$separator."KODE KOTA".$separator."KODE PROVINSI".$separator."NOMOR TELEPON".$separator."NOMOR HANDPHONE".$separator."EMAIL".$separator."TANGGAL PEMESANAN".$separator."NOMOR REKENING SECURITIES".$separator."KODE BANK".$separator."KUSTODIAN\r\n";
		$text = '';
		if($id!=''){
		   $data = $this->reportingtransaction_model->get_final_transaction_all($id);
		   foreach($data as $value) {
		   	 $gender = (($value['GENDER'] == 1) ? 'Laki-laki' : 'Perempuan');
			 $text .= $value['order_id'].$separator.$value['billing_code'].$separator.$value['ntpn'].$separator.$value['ntb'].$separator.$value['status'].$separator.$value['seri_name'].$separator.$value['created_by'].$separator.$value['sid'].$separator.$value['NAME'].$separator.$value['amount'].$separator.$value['NOMOR_REKENING'].$separator.$value['NOMOR_KTP'].$separator.$value['TEMPAT_LAHIR'].$separator.date('Y-m-d', strtotime($value['TANGGAL_LAHIR'])).$separator.$gender.$separator.$value['PEKERJAAN'].$separator.$value['ALAMAT'].$separator.$value['KODE_KOTA'].$separator.$value['KODE_PROVINSI'].$separator.$value['NOMOR_TELEPON'].$separator.$value['NOMOR_HANDPHONE'].$separator.$value['EMAIL'].$separator.$value['creation_date'].$separator.$value['sec_account_no'].$separator.$value['KODE_BANK'].$separator.$value['subreg_name']."\r\n";
		   }

		}
		print($text);
		ob_flush();
	}

	function get_seri_name(){
		$keyword = strval($_POST['query']);
		$q = "SELECT seri_name FROM orders WHERE seri_name LIKE '$keyword%' GROUP BY seri_name";
		$query = $this->db->query($q);
		$seriResult = array();
		if($query->num_rows() > 0){
		    foreach ($query->result_array() as $value) {
				$seriResult[] = $value["seri_name"];
			}
			echo json_encode($seriResult);	
		}
		
	}
}

?>