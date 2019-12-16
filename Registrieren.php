<?php

require_once "Controllers/RegistrierenController.php";
$controller=new RegistrierenController();
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

















$controller->start();

?>