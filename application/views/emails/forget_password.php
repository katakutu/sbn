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
	<p>Halo <?php echo $name; ?>. Password Anda telah diatur ulang. Anda dapat masuk ke dalam sistem menggunakan data berikut:</p>
	<p>Username : <?php echo $userid; ?></p>
	<p>Password : <?php echo $passcode; ?></p>
	<p>Semoga informasi ini bermanfaat untuk Anda.</p>
    <br />
    <p >Hormat kami,</p>
    <p style=""font-weight:bold;"">PT. Bank Rakyat Indonesia (Persero).</p>
    <br/>
    <p style="font-size: 12px; color: #565656;">Email ini dihasilkan oleh komputer dan tidak perlu dijawab.</p>
</div>
<p>=========================================================================================</p>
<div>
	<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"></div>
	<p>Hello <?php echo $name; ?>. Your password has been reset. You can log in to the system using this following data:</p>
	<p>Username : <?php echo $userid; ?></p>
	<p>Password : <?php echo $passcode; ?></p>
	<p>Hopefully this information can be useful for you.</p>
    <br />
    <p >Best regards,</p>
    <p style=""font-weight:bold;"">PT. Bank Rakyat Indonesia (Persero).</p>
    <br/>
    <p style="font-size: 12px; color: #565656;">This is a computer-generated email, please do not reply.</p>
</div>
</body>

</html>