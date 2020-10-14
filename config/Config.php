<?php

    namespace Config;

define('ROOT', dirname(__DIR__) . "/");

define( 'PELICULAS', 'https://api.themoviedb.org/3/movie/now_playing?api_key=f20416aa14acdc6b2cd1af3feb7633a6&language=es&region=AR' );

define( 'GENEROS', 'https://api.themoviedb.org/3/genre/movie/list?api_key=f20416aa14acdc6b2cd1af3feb7633a6&language=es' );

define( 'IMAGENES', 'https://image.tmdb.org/t/p/w500');

define("FRONT_ROOT", "/TP-METODOLOGIA/");

define('VIEWS_PATH', "Views/");

define('CSS_PATH', ROOT.VIEWS_PATH . "css/");

define('JS_PATH', ROOT.VIEWS_PATH . "js/");

?>