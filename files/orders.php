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
		
		
		
		
		/************************* Check If There is Reserved Orders on dataBase Or No *************************/
		function checkReservedOrders()
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb  where  status = '3'";  
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
		
		/************************* Check For Order Number  on dataBase Or No *************************/
		function checkAllOrders()
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb  where ( status ='1' or status ='2'  ) ";  
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
		
		
		/************************* Check For Order Number And Its Status Exist Or No on dataBase Or No *************************/
		function checkOrderStatus($orderNum ,$status)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb  where id= '".$orderNum."' and status ='".$status."' ";  
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
		
		
		
		/************************* View All Orderes Belong To Certin User Entered To DataBase In Search Date  *************************/
		function viewSearchChecksForUserByDate($u_id , $from , $to , $action)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb where u_id = '".$u_id."' and ( date between '".$from."' AND '".$to."' ) order by date ";  
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
                            <?php
							if($action != "2")
							{
							?>
                            <th>Action</th>
                            <?php
							}
							?>
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
                                <?php if( $action !="2"){	?><td class="text-center"> <?php if($row['status'] == "3"  ) { ?><a href="myOrders.php?cancel=<?php echo $row['id'] ?>" class="btn btn-info">Cancel</a> <?php } ?> </td> <?php } ?>
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
                	<div class="alert alert-danger text-center">Sorry No Orders Found On This DataBase</div>
                <?php 
            }  
			
				
		}
		
		
		/************************* View All Orderes Belong To Certin User Entered To DataBase *************************/
		function viewChecksForUser($u_id , $action)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb where u_id = '".$u_id."' order by date";  
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
                            <?php
							if($action != "2")
							{
							?>
                            <th>Action</th>
                            <?php
							}
							?>
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
                                <?php if( $action !="2"){	?><td class="text-center"> <?php if($row['status'] == "3"  ) { ?><a href="myOrders.php?cancel=<?php echo $row['id'] ?>" class="btn btn-info">Cancel</a> <?php } ?> </td> <?php } ?>
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
                	<div class="alert alert-danger text-center">Sorry No Orders Found On This DataBase</div>
                <?php 
            }  
			
				
		}
		
		/************************* View All Reserved Orders Entered To DataBase *************************/
		function viewReservedOrders()
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from check_tb where status = '3'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if(mysqli_num_rows($res) > 0)  
           	{	
				$index=1;			
				while($row=mysqli_fetch_array($res))
				{
					$userQuery = " select * from users_tb where id = '".$row['u_id']."'";  
            		$userRes = $mysqli->query($userQuery) or die (mysqli_error($mysqli));
					$rowUser=mysqli_fetch_array($userRes);	
					?>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="heading<?php echo $row['id'] ?>">
                      <h4 class="panel-title row">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#check_<?php echo $row['id'] ?>" aria-expanded="true" aria-controls="check_<?php echo $row['id'] ?>" class="col-sm-2 text-left">
                        <span >Order #<?php echo $index++; ?></span>
                        </a>
                        
                      </h4>
                    </div>
                    <div id="check_<?php echo $row['id'] ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $row['id'] ?>">
                      <div class="panel-body">
                        
                        
                        <!-- End Of Check -->
                        <div class="row">
                            <table class="table table-bordered table-hover">
                                <thead >
                                    <tr class="info ">
                                        <th>Order Date</th>
                                        <th>Name</th>
                                        <th>Room</th>
                                        <th>Ext</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr >
                                        <td><?php echo $row['date'] ?></td>
                                        <td><?php echo $rowUser['name'] ?></td>
                                        <td><?php echo $rowUser['roomNo'] ?></td>
                                        <td><?php echo $rowUser['ext'] ?></td>
                                        <td class="text-center"> <a href="orders.php?deliver=<?php echo $row['id'] ?>" class="btn btn-info">Deliver</a> </td>
                                    </tr>
                                </tbody>
                
                            </table>
                        </div>
                        <!-- End Of Check -->
                        <!-- What User Buy -->
                        <div class="row">
                            <?php
								$ordersQuery = " select * from orders_tb where check_id = '".$row['id']."'";  
			            		$ordersRes = $mysqli->query($ordersQuery) or die (mysqli_error($mysqli));
								while($rowOrder=mysqli_fetch_array($ordersRes))
								{
									$productQuery = " select * from products_tb where id = '".$rowOrder['prod_id']."'";  
			            			$productRes = $mysqli->query($productQuery) or die (mysqli_error($mysqli));
									$rowProduct=mysqli_fetch_array($productRes);
							?>
                                    <div class="col-sm-2 ">
                                    
                                        <img  src="uploads/products/<?php echo $rowProduct['prod_pic'] ?>" data-toggle="tooltip" data-placement="right" title="Price : <?php echo $rowProduct['price'] ?> LE" class="img-responsive img-thumbnail" />
                                        <h4 class="text-center text-muted"><?php echo $rowProduct['name'] ?></h4>
                                        <h4 class="text-center text-muted"><?php echo $rowOrder['amount'] ?></h4>
                                        
                                    </div>
                                    <?php
								}
											?>
                        </div>
                        <!-- End What User Buy -->
                        <!-- Total Price -->
                        <div class="row text-right">
                        	<label>Total Price : <?php echo $row['total_price'] ?> EGP</label>&nbsp;&nbsp;
                        </div>
                        <!-- End of Total Price -->
                                        
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Of Collaps 1 -->
					<?php	
				}
            }  
            else  
            {  
              	?>
                	<div class="alert alert-danger text-center">Sorry No Reserved Orders Found On This DataBase</div>
                <?php 
            }  
			
				
		}
		
		
		/************************* View All Checks For All Users Orders Entered To DataBase *************************/
		function viewAllChecks()
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$userQuery = " select * from users_tb ";  
            $userRes = $mysqli->query($userQuery) or die (mysqli_error($mysqli));	
			if(mysqli_num_rows($userRes) > 0)  
           	{	
			?>
            	<table class="table table-bordered table-hover">
                    <thead >
                        <tr class="info ">
                            <th>Name </th>
                            <th width="20%">amount</th>
                        </tr>
                    </thead>
                    <tbody  class="text-left">
                        <?php
                        while($rowUser=mysqli_fetch_array($userRes))
                        {
								
							?>
                            <!-- Users Name With Details -->
                                <tr >
                                    <td >  <label class=" pull-left"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $rowUser['id'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $rowUser['id'] ?>">+</a></label>&nbsp; <?php echo $rowUser['name'] ?></td>
                                    <td><?php $this -> getSum($rowUser['id']);?> </td>
                                </tr>
        
                                <tr id="collapse<?php echo $rowUser['id'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="  headingOne">
                                  <td  colspan="2" class="">
                                    <!-- Orders Date With its Content -->
                                        
                                        <?php
                                       $this -> viewChecksForUser($rowUser['id'] , "2");
                                        ?>
                                        
                                    <!-- End Of Orders Date and Its Content -->
                                  </td>
                                </tr>
                                <!-- End of Users Name With Details -->
                            <?php	
                        }
                        ?>
                    </tbody>
                </table>
            <?
			}  
            else  
            {  
              	?>
                	
                <?php 
            }  
			
				
		}
		
		
		/************************* Cancel From Users Tb  *************************/
		function getSum($u_id)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			  $myarr['total'] =0;
			 $query = "select  SUM(total_price) AS total  from check_tb where u_id='".$u_id."'";  
            $res=$mysqli->query($query) or die (mysqli_error($mysqli));
			
			$myarr=mysqli_fetch_assoc($res);
			if($myarr['total'] == "")
			{
				echo "0";	
			}
			else
			{
				echo $myarr['total'];
			}
		}
		
		
		/************************* Cancel From Users Tb  *************************/
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
		
		/************************* Deliver From Users Tb  *************************/
		function deliverOrder($orderNum)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			 $query = " update  check_tb  set status = '2' where id='".$orderNum."' ";  
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