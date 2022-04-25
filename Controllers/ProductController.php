<?php

namespace Controller;

require_once('./Controllers/Controller.php');
require_once('./Models/Product.php');

use Model\Product;

class ProductController extends Controller
{
    public Product $product;

    function __construct() {
        parent::__construct();
    }

    public function initializeProduct(int $id): ProductController
    {
        $this->product = new Product();
        $this->product->setDataFromExisting(id : $id);

        return $this;
    }
}