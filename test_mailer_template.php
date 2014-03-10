<?php

require_once 'mandrill_mail.php';

//define("API_URL", "http://api.eshopinion.com");
define("API_URL", "http://api-test.eshopinion.com");
define("FORM_URL", "http://form.eshopinion.com");

if (!$_GET['id']) {
    return;
}

// Get current order structure
$pending_order_JSON = file_get_contents( API_URL . '/orders/'.$_GET['id']);
$pending_order = json_decode($pending_order_JSON, true);

// Bad order
if(!$pending_order){
    return;
}

// Get mail to be sended
$po = $pending_order['order'];
if(isset($_GET['lang']))
{
    if(file_exists('./templates/opinion_request_mail_' . $_GET['lang'] . '.php'))
        include_once './templates/opinion_request_mail_' . $_GET['lang'] . '.php';
    else
        include_once './templates/opinion_html_mail.php';
}
else
{
    if($po['client']['lang'])
    {
        if(file_exists('./templates/opinion_request_mail_' . $po['client']['lang'] . '.php'))
            include_once './templates/opinion_request_mail_' . $po['client']['lang'] . '.php';
        else
            include_once './templates/opinion_html_mail.php';
    }
    else
    {
        include_once './templates/opinion_request_mail.php';
    }
}

echo $html_mail['html'];

?>
