<?php require __DIR__.'/vendor/autoload.php';
$dotenv=Dotenv\Dotenv::create(__DIR__,'.env');
$dotenv->load();
$dotenv->required(['DB_HOST','DB_NAME','DB_USER','DB_PASS','DB_PORT']);
?>
<!doctype html>
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

    <title>Mensa</title>
</head>
<body>
<div class="container">
    <?php include('snippets/NavOben.php'); ?>


    <!-- erstes Bild-->
    <div class="row">


        <img alt="empty Picture" src="pictures/mensa.img" title="example Picture" style="margin-top: 1.5em; height: 20em;width:max-content">

    </div>
    <!--hier ist der main part-->
    <div class="row" style="height: 320px;margin-top: 4em;margin-bottom: 10em;">

        <div class="col-2">
            <section>
                <p>
                    Der Dienst e-Mensa ist noch beta. Sie können
                    bereits <a href="Produkte.php">Mahlzeiten</a>
                    durchstöbern, aber noch nicht bestellen.
                </p>
                <p>
                    Registrieren Sie sich <a href="Registrieren.php">hier</a>
                    , um über die Veröffentlichung des Dienstes per Mail informiert zu werden.
                </p>
            </section>
        </div>
        <div class="col-9">
            <div class="row">

                <div class="col-8 rot">
                    <p>
                    <h3>Leckere Gerichte vorbestellen</h3>
                    <p>...und gemeinsam mit Kommilitonen und Freunden Essen</p>
                </div>
                <div class="col-4" style="">
                    <form action="Registrieren.php">
                        <br>

                        <div class="row  h-50">
                            <div class="col-12 align-self-end w-50 h-100 " style="margin-left: 8em;">
                                <button type="submit"><i class="far fa-hand-point-right"></i> Registrieren</button>
                            </div>
                        </div>

                        <div class="row align-items-end" style="margin-top: 1.3em">
                            <div class="col-12" style="margin-left: 8em;">
                                <button type="button"><i class="fas fa-sign-in-alt"></i> Anmelden &nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
            <div class="row">
                <div class="col">
                    <img alt="empty Picture" src="pictures/emptyPicture.PNG" title="example Picture"
                         style="margin-top: 4em">

                </div>
            </div>


        </div>


    </div>


    <?php include('snippets/NavUnten.php'); ?>
    <?php
    $query = 'SELECT * FROM Benutzer;'; // Ihre SQL Query aus HeidiSQL
    $link = mysqli_connect(getenv('DB_HOST'),getenv('DB_USER'),getenv('DB_PASS'), getenv('DB_NAME'),(int)getenv('DB_PORT'));

    if (mysqli_connect_errno()) {
    printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
    exit();
    }
    //else{echo 'lief wohl gut';}

    if ($result = mysqli_query($link, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
        // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
       // echo '<li id="id-' .$row['Nummer']. '">' .$row['Nutzername'].$row['E-Mail'].'</li>';
        }
    }

    mysqli_close($link);
    ?>

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