<?php

if($_POST['username']=="cliente")
{
   
    header("Status: 301 Moved Permanently");
    header("Location: films.php");
    exit;
  
}

if($_POST['username']=="admin")
{
   
    header("Status: 301 Moved Permanently");
    header("Location: Cines_AbM.php");
    exit;
  
}
?>