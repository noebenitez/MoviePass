<?php

$usuario=$_POST['username'];
if($usuario=="cliente")
{
   
    header("Status: 301 Moved Permanently");
    header("Location: peliculas.php");
    exit;
  
}

if($usuario=="admin")
{
   
    header("Status: 301 Moved Permanently");
    header("Location: Cines_AbM.php");
    exit;
  
}
?>