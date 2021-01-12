@extends('layouts.app')



@section('content')


<div class="container">
    <div class="jumbotron text-left transparent">
@switch ($typ)
    @case ("create")

          <h1 class="display-4"> Pridanie záznamu prebehlo úspešne </h1>
          <hr class="my-4">
          @if ($objekt == 'movie')
          <p> Film <strong>{{$model->nazov}}</strong> úspešne pridany</p>
            @else
                <p> Recenzia k filmu <strong>{{$model->movie->nazov}}</strong> úspešne pridana</p>
              @endif

    @break
    @case ("edit")
            <h1 class="display-4"> Editacia záznamu prebehla úspešne </h1>
            <hr class="my-4">
            @if ($objekt == 'movie')
            <p> Film <strong>{{$model->nazov}}</strong> úspešne editovany</p>
            @else
                <p> Recenzia k filmu <strong>{{$model->movie->nazov}}</strong> úspešne editovana</p>
            @endif
    @break
    @case ("destroy")
            <h1 class="display-4"> Mazanie záznamu prebehlo úspešne </h1>
            <hr class="my-4">
            @if ($objekt == 'movie')
            <p> Film <strong>{{$model->nazov}}</strong> úspešne zmazana</p>
            @else
            <p> Recenzia k filmu <strong>{{$model->movie->nazov}}</strong> úspešne zmazana</p>
            @endif
    @break
@endswitch
    </div>
    </div>
@endsection

