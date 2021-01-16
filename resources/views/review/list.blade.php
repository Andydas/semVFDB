@extends('movie.index')


@section('content')
    <div class="container">

        <div class="jumbotron text-left transparent">
            <h1 class="display-4"> {{ __('Recenzie od uzivatelov ') }}</h1>
            <p class="lead">Top akčné filmy podľa hodnotenia užívateľov.</p>
            <hr class="my-4">
        </div>

        <div class="reviewSearchField row justify-content-end">
            <input type="text" id="searchReview" name="vstup" placeholder="Meno užívateľa" autocomplete="off">
        </div>



        <div id="reviewList">
        <?php
        $inc = 0;
        ?>
        @foreach ($reviews as $review)
            <div class="card review col-12">
                <div class="row my-auto">
                    <div class="col-10 my-auto">
                        <strong>{{$review->movie->nazov}}</strong>
                    </div>
                    @if(isset(Auth::user()->id) && (Auth::user()->id == $review->user_id || Auth::user()->role == 'admin'))
                        <div class="upravovanieMazanie text-right my-auto col-2">
                            {{--                                upravit--}}
                            <a href=" {{ route('review.edit', $review->id) }}"
                               class=" m-1 btn btn-dark" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                     height="16" fill="currentColor"
                                     class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>

                            <input type="button" class="deleteReviewButton" id="{{$review->id}}" >
                        </div>
                    @endif
                </div>
            </div>
            <?php
            $inc++;
            ?>
        @endforeach
        </div>
    </div>
@endsection
