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
    <!-- hier testen wir ob die Informationen der Übergebenen ID vorhanden sind -->
    <?php

    $übergebeneID = -1;
    if (isset($_GET["id"])) {
        $übergebeneID = $_GET["id"];
    }

    //echo $übergebeneID;
    $query = 'SELECT Mahlzeiten.`Name`, Mahlzeiten.ID, Beschreibung, Vorrat,
Kategorie, hatBilder.MahlzeitenID, Gastpreis, 
Studentpreis,
`MA-Preis`, BilderID, `Alt-Text`, `Binärdaten`, Titel, ZutatenID,Zutaten.Name AS Zutatenname 
FROM Mahlzeiten JOIN Preise ON Mahlzeiten.id=Preise.MahlzeitenID  
join hatBilder on Mahlzeiten.ID = hatBilder.MahlzeitenID 
JOIN Bilder ON hatBilder.BilderID = Bilder.ID
left Join enthältZutaten on Mahlzeiten.ID=enthältZutaten.MahlzeitenID
left Join Zutaten on enthältZutaten.ZutatenID=Zutaten.ID
WHERE Jahr=YEAR(CURDATE())
 and  Mahlzeiten.id=' . $übergebeneID . ';'; // Ihre SQL Query aus HeidiSQL

    // ; Select ID,Name,Gastpreis from Mahlzeiten where id=\'.$übergebeneID
    $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

    if (mysqli_connect_errno()) {
        printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
        exit();
    }
    // else{echo 'lief wohl gut';}

    $result = mysqli_query($link, $query);
    $result2 = mysqli_query($link, $query);
    //gucken ob id gesetzt ist
    $row = mysqli_fetch_assoc($result);
    if (isset($_GET["id"])) {
       // echo 'id gesetzt';
       // echo ' übergebene ist' . $übergebeneID . '\n';
       // echo 'rowid ist ' . $row['MahlzeitenID'] . " ";
        if ($übergebeneID == $row['MahlzeitenID']) {

            //wenn wir hier sind gibt es die auf jeden fall und sie ist gesetzt
            //  echo $row['ID'] . " ";
        }
        if ($übergebeneID != $row['MahlzeitenID']) {

            //wenn wir hier sind gibt es die auf jeden fall und sie ist gesetzt
            // echo $row['ID'];
            //echo 'übergene id ist nicht row id ';
            //echo $übergebeneID . " ";
            //echo $row['ID'] . " ";
            echo '<meta content="3; url=./Start.php" http-equiv="refresh">';
        }
        //wen id gar nicht gesetzt ist
    } else {
        echo 'offenbar ist die id nicht gesetzt';
        echo '<meta content="3; url=./Start.php" http-equiv="refresh">';
    }


    /*if ($result = mysqli_query($link, $query)) {
        $row = mysqli_fetch_assoc($result);
        // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
        //  echo $row['Gastpreis'];
       //     echo $row['ID'];
    }
    */
    //echo $row['Gastpreis'];
    mysqli_close($link);
    ?>
    <!-- <meta content="3; url=./Start.php" http-equiv="refresh"> -->
    <link href="fontawesome-free-5.11.2-web/css/all.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" rel="stylesheet">
    <!--stylesheet-->
    <link href="allgemeinStyle.css" rel="stylesheet">
    <title>Detail <?php echo $row['Name']; ?></title>
</head>
<body>
<div class="container">
    <?php include('snippets/NavOben.php'); ?>

    <!--main part-->
    <div class="row" style="margin-top: 3em;">

        <!--form für login-->
        <div class="col-3">
            <!--form für login und text-->
            <form id="login" name="login" style="margin-top: 2.7em;">
                <fieldset class="rahmenumform" form="login">
                    <legend style="width: auto;padding-bottom: 0.7em;">Login</legend>
                    <label for="benutzer">
                        <input id="benutzer" name="benutzer" placeholder="Benutzer"
                               style="border-style: solid;border-color: black;"
                               type="text">
                    </label>
                    <label for="password">
                        <input id="password" name="password" placeholder="*******"
                               style="border-style: solid;border-color: black;"
                               type="password">
                    </label>
                    <button form="login" style="margin-bottom: 4em" type="submit">Anmelden</button>
                </fieldset>
            </form>

            <section>
                Melden Sie sich jetzt an, um die wirklich viel günstigeren Preise für
                Mitarbeiter oder Studenten zu sehen.
            </section>
        </div>

        <!--falafelbild und preise-->

        <div class="col">
            <div class="row" style="margin-bottom:2em ;">
                <div class="col"><h4>Details für <?php echo $row['Name']; ?></h4></div>
            </div>
            <div class="row">
                <!--produktbild und details-->
                <div class="col-9">
                    <!--<img alt="falafel picture" class="w-100" src="pictures/falafel.png"
                         style="overflow: hidden;height: 63%"
                         title="falafel Picture">-->

                    <?php if (isset($row['Binärdaten'])) {
                        echo '<img alt="' . $row['Alt-Text'] .
                            '" class="w-100" src="data:image/png;base64,' . base64_encode($row["Binärdaten"]) . '" style="overflow: hidden;height: 63%">';
                    } else {
                        echo '<img alt="falafel picture" class="w-100" src="pictures/falafel.png"
                         style="overflow: hidden;height: 63%"
                         title="falafel Picture">';

                    }
                    ?>
                </div>


                <div class="col-3">
                    <!--gastpreise und button-->
                    <div style="margin-left: 6em;">
                        <strong>Gast-</strong>Preis
                        <h5 style="margin-left: 1.2em;"><?php echo $row['Gastpreis'] ?></h5>
                    </div>
                    <form>
                        <button id="vorbestellen" style="margin-top: 9em;margin-left: 3em;" type="button">
                            <i class="fas fa-utensils"></i>
                            Vorbestellen
                        </button>
                    </form>
                </div>

            </div>
            <!--Tabauswahl-->
            <div class="row">
                <div class="col">
                    <div class="row">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a aria-controls="home" aria-selected="true" class="nav-link active"
                                   data-toggle="tab"
                                   href="#home"
                                   id="home-tab" role="tab">Beschreibung</a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="profile" aria-selected="false" class="nav-link" data-toggle="tab"
                                   href="#profile"
                                   id="profile-tab" role="tab">Zutaten</a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="contact" aria-selected="false" class="nav-link" data-toggle="tab"
                                   href="#contact"
                                   id="contact-tab" role="tab">bewertung</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-9">


                            <div class="tab-content" id="myTabContent" style="border-style: solid">
                                <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home"
                                     role="tabpanel">
                                    <p><?php echo $row['Beschreibung'] ?>
                                        <a href="Impressum.php">Krautsalat</a></p>
                                </div>

                                <div aria-labelledby="profile-tab" class="tab-pane fade" id="profile"
                                     role="tabpanel">
                                    <!-- Trust Me you don't want to know ;)-->
                                    <!--<iframe class="w-100 h-100" src="Start.php"></iframe>-->
                                    <?php
                                    //result variable wurde schon einmal ausgelesen daher eine zweite result
                                    echo '<ul>';
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                        if (isset($row['Zutatenname'])) {
                                            echo '<li>' . $row['Zutatenname'] . '</li>';
                                        }
                                        else echo '<li>Leider sind keine Zutaten angegeben</li>';

                                    }
                                    echo '</ul>';


                                    ?>

                                </div>
                                <div aria-labelledby="contact-tab" class="tab-pane fade" id="contact"
                                     role="tabpanel">
                                    <!--Mahlzeit bewerten-->
                                    <form action="http://bc5.m2c-lab.fh-aachen.de/form.php" id="mahlzeitBewerten"
                                          method="post" name="mahlzeitBewerten">
                                        <fieldset form="mahlzeitBewerten" style="border-style: solid">
                                            <legend>Mahlzeit bewerten</legend>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="mahlzeit">
                                                        Mahlzeit
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <select form="mahlzeitBewerten" id="mahlzeit" name="mahlzeit"
                                                            required>
                                                        <option value="">Falafel</option>
                                                        <option>Bratrolle</option>
                                                        <option>Curry Wok</option>
                                                        <option>Bratrolle</option>
                                                        <option>Krautsalat</option>
                                                    </select></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="benutzer1">
                                                        Benutzername


                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <input form="mahlzeitBewerten" id="benutzer1" name="benutzer"
                                                           required type="text">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="bewertung1">
                                                        Bewertung

                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <input form="mahlzeitBewerten" id="bewertung1" max="5" min="1"
                                                           name="bewertung"
                                                           required
                                                           type="number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="bemerkung">
                                                        Bemerkung


                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <textarea
                                                            form="mahlzeitBewerten"
                                                            id="bemerkung"
                                                            name="bemerkung"
                                                            placeholder="Geben Sie eine Bewertung ein wenn sie möchten"

                                                            required>
                                                    </textarea>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3"></div>
                                                <div class="col">
                                                    <button type="submit" value="Senden">Bewertung absenden</button>
                                                </div>
                                            </div>


                                            <p>

                                                <input form="mahlzeitBewerten" name="matrikel" type=hidden
                                                       value="3211992">
                                                <input form="mahlzeitBewerten" name="kontrolle" type=hidden
                                                       value="sep">
                                            </p>


                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <?php include('snippets/NavUnten.php'); ?>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script crossorigin="anonymous"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>