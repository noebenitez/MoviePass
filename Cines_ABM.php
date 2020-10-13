<?php
 	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require_once "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	autoload::Start();

	session_start();

	require_once(VIEWS_PATH."cinema/header.php");

	Router::Direccionar(new Request());

	require_once(VIEWS_PATH."cinema/footer.php");
?>