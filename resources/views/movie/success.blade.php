@extends('layouts.app')

@section('title', 'Úspech')

@section('content')


@switch ($typ)
    @case ("create")
    <div class="container">
        <div class="jumbotron text-left transparent">
          <h1 class="display-4"> Pridanie záznamu prebehlo úspešne </h1>
          <hr class="my-4">
          <p> Položka <strong>{{$movie->nazov}}</strong> úspešne pridaná</p>
        </div>
    </div>
    @break
    @case ("edit")
    <div class="container">
        <div class="jumbotron text-left transparent">
            <h1 class="display-4"> Editacia záznamu prebehla úspešne </h1>
            <hr class="my-4">
            <p> Položka <strong>{{$movie->nazov}}</strong> úspešne editovana</p>
        </div>
    </div>
    @break
    @case ("destroy")
    <div class="container">
        <div class="jumbotron text-left transparent">
            <h1 class="display-4"> Mazanie záznamu prebehlo úspešne </h1>
            <hr class="my-4">
            <p> Položka <strong>{{$movie->nazov}}</strong> úspešne zmazana</p>
        </div>
    </div>
    @break
@endswitch
@endsection

