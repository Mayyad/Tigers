<?php
require_once("dbConnect.php");
require_once("validation.php");


class uLogin 
{  
		private $uname='';
		private $password='';
		
		
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
		
		
		function login($uname , $password , $checked)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = "SELECT * FROM users_tb WHERE mail= '".$uname."' AND pass = '".md5($password)."'";  
            $res = $mysqli->query($query);	
			if(mysqli_num_rows($res) > 0)  
           	{
				$row=mysqli_fetch_array($res);
				
				if($row['type'] != "3")
				{
					
					$_SESSION['cafeteriaSystem']=$row['id'];
					$_SESSION['type']=$row['type'];
					$_SESSION['name']=$row['name'];
					$_SESSION['pic']=$row['pic_path'];
					//echo $_SESSION['php'];
				
					if($checked =="1")
					{
						setcookie("cafeteriaSystem", $row['id'], time() + 3600);
						//echo $_COOKIE['php'];
					}
						if($row['type'] == "1")
					{	
						header("location:orders.php");	
					}
					else
					{
						header("location:index.php");
					}	
					return TRUE;  
				}
				
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