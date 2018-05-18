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

// Split message then keep it in database. 
$appointments = explode(',', $event['message']['text']); 
if(count($appointments) == 2) { 
$host = 'ec2-54-243-129-189.compute-1.amazonaws.com'; 
$dbname = 'ddad3lvtccl8i9'; 
$user = 'jknxgucpqtqspw';
$pass = 'e4612e631a195ea8e460ecabb629fcf13027aec5fcfc29c7b32ffa377bb913f5'; 
$connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass); 
$params = array( 
'time' => $appointments[0], 
'content' => $appointments[1], 
); 
$statement = $connection->prepare("INSERT INTO appointments (time, content) VALUES (:time, :content)"); 
$result = $statement->execute($params); 
  
$respMessage = 'Your appointment has saved.'; 
}else{ 
$respMessage = 'You can send appointment like this "12.00,House keeping." '; 
} 
$httpClient = new CurlHTTPClient($channel_token); 
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret)); 
$textMessageBuilder = new TextMessageBuilder($respMessage); 
$response = $bot->replyMessage($replyToken, $textMessageBuilder); 
} 
} 
} 
echo "OK Appointment4 "; 
echo "/n";
$con= mysqli_connect("ec2-54-243-129-189.compute-1.amazonaws.com","jknxgucpqtqspw","e4612e631a195ea8e460ecabb629fcf13027aec5fcfc29c7b32ffa377bb913f5","ddad3lvtccl8i9") or die("Error: " . mysqli_error($con));
$query1 = "SELECT * FROM public.appointments " or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query1); 
while($row = mysqli_fetch_array($result2)) {
  echo "<td>" .$row["id"];}
mysqli_close($con);


