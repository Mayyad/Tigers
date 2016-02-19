<?php
session_start();
require_once("../files/products.php");
$word=$_POST['word'];
$products = new products();
//echo "aaaaaaaaaaaaaaa";
								if($products -> checkAvailableProducts())
								{
									$products -> viewavAilableProductsBySearch($word);	
									
								}
								
							?>