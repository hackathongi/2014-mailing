<?php
require_once 'Mandrill/Mandrill.php';

define("ESHOPINION_MAIL", "eshopinion@gmail.com");
define("ESHOPINION_NAME", "eShopinion");

function send_opinion_request($shop, $html_msg, $customer, $ip_pool = 'Main Pool')
{
    // Initiate Mandrill
    $mandrill = new Mandrill($shop['mandrill_key']);

    // Prepare message array
    $message = array(
        'html' => $html_msg['html'],
        'text' => '',
        'subject' => $html_msg['subject'],
        'from_email' => $shop['e-mail'],
        'from_name' => $shop['name'],
        'to' => array(
            array(
                'email' => $customer['e-mail'],
                'name' => 'Recipient Name',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => $shop['e-mail']),
        'important' => false,
        'track_opens' => true,
        'track_clicks' => true,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'global_merge_vars' => null,
        'merge_vars' => null,
        'tags' => null,
        'subaccount' => null,
        'google_analytics_domains' => null,
        'google_analytics_campaign' => null,
        'metadata' => null,
        'recipient_metadata' => null,
        'attachments' => null,
        'images' => null
    );
    $async = false;
    
    // Send message
    $result = $mandrill->messages->send($message, $ip_pool, $customer['e-mail']);
    
    // Return result
    switch($result[0]['status'])
    {
        case "sent":
        case "queued":
            return true;
            break;
        case "error":
            return $result[0]['code'] . "|" . $result[0]['message'];
            break;
    }
}

function send_collector_request($html_msg, $shop, $ip_pool = 'Main Pool')
{
    // Initiate Mandrill
    $mandrill = new Mandrill($shop['mandrill_key']);

    // Prepare message array
    $message = array(
        'html' => $html_msg['html'],
        'text' => '',
        'subject' => $html_msg['subject'],
        'from_email' => ESHOPINION_MAIL,
        'from_name' => ESHOPINION_NAME,
        'to' => array(
            array(
                'email' => $shop['e-mail'],
                'name' => 'Recipient Name',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => ESHOPINION_MAIL),
        'important' => false,
        'track_opens' => true,
        'track_clicks' => true,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'global_merge_vars' => null,
        'merge_vars' => null,
        'tags' => null,
        'subaccount' => null,
        'google_analytics_domains' => null,
        'google_analytics_campaign' => null,
        'metadata' => null,
        'recipient_metadata' => null,
        'attachments' => null,
        'images' => null
    );
    $async = false;
    
    // Send message
    $result = $mandrill->messages->send($message, $ip_pool, $shop['e-mail']);
    
    // Return result
    switch($result[0]['status'])
    {
        case "sent":
        case "queued":
            return true;
            break;
        case "error":
            return $result[0]['code'] . "|" . $result[0]['message'];
            break;
    }
}
    

?>
