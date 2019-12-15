<div class="row">
    <div class="col-10">


        <fieldset>
            <legend>Ihre Benutzerdaten</legend>

            <div class="row">
                <div class="col-2">
                    <label for="vorname">Vorname

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input type="text" id="vorname" name="vorname" value="{{$_REQUEST['vorname'] or ''}}">
                </div>

            </div>
            <div class="row">
                <div class="col-2">
                    <label for="nachname">Nachname

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input type="text" id="nachname" name="nachname" value="{{$_REQUEST['nachname'] or ''}}">
                </div>

            </div>

            <div class="row">
                <div class="col-2">
                    <label for="email">E-Mail

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input type="email" id="email" name="email" value="{{$_REQUEST['email'] or ''}}">
                </div>

            </div>

            <div class="row">
                <div class="col-2">
                    <label for="gebDat">Geburtsdatum

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input type="date" id="gebDat" name="gebDat" value="{{$_REQUEST['gebDat'] or ''}}">
                </div>

            </div>


        </fieldset>



        {{--  //fachbereich --}}
        <fieldset>
            <legend>Ihr Fachbereich</legend>


            <div class="row">
                <div class="col-2">
                    <label for="fachbereich">Welchen Fachbereichen gehören Sie an?

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <select name="fachbereich" id="fachbereich" size="5" style="border-style:solid;border-color: black;width:100%;" >
                        <option value="0" @if(isset($_REQUEST['fachbereich'])){!! "selected" !!}@endif> Alle zeigen</option>
                    </select>
                </div>

            </div>




        </fieldset>
{{--Studentendaten --}}
        <fieldset>
            <legend>Ihr Fachbereich</legend>

            <div class="row">
                <div class="col-2">
                    <label for="matrikelnr">Matrikelnummer

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input type="number" min="000000" id="matrikelnr" name="matrikelnr" value="{{$_REQUEST['matrikelnr'] or ''}}">
                </div>

            </div>
            <div class="row">
                <div class="col-2">
                    <label for="studiengang">Studiengang

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <select name="studiengang" id="studiengang" size="1" style="border-style:hidden;border-color: black;width:auto;" >
                        <option value="0" @if(isset($_REQUEST['studiengang'])){!! "selected" !!}@endif> Alle zeigen</option>
                    </select>
                </div>

            </div>


            <div class="row">
                <div class="col-3">
                    <button type="submit" name="action" value="0">Registrierung fortsetzten</button>
                </div>
            </div>


        </fieldset>
    </div>
</div>