<?php

require_once 'mandrill_mail.php';

//define("API_URL", "http://api.eshopinion.com");
define("API_URL", "http://api-test.eshopinion.com");
define("LANDING_URL", "http://www.eshopinion.com/landing.php");

if (!$_GET['id']) {
    return;
}

//Get shop for id
$shop_JSON = file_get_contents(API_URL . '/shops/' . $_GET['id']);
$shop = json_decode($shop_JSON, true);

// No shop
if (!$shop) {
    return;
}

// Get mail to be sended
if(isset($_GET['lang']))
{
    if(file_exists('./templates/shop_collector_mail_' . $_GET['lang'] . '.php'))
        include_once './templates/shop_collector_mail_' . $_GET['lang'] . '.php';
    else
        include_once './templates/shop_collector_mail.php';
}
else
{
    if($shop['lang'])
    {
        if(file_exists('./templates/shop_collector_mail_' . $shop['lang'] . '.php'))
            include_once './templates/shop_collector_mail_' . $shop['lang'] . '.php';
        else
            include_once './templates/shop_collector_mail.php';
    }
    else
    {
        include_once './templates/shop_collector_mail.php';
    }
}

echo $html_mail['html'];
?>
