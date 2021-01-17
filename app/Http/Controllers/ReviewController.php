<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Review::class, 'review');
    }

    public function myReviews(Request $request){
        // $movies = DB::table('movies')->where('zaner', 'akcny')->orderBy('nazov')->paginate(4);
        //$reviews = Review::all()->pluck(Auth::user()->id);
        //$reviews = DB::table('reviews')->where('user_id', $request->user()->id)->orderBy('id')->paginate(4);
       // dd($reviews);
        $reviews = $request->user()->reviews;
        return view('review.list', ['reviews' => $reviews]);
    }

    public function detail(Review $review){
        return view('review.detail', $review);
    }

    public function movieReviews(Movie $movie){
        $reviews = $movie->reviews();
        return view('review.list', ['reviews' => $reviews]);
    }

    public function filterReview(Request $request){

        $allReviews = Review::with('movie')->get();
        $reviews = [];
        //dd($request->input('vstup'));
        if ($request->input('vstup') != ""){
            foreach ($allReviews as $review){
                if (str_contains(strtolower($review->user->name), strtolower($request->input('vstup'))) ||
                    str_contains(strtolower($review->movie->nazov), strtolower($request->input('vstup')))){
                    $reviews[] = $review;
                }
            }
        } else {
            $reviews = Review::with('movie')->with('user')->get();
        }
            $user = $request->user();

        return response()->json(['reviews' => $reviews,'user'=> $user]);



//        return view('review.list', ['reviews' => $reviews,
//            'name' => $request->input('name')
//        ]);
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
            return view('error', ['objekt' => 'review', 'typ' => 'create', 'model' => $movie]);
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
            'popis' => 'required|min:4',
            'hodnotenie' => 'required|integer|gte:0|lte:5'
        ]);

        $movie = Movie::with('reviews')->where('id', $request->input('movie'))->first();

        if (!$movie->reviews->pluck('user_id')->contains($request->user()->id)){
        $review = $request->user()->reviews()->create([
            'popis' => $request->input('popis'),
            'hodnotenie' => $request->input('hodnotenie'),
            'movie_id' => $request->input('movie')
        ]);
            return view('success', ['objekt' => 'review', 'typ' => 'create', 'model' => $review]);

        } else {
            return view('error', ['objekt' => 'review', 'typ' => 'create', 'model' => $movie]);
        }
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, Review $review)
    {
        //if ($request->user()->id == $review->user_id) {
            return view('review.edit', [
                'action' => route('review.update', $review->id),
                'method' => 'put',
                'model' => $review
            ]);
        //} else {
        //    return view('error', ['objekt' => 'review', 'typ' => 'edit', 'model' => $review]);
        //}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {

            $request->validate([
                'popis' => 'required|min:4',
                'hodnotenie' => 'required|integer|gte:0|lte:5'
            ]);
            $review->update($request->all());
            return view('success', ['objekt' => 'review', 'typ' => 'edit', 'model' => $review]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Request $request, Review $review)
    {
        //if ($request->user()->id == $review->user_id){
            $review->delete();
            $reviews = Review::with('movie')->with('user')->get();
            $user = $request->user();
            return response()->json(['reviews' => $reviews,'user'=> $user]);
        //}//else {
            //return view('error', ['objekt' => 'review', 'typ' => 'destroy', 'model' => $review]);
       // }

       /*if ($request->user()->id == $review->user_id){
           $review->delete();

           return view('success', ['objekt' => 'review', 'typ' => 'destroy', 'model' => $review]);
       } else {
           return view('error', ['objekt' => 'review', 'typ' => 'destroy', 'model' => $review]);
       }*/
    }
}
