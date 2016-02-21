<?php


require_once('../files/dbConnect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = dbConnect::getInstance();
$mysqli = $db->getConnection();
//echo $mysqli;
$product_id=$_POST['product_id'];
$condition=$_POST['product_avail'];
echo $product_id ."<br/>";
echo $condition."<br/>";

if($condition=="product_unavail") {
    $query = "update `products_tb` set status='1' where id='$product_id'";
    $result = $mysqli ->query($query);
    echo $result ;
}elseif($condition=="product_avail"){
    $query = "update `products_tb` set status='0' where id='$product_id'";
    $result = $mysqli ->query($query);
    echo $result ;
}
?>