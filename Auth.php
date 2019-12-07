<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
?>
<?php
if (empty($_POST['password']) or empty($_POST['user'])) {
    echo 'eine der beiden variablen ist leer';

} //beide wurden mitgeliefert
else {
    echo 'beide variablen wurden geliefert </br> ';
    echo $_POST['password'] . ' user ' . $_POST['user'];
    $_SESSION['password'] = $_POST['password'];



    //check if pw ist korrekt
    $query = 'SELECT Nutzername, `Hash1`,Vorname FROM Benutzer where Nutzername=\''.$_POST['user'].'\';'; // Ihre SQL Query aus HeidiSQL
    $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

    if (mysqli_connect_errno()) {
        printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
        exit();
    }
    //$nutzernamenarray = array();
    if ($result = mysqli_query($link, $query)) {
        //var_dump( $result->num_rows);
        //echo $result->num_rows;
        while ($row = mysqli_fetch_assoc($result)) {
        //hier kommen wir nur rein wenn user existiert
        echo 'user existiert';
        if(password_verify($_POST['password'],$row['Hash1']))
        {
            echo 'passwort ist korrekt';
            $_SESSION['user']=$row['Vorname'];
            $_SESSION['role']='hierkommtrollehin';

        }

        }
    }

    mysqli_close($link); // daran denken, die Verbindung wieder zu schließen wenn sie nicht mehr benötigt ist.


}

?>






