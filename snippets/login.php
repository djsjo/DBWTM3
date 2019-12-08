<form id="login" name="login" style="margin-top: 2.7em;" method="post" action="Auth.php" autocomplete="on">
    <fieldset class="rahmenumform" form="login">
        <legend style="width: auto;padding-bottom: 0.7em;">Login</legend>
        <label for="user">
            <input  id="benutzer" name="user" placeholder="Benutzer"
                   style="border-style: solid;border-color: black;"
                   type="text" class="form-control
<?php
            if (isset($_SESSION['userfehlt']) and $_SESSION['userfehlt'] == true) {
                echo 'alert alert-danger"role="alert';
                unset($_SESSION['userfehlt']);

            }
            echo '" ';
            //wenn user gesetzt wurde in form eintragen
            if(isset($_SESSION['user'])){
                echo 'Value="'.$_SESSION['user'].'"';
            }
            ?>
>
        </label>
        <label for="password">
            <input id="password" name="password" placeholder="*******"
                   style="border-style: solid;border-color: black;"
                   type="password" class="form-control
                                <?php
            if (isset($_SESSION['pwfehlt']) and $_SESSION['pwfehlt'] == true) {
                echo 'alert alert-danger"role="alert';
                unset($_SESSION['pwfehlt']);
            }


            ?>
           "> </label>
        <button form="login" style="margin-bottom: 4em" type="submit">Anmelden</button>
    </fieldset>
</form>

<section>
    Melden Sie sich jetzt an, um die wirklich viel günstigeren Preise für
    Mitarbeiter oder Studenten zu sehen.
</section>
