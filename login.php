<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$login=new uLogin();
$validate = new validation(); 

//echo $_SESSION['type'];
$validate -> checkCookie();


if(isset($_SESSION['cafeteriaSystem']))
{
	if($_SESSION['type'] == "1")
	{
		header("location:orders.php");
	}
	else
	{
		header("location:index.php");
	}

}


if(isset($_GET['logout']))
{
	//echo("aaaaa");
	session_destroy();
	unset($_COOKIE['cafeteriaSystem']);
	setcookie("cafeteriaSystem", null , time() - 3600);
	header("location:login.php");
}
?>
<html>
	<head>
	<title>Cafeteria System | Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body>
		
		    <div class="container">
            	
                	
		        <div class="card card-container">
                             <h3 align="center" style="color:black;">Cafeteria</h3>
		            <img id="profile-img" class="profile-img-card" src="images/avatar_2x.png" />
                    
                    <?php
				  	if(isset($_POST['login_btn']))
					{
						$uname=$_POST['uname'];
						$pass=$_POST['password'];
						$checked='';
						if($validate -> checkNotNull($uname) and $validate -> checkNotNull($pass))
						{
							if ($validate->checkMail($uname)) 
							{
								if(isset($_POST['remember']))
								{
									$checked='1';
								}
								else
								{
									$checked='2';;
								}
								if($login -> login($uname , $pass , $checked))
								{
									echo "Go To Login Function";			
								}
								else
								{
								?>
									<div class="alert alert-danger">No Email Found With This Data or This User Blocked <br> Please Contact The Administretor</div>
								<?php	
								}
																		
							}
							else
							{
								?>
								<div class="alert alert-danger">Invalied Email</div>
							<?php
							}
							
						}
						else
						{
							?>
                            	<div class="alert alert-danger">Please Enter Your Email and password</div>
                            <?php	
						}
					}
				  ?>
                    
		            <p id="profile-name" class="profile-name-card"></p>
		            <form class="form-signin" method="post" action="login.php" >
		                <span id="reauth-email" class="reauth-email"></span>
		                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="uname"  autofocus>
		                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" >
		                <div id="remember" class="checkbox">
		                    <label>
		                        <input type="checkbox" name="remember"> Remember me
		                    </label>
		                </div>
		                <button class="btn btn-lg btn-primary btn-block btn-signin" name="login_btn" type="submit">Sign in</button>
		            </form><!-- /form -->
		            <a href="resetpassword.php" class="forgot-password">
		                Forgot the password?
		            </a>
		        </div><!-- /card-container -->
		    </div><!-- /container -->
	</body>

</html>



