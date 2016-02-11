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
    
    
    <!-- Nav Bar -->
      <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Cafeteria</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.html">Home </a></li>
                <li><a href="myOrders.html">My Orders</a></li>
                <li><a href="myProducts.html">My Products</a></li>
                <li><a href="categories.html">Categories</a></li>
                <li><a href="rooms.php">Users</a></li>
                <li><a href="manualOrders.html">Manual Orders</a></li>
                <li><a href="checks.html">Checks</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><img src="images/avatar_2x.png" width="50" height="50"></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mina Amir <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="setting.html">Setting</a></li>
                    <li><a href="#">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>


     <div class="row">      
            <div class="page-header text-center">
                <h1>All Rooms</h1>
            </div> 
      </div>   
		
        <div class="row text-right marginBottom">
        	<a class="btn btn-info" href="#">Insert New Room</a>
        </div>
        
	
       <div class="row table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead >
                                    <tr class="info ">
                                        <th>Name </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr >
                                        <td> 2001 </td>
                                        
                                        <td>   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#avilabe"> Avilable </button> 

                                           

                                         <a href="#" class="btn btn-info"> Edit </a> 
                                                                 <a href="#" class="btn btn-danger"> Delete </a>  </td>
                                    </tr>
                                    
                                    <tr >
                                        <td> 2001 </td>
                                        
                                        <td>   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#avilabe"> Un Avilable </button> 

                                           

                                         <a href="#" class="btn btn-info"> Edit </a> 
                                                                 <a href="#" class="btn btn-danger"> Delete </a>  </td>
                                    </tr>
                                    
                                    <tr >
                                        <td> 2001 </td>
                                        
                                        <td>   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#avilabe"> Avilable </button> 

                                           

                                         <a href="#" class="btn btn-info"> Edit </a> 
                                                                 <a href="#" class="btn btn-danger"> Delete </a>  </td>
                                    </tr>
                                </tbody>
                
                            </table>
                        </div>


  

</body>
</html>