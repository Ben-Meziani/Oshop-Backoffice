<?php

namespace App\Utils;

use PDO;

// Design Pattern : Singleton
class Database {
    /**
     * 
     * @var PDO
     */
    private $dbh;
    /**
     * 
     * @var Database
     */
    private static $_instance;

    /**
     * Constructeur
     * 
     */
    private function __construct() {
    
        $configData = parse_ini_file(__DIR__.'/../config.ini');
        
        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};port=3306;charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
            );
        }
        catch(\Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }

    /**
     *
     * @return PDO
     */
    public static function getPDO() {
        if (empty(self::$_instance)) {
            self::$_instance = new Database();
        }

        return self::$_instance->dbh;
    }
}