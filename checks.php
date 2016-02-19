<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$orders=new orders();
$users=new users();
$validate = new validation();
if(isset($_SESSION['cafeteriaSystem'])  ){
if($_SESSION['type'] != '1' )
{
	header("location:index.php");
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
  <body>
  
      <div class="container">
   	 	<!-- Menu Bar-->
            <?php require_once("includes/menu.php"); ?>
        <!-- End Of Menu Bar --> 
        
        <!--  <page Body  Will Change in Every Page> -->
        <div class="row">    	
            <div class="page-header text-center">
                <h1>All Checks</h1>
            </div> 
        </div>
        
        <div class="row">
        	<div class="col-sm-12">
            	
            </div>
        </div>
        
        
        <!-- All Will Write Their Code Here  -->
        
        
        <!-- End Of Check -->
        <div class="row">
            <div class="col-sm-12">
                <form class="form-inline">
                  <div class="form-group">
                      <?php
                            if($resUsers = $users -> viewAllUsersToCheck())
                            {
                                ?>
                                    <select id="userID" class="form-control">
                                        <option value="0">All Users</option>
                                    <?php
                                    while($rowUsers=mysqli_fetch_array($resUsers))
                                    {
                                    ?>
                                      <option value="<?php echo $rowUsers['id'] ?>"><?php echo $rowUsers['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <div class="alsert alert-danger text-center">No Users Found</div>
                                <?php   
                            }
                        ?>
                  </div>
                  <div class="form-group">
                    <label for="datefrom">From</label>
                    <input type="text" class="form-control" id="datefrom" value="" placeholder="YYYY-MM-DD">
                  </div>
                  <div class="form-group">
                    <label for="dateto">To</label>
                    <input type="text" class="form-control" id="dateto" value="" placeholder=" YYYY-MM-DD">
                  </div>
                  <button type="button" class="btn btn-default" id="viewCheckBtn">Search</button>
                </form>
            </div>
        </div>
        <br>
            <div class="row " id="viewCheeckSearchResult" >
            


                
                <?php    require_once("ajax-files/paginationChecks.php"); 
                    /*
                    if($orders -> checkAllOrders())
                    {
                        
                        $orders -> viewAllChecks();
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-danger">No Orders Found</div>
                        <?php	
                    }*/
                ?>

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