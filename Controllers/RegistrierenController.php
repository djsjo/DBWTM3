<?php

/*
 *	BladeOne Viewengine aufsetzen
 */


if (!isset($_SESSION)) session_start();
#77require __DIR__ . '/vendor/autoload.php';
require_once "vendor\autoload.php";
require_once "Models/ZutatenModel.php";




use eftec\bladeone\BladeOne;


class RegistrierenController
{
    private $blade;

    public function __construct()
    {
        $views = __DIR__ . '/../views';
        $cache = __DIR__ . '/../cache';
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }
public  function start(){
    echo "hello world";
    echo $this->blade->run("pages.registrieren", array());
}
}