<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{

    public function akcny()
    {
        $movies = DB::select('select * from movies where zaner = :zaner', ['zaner' => 'akcny']);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'akcny']);
    }

    public function scifi()
    {
        $movies = DB::select('select * from movies where zaner = :zaner', ['zaner' => 'scifi']);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'scifi']);
    }

    public function horror()
    {
        $movies = DB::select('select * from movies where zaner = :zaner', ['zaner' => 'horror']);
        return view('movie.list', ['movies' => $movies, 'zaner' => 'horror']);
    }

    public function success(){
        return view('movie.success');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

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
            'zaner' => 'required'
        ]);
        $movie = Movie::create($request->all());
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'nazov' => 'required|min:3|unique:movies',
            'popis' => 'required|min:8',
            'zaner' => 'required'
        ]);
        $movie->update($request->all());
        return view('movie.success', [ 'typ' => 'edit', 'movie' => $movie]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return view('movie.success', [ 'typ' => 'destroy', 'movie' => $movie]);
    }
}
