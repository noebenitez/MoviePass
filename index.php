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
	
	session_start();
	//echo 'Paso por index.php';
	/**
	 * Flujo de ejecución
	 */
	Autoload::start();

	header('Cache-Control: no cache'); //Evita el error de cache por reenvío de formulario

	$request = new Request();

	Router::direccionar($request);
