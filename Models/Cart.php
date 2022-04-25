<?php

namespace Model;

use DateTime;

require_once('./Models/Model.php');

class Cart extends Model
{
    const TABLE_NAME = 'products';

    /**
     * @var int
     */
    protected int $id;

    /**
     * @var bool
     */
    protected bool $isExpired;

    /**
     * @var DateTime
     */
    protected DateTime $created_at;

    /**
     * @var DateTime
     */
    protected DateTime $updated_at;


    function __construct() {
        parent::__construct(tableName : self::TABLE_NAME);
    }

    function setDataFromExisting(int $id): Cart {
        $cartData = $this->getById(id : $id);

        $this->setId($cartData['id']);
        $this->setIsExpired($cartData['is_expired']);
        $this->setCreatedAt(new DateTime($cartData['created_at']));
        $this->setUpdatedAt(new DateTime($cartData['updated_at']));

        return $this;
    }

    public function getById(int $id): array {
        $query = "SELECT * FROM carts WHERE id = $id;";

        $data = $this->execute($query)->fetch();
        return $data ?: [];
    }

    public function addProductsToCart(int $productId, int $quantity): array {
        $query = "INSERT INTO carts_products
                        (id, cart_id, product_id, quantity)
                    VALUES 
                        (null, {$this->id}, $productId, $quantity)
                ";

        $data = $this->execute($query)->fetch();
        return $data ?: [];
    }

    public function deleteProductsFromCart(int $productId): array {
        $query = "DELETE FROM carts_products WHERE cart_id = {$this->id} AND product_id = $productId";

        $data = $this->execute($query)->fetch();
        return $data ?: [];
    }

    public function getAllProductsAmount() {
        $query = "SELECT product_id, quantity FROM carts_products WHERE cart_id = $this->id";

        $data = $this->execute($query)->fetchAll();
        return $data ?: [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->isExpired;
    }

    /**
     * @param bool $isExpired
     */
    public function setIsExpired(bool $isExpired): void
    {
        $this->isExpired = $isExpired;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}