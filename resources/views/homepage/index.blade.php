@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-left transparent">
            <h1 class="display-4"> Vymyslená filmová databáza</h1>
            <p class="lead">Stránka venovaná nadšencom všetkých žánrov filmov.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id turpis ipsum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam suscipit mauris et laoreet luctus. Cras pretium tincidunt aliquet. </p>
            <hr class="my-4">
        </div>
        <p>Vychadzajuce novinky</p>

        <div class="row">
            <div class="col-sm-12">
                <div id="carouselHome" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselHome" data-slide-to="1"></li>
                        <li data-target="#carouselHome" data-slide-to="2"></li>
                        <li data-target="#carouselHome" data-slide-to="3"></li>
                        <li data-target="#carouselHome" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="https://www.youtube.com/watch?v=tykS7QfTWMQ"><img src="https://www-rewind-sk.exactdn.com/wp-content/uploads/2019/02/the-haunting-of-bly-manor.jpg?strip=all&lossy=1&resize=696%2C392&ssl=1"  alt="TheHauntingOfBlyManor"></a>
                            <div class="carousel-caption">
                                <p>The Haunting of Bly Manor</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <a href="https://www.youtube.com/watch?v=T0dE_YLghMM"><img src="https://video.newsserve.net/v/20201015/1312263536-Jungleland-with-Charlie-Hunnam-Official-Trailer_hires.jpg"  alt="Jungleland"></a>
                            <div class="carousel-caption">
                                <p>Jungleland</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <a href="https://www.youtube.com/watch?v=xOsLIiBStEs"><img src="https://video.newsserve.net/v/20200312/1305240572-Soul-movie-2020-Jamie-Foxx-Tina-Fey_hires.jpg"  alt="Soul"></a>
                            <div class="carousel-caption">
                                <p>Soul</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <a href="https://www.youtube.com/watch?v=qgDJkVuv-Ag"><img src="https://serialy.bombuj.tv/images/covers/run2020.jpg"  alt="Run"></a>
                            <div class="carousel-caption">
                                <p>Run</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <a href="https://www.youtube.com/watch?v=3od-kQMTZ9M"><img src="https://cdn.collider.com/wp-content/uploads/2020/02/monster-hunter-milla-jovovich-social.jpg"  alt="MonsterHunter"></a>
                            <div class="carousel-caption">
                                <p>Monster Hunter</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>


    </div>

@endsection
