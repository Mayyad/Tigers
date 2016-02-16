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
		
		
		/************************* View All Users Except Number 1 *************************/
		function view()
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where id != '1' ";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));	
			if(mysqli_num_rows($res) > 0)  
           	{
				?>
        	<table class="table text-center table-hover table-bordered">
             	<tr>
                	<th >#</th>
                    <th>Namae</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>
					<?php
                        $index=1;
                        while($row=mysqli_fetch_array($res))
                        {
                    ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                <td><?php echo $row['mail']; ?></td>
                                <td>
                                    <a href="update.php?u_id=<?php echo $row['id']; ?>" class="btn btn-info">Update</a>
                                    <a href="home.php?del_id=<?php echo $row['id']; ?>" class="btn btn-info">Delete</a>
                                </td>
                            </tr>
                                                        <?php
                        }
                    ?>   
            </table>
				<?php
            }  
            else  
            {  
              	?>
                	<div class="alert alert-danger text-center">Sorry No User Found On This DataBase</div>
                <?php 
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
			
			unlink("uploads/".$row['prof_pic']);
			$res1=$mysqli->query($query1) or die (mysqli_error($mysqli));
			if($res1)
			{
				header("location:home.php");	
			}
			else
			{
				echo "Some Thing Wrong Please Try Again Later";	
			}
		}
		
		/************************* Update user Tb  *************************/
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
		
		
		/************************* View Single user   *************************/
		function view_user($id , $viewType)
		{
			$db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " select * from users_tb where id != '1' and id='".$id."' ";  
            $res = $mysqli->query($query) or die (mysqli_error($mysqli));
			if(mysqli_num_rows($res) == 1)
			{
				$row=mysqli_fetch_array($res);
			?>
            <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control"    id="fname" name="fname" value="<?php echo $row['fname']; ?>" placeholder="Enter Your First name">
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname"   name="lname" value="<?php echo $row['lname']; ?>" placeholder="Enter Your Last Name">
                      </div>
                      

                      
                      <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address"  name="address"rows="3"><?php echo $row['address']; ?></textarea>
                      </div>
                      
                      <div class="form-group">
                      	<label for="country" >Country</label>
                        <select class="form-control" name="country">
                          <option value="0">Select Country</option>
                          <option <?php if($row['country']=="1"){ echo "selected"; } ?> value="1">Egypt</option>
                          <option <?php if($row['country']=="2"){ echo "selected"; } ?> value="2">KSA</option>
                          <option <?php if($row['country']=="3"){ echo "selected"; } ?> value="3">USA</option>
                          <option <?php if($row['country']=="4"){ echo "selected"; } ?> value="4">France</option>	
                        </select>	
                      </div>	


											<div class="form-group">
                        <label for="file">Profie Picture</label>
                        <input type="file" class="form-control" id="file"  name="myfile" >
                      </div>

                      
                      <div class="form-group">
                      	<label for="age">Gender</label>
                        <p class="form-control">
                        <label class="radio-inline ">
                          <input type="radio" name="ugender" <?php if($row['gender']=="1"){ echo "checked"; } ?> id="inlineRadio2" value="1"> Male
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="ugender" <?php if($row['gender']=="2"){ echo "checked"; } ?>  id="inlineRadio3" value="2"> Female
                        </label>
                        </p>
                      </div> 
					                       
                      
                      <div class="form-group">
                      	<label for="age">Skils</label>
                        <p class="form-control">
                        <label class="checkbox-inline">
                        <?php
						$row['skils']=trim($row['skils']);
						$skilexp=explode("&" , $row['skils']);
						?>
                          <input type="checkbox" id="inlineCheckbox1" name="skils[]"
                          <?php
								if(in_array('php',$skilexp))
								{
									echo "checked";	
								}
								
							?>
  
                           value="php"> PHP
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox2" <?php
						  
								if(in_array('j2se',$skilexp))
								{
									echo "checked";	
								}
							?> name="skils[]" value="j2se"> J2SE
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox1" name="skils[]"
                          <?php
								if(in_array('mysql',$skilexp))
								{
									echo "checked";	
								}
							?> value="mysql"> MYSQL
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox2"
                        <?php
							if(in_array('postgreesql',$skilexp))
							{
								echo "checked";	
							}
						?> 
                           name="skils[]" value="postgreesql"> POSTGREESQL
                        </label>
                        </p>
                       </div>
                       
                       <div class="form-group">
                        <label for="uname">User Name</label>
                        <input type="text" class="form-control" id="uname"   value="<?php echo $row['mail'] ?>"  placeholder="Enter Your User Name">
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control"    id="password"  name="oldpassword" placeholder="Enter Your old Password"  >
                      </div>
                      
                      <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control"   id="password"  name="newpassword" placeholder="Enter Your New Password"  >
                      </div>
                      
                      <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control"  id="department"   value="OpenSource" disabled  >
                        <input type="hidden" class="form-control"  name="dept"  value="<?php echo $row['dept'] ?>"   >
                      </div>
                      <?php
					  if($viewType == "update")
					  {
					  ?>
                      <button type="submit" name="regist_btn" class="btn btn-info pull-right">update</button>
            <?php
					  }
			}
			else
			{
				?>
                	<div class="alert alert-danger">No User Found With This Data</div>
                <?php
			}
		}
		
		/************************* Update user Tb  *************************/
		function updateUser($fname , $lname , $address ,  $country , $gender , $password , $myskils , $department,$pic_name , $id)
		{
			 $db = dbConnect::getInstance();
    		 $mysqli = $db->getConnection();
			$query = " update users_tb set
						fname='".$fname."' ,
						lname='".$lname."' ,	
						address='".$address."' ,
						type = '2' ,
						country = '".$country."' ,
						gender='".$gender."' ,
						password='".$password."' ,
						skils='".$myskils."' ,
						dept = '".$department."' ,
						prof_pic='".$pic_name."' where id='".$id."'
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
