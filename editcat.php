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
    if (!empty($_POST["catName"]))
    {
       $catName = $_POST["catName"];
    }
    else 
    {
      $catName = $_POST["tempname"];   
    }
    
    $id = $_POST["id"];
    $statues = $_POST["status"];
  
   
    
   $products->updatecat($id , $catName ,$statues);
   
   header("location:myproducts.php");
}



if(isset($_POST["submitt"]))
{
    $catname = $_POST["catName"];
    //echo $catname;
    $products->addcat($catname);
    header("location:myproducts.php");
}




}
else
{
	header("location:login.php");	
}
?>