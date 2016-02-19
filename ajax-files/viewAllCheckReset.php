
<?php
	session_start();
	require_once("../files/orders.php");
	$orders =new orders;
	
            if($orders -> checkAllOrders())
            {
                
                $orders -> viewAllChecks();
            }
            else
            {
                ?>
                <div class="alert alert-danger">No Orders Found</div>
                <?php	
            }
        ?>
		