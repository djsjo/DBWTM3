<?php
//quasi ein viewmodel
$dotenv = Dotenv\Dotenv::create(__DIR__.'/..', '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);


class RegistrierenModel
{





    public static function mailExits($mailadress){
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        $query = 'SELECT `E-Mail` FROM Benutzer WHERE `E-Mail`="'.$mailadress.'";'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        mysqli_close($link);
        if($result->num_rows>0)
        {
            return true;
        }
        else return false;


    }
    public static function matrNrExits($matrikelnr){
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        $query = 'SELECT Matrikelnummer FROM Studenten WHERE Matrikelnummer="'.$matrikelnr.'";'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        mysqli_close($link);
        if($result->num_rows>0)
        {
            return true;
        }
        else return false;


    }
    public static function matrNrInRange($matrikelnr){
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        $query = 'SELECT Matrikelnummer FROM Studenten WHERE Matrikelnummer="'.$matrikelnr.'";'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
        mysqli_close($link);
        if($result->num_rows>0)
        {
            return true;
        }
        else return false;


    }
}