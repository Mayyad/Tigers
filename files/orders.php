<?php
require_once("dbConnect.php");
require_once("validation.php");


class orders
{  
		
       function __construct() {  
              
            // connecting to database  
            //$db = new dbConnect();  
               
        }  
        // destructor  
        function __destruct() {  
              
        }
		
		
		/************************* Check For Room Number By ID is found on dataBase Or No *************************/
		function checkRoomNumById($roomNum)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from rooms_tb where id = '".trim($roomNum)."'";  
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
		
		
		/************************* Check if User is Exist on This Room Number By ID is found on dataBase Or No *************************/
		function checkUserSelectRoom($roomNum)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where roomNo = '".$roomNum."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				return false;	
			}
			else
			{
				return true;
			}
		}
		
		
		/************************* info Room Number By ID is found on dataBase Or No *************************/
		function getRoomInfo($roomNum)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from rooms_tb where id = '".trim($roomNum)."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				return mysqli_fetch_array($res);	
			}
			else
			{
				return false;
			}
		}
		
		
		/************************* Check For Order Number is Mine Or No on dataBase Or No *************************/
		function checkOrderIsMine($orderNum ,$u_id)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb  where id= '".$orderNum."' and u_id ='".$u_id."' and status = '3'";  
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
		
		/************************* Check For Orders For One User on dataBase Or No *************************/
		function checkFoundOrdersForId($u_id)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb where u_id = '".$u_id."'  ";  
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
		
		
		
		
		/************************* View All Rooms Entered To DataBase *************************/
		function viewAllRooms()
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from rooms_tb";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if(mysqli_num_rows($res) > 0)  
           	{
				?>
                <table class="table table-bordered table-hover">
                    <thead >
                        <tr class="info ">
                        	<th>#</th>
                            <th >Name </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody >
                    <?php
					$index=1;
						while($row=mysqli_fetch_array($res))
						{
							?>
                            <tr class="text-left" >
                            	<td width="7%"><?php echo $index++; ?></td>
                                <td> <?php  echo $row['name']?></td>
                                <td width="40%">
                                 <?php if($row['status'] == "1"){ ?>
                                   <a  href="rooms.php?unavailable=<?php echo $row['id'] ?>" class="btn btn-danger" > Un Avilable </a> 
                                   <?php
								 }
								 else
								 {
									?>
                                    <a  href="rooms.php?available=<?php echo $row['id'] ?>" class="btn btn-success" > Avilable </a>
                                    <?php 
								 }
								   ?>
									<a href="rooms.php?edit=<?php echo $row['id'] ?>" class="btn btn-info"> Edit </a> 
                                    <a href="rooms.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger"> Delete </a> 
                                 </td>
                            </tr>
                            <?php	
						}
					?>
                    </tbody>
				 </table>	
                <?php
            }  
            else  
            {  
              	?>
                	<div class="alert alert-danger text-center">Sorry No Rooms Found On This DataBase</div>
                <?php 
            }  
			
				
		}
		
		
		/********************** View Order TYPE *********************************************/
		function getOrderType($type)
		{
			$returnType='';
			if($type == "1")
				$returnType = "Done";
			elseif($type == "2")
				$returnType = "On The Way To You";
			elseif($type == "3")
				$returnType = "On Process";
			else
				$returnType = "Canceled";
				
				echo $returnType;
		}
		
		
		
		/************************* View All Rooms Entered To DataBase *************************/
		function viewChecksForUser($u_id)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb where u_id = '".$u_id."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if(mysqli_num_rows($res) > 0)  
           	{
				?>
                <table class="table table-bordered "  id="accordion" role="tablist" aria-multiselectable="true">
                    <thead >
                        <tr class="info ">
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody >
                    <?php
					$index=1;
						while($row=mysqli_fetch_array($res))
						{
							?>
                            <tr  >
                                <td><?php echo $row['date'] ?> <label class=" pull-right"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#check_<?php echo $row['id'] ?>" aria-expanded="true" aria-controls="#check_<?php echo $row['id'] ?>">+</a></label></td>
                                <td><?php  $this -> getOrderType($row['status']) ?></td>
                                <td><?php echo $row['total_price'] ?></td>
                                <td class="text-center"> <?php if($row['status'] == "3" ) { ?><a href="myOrders.php?cancel=<?php echo $row['id'] ?>" class="btn btn-info">Cancel</a> <?php } ?> </td>
                            </tr>
                            
                            <tr id="check_<?php  echo  $row['id'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                    	<td  colspan="4" >
                                        	<?php
													$query = " select * from orders_tb where check_id = '".$row['id']."'";  
													$ordersRes = $mysqli->query($query) or die (mysqli_error($mysqli));	
													if(mysqli_num_rows($ordersRes) > 0)  
													{
												?>
                                            	<div class="row text-center" >
                                    				<?php
													while($rowOrder=mysqli_fetch_array($ordersRes))
													{
														$query = " select * from products_tb where id = '".$rowOrder['prod_id']."'";  
														$prodRes = $mysqli->query($query) or die (mysqli_error($mysqli));
														$rowProd=mysqli_fetch_array($prodRes);
													?>
                                                    <div class="col-sm-2 ">
                                                        <img  width="100%"  src="uploads/products/<?php echo $rowProd['prod_pic'] ?>" data-toggle="tooltip" data-placement="right" title="Total Price : <?php echo $rowOrder['totalPrice'] ?> LE" class="img-responsive img-thumbnail" />
                                                        <h4 class="text-center text-muted"><?php echo $rowProd['name']; ?></h4>
                                                        <h4 class="text-center text-muted"><?php echo $rowOrder['amount'] ?></h4>
                                                        
                                                    </div>
                                                    <?php
													}
													?>
                                              	</div>
                                                <div class="row text-left">&nbsp;&nbsp;
                                                 <label>Total Amount : <?php echo $row['total_price'] ?> EGP</label>
                                              	</div>
                                                <?php
													}
													else
													{
														?>
                                                        <div class="alert alert-danger">No Product Found On This Orders</div>
                                                        <?php	
													}
												?>
                                        </td>
                                    </tr>
                            <?php	
						}
					?>
                    </tbody>
				 </table>	
                <?php
            }  
            else  
            {  
              	?>
                	<div class="alert alert-danger text-center">Sorry No Rooms Found On This DataBase</div>
                <?php 
            }  
			
				
		}
		
		/************************* Delete From Users Tb  *************************/
		function cancelOrder($orderNum)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			 $query = " update  check_tb  set status = '4' where id='".$orderNum."' ";  
            $res=$mysqli->query($query) or die (mysqli_error($mysqli));
			if($res)
			{
				return true;	
			}
			else
			{
				return false;	
			}
		}
		
		/************************* Add New Room   *************************/
		function addRoom($number )
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " insert into rooms_tb set
						name='".$number."' ,
						status='1' 
			";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if($res)  
           	{
				return TRUE;  
            }  
            else  
            {  
              	return false; 
            }  
		}
		
		
		
		/************************* Update user Tb  *************************/
		function editRoom($roomName, $roomNum)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " update rooms_tb set
						name='".$roomName."'  where id='".$roomNum."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if($res)  
           	{
				return TRUE;  
            }  
            else  
            {  
              	return false; 
            }  
		}
		
		
		/************************* Update Rooms Tb set Status UnAvailable  *************************/
		function unavilableRoom($roomNum)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " update rooms_tb set
						status='0'  where id='".$roomNum."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if($res)  
           	{
				return TRUE;  
            }  
            else  
            {  
              	return false; 
            }  
		}
		
		/*************************  Update Rooms Tb set Status Available   *************************/
		function avilableRoom($roomNum)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " update rooms_tb set
						status='1'  where id='".$roomNum."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if($res)  
           	{
				return TRUE;  
            }  
            else  
            {  
              	return false; 
            }  
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