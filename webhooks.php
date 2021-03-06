<?php // callback.php
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'ZRy9NdUUIyNUC5V/Ka8tbgxZWTOejy+8EFsdUAfvdsC8Y+xvO8wC7gmSkAgIFFc6Gi5W3MprNVi8EUv52qSgWwm2xwwlLLG+ym0EN2DzDq0RqV1IkcYPM32JD4KVeaQTQWPyGJIY4Sk4x4X4khzrHgdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            if (0 == strcasecmp($event['message']['text'], 'id')) {
                if(isset($event['source']['userId'])){
                    $text = 'Your ID is ' . $event['source']['userId'];
                }
                else {
                    $text = "No User ID information.";
                }
            }
            elseif (0 == strcasecmp($event['message']['text'], 'group')) {
                if(isset($event['source']['groupId'])){
                    $text = 'Group ID is ' . $event['source']['groupId'];
                }
                else {
                    $text = "No Group ID information.";
                }
            }
            elseif (0 == strcasecmp($event['message']['text'], 'room')) {
                if(isset($event['source']['room'])){
                    $text = 'Room ID is ' . $event['source']['room'];
                }
                else {
                    $text = "No Room ID information.";
                }
            }
            //else {
            //    $text = $event['message']['text'] . " จ๊ะ";
            //}
        } // End Message Type is Text
        // Get replyToken
        $replyToken = $event['replyToken'];
        // Build message to reply back
        $messages = [
            'type' => 'text',
            'text' => $text
        ];
        // Make a POST Request to Messaging API to reply to sender
        $url = 'https://api.line.me/v2/bot/message/reply';
        $data = [
            'replyToken' => $replyToken,
            'messages' => [$messages],
        ];
        $post = json_encode($data);
        $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result . "\r\n";
    }
}
echo "OK";
