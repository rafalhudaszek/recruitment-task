<?php

require_once('./Controllers/ProductController.php');
require_once('./Controllers/CartController.php');

use Controller\CartController;
use Controller\ProductController;



$cartController = new CartController();
$cartController->initializeCart(1);


//var_dump($cartController->calculateCartValue());
//$cartController->exportToHTML();
$cartController->exportToTXT();