<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$users = new users();
$rooms=new rooms();
$validate = new validation();
if(isset($_SESSION['cafeteriaSystem'])  ){
if($_SESSION['type'] != '1' )
{
	header("location:index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Setting</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    
    
	
    <style>
		body{
			margin-top:10px ;	
		}
		.border{
			border:1px solid #000;
			min-height:100px;	
		}
	</style>
    
    <!-- Bootstrap -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>	
    <script src="js/scripts.js"></script>	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php
  if(!isset($_GET['Done']) and !isset($_GET['edit']))
  {
		header("location:index.php");  
  }
  	if(isset($_GET['Done']))
	{
		
		
  ?>
  <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            <h4 class="modal-title">Confirmation</h4>
          </div>
          <div class="modal-body ">
          	<div class="alert alert-success">user Information Updated Successfully</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a type="button" class="btn btn-primary" href="index.php" >Back To Admin Panel</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

<?php
	}
		  if(isset($_GET['edit']) )
				  {
					  $u_id=$_GET['edit'];
					  if(trim($u_id) != "")
					  {
						  if(is_numeric($u_id))
						  {
				  				
				  ?>

    <div class="container">
    	<?php
			require_once("includes/menu.php");
		 
		 
		 if(isset($_GET['insRoom']))
		{
		?>
        <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
                <h4 class="modal-title text-left">Add New Room</h4>
              </div>
              <div class="modal-body ">
				  <?php
				  	if(isset($_POST['addRoomBtn']))
					{
						$roomNum=$_POST['roomNum'];
						//Check if is not Null
						if($validate -> checkNotNull($roomNum))
						{
							if($validate -> checkNumeric($roomNum))
							{
								if($rooms -> checkRoomNum($roomNum))
								{
									if($rooms -> addRoom($roomNum))
									{
											header("location:addUser.php?action=Insert Sucsessful Completed");
									}
									else
									{
										?>
											<p class="alert alert-danger">Some Things Wrong in Connection With DataBase Try Again Later</p>    
										<?php	
									}
								}
								else
								{
									?>
										<p class="alert alert-danger">This Room Inserted To The DataBase Befor</p>    
									<?php	
								}
							}
							else
							{
								?>
                            	<p class="alert alert-danger">Room Number Must Be Number </p>    
                                <?php	
							}
						}
						else
						{
							?>
                            <p class="alert alert-danger">Please Enter The Room Number</p>
                            <?php	
						}
					}
                  ?>              
                <form class="form-horizontal" action="addUser.php?insRoom" method="POST">
                    <div class="control-group">
                      <label class="control-label" for="username">Room Number</label>
                      <div class="controls">
                        <input id="username" name="roomNum" placeholder="" class="form-control input-lg" type="text">
                        <p class="help-block">Please Enter Room Number</p>
                      </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="addRoomBtn" class="btn btn-info ">Confirm</button>
                    </div>
              </div>
              <div class="modal-footer">
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
        <?php
		}
		?>
       
        
        <!--  <page Body  Will Change in Every Page> -->
        <div class="row">    	
                 
         <!-- All Will Write Their Code Here  -->
        <div class="container">
  <div class="row">
  	<div class="col-sm-12">
    		<?php
			
			
			
						
						
						
			if(mysqli_num_rows($users -> getUserInfoById($u_id)) == "1")
			{
				$rowUser=mysqli_fetch_array($users -> getUserInfoById($u_id));
				
				
				if(isset($_POST['save_btn']))
						{
							$name=$_POST['name'];
							$ext=$_POST['ext'];
							$roomNo=$_POST['roomNo'];
							$serverpass=$rowUser['pass'];
							$oldpassword=$_POST['oldPassword'];
							$newpassword=$_POST['newPassword'];
							$password=$rowUser['pass'];
							$pic_name=$rowUser['pic_path'];
							
							
							
							if(trim($name) != "" and trim($ext) != "" and trim($roomNo) != "0" )
							{
								if(isset($oldpassword))
								{
										if($validate->checkNotNull($oldpassword) and $validate->checkNotNull($newpassword) )
										{
											if($validate->checkEqual(md5($oldpassword),$serverpass))
											{
												$password=md5($newpassword);	
											}					
										}									
								 }
								
										
								if(isset($_FILES["myfile"]))
								{
									if($validate->checkImage())
									{          
										unlink("uploads/users/".$rowUser['pic_path']);
										$pic_name=time()."_".$_FILES["myfile"]["name"];
										move_uploaded_file($_FILES["myfile"]["tmp_name"], "uploads/users/".$pic_name);													
									}


										$putValue=$users -> updateUser($name , $ext, $roomNo,  $pic_name, $password , $u_id);
										if($putValue)
										{
											header("location:editUser.php?edit=".$u_id."&Done");
										}
										else
										{
											echo "Some Thing Wrong happen please Try Again Later";	
										}
								}
								
							}
							else
							{
								?>
								<p class="alert alert-danger w text-center">
                               <?php echo "Please Complete Your Data First";?>
                                </p>	
								<?php
                            }
							
							
						}
				
			?>
            <form class="form-horizontal" action="editUser.php?edit=<?php echo $u_id ?>" enctype="multipart/form-data" method="POST">
          <fieldset>
            
            <div class="control-group">
              <label class="control-label" for="username">Username</label>
              <div class="controls">
                <input id="username" name="name" placeholder="" value="<?php echo $rowUser['name'] ?>" class="form-control input-lg" type="text">
                <p class="help-block">Please Enter Your Name</p>
              </div>
            </div>
         
            <div class="control-group">
              <label class="control-label" for="email">E-mail</label>
              <div class="controls">
                <input id="email" name="mail" placeholder="" value="<?php echo $rowUser['mail'] ?>" class="form-control input-lg" type="email">
                <p class="help-block">Please provide your E-mail</p>
              </div>
            </div>


            <div class="control-group">
              <label class="control-label" for="email">Your Secret Answer</label>
              <div class="controls">
                <input id="email" name="text" disabled placeholder="" value="<?php echo $rowUser['secret'] ?>" class="form-control input-lg" type="text">
                
              </div>
            </div>
         	
            
            <div class="control-group">
              <label class="control-label" for="password">Password (old)</label>
              <div class="controls">
                <input id="password" name="oldPassword" placeholder="" class="form-control input-lg" type="password">
                <p class="help-block">Enter ur Old Password if u wanna to change the password</p>
              </div>
            </div>
         
            <div class="control-group">
              <label class="control-label" for="password_confirm">Password (new)</label>
              <div class="controls">
                <input id="password_confirm" name="newPassword" placeholder="" class="form-control input-lg" type="password">
                <p class="help-block">Enter Your New Password</p>
              </div>
            </div>
            
             <div class="control-group">
              <label class="control-label" for="roomNo">Room Number</label>
              	<label class="pull-right"><a href="addUser.php?insRoom" class="btn-link">Add Room</a></label>
              <div class="controls">
              <?php
					if($roomsReturn = $rooms -> selectAvilableRoom())
					{
					?>
                          <select id="roomNo" name="roomNo" class="form-control">
                              <?php
							  while($row=mysqli_fetch_array($roomsReturn))
							  {
							  ?>
                              <option <?php if($rowUser['roomNo'] == $row['id']){  echo "selected"; } ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                              
                            	<?php
							  }
							  ?>
                            </select>
                        
					<?php
					}
					else
					{
						
					}
					
					?>
              </div>
            </div>


      <div class="control-group">
              <label class="control-label" for="ext">Ext</label>
              <div class="controls">
                <input id="Room" name="ext" placeholder="ex:1024.1" value="<?php echo $rowUser['ext'] ?>" class="form-control input-lg" type="ext">
              </div>
            </div>

         
                        <div class="control-group">
                          profile Pic: <input type="file" name="myfile" size="25" />
                       </div>


            <div class="control-group">
              <!-- Button -->
              <div class="controls">
                <button class="btn btn-success" type="submit" name="save_btn">Save</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
            </div>
          </fieldset>
        </form>
        
        	<?php
			}
			else
			{
				?>
                <div class="alert alert-danger">No user Found With This DataBase</div>
                <?php	
			}
			?>
    </div>
   </div>
        
         <div class="row">
        	<div class="col-sm-12">
                <div class="well text-center well-default">
                    Website Designed By OS Nozha Team (Tigers TeaM)
                </div>
            </div>
        </div>
</div>
     	<?php
						  }						  
						  else
						  {
							  header("location:home.php");
						  }
					  }
					  else
					  {
						  header("location:home.php");
					  }
				  }
				  
				  ?>
    
    
  </body>
</html>

<?php
}
else
{
	header("location:login.php");	
}
?>
