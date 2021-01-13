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

    public function detail(Movie $movie){
        return view('movie.detail', ['movie' => $movie]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $movies = DB::table('movies')->orderBy('nazov')->paginate(4);
        return view('movie.list', ['movies' => $movies,'zaner' => 'vsetky']);
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
            'nazov' => 'required|min:3|unique:movies',
            'popis' => 'required|min:8',
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
     * @return \Illuminate\Http\Response
     */
    public function show($zaner)
    {

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
            'nazov' => 'required|min:3',
            'popis' => 'required|min:8',
            'zaner' => 'required'
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
        $reviews = $movie->reviews();
        $reviews->delete();
        $movie->delete();
        return view('success', ['objekt' => 'movie',  'typ' => 'destroy', 'model' => $movie]);
    }
}
