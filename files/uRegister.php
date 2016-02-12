<?php
require_once("dbConnect.php");
require_once("validation.php");


class uRegister 
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
		
		
		function regist($fname , $lname , $address ,  $country , $gender , $uname , $password , $myskils , $department,$pic_name)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " insert into users_tb set
						fname='".$fname."' ,
						lname='".$lname."' ,	
						address='".$address."' ,
						type = '2' ,
						country = '".$country."' ,
						gender='".$gender."' ,
						mail='".$uname."' ,
						password='".md5($password)."' ,
						skils='".$myskils."' ,
						dept = '".$department."' ,
						prof_pic='".$pic_name."'
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