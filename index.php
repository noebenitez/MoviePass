<?php 

include("config/autoload.php");
include("config/constants.php");


$daosFilms = new \daos\Films();

$films = $daosFilms->GetAll();

echo "<br>PELICULAS (disponibles en Argentina y traducidas al español)<br>";
echo "<pre>";
var_dump($films);
echo "</pre>";

echo "<br><br><br>";

$daosGenres = new \daos\Genres();

$genres = $daosGenres->GetAll();

echo "<br>GENEROS (todos los géneros)<br>";
echo "<pre>";
var_dump($genres);
echo "</pre>";

?>