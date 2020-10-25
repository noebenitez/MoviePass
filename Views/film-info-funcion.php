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

     
    <br><a href="<?php echo FRONT_ROOT ?>Funcion/ShowAddView/ <?php echo $film->getId() ?>" class="btn btn-danger"><i class="fa fa-ticket"></i>&#160;&#160;Agregar Función</a>&#160;&#160;
   
      
<br><br>
        </div>
    </div> 
 
<?php
		}
	}
    ?>



