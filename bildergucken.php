<?php require __DIR__.'/vendor/autoload.php';
$dotenv=Dotenv\Dotenv::create(__DIR__,'.env');
$dotenv->load();
$dotenv->required(['DB_HOST','DB_NAME','DB_USER','DB_PASS','DB_PORT']);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <!-- hier testen wir ob die Informationen der Übergebenen ID vorhanden sind -->

    <!-- <meta content="3; url=./Start.php" http-equiv="refresh"> -->
    <link href="fontawesome-free-5.11.2-web/css/all.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" rel="stylesheet">
    <!--stylesheet-->
    <link href="allgemeinStyle.css" rel="stylesheet">
    <title>Detail </title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>



<body>
<?php
$query = 'SELECT * FROM Bilder;'; // Ihre SQL Query aus HeidiSQL
$remoteConnection = mysqli_connect(getenv('DB_HOST'),getenv('DB_USER'),getenv('DB_PASS'), getenv('DB_NAME'),getenv('DB_PORT'));
if (mysqli_connect_errno()) {
printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
exit();
}
if ($result = mysqli_query($remoteConnection, $query)) {
while ($row = mysqli_fetch_assoc($result)) {
// $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
    echo '<img alt="'.$row['Alt-Text'].
        '"src="data:image/png;base64,'.base64_encode($row["Binärdaten"]).'">';
}
}
mysqli_close($remoteConnection); // daran denken, die Verbindung wieder zu schließen wenn sie nicht mehr benötigt ist.




?>

</body>
</html>
