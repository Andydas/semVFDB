@extends('movie.index')

@section('title', 'Zoznam recezií')


@section('script')

    <script  src="{{asset("js/filterReviewsAjax.js")}}"></script>
@endsection

@section('content')


    <div class="container">

        <div class="jumbotron text-left transparent">
            <h1 class="display-4"> Recenzie filmov</h1>
            <p class="lead">Zoznam pridaných recenzií</p>
            <hr class="my-4">
        </div>

        <div class="reviewSearchField row justify-content-end">
            <input type="text" id="searchReview" name="vstup" placeholder="Vyhľadaj recenziu" autocomplete="off">
        </div>

        <div class="card review ">
            <div class="card-header">

                <div class="row my-auto">
                    <div class="review-list-user my-auto col-4">Meno užívateľa</div>
                    <div class="review-list-user my-auto col-5">Názov filmu</div>
                    <div class="review-list-movie my-auto">Hodnotenie</div>
                </div>
            </div>
        </div>


        <div class="accordion" id="reviewList">
            <?php
            $inc = 0;
            ?>
            @foreach ($reviews as $review)
                <div class="card highlighted review ">
                    <div class="card-header" id="heading{{$review->id}}">
                            <div role="button" class="btn collapsed btn-review btn-block text-left"
                                    data-toggle="collapse" data-target="#collapse{{$review->id}}"
                                    aria-expanded="false" aria-controls="collapse{{$review->id}}">
                                <div class="row my-auto">
                                    <div class="review-list-user my-auto col-4">{{$review->user->name}}</div>
                                    <div class="review-list-user my-auto col-5">{{$review->movie->nazov}}</div>
                                    <div class="review-list-movie my-auto  ">{{$review->hodnotenie}} / 5</div>
                                </div>
                            </div>
                    </div>

                    <div id="collapse{{$review->id}}" class="collapse" aria-labelledby="heading{{$review->id}}"
                         data-parent="#reviewList">
                        <div class="card-body">
                            {{$review->popis}}
                            @if(isset(Auth::user()->id) && (Auth::user()->id == $review->user_id || Auth::user()->role == 'admin'))
                                <div class="upravovanieMazanie text-right">
                                    <a href=" {{ route('review.edit', $review->id) }}"
                                       class=" m-1 btn btn-dark" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                             height="16" fill="currentColor"
                                             class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                    <button class="btn btn-dark deleteReviewButton"
                                            id="{{$review->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                             height="16" fill="currentColor"
                                             class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </button>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <?php
                $inc++;
                ?>
            @endforeach
        </div>
    </div>

@endsection
