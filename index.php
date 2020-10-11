<<<<<<< Updated upstream
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
=======
<?php

	/**
	 * Mostrar errores de PHP
	 */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	/**
	 * Archivos necesarios de inicio
	 */
	require("config/autoload.php");
	require("config/config.php");

	/**
	 * Alias
	 */
	use config\Autoload as Autoload;
	use config\Router as Router;
	use config\Request as Request;
	
	//echo 'Paso por index.php';
	/**
	 * Flujo de ejecución
	 */
	Autoload::start();

	$request = new Request();

	Router::direccionar($request);
>>>>>>> Stashed changes
