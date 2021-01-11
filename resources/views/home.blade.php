@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-left transparent">
            @if (Auth::user() != null)
            <h1 class="display-4"> {{ __('Vitaj ') }}</h1>
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

        {{ __('You are logged in!') }}


    </div>

@endsection
