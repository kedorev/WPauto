<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 16/01/2017
 * Time: 14:09
 */

include "Site.php";
include "Database.php";
include "Password.php";


echo "<pre>";
try
{
    if(!isset($_POST['nom']) or $_POST['nom'] == null)
    {
        throw new Exception("Nom du site non valide");
    }
    if(!isset($_POST['bdd_user']) or $_POST['bdd_user'] == null or $_POST['bdd_user'] == "root")
    {
        throw new Exception("Nom utilisateur invalide");
    }
    if(!isset($_POST['bdd_pwd']) or $_POST['bdd_pwd'] == null)
    {
        throw new Exception("Mot de passe invalide");
    }
    if(!isset($_POST['bdd_name']) or $_POST['bdd_name'] == null)
    {
        throw new Exception("Nom de la base de donnée invalide");
    }
    if(!isset($_POST['email']) or $_POST['email'] == null)
    {
        throw new Exception("Email invalide ");
    }


    $site = new Site();
    $site->setUserDB(htmlentities($_POST['bdd_user']));
    $site->setNameUser(htmlentities($_POST['bdd_user']));
    $site->setPasswordUser(htmlentities($_POST['bdd_pwd']));
    $site->setLocale(htmlentities($_POST['locale']));
    $site->setNameDB(htmlentities($_POST['bdd_name']));
    $site->setNameSite(htmlentities($_POST['nom']));
    $site->setMail(htmlentities($_POST['email']));
    $site->setPwdDB(htmlentities($_POST['bdd_pwd']));



    if(file_exists("/usr/local/bin/wp") == null and file_exists("wp-cli.phar") == null)
    {
        $site->importWP_cli();
    }

    if(!file_exists($site->getPath()))
    {
        mkdir($site->getPath());
    }
    else
    {
        throw new Exception("Votre site web existe deja");
    }


    shell_exec("wp core download --path=\"".$site->getPath()."\" --locale=".$site->getLocale());

    $site->createDatabaseAndUser();

    $string = var_dump("wp core config --dbname=".$site->getNameDB()." --dbuser=".$site->getNameUser()." --dbpass=".$site->getPasswordUser()." --path=\"".$site->getPath()."\" --locale=".$site->getLocale());
    var_dump($string);
    shell_exec("wp core config --dbname=".$site->getNameDB()." --dbuser=".$site->getNameUser()." --dbpass=".$site->getPasswordUser()." --path=\"".$site->getPath()."\" --locale=".$site->getLocale());
    $debug3 = shell_exec("wp core install --url=192.168.33.10 --title=\"".$site->getNameSite()."\" --admin_user=".$site->getNameUser()." --admin_password=".$site->getPwdDB()." --admin_email=\"".$site->getMail()."\" --skip-email");



    var_dump($site);
    var_dump($debug3);
}
catch (Exception $e)
{
    echo $e->getMessage();
}


