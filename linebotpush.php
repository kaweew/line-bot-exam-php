<?php
require "vendor/autoload.php";
$access_token = 'ZRy9NdUUIyNUC5V/Ka8tbgxZWTOejy+8EFsdUAfvdsC8Y+xvO8wC7gmSkAgIFFc6Gi5W3MprNVi8EUv52qSgWwm2xwwlLLG+ym0EN2DzDq0RqV1IkcYPM32JD4KVeaQTQWPyGJIY4Sk4x4X4khzrHgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '70caa8313776365f76a9521a9abfc3f8';

// Get POST body content
$content = file_get_contents('php://input');
echo $content;
// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
            // Get Source Device
            $pushID = $event['pushID'];
            // Get text sent
            $text = $event['message']['text'];
            // Make a POST Request to Messaging API to reply to sender

            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
            $response = $bot->pushMessage($pushID, $textMessageBuilder);
            echo $response->getHTTPStatus() . ' ' . $response->getRawBody() . "\r\n";
        }
    }
}
else {
    echo "Cannot Parse Data";
}
