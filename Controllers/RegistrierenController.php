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
        //daten in sessions speichern
        if (isset($_REQUEST['checkfirstRegister'])) {
            $_SESSION['checkfirstRegister'] = $_REQUEST['checkfirstRegister'];
        }
        if (isset($_REQUEST['checksecondRegister'])) {
            $_SESSION['checksecondRegister'] = $_REQUEST['checksecondRegister'];
        }
        if (isset($_REQUEST['username'])) {
            $_SESSION['username'] = $_REQUEST['username'];
        }
        if (isset($_REQUEST['gast'])) {
            $_SESSION['gast'] = $_REQUEST['gast'];
        }
        if (isset($_REQUEST['arbeitet'])) {
            $_SESSION['arbeitet'] = $_REQUEST['arbeitet'];
        }
        if (isset($_REQUEST['studiert'])) {
            $_SESSION['studiert'] = $_REQUEST['studiert'];
        }
        if (isset($_REQUEST['studiert'])) {
            $_SESSION['studiert'] = $_REQUEST['studiert'];
        }
        if (isset($_REQUEST['passwort']) and isset($_REQUEST['passwortwh'])) {
            $_SESSION['passwort'] = $_REQUEST['passwort'];
            $_SESSION['passwortwh'] = $_REQUEST['passwortwh'];
        }
//variablen aus registrierung further persisten macehn

        if (isset($_REQUEST['vorname'])) {
            $_SESSION['vorname'] = $_REQUEST['vorname'];
        }
        if (isset($_REQUEST['nachname'])) {
            $_SESSION['nachname'] = $_REQUEST['nachname'];
        }
        if (isset($_REQUEST['email'])) {
            $_SESSION['email'] = $_REQUEST['email'];
        }
        if (isset($_REQUEST['gebDat'])) {
            $_SESSION['gebDat'] = $_REQUEST['gebDat'];
        }
        if (isset($_REQUEST['fachbereich'])) {
            $_SESSION['fachbereich'] = $_REQUEST['fachbereich'];
        }
        if (isset($_REQUEST['matrikelnr'])) {
            $_SESSION['matrikelnr'] = $_REQUEST['matrikelnr'];
        }
        if (isset($_REQUEST['studiengang'])) {
            $_SESSION['studiengang'] = $_REQUEST['studiengang'];
        }

        if (isset($_SESSION['checkfirstRegister']) and $_SESSION['checkfirstRegister'] == true) {
            //$_SESSION['firstRegisterSuccesful']=true;
            $this->checkFirstRegister();
        }
        elseif (isset($_SESSION['firstRegisterSuccesful']) and isset($_SESSION['checksecondRegister'])
            and ($_SESSION['firstRegisterSuccesful'] == true) and $_SESSION['checksecondRegister'] == true) {
            if (isset($_SESSION['checkfirstRegister'])) {
                unset($_SESSION['checkfirstRegister']);
            }
            $this->checkSecondRegister();
        }


        echo $this->blade->run("pages.registrieren", array());
    }



public
function checkFirstRegister()
{
   // echo 'wird gecheckt';
    $_SESSION['checkfirstRegister'] = false;
    $_SESSION['firstRegisterSuccesful']=false;
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


    echo $this->blade->run("pages.registrieren", array());
}

public
function checkSecondRegister()
{
    echo 'wird gecheckt';
    $_SESSION['checksecondRegister'] = false;
    $_SESSION['fehlernachrichtenBetroffeneFelder'] = array();
    $_SESSION['fehlernachrichten'] = array();
    $_SESSION['secondRegisterSuccesful']=false;

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

    $this->start();
    //echo '<meta content="10; url=./Registrieren.php" http-equiv="refresh">';

}
}