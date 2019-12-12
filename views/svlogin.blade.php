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