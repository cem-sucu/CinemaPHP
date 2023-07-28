<?php

namespace Model;

abstract class Connect {

    const HOST = "localhost";
    const DB = "cinema_cem";
    const USER = "root";
    const PASS = "";

    public static function seConnecter() {
        try{
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
            }catch(\PDOException $ex) {
                echo "Erreur de connexion a la base :" .$ex->getMessage();
                return null;
        }
    }
}




?>