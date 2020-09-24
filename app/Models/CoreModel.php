<?php

namespace App\Models;

use PDO;
use App\Database;


abstract class CoreModel
{

    abstract public function update();

    //abstract public function insert();

    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    protected $table;

    protected $class;

    public static function find($id, $table, $class)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":id"    => $id]);

        return $stmt->fetchObject("App\Models\\" . $class);
    }

    public static function findAll($table, $class)
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM $table";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "App\Models\\" . $class);
    }

    public static function delete($id, $table)
    {
        $pdo = Database::getPDO();

        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([":id" => $id]);
    }

    // GETTERS AND SETTERS

    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public static function getTable()
    {
        return self::getTable();
    }

    /**
     * Set the value of table
     *
     * @return  self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * Set the value of PDO
     *
     * @return  self
     */
    public function setPDO($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }
}
