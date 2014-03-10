<?php
$html_mail['subject'] = 'Valora la teva experiència';
$html_mail['html'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body style="margin:auto 0;padding: 20px 20px;">
<img src="' . $po['shop']['logo_url'] . '" width="99" height="100" />

<h1 style="font-family:Arial, Helvetica, sans-serif;font-size:16px;font-weight:600;color:#0C2A38;margin-top:20px;">
Hola ' . $po['client']['name'] . '!</h1>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#666;">Moltes gràcies per comprar a <strong>' . $po['shop']['name'] . '</strong>.
En agradaria saber com valores l\'experiència que has tingut en la teva compra on-line!</p> 
<a  href="'.FORM_URL.'?h='.$po['id_order'].'" style="text-decoration:none;color:#1D8CAC;font-size:13px;width:100px;height:24px;margin: 20px 0 20px 0;border-radius:4px;background-color:#1D8CAC;padding-top:10px;text-align:center;color:#fff;font-size:13px;font-family:Arial, Helvetica, sans-serif;text-transform:uppercase;display:block;"> VALORA</a>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#666;">Gràcies per la teva confiança,</p>'
. $shop['firma_html'] . '
</div>

</body>
</html>'

?>