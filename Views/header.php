

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviePass</title>
<link rel="shortcut icon" href="<?php echo IMAGES.'ico.png' ?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo CSS_ARCH ?>" type="text/css">
<script src="https://use.fontawesome.com/b29ce011be.js"></script>

</head>
<body>

<header>
<div id="cardHeader" class="card">
  <div class="card-body">
<div id="logoP">
	<img src="<?php echo IMAGES.'logo.png' ?>" class="card-img-top" alt="MoviePass" width="100%">
   
</div>
<br>
    <h5 id="hHeader" class="card-text">¡Adquiere entradas para ver tu pr&oacute;xima pel&iacute;cula favorita aqu&iacute;!</h5><br>
   

<a type="button" class="btn btn-danger col-5" href="<?php echo FRONT_ROOT ?>Funcion/ShowCartelera#peliculas">
 Comprar
</a>



  </div>
</div>
<br>
<br>
</header>
<div id="video">
<video src="<?php echo VIDEOS.'inicio-2.mp4' ?>" width="100%" autoplay muted loop>
</video>
</div>



<br>
