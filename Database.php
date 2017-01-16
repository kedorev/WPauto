<?php

/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 16/01/2017
 * Time: 16:38
 */
class Database
{
    const PasswordDB = "0000";
    const UserDB = "admin";

    private $databaseStance;

    private function __construct()
    {

    }

    public static function createUser($user, $password, $database)
    {
        $pdo = new PDO('localhost', Database::UserDB, Database::PasswordDB);
        $pdo->exec("CREATE USER '".$user."'@'localhost' IDENTIFIED BY '".$password.";");
        $pdo->exec("GRANT ALL ON ".$database.".* TO '".$user."'@'localhost'");
        unset($pdo);
    }

    public static function createDB($database)
    {
        $pdo = new PDO('localhost', Database::UserDB, Database::PasswordDB);
        $pdo->exec("CREATE DATABASE ".$database);
        unset($pdo);
    }

}