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
				 while($rowProduct = mysqli_fetch_array($res))
				 {
					  $name = $rowProduct['name'];
					  array_push($list, $name);
				 }
					return $list ;
			 }
		}


		function viewallproduct($x)
		{

			$product_List = array();

			$db = dbConnect::getInstance();
			$mysqli = $db->getConnection();
			$query = " select * from products_tb WHERE cat_id=$x+1 ";
			$res = $mysqli ->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				while($rowProduct = mysqli_fetch_array($res))
				{
					$name = $rowProduct['name'];
					array_push($product_List, $name);
				}
				return $product_List ;
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
                        $query =" update products_tb SET status ='1' where id=$x+1 ";
                        $res = $mysqli ->query($query) or die (mysqli_error($mysqli));
                        return true;
                }
                
                
                 function unavailableProduct($x)
                {
                        $db = dbConnect::getInstance();
                        $mysqli = $db->getConnection();
                        $query =" update products_tb SET status ='0' where id=$x+1 ";
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
