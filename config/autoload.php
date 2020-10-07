<?php
spl_autoload_register(function($classname) {

    $filename = dirname(__DIR__)."\\".$classname.".php";
    require_once($filename);
});