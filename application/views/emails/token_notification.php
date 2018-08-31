<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>SBN Retail Online BRI</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<style type="text/css">
	p {
		Margin-top: 0;color: #000;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px;
	}
</style>
<body>
 <div>
	<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"></div>
	<p>Hai, kami informasikan kode verifikasi transaksi Anda adalah sebagai berikut:</p>
	<p>Kode Verifikasi   : <b><?php echo $token; ?></b>.</p>
	<p>Anda menerima pesan ini karena adanya proses transaksi yang dilakukan. Silahkan menggunakan kode tersebut untuk melanjutkan proses transaksi Anda. Jika Anda tidak merasa melakukan transaksi, silahkan abaikan atau hapus pesan ini.</p>
    <br />
    <p >Hormat kami,</p>
    <p style=""font-weight:bold;"">PT. Bank Rakyat Indonesia (Persero).</p>
    <br/>
    <p style="font-size: 12px; color: #565656;">Email ini dihasilkan oleh komputer dan tidak perlu dijawab.</p>
</div>
<p>=========================================================================================</p>
<div>
	<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"></div>
	<p>Hi, we inform you that your transaction verification code is:</p>
	<p>Verification Code   : <b><?php echo $token; ?></b>.</p>
	<p>You received this message because of the transaction process performed. Please use the code to continue ypur transaction process. If you do not feel like having a transaction process, please ignore or delete this message.</p>
    <br />
    <p >Best regards,</p>
    <p style=""font-weight:bold;"">PT. Bank Rakyat Indonesia (Persero).</p>
    <br/>
    <p style="font-size: 12px; color: #565656;">This is a computer-generated email, please do not reply.</p>
</div>
</body>

</html>