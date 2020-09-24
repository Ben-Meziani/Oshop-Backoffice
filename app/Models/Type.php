<?php

namespace App\Models;

use App\Database;
use PDO;

class Type extends CoreModel
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $footer_order;

    /**
     *
     * @return Type[]
     */
    public static function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT *
                FROM type
                WHERE footer_order > 0
                ORDER BY footer_order ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO `type` (name)
                VALUES (:name)";  // entourer de "" si string
        $stmt = $pdo->prepare($sql);

        $insertedRows = $stmt->execute([":name" => $this->name]);

        if ($insertedRows > 0) {

            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "UPDATE `type`
                SET
                name = :name,
                footer_order = :footer_order,
                updated_at = NOW()
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $updatedRows = $stmt->execute([
            ":name"         => $this->name,
            ":footer_order" => $this->footer_order,
            ":id"           => $this->getId()
        ]);

        return ($updatedRows > 0);
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
