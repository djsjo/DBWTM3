<?php
session_start();
 ?>
<?php
if (empty($_POST['password']) or empty($_POST['user'])) {
    echo 'eine der beiden variablen ist leer';

} //beide wurden mitgeliefert
else {
    echo 'beide variablen wurden geliefert </br> ';
    echo $_POST['password'] . ' user ' . $_POST['user'];
}

?>






