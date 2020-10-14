    
 <br>
    <h2>PELICULAS</h2>
    <div class="container-fluid">
        <div id="peliculas" class="row col-12">
    <?php
        foreach($films as $film){
    ?>
    <div class="card col-2" style="width: 18rem;">
        <img src="<?php echo IMAGENES.$film->getPoster() ?>" class="card-img-top" alt="..." style="width: 9rem;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $film->getTitulo() ?></h5>
          <p class="card-text"><b>Puntuaci&oacute;n: </b><?php echo $film->getPuntuacion() ?></p>
          <a href="<?php echo FRONT_ROOT ?>Films/getInfo/<?php echo $film->getId() ?>" class="btn btn-primary">M&aacute;s informaci&oacute;n</a>
        </div>
    </div>
    <?php
        }
    ?>
    </div>
    </div>

