<?php require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">


    <link href="fontawesome-free-5.11.2-web/css/all.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" rel="stylesheet">
    <!--stylesheet-->
    <link href="allgemeinStyle.css" rel="stylesheet">
    <title>Produkte.html</title>
</head>
<body>


<div class="container">
    <!--header-->

    <?php include('snippets/NavOben.php'); ?>
    <!--main part-->
    <div class="row" style="margin-top: 2em;">
        <!--formbereich-->


        <div class="col-3" style="margin-top: 4em;margin-bottom: 1.2em;">
            <form id="formular" name="speiseliste filtern" method="get" target="_self">
                <fieldset form="formular" style="border-style: solid;padding-bottom: 5em">
                    <legend style="padding-bottom: 0.6em;">Speiseliste filtern</legend>
                    <select name="speiselistenKategorien" size="1" style="border-style:solid;border-color: black">
                        <optgroup label="Generell">
                            <option value="0"> Alle zeigen</option>
                        </optgroup>


                        <?php
                        $query = 'SELECT * FROM Kategorien ';

                        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));
                        if (mysqli_connect_errno()) {
                            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
                            exit();
                        }
                        $oberkatquery = $query . ' where hatOberkategorie IS Null;';
                        $unterkatquery = $query . 'where hatOberkategorie IS Not Null;';


                        $oberkatarray = array();
                        $unterkatarray = [];
                        //$oberkatarray=[];


                        if ($oberkategorie = mysqli_query($link, $oberkatquery)) {
                            while ($row = mysqli_fetch_assoc($oberkategorie)) {
                                // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
                                // echo '<li id="id-' . $row['ID'] . '">' . $row['Name'] . '</li>';
                                $oberkatarray[] = $row;

                            }
                        }
                        if ($unterkategorie = mysqli_query($link, $unterkatquery)) {
                            while ($row = mysqli_fetch_assoc($unterkategorie)) {
                                // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
                                // echo '<li id="id-' . $row['ID'] . '">' . $row['Name'] . '</li>';
                                $unterkatarray[] = $row;
                            }
                        }
                        var_dump($unterkatarray);
                        //echo $oberkatarray[0]['ID'];
                        //für jedes array der oberkategorie
                        foreach ($oberkatarray as $oberkategor) {
                            echo '<optgroup label="' . $oberkategor['Bezeichnung'] . '">';
                            foreach ($unterkatarray as $unterkategor) {
                                //echo '<option>'.$unterkategor['hatOberkategorie'].'</option>';
                                // echo '<option>'.$oberkategor['ID'].'</option>';
                                if ($unterkategor['hatOberkategorie'] == $oberkategor['ID']) {
                                    echo '<option value="' . $unterkategor['ID'] . '">' . $unterkategor['Bezeichnung'] . '</option>';
                                }
                            }
                            echo '</optgroup>';
                        }

                        mysqli_close($link);


                        ?>

                    </select>


                    <fieldset form="formular" style="padding:10px 0px;">


                        <label><input name="available" type="checkbox"> nur verfügbare</label>
                        <label><input name="veggie" type="checkbox"> nur vegetarische</label>

                        <label><input checked name="vegan" type="checkbox"> nur vegane</label>

                    </fieldset>

                    <button name="action" type="submit">Speisen filtern</button>


                </fieldset>
            </form>
        </div>

        <!--bildersammlung und co-->
        <div class="col-9">
            <div class="row" style="margin-bottom: 2em;">
                <div class="col">
                    <h2>Verfügbare Speisen (Bestseller)</h2>
                </div>
            </div>

            <!--bilder und diverse speisen-->
            <div class="row" style="">
                <div class="col-9">
                    <!-- die ist ein test -->
                    <?php
                    //fall mindestens limit oder avail angegeben wurden
                    if (isset($_GET['limit']) || isset($_GET['avail'])) {
                        $limit = 100;
                        //$avail=false;

                        // echo 'ausgabe geht';

                        //setzen der einzelnen variablen falls gesetzt

                        if (isset($_GET['avail'])) {
                            $avail = $_GET['avail'];
                            // echo 'avail geht';

                            //wenn avail query verändern
                            $query = 'SELECT * FROM Mahlzeiten 
                                        join hatBilder on Mahlzeiten.ID = hatBilder.MahlzeitenID 
                                        JOIN Bilder ON hatBilder.BilderID = Bilder.ID
                                         where Vorrat >0;'; // Ihre SQL Query aus HeidiSQL
                        } else {
                            $query = 'SELECT * FROM Mahlzeiten 
                            join hatBilder on Mahlzeiten.ID = hatBilder.MahlzeitenID 
                                    JOIN Bilder ON hatBilder.BilderID = Bilder.ID;';
                            //echo 'avail geht nicht';
                        }

                        // echo $query;
                        //echo 'limit wäre ohne gesetzt zu sein' . $limit;
                        //query sezten je nachdem ob avail

                        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

                        if (mysqli_connect_errno()) {
                            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
                            exit();
                        } else {
                            // echo 'lief wohl gut';
                        }

                        if ($result = mysqli_query($link, $query)) {
                            if (isset($_GET['limit'])) {
                                $limit = $_GET['limit'];
                                //echo 'limit geht';
                                $i = 1;
                                //echo $i;
                                echo '<div class="row" style="margin-bottom: 1em;">';
                                while (($row = mysqli_fetch_assoc($result)) && ($i <= $limit)) {
                                    // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
                                    //echo '<li id="id-' . $row['Nummer'] . '">' . $row['Nutzername'] . $row['E-Mail'] . '</li>';
                                    // echo $row['ID'];
                                    //breite berechnen


                                    echo '<div class="col-3" style=" ">';
                                    // <img alt="miniempty Picture"
                                    //  src="pictures/miniEmptyPicture.PNG"
                                    //title="example mini Picture" class="h-50 w-100">'
                                    echo '<img alt="' . $row['Alt-Text'] .
                                        '"class="w-100" src="data:image/png;base64,' . base64_encode($row["Binärdaten"]) . '"style="overflow: hidden;height: 63%" class=" w-100">'


                                        . $row['Name'] .
                                        '<p><a href="Detail.php?id=' . $row['MahlzeitenID'] . '">Details</a></p>';
                                    echo '</div>';


                                    $i++;
                                }

                                echo '</div>';

                            }
                        }

                        mysqli_close($link);


                    } else {

                            $query = 'SELECT * FROM Mahlzeiten 
                            join hatBilder on Mahlzeiten.ID = hatBilder.MahlzeitenID 
                                    JOIN Bilder ON hatBilder.BilderID = Bilder.ID;';


                        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

                        if (mysqli_connect_errno()) {
                            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
                            exit();
                        } else {
                            // echo 'lief wohl gut';
                        }

                        if ($result = mysqli_query($link, $query)) {


                                //echo $i;
                                echo '<div class="row" style="margin-bottom: 1em;">';
                                while (($row = mysqli_fetch_assoc($result))) {
                                    // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
                                    //echo '<li id="id-' . $row['Nummer'] . '">' . $row['Nutzername'] . $row['E-Mail'] . '</li>';
                                    // echo $row['ID'];
                                    //breite berechnen


                                    echo '<div class="col-3" style=" ">';
                                    // <img alt="miniempty Picture"
                                    //  src="pictures/miniEmptyPicture.PNG"
                                    //title="example mini Picture" class="h-50 w-100">'
                                    echo '<img alt="' . $row['Alt-Text'] .
                                        '"class="w-100" src="data:image/png;base64,' . base64_encode($row["Binärdaten"]) . '"style="overflow: hidden;height: 63%" class=" w-100">'


                                        . $row['Name'] .
                                        '<p><a href="Detail.php?id=' . $row['MahlzeitenID'] . '">Details</a></p>';
                                    echo '</div>';



                                }

                                echo '</div>';


                        }

                        mysqli_close($link);

                    }
                    ?>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>

    <!--footer-->
    <?php include('snippets/NavUnten.php'); ?>
</div>


</body>
</html>