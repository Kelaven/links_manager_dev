<?php

require_once __DIR__ . '/../config/init.php';




class Database
{
    // méthode qui renvoie PDO, on fait une méthode statique pour ne pas avoir à l'appeler avec new Database
    public static function connect(){

        $pdo = new PDO(DSN, USER, PASSWORD);

        return $pdo;
    }

}
