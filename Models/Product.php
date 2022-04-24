<?php

namespace Model;

use DateTime;

require_once('./Models/Model.php');

class Product extends Model
{
    const TABLE_NAME = 'products';

    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var int
     */
    protected int $price;

    /**
     * @var string
     */
    protected string $code;

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

    function setDataFromExisting(int $id): Product {
        $productData = $this->getById(id : $id);

        $this->setId($productData['id']);
        $this->setName($productData['name']);
        $this->setPrice($productData['price']);
        $this->setCode($productData['code']);
        $this->setCreatedAt(new DateTime($productData['created_at']));
        $this->setUpdatedAt(new DateTime($productData['updated_at']));

        return $this;
    }

    function getById(int $id): array {
        $query = "SELECT * FROM products WHERE id = $id;";

        $data = $this->execute($query)->fetch();
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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