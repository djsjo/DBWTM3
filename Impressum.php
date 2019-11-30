<?php require __DIR__.'/vendor/autoload.php';
$dotenv=Dotenv\Dotenv::create(__DIR__,'.env');
$dotenv->load();
$dotenv->required(['DB_HOST','DB_NAME','DB_USER','DB_PASS','DB_PORT']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="3; url=./Start.html" http-equiv="refresh">
    <title>Impressum</title>
</head>
<body>

<h1>Diese Seite befindet Sich noch im Aufbau</h1>
<img alt="Picture of Minions" src="pictures/fehler.jfif" style="align-content: center">
</body>
</html>