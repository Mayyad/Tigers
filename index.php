<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$orders=new orders();
$rooms=new rooms();
$products=new products();
$validate = new validation();
if(isset($_SESSION['cafeteriaSystem'])  ){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cafeteria System | Home Page</title>
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
  <body>
 

    <div class="container">
    	<!-- Menu Bar-->
            <?php require_once("includes/menu.php"); ?>
        <!-- End Of Menu Bar -->
        
       
        
        <!--  <page Body  Will Change in Every Page> -->
        <div class="row">    	
            <div class="page-header text-center">
                <h1>Home Page</h1>
            </div> 
        </div>
        
        
        <!-- All Will Write Their Code Here  -->
        <div class="row">
        	<!-- Examples Of Product Ordered -->
        	<div class="col-sm-4  ">
            	<div id="appendProducts">
                
                </div>
                
            <!--
            	
                    
                </div>-->
                
                
                
                <div class="row">
                	<div id="viewConfirmOrderResult"></div>
                  <br>
                	<div class="col-sm-12">
                    	<label>Notice </label>
                    </div>
                	<div class="col-sm-12">	
                		<textarea id="orderNotice" class="form-control" rows="3"></textarea>
                    </div>    
                </div>	
                
                <div class="row">
                <br>
                <?php
					if($roomsReturn = $rooms -> selectAvilableRoom())
					{
					?>
                        <label class="col-sm-2">RooM</label>
                        <div class="col-sm-10">
                            <select id="roomNo" class="form-control">
                              <?php
							  while($row=mysqli_fetch_array($roomsReturn))
							  {
							  ?>
                              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                              
                            	<?php
							  }
							  ?>
                            </select>
                        </div>
					<?php
					}
					else
					{
						
					}
					
					?>
                </div>
                
                <hr>
                
                <div class="row">
                	<label id="orderSum"></label>
                    <input type="hidden" id="userID" value="<?php echo $_SESSION['cafeteriaSystem'] ?>" >
                </div>
                
                <div class="row text-right">
                	<button type="button"  class="btn btn-info " id="confirmMyOrderBtn">Confirm</button>&nbsp;&nbsp; 
                </div>
                
            </div>
            
            <div class="col-sm-8 " style="border-left:1px solid #dfdfdf">
            	<div class="row">
                	<div class="col-sm-12">
                    	<h3 class="page-header">Latest Order</h3>
                        <div class="row " id="viewMyLastOrder">
                        	<?php
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
                        
                        </div><!-- End Of  View Products of Last Order -->
                    </div>
                </div><!-- End Of Latest Order Div -->
                	<hr >
                <div class="row"><!-- Div All Product -->
                	<div class="col-sm-12">
                		<h3 class="page-header">All Products

                        </h3>
                        <div class="row">
                            <div class="col-sm-8"></div>
                           <div class="col-sm-4">
                           <input class="  form-control" type="text" id="productSearch" placeholder="Enter Product Name"    ><br>
                            </div>
                        </div>
                        <div class="viewMyProducts row" id="products">
                    		<?php
								if($products -> checkAvailableProducts())
								{
									$products -> viewAvailableProducts();	
								}
								else
								{
									?>
                                    <div class="alert alert-danger">No Products Avilable</div>
                                    <?php	
								}
							?>
                            
                        </div>    
                    </div>
                </div><!-- End Of Div All Product -->
                
                
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