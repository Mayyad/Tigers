<?php
require_once("dbConnect.php");
require_once("validation.php");


class users 
{  
		
       function __construct() {  
              
            // connecting to database  
            //$db = new dbConnect();  
               
        }  
        // destructor  
        function __destruct() {  
              
        }
		function __get($name)
		{
			return $this->$name;	
		}
		function __set($name , $value)
		{
			return $this -> $name = $value;	
		}

		

		/**********************  view All Users                           *******************/	
	
		function viewAllUsers()
		{
			$db = dbConnect::getInstance();
	    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where id != '1' ";  
		    	$res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res)>0)
			{
				return $res;
			}
			else
			{
				return false;
			}	
		}
		
		/**********************  view All Users                           *******************/	
	
		function viewAllUnBlockedUsers()
		{
			$db = dbConnect::getInstance();
	    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where type = '2' ";  
		    	$res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res)>0)
			{
				return $res;
			}
			else
			{
				return false;
			}	
		}


		/**********************  view All Users                           *******************/	
	
		function viewAllUsersToCheck()
		{
			$db = dbConnect::getInstance();
	    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb ";  
		    	$res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res)>0)
			{
				return $res;
			}
			else
			{
				return false;
			}	
		}


		/**********************  View User Room No                           *******************/	
	
		function getMyRoom($roomNo)
		{
			$db = dbConnect::getInstance();
	    		 $mysqli = $db->getConnection();
			$query = " select * from rooms_tb where id = '".$roomNo."' ";  
		    	$res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res)>0)
			{
$rowRoom=mysqli_fetch_array($res);
				echo $rowRoom['name']; 
			}
			else
			{
				return false;
			}	
		}
		
		
		/************************* Insert user Tb  *************************/
		function regist($name , $mail, $ext,  $pic_name , $password, $roomNo ,  $secret)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " insert into users_tb set
						name='".$name."' ,
						mail='".$mail."' ,	
						ext='".$ext."' ,
						type = '2' ,
						pic_path= '".$pic_name."' ,
						pass='".md5($password)."' ,
						roomNo='".$roomNo."' ,
						secret='".$secret."' 
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
		




		
		
		/************************* Count Number Of Users On DataBase *************************/
		function countUsers()
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where id != '1' ";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			return mysqli_num_rows($res);
		}
		
		/************************* Select Users On DataBase *************************/
		function selectUsers()
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb  ";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) > 0)
			{
				?>
                <select class="form-control" name="u_id">
                      <option value="0">Select User</option>
                      <?php
                        while($row=mysqli_fetch_array($res))
                        {
                      ?>
                      <option value="<?php echo $row['id'] ?>"><?php echo $row['fname']." ".$row['lname'] ?></option>
                      <?php
                        }
                      ?>	
                 </select>
                <?php	
			}
		}
		
		/************************* Get Old Password DataBase *************************/
		function getOldPassword($id)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where id != '1'  and id='".$id."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			$row =mysqli_fetch_array($res);
			return $row['password'];
		}
		
		/************************* Get Pic Name DataBase *************************/
		function getPicName($id)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where id != '1'  and id='".$id."'";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			$row =mysqli_fetch_array($res);
			return $row['prof_pic'];
		}
		
		
		/************************* Get Pic Name DataBase *************************/
		function getUserInfoById($id)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where id != '1'  and id='".$id."'";  
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
		
		
		
		
		
		/************************* Delete From Users Tb  *************************/
		function delete($id)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			
			 $query = " select * from users_tb  where id != '1' and id='".$id."' ";
			$query1 = " delete from users_tb  where id != '1' and id='".$id."' ";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			$row=mysqli_fetch_array($res);
			
			unlink("uploads/users/".$row['pic_path']);
			$res1=$mysqli->query($query1) or die (mysqli_error($mysqli));
			if($res1)
			{
				header("location:users.php");	
			}
			else
			{
				echo "Some Thing Wrong Please Try Again Later";	
			}
		}
		
		
		
		
		
		/************************* Update user Tb  *************************/
		function updateUser($name , $ext, $roomNo,  $pic_path, $password , $u_id)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " update users_tb set
						name='".$name."' ,
						ext='".$ext."' ,	
						roomNo='".$roomNo."' ,
						pass='".$password."' ,
						pic_path='".$pic_path."' where id='".$u_id."'
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
		function resetPassword($mail , $secret)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
    		 $newPass=substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
    		 $q1="select * from users_tb  where mail='".$mail."' and secret='".$secret."' ";
    		 $qRes= $mysqli->query($q1) or die (mysqli_error($mysqli));
	
					
			if(mysqli_num_rows($qRes) > 0)
			{
				$query = " update users_tb set					pass='".md5($newPass)."'  where mail='".$mail."' and secret='".$secret."'";  
	            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
				if($res)  
	           	{
					echo "Password Reset And ur new password is ".$newPass;
	            }  
	            else  
	            {  
	              	echo "Wrong Secret and Mail"; 
	            }	
			}
			else
			{
				echo "Please Enter Valied Email and Secret";
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
