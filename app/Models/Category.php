<?php

namespace App\Models;

use App\Database;
use PDO;
use Symfony\Component\VarDumper\Cloner\Data;

class Category extends CoreModel
{

    // PROPRIETES //

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

    // METHODES //

    /**
     *
     * @return Category[]
     */
    public static function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT *
                FROM category
                WHERE home_order > 0
                ORDER BY home_order ASC";
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $categories;
    }

    /**
     *
     * @return Category[]
     */
    public static function findAllBackOfficeHomepage()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT id, name
                FROM category
                ORDER BY updated_at DESC
                LIMIT 3";
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');

        return $categories;
    }

    public function insert()
    {

        $pdo = Database::getPDO();

        $sql = "INSERT INTO `category` (name, subtitle, picture)
                VALUES (:name, :subtitle, :picture)"; // entourer de "" si string
        $stmt = $pdo->prepare($sql);

        $insertedRows = $stmt->execute([
            ":name"     => $this->name,
            ":subtitle" => $this->subtitle,
            ":picture"  => $this->picture,
        ]);

        if ($insertedRows > 0) {
            // récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
        }

        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "UPDATE `category`
                SET
                name = :name,
                subtitle = :subtitle,
                picture = :picture,
                home_order = :home_order,
                updated_at = NOW()
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":name"         => $this->name,
            ":subtitle"     => $this->subtitle,
            ":picture"      => $this->picture,
            ":home_order"   => $this->home_order,
            ":id"           => $this->id,
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
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     */
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }
}
