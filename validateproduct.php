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
    //$picture = $_POST["pic"];
    
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





}
else
{
	header("location:login.php");	
}
?>