<div class="row">
    <div class="col-10">


<fieldset>
    <legend>Ihre Benutzerdaten</legend>
    <?php var_dump($_REQUEST);?>

            <div class="row">
                <div class="col-2">
                    <label for="vorname">Vorname

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input type="text" id="vorname" name= vorname value="{{$_REQUEST['username'] or ''}}">
                </div>

            </div>

            <div class="row">
                <div class="col-2">
                    <label for="passwortwh">Passwort

                    </label>
                </div>
                <div class="col-5">
                    <input type="password" id="passwortwh" placeholder="*******">
                </div>


            </div>
            <div class="row">
                <div class="col-5">
                    <p><small> Das Passwort muss mindestens 10 Zeichen lang sein und mindestens eine Ziffer und ein
                            Sonderzeichen
                            enthalten.</small></p>
                </div>
            </div>


            <div class="row">
                <div class="col-2">
                    <label for="passwort">Passwort

                    </label>
                </div>
                <div class="col-5">
                    <input type="password" id="passwort" placeholder="*******">
                    <p><small> Hier müssen Sie das Passwort wiederholen.</small></p>
                </div>


            </div>
            <div class="row">
                <div class="col-2" style="margin-right: 1px">
                    Was tun Sie?
                </div>
                <div class="col-5" style="margin-left: 1px">
                    <fieldset>
                        <ul style="list-style: none;">
                            <li>
                                <label>
                                    <input type="checkbox" name="gast" @if(isset($_REQUEST['gast'])){!! "checked" !!}@endif>
                                    Ich bin Gast
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="arbeitet" @if(isset($_REQUEST['arbeitet'])){!! "checked" !!}@endif>
                                    Ich arbeite an der FH
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="studiert" @if(isset($_REQUEST['studiert'])){!! "checked" !!}@endif>
                                    Ich studiere an der FH
                                </label>
                            </li>
                        </ul>

                    </fieldset>
                </div>


            </div>

            <div class="row">
                <div class="col-3">
                    <button type="submit" name="action" value="0">Registrierung fortsetzten</button>
                </div>
            </div>
        </div>
    </div>

</fieldset>
