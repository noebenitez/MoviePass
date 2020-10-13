//////////////////////////////////////////////////
///////////////////////////////////////////////////
/////CANDELA//////////////////////
//////

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
	require("Config/Autoload.php");
	require("Config/Config.php");

	/**
	 * Alias
	 */
	use Config\Autoload as Autoload;
	use Config\Router as Router;
	use Config\Request as Request;
	
	//echo 'Paso por index.php';
	/**
	 * Flujo de ejecución
	 */
	Autoload::Start();

	$request = new Request();

	Router::direccionar($request);


	?>