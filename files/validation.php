<?php
require_once("dbConnect.php");

class validation 
{  
		private $uname='';
		private $password='';
		
		
       function __construct() {  
              
            // connecting to database  
            //$db = new dbConnect();  
               
 //   $sql_query = "SELECT foo FROM .....";
//    $result = $mysqli->query($sql_query); 
        } 
		 
        // destructor  
        function __destruct() {  
              
        }
		
		public function checkImage()
		{
			if (preg_match('/^image/' , $_FILES['myfile']['type']  )    
			  && ($_FILES["myfile"]["size"] < 204800  )
			  && ($_FILES["myfile"]["size"] >0)
			  )
					{           
								if ($_FILES["myfile"]["error"] > 0)
							   {
									echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
							   }
						  else
							   {
								   return true;
							   }
					}
					else
					{
						return false;
					}
		
		}
		
		public function checkEqual($value1 , $value2)
		{
			if (trim($value1) === trim($value2)) 
			{
				return true ;
			}
			else
			{
				return false ;
			}
		}
		
		public function checkMail($mail)
		{
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
			if (preg_match($regex, $mail)) 
			{
				return true ;
			}
			else
			{
				return false ;
			}
		}
		
		
		public function checkNotNull($value)
		{
			if(trim($value) != "")
			{
				return true;	
			}
			else
			{
				return false;
			}
		}
		
		public function checkNumeric($value)
		{
			if(is_numeric($value) != "")
			{
				return true;	
			}
			else
			{
				return false;
			}
		}
		
		public function isUserExist($mail){  
           
		   $db = dbConnect::getInstance();
    $mysqli = $db->getConnection();
		   
		    $query = "SELECT * FROM users_tb WHERE mail= '".$mail."'";
			$res = $mysqli->query($query);  
            if(mysqli_num_rows($res) > 0){  
                return true;  
            } else {  
                return false;  
            }
		}
		
		
		public function checkID($id){  
           
		   $db = dbConnect::getInstance();
    $mysqli = $db->getConnection();
		   
		    $query = "SELECT * FROM users_tb WHERE id= '".$id."'";
			$res = $mysqli->query($query);  
            if(mysqli_num_rows($res) > 0){  
                return true;  
            } else {  
                return false;  
            }
		}
		
		
		public function checkPostID($id){  
           
		   $db = dbConnect::getInstance();
    $mysqli = $db->getConnection();
		   
		    $query = "SELECT * FROM posts_tb WHERE id= '".$id."'";
			$res = $mysqli->query($query);  
            if(mysqli_num_rows($res) > 0){  
                return true;  
            } else {  
                return false;  
            }
		}
		
		public function checkCommentID($id){  
           
		   $db = dbConnect::getInstance();
    $mysqli = $db->getConnection();
		   
		    $query = "SELECT * FROM comments_tb WHERE id= '".$id."'";
			$res = $mysqli->query($query);  
            if(mysqli_num_rows($res) > 0){  
                return true;  
            } else {  
                return false;  
            }
		}
		
		public function checkCookie()
		{
			if(isset($_COOKIE['cafeteriaSystem'])) {
				$db = dbConnect::getInstance();
    			$mysqli = $db->getConnection();
		   
		    	$query = "SELECT * FROM users_tb WHERE id= '".$_COOKIE['cafeteriaSystem']."'";
				$res = $mysqli->query($query); 
				if(mysqli_num_rows($res) > 0)
				{
					$row=mysqli_fetch_array($res);
					$_SESSION['cafeteriaSystem']=$row['id'];
					$_SESSION['type']=$row['type'];
					$_SESSION['name']=$row['name'];
					if($row[$type] == "1")
					{	
						header("location:orders.php");	
					}
					else
					{
						header("location:index.html");
					}	
				}
			
			}	
		}
		
		
		
		public function checkAuther($id)
		{
			
				$db = dbConnect::getInstance();
    			$mysqli = $db->getConnection();
		   
		    	$query = "SELECT * FROM posts_tb WHERE id= '".$id."'";
				$res = $mysqli->query($query); 
				if(mysqli_num_rows($res) > 0)
				{
					$row=mysqli_fetch_array($res);
					if($row['u_id'] == $_SESSION['php'] or $_SESSION['type'] == "1")
					{	
						return true;	
					}
					else
					{
						return false;
					}	
				}
			
				
		}
		
		
		
		public function checkCommentAuther($id)
		{
			
				$db = dbConnect::getInstance();
    			$mysqli = $db->getConnection();
		   
		    	$query = "SELECT * FROM comments_tb WHERE id= '".$id."'";
				$res = $mysqli->query($query); 
				if(mysqli_num_rows($res) > 0)
				{
					$row=mysqli_fetch_array($res);
					if($row['u_id'] == $_SESSION['php'] or $_SESSION['type'] == "1")
					{	
						return true;	
					}
					else
					{
						return false;
					}	
				}
			
				
		}
		

}  


/*

$user= new validation();
$check_exist=$user->isUserExist("eng.mina23@gmail.com");
if($check_exist)
{
	echo "Exist";	
}
else
{
	echo "Not Exist";	
}
*/
?>