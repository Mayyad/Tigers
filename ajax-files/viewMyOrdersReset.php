
<?php
	session_start();
	require_once("../files/orders.php");
	$orders =new orders;
	
		if($orders ->  checkFoundOrdersForId($_SESSION['cafeteriaSystem']))
			{
				$orders -> viewChecksForUser($_SESSION['cafeteriaSystem'] , "1");
			}
			else
			{
				?>
					<div class="alert alert-danger">Sorry No Orders Found  For This User</div>
				<?php	
			}
		
?>