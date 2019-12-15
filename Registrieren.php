<?php

require_once "Controllers/RegistrierenController.php";
$controller=new RegistrierenController();
//daten in sessions speichern
if (isset($_REQUEST['checkfirstRegister'])){
    $_SESSION['checkfirstRegister']=  $_REQUEST['checkfirstRegister'];
}
if (isset($_REQUEST['username'])){
    $_SESSION['username']=  $_REQUEST['username'];
}
if (isset($_REQUEST['gast'])){
    $_SESSION['gast']=  $_REQUEST['gast'];
}
if (isset($_REQUEST['arbeitet'])){
    $_SESSION['arbeitet']=  $_REQUEST['arbeitet'];
}
if (isset($_REQUEST['studiert'])){
    $_SESSION['studiert']=  $_REQUEST['studiert'];
}
//variablen aus registrierung further persisten macehn

if (isset($_REQUEST['vorname'])){
    $_SESSION['vorname']=  $_REQUEST['vorname'];
}if (isset($_REQUEST['nachname'])){
    $_SESSION['nachname']=  $_REQUEST['nachname'];
}if (isset($_REQUEST['email'])){
    $_SESSION['email']=  $_REQUEST['email'];
}if (isset($_REQUEST['gebDat'])){
    $_SESSION['gebDat']=  $_REQUEST['gebDat'];
}if (isset($_REQUEST['fachbereich'])){
    $_SESSION['fachbereich']=  $_REQUEST['fachbereich'];
}if (isset($_REQUEST['matrikelnr'])){
    $_SESSION['matrikelnr']=  $_REQUEST['matrikelnr'];
}if (isset($_REQUEST['studiengang'])){
    $_SESSION['studiengang']=  $_REQUEST['studiengang'];
}













if(isset($_SESSION['firstRegisterSuccesful'])and ($_SESSION['firstRegisterSuccesful']==true))
{unset(isset($_SESSION['checkfirstRegister']));
    $controller->start();


}
if(isset($_SESSION['checkfirstRegister'])and $_SESSION['checkfirstRegister']==true)
{
    $_SESSION['firstRegisterSuccesful']=true;
    $controller->checkFirstRegister();
}
else
$controller->start();

?>