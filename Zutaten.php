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
    <link href="ZutatenStyle.css" rel="stylesheet">


    <title>Mensa</title>
</head>
<body>
<?php include('snippets/NavOben.php'); ?>


<?php
$query = 'SELECT ID,Name,Bio,Vegan, Vegetarisch,Glutenfrei FROM Zutaten order by Bio desc,Name asc;'; // Ihre SQL Query aus HeidiSQL
$link = mysqli_connect(getenv('DB_HOST'),getenv('DB_USER'),getenv('DB_PASS'), getenv('DB_NAME'),getenv('DB_PORT'));

if (mysqli_connect_errno()) {
    printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
    exit();
} else {
    echo 'lief wohl gut';
}


/* if ($result = mysqli_query($link, $query)) {
     while ($row = mysqli_fetch_assoc($result)) {
         // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
         echo '<li id="id-' .$row['Nummer']. '">' .$row['Nutzername'].$row['E-Mail'].'</li>';

     }
 }*/

?>
<div class="container">


    <h1>Zutatenliste</h1>
    <table class="table">
        <thead>
        <tr>
           <!-- <th scope="col">ID</th> -->
            <th scope="col">Zutat</th>
            <th scope="col">Bio?</th>
            <th scope="col">Vegan?</th>
            <th scope="col">Vegetarisch?</th>
            <th scope="col">Glutenfrei?</th>
        </tr>
        </thead>
        <tbody>
        // SELECT ID,Name,Bio,Vegan, Vegetarisch,Glutenfrei FROM Zutaten;

        <?php
        if ($result = mysqli_query($link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                // $row['ID'] und $row['Name'] stehen aus der Query zur Verfügung
                //echo '<li id="id-' .$row['Nummer']. '">' .$row['Nutzername'].$row['E-Mail'].'</li>';

                echo '
                 <tr>
              <!--  <th scope="row">' . $row['ID'] . '</th> -->
                <th><i class="fas fa-barcode"></i><a href="https://www.google.com/search?q='.$row['Name'].'" title="Suchen Sie nach '.$row['Name'].' im Web"</a>'. $row['Name'].'</form>';
                if ($row['Bio'] == true) {
                    echo '<img alt="bio label" src="pictures/bio.svg" title="bio label" Style="img width="20 height="20"> ';
                }

                echo '</th> <td>';

                if ($row['Bio'] == true) {
                    echo '<i class="far fa-check-circle"></i>';
                } else {
                    echo '<i class="far fa-circle"></i>';
                }
                echo '</td> <td>';

                if ($row['Vegan'] == true) {
                    echo '<i class="far fa-check-circle"></i>';
                } else {
                    echo '<i class="far fa-circle"></i>';


                }
                echo ' </td ><td>';

                if ($row['Vegetarisch'] == true) {
                    echo '<i class="far fa-check-circle"></i>';
                } else {
                    echo '<i class="far fa-circle"></i>';


                }
                echo ' </td ><td>';
                if ($row['Glutenfrei'] == true) {
                    echo '<i class="far fa-check-circle"></i>';
                } else {
                    echo '<i class="far fa-circle"></i>';


                }
                echo ' </td ></tr>';
            }
        }
        ?>


        </tbody>
    </table>

    <?php include('snippets/NavUnten.php'); ?>
</div>
</body>

</html>