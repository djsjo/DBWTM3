@extends('layouts.all');
@section('title','Registrierung')

//@section('specialCss','<link href="ZutatenStyle.css" rel="stylesheet">')
@section('content')
    <div class="row">
        <div class="col">
            <form id="registrierung" name="registrierung" style="margin-top: 2.7em;" method="get"
                  action="Registrieren.php" autocomplete="on">
                <fieldset class="rahmenumform" form="registrierung">
                    <legend style="width: auto;padding-bottom: 0.7em;">Registrierung</legend>
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