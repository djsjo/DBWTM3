<fieldset>
    <legend>Ihre Registrierung</legend>

    <div class="row">
        <div class="col-10">
            Willkommen Ihre Registrierung war erfolgreich!
            Ihre Nummer ist:
            @if(isset($_SESSION['lastUserNr']))
                {!! $_SESSION['lastUserNr']!!}
            @endif
        </div>
    </div>

</fieldset>
