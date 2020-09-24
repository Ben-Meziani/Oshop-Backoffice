<?php

namespace App\Models;

use App\Database;
use PDO;


class Brand extends CoreModel
{
  
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $footer_order;

    /*
     *
     * @return Brand[]
     */
    public function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM brand
            WHERE footer_order > 0
            ORDER BY footer_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $brands = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');

        return $brands;
    }

    /**
     *
     * @return bool
     */
    public function insert()
    {

        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `brand` (name)
            VALUES (:name)";
        $stmt = $pdo->prepare($sql);

        $insertedRows = $stmt->execute([
            ":name" => $this->name
        ]);
        if ($insertedRows > 0) {

            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }

    /**
     *
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `brand`
            SET
                name = :name,
                footer_order = :footer_order,
                updated_at = NOW()
            WHERE id = :id
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":name"         => $this->name,
            ":footer_order" => $this->footer_order,
            ":id"           => $this->getId(),
        ]);
    }

    // GETTERS AND SETTERS

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

    /**
     * Get the value of footer_order
     *
     * @return  int
     */
    public function getFooterOrder()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     * @param  int  $footer_order
     */
    public function setFooterOrder(int $footer_order)
    {
        $this->footer_order = $footer_order;
    }
}
