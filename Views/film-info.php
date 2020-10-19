<br>
<h2>INFORMACION</h2>
<br>

<?php
        foreach($films as $film){
		if($film->getId() == $id) {
?>

 <div class="card flex-row flex-wrap">
        <div class="card-header border-0 col-4">
            <?php if (empty($film->getPoster())) { ?>
  <img class="card-img-top" src="../Views/images/not-available.jpg" alt="Card image cap">

<?php }else{ ?>

<img class="card-img-top" src="<?php echo IMAGENES.$film->getPoster() ?>" alt="Card image cap">

<?php } ?>
        </div>
        <div class="card-block px-2 col-7"><br>
            <h3 class="card-title"><?php echo $film->getTitulo() ?></h3>
            <h5 class="card-text"><?php echo $film->getTituloOriginal() ?></h5>
	    <p class="card-text">
<nav aria-label="breadcrumb" class="" style="display: inline-block;">
        <ol class="breadcrumb"  id="datosPeli">
<?php 
switch ($film->getIdiomaOriginal()) {
case "es":
echo "Espa&ntilde;ol";
break;
case "en":
echo "Ingl&eacute;s";
break;
default:
echo "-";
break;
} 
?> &#160;|&#160;&#160;

<?php 
      foreach($genres as $genre){
	      foreach($film->getGeneros() as $genreFilm){
		
        if ($genre->getId() == $genreFilm) { ?>
		      <li class="breadcrumb-item"><a href="<?php echo FRONT_ROOT ?>Films/getFilmsByGenres/<?php echo $genre->getId() ?>" class="generos"><?php echo $genre->getNombre() ?></a></li> <?php
}}}
 ?>&#160;&#160;|&#160; 
<?php echo $film->getFechaEstreno() ?></p></ol>
    </nav>
	    <p class="card-text"><?php echo $film->getDescripcion() ?></p>
	    <p class="card-text"><b>Puntuaci&oacute;n</b></p>
<span id="puntuacion" class=" col-12">
<span class="badge badge-secondary puntuacion col-1" id="estrellasCard"><h5><b>&#160;<?php 

if($film->getPuntuacion()==0) { 
  echo "-";
  }else{ 
  echo $film->getPuntuacion();
  }

?> </b><span id="estrellaPelicula">&#9733; </span></h5></span>


<form id="puntuacionEstr">
  <p class="clasificacion">
    <input id="radio1" type="radio" name="estrellas" value="5"><!--
    --><label for="radio1">&#9733;</label><!--
    --><input id="radio2" type="radio" name="estrellas" value="4"><!--
    --><label for="radio2">&#9733;</label><!--
    --><input id="radio3" type="radio" name="estrellas" value="3"><!--
    --><label for="radio3">&#9733;</label><!--
    --><input id="radio4" type="radio" name="estrellas" value="2"><!--
    --><label for="radio4">&#9733;</label><!--
    --><input id="radio5" type="radio" name="estrellas" value="1"><!--
    --><label for="radio5">&#9733;</label>
  </p>
</form></span>

            <br><a href="#" class="btn btn-danger">Comprar</a><br><br>
        </div>
    </div>
 
<?php
		}
	}
    ?>

