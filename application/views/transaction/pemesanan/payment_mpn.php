<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->lang->line('beneficiary_bank') ?>
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="Keywords" content="keyword">
	<meta name="Description" content="description">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">

	<!-- DataTables JavaScript -->
	<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/flag.css">
	<link rel="stylesheet" href="<?= base_url() ?>plugin/AdminLTE.min.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery.payment.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/side.js"></script>
	<style type="text/css">
		td {
		    padding-top: .5em;
		    padding-bottom: .5em;
		}
	</style>
</head>

<div class="col-xs-12 col-sm-12 col-md-10">
	<div class="panel panel-primary">
		<h3 style="text-align: right; padding-right: 25px">
			<i class="fa fa-feed"></i> <b><?= $this->lang->line('pemesanan') ?></b>
		</h3>
		<div class="panel-body">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('pemesanan') ?></li>
				<li class="active"><?= $this->lang->line('payment_mpn') ?></li>
			</ol>
	<form action="<?php echo base_url();?>Pemesanan.jsp/add?>" id="detailorder" class="form" target="content">
	<input type="hidden" value="" name="orderdate" id="orderdate" />
	<input type="hidden" value="" name="payout" id="payout" />
	<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
	
	<div>
		<div class="row">
	        <div class="col-md-6">
	          <div class="box box-solid">
	            <div class="box-header with-border">
	              <span class="fa fa-credit-card"><h3 class="box-title">&nbspPetunjuk pembayaran melalui MPN Gen2</h3></span>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <div class="box-group" id="accordion">
	                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	                        Internet Banking
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="collapseOne" class="panel-collapse collapse in">
	                    <div class="box-body">
	                    <span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        1   
						    </strong>
						</span>&nbspLogin ke internet banking bri ib.bri.co.id.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        2   
						    </strong>
						</span>&nbspPilih menu pembayaran MPN.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        3   
						    </strong>
						</span>&nbspPilih nomor  rekening dan masukkan kode billing.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        4   
						    </strong>
						</span>&nbspKlik kirim untuk melanjutkan transaksi.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        5   
						    </strong>
						</span>&nbspMasukkan password dan mToken, kemudian klik Kirim.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        6   
						    </strong>
						</span>&nbspNasabah akan mendapatkan NTPN, untuk mengakhiri transaksi silahkan tekan tombol tutup.<br>
							<div style="color:red;">*Note : Maksimum transaksi sesuai dengan limit kartu</div>
	                    </div>
	                  </div>
	                </div>
	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
	                        ATM
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="collapseTwo" class="panel-collapse collapse">
	                    <div class="box-body">
	                        <span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        1   
						    </strong>
						</span>&nbspMasukkan ATM dan PIN BRI Anda.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        2   
						    </strong>
						</span>&nbspMasuk ke menu TRANSAKSI LAIN dan klik LAINNYA.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        3   
						    </strong>
						</span>&nbspMasuk ke menu PEMBAYARAN dan klik LAINNYA.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        4   
						    </strong>
						</span>&nbspPilih menu MPN dan masukkan kode billing.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        5   
						    </strong>
						</span>&nbspLanjutkan pembayaran<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        6   
						    </strong>
						</span>&nbspNasabah akan mendapatkan NTPN pada struk ATM.<br>
							<div style="color:red;">*Note : Maksimum transaksi sesuai dengan limit kartu.</div>
	                    </div>
	                  </div>
	                </div>
	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
	                        Teller
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="collapseThree" class="panel-collapse collapse">
	                    <div class="box-body">
	                    <span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						           
						    </strong>
						</span>&nbspSilahkan datang ke Unit Kerja BRI terdekat.<br>
	                    	<div style="color:red;">*Note : Maksimum transaksi sesuai dengan saldo rekening.</div>
	                    </div>
	                  </div>
	                </div>
	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
	                        iBBIZ BRI
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="collapseFour" class="panel-collapse collapse">
	                    <div class="box-body">
	                    <span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        1   
						    </strong>
						</span>&nbspLogin ke iBBIZ BRI biz.bri.co.id<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        2   
						    </strong>
						</span>&nbspPilih menu pembelian dan pembayaran. Pilih MPN Gen 2. Pilih menu input billing pajak<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        3   
						    </strong>
						</span>&nbspPilih nomor  rekening dan masukkan kode billing.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        4   
						    </strong>
						</span>&nbspLanjutkan transaksi hingga ke user signer.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        5   
						    </strong>
						</span>&nbspUser signer meneruskan transaksi dengan menggunakan token yang di generate.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        6   
						    </strong>
						</span>&nbspTransaksi diproses dan nasabah mendapatkan NTPN.<br>
							<div style="color:red;">*Note : Maksimum transaksi sesuai dengan limit iBBIZ.</div>
	                    </div>
	                  </div>
	                </div>
	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
	                        CMS
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="collapseFive" class="panel-collapse collapse">
	                    <div class="box-body">
	                    <span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        1   
						    </strong>
						</span>&nbspLogin ke CMS BRI ibank.bri.co.id<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        2   
						    </strong>
						</span>&nbspPilih menu Payment and Purchase. Pilih MPN Gen 2.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        3   
						    </strong>
						</span>&nbspPilih menu input kode billing. Pilih nomor  rekening dan masukkan kode billing.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        4   
						    </strong>
						</span>&nbspLanjutkan transaksi hingga ke user signer.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        5   
						    </strong>
						</span>&nbspUser signer meneruskan transaksi dengan memasukkan token.<br>
						<div class="fa fa-arrow-down" style="margin-left:7px;"></div><br>
							<span class="fa-stack">
						    <!-- The icon that will wrap the number -->
						    <span class="fa fa-circle-o fa-stack-2x"></span>
						    <!-- a strong element with the custom content, in this case a number -->
						    <strong class="fa-stack-1x">
						        6   
						    </strong>
						</span>&nbspTransaksi diproses dan nasabah mendapatkan NTPN.<br>
							<div style="color:red;">*Note : Maksimum transaksi sesuai dengan limit client CMS.</div>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
	        </div>
		</div>
	</div>
	</form>
	</div>
	</div>
</div>

</html>

<script type="text/javascript">

	parent.setIframeHeight('content');
	parent.waitingDialog.hide();
	
</script>