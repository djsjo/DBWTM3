@extends('layouts.all');
@section('title','Zutatenliste')
@section('specialCss','<link href="ZutatenStyle.css" rel="stylesheet">')
@section('content')


    <h1>Zutatenliste</h1>
    <table class="table">
        <thead>
        <tr>
            <!-- <th scope="col">ID</th> -->
            <th scope="col">Zutat</th>
            <th scope="col">Bio?</th>
            <th scope="col">Vegan?</th>
            <th scope="col">Vegetarisch?</th>
            <th scope="col">Glutenfrei?</th>
        </tr>
        </thead>
        <tbody>


        @if (!empty($zutatenrows))
            @foreach ($zutatenrows as $zutatenrow)

            {{--<li id="id-' .$zutatenrow['Nummer']. '">' .$zutatenrow['Nutzername'].$row['E-Mail'].'</li>';--}}

            {!! '<tr>

                <th><i class="fas fa-barcode"></i><a href="https://www.google.com/search?q='.$zutatenrow['Name'].'"
                                                     title="Suchen Sie nach '.$zutatenrow['Name'].' im Web"> '.
                    $zutatenrow['Name'].'</a>'

                    !!}

            @if ($zutatenrow['Bio'] == true)
                {!! '<img alt="bio label" src="pictures/bio.svg" title="bio label"  Style="img" width="20
                height="20">'
                 !!}
            @endif


            {!! '</th>
            <td>' !!}

            @if ($zutatenrow['Bio'] == true)
                {!!  '<i class="far fa-check-circle"></i>'!!}
            @else

                {!!  '<i class="far fa-circle"></i>'!!}

            @endif
            {!!
            '</td>
            <td>'!!}

                @if ($zutatenrow['Vegan'] == true)
                    {!! '<i class="far fa-check-circle"></i>'!!}
                @else
                    {!! '<i class="far fa-circle"></i>'!!}



                @endif
                {!! '</td>
            <td>' !!}

                @if ($zutatenrow['Vegetarisch'] == true)
                    {!! '<i class="far fa-check-circle"></i>'!!}
                @else
                {!! '<i class="far fa-circle"></i>'!!}

                @endif

                {!! '
            </td>
            <td>'!!}
                @if ($zutatenrow['Glutenfrei'] == true)
                    {!! '<i class="far fa-check-circle"></i>'!!}
                @else
                    {!! '<i class="far fa-circle"></i>'!!}

                @endif

                {!! '
            </td>
            </tr>'!!}

            @endforeach
        @endif


        </tbody>
    </table>








@endsection