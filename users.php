<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$users = new users();
$orders= new orders();
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
<title>allusers</title>
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<a type="button" class="btn btn-primary" href="view.php" >More Details</a>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<div class="container">
<?php
	require_once("includes/menu.php");
?>
<div class="row">
<div class="page-header text-center">
<h1>All Users</h1>
<div class="row">
<div class="col-sm-12">
<div class="right">
        <a href="addUser.php">Add Users</a> | <a href="rooms.php">Rooms</a>
    </div>
</div>
</div>

<!-- All Will Write Their Code Here -->
<div class="row">
<div class="row table-responsive">
	
	<?php
	
	if(isset($_GET['del_id']))
				{
					$del_id=$_GET['del_id'];
					
					
					if($validate->checkNotNull($del_id))
					{
						if($validate -> checkNumeric($del_id))
						{
							if($validate -> checkID($del_id))
							{
								if($orders -> checkFoundOrdersForId($del_id))
								{
									?><div class="alert alert-danger text-center">Cannot Delete This User Becous he already Get  Orders</div><?php
									
								}
								else
								{
										$users->delete($del_id);
								}
								
							}
							else
							{
								echo "No User Found With This Data";	
							}
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
	
	
		if($returnUsers = $users -> viewAllUsers())
		{
			?>
<table class="table table-bordered table-hover">
<thead >
<tr class="info ">
<th>Name</th>
<th>Room</th>
<th>image</th>
<th>ext</th>
<th>Action</th>
</tr>
</thead>
<tbody >
<?php
	while($rowUsers=mysqli_fetch_array($returnUsers))
	{
		
		?>
		<tr >
<td><?php echo $rowUsers['name'] ?> <label class=" pull-right"></label></td>
<td><?php $users->getMyRoom($rowUsers['roomNo']); ?></td>
<td width="20%"><img  src="uploads/users/<?php echo $rowUsers['pic_path'] ?>" class="img-responsive"></td>
<td><?php echo $rowUsers['ext'] ?></td>
<td class="text-center"> <a href="editUser.php?edit=<?php echo $rowUsers['id'] ?>" class="btn btn-info">Edit</a>&nbsp;&nbsp; <a href="users.php?del_id=<?php echo $rowUsers['id'] ?>" class="btn btn-info">Delete</a></td> </td>
</tr>
<?php
	}
?>

</tbody>
</table>
			<?php
		}
else
{
	echo "No Users Found on this DB";
}
	?>
</div>
<!-- Untill Here -->
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
