<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investor extends CI_Controller {
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
		$this->load->model(array('reportinginvestor_model'));
		$this->load->library(array('sbn_tambahan'));
	}

	function statistic()
	{
		$data['data'] = $this->reportinginvestor_model->get_statistic_all();
		$this->load->view('reporting/investor/statistic', $data);
		// var_dump($data['data']);
		// exit;
	}

	function statistic_export_csv()
	{
		ob_clean();
		$filename = 'static_export'.date('dmYHis').'.csv';
		header('Content-Transfer-Encoding: UTF-8');
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Pragma: no-cache');
        header('Expires: 0');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'wb');

		// output the column headings
		fputcsv($output, array('NAMA', 'JENIS KELAMIN', 'EMAIL', 'NOMOR KARTU IDENTITAS', 'NPWP', 'SID', 'SUBREG', 'ALAMAT', 'NOMOR TELEPON', 'NOMOR HANDPHONE', 'NOMOR REKENING', 'TANGGAL REGISTRASI'));
		$data = $this->reportinginvestor_model->get_statistic_all();
		foreach ($data as $key) {
			// if(trim($key) !=''){
			  fputcsv($output, array($key['NAME'], $key['gender'], $key['email'], $key['idcard_no'], $key['NPWP'], $key['SID'], $key['SUBREG'], $key['address'], $key['phone_no'], $key['mobilephone_no'], $key['NOMOR_REKENING'], $key['creation_date']));	
			// }
		   		
		}	
		ob_flush();  	
	}

	function statistic_export_xls()
	{
		ob_clean();
		$filename = 'static_export'.date('dmYHis').'.xls';
        header('Content-Disposition: attacment;filename='.$filename);
		echo '<table style="border-collapse: collapse;" border="1">
                  <thead>
                       <tr>
                           <th style="text-align: center;border:none;" colspan="12">LAPORAN DATA STATIK NASABAH</th>
                       </tr>
                       <tr>
                           <th style="background-color: #FF8C00;height:5px;border:none;" colspan="12"></th>
                       </tr>
                       <tr>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NAMA</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">JENIS KELAMIN</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;"EMAIL</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NOMOR KARTU IDENTITAS</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NPWP</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">SID</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">SUBREG</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">ALAMAT</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NOMOR TELEPON</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NOMOR HANDPHONE</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NOMOR REKENING</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">TANGGAL REGISTRASI</th>
                      </tr>
                  </thead>
                  <tbody>';
                  
                  	$data = $this->reportinginvestor_model->get_statistic_all();
					foreach ($data as $key) {
					    echo '<tr>
                                 <td>'.$key['NAME'].'</td>
		                    	 <td>'.$key['gender'].'</td>
		                    	 <td>'.$key['email'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$key['idcard_no'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$key['NPWP'].'</td>
		                    	 <td>'.$key['SID'].'</td>
		                    	 <td>'.$key['SUBREG'].'</td>
		                    	 <td>'.$key['address'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$key['phone_no'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$key['mobilephone_no'].'</td>
		                    	 <td style="mso-number-format:\@;">'.$key['NOMOR_REKENING'].'</td>
		                    	 <td style="text-align:center;mso-number-format:\@;">'.date('d-m-Y H:i:s', strtotime($key['creation_date'])).'</td>
                              </tr>'; 	
					}
                  
       echo '	  </tbody>
            </table>';
       ob_flush();
	}

	function statistic_export_txt()
	{
		ob_clean();
		$separator = ",";
		$filename = 'static_export'.date('dmYHis').'.txt';
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename='.$filename);
		// echo 'NAMA'.$separator.'TANGGAl TRANSAKSI'.$separator.'NOMOR ORDER'.$separator."STATUS TRANSAKSI\r\n";
		
		$data = $this->reportinginvestor_model->get_statistic_all();
		foreach($data as $key) {
			 echo $key['NAME'].$separator.$key['gender'].$separator.$key['email'].$separator.$key['idcard_no'].$separator.$key['NPWP'].$separator.$key['SID'].$separator.$key['SUBREG'].$separator.$key['address'].$separator.$key['phone_no'].$separator.$key['mobilephone_no'].$separator.$key['NOMOR_REKENING'].$separator.$key['creation_date']."\r\n";
		}
	   ob_flush();
		
	}

	function portofolio()
	{
		$data['data'] = $this->reportinginvestor_model->get_portofolio_all();
		$this->load->view('reporting/investor/portofolio', $data);
		// var_dump($data['data']);
		// exit;
	}

	function portofolio_export_xls()
	{
		ob_clean();
		$filename = 'portofolio_export'.date('dmYHis').'.xls';
        header('Content-Disposition: attacment;filename='.$filename);
		echo '<table border="1">
                  <thead>
                       <tr>
                           <th style="text-align: center;border-width:0;" colspan="4">LAPORAN PORTOFOLIO NASABAH</th>
                       </tr>
                       <tr>
                           <th style="background-color: #FF8C00;height:5px;border:0;" colspan="4"></th>
                       </tr>
                       <tr>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">NAMA</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">SID</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">SUBREG</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;">JUMLAH PORTOFOLIO</th>
                      </tr>
                  </thead>
                  <tbody>';
                  
                  	$data = $this->reportinginvestor_model->get_portofolio_all();
					foreach ($data as $key) {
					    echo '<tr>
                                 <td>'.$key['NAME'].'</td>
		                    	 <td>'.$key['SID'].'</td>
		                    	 <td>'.$key['SUBREG'].'</td>
		                    	 <td style="text-align:center;">'.$key['JUMLAH_PORTOFOLIO'].'</td>
                              </tr>'; 	
					}
                  
       echo '	  </tbody>
            </table>';
       ob_flush();
	}
}

?>