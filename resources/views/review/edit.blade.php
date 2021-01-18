@extends('layouts.app')

@section('title', 'Editácia recenzie')

@section('content')
<div class="container">

    <div class="jumbotron text-left transparent">
        <h1 class="display-4"> Editacia existujúcej recenzie </h1>
        <p class="lead">Formulár na editáciu recenzie.</p>
        <hr class="my-4">
    </div>


    @include('review.form')

</div>
@endsection
