<br>
<h2>NO PUEDE REALIZARSE LA COMPRA</h2>
<br>

<div class="card flex-row flex-wrap">
    <div class="card-header border-0 col-4">
        <?php if (empty($film->getPoster())) { ?>
        <img class="card-img-top" src="<?php echo IMAGES ?>not-available.jpg" alt="Card image cap">

        <?php }else{ ?>

        <img class="card-img-top" src="<?php echo IMAGENES.$film->getPoster() ?>" alt="Card image cap">

        <?php } ?>
    </div>
    <div class="card-block px-2 col-7"><br>
        <h3 class="card-title"><?php echo $film->getTitulo() ?></h3>
        <br>

        <div class="form-group">
            <?php
            $room = $this->roomDAO->GetOne($funcion->getIdSala());      
            ?>
            <label for="funcion"><b>Funci&oacute;n:</b> &#160;<?php echo $this->cinemaDAO->nombrePorId($room->getIdCine()) . " - " . $room->getNombre() . " - " . $funcion->getFecha() . " - " . $funcion->getHora() ?></label> 

        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
            <label for="error" ><b>Error: La cantidad de entradas disponibles para esta función es de <?=$entradasDisponibles?> por lo que no puede completarse la compra de las <?=$cantidad?> entradas ingresadas.</b> &#160;</label>
        </div>

        <br>
        <a href="<?php echo FRONT_ROOT ?>Compra/BuyTicket/<?php echo $idFilm ?>" class="btn btn-secondary col-md-3">Cancelar</a>
        <br>
        

    </div>
</div> 