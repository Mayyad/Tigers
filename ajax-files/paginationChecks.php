<?php 
	$connection=mysqli_connect('localhost','root','iti','cafeteria_db')or die ("Error in Connection to server ") .mysqli_error();
if (mysqli_connect_errno($connection))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
mysqli_query($connection,"SET charset UTF8");

if(isset($_POST['secondryPage']))
{
require_once("../files/orders.php");
$orders=new orders();
}




/* **********************/
if(isset($_GET['p_id']))
{
	if(is_numeric($_GET['p_id']))
	{
		$strPage=$_GET['p_id'];	
	}
	else
	{
		$strPage='';
	}
	
}
else
{
	$strPage='';
}


			$query = "select * from users_tb  ";

$result = mysqli_query($connection,$query) or die(mysqli_error($connection));
$Num_Rows = mysqli_num_rows ($result);
 
########### pagins

$Per_Page = 1;   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$query.="  LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($connection,$query) or die(mysqli_error($connection));

// Insert a new row in the table for each person returned
if(mysqli_num_rows($result) > 0 ) {
	
	?>
		<table class="table table-bordered table-hover">
                    <thead >
                        <tr class="info ">
                            <th>Name </th>
                            <th width="20%">amount</th>
                        </tr>
                    </thead>
                    <tbody  class="text-left">
    <?php
    
	$index=1;
	while($rowUser=mysqli_fetch_array($result))
			{ 
		  
			?>	
				<!-- Users Name With Details -->
                    <tr >
                        <td >  <label class=" pull-left"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $rowUser['id'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $rowUser['id'] ?>">+</a></label>&nbsp; <?php echo $rowUser['name'] ?></td>
                        <td><?php $orders -> getSum($rowUser['id'] , "");?> </td>
                    </tr>

                    <tr id="collapse<?php echo $rowUser['id'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="  headingOne">
                      <td  colspan="2" class="">
                        <!-- Orders Date With its Content -->
                            
                            <?php
                           $orders -> viewChecksForUser($rowUser['id'] , "2");
                            ?>
                            
                        <!-- End Of Orders Date and Its Content -->
                      </td>
                    </tr>
                    <!-- End of Users Name With Details -->
			<?php

		    } ?>
              
		    </tbody>
          </table>

<nav>
  <ul class="pagination">
<?php

	
	for($i=1; $i<=$Num_Pages; $i++){
		if($i != $Page)
		{
			?>
			<li >
	      <span> <a  href="checks.php?p_id=<?php echo $i ?>"><?php echo $i ?></a> </span>
	    </li>
	    <?php
		}
		else
		{
			?>
			<li class="active">
	      <span><?php echo $i ?><span class="sr-only">(current)</span></span>
	    </li>
	    <?php
		}
	}

}
else
{
?>
	<div class="alet alert-danger text-center">No Users Found</div>
<?php
}
?>

</ul>
</nav>

