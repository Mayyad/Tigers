
<?php
ini_set('max_execution_time',0);
require_once("../files/dbConnect.php");
require_once("../files/orders.php");
$orders =new orders;

$db = dbConnect::getInstance();
 $mysqli = $db->getConnection();
$query = " select * from check_tb  where  status = '3' ";  
$res = $mysqli->query($query) or die (mysqli_error($mysqli));
$row=mysqli_num_rows($res);

//$file_name = 'document.txt';
$client_amount = isset($_GET['lastModified'])?$_GET['lastModified']:0;

//$server_time = filemtime($file_name);
$server_time = mysqli_num_rows($res);
$client_amount = $server_time;
while($client_amount == $server_time){
	sleep(10);
	clearstatcache();
	$query1 = " select * from check_tb  where  status = '3' ";  
$res1 = $mysqli->query($query1) or die (mysqli_error($mysqli));
$row1=mysqli_fetch_array($res1);
	$client_amount=mysqli_num_rows($res1);
}
//$client_amount = $row['id'];
//echo $server_time ."<BR>" . $client_amount;




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





$response = array();
$response['lastModified'] = $client_amount;
$response['msg'] = "kkkkk";
//echo json_encode($response);

?>