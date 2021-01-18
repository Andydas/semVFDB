@extends('layouts.app')

@section('title', 'Editácia filmu')

@section('content')
<div class="container">

    <div class="jumbotron text-left transparent">
        <h1 class="display-4"> Editacia existujuceho filmu </h1>
        <p class="lead">Formulár na editaciu existujuceho filmu.</p>
        <hr class="my-4">
    </div>


    @include('movie.form')

</div>
@endsection
