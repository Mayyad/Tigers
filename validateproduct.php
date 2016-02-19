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




/////////////////////////////////////////////////////////Add Product

if (isset($_POST["submit"]))   
{
    $addProductFalg = 1;
    
    $proName = $_POST["proName"];
    $price = $_POST["price"];
    $statues = $_POST["statues"];
    $catId = $_POST["catID"];
    
    if (!$validate->checkNotNull($proName))
    {
        $addProductFalg = 0;
    }
    
    if (!$validate->checkNotNull($price))
    {
        $addProductFalg=0;
    }
    
    if (!$validate->checkNotNull($statues))
    {
        $addProductFalg=0;
    }
    
    if (!$validate->checkNotNull($catId))
    {
        $addProductFalg=0;
    }
    
    
    if ($addProductFalg == 1 )
    {
        if(isset($_FILES["myfile"]))
        {
                if($validate->checkImage())
                {	
                        $pic_name=time()."_".$_FILES["myfile"]["name"];
                        move_uploaded_file($_FILES["myfile"]["tmp_name"], "uploads/products/".$pic_name);
                        $putValue= $products->AddPro($proName,$price,$statues, $pic_name,$catId);
                        if($putValue)
                        {
                                echo "Insert Complete";
                                header("location:myproducts.php?action=New Product Added To Our DataBase");
                        }
                        else
                        {
                                echo "<div class='alert alert-danger '>Some Thing Wrong happen please Try Again Later</div>";	
                        }
                }
                else
                {
                        echo "<div class='alert alert-danger '>Invalied Picture</div>";	
                }

        }
        else
        {
                echo "<div class='alert alert-danger '>No Pics Found</div>";
        }
    
    }
    
    else
    {
        header("location:myproducts.php?LeckOFInformation");
    }
   
   
}



/////////////////////////////////////////////////////////////Update Products


if (isset($_POST["submitt"]))
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