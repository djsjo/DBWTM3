<?php
if (!isset($_SESSION)) session_start();
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
?>
<?php
//user variable wird gesetzt
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = $_POST['user'];
}

//if user klickt "abmelden"
if (isset($_POST['logout']) and $_POST['logout'] == true) {
    echo 'nutzer will sich abmelden';
    session_destroy();
    echo '<meta content="0; url=./Detail.php?id=1" http-equiv="refresh">';
}

//if one of the input fields isn't filled it will be formatted accrodingly
if (empty($_POST['password']) or empty($_POST['user'])) {
    echo 'eine der beiden variablen ist leer';

    if (empty($_POST['password'])) {
        $_SESSION['pwfehlt'] = true;
    }
    if (empty($_POST['user'])) {
        $_SESSION['userfehlt'] = true;
    }

} //beide wurden mitgeliefert
else {
    echo 'beide variablen wurden geliefert </br> ';
    echo $_POST['password'] . ' user ' . $_POST['user'];
    $_SESSION['password'] = $_POST['password'];


    //check if pw ist korrekt
    $query = 'SELECT Nutzername, `Hash1`,Vorname FROM Benutzer where Nutzername=\'' . $_POST['user'] . '\';'; // Ihre SQL Query aus HeidiSQL
    $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

    if (mysqli_connect_errno()) {
        printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
        exit();
    }
    //$nutzernamenarray = array();
    if ($result = mysqli_query($link, $query)) {
        //var_dump( $result->num_rows);
        if ($result->num_rows) {

            $_SESSION['userfehlt'] = true;

        }
        while ($row = mysqli_fetch_assoc($result)) {
            //hier kommen wir nur rein wenn user existiert
            echo 'user existiert';
            if (password_verify($_POST['password'], $row['Hash1'])) {
                echo 'passwort ist korrekt';
                $_SESSION['user'] = $row['Vorname'];
                $_SESSION['role'] = 'hierkommtrollehin';
                $_SESSION['auth'] = true;
                echo '<meta content="3; url=./Detail.php?id=1" http-equiv="refresh">';

            } else {
                if (empty($_POST['password'])) {
                    $_SESSION['userfehlt'] = true;
                }
            }

        }

    }


    mysqli_close($link); // daran denken, die Verbindung wieder zu schließen wenn sie nicht mehr benötigt ist.


}
echo '<meta content="3; url=./Detail.php?id=1" http-equiv="refresh">';

?>






