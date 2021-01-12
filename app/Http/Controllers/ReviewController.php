<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function myReviews(){
        //$reviews = Review::all()->pluck(Auth::user()->id);
        $reviews = Auth::user()->reviews;
        return view('review.list', ['reviews' => $reviews]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        return view('review.list', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request, Movie $movie)
    {
        $movie->load('reviews');
        if (!$movie->reviews->pluck('user_id')->contains($request->user()->id)){
        return view('review.create', [
            'action' => route('review.store'),
            'method' => 'post',
            'movie' => $movie
        ]);
        } else {
            echo('hocno');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'popis' => 'required|min:8',
            'hodnotenie' => 'required|gte:0|lte:5'
        ]);

        $review = $request->user()->reviews()->create([
            'popis' => $request->input('popis'),
            'hodnotenie' => $request->input('hodnotenie'),
            'movie_id' => $request->input('movie')
        ]);
        return view('success', ['objekt' => 'review', 'typ' => 'create', 'model' => $review]);

//        $review = Review::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return view('success', ['objekt' => 'review', 'typ' => 'destroy', 'model' => $review]);
    }
}
