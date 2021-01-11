@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron text-left transparent">
        <h1 class="display-4"> Pridávanie nového filmu </h1>
        <p class="lead">Formulár na pridávanie filmu.</p>
        <hr class="my-4">
    </div>


    @include('movie.form')

</div>
@endsection
