<?php
//quasi ein viewmodel
$dotenv = Dotenv\Dotenv::create(__DIR__.'/..', '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);


class ZutatenModel
{


    public static function newZutat()
    {

    }

    public static function deleteZutat()
    {

    }

    public static function zutaten($id=0)
    {
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo 'lief wohl gut';
        }
        $query = 'SELECT ID,Name,Bio,Vegan, Vegetarisch,Glutenfrei FROM Zutaten order by Bio desc,Name asc;'; // Ihre SQL Query aus HeidiSQL


        $result = mysqli_query($link, $query);
//$result2 = mysqli_query($link, $query);
//gucken ob id gesetzt ist
//$row = mysqli_fetch_assoc($result);

//$title = "Views Demo";


        $zutatenrows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            if (isset($row)) {

                $zutatenrows[] = $row;
            }

        }


        mysqli_close($link);
        return $zutatenrows;
    }
}