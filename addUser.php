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
    <title>BootStrap</title>
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
  
  

    <div class="container">
    
    
 <?php
	require_once("includes/menu.php");
?>
        
        <!--  <page Body  Will Change in Every Page> -->
        <div class="row">    	
            <div class="page-header text-center">
                <h3>Add User</h3>
            </div> 
        </div>
        

	<!-- if any action Completed -->
        <?php
        if(isset($_GET['action']))
        {
        ?>
            <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
                    <h4 class="modal-title text-left">Action Complete</h4>
                  </div>
                  <div class="modal-body ">
                      <div class="alert alert-success text-center"><?php echo $_GET['action'] ?></div>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
        
        <?php
        }
        ?>
        
        <!-- End Of The Action Complete Pop Up -->

	 <!--  Insert New Room Pop Up  -->
        <?php
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
        <!-- End Of   Insert New Room Pop Up  -->

        
        <!-- All Will Write Their Code Here  -->
        <div class="container">
  <div class="row">
  	<div class="col-md-12">
    		<?php
	if(isset($_POST['save_btn']))
				{
					$name=$_POST['name'];
					$roomNo=$_POST['roomNo'];
					$ext=$_POST['ext'];
					$mail=$_POST['mail'];
					$password=$_POST['password'];
					$cpassword=$_POST['password_confirm'];
					#Check For Gender Exist  Or No
					if(isset($_POST['ugender'] ) )
					{
						$gender=	$_POST['ugender'];
					}
					else
					{
						$gender='';	
					}
					//echo strlen($fname);
					
					if(trim($name) != "" and trim($roomNo) != "" and trim($ext) != "" and trim($mail) != "" and trim($password) != "" and trim($cpassword) != ""  )
					{
						
							if ($validate->checkMail($mail)) {
									if($validate -> checkEqual($password , $cpassword))
									{
										
											if(! $validate -> isUserExist($mail))
											{
												
												
												if(isset($_FILES["myfile"]))
												{
													if($validate->checkImage())
													{	
														$pic_name=time()."_".$_FILES["myfile"]["name"];
														move_uploaded_file($_FILES["myfile"]["tmp_name"], "uploads/users/".$pic_name);
														$putValue=$users -> regist($name , $mail, $ext,  $pic_name , $password, $roomNo);
														if($putValue)
														{
															echo "Insert Complete";
															header("location:addUser.php?action=New User Added To Our DataBase");
														}
														else
														{
															echo "<div class='alert alert-danger '>Some Thing Wrong happen please Try Again Later</div>";	
														}
													}
													else
													{
														echo "<div class='alert alert-danger '>Invalied Picture</div>";	
													}

												}else
												{
													echo "<div class='alert alert-danger '>No Pics Found</div>";
												}	
											}
											else
											{
												echo "<div class='alert alert-danger '>This Email Entered Befor</div>";
											}
										
									}
									else
									{
										?>
							<p class="alert alert-danger w text-center">
						   <?php echo "<div class='alert alert-danger '>Password and Confirm Password Doesn't Match</div>";?>
							</p>	
							<?php	
									}
								}
								else
								{
									echo "Invalied Email";
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
    
          <form class="form-horizontal" action="addUser.php" enctype="multipart/form-data" method="POST">
          <fieldset>
            
            <div class="control-group">
              <label class="control-label" for="username">Username</label>
              <div class="controls">
                <input id="username" name="name" placeholder="" class="form-control input-lg" type="text">
                <p class="help-block">Please Enter Your Name</p>
              </div>
            </div>
         
            <div class="control-group">
              <label class="control-label" for="email">E-mail</label>
              <div class="controls">
                <input id="email" name="mail" placeholder="" class="form-control input-lg" type="email">
                <p class="help-block">Please provide your E-mail</p>
              </div>
            </div>
         
            <div class="control-group">
              <label class="control-label" for="password">Password</label>
              <div class="controls">
                <input id="password" name="password" placeholder="" class="form-control input-lg" type="password">
                <p class="help-block">Password should be at least 6 characters</p>
              </div>
            </div>
         
            <div class="control-group">
              <label class="control-label" for="password_confirm">Password (Confirm)</label>
              <div class="controls">
                <input id="password_confirm" name="password_confirm" placeholder="" class="form-control input-lg" type="password">
                <p class="help-block">Please confirm password</p>
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
                              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                              
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
                <input id="Room" name="ext" placeholder="ex:1024.1" class="form-control input-lg" type="ext">
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
     
    
    
  </body>
</html>

<?php
}
else
{
	header("location:login.php");	
}
?>
