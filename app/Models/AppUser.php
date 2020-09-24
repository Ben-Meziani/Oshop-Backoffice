<?php

namespace App\Models;

use App\Database;
use PDO;

class AppUser extends CoreModel
{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;

    public static function findAllBackOfficeHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT firstname, lastname
            FROM app_user
            ORDER BY updated_at DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $users = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\AppUser');

        return $users;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `app_user` (password, email, firstname, lastname, role, status)
            VALUES (:password, :email, :firstname, :lastname, :role, :status)
        ";
        $stmt = $pdo->prepare($sql);

        $insertedRows = $stmt->execute([
            ":password"  => $this->password,
            ":email"     => $this->email,
            ":firstname" => $this->firstname,
            ":lastname"  => $this->lastname,
            ":role"      => $this->role,
            ":status"    => $this->status,
        ]);
        if ($insertedRows) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `app_user`
            SET
                firstname = :firstname
                lastname  = :lastname,
                role      = :role,
                status    = :status,
                updated_at = NOW()
            WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":firstname" => $this->firstname,
            ":lastname"  => $this->lastname,
            ":role"      => $this->role,
            ":status"    => $this->status,
            ":id"        => $this->id,
        ]);
    }

    public static function findByEmail($userEmail)
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `app_user` WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([":email" => $userEmail]);

        return $stmt->fetchObject(self::class);
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
