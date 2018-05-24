<?php
 /*
require_once('./vendor/autoload.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token 
$channel_token = 'AaC6MGkTB53CyXHhSFQtJ0jB/7N3Us/ZIlUtYpDuaLY59fhT8NRXI13cV3TuBewRIz6To7lN29uWOYAELcimK1ihnHKnN7wZE0F0infoxvns9AAaKMULnrWd9U//hUALyqAIsBTVDt9EVWo0/ly93AdB04t89/1O/w1cDnyilFU=';
$channel_secret = '9b9944d9c68676a215b2efa60ae862c9'; 
// Create bot
$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
*/

// Database connection 
$host = 'ec2-174-129-223-193.compute-1.amazonaws.com';

$dbname = 'd74bjtc28mea5m'; 
$user = 'eozuwfnzmgflmu'; 
$pass = '2340614a293db8e8a8c02753cd5932cdee45ab90bfcc19d0d306754984cbece1'; 
$connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass); 



$query = "INSERT INTO test(name) values ('test')";
$connection->execute($query);

/*
// Get message from Line API 
$content = file_get_contents('php://input');
 $events = json_decode($content, true); 

// Bot response 
$respMessage = 'Your data has saved.'; 
$replyToken = $event['replyToken']; 
$textMessageBuilder = new TextMessageBuilder($respMessage); 
$response = $bot->replyMessage($replyToken, $textMessageBuilder);
*/


echo "OK Slips1";
