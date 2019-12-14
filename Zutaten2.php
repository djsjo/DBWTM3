<?php
require "vendor/autoload.php";

/*
 *	BladeOne Viewengine aufsetzen
 */
//notwendiges für datenbankaufbau

if (!isset($_SESSION)) session_start();
require __DIR__ . '/vendor/autoload.php';

require_once "Models/ZutatenModel.php";

$dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);


use eftec\bladeone\BladeOne;

class ZutatenController
{
    private $blade;

    public function _construct()
    {
        $views = __DIR__ . '/views';
        $cache = __DIR__ . '/cache';
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }
}

/*
 * Daten vorbereiten (das sind später die Models),
 * d.h. die Queries an die DB senden und in Arrays
 * oder Objekten speichern, damit sie an die Views
 * übergeben werden können
 */

$query = 'SELECT ID,Name,Bio,Vegan, Vegetarisch,Glutenfrei FROM Zutaten order by Bio desc,Name asc;'; // Ihre SQL Query aus HeidiSQL
$link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), getenv('DB_PORT'));

if (mysqli_connect_errno()) {
    printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
    exit();
} else {
    //echo 'lief wohl gut';
}


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

//echo $blade->run("pages.detail",array("result"=>$result,"row"=>$row,'zutatenrows'=>$zutatenrows,"session"=>$_SESSION));
echo $blade->run("pages.zutaten", array('zutatenrows' => $zutatenrows));
//
//echo "
//		</div>
//	</body>
//</html>";