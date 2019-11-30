

<header>
    <div class="row align-items-end" style="margin-top: 2em;">
        <div class="col-3"><h2><strong>e-Mensa</strong></h2></div>
        <div class="col">
            <?php
            $rest = substr($_SERVER['REQUEST_URI'], 4);
           // echo $rest;
            ?>

            <nav>


                <ul class="nav">
                    <?php
                    if ($rest == "Start.php") {
                        echo '<li><a> Start</a></li>';
                    } else {
                        echo '<li ><a href = "Start.php" target = "_self" > Start</a ></li >';
                    }
                    ?>
                    <?php
                    if ($rest == "Produkte.php") {
                        echo '<li ><a > Mahlzeiten</a ></li >';
                    } else {
                        echo '<li ><a href = "Produkte.php?limit=100" target = "_self" > Mahlzeiten</a ></li >';
                    }
                    ?>
                    <?php

                    if ($rest == "ausprobieren.php") {
                        echo '<li ><a > Bestellung</a ></li >';
                    } else {
                        echo '<li ><a href = "ausprobieren.php" > Bestellung</a ></li >';
                    }
                    ?>

                    <li><a class="lastlinkright" href="//www.fh-aachen.de" rel=noopener
                           target="_blank">FH-Aachen</a></li>


                </ul>

            </nav>

        </div>
        <div class="col-3">

            <div class="suchen" >
                <form action="http://www.google.de/search" method="get" rel="noopener" style=";" target="_blank">

                    <label for="suchleiste" style="padding-right: 1px">
                        <i class="fas fa-search"></i>
                        <input id="suchleiste" name="q" placeholder="Suchen.."
                               style="border-style: hidden;width: 12em;border-radius: 50px;"
                               type="search">
                        <input name="as_sitesearch" type="hidden" value="fh-aachen.de">
                    </label>


                </form>


            </div>


        </div>

    </div>
</header>
