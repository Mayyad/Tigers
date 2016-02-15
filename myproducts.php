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
	header("location:index.php");
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> My Products </title>
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
    
    
<?php
	require_once("includes/menu.php");
?>

     <div class="row">      
            <div class="page-header text-center">
                <h1>My Product</h1>
            </div> 
      </div>   


       <div class="row table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead >
                                    <tr class="info ">
                                        <th>Name </th>
                                        <th>Number of brands</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td> Hot <label class=" pull-right"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">+</a></label></td>
                                        <td> 5 </td>
                                        <td>   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#avilabe"> Avilable </button> </td>

                                            <div id="avilabe" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Are you sure to avialable this product</p>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=""> yes </button> </td>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button> </td>

                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>

                                        <td class="text-center"> <a href="#" class="btn btn-info"> Edit </a> 
                                                                 <a href="#" class="btn btn-danger"> Delete </a>  </td>
                                    </tr>

                                    <tr id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="  headingOne">
                                      <td  colspan="4" class="">
                                        <div class="row text-center">   <!-- asnaaf start -->
                                            <div class="col-sm-2 ">
                                                <h4 class="text-center text-muted">Tea</h4>
                                            </div>
                                            <div class="col-sm-5">
                                                    <div>
                                                      <div class="col-sm-2">
                                                        <span class="checkbox">
                                                            <input type="checkbox">
                                                            <label data-on="ON" data-off="OFF"></label>
                                                        </span>
                                                      </div>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="row text-center">   <!-- asnaaf start -->
                                            <div class="col-sm-2 ">
                                                <h4 class="text-center text-muted">coffe</h4>
                                            </div>
                                            <div class="col-sm-5">
                                                    <div>
                                                      <div class="col-sm-2">
                                                        <span class="checkbox">
                                                            <input type="checkbox">
                                                            <label data-on="ON" data-off="OFF"></label>
                                                        </span>
                                                      </div>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="row text-center">   <!-- asnaaf start -->
                                            <div class="col-sm-2 ">
                                                <h4 class="text-center text-muted">milk with tea</h4>
                                            </div>
                                            <div class="col-sm-5">
                                                    <div>
                                                      <div class="col-sm-2">
                                                        <span class="checkbox">
                                                            <input type="checkbox">
                                                            <label data-on="ON" data-off="OFF"></label>
                                                        </span>
                                                      </div>
                                                    </div>
                                            </div>
                                        </div>
                                      </td>
                                    </tr>


                                    
                                </tbody>
                
                            </table>
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