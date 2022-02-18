<?php

/**
 * Class Database instanciation de base de données
 */
class Database 
{
    protected static $instance = null;
    

    /**
     * Function getPdo
     *
     * @return PDO
     */
    public static function getPdo()
    {
        if(self::$instance == null){

        try {
        self::$instance = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        } catch (PDOException $e) {
            die('Erreur : ' .$e->getMessage());
        }
        // Mac
        // self::$instance = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', 'root', [
        //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        // ]);
        }
        
        return self::$instance;
    }
}