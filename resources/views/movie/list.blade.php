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
            @elseif ($zaner == 'vsetky')
                <h1 class="display-4"> {{ __('Vsetky filmy ') }}</h1>
                <p class="lead">Top filmy podľa hodnotenia užívateľov.</p>
                <hr class="my-4">
            @endif
        </div>

        <?php
        $inc = 0;
        ?>
        @foreach ($movies as $movie)


            @if($inc%2 == 0)
                <div class="card-deck">
                    @endif
                        <div class="card sedePozadie mb-3 mr-2 ml-2 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lx-6" style="min-width: 200px">
                            <div class="detailLink">
                                <div class="row no-gutters h-100">

                                    <div class="col-md-4 d-flex align-items-center">
                                        <img src="{{ $movie->img }}" class="card-img">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="h-100 d-flex flex-column">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <a href="{{route('movie.detail', $movie->id)}}">
                                                        <h5 class="card-title">{{$movie->nazov}}</h5>
                                                    </a>
                                                    <p class="card-text">{{$movie->popis}}</p>
                                                    <br>
                                                    <p class="card-text">Žáner: {{$movie->zaner}}</p>
                                                </div>
                                            </div>

                                            @if(Auth::user() != null)
                                                <div class="card-footer bg-transparent d-flex justify-content-between">
                                                    <div class="pridajRecenziu ">
                                                        <a href=" {{ route('review.create', $movie->id) }}"
                                                           class=" m-1 btn btn-dark" role="button">REcenzia</a>
                                                    </div>
                                                    @can('create', App\Models\Movie::class)
                                                        <div class="upravovanieMazanie text-nowrap">
                                                            {{--                                upravit--}}
                                                            <a href=" {{ route('movie.edit', $movie->id) }}"
                                                               class=" m-1 btn btn-dark" role="button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                     height="16" fill="currentColor"
                                                                     class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                                </svg>
                                                            </a>
                                                            {{--                                  zmazat--}}
                                                            <a href="{{ route('movie.destroy', $movie->id) }}"
                                                               class="m-1 btn btn-dark" role="button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                     height="16" fill="currentColor"
                                                                     class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    $inc++;
                    ?>
                    @if($inc%2 == 0)
                </div>
            @endif
        @endforeach
        <div>{{$movies->links()}}</div>
    </div>
@endsection
