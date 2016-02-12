<?php
require_once("dbConnect.php");
require_once("validation.php");


class rooms 
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
		
		
		/************************* Check For Room Number is found on dataBase Or No *************************/
		function checkRoomNum($roomNum)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from rooms_tb where name = '".trim($roomNum)."'";  
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
		
		/************************* Check For Room Number is found on dataBase Or No *************************/
		function checkFoundRooms()
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from rooms_tb ";  
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
		
		/************************* Delete From Users Tb  *************************/
		function deleteRoom($roomNum)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			 $query = " delete from rooms_tb  where id='".$roomNum."' ";  
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