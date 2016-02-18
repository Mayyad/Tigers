<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$products = new products();
$rooms=new rooms();
$validate = new validation();
if(isset($_SESSION['cafeteriaSystem'])  ){
if($_SESSION['type'] != '1' )
{
	header("location:index.php");
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> My Products </title>
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
    
    
<?php
	require_once("includes/menu.php");
?>

     <div class="row">      
            <div class="page-header text-center">
                <h1>My Product</h1>
            </div> 
      </div>   


 <div class="row table-responsive">
    <table class="table table-bordered table-hover">
        <thead >
            <tr class="info ">
                <th>Name </th>
                <th>Number of brands</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php


            $list = array ();
            $list = $products->viewAllCat();


                while ($row=mysqli_fetch_array($list))
            {
                ?>
                <tr>

                    <td> <?php echo $row["name"]; ?> <label class=" pull-right"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row['id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row['id']; ?>">+</a></label></td>

                    <td> 5 </td>

                    <td> <?php if($row['status'] == "1"){ ?>  <button id="checkava" type="button" class="btn btn-success" > Available </button> <?php } else{?> <button id="checkava" type="button" class="btn btn-success" > UnAvailable </button> <?php } ?> </td>

                    <td class="text-center"> <a href="#" class="btn btn-info"> Edit </a>
                    </td>
                </tr>

                <tr id="collapse<?php echo $row['id']; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="  headingOne">
                    <td  colspan="4" class="">
                        <?php

                            $products_list = array();
                            $products_list = $products->viewallproduct($row['id']);
                            $pro_count = count($products_list);

                        while($pro=mysqli_fetch_array($products_list))
                        {
                            ?>

                        <div class="row text-center">   <!-- asnaaf start -->
                            <div class="col-sm-2 ">
                                <h4 class="text-center text-muted">
                                    <?php  echo $pro["name"] ?>
                                </h4>
                            </div>
                            <div class="col-sm-2">
                                <div>
                                  <div class="col-sm-2">
                                    <span class="checkbox">
                                        <input type="checkbox">
                                        <label onclick="" data-on="ON" data-off="OFF"></label>
                                    </span>
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                             <a class="btn btn-info" href="#edtpro<?PHP echo $pro["id"];?>" data-toggle="modal" > Edit </a>
                            </div>
                         </div>
                        
                        
                        <!--Edit product Popup -->
                         <div id="edtpro<?PHP echo $pro["id"];?>"  class="modal fade" role="dialog" >
                             <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="editpro.php" method="POST">
                                            <div class="form-group">
                                                <label for="proName"> Product Name </label>
                                                <input type="text" class="form-control" name="proName" placeholder="<?PHP echo $pro['name'];?>" >
                                                <label for="price"> Price </label>
                                                <input type="text" class="form-control" name="price" placeholder="<?PHP echo $pro['price'];?> L.E">
                                               
                                                <label for="proName"> Product Picture </label>
                                                <input type="file" class="form-control" name="pic">
                                                <br>
                                                <input type="hidden" class="form-control" name="catID" value="<?PHP echo $row["id"];?>" >
                                                <input type="submit" class="btn btn-success form-control" value="Change" name="submit" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <!--End of Edit product popup -->
                        
                        <?php } ?>
                        <div>
                            <a class="btn btn-info btn-block" href="#adprdct<?PHP echo $row["id"];?>" data-toggle="modal" > Add Product </a>
                        </div
                        
                         <!--Add Product PopUp -->
                        <div id="adprdct<?PHP echo $row["id"];?>" class="modal fade" role="dialog" > <!--Add Product PopUp --> 
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="validateproduct.php" method="POST">
                                            <div class="form-group">
                                                <label for="proName"> Product Name </label>
                                                <input type="text" class="form-control" name="proName">
                                                <label for="price"> Price </label>
                                                <input type="text" class="form-control" name="price">
                                                <label for="proName"> Statues </label>
                                                <select class="form-control" name="statues">
                                                    <option value="1"> Available </option>
                                                    <option value="0"> Unavailable </option>
                                                </select>
                                                <label for="proName"> Product Picture </label>
                                                <input type="file" class="form-control" name="pic">
                                                <br>
                                                <input type="hidden" class="form-control" name="catID" value="<?PHP echo $row["id"];?>" >
                                                <input type="submit" class="btn btn-success form-control" value="Add" name="submit" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- End of add product popup -->
                         
                         
                         
                         
                    </td>
                </tr>

            <?php } ?>




        </tbody>

    </table>
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
