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
    const UserDB = "root";

    private static $databaseStance = null;

    private function __construct()
    {

    }


    private function connectWithRoot()
    {
        $localhost = "mysql:mysql=test;host=localhost";
        Database::$databaseStance = new PDO($localhost, Database::UserDB, Database::PasswordDB);
        Database::$databaseStance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function createUser($user, $password, $database)
    {

        if(Database::$databaseStance == null)
        {
            Database::connectWithRoot();
        }
        $request = "CREATE USER '".$user."'@'localhost' IDENTIFIED BY '".$password."'";

        $request = "SELECT IF(EXISTS (SELECT user FROM user WHERE user=\"".$user."\"'), 'Yes','No') ";
        $statement = Database::$databaseStance->exec($request);
        if($statement == "yes")
        {
            throw new Exception("User name already exist.");
        }
        var_dump($request);
        $statement = Database::$databaseStance->exec($request);
        var_dump("debug : create user");
        if(!$statement == 0)
        {
            throw new Exception("Erreur lors de la creation de l'utilisateur : ".Database::$databaseStance->errorInfo());
        }
        Database::$databaseStance->exec("GRANT ALL ON ".$database.".* TO '".$user."'@'localhost'");
        var_dump("debug : grant request");

    }

    public static function createDB($database)
    {
        if(Database::$databaseStance == null)
        {
            Database::connectWithRoot();
        }

        $request = "SELECT IF(EXISTS (SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$database."'), 'Yes','No') ";
        $statement = Database::$databaseStance->exec($request);
        if($statement == "yes")
        {
            //var_dump()
            throw new Exception("Database name already exist.");
        }

        $request = "CREATE DATABASE ".$database;
        $statement = Database::$databaseStance->exec($request);
        /**
         * TODO : faire la vérification
         */

        var_dump(Database::$databaseStance->errorInfo());
        if($statement == 0)
        {
            var_dump(Database::$databaseStance->errorInfo());
            throw new Exception("Erreur lors de la creation de la base de données. Requete : ". $request .". Codde erreur : ".Database::$databaseStance->errorInfo());
        }
        //unset($pdo);
    }

}