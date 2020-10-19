<br>
    <h2>PELICULAS DISPONIBLES</h2><br> 

<div id="peliculas" class="row col-12">

 <?php
        foreach($films as $film){
    ?>

  <div class="card col-3">
<br>
<?php if (empty($film->getPoster())) { ?>
  <img class="card-img-top" src="../Views/images/not-available.jpg" alt="Card image cap">

<?php }else{ ?>

<img class="card-img-top" src="<?php echo IMAGENES.$film->getPoster() ?>" alt="Card image cap">

<?php } ?>

  <div class="card-body">

    <h4 class="card-title"><?php echo $film->getTitulo() ?></h4>
<br>
<span>
    <a href="#" class="btn btn-danger col-5">Comprar</a>&#160;

	<a href="<?php echo FRONT_ROOT ?>Films/getInfo/<?php echo $film->getId() ?>" class="btn btn-secondary col-4">+ Info</a>&#160;

<span class="badge badge-secondary col-1" id="estrellasCard"><h5><b>&#160;<?php 

if($film->getPuntuacion()==0) { 
echo "-";
}else{ 
echo $film->getPuntuacion();
}

?> </b><span id="estrellaPelicula">&#9733; </span></h5></span>

</span>
</div>
</div>
<?php
        }
    ?>

 <br><br>
</div>