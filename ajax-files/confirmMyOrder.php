<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<?php
session_start();
require_once("../files/products.php");
require_once("../files/validation.php");
require_once("../files/rooms.php");
require_once("../files/orders.php");
$products = new products();
$validate = new validation();
$rooms = new rooms();
$orders = new orders();
	//$mystr=$_POST['msg'];
	//echo $mystr;
	//Hena ana hab3at ll method al id Session
	/*
	
	echo date("Y-m-d");
	echo "<br>".date("h : i : A");*/
	$totalAmount=0;
	
	if($_POST['isNullProduct'] == "1")
	{
		if($validate->checkNotNull($_POST['roomNo']))
		{
			if($rooms -> checkRoomNumById($_POST['roomNo']))
			{
				if($returnRow = $orders -> insertCheck($_SESSION['cafeteriaSystem'] , $_POST['roomNo'] , $_POST['orderNotice']))
				{
					foreach($_POST as $key => $value)
					{
						if(is_numeric($key))
						{
							if($products -> returnProductInfo($key))
							{	
								$productInfo = mysqli_fetch_array($products -> returnProductInfo($key));
								//echo "Found" . $productInfo['name'];	
								$sum= $value * $productInfo['price'];
								$orders -> insertOrder($returnRow , $key , $value , $sum );
								$totalAmount=$totalAmount+$sum;
							}
							
								
						}
					}
					$orders->updateOrder($returnRow , $totalAmount ,"index.php?action=Order Confirmed");
					
					
					
				}
				else
				{
					echo "Wrong";	
				}
			
			
			}
			else
			{
				?>
					<div class="alert alert-danger -text-center"> No Rooms Found With This Data </div>
				<?php	
			}
		}
		else
		{
			?>
			<div class="alert alert-danger text-center">Room Is Not Null</div>
			<?php	
		}
	}
	else
	{
		?>
        <div class="alert alert-danger text-center">Please Choose One Product At Least</div>
        <?php	
	}
		
?>