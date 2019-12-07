<?php require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);


$passwort = "passwort";
//echo password_hash($passwort, PASSWORD_BCRYPT); //BCRYPT als default Hash-Algorithmus

$query = 'SELECT Nutzername FROM Benutzer;'; // Ihre SQL Query aus HeidiSQL
$link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

if (mysqli_connect_errno()) {
    printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
    exit();
}
$nutzernamenarray = array();
if ($result = mysqli_query($link, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
// $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
        //alte benuter mit hash passwort ausstatten
        //echo $row['Nutzername'];
        array_push($nutzernamenarray, $row);

    }
}



foreach ($nutzernamenarray as $nutzerarr) {
    $passwort = "passwort";
    $hashpassword = password_hash($passwort, PASSWORD_BCRYPT); //BCRYPT als default Hash-Algorithmus;
    $query = 'UPDATE Benutzer SET `Hash1`="' . $hashpassword . '" WHERE Nutzername=\'' . $nutzerarr['Nutzername'] . '\';';
    mysqli_query($link, $query);

    var_dump($nutzerarr);

    $ergebnis=password_verify("passwort",$hashpassword);
    var_dump($ergebnis);
}


mysqli_close($link); // daran denken, die Verbindung wieder zu schließen wenn sie nicht mehr benötigt ist.

?>