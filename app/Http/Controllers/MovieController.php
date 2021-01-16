<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Movie::class, 'movie');
    }

    public function akcny()
    {
        $movies = DB::table('movies')->where('zaner', 'akcny')->orderBy('nazov')->paginate(4);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'akcny']);
    }

    public function scifi()
    {
        $movies = DB::table('movies')->where('zaner', 'scifi')->orderBy('nazov')->paginate(4);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'scifi']);
    }

    public function horror()
    {
        $movies = DB::table('movies')->where('zaner', 'horror')->orderBy('nazov')->paginate(4);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'horror']);
    }
    public function komedia()
    {
        $movies = DB::table('movies')->where('zaner', 'komedia')->orderBy('nazov')->paginate(4);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'komedia']);
    }
    public function fantasy()
    {
        $movies = DB::table('movies')->where('zaner', 'fantasy')->orderBy('nazov')->paginate(4);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'fantasy']);
    }

    public function success(){
        return view('movie.success');
    }

    public function detail(){
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */



    public function index()
    {
//        $movies = DB::table('movies')->orderBy('nazov')->paginate(2);
        $movies = DB::table('movies')
                    ->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
                    ->groupBy('movies.id', 'movies.nazov', 'movies.popis', 'movies.zaner', 'movies.img')
                    ->select('movies.id', 'movies.nazov', 'movies.zaner','movies.popis', 'movies.img', DB::raw('avg(hodnotenie) as hodnotenie'))
                    ->paginate(20);
        //dd($movies);
        return view('movie.list', [
            'action' => route('movie.filterMovie'),
            'method' => 'get',
            'movies' => $movies,
            'zaner' => 'vsetky'
        ]);

    }

    public function filterMovie(Request $request){
        //dd($request->toArray());
        if ($request->input('nazov')!='' && $request->input('zaner')!= ''){
            $movies = DB::table('movies')
                ->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
                ->groupBy('movies.id', 'movies.nazov', 'movies.popis', 'movies.zaner', 'movies.img')
                ->select('movies.id', 'movies.nazov', 'movies.zaner','movies.popis', 'movies.img', DB::raw('avg(hodnotenie) as hodnotenie'))
                ->where('zaner', $request->input('zaner'))
                ->where('nazov', 'like', '*'.$request->input('nazov').'*')
                ->orderBy('nazov')
                ->paginate(20);
        } else if ($request->input('nazov') =='' && $request->input('zaner') != ''){
            $movies = DB::table('movies')
                ->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
                ->groupBy('movies.id', 'movies.nazov', 'movies.popis', 'movies.zaner', 'movies.img')
                ->select('movies.id', 'movies.nazov', 'movies.zaner','movies.popis', 'movies.img', DB::raw('avg(hodnotenie) as hodnotenie'))
                ->where('zaner', $request->input('zaner'))
                ->orderBy('nazov')
                ->paginate(20);
        } else if ($request->input('nazov') !='' && $request->input('zaner') == ''){
            //$movies = Movie::where('nazov', $request->input('nazov'))
            $movies = DB::table('movies')
                ->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
                ->groupBy('movies.id', 'movies.nazov', 'movies.popis', 'movies.zaner', 'movies.img')
                ->select('movies.id', 'movies.nazov', 'movies.zaner','movies.popis', 'movies.img', DB::raw('avg(hodnotenie) as hodnotenie'))
                ->where('nazov', $request->input('nazov'))
                ->orderBy('nazov')
                ->paginate(20);
        } else {
            $movies = DB::table('movies')
                ->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
                ->groupBy('movies.id', 'movies.nazov', 'movies.popis', 'movies.zaner', 'movies.img')
                ->select('movies.id', 'movies.nazov', 'movies.zaner','movies.popis', 'movies.img', DB::raw('avg(hodnotenie) as hodnotenie'))
                ->paginate(20);
        }

        return view('movie.list', ['movies' => $movies,
            'zaner' => $request->input('zaner'),
            'action' => route('movie.filterMovie'),
            'method' => 'get',
            'nazov' => $request->input('nazov')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie.create', [
            'action' => route('movie.store'),
            'method' => 'post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nazov' => 'required|min:2|unique:movies',
            'popis' => 'required|min:4',
            'zaner' => 'required|in:'. implode(',', ['akcny','scifi','horror','komedia','fantasy',]),
            'img' => 'nullable|active_url'
        ]);


        $movie = Movie::make($request->all());
        if ($request->input('img') == '')
            $movie->img = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png';

        $movie->save();
        return view('movie.success', [ 'typ' => 'create', 'movie' => $movie]);
        //return redirect()->route('movie.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $zaner
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        $reviews = $movie->reviews()->get();
        //dd($reviews);
        return view('movie.detail', ['movie' => $movie, 'reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movie.edit', [
            'action' => route('movie.update', $movie->id),
            'method' => 'put',
            'model' => $movie
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'nazov' => 'required|min:2',
            'popis' => 'required|min:4',
            'zaner' => 'required|in:'. implode(',', ['akcny','scifi','horror','komedia','fantasy',]),
            'img' => 'nullable|active_url'
        ]);
        $movie->update($request->all());
        return view('success', ['objekt' => 'movie', 'typ' => 'edit', 'model' => $movie]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {

        DB::transaction(function () use( $movie ){
            $reviews = $movie->reviews();
            $reviews->delete();
            $movie->delete();
        });
        return view('success', ['objekt' => 'movie',  'typ' => 'destroy', 'model' => $movie]);
    }
}
