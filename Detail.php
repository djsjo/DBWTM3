<?php
require "vendor/autoload.php";

/*
 *	BladeOne Viewengine aufsetzen
 */
//notwendiges für datenbankaufbau

if (!isset($_SESSION)) session_start();
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);





use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);

/*
 * Daten vorbereiten (das sind später die Models),
 * d.h. die Queries an die DB senden und in Arrays
 * oder Objekten speichern, damit sie an die Views
 * übergeben werden können
 */

$übergebeneID = -1;
if (isset($_GET["id"])) {
    $übergebeneID = $_GET["id"];
}
//query stellen
$query = 'SELECT Mahlzeiten.`Name`, Mahlzeiten.ID, Beschreibung, Vorrat,
Kategorie, hatBilder.MahlzeitenID,Jahr, Gastpreis, 
Studentpreis,
`MA-Preis`, BilderID, `Alt-Text`, `Binärdaten`, Titel, ZutatenID ,Zutaten.Name AS Zutatenname

FROM Mahlzeiten 
left JOIN Preise ON Mahlzeiten.id=Preise.MahlzeitenID  
left join hatBilder on Mahlzeiten.ID   = hatBilder.MahlzeitenID 
left JOIN Bilder ON hatBilder.BilderID = Bilder.ID
left Join enthältZutaten on Mahlzeiten.ID=enthältZutaten.MahlzeitenID
left Join Zutaten on enthältZutaten.ZutatenID=Zutaten.ID
WHERE Mahlzeiten.id=' . $übergebeneID . ';'; // Ihre SQL Query aus HeidiSQL


$link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

if (mysqli_connect_errno()) {
    printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
    exit();
}

$result = mysqli_query($link, $query);
$result2 = mysqli_query($link, $query);
//gucken ob id gesetzt ist
$row = mysqli_fetch_assoc($result);

//$title = "Views Demo";


$zutatenrows=array();
while ($row2 = mysqli_fetch_assoc($result2)) {
    if (isset($row2['Zutatenname'])) {

        $zutatenrows[]=$row2;
    }

}
mysqli_close($link);




$defs = array();
array_push($defs,array("label" => "PRIMARY KEY", "term" => "Primärschlüssel"));
array_push($defs,array("label" => "KEY", "term" => "Sekundärschlüssel"));
array_push($defs,array("label" => "UNIQUE", "term" => "Eindeutigkeitsbedingung"));
array_push($defs,array("label" => "FOREIGN KEY", "term" => "Fremdschlüssel"));

$media = array();
array_push($media,"https://images.unsplash.com/photo-1573641287741-f6e223d81a0f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjExMDk0fQ&auto=format&fit=crop&w=1050&q=80");
array_push($media,"https://images.unsplash.com/photo-1572315831029-5d6f20e0035d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80");
array_push($media,"https://images.unsplash.com/photo-1569271836752-ed9351b75521?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80");

$labels = array();
array_push($labels, "Mitchell Luo @mitchel3uo");
array_push($labels, "Raul Angel @raulangel");
array_push($labels, "Stéphane Mingot @smingot");


/*
 * Wenn die Daten vorbereitet sind, können Sie mit dem HTML Output
 * beginnen. Alle Daten liegen schon vor, d.h. keine DB-Zugriffe mehr
 */

//echo "<!DOCTYPE html>
//<html lang='de'>
//	<head>
//		<title>$title</title>
//";

//echo $blade->run("static.css"); // statisches HTML Fragment aus dem Ordner views/static/ namens css.blade.php (lesen Sie aber auch zu den Möglichkeiten von View Layouts!)

//echo"	</head>
//	<body>
///		<div class='container'>
	//	<div class='row'>
	//	<header class='col'>
	//		<p>Hier könnte Ihre Webseite existieren</p>
	//	</header>
	//	</div>";





//echo $blade->run("deflist",array("defs"=>$defs,"headline" => "Defnitionen")); // übergibt das $defs Array als Variable defs an die View views/deflist.blade.php

//echo $blade->run("fragment"); // weiteres statisches HTML Fragment, das Sie vielleicht einbinden möchten

//echo $blade->run("gallerie",array("media"=>$media,"labels"=>$labels,"caption"=>$caption));

//echo "<footer><p>Sie sehen, mit der View-Engine können Sie jede Menge Code auslagern und in den dedizierten Views eine spezialisierte Syntax verwenden.</p></footer>";

echo $blade->run("pages.detail",array("result"=>$result,"row"=>$row,'zutatenrows'=>$zutatenrows));

//
//echo "
//		</div>
//	</body>
//</html>";