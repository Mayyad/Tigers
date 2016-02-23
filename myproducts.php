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
   <title>Cafeteria System | My Products</title>
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
    
    
    <script>
        
</script>


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

                    <td> <?php if($row['status'] == "1"){ echo' <button id="statuss'.$row["id"].'" onclick="changeCatStatusAvail('.$row["id"].')"   id="checkava" type="button" class="btn btn-danger" > UnAvailable </button> '; }
                                else { echo' <button id="statuss'.$row["id"].'"     onclick="changeCatStatusUnAvail('.$row["id"].')" id="checkava" type="button" class="btn btn-success" > Available </button>';  }?> </td>

                    <td class="text-center"> <a href="#edtcat<?PHP echo $row["id"];?>" class="btn btn-info" data-toggle="modal" > Edit </a> </td>
                     
                    <!--Edit cat -->
                         <div id="edtcat<?PHP echo $row["id"];?>"  class="modal fade" role="dialog" >
                             <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="validatecat.php" method="POST">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="id" value="<?PHP echo $row['id'];?>" >
                                                <label for="proName"> Category Name [Optional]</label>
                                                <input type="text" class="form-control" name="catName" placeholder="<?PHP echo $row['name'];?>"  >
                                                <input type="hidden" class="form-control" name="tempname" value="<?PHP echo $row['name'];?>" >
                                        
                                                <input type="hidden" class="form-control" name="status" value="<?PHP echo $row['status'];?>" >
                                                <br>
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
                    <!--End of Edit cat-->
                
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
                                    
                                        <?php 
                                        
                                         if ($pro['status']==1){
                                            echo '<span id ="status'.$pro["id"].'" class="checkbox" onclick="changeProudctStatusAvail('.$pro["id"].')">
                                           <input type="checkbox" checked ><label  data-on="ON" data-off="OFF"></label> </span>';}  
                                           else 
                                           {

                                           echo '<span id ="status'.$pro["id"].'" class="checkbox" onclick="changeProudctStatusUnAvail('.$pro["id"].')">
                                           <input type="checkbox"><label data-on="ON" data-off="OFF"></label> </span>';                                         }
                                        
                                        
                                        ?>
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
                                        <form role="form" action="validateproduct.php" method="POST">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="id" value="<?PHP echo $pro['id'];?>" >
                                                <label for="proName"> Product Name [Optional]</label>
                                                <input type="text" class="form-control" name="proName" placeholder="<?PHP echo $pro['name'];?>"  >
                                                <input type="hidden" class="form-control" name="tempname" value="<?PHP echo $pro['name'];?>" >
                                        
                                                <label for="price"> Price [Optional] </label>
                                                <input type="text" class="form-control" name="price" placeholder="<?PHP echo $pro['price'];?> L.E" >
                                               <input type="hidden" class="form-control" name="tempprice" value="<?PHP echo $pro['price'];?>" >
                                                     
                                                <input type="hidden" class="form-control" name="status" value="<?PHP echo $pro['status'];?>" >
                                                <input type="hidden" class="form-control" name="pic" value="<?PHP echo $pro['prod_pic'];?>">
                                                <br>
                                                <input type="hidden" class="form-control" name="catID" value="<?PHP echo $row["id"];?>" >
                                                <input type="submit" class="btn btn-success form-control" value="Change" name="submitt" />
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
                            <a class="btn btn-danger btn-block" href="#adprdct<?PHP echo $row["id"];?>" data-toggle="modal" > Add New Product </a>
                        </div
                        
                         <!--Add Product PopUp -->
                        <div id="adprdct<?PHP echo $row["id"];?>" class="modal fade" role="dialog" > <!--Add Product PopUp --> 
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="validateproduct.php" method="POST" enctype="multipart/form-data" >
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
                                                <input type="file" class="form-control" name="myfile">
                                                
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

            <div class=" col-sm-5 col-sm-offset-9">  
                <a href="#addcat" data-toggle="modal"> <img class ="img" width="80px"  height="80px" src="images/Button-Add-icon.png"> </a>
            </div>
      
      
            <!--Add Cat popup-->
            <div id="addcat"  class="modal fade" role="dialog" >
                             <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" action="validatecat.php" method="POST">
                                            <div class="form-group">
                                                
                                                <label for="catName"> Category Name </label>
                                                <input type="text" class="form-control" name="catName"  >
                                                <br>
                                                <input type="submit" class="btn btn-success form-control" value="Add" name="submitt" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
            </div>
            <!--End of add cat-->

</body>
</html>

<?php
}
else
{
	header("location:login.php");	
}
?>
