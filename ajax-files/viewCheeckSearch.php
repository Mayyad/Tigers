<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script> 
$('#resetMyOrdersPageBtn').click(function()
{
	$.ajax(
	{
		type : 'POST',
		url : "ajax-files/viewMyOrdersReset.php" ,
		success : function( result )
		{
			$("#viewMyOrdersSearchView").html(result);	
		}
	});
});
</script>
<?php
	session_start();
	require_once("../files/orders.php");
	require_once("../files/users.php");
	$orders =new orders;
	$users =new users;
	$to=$_POST['to'];
	$from=$_POST['from'];
	$userID=$_POST['userID'];
	$searchUser='';
	$searchDate=0;
	$searchDateFrom = '' ;
	$searchDateTo = '';
	if(trim($to) != "" and trim($from) != "")
	{
		$searchDate=1;
		$searchDateFrom = $from ;
		$searchDateTo = $to ;
	}
	else
	{
		$searchDate=0;
	}

	if(is_numeric($userID))
	{
		if($userID == "0")
		{
			$searchUser='0';
		}
		else
		{
			$searchUser=$userID;
		}	
	}
	else
	{
		$searchUser='';
	}

	?>
    <button type="button" class="btn btn-info btn-block"  id="resetMyOrdersPageBtn">Review All Orders</button>
    	<?php
    if($searchUser != '')
    {
	    if($searchUser == "0" and $searchDate == '0')
	    {
	    	//echo "View All Cheeck For All Users";
	    	$users -> viewAllChecksSearch("" , "");
	    }

	    if($searchUser == "0" and $searchDate == '1')
	    {
	    	echo "View All Cheeck For All Users in Date Between to dates";
	    }

	    if($searchUser != "0"   and $searchDate == '0')
	    {
	    	echo "View All Cheeck For user  with all dates";
	    }

	    if($searchUser != "0"   and  $searchDate == '1')
	    {
	    	echo "View All Cheeck For user  In Certin Date";
	    }
	 }
	 else
	 {
	 	?>
	 	<div class="alert alert-danger ">Some Thing Wrong</div>
	 	<?php
	 }


	/*
	if($orders ->  checkFoundOrdersForId($_SESSION['cafeteriaSystem']))
	{
		$orders -> viewSearchChecksForUserByDate($_SESSION['cafeteriaSystem'] , $from  , $to, "1");
	}
	else
	{
		?>
			<div class="alert alert-danger">Sorry No Orders Found  For This User</div>
		<?php	
	}
		*/
?>