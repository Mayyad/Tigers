
<?php

require_once("../files/dbConnect.php");
require_once("../files/orders.php");
$orders =new orders;

$db = dbConnect::getInstance();
 $mysqli = $db->getConnection();
$query = " select * from check_tb  where  status = '3' order by id DESC limit 1";  
$res = $mysqli->query($query) or die (mysqli_error($mysqli));
$row=mysqli_fetch_array($res);

//$file_name = 'document.txt';
$client_time = isset($_GET['lastModified'])?$_GET['lastModified']:0;
//$server_time = filemtime($file_name);
$server_time = $row['id'];
while($client_time >= $server_time){
	sleep(10);
	clearstatcache();
	$server_time = $row['id'];
}
$client_time=$row['id'];
echo $server_time ."<BR>" . $client_time;

                	if($orders -> checkReservedOrders())
					{
						$orders -> viewReservedOrders();
					}
					else
					{
						?>
                        <div class="alert alert-danger">No Orders Found</div>
                        <?php	
					}



/*
$response = array();
$response['lastModified'] = $server_time;
$response['msg'] = file_get_contents($file_name);
echo json_encode($response);*/

?>