@extends('layouts.app')



@section('content')


    <div class="container">
        <div class="jumbotron text-left transparent">

            <h1 class="display-4"> Vyskytla sa chyba! </h1>
            <hr class="my-4">

            @switch ($typ)
                @case ("create")
                    <p class="alert-warning"> K tomuto filmu už si pridal recenziu! </p>
                @break

                @case ("edit")
                    <p class="alert-warning"> Nemôžeš editovať recenziu, ktorá patrí inému užívateľovi!</p>
                @break

                @case ("destroy")
                    <p class="alert-warning"> Nemôžeš zmazať recenziu, ktorá patrí inému užívateľovi! </p>
                @break
            @endswitch
        </div>
    </div>
@endsection

