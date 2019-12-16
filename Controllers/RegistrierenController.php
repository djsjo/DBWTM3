<?php

/*
 *	BladeOne Viewengine aufsetzen
 */


if (!isset($_SESSION)) session_start();
#77require __DIR__ . '/vendor/autoload.php';
require_once "vendor\autoload.php";
require_once "Models/RegistrierenModel.php";


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

    public function start()
    {
        echo "hello world";
        echo $this->blade->run("pages.registrieren", array());
    }

    public function checkFirstRegister($anfragen="")
    {
        echo 'wird gecheckt';
        unset($_SESSION['checkfirstRegister']);
        $_SESSION['fehlernachrichtenBetroffeneFelder'] = array();
        $_SESSION['fehlernachrichten'] = array();

        //unset($_REQUEST['checkfirstRegister']);
        //email exists?
        if (isset($_SESSION['email'])and RegistrierenModel::mailExits($_SESSION['email'])) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'email');
            array_push($_SESSION['fehlernachrichten'], 'Diese E-Mailadresse existiert bereits!');
        }
        if (isset($_SESSION['matrikelnr']) and (RegistrierenModel::matrNrExits($_SESSION['matrikelnr']))) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'matrikelnr');
            array_push($_SESSION['fehlernachrichten'], 'Diese Matrikelnummer existiert bereits!');
        }
        if (isset($_SESSION['matrikelnr'])and ($_SESSION['matrikelnr'] > 999999999 or $_SESSION['matrikelnr'] < 10000000)) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'matrikelnr');
            $nachricht = 'Ihre Matrikelnummer erfüllt nicht die Kriterien ';
            if ($_SESSION['matrikelnr'] > 999999999) {
                $nachricht = $nachricht . '(zu lang).';
            }
            if ($_SESSION['matrikelnr'] < 10000000) {
                $nachricht = $nachricht . '(zu kurz).';
            }


            array_push($_SESSION['fehlernachrichten'], $nachricht);
        }


        if(isset($_SESSION['passwort'])and isset($_SESSION['passwortwh'])and  $_SESSION['passwort']!=$_SESSION['passwortwh'])
        {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'passwort');
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'passwortwh');
            array_push($_SESSION['fehlernachrichten'], 'Die Passwörter stimmen nicht überein!');
        }

        if(!isset( $_SESSION['fehlernachrichtenBetroffeneFelder']))
        {
            $_SESSION['firstRegisterSuccesful']=true;
        }
        echo '<meta content="10; url=./Registrieren.php" http-equiv="refresh">';

    }
    public function checkSecondRegister()
    {
        echo 'wird gecheckt';
        unset($_SESSION['checkfirstRegister']);
        $_SESSION['fehlernachrichtenBetroffeneFelder'] = array();
        $_SESSION['fehlernachrichten'] = array();

        //unset($_REQUEST['checkfirstRegister']);
        //email exists?
        if (RegistrierenModel::mailExits($_SESSION['email'])) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'email');
            array_push($_SESSION['fehlernachrichten'], 'Diese E-Mailadresse existiert bereits!');
        }
        if (RegistrierenModel::matrNrExits($_SESSION['matrikelnr'])) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'matrikelnr');
            array_push($_SESSION['fehlernachrichten'], 'Diese Matrikelnummer existiert bereits!');
        }
        if ($_SESSION['matrikelnr'] > 999999999 or $_SESSION['matrikelnr'] < 10000000) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'matrikelnr');
            $nachricht = 'Ihre Matrikelnummer erfüllt nicht die Kriterien ';
            if ($_SESSION['matrikelnr'] > 999999999) {
                $nachricht = $nachricht . '(zu lang).';
            }
            if ($_SESSION['matrikelnr'] < 10000000) {
                $nachricht = $nachricht . '(zu kurz).';
            }


            array_push($_SESSION['fehlernachrichten'], $nachricht);
        }
        if(isset($anfragen)and $anfragen['passwort']!=$anfragen['passwortwh'])
        {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'passwort');
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'passwortwh');
            array_push($_SESSION['fehlernachrichten'], 'Die Passwörter stimmen nicht überein!');
        }


        echo '<meta content="10; url=./Registrieren.php" http-equiv="refresh">';

    }
}