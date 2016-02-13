<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
<?php
	session_start();
	require_once("../files/orders.php");
	$orders =new orders;
	$to=$_POST['to'];
	$from=$_POST['from'];
	
	?>
    <button type="button" class="btn btn-info btn-block"  id="resetMyOrdersPageBtn">Review All Orders</button>
    	
    <?php
	
	if($orders ->  checkFoundOrdersForId($_SESSION['cafeteriaSystem']))
	{
		$orders -> viewSearchChecksForUserByDate($_SESSION['cafeteriaSystem'] , $from  , $to, "1");
	}
	else
	{
		?>
			<div class="alert alert-danger">Sorry No Orders Found  For This User</div>
		<?php	
	}
		
?>