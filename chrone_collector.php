<?php

require_once 'mandrill_mail.php';

//define("API_URL", "http://api.eshopinion.com");
define("API_URL", "http://api-test.eshopinion.com");
define("LANDING_URL", "http://www.eshopinion.com/landing.php");

$test = $_GET['test'] ? $_GET['test'] : false;

//Get pending orders ready to be send
$crawled_shops_JSON = file_get_contents( API_URL . '/shops/crawled');
$crawled_shops = json_decode($crawled_shops_JSON, true);

// No pending orders
if(!$crawled_shops) return;

// Counters
$i_crawled_shops = count($crawled_shops);
$i_send_shops = 0;

foreach($crawled_shops as $shop)
{
    // Get mail to be sended
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

    // Send mail
    if(!$test) {
        $res = send_collector_request($html_mail, $shop);

        if($res)
        {
            $i_send_shops++;
            // Post sended status
            file_get_contents( API_URL . '/shops/crawled/' . $shop['user_id']);
        }
        else
        {
            echo $res."<br/>";
        }
    }
    else
    {
        $i_send_shops++;
    }
}

echo "DONE<br/>";
echo "Crawled shops: " . $i_pending_orders . "<br/>";
echo "Send shops: " . $i_send_shops . "<br/>";

?>
