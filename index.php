<?php 

require_once('./vendor/autoload.php'); 
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 

// Token 
$channel_token = 'AaC6MGkTB53CyXHhSFQtJ0jB/7N3Us/ZIlUtYpDuaLY59fhT8NRXI13cV3TuBewRIz6To7lN29uWOYAELcimK1ihnHKnN7wZE0F0infoxvns9AAaKMULnrWd9U//hUALyqAIsBTVDt9EVWo0/ly93AdB04t89/1O/w1cDnyilFU=';
$channel_secret = '9b9944d9c68676a215b2efa60ae862c9'; 

// Get message from Line API 
$content = file_get_contents('php://input'); 
$events = json_decode($content, true); 
if (!is_null($events['events'])) { 
  
// Loop through each event 
foreach ($events['events'] as $event) {
  
// Line API send a lot of event type, we interested in message only. 
if ($event['type'] == 'message' && $event['message']['type'] == 'text') { 
  
// Get replyToken 
$replyToken = $event['replyToken']; 
switch($event['message']['text']) { 
case 'โทร': 
$respMessage = '089-5124512'; 
break; 
case 'ที่อยู่': 
$respMessage = '99/451 Muang Nonthaburi'; 
break; 
case 'boss': 
$respMessage = '089-2541545'; 
break; 
case 'ช่วย': 
    
$respMessage = 'วิธีใช้งาน ให้พิมม์'. '\r\n'.'โทร '.'\r\n'.'ที่อยุ่'.'\r\n'.'ช่วย'.'\r\n'.'จะแสดงรายละเอียดออกมา';
  //'โทร'.'ที่อยุ่'.'ช่วย'.'จะแสดงรายละเอียดออกมา'; 
break; 
default: 
break; 
} 
$httpClient = new CurlHTTPClient($channel_token); 
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret)); 
$textMessageBuilder = new TextMessageBuilder($respMessage); 
$response = $bot->replyMessage($replyToken, $textMessageBuilder); 
} 
} 
} 
echo "OK Operator3";
