
    <!-- hier testen wir ob die Informationen der Übergebenen ID vorhanden sind -->
    <?php

    //id setzen



    //echo $query;


    // else{echo 'lief wohl gut';}

  //result 1 und 2
    //row setzen
    if (isset($_GET["id"])) {

        if ($übergebeneID == $row['MahlzeitenID']) {

        }
        if ($übergebeneID != $row['MahlzeitenID']) {
            echo '<meta content="3; url=./Start.php" http-equiv="refresh">';
        }
        //wen id gar nicht gesetzt ist
    } else {
        echo 'offenbar ist die id nicht gesetzt';
        echo '<meta content="3; url=./Start.php" http-equiv="refresh">';
    }



   //link schließen
    ?>
//hier war ein header


    <!--main part-->
    <div class="row" style="margin-top: 3em;">

        <!--form für login-->
        <div class="col-3 ">

            <?php

            //var_dump($_SESSION);
            if (isset($_SESSION['auth']) and $_SESSION['auth'] == true) {
                //     echo 'hallo';
                include('snippets/logout.php');
            } else {
                include('snippets/login.php');

            }
            ?>
            <!--  echo '<meta content="3; url=./Detail.php?ID=1" http-equiv="refresh">'; -->

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
                        <strong>
                            <?php
                            if (isset($_SESSION['role'])) {
                                switch ($_SESSION['role']) {
                                    case "ma":
                                        echo "Mitarbeiter-";
                                        break;
                                    case "student":
                                        echo "Studenten-";
                                        break;
                                    case "gast":
                                        echo "Gast-";
                                        break;
                                    default:
                                        echo "Gast-";
                                }
                            } else echo 'Gast-';
                            ?>
                        </strong>Preis
                        <h5 style="margin-left: 1.2em;">
                            <?php
                            if (isset($_SESSION['role'])) {
                                switch ($_SESSION['role']) {
                                    case "ma":
                                        echo $row['MA-Preis'];
                                        break;
                                    case "student":
                                        echo $row['Studentpreis'];
                                        break;
                                    case "gast":
                                        echo $row['Gastpreis'];
                                        break;
                                    default:
                                        echo $row['Gastpreis'];
                                }
                            } //falls nicht angemeldet
                            else  echo $row['Gastpreis'];
                            ?>
                        </h5>
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
                                        } else echo '<li>Leider sind keine Zutaten angegeben</li>';

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


