<?php

/*
 *	BladeOne Viewengine aufsetzen
 */


if (!isset($_SESSION)) session_start();

require_once "vendor/autoload.php";
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
        echo $this->blade->run("pages.registrieren", array());
//        if (!isset($_SESSION['checkfirstRegister']) and !isset($_SESSION['checkfirstRegister'])) {
//            echo $this->blade->run("pages.registrieren", array());
//        }


        if (isset($_SESSION['checkfirstRegister']) and $_SESSION['checkfirstRegister'] == true) {
            //$_SESSION['firstRegisterSuccesful']=true;
            $this->checkFirstRegister();
           // echo $this->blade->run("pages.registrieren", array());
            echo '<meta content="4; url=./Registrieren.php" http-equiv="refresh">';
        } elseif (isset($_SESSION['firstRegisterSuccesful']) and isset($_SESSION['checksecondRegister'])
            and ($_SESSION['firstRegisterSuccesful'] == true) and $_SESSION['checksecondRegister'] == true) {
            if (isset($_SESSION['checkfirstRegister'])) {
                unset($_SESSION['checkfirstRegister']);
            }
            $this->checkSecondRegister();
            echo '<meta content="4; url=./Registrieren.php" http-equiv="refresh">';
            //echo $this->blade->run("pages.registrieren", array());
            //

        }

        // echo $this->blade->run("pages.registrieren", array());

    }


    public
    function checkFirstRegister()
    {
        // echo 'wird gecheckt';
        $_SESSION['checkfirstRegister'] = false;
        $_SESSION['firstRegisterSuccesful'] = false;
        $_SESSION['fehlernachrichtenBetroffeneFelder'] = array();
        $_SESSION['fehlernachrichten'] = array();

        //unset($_REQUEST['checkfirstRegister']);
        //email exists?
        if (isset($_SESSION['email']) and RegistrierenModel::mailExits($_SESSION['email'])) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'email');
            array_push($_SESSION['fehlernachrichten'], 'Diese E-Mailadresse existiert bereits!');
        }
        if (isset($_SESSION['matrikelnr']) and (RegistrierenModel::matrNrExits($_SESSION['matrikelnr']))) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'matrikelnr');
            array_push($_SESSION['fehlernachrichten'], 'Diese Matrikelnummer existiert bereits!');
        }
        if (isset($_SESSION['matrikelnr']) and ($_SESSION['matrikelnr'] > 999999999 or $_SESSION['matrikelnr'] < 10000000)) {
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


        if (isset($_SESSION['passwort']) and isset($_SESSION['passwortwh']) and $_SESSION['passwort'] != $_SESSION['passwortwh']) {
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'passwort');
            array_push($_SESSION['fehlernachrichtenBetroffeneFelder'], 'passwortwh');
            array_push($_SESSION['fehlernachrichten'], 'Die Passwörter stimmen nicht überein!');
        }

        if (empty($_SESSION['fehlernachrichtenBetroffeneFelder'])) {
            $_SESSION['firstRegisterSuccesful'] = true;
        }


        //echo $this->blade->run("pages.registrieren", array());
    }

    public
    function checkSecondRegister()
    {
        echo 'wird gecheckt zweites register';
        $_SESSION['checksecondRegister'] = false;
        unset($_SESSION['fehlernachrichten']);

        unset($_SESSION['fehlernachrichtenBetroffeneFelder']);
        $_SESSION['fehlernachrichtenBetroffeneFelder'] = array();
        $_SESSION['fehlernachrichten'] = array();
        $_SESSION['secondRegisterSuccesful'] = false;

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
            if (empty($_SESSION['fehlernachrichtenBetroffeneFelder'])) {
                $_SESSION['secondRegisterSuccesful'] = true;
            }
        }

        //$this->start();
        // echo '<meta content="10; url=./Registrieren.php" http-equiv="refresh">';


    }
}