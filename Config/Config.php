<?php

    namespace Config;

define('ROOT', dirname(__DIR__) . "/");

define( 'PELICULAS', 'https://api.themoviedb.org/3/movie/now_playing?api_key=f20416aa14acdc6b2cd1af3feb7633a6&language=es' );

define( 'GENEROS', 'https://api.themoviedb.org/3/genre/movie/list?api_key=f20416aa14acdc6b2cd1af3feb7633a6&language=es' );

define( 'IMAGENES', 'https://image.tmdb.org/t/p/w500');

define("FRONT_ROOT", "/MoviePass/");

define('VIEWS_PATH', "Views/");

define('CSS_PATH', ROOT.VIEWS_PATH . "css/");

define('JS_PATH', ROOT.VIEWS_PATH . "js/");

define('CSS_ARCH', 'http://avmartinmalharro.edu.ar/dweb/4a/2019/YAROSSI/TPFLab4/css/style.css');

define('VIDEOS', 'http://avmartinmalharro.edu.ar/dweb/4a/2019/YAROSSI/TPFLab4/videos/');

define('IMAGES', 'http://avmartinmalharro.edu.ar/dweb/4a/2019/YAROSSI/TPFLab4/images/');

define("DB_HOST", "localhost");

define("DB_NAME", "cinesbd");

define("DB_USER", "root");

define("DB_PASS", "");

?>