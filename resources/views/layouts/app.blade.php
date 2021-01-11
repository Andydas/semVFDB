<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Domov</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/styles.css")}}">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="script.js"></script>

    <style>

    </style>

</head>
<body>


<header>

    <nav class="navbar navbar-expand-lg navbar-light transparent">
        <div class="container">
            <a class="navbar-brand" href="#"><strong>VFDB</strong></a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('homepage.index')}}">{{__('Domov')}}<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filmy
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('movie.akcny')}}">Akčné</a>
                            <a class="dropdown-item" href="{{route('movie.scifi')}}">Sci-fi</a>
                            <a class="dropdown-item" href="{{route('movie.horror')}}">Horrory</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Seriály
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?c=Show&a=komedia">Komédie</a>
                            <a class="dropdown-item" href="?c=Show&a=fantasy">Fantasy</a>
                            <a class="dropdown-item" href="?c=Show&a=drama">Drama</a>
                        </div>
                    </li>

                    @if(Auth::user() != null && Auth::user()->role == 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pridaj
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('movie.create')}}">Film</a>
                            <a class="dropdown-item" href="?c=Show&a=add">Seriál</a>
                        </div>
                    </li>
                    @endif
                    @if(Auth::user() != null && Auth::user()->role == 'admin')
                    <li class="nav-item">
                        @auth
                            <a class="nav-link" href="{{route('user.index')}}">{{__('Správa užívateľov')}}</a>
                        @endauth
                    </li>
                    @endif
                </ul>

                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Prihlás') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registruj') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?c=Show&a=komedia">Moje recenzie</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


</header>
    @yield('content')
</body>
</html>
