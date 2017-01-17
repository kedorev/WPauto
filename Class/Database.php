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


    private function connectWithRoot($dbname = null)
    {

        $localhost = "mysql:mysql=test;host=localhost";
        if($dbname != null )
        {
            $localhost .= ";dbname=".$dbname;
        }
        Database::$databaseStance = new PDO($localhost, Database::UserDB, Database::PasswordDB);
        Database::$databaseStance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function createUser($user, Password $password, $database, $host = "localhost")
    {

        if(Database::$databaseStance == null)
        {
            Database::connectWithRoot("mysql");
        }

        Database::$databaseStance->exec("RESET QUERY CACHE");
        //var_dump(Database::$databaseStance);
        $request = "SELECT IF(EXISTS (SELECT user FROM user WHERE user=\"".$user."\"), 'Yes','No') ";
        //var_dump($request);
        $result = Database::$databaseStance->query($request);
        $exist = $result->fetch();
        //var_dump($result);
        if( $exist == "yes")
        {
            throw new Exception("User name already exist.");
        }


        $sRequest = "CREATE USER '".$user."'@'".$host."' IDENTIFIED BY '".$password->toString()."'";
        var_dump($sRequest);
        Database::$databaseStance->exec($sRequest);

        /*$request = Database::$databaseStance->prepare("CREATE USER ':user'@':host' IDENTIFIED BY ':password'");
        //var_dump($request);

        $request->bindParam(":user",$user);
        $request->bindParam(":password",$password->toString());
        $request->bindParam(":host",$host);
        //var_dump($request);
        $request->execute();*/


        //$statement = Database::$databaseStance->exec($request);
        //var_dump("debug : create user");
        /*if(!$statement == 0)
        {
            throw new Exception("Erreur lors de la creation de l'utilisateur : ".Database::$databaseStance->errorInfo());
        }*/
        Database::$databaseStance->exec("GRANT ALL ON ".$database.".* TO '".$user."'@'localhost'");
        //var_dump("debug : grant request");

    }

    public static function createDB($database)
    {
        //var_dump("createDB : init");
        if(Database::$databaseStance == null)
        {
            //("createDB : create connexion");
            Database::connectWithRoot();
        }

        //var_dump("createDB : reset cache");
        Database::$databaseStance->exec("RESET QUERY CACHE");
        $request = "SELECT IF(EXISTS (SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$database."'), 'Yes','No') ";
        //var_dump("createDB : execute request seak request");

        $result = Database::$databaseStance->query($request);

        $exist = $result->fetch();
        //var_dump($result);
        //var_dump($exist);

        if( $exist == "yes")
        {
            //var_dump("pouette");
            throw new Exception("Database name already exist.");
        }


        $request = "CREATE DATABASE ".$database;
        //var_dump($request);
        $statement = Database::$databaseStance->exec($request);
        //var_dump(Database::$databaseStance->errorInfo());
        //ar_dump(Database::$databaseStance);
        if($statement == 0)
        {
            //var_dump(Database::$databaseStance->errorInfo());
            throw new Exception("Erreur lors de la creation de la base de données. Requete : ". $request .". Codde erreur : ".Database::$databaseStance->errorInfo());
        }
        //unset($pdo);
        Database::$databaseStance = null;
    }

}