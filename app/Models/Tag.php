<?php

namespace App\Models;

use App\Database;
use PDO;
use Symfony\Component\VarDumper\Cloner\Data;

class Tag extends CoreModel
{
    private $name;

    private $tag_id;

    private $product_id;


    public static function findProductTags($productId)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT tag.* 
        FROM tag 
        JOIN product_has_tag 
        on product_has_tag.tag_id = tag.id
        WHERE product_has_tag.product_id = :productId";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([":productId" => $productId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }


    public function insert($productId, $tag_id)
    {
    }

    public function insertNewProductTag()
    {
    }

    public function update()
    {
    }
    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of tag_id
     */
    public function getTag_id()
    {
        return $this->tag_id;
    }

    /**
     * Set the value of tag_id
     *
     * @return  self
     */
    public function setTag_id($tag_id)
    {
        $this->tag_id = $tag_id;

        return $this;
    }
}
