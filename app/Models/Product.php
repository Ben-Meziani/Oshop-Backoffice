<?php

namespace App\Models;

use App\Database;
use PDO;

/**
 * Product hérite de CoreModel
 */
class Product extends CoreModel
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var float
     */
    private $price;
    /**
     * @var int
     */
    private $rate;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $brand_id;
    /**
     * @var int
     */
    private $category_id;
    /**
     * @var int
     */
    private $type_id;

    /**
     *
     * @return Product[]
     */
    public static function findAllBackOfficeHomepage()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT id, name
                FROM product
                ORDER BY id DESC
                LIMIT 3";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `product` (name, description, picture, price, status,
                brand_id, category_id, type_id)
                VALUES (:name, :description, :picture, :price, :status, :brand_id, :category_id, :type_id)";

        $stmt = $pdo->prepare($sql);

        $insertedRows = $stmt->execute([
            ":name"         => $this->name,
            ":description"  => $this->description,
            ":picture"      => $this->picture,
            ":price"        => $this->price,
            ":status"       => $this->status,
            ":brand_id"     => $this->brand_id,
            ":category_id"  => $this->category_id,
            ":type_id"      => $this->type_id,
        ]);

        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }

    public function insertNewProductTag($tag_id)
    {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `product_has_tag` (product_id, tag_id)
                VALUES (:product_id, :tag_id)";
        $stmt = $pdo->prepare($sql);

        // on remplace ici :name par sa valeur
        return $stmt->execute([
            ":product_id" => $this->id,
            ":tag_id"     => $tag_id,
        ]);
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "UPDATE `product`
                SET
                name        = :name,
                description = :description,
                picture     = :picture,
                price       = :price,
                status      = :status,
                brand_id    = :brand_id,
                category_id = :category_id,
                type_id     = :type_id,
                updated_at = NOW()
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":name"         => $this->name,
            ":description"  => $this->description,
            ":picture"      => $this->picture,
            ":price"        => $this->price,
            ":status"       => $this->status,
            ":brand_id"     => $this->brand_id,
            ":category_id"  => $this->category_id,
            ":type_id"      => $this->type_id,
            ":id"           => $this->id,
        ]);
    }

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getShortDescription()
    {
        return mb_substr($this->description, 0, 45) . '...';
    }

    /**
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     */
    public function setRate(int $rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Get the value of brand_id
     *
     * @return  int
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @param  int  $brand_id
     */
    public function setBrandId(int $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Get the value of category_id
     *
     * @return  int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     */
    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of type_id
     *
     * @return  int
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @param  int  $type_id
     */
    public function setTypeId(int $type_id)
    {
        $this->type_id = $type_id;
    }

    /**
     * Get the value of brand_name
     *
     * @return  string
     */
    public function getBrand_name()
    {
        return $this->brand_name;
    }

    /**
     * Set the value of brand_name
     *
     * @param  string  $brand_name
     *
     * @return  self
     */
    public function setBrand_name(string $brand_name)
    {
        $this->brand_name = $brand_name;

        return $this;
    }

    /**
     * Get the value of category_name
     *
     * @return  string
     */
    public function getCategory_name()
    {
        return $this->category_name;
    }

    /**
     * Set the value of category_name
     *
     * @param  string  $category_name
     *
     * @return  self
     */
    public function setCategory_name(string $category_name)
    {
        $this->category_name = $category_name;

        return $this;
    }

    /**
     * Get the value of type_name
     *
     * @return  string
     */
    public function getType_name()
    {
        return $this->type_name;
    }

    /**
     * Set the value of type_name
     *
     * @param  string  $type_name
     *
     * @return  self
     */
    public function setType_name(string $type_name)
    {
        $this->type_name = $type_name;

        return $this;
    }
}
