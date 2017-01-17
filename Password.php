<?php

/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 17/01/2017
 * Time: 10:40
 */
class Password
{
    const nbCarMin = 4;
    const nbCarMax = 16;
    const haveUpperLowerCase = true;

    private $password;

    public function __construct($password)
    {
        $this->setPassword($password);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        if(Password::passordValide($password)) {
            $this->password = $password;
        }
        else
        {
            throw new Exception("Le mot de passe ne respecte pas les spécifications");
        }
    }


    private static function passordValide($pwd)
    {
        if(strlen($pwd) > Password::nbCarMin and strlen($pwd) < Password::nbCarMax)
        {
            if(Password::haveUpperLowerCase)
            {
                if(preg_match('/[A-Z]/', $pwd)){
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
}