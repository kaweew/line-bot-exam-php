<?php
require "vendor/autoload.php";

$access_token = 'ZRy9NdUUIyNUC5V/Ka8tbgxZWTOejy+8EFsdUAfvdsC8Y+xvO8wC7gmSkAgIFFc6Gi5W3MprNVi8EUv52qSgWwm2xwwlLLG+ym0EN2DzDq0RqV1IkcYPM32JD4KVeaQTQWPyGJIY4Sk4x4X4khzrHgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '70caa8313776365f76a9521a9abfc3f8';
$multicastPushIDs = array(
    'U842c2884dad3c4fda6e844e35b33dc29'    // Kawee
    //'Cd0d18c6d9d8c351987a81cf9c61f067c'	    // Group System Monitor
);

// Get POST body content
$content = file_get_contents('php://input');
echo $content;
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
echo "\r\n----- event dont be null -----\r\n";
    // Loop through each event
    foreach ($events['events'] as $event) {
echo "\r\n----- event 1 -----\r\n";
        // Reply only when message sent is in 'text' format
var_dump($event);
echo "\r\n----- End Var Dump -----\r\n";
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
echo "\r\n----- match message -----\r\n";
            // Get Source Device
            $source = $event['source'];
            // Get text sent
            $text = $event['message']['text'];
            // Make a POST Request to Messaging API to reply to sender
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

            $msg = $source . "\r\n" . $text;
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);
            $response = $bot->multicast($multicastPushIDs, $textMessageBuilder);

            echo $response->getHTTPStatus() . ' ' . $response->getRawBody() . "\r\n";
        }
    }
}
else {
    echo "Cannot Parse Data";
}
