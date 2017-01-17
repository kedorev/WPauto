<?php

/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 17/01/2017
 * Time: 14:50
 */
class Plugin
{
    private $name;
    private $sludge;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSludge()
    {
        return $this->sludge;
    }

    /**
     * @param mixed $sludge
     */
    public function setSludge($sludge)
    {
        $this->sludge = $sludge;
    }


    public function desactivate()
    {
        return shell_exec("wp plugin deactivate".$this->getSludge());
    }


    public function deletePlugin()
    {
        return shell_exec("wp plugin uninstall --deactivate ".$this->getSludge());
    }

}