<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$rooms=new rooms();
$validate = new validation();
if(isset($_SESSION['cafeteriaSystem'])  ){
if($_SESSION['type'] != '1' )
{
	header("location:index.php");
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
    <link href="css/css.css" rel="stylesheet">
    <style>
		body{
			margin-top:10px ;	
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
  		<!-- Menu Bar-->
            <?php require_once("includes/menu.php"); ?>
        <!-- End Of Menu Bar -->    
            
      	<div class="row">      
            <div class="page-header text-center">
                <h1>All Rooms</h1>
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
											header("location:rooms.php?action=Insert Sucsessful Completed");
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
                <form class="form-horizontal" action="rooms.php?insRoom" method="POST">
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
        
        <!--  Edit  Room Pop Up  -->
        <?php
		if(isset($_GET['edit']))
		{
			$roomNum=$_GET['edit'];
			if($validate -> checkNotNull($roomNum))
			{
				if($validate -> checkNumeric($roomNum))
				{
					if($rooms -> checkRoomNumById($roomNum))
					{
						$roomInfo = $rooms -> getRoomInfo($roomNum);
						?>
						<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
								<h4 class="modal-title text-left">Edit Room</h4>
							  </div>
							  <div class="modal-body ">
								  <?php
									if(isset($_POST['editRoomBtn']))
									{
										$roomName=$_POST['roomNum'];
										//Check if is not Null
										if($validate -> checkNotNull($roomName))
										{
											if($validate -> checkNumeric($roomName))
											{	
												if($rooms -> editRoom($roomName , $roomNum))
												{
														header("location:rooms.php?action=Edit Sucsessful Completed");
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
								<form class="form-horizontal" action="rooms.php?edit=<?php echo $roomNum ?>" method="POST">
									<div class="control-group">
									  <label class="control-label" for="username">Room Number</label>
									  <div class="controls">
										<input id="username" name="roomNum" value="<?php echo $roomInfo['name']; ?>" class="form-control input-lg" type="text">
										<p class="help-block">Please Enter Room Number</p>
									  </div>
									</div>
									<div class="text-right">
										<button type="submit" name="editRoomBtn" class="btn btn-info ">Confirm</button>
									</div>
							  </div>
							  <div class="modal-footer">
							  </div>
							</div><!-- /.modal-content -->
						  </div><!-- /.modal-dialog -->
						</div>
						<?php
					}
					else
					{
						header("location:rooms.php");	
					}
				}
				else
				{
					header("location:rooms.php");	
				}
			}
			else
			{
				header("location:rooms.php");	
			}
		}
		?>
        <!-- End Of   Edit Room Pop Up  -->
        
        <!--  Edit  Room Pop Up  -->
        <?php
		if(isset($_GET['delete']))
		{
			$roomNum=$_GET['delete'];
			if($validate -> checkNotNull($roomNum))
			{
				if($validate -> checkNumeric($roomNum))
				{
					if($rooms -> checkRoomNumById($roomNum))
					{
						?>
						<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
								<h4 class="modal-title text-left">Edit Room</h4>
							  </div>
							  <div class="modal-body ">
								  <?php
									if(isset($_POST['deleteRoomBtn']))
									{
										if($rooms -> checkUserSelectRoom($roomNum))
										{
											if($rooms -> deleteRoom($roomNum))
											{
												header("location:rooms.php?action=Room Deleted Succssesfilly");
											}
											else
											{
												?>
                                                <div class="alert alert-danger ">Sorry Some Thing Wrong On Connection With DataBase</div>
                                                <?php	
											}
										}
										else
										{
											?>
                                            <div class="alert alert-danger">Sorry This Room Canot Deleted Becose Its Choosen By User</div>
                                            <?php
										}
										
									}
								  ?>              
								<form class="form-horizontal" action="rooms.php?delete=<?php echo $roomNum ?>" method="POST">
									<div class="row">
									 	Are You Sure You Wanna To Delete This Roms?
                                        <div class="text-right">
                                            <button type="submit" name="deleteRoomBtn" class="btn btn-danger">yes</button>
                                            <a class="btn btn-info" href="rooms.php">No</a>	
                                        </div>
                                 	 </div>
							  </div>
							  <div class="modal-footer">
							  </div>
							</div><!-- /.modal-content -->
						  </div><!-- /.modal-dialog -->
						</div>
                        
						<?php
					}
					else
					{
						header("location:rooms.php");	
					}
				}
				else
				{
					header("location:rooms.php");	
				}
			}
			else
			{
				header("location:rooms.php");	
			}
		}
		?>
        <!-- End Of   Edit Room Pop Up  -->
        
        <!--  UnAvaliable  Room Pop Up  -->
        <?php
		if(isset($_GET['unavailable']))
		{
			$roomNum=$_GET['unavailable'];
			if($validate -> checkNotNull($roomNum))
			{
				if($validate -> checkNumeric($roomNum))
				{
					if($rooms -> checkRoomNumById($roomNum))
					{
						?>
						<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
								<h4 class="modal-title text-left">Edit Room</h4>
							  </div>
							  <div class="modal-body ">
								  <?php
									if(isset($_POST['unavailableRoomBtn']))
									{
										if($rooms -> checkUserSelectRoom($roomNum))
										{
											if($rooms -> unavilableRoom($roomNum))
											{
												header("location:rooms.php?action=Room unavailable Succssesfilly");
											}
											else
											{
												?>
                                                <div class="alert alert-danger ">Sorry Some Thing Wrong On Connection With DataBase</div>
                                                <?php	
											}
										}
										else
										{
											header("location:rooms.php?action=Sorry This Room Canot unavilable Becose Its Choosen By User");
										}
										
									}
								  ?>              
								<form class="form-horizontal" action="rooms.php?unavailable=<?php echo $roomNum ?>" method="POST">
									<div class="row">
									 	Are You Sure You Wanna To unavailable This Roms?
                                        <div class="text-right">
                                            <button type="submit" name="unavailableRoomBtn" class="btn btn-danger">yes</button>
                                            <a class="btn btn-info" href="rooms.php">No</a>	
                                        </div>
                                 	 </div>
							  </div>
							  <div class="modal-footer">
							  </div>
							</div><!-- /.modal-content -->
						  </div><!-- /.modal-dialog -->
						</div>
                        
						<?php
					}
					else
					{
						header("location:rooms.php");	
					}
				}
				else
				{
					header("location:rooms.php");	
				}
			}
			else
			{
				header("location:rooms.php");	
			}
		}
		?>
        <!-- End Of   unAvilable  Room Pop Up  -->
        
        
        <!--  UnAvaliable  Room Pop Up  -->
        <?php
		if(isset($_GET['available']))
		{
			$roomNum=$_GET['available'];
			if($validate -> checkNotNull($roomNum))
			{
				if($validate -> checkNumeric($roomNum))
				{
					if($rooms -> checkRoomNumById($roomNum))
					{
						?>
						<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
								<h4 class="modal-title text-left">Edit Room</h4>
							  </div>
							  <div class="modal-body ">
								  <?php
									if(isset($_POST['availableRoomBtn']))
									{
										if($rooms -> avilableRoom($roomNum))
										{
											header("location:rooms.php?action=Room available Succssesfilly");
										}
										else
										{
											?>
											<div class="alert alert-danger ">Sorry Some Thing Wrong On Connection With DataBase</div>
											<?php	
										}	
									}
								  ?>              
								<form class="form-horizontal" action="rooms.php?available=<?php echo $roomNum ?>" method="POST">
									<div class="row">
									 	Are You Sure You Wanna To available This Roms?
                                        <div class="text-right">
                                            <button type="submit" name="availableRoomBtn" class="btn btn-danger">yes</button>
                                            <a class="btn btn-info" href="rooms.php">No</a>	
                                        </div>
                                 	 </div>
							  </div>
							  <div class="modal-footer">
							  </div>
							</div><!-- /.modal-content -->
						  </div><!-- /.modal-dialog -->
						</div>
                        
						<?php
					}
					else
					{
						header("location:rooms.php");	
					}
				}
				else
				{
					header("location:rooms.php");	
				}
			}
			else
			{
				header("location:rooms.php");	
			}
		}
		?>
        <!-- End Of   unAvilable  Room Pop Up  -->
        
		
        <div class="row text-right marginBottom">
        	<a class="btn btn-info" href="rooms.php?insRoom">Insert New Room</a>
        </div>
        
	
       <div class="row table-responsive">
           <?php
		   		if($rooms ->  checkFoundRooms()	 )
				{
					$rooms -> viewAllRooms();
				}
				else
				{
					?>
                    	<div class="alert alert-danger">Sorry No Rooms Found <a class="btn-link" href="rooms.php?insRoom">Insert New Room</a></div>
                    <?php	
				}
		   ?>                 
                            
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