@extends('movie.index')

@section('title', 'Zoznam filmov')

@section('content')
    <div class="container">

        <div class="jumbotron text-left transparent">
            @if ($zaner == 'vsetky' || ($zaner == '' && $nazov == ''))
                <h1 class="display-4"> {{ __('Všetky filmy ') }}</h1>
                <p class="lead">Zoznam všetkých filmov databázy.</p>
                <hr class="my-4">
            @elseif ($zaner == '')
                <h1 class="display-4"> {{ __('Filter filmov ') }}</h1>
                <p class="lead">Filmy filtrované podľa názvu: {{$nazov}}</p>
                <hr class="my-4">
            @elseif ($nazov == '')
                <h1 class="display-4"> {{ __('Filter filmov ') }}</h1>
                <p class="lead">Filmy filtrované podľa žánra: {{$zaner}}</p>
                <hr class="my-4">
            @else
                <h1 class="display-4"> {{ __('Filter filmov ') }}</h1>
                <p class="lead">Filmy filtrované podľa názvu: {{$nazov}} a žánra: {{$zaner}}</p>
                <hr class="my-4">
            @endif
        </div>

        <div class="movie-filter row justify-content-end">
            <form action="{{$action}}">
                @csrf
                @method($method)
                <div class="form-group d-flex ">
                    <input type="text" class="form-control" name="nazov" value="" placeholder="Názov filmu">
                    <select class="form-control mb-2 " style="width:200px" name="zaner">
                        <option selected value="">Zvol zaner</option>
                        <option value="akcny">akcny</option>
                        <option value="scifi">scifi</option>
                        <option value="horror">horror</option>
                    </select>
                    <button class="btn btn-dark mx-2" style="height:40px">Potvrdiť</button>
                </div>
            </form>
        </div>

        <div class="movie-list">
            <?php
            $inc = 0;
            $count = 0;
            ?>
            @foreach($movies as $movie)
               <?php $count++; ?>
                @endforeach

            @foreach ($movies as $movie)


                @if($inc%2 == 0)
                    <div class="card-deck">
                        @endif
                        <div
                            class="card sedePozadie px-0 mb-3 mr-2 ml-2 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lx-6"
                            style="min-width: 200px">
                            <div class="detailLink">
                                <div class="row no-gutters h-100">

                                    <div class="col-md-4 d-flex align-items-center">
                                        <img src="{{ $movie->img }}" alt="obrazok{{ $movie->id }}" class="card-img">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="h-100 d-flex flex-column">
                                            <div class="card-body pb-0">
                                                <div class="d-flex flex-column">
                                                    <a href="{{route('movie.show', $movie->id)}}">
                                                        <h5 class="card-title">{{$movie->nazov}}</h5>
                                                    </a>
                                                    <p class="card-text">{{\Illuminate\Support\Str::limit($movie->popis,170, $end = '...') }}</p>

                                                    <p class="card-detail">Žáner: {{$movie->zaner}}</p>
                                                    @if(isset($movie->hodnotenie))
                                                    <p class="card-detail">Hodnotenie: {{number_format(round($movie->hodnotenie, 1),1)}} </p>
                                                    @else
                                                    <p class="card-detail">Hodnotenie: - </p>
                                                        @endif
                                                </div>
                                            </div>

                                            @if(Auth::user() != null)
                                                <div class="card-footer py-1 bg-transparent d-flex justify-content-between">
                                                    <div class="pridajRecenziu m-0 my-1 ">
                                                        <a href=" {{ route('review.create', $movie->id) }}"
                                                           class=" m-0 btn btn-dark" role="button">Recenzia</a>
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
                                                               class="my-1 mr-0 btn btn-dark" role="button">
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
                @if($inc%2 != 0 && $inc == $count)
                        <div
                            class="card invisible px-0 mb-3 mr-2 ml-2 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lx-6"
                            style="min-width: 200px">
                            <div class="detailLink">
                                <div class="row no-gutters h-100">
                                    <div class="col-md-4 d-flex align-items-center">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="h-100 d-flex flex-column">
                                            <div class="card-body pb-0">
                                                <div class="d-flex flex-column">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
        @endif
            @endforeach
           <div class="strankovanie">{{$movies->links()}}</div>
        </div>
    </div>
@endsection
