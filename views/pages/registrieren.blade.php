@extends('layouts.all');
@section('title','Registrierung')

//@section('specialCss','<link href="ZutatenStyle.css" rel="stylesheet">')
@section('content')
    <div class="row">
        <div class="col">
            <form id="registrierung" name="registrierung" style="margin-top: 2.7em;" method="post"
                  action="Registrieren.php" autocomplete="on">
                <fieldset class="rahmenumform" form="registrierung">
                    <legend style="width: auto;padding-bottom: 0.7em;">Registrierung</legend>
                    @if(!empty($_SESSION['fehlernachrichten']))
                        {{var_dump($_SESSION['fehlernachrichten'])}}
                    <div class="row">
                        <div class="col-10">
                            Es gab Fehler beim Bearbeiten Ihrer Anfrage:
                            <ul style="list-style: none;">

                                @foreach($_SESSION['fehlernachrichten'] as $fehlernachricht)
                                <li>
                                    {{$fehlernachricht}}
                                </li>
                                @endforeach
                        </div>
                    </div>
                    @endif

                    @if(isset($_SESSION['firstRegisterSuccesful'])and $_SESSION['firstRegisterSuccesful']==true)
                        @include('includes.registrierungFurther')
                    @else
                        @include('includes.registrierungstart')
                    @endif


                </fieldset>


            </form>
        </div>
    </div>










@endsection