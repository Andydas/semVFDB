@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-left transparent">
            @if (Auth::user() != null)
            <h1 class="display-4"> Vitaj {{ Auth::user()->name }}!</h1>
                <p class="lead">{{ __('Bol si uspesne prihlaseny') }}</p>
            <hr class="my-4">
                @elseif (Auth::user() == null)
                <h1 class="display-4"> {{ __('VFDB') }}</h1>
                <hr class="my-4">
                @endif

        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif




    </div>

@endsection
