
<?php
	session_start();
	require_once("../files/orders.php");
	$orders =new orders;
	
		if($orders -> checkFoundOrdersForId($_SESSION['cafeteriaSystem']))
		{
			$orders -> viewMyLastOrder($_SESSION['cafeteriaSystem']);
		}
		else
		{
			?>
				<div class="alert alert-danger">No Orders Found For u</div>
			<?php	
		}
		
?>