<html>
<head>
	<title>Laporan Data Penjualan Harian</title>
</head>
<body>
    <?php
        $filename = 'daily_export'.date('dmYHis').'.xls';
        header('Content-Disposition: attacment;filename='.$filename);
        header('Content-type: application/vnd-ms-excel');
		echo '<table class="border-collapse: collapse;">
                  <thead>
                       <tr>
                           <th style="text-align: center;" colspan="4">LAPORAN DATA PENJUALAN HARIAN</th>
                       </tr>
                       <tr>
                           <th style="background-color: #FF8C00;height:5px;" colspan="4"></th>
                       </tr>
                       <tr>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;border-style: solid;">NAMA</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;border-style: solid;">TANGGAL TRANSAKSI</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;border-style: solid;">NOMOR ORDER</th>
                           <th style="text-align: center;background: #00008B;color:#fff;vertical-align:middle;border-style: solid;">STATUS TRANSAKSI</th>
                      </tr>
                  </thead>
                  <tbody>';
                  if($id!=''){
                  	$data = $this->reportingtransaction_model->get_daily($id);
					foreach ($data as $key) {
					    echo '<tr>
                                 <td style="border-style: solid;">
                                 '.$key['NAME'].'
                                 </td>
                                 <td style="text-align: center;border-style: solid;">
                                 '.date('d-m-Y H:i:s', strtotime($key['creation_date'])).'
                                 </td>
                                 <td style="text-align: center;border-style: solid;">
                                 '.$key['order_id'].'
                                 </td>
                                 <td style="text-align: center;border-style: solid;">
                                 '.$key['status'].'
                                 </td>
                              </tr>'; 	
					}
                  }
       echo '	  </tbody>
            </table>';
       ?>
</body>
</html>