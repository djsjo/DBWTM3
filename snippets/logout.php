<?php
if(!isset($_SESSION))session_start();


echo '<form id="logout" name="logout" style="margin-top: 2.7em;" method="post" action="Auth.php" autocomplete="on" >
                <fieldset class="rahmenumform" form="logout">
                    <legend style="width: auto;padding-bottom: 0.7em;">Logout</legend>';
                    echo 'Hallo '.$_SESSION['username'].', Sie sind angemeldet als '.$_SESSION['role'].

                    '<button  type="submit" name="logout" value="true" form="logout" style="margin-bottom: 4em">Abmelden</button>
                </fieldset>
            </form>';

?>