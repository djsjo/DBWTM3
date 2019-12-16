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
                    <input required type="text" id="vorname" name="vorname" value="{{$_SESSION['vorname'] or ''}}">
                </div>

            </div>
            <div class="row">
                <div class="col-2">
                    <label for="nachname">Nachname

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input required type="text" id="nachname" name="nachname" value="{{$_SESSION['nachname'] or ''}}">
                </div>

            </div>

            <div class="row">
                <div class="col-2">
                    <label for="email">E-Mail

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input required type="email" id="email" name="email" value="{{$_SESSION['email'] or ''}}" @if(isset($_SESSION['fehlernachrichtenBetroffeneFelder']) and in_array(('email'),($_SESSION['fehlernachrichtenBetroffeneFelder'])))
                        {!! 'class="alert-danger"' !!}


                            @endif>
                </div>

            </div>

            <div class="row">
                <div class="col-2">
                    <label for="gebDat">Geburtsdatum

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <input required type="date" id="gebDat" name="gebDat" value="{{$_SESSION['gebDat'] or ''}}">
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
                        <option value="0" @if(isset($_SESSION['fachbereich'])){!! "selected" !!}@endif> Alle zeigen</option>
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
                    <input required type="number" min="000000" id="matrikelnr" name="matrikelnr" value="{{$_SESSION['matrikelnr'] or ''}}" @if(isset($_SESSION['fehlernachrichtenBetroffeneFelder']) and in_array(('matrikelnr'),($_SESSION['fehlernachrichtenBetroffeneFelder'])))
                        {!! 'class="alert-danger"' !!}


                            @endif>
                </div>

            </div>
            <div class="row">
                <div class="col-2">
                    <label for="studiengang">Studiengang

                    </label>
                </div>
                <div class="col-5" style="margin-left: 0em ">
                    <select name="studiengang" id="studiengang" size="1" style="border-style:hidden;border-color: black;width:auto;" >
                        <option value="0" @if(isset($_SESSION['studiengang'])){!! "selected" !!}@endif> Alle zeigen</option>
                    </select>
                </div>
                <div>
                    <input type="hidden" name="checksecondRegister" value=true>
                </div>
            </div>


            <div class="row">
                <div class="col-3">
                    <button type="submit" name="action" >senden</button>
                </div>
            </div>


        </fieldset>
    </div>
</div>