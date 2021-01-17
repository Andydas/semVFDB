@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron text-left transparent">
        <h1 class="display-4"> Editácia existujúceho užívateľa </h1>
        <p class="lead">Formulár na editáciu užívateľa.</p>
        <hr class="my-4">
    </div>


    @include('user.form')

</div>
@endsection
