<?php require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
$rest = substr($_SERVER['REQUEST_URI'], 4);
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
                        //markiert die auswahl die zuvor getroffen wurde
                        function sel($filterKategorie, $optionID)
                        {
                            if ($filterKategorie == $optionID) {
                                return "selected";
                            }
                        }


                        //für jedes array der oberkategorie
                        foreach ($oberkatarray as $oberkategor) {
                            echo '<optgroup label="' . $oberkategor['Bezeichnung'] . '">';
                            foreach ($unterkatarray as $unterkategor) {
                                $selekted = sel($_GET['speiselistenKategorien'], $unterkategor['ID']);

                                if ($unterkategor['hatOberkategorie'] == $oberkategor['ID']) {
                                    echo '<option  value="' . $unterkategor['ID'] . '"' . $selekted . '>' . $unterkategor['Bezeichnung'] .
                                        '</option>';
                                }
                            }
                            echo '</optgroup>';
                        }

                        mysqli_close($link);


                        ?>

                    </select>

                    <fieldset form="formular" style="padding:10px 0px;">


                        <label><input name="avail" type="checkbox" value="1"
                                <?php if (isset($_GET['avail'])) echo 'checked'; ?>
                            > nur verfügbare</label>
                        <label><input name="veggie" type="checkbox" value="1"
                                <?php if (isset($_GET['veggie'])) echo 'checked'; ?>
                            > nur vegetarische</label>

                        <label><input name="vegan" type="checkbox" value="1"
                                <?php if (isset($_GET['vegan'])) echo 'checked'; ?>
                            > nur vegane</label>

                    </fieldset>


                    <button name="action" type="submit">Speisen filtern</button>


                </fieldset>
            </form>
        </div>

        <!--bildersammlung und co-->
        <div class="col-9">
            <div class="row" style="margin-bottom: 2em;">
                <div class="col">
                    <h2>Verfügbare Speisen
                        <?php
                        if (isset($_GET['speiselistenKategorien']) and $_GET['speiselistenKategorien'] != 0) {
                            foreach ($unterkatarray as $unterkategor) {
                                if ($_GET['speiselistenKategorien'] == $unterkategor['ID'])
                                    echo '(' . $unterkategor['Bezeichnung'] . ')';
                            }

                        } else  echo '(Alle)';
                        ?>

                    </h2>
                </div>
            </div>

            <!--bilder und diverse speisen-->
            <div class="row" style="">
                <div class="col-9">
                    <!-- die ist ein test -->
                    <?php
                    //fall mindestens limit oder avail angegeben wurden
                    if (isset($_GET['limit']) || isset($_GET['avail'])) {
                        echo 'gehen in besonderen fall rein';
                        $limit = 100;
                        //$avail=false;

                        // echo 'ausgabe geht';

                        //setzen der einzelnen variablen falls gesetzt
                        //avail gesetzt
                        if (isset($_GET['avail'])) {
                            $avail = $_GET['avail'];
                            echo 'avail geht';
                            //var_dump($avail);

                            //wenn avail query verändern
                            $query = 'SELECT Mahlzeiten.Name,Mahlzeiten.ID,Beschreibung,Vorrat,Mahlzeiten.Kategorie,hatBilder.MahlzeitenID,enthältZutaten.MahlzeitenID,Bilder.ID,\'Alt-Text\',`Binärdaten`,Titel, Bezeichnung,hatOberkategorie,
                        hatBild,enthältZutaten.ZutatenID,Bio,Vegan,Vegetarisch,Glutenfrei,hatBilder.BilderID,Kategorien.ID,Zutaten.ID,
                                    MIN(Vegetarisch) AS MahlzeitVeggie,MIN(Vegan) AS MahlzeitVegan
                                     FROM Mahlzeiten 
                                        join hatBilder on Mahlzeiten.ID = hatBilder.MahlzeitenID 
                                        JOIN Bilder ON hatBilder.BilderID = Bilder.ID
                                        JOIN Kategorien ON Mahlzeiten.Kategorie = Kategorien.ID
                                        LEFT JOIN enthältZutaten ON Mahlzeiten.ID=enthältZutaten.MahlzeitenID
		                	            left JOIN Zutaten ON enthältZutaten.ZutatenID=Zutaten.ID
		                	            
                                      where Vorrat >0'; // Ihre SQL Query aus HeidiSQL

                            if (isset($_GET['speiselistenKategorien']) and $_GET['speiselistenKategorien'] != 0) {
                                echo 'geht in speiselisten bereich';
                                $query = $query . ' and Kategorien.ID=' . $_GET['speiselistenKategorien'];

                            }
                            $query = $query . ' GROUP BY Mahlzeiten.ID ';
                            if (isset($_GET['veggie']) and $_GET['veggie'] != 0) {
                                $query = $query . ' having MahlzeitVeggie=1 ';
                            }
                            if (isset($_GET['vegan']) and $_GET['vegan'] != 0) {
                                if (strpos($query, "having") == false) {
                                    $query = $query . ' having ';
                                } else $query = $query . ' and ';
                                $query = $query . '  MahlzeitVegan=1';
                            }
                            $query = $query . ' ;';
                            echo $query;

                            //avail nicht gesetzt aber limit
                        } else {


                            $query = 'SELECT Mahlzeiten.Name,Mahlzeiten.ID,Beschreibung,Vorrat,Mahlzeiten.Kategorie,hatBilder.MahlzeitenID,enthältZutaten.MahlzeitenID,Bilder.ID,\'Alt-Text\',`Binärdaten`,Titel, Bezeichnung,hatOberkategorie,
                        hatBild,enthältZutaten.ZutatenID,Bio,Vegan,Vegetarisch,Glutenfrei,hatBilder.BilderID,Kategorien.ID,Zutaten.ID,
                                    MIN(Vegetarisch) AS MahlzeitVeggie,MIN(Vegan) AS MahlzeitVegan
                                     FROM Mahlzeiten 
                                        join hatBilder on Mahlzeiten.ID = hatBilder.MahlzeitenID 
                                        JOIN Bilder ON hatBilder.BilderID = Bilder.ID
                                        JOIN Kategorien ON Mahlzeiten.Kategorie = Kategorien.ID
                                        LEFT JOIN enthältZutaten ON Mahlzeiten.ID=enthältZutaten.MahlzeitenID
		                	            left JOIN Zutaten ON enthältZutaten.ZutatenID=Zutaten.ID
		                	            
                                      ';
                            //echo 'avail geht nicht';


                            if (isset($_GET['speiselistenKategorien']) and $_GET['speiselistenKategorien'] != 0) {
                                $query = $query . ' where Kategorien.ID=' . $_GET['speiselistenKategorien'];
                            }

                            $query = $query . ' GROUP BY Mahlzeiten.ID ';
                            if (isset($_GET['veggie']) and $_GET['veggie'] != 0) {
                                $query = $query . ' having MahlzeitVeggie=1 ';
                            }
                            if (isset($_GET['vegan']) and $_GET['vegan'] != 0) {
                                if (strpos($query, "having") == false) {
                                    $query = $query . ' having ';
                                } else $query = $query . ' and ';
                                $query = $query . '  MahlzeitVegan=1 ';
                            }

                            $query = $query . ' ;';
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
                            }
                            //echo 'limit geht';
                            $i = 1;
                            //echo $i;
                            echo '<div class="row" style="margin-bottom: 1em;">';
                            if ($result->num_rows == 0) {
                                echo 'Es wurde nix gefunden';
                            }
                            //var_dump($result->num_rows);
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
                                    '"class="w-100" src="data:image/png;base64,' . base64_encode($row["Binärdaten"]) . '"style="overflow: hidden;';


                                if (!isset($row['Vorrat']) or $row['Vorrat'] <= 0) {
                                    echo ' -webkit-filter: grayscale(100%); 
                                 filter: grayscale(100%);';
                                }

                                echo ' height: 63%" class=" w-100">'


                                    . $row['Name'] .
                                    '<p>
 <a href="Detail.php?id=' . $row['MahlzeitenID'] . '">Details</a>
 
 
 </p>';
                                echo '</div>';


                                $i++;
                            }

                            echo '</div>';


                        }

                        mysqli_close($link);


                    } //weder avail noch limit gesetzt
                    else {
                        echo 'gehen in fall dass weder limit noch avila gesetzte ist ';
                        $query = 'SELECT Mahlzeiten.Name,Mahlzeiten.ID,Beschreibung,Vorrat,Mahlzeiten.Kategorie,hatBilder.MahlzeitenID,enthältZutaten.MahlzeitenID,Bilder.ID,\'Alt-Text\',`Binärdaten`,Titel, Bezeichnung,hatOberkategorie,
                        hatBild,enthältZutaten.ZutatenID,Bio,Vegan,Vegetarisch,Glutenfrei,hatBilder.BilderID,Kategorien.ID,Zutaten.ID,
                                    MIN(Vegetarisch) AS MahlzeitVeggie,MIN(Vegan) AS MahlzeitVegan 
                                    FROM Mahlzeiten 
                                        join hatBilder on Mahlzeiten.ID = hatBilder.MahlzeitenID 
                                        JOIN Bilder ON hatBilder.BilderID = Bilder.ID
                                        JOIN Kategorien ON Mahlzeiten.Kategorie = Kategorien.ID
                                        LEFT JOIN enthältZutaten ON Mahlzeiten.ID=enthältZutaten.MahlzeitenID
		                	            left JOIN Zutaten ON enthältZutaten.ZutatenID=Zutaten.ID
                                    ';

                        if (isset($_GET['speiselistenKategorien']) and $_GET['speiselistenKategorien'] != 0) {
                            $query = $query . ' where Kategorien.ID=' . $_GET['speiselistenKategorien'];
                        }
                        $query = $query . ' GROUP BY Mahlzeiten.ID ';
                        if (isset($_GET['veggie']) and $_GET['veggie'] != 0) {
                            $query = $query . ' having MahlzeitVeggie=1 ';
                        }
                        if (isset($_GET['vegan']) and $_GET['vegan'] != 0) {
                            if (strpos($query, "having") == false) {
                                $query = $query . ' having ';
                            } else $query = $query . ' and ';
                            $query = $query . '  MahlzeitVegan=1 ';
                        }

                        $query = $query . ' ;';

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
                            if ($result->num_rows == 0) {
                                echo 'Es wurde nix gefunden';
                            }
                            //var_dump($result->num_rows);
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
                                    '"class="w-100" src="data:image/png;base64,' . base64_encode($row["Binärdaten"]) . '"style="overflow: hidden;';


                                if (!isset($row['Vorrat']) or $row['Vorrat'] <= 0) {
                                    echo ' -webkit-filter: grayscale(100%); 
                                 filter: grayscale(100%);';
                                }

                                echo ' height: 63% " class=" w-100">'


                                    . $row['Name'];

                                if (!isset($row['Vorrat']) or $row['Vorrat'] <= 0) {
                                    echo '<p>Details</p>';
                                }
                                else echo '<p><a href="Detail.php?id=' . $row['MahlzeitenID'] . '">Details</a></p>';
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