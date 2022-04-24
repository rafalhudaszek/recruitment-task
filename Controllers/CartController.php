<?php

namespace Controller;

require_once('./Controllers/Controller.php');
require_once('./Models/Cart.php');
require_once('./Models/Product.php');

use Model\Cart;

class CartController extends Controller
{
    private Cart $cart;

    const EXPORT_HTML_FILE_NAME = 'cart_products.html';
    const EXPORT_TXT_FILE_NAME = 'cart_products.txt';

    function __construct() {
        parent::__construct();

        $this->cart = new Cart();
    }

    public function initializeCart(int $id): CartController
    {
        $this->cart->setDataFromExisting(id : $id);

        return $this;
    }

    public function addProducts(int $productId, int $quantity): void {
        $this->cart->addProductsToCart(productId : $productId, quantity: $quantity);
    }

    public function deleteProducts(int $productId): void {
        $this->cart->deleteProductsFromCart(productId : $productId);
    }

    public function calculateCartValue(): float {
        $amountOfProducts = $this->cart->getAllProductsAmount();

        $cartValue = 0;
        foreach ($amountOfProducts as $amountOfProduct) {
            //TODO: there should by one Controller for many models of Product
            $productController = new ProductController();
            $productController->initializeCart($amountOfProduct['product_id']);
            $cartValue += $productController->product->getPrice() * $amountOfProduct['quantity'];
        }

        return $cartValue;
    }

    public function exportToHTML(): void {
        $content = '<table><tr><th>Nazwa produktu</th><th>Ilość</th><th>Cena</th></tr>';

        $amountOfProducts = $this->cart->getAllProductsAmount();

        foreach ($amountOfProducts as $amountOfProduct) {
            $productController = new ProductController();
            $productController->initializeCart($amountOfProduct['product_id']);
            $content = "$content<tr><td>{$productController->product->getName()}</td><td>{$amountOfProduct['quantity']}</td><td>{$productController->product->getPrice()}</td></tr>";
        }

        $content = "$content</table>";

        file_put_contents(self::EXPORT_HTML_FILE_NAME, $content);
    }

    public function exportToTXT(): void {
        $content = "Nazwa produktu\tIlość\tCena\n";

        $amountOfProducts = $this->cart->getAllProductsAmount();

        foreach ($amountOfProducts as $amountOfProduct) {
            $productController = new ProductController();
            $productController->initializeCart($amountOfProduct['product_id']);
            $content = "$content\t{$productController->product->getName()}\t{$amountOfProduct['quantity']}\t{$productController->product->getPrice()}\n";
        }

        file_put_contents(self::EXPORT_TXT_FILE_NAME, $content);
    }
}