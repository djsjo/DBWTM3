<?php
//quasi ein viewmodel
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..', '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);


class RegistrierenModel
{


    public static function mailExits($mailadress)
    {
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        $query = 'SELECT `E-Mail` FROM Benutzer WHERE `E-Mail`="' . $mailadress . '";'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        mysqli_close($link);
        if ($result->num_rows > 0) {
            return true;
        } else return false;


    }

    public static function matrNrExits($matrikelnr)
    {
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        $query = 'SELECT Matrikelnummer FROM Studenten WHERE Matrikelnummer="' . $matrikelnr . '";'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        mysqli_close($link);
        if ($result->num_rows > 0) {
            return true;
        } else return false;


    }

    public static function matrNrInRange($matrikelnr)
    {
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }

        $query = 'SELECT Matrikelnummer FROM Studenten WHERE Matrikelnummer="' . $matrikelnr . '";'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        mysqli_close($link);
        if ($result->num_rows > 0) {
            return true;
        } else return false;


    }

    public static function createUser()
    {
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        mysqli_begin_transaction($link);
        $hashpassword = password_hash($_SESSION['passwort'], PASSWORD_BCRYPT); //BCRYPT als default Hash-Algorithmus;
        $query = 'INSERT INTO Benutzer (`E-Mail`,Nutzername,`Hash1`,`Hash2`,Vorname,Nachname,Geburtsdatum)
	VALUES ("' . $_SESSION['email'] . '","' . $_SESSION['username'] . '","' . $hashpassword . '","12" ,"' . $_SESSION['vorname'] . '","' . $_SESSION['nachname'] .
            '","' . $_SESSION['gebDat'] . '");'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        $finalUserNumber = mysqli_insert_id($link);

        //var_dump($result);

        if (!$result) {
            var_dump($link);
            echo "Bei Benutzer hinzufügen ist etwas schief gelaufen: " . mysqli_error($link);
            mysqli_rollback($link);
        } else {

            $_SESSION['lastUserNr'] = $finalUserNumber;
            mysqli_commit($link);
        }

        mysqli_close($link);
    }

    public static function createStudent()
    {
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        echo $_SESSION['LastUserNr'];
        mysqli_begin_transaction($link);
        if (isset($_SESSION['LastUserNr'])) {
            $userid = $_SESSION['LastUserNr'];
        } else $userid = 0;
        $hashpassword = password_hash($_SESSION['passwort'], PASSWORD_BCRYPT); //BCRYPT als default Hash-Algorithmus;
        $query = 'INSERT INTO Studenten (Nummer,Studiengang,Matrikelnr)
	VALUES ("' . $userid . '","ET","' . $_SESSION['matrikelnr'] . '");'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        mysqli_begin_transaction($link);
        $finalUserNumber = mysqli_insert_id($link);

        //var_dump($result);

        if (!$result) {
            var_dump($link);
            echo "Es ist ein Fehler aufgetreten: " . mysqli_error($link);
            mysqli_rollback($link);
        } else {
            mysqli_commit($link);
        }

        mysqli_close($link);
    }
}