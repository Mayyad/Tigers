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
              <?php
			  if($_SESSION['type'] == "1")
				{
				?>
                	<li class="active"><a href="orders.php">Home </a></li>
                <?php
				}
				else
				{
			  ?>
                <li class="active"><a href="index.php">Home </a></li>
                <?php
				}
				?>
                <li><a href="myOrders.php">My Orders</a></li>
                <?php
				if($_SESSION['type'] == "1")
				{
				?>
                <li><a href="myproducts.php">My Products</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="manualOrders.php">Manual Orders</a></li>
                <li><a href="checks.php">Checks</a></li>
                <?php
				}
				?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><img src="uploads/users/<?php echo $_SESSION['pic']; ?>" width="50" height="50"></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="login.php?logout">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>