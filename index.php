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

$connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass); 

// Get message from Line API 
$content = file_get_contents('php://input'); 
$events = json_decode($content, true); 
if (!is_null($events['events'])) { 
 
// Loop through each event 
foreach ($events['events'] as $event) { 
 
// Line API send a lot of event type, we interested in message only. 
if ($event['type'] == 'message') { 
switch($event['message']['type']) { 
case 'text': 
$sql = sprintf( 
"SELECT * FROM slips WHERE slip_date='%s' AND user_id='%s' ", 
date('Y-m-d'), 
$event['source']['userId']); 
$result = $connection->query($sql); 
 
  
if($result !== false && $result->rowCount() >0) { 
 
// Save database 
$params = array( 
'name' => $event['message']['text'], 
'slip_date' => date('Y-m-d'), 
'user_id' => $event['source']['userId'], 
); 
$statement = $connection->prepare('UPDATE slips SET name=:name WHERE slip_date=:slip_date AND user_id=:user_id'); 
$statement->execute($params); 
} else { 
$params = array( 
'user_id' => $event['source']['userId'] , 
'slip_date' => date('Y-m-d'), 
'name' => $event['message']['text'], 
); 
$statement = $connection->prepare('INSERT INTO slips (user_id, slip_date, name) VALUES (:user_id, :slip_date, :name)');
$effect = $statement->execute($params); 
} 
  
// Bot response 
$respMessage = 'Your data has saved TExt.'; 
$replyToken = $event['replyToken']; 
$textMessageBuilder = new TextMessageBuilder($respMessage); 
$response = $bot->replyMessage($replyToken, $textMessageBuilder); 
break; 


}
} 
} 
} 
echo "OK Slip 1";
