<?php
require_once 'mandrill_mail.php';

//define("API_URL", "http://api.eshopinion.com");
define("API_URL", "http://api-test.eshopinion.com");
define("FORM_URL", "http://form.eshopinion.com");

$test = $_GET['test'] ? $_GET['test'] : false;

//Get pending orders ready to be send
$pending_orders_JSON = file_get_contents( API_URL . '/orders/pending');
$pending_orders = json_decode($pending_orders_JSON, true);

// No pending orders
if(!$pending_orders) return;

// Counters
$i_pending_orders = count($pending_orders);
$i_processed_orders = 0;
$i_send_orders = 0;

foreach($pending_orders as $order)
{
    // Get current order structure
    $pending_order_JSON = file_get_contents( API_URL . '/orders/'.$order['order_id']);
    $pending_order = json_decode($pending_order_JSON, true);

    // Bad order
    if(!$pending_order) continue;
    $i_processed_orders++;

    // Get mail to be sended
    $po = $pending_order['order'];
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

    // Send mail
    if(!$test) {
        $res = send_opinion_request($po['shop'], $html_mail, $po['client']);

        if($res)
        {
            $i_send_orders++;
            // Post sended status
            file_get_contents( API_URL . '/orders/pending/' . $order['order_id']);
        }
        else
        {
            echo $res."<br/>";
        }
    }
    else
    {
        $i_send_orders++;
    }
}

echo "DONE<br/>";
echo "Pending orders: " . $i_pending_orders . "<br/>";
echo "Processed orders: " . $i_processed_orders . "<br/>";
echo "Send orders: " . $i_send_orders . "<br/>";

?>
