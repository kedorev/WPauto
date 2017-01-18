<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 16/01/2017
 * Time: 14:09
 */

include "include.php";

echo "<pre>";
try
{

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

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

    //var_dump($_POST['deleteDefaultPlugin']);


    $site = new Site();
    $site->setUserDB(htmlentities($_POST['bdd_user']));
    $site->setNameUser(htmlentities($_POST['bdd_user']));
    $site->setPasswordUser(htmlentities($_POST['bdd_pwd']));
    $site->setLocale(htmlentities($_POST['locale']));
    $site->setNameDB(htmlentities($_POST['bdd_name']));
    $site->setNameSite(htmlentities($_POST['nom']));
    $site->setMail(htmlentities($_POST['email']));
    $site->setPwdDB(htmlentities($_POST['bdd_pwd']));

    $site->addDefaultPlugin();

    if(file_exists("/usr/local/bin/wp") == null and file_exists("wp-cli.phar") == null)
    {
        $site->importWP_cli();
    }

    //var_dump($site->getPath());
    if(!file_exists($site->getPath()))
    {
        mkdir($site->getPath());
    }
    else
    {
        throw new Exception("Votre site web existe deja");
    }

    chdir($site->getPath());
    shell_exec("wp core download --locale=".$site->getLocale());

    $site->createDatabaseAndUser();

    $debug1 = shell_exec("wp core config --dbname=".$site->getNameDB()." --dbuser=".$site->getNameUser()." --dbpass=".$site->getPasswordUser()->toString()." --dbprefix=\"WP_\" --locale=".$site->getLocale() );
    //var_dump($string);
    $debug3 = shell_exec("wp core install --path=\"".$site->getPath()."\" --url=192.168.33.10 --title=\"".$site->getNameSite()."\" --admin_user=".$site->getNameUser()." --admin_password=".$site->getPwdDB()->toString()." --admin_email=\"".$site->getMail()."\" --skip-email");




    if(isset($_POST['deleteDefaultPlugin']))
    {
        $site->getPluginByName("hello dolly")->deletePlugin();
        $site->getPluginByName("akismet")->deletePlugin();
    }

    //Plugin::install();

    Echo "site créé avec succès";
}
catch (Exception $e)
{
    echo $e->getMessage();
}


