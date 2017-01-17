<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 17/01/2017
 * Time: 15:06
 */


function __autoload($class_name) {
    include 'Class/'.$class_name . '.php';
}