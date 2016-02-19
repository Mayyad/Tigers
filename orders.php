<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$orders=new orders();
$validate = new validation();
if(isset($_SESSION['cafeteriaSystem'])  ){
if($_SESSION['type'] != '1' )
{
	header("location:index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BootStrap</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/css.css" rel="stylesheet">
    
    
	
    <style>
		body{
			margin-top:10px ;	
		}
		
	</style>
    
    <!-- Bootstrap -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>	
    <script src="js/scripts.js"></script>	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onLoad="ordersRedirectDinamicaly()">
  

    <div class="container">
    	<!-- Menu Bar-->
            <?php require_once("includes/menu.php"); ?>
        <!-- End Of Menu Bar --> 
        
       <!-- if any action Completed -->
        <?php
        if(isset($_GET['action']))
        {
        ?>
            <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
                    <h4 class="modal-title text-left">Action Complete</h4>
                  </div>
                  <div class="modal-body ">
                      <div class="alert alert-success text-center"><?php echo $_GET['action'] ?></div>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
        
        <?php
        }
        ?>
        
        <!-- End Of The Action Complete Pop Up -->
        
        <!--  Edit  Order (deliver It ) Pop Up  -->
        <?php
		if(isset($_GET['deliver']))
		{
			$orderNum=$_GET['deliver'];
			if($validate -> checkNotNull($orderNum))
			{
				if($validate -> checkNumeric($orderNum))
				{
					if($orders -> checkOrderStatus($orderNum , 3))
					{
						?>
						<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
								<h4 class="modal-title text-left">Deliver Order</h4>
							  </div>
							  <div class="modal-body ">
								  <?php
									if(isset($_POST['deliverOrderBtn']))
									{
										
											if($orders -> deliverOrder($orderNum))
											{
												header("location:orders.php?action=Orders Delivered Succssesfilly");
											}
											else
											{
												?>
                                                <div class="alert alert-danger ">Sorry Some Thing Wrong On Connection With DataBase</div>
                                                <?php	
											}
										
										
									}
								  ?>              
								<form class="form-horizontal" action="orders.php?deliver=<?php echo $orderNum ?>" method="POST">
									<div class="row">
									 	Are You Sure You Wanna To Deliver This Order?
                                        <div class="text-right">
                                            <button type="submit" name="deliverOrderBtn" class="btn btn-danger">yes</button>
                                            <a class="btn btn-info" href="orders.php">No</a>	
                                        </div>
                                 	 </div>
                                     </form>
							  </div>
							  <div class="modal-footer">
							  </div>
							</div><!-- /.modal-content -->
						  </div><!-- /.modal-dialog -->
						</div>
                        
						<?php
					}
					else
					{
						header("location:orders.php");	
					}
				}
				else
				{
					header("location:orders.php");	
				}
			}
			else
			{
				header("location:orders.php");	
			}
		}
		?>
        <!-- Edit  Order (deliver It ) Pop Up  -->
        
        <!--  <page Body  Will Change in Every Page> -->
        <div class="row">    	
            <div class="page-header text-center">
                <h1>Orders</h1>
            </div> 
        </div>
        
        <!-- All Will Write Their Code Here  -->
        
        <div class="row">
        	<div id="viewOrders" class="col-sm-12">
            	<?php
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
                ?>
                
            </div>
        </div>
        
        <!--  Untill Here -->
        
        
            
        <div class="row">
        	<div class="col-sm-12">
                <div class="well text-center well-default">
                    Website Designed By OS Nozha Team (Tigers TeaM)
                </div>
            </div>
        </div>
    </div>
    
    
    
    
  </body>
</html>

<?php
}
else
{
	header("location:login.php");	
}
?>