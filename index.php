<html>
<head>
    
</head>
    <style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
  <body>
  

      <?php
   
      
     $servername = "52.74.245.239";
      $database = "DBDPManagement";

$username = "dpuser";
$password = "6?]Nu-TX6jKN";
      
  /*    
      $objConnect = mssql_connect("52.74.245.239","DBDPManagement","dpuser","6?]Nu-TX6jKN");
	if($objConnect)
	{
		echo "Database Connected.";
	}
	else
	{
		echo "Database Connect Failed.";
	}

	mssql_close($objConnect);*/
      

try
{
    $conn= new PDO("sqlsrv:Server=52.74.245.239,1433;Database=DBDPManagement","dpuser","6?]Nu-TX6jKN");
    
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "connected";
    
}
catch(Exception $e)
{
    die(print_r($e->getMessage()));    
}
      
     $tsql="select * from tbdpmarket where MarketID='RN01-M01'" ;
      $getResult=$conn->prepare($tsql);
      $getResult->execute();
      $result=$getResult->fetchAll(PDO::FETCH_BOTH);
      
      foreach($result as $result)
      {
          
          echo $result;
          echo '<br>';
          
      }
      
      
      //phpinfo();
      
      
     
	

?>  
  
    </body>  
</html>
