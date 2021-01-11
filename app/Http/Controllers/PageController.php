<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function domov() {
        return view('homepage');
    }

    public function master() {
        return view('master');
    }
}
