<?php
 
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

// Database connection 
$host = 'ec2-54-243-129-189.compute-1.amazonaws.com'; 
$dbname = 'ddad3lvtccl8i9'; 
$user = 'jknxgucpqtqspw';
$pass = 'e4612e631a195ea8e460ecabb629fcf13027aec5fcfc29c7b32ffa377bb913f5'; 

$connection = new PDO(sprintf('pgsql:host=%s;dbname=%s', $host, $database), $username, $password);

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
    
        // Line API send a lot of event type, we interested in message only.
		if ($event['type'] == 'message') {           
           
                    
			  
$query = "INSERT INTO slips (user_id, slip_date, name) values ('3', '2018-05-21','test')";
$myPDO->execute($query);
                   
                    // Bot response 
                    $respMessage = 'Your data has saved.';
                    $replyToken = $event['replyToken'];
                    $textMessageBuilder = new TextMessageBuilder($respMessage);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);

            
                
                    
                    
	  
		}
	}
}

echo "OK Slips1";
