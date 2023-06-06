<?php

class DataBase {

    private static $connection = null;
    private static $dbHost = 'localhost';
    private static $dbName = 'ateliera_electronik_service';
    private static $dbUser = 'root';
    private static $dbPass = '';

    public static function connect() {
        try {
            self::$connection = new PDO('mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName, self::$dbUser, self::$dbPass,array('charset'=>'utf8'));
            //permet de voir les erreurs
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->query("SET CHARACTER SET utf8");
        } catch (Exception $ex) {
            die('Erreur : '.$e->getMessage());
           // die('Erreur intranet,site en maintenance');
        }
        return self::$connection;
    }

    public static function disconnect() {
        self::$connection = null;
    }

    public static function getConnection(){
        return self::$connection;
    }
}

DataBase::connect();
