<?php
require "vendor/autoload.php";

$access_token = 'ZRy9NdUUIyNUC5V/Ka8tbgxZWTOejy+8EFsdUAfvdsC8Y+xvO8wC7gmSkAgIFFc6Gi5W3MprNVi8EUv52qSgWwm2xwwlLLG+ym0EN2DzDq0RqV1IkcYPM32JD4KVeaQTQWPyGJIY4Sk4x4X4khzrHgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '70caa8313776365f76a9521a9abfc3f8';
$multicastPushIDs = array(
    'U842c2884dad3c4fda6e844e35b33dc29'    // Kawee
);

// Get POST body content
$content = file_get_contents('php://input');
echo $condtent
// Parse JSON
//$events = json_decode($content, true);
/*
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->multicast($multicastPushIDs, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
*/
