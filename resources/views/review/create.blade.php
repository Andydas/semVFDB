@extends('layouts.app')

@section('title', 'Vytváranie recenzie')

@section('content')
<div class="container">

    <div class="jumbotron text-left transparent">
        <h1 class="display-4"> Pridávanie novej recenzie </h1>
        <p class="lead">Formulár na pridávanie recenzie.</p>
        <hr class="my-4">
    </div>


    @include('review.form')

</div>
@endsection
