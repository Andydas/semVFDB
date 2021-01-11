@extends('movie.index')


@section('content')
<div class="container">

    <div class="jumbotron text-left transparent">
        @if ($zaner == 'akcny')
            <h1 class="display-4"> {{ __('Akcne filmy ') }}</h1>
            <p class="lead">Top akčné filmy podľa hodnotenia užívateľov.</p>
            <hr class="my-4">
        @elseif ($zaner == 'scifi')
            <h1 class="display-4"> {{ __('Scifi filmy ') }}</h1>
            <p class="lead">Top scifi filmy podľa hodnotenia užívateľov.</p>
            <hr class="my-4">
        @elseif ($zaner == 'horror')
            <h1 class="display-4"> {{ __('Horrorove filmy ') }}</h1>
            <p class="lead">Top horrorove filmy podľa hodnotenia užívateľov.</p>
            <hr class="my-4">
        @endif
    </div>

    @foreach ($movies as $movie)
        <div class="row">
        <div class="card sedePozadie mb-3 mr-2 ml-2 col-xs-12 col-sm-12 col-md-6 col-lg-6" style="max-width: 540px;">
            <div class="row no-gutters h-100">
                <div class="col-md-4 d-flex align-items-center">
                    <img src="{{ $movie->img }}?>" class="card-img">
                </div>
                <div class="col-md-8">
                    <div class="h-100 d-flex flex-column">
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <h5 class="card-title">{{$movie->nazov}}</h5>
                                <p class="card-text">{{$movie->popis}}</p>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent row">
                            <div class="upravovanie col-6">
                                <a href=" {{ route('movie.edit', $movie->id) }}" class="btn btn-dark" role="button">Upraviť</a>
                            </div>
                            <div class="mazanie col-6">
                                <a href="{{ route('movie.destroy', $movie->id) }}" class="btn btn-dark" role="button">Zmazať</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
</div>
@endsection
