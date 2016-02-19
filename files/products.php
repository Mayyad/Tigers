<?php
require_once("dbConnect.php");
require_once("validation.php");


class products
{  
		
       function __construct() {  
              
            // connecting to database  
            //$db = new dbConnect();  
               
        }  
        // destructor  
        function __destruct() {  
              
        }
		
		
		
		
		/************************* Check If There is Available Products on dataBase Or No *************************/
		function checkAvailableProducts()
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from products_tb  where  status = '1'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				return true;	
			}
			else
			{
				return false;
			}
		}
		
		/************************* view All Available Products on dataBase Or No *************************/
		function viewavAilableProducts()
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from products_tb  where  status = '1'";  
            $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				while($rowProduct = mysqli_fetch_array($res))
				{
					?>
                    <div class="col-sm-2 ">
                        <img alt="<?php echo $rowProduct['price'] ?>"  name="<?php echo $rowProduct['id'] ?>" src="uploads/products/<?php echo $rowProduct['prod_pic'] ?>" data-toggle="tooltip" data-placement="right" title="Price : <?php echo $rowProduct['price'] ?> LE" class="img-responsive img-thumbnail prouctImage" />
                        <h4 class="text-center text-muted"><?php echo $rowProduct['name'] ?></h4>
                        
                        
                    </div>
                    <?php	
				}
			}
		}


		/************************* view All Available Products on dataBase Or No By Search *************************/
		function viewavAilableProductsBySearch($word)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from products_tb  where  status = '1' and   name like '".$word."%'";  
            $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				while($rowProduct = mysqli_fetch_array($res))
				{
					?>
                    <div class="col-sm-2">
                        <img alt="<?php echo $rowProduct['price'] ?>"  name="<?php echo $rowProduct['id'] ?> " src="uploads/products/<?php echo $rowProduct['prod_pic'] ?>" data-toggle="tooltip" data-placement="right" title="Price : <?php echo $rowProduct['price'] ?> LE" class="img-responsive img-thumbnail prouctImage" />
                        <h4 class="text-center text-muted"><?php echo $rowProduct['name'] ?></h4>
                    </div>
                    <?php	
				}
			}
			else
			{
				?>
                                    <div class="alert alert-danger">No Products Avilable</div>
                                    <?php	
			}
		}
		
		/************************* Return Product Info *************************/
		function returnProductInfo($p_id)
		{
			$db = dbConnect::getInstance();
                    	 $mysqli = $db->getConnection();
			$query = " select * from products_tb  where  id = '".$p_id."'";  
                         $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if($res)
			{
				return $res;
			}
			else
			{
				return false;
			}
			
		}
                
                
		 function viewAllCat()
		{

			$list = array();

			$db = dbConnect::getInstance();
			$mysqli = $db->getConnection();
			$query = " select * from categories_tb ";
			$res = $mysqli ->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			 {
				/* while($rowProduct = mysqli_fetch_array($res))
				 {
					  $name = $rowProduct['name'];
					  array_push($list, $name);
				 }*/
					return $res ;
			 }
		}


		function viewallproduct($x)
		{

			$product_List = array();

			$db = dbConnect::getInstance();
			$mysqli = $db->getConnection();
			$query = " select * from products_tb WHERE cat_id=$x ";
			$res = $mysqli ->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				/*while($rowProduct = mysqli_fetch_array($res))
				{
					$name = $rowProduct['name'];
					array_push($product_List, $name);
				} */
				return $res ;
			}
                }            



                function available($x)
                {
                        $db = dbConnect::getInstance();
                        $mysqli = $db->getConnection();
                        $query =" update categories_tb SET status ='1' where id=$x+1 ";
                        $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                        return true;
                }

                
                function unavailable($x)
                {
                        $db = dbConnect::getInstance();
                        $mysqli = $db->getConnection();
                        $query =" update categories_tb SET status ='0' where id=$x+1 ";
                        $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                        return true;
                }
                
                
                 function availableProduct($x)
                {
                        $db = dbConnect::getInstance();
                        $mysqli = $db->getConnection();
                        $query =" update products_tb SET status ='1' where id=$x ";
                        $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                        return true;
                }
                
                
                 function unavailableProduct($x)
                {
                        $db = dbConnect::getInstance();
                        $mysqli = $db->getConnection();
                        $query =" update products_tb SET status ='0' where id=$x ";
                        $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                        return true;
                }

                
                function AddPro($Name,$price,$Statues,$Prod_pic,$Cat_id)
                {
                    $db = dbConnect::getInstance();
                    $mysqli = $db->getConnection();
                    $query ="insert into products_tb (name,price,status,prod_pic,cat_id) VALUES ('$Name','$price','$Statues','$Prod_pic','$Cat_id') ";
                    $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                    return true;
                }
                
                
                function updatePro($id,$Name,$price,$Statues,$Prod_pic,$Cat_id)
                {
                    $db = dbConnect::getInstance();
                    $mysqli = $db->getConnection();
                    $query ="UPDATE products_tb SET name='$Name' , price='$price' , status='$Statues' , prod_pic='$Prod_pic' , cat_id=$Cat_id WHERE id=$id ";
                    $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                    return true;
                }
                
                
                
                function updatecat($id,$Name,$Statues)
                {
                    $db = dbConnect::getInstance();
                    $mysqli = $db->getConnection();
                    $query ="UPDATE categories_tb SET name='$Name' , status='$Statues' WHERE id=$id ";
                    $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                    return true;
                }
                    
                
                function addcat($Name)
                {
                    $db = dbConnect::getInstance();
                    $mysqli = $db->getConnection();
                    $query ="insert into categories_tb (name,status) VALUES ('$Name' ,1) ";
                    $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                    return true;
                } 
}
		
		
		
		
		
		
		
		
		
		
		

 
/*
$user= new uLogin();
$user->__set("uname" , "Mina");
echo $user->__get("uname");
$check_exist=$user->login("eng.mina23@gmail.com" , "1ee23");
if($check_exist)
{
	echo "Exist";	
}

*/
?>
