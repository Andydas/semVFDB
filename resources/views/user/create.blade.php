@extends('layouts.app')
@section('title', 'Pridanie používateľa')

@section('content')
<div class="container">

    <div class="jumbotron text-left transparent">
        <h1 class="display-4"> Pridávanie nového užívateľa </h1>
        <p class="lead">Formulár na pridávanie užívateľa.</p>
        <hr class="my-4">
    </div>


    @include('user.form')

</div>
@endsection
