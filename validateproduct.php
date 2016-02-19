<?php
ob_start();
session_start();
function __autoload($name)
{
	include_once("files/".$name.".php");	
}

$products = new products();
$rooms=new rooms();
$validate = new validation();
if(isset($_SESSION['cafeteriaSystem'])  ){
if($_SESSION['type'] != '1' )
{
	header("location:index.php");
}


if (isset($_POST["submit"]))
{
    $proName = $_POST["proName"];
    $price = $_POST["price"];
    $statues = $_POST["statues"];
    $catId = $_POST["catID"];
    $picture = $_POST["pic"];
    //echo $statues;
    
   $products->AddPro($proName,$price,$statues, $picture,$catId);
   
   header("location:myproducts.php");
}





}
else
{
	header("location:login.php");	
}
?>