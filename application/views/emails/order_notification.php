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
	<p>Hai, kami informasikan bahwa pesanan Anda sudah diproses.</p>
	<p>Silahkan selesaikan pesanan Anda sebelum <b><?php echo $limit ?></b>.</p>
	<p>ID Pesanan   : <b><?php echo $orderid; ?></b>.</p>
	<p>ID Tagihan   : <b><?php echo $billing; ?></b>.</p>
	<p>Nominal      : IDR <b><?php echo $amount; ?></b>.</p>
	<p>Anda dapat melakukan pembayaran menggunakan channel BRI seperti ATM, Internet Banking dan Unit Kerja BRI melalui fitur pembayaran MPN Gen 2. Semoga informasi ini bermanfaat untuk Anda.</p>
    <br />
    <p >Hormat kami,</p>
    <p style=""font-weight:bold;"">PT. Bank Rakyat Indonesia (Persero).</p>
    <br/>
    <p style="font-size: 12px; color: #565656;">Email ini dihasilkan oleh komputer dan tidak perlu dijawab.</p>
</div>
<p>=========================================================================================</p>
<div>
	<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"></div>
	<p>Hi, we inform you that your order has been proceed.</p>
	<p>Please complete your order before <b><?php echo $limit; ?></b>.</p>
	<p>Order ID   : <b><?php echo $orderid; ?></b>.</p>
	<p>Billing ID : <b><?php echo $billing; ?></b>.</p>
	<p>Amount     : IDR <b><?php echo $amount; ?></b>.</p>
	<p>You can complete your order payment using BRI channel such as ATM, Internet Banking and BRI office by MPN Gen 2 payment feature. Hopefully this information can be useful for you.</p>
    <br />
    <p >Best regards,</p>
    <p style=""font-weight:bold;"">PT. Bank Rakyat Indonesia (Persero).</p>
    <br/>
    <p style="font-size: 12px; color: #565656;">This is a computer-generated email, please do not reply.</p>
</div>
</body>

</html>