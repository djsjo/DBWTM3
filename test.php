<?php require './vendor/autoload.php';
$dotenv=Dotenv\Dotenv::create(_DIR_,'.env');
$dotenv->load();
$dotenv->required(['DB_HOST','DB_NAME','DB_USER','DB_PASS','DB_PORT']);
?>
<!doctype html>
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

    <title>Zutaten</title>
</head>
<body>
<?php include('snippets/NavOben.php'); ?>

<footer>
    <?php include ('snippets/NavUnten.php');?>
</footer>


</body>
</html>