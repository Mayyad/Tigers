<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}


$validate = new validation(); 
$users = new users();


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
?>
<html>
	<head>
	<title> Cafetria</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body>

	
		
		    <div class="container">
		        <div class="card card-container">
		           <p id="profile-name" class="profile-name-card">please enter your email</p>
		           <?php
						if(isset($_POST['password_btn']))
						{
							$mail=$_POST['mail'];
							$secret=$_POST['mysecret'];
							$users -> resetPassword($mail , $secret);
							
						}
						?>
		            <form class="form-signin" action="" method="post">
		                <span id="secret" class="reauth-email"></span>
		                <input type="text" id="inputEmail" name="mysecret"  class="form-control" placeholder="Secret Answer" >
		                <span id="reauth-email" class="reauth-email"></span>
		                <input type="email" name="mail" id="inputEmail" class="form-control" name="mail" placeholder="Email address" required autofocus>
		                <button class="btn btn-lg btn-primary btn-block btn-signin" name="password_btn" type="submit">reset</button>
		            </form><!-- /form -->
		        </div><!-- /card-container -->
		    </div><!-- /container -->
	</body>

</html>



