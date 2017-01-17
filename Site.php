<?php

/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 16/01/2017
 * Time: 15:41
 */
class Site
{

    private $nameSite;
    private $passwordUser;
    private $nameUser;
    private $locale;
    private $userDB;
    private $pwdDB;
    private $nameDB;
    private $mail;

    /**
     * site constructor.
     * @param $nameSite
     */
    public function __construct()
    {}

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getNameSite()
    {
        return $this->nameSite;
    }

    /**
     * @param mixed $nameSite
     */
    public function setNameSite($nameSite)
    {
        $this->nameSite = $nameSite;
    }

    /**
     * @return mixed
     */
    public function getPasswordUser()
    {
        return $this->passwordUser;
    }

    /**
     * @param mixed $passwordUser
     */
    public function setPasswordUser($passwordUser)
    {
        $this->passwordUser = $passwordUser;
    }

    /**
     * @return mixed
     */
    public function getNameUser()
    {

        return $this->nameUser;
    }

    /**
     * @param mixed $nameUser
     */
    public function setNameUser($nameUser)
    {
        $this->nameUser = $nameUser;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getUserDB()
    {
        return $this->userDB;
    }

    /**
     * @param mixed $userDB
     */
    public function setUserDB($userDB)
    {
        if($userDB != "root")
        {
            $this->userDB = $userDB;
        }
    }

    /**
     * @return mixed
     */
    public function getPwdDB()
    {
        return $this->pwdDB;
    }

    /**
     * @param mixed $pwdDB
     */
    public function setPwdDB($pwdDB)
    {
        $this->pwdDB = $pwdDB;
    }

    /**
     * @return mixed
     */
    public function getNameDB()
    {
        return $this->nameDB;
    }

    /**
     * @param mixed $nameDB
     */
    public function setNameDB($nameDB)
    {
        $this->nameDB = $nameDB;
    }


    public function getPath()
    {
        return "/var/www/html/".$this->getNameSite();
    }


    public function importWP_cli()
    {
        shell_exec("curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar");
        shell_exec("chmod +x wp-cli.phar");
        shell_exec("sudo mv wp-cli.phar /usr/local/bin/wp");
    }

    public function createDatabaseAndUser()
    {
        var_dump("start : createDatabaseAndUser ->create DB");
        Database::createDB($this->getNameDB());
        var_dump("start : createDatabaseAndUser ->create USER");
        Database::createUser($this->getUserDB(),$this->getPasswordUser(),$this->getNameDB());
    }
}