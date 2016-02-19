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
    if (!empty($_POST["proName"]))
    {
       $proName = $_POST["proName"];
    }
    else 
    {
      $proName = $_POST["tempname"];   
    }
    
    if (!empty($_POST["price"]))
    {
       $price = $_POST["price"];
    }
    else 
    {
      $price = $_POST["tempprice"];   
    }
    
    
    $picture = $_POST["pic"];
    $id = $_POST["id"];
    $statues = $_POST["status"];
    $catId = $_POST["catID"];
    echo $statues;
    
   $products->updatePro($id , $proName,$price,$statues, $picture,$catId);
   
   header("location:myproducts.php");
}



}   
else
{
	header("location:login.php");	
}
?>