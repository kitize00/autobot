<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
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
$respMessage = 'Your data has saved Text.'.$event['message']['id']; 
  
$replyToken = $event['replyToken']; 
$textMessageBuilder = new TextMessageBuilder($respMessage); 
$response = $bot->replyMessage($replyToken, $textMessageBuilder); 
break; 
case 'image': 

// Get file content. 
$fileID = $event['message']['id']; 
$response = $bot->getMessageContent($fileID); 
$fileName = md5(date('Y-m-d')).'.jpg'; 
if ($response->isSucceeded()) { 

// Create file. 
$file = fopen($fileName, 'w'); 
fwrite($file, $response->getRawBody()); 
$sql = sprintf( 
"SELECT * FROM slips WHERE slip_date='%s' AND user_id='%s' ", 
date('Y-m-d'), 
$event['source']['userId']); 
$result = $connection->query($sql); 
if($result !== false && $result->rowCount() >0) { 

// Save database 
$params = array( 
'image' => $fileName, 
'slip_date' => date('Y-m-d'), 
'user_id' => $event['source']['userId'], 
); 
$statement = $connection->prepare('UPDATE slips SET image=:image WHERE slip_date=:slip_date AND user_id=:user_id'); 
$statement->execute($params); 
} else { 
$params = array( 
'user_id' => $event['source']['userId'] , 
'image' => $fileName, 
'slip_date' => date('Y-m-d'),
); 
$statement = $connection->prepare('INSERT INTO slips (user_id, image, slip_date) VALUES (:user_id, :image, :slip_date)'); 
$statement->execute($params); 
} 
} 

// Bot response 
$respMessage = 'Your data has saved Images.'.$event['message']['id']; 
$replyToken = $event['replyToken']; 
$textMessageBuilder = new TextMessageBuilder($respMessage); 
$response = $bot->replyMessage($replyToken, $textMessageBuilder); 
 
break; 
} 
} 
} 
} 
echo "OK Slip2";
?>


<h2>HTML Image</h2>
<!--
<img src="public/img/5905b55d316c98ef24463edad0a1fbb4.jpg" alt="Mountain View" width="500" height="377">
-->

  
<?php 
 /* 
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('AaC6MGkTB53CyXHhSFQtJ0jB/7N3Us/ZIlUtYpDuaLY59fhT8NRXI13cV3TuBewRIz6To7lN29uWOYAELcimK1ihnHKnN7wZE0F0infoxvns9AAaKMULnrWd9U//hUALyqAIsBTVDt9EVWo0/ly93AdB04t89/1O/w1cDnyilFU=');
  
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '9b9944d9c68676a215b2efa60ae862c9']);
//$response = $bot->getProfile('U3f74bda0541d40bdfb461ba224c0ba11');//ออม
  
//$response = $bot->getProfile('Ua2010f21cf2e3ba7f3b45e88a4f8b602');//พี่เอส
  
  $response = $bot->getProfile('U6a900c42ef3d3dad5c3fbdb763d69552');
  
if ($response->isSucceeded()) {
    $profile = $response->getJSONDecodedBody();
    echo $profile['displayName']."<br>";
    echo $profile['pictureUrl']."<br>";
    echo $profile['statusMessage']."<br>";
}
  
*/
  
 /* 
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('AaC6MGkTB53CyXHhSFQtJ0jB/7N3Us/ZIlUtYpDuaLY59fhT8NRXI13cV3TuBewRIz6To7lN29uWOYAELcimK1ihnHKnN7wZE0F0infoxvns9AAaKMULnrWd9U//hUALyqAIsBTVDt9EVWo0/ly93AdB04t89/1O/w1cDnyilFU=');
  
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '9b9944d9c68676a215b2efa60ae862c9']);
$response = $bot->getMessageContent('8011086635888');
if ($response->isSucceeded()) {
    $tempfile = tmpfile();
    fwrite($tempfile, $response->getRawBody());
} else {
    error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
}

  */


  
 
  ?>
 
  <!--<img src="https://kitize-bot.herokuapp.com/620f84dd8c75f340243fbd5cd34bfe5d.jpg" alt="Smiley face" height="42" width="42">-->
   
</body>
</html>
