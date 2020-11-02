<br>
<h2>CONFIRMAR COMPRA</h2>
<br>

<?php
        foreach($films as $film){
		if($film->getId() == $idFilm) {
?>

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

	<form method="post" action="<?php echo FRONT_ROOT ?>/Compra/compraConfirmada">

  <input type="hidden" class="form-control" name="idFilm" value="<?php echo $idFilm ?>">
  <input type="hidden" class="form-control" name="idFuncion" value="<?php echo $idFuncion ?>">
  <input type="hidden" class="form-control" name="cantidad" value="<?php echo $cantidad ?>">
  <input type="hidden" class="form-control" name="total" value="<?php echo $total?>">
  <input type="hidden" class="form-control" name="nroTarjeta" value="<?php echo $nroTarjeta ?>">
  <input type="hidden" class="form-control" name="titular" value="<?php echo $titular ?>">
  <input type="hidden" class="form-control" name="vencimiento" value="<?php echo $vencimiento ?>">
  <input type="hidden" class="form-control" name="codSeguridad" value="<?php echo $codSeguridad?>">
  <input type="hidden" class="form-control" name="email" value="<?php echo $email ?>">
  <input type="hidden" class="form-control" name="empresa" value="<?php echo $empresa ?>">


    <div class="form-group">
    <?php foreach($funciones as $funcion){ 
              if($funcion->getId() == $idFuncion){
                $room = $roomDAO->GetOne($funcion->getIdSala());      
      ?>
        <label for="funcion"><b>Funci&oacute;n:</b> &#160;<?php echo $cinemaDAO->nombrePorId($room->getIdCine()) . " - " . $room->getNombre() . " - " . $funcion->getFecha() . " - " . $funcion->getHora() ?></label> 
        
    <?php } } ?>

  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="cantidad" ><b>Cantidad:</b> &#160;<?php echo $cantidad ?></label>
  </div>
  <div class="form-group col-md-4">
    <label for="total" ><b>Total:</b> &#160;<?php echo $total ?></label>
  </div>
  </div> 

  <div class="form-row">
  <div class="form-group col-md-10">
  <label for="pago" ><b>Medio de Pago:</b> &#160;Tarjeta de Cr&eacute;dito <?php echo $empresa ?></label>

 </div> </div>
 <div class="form-row">
<div class="form-group col-md-8">
    <label for="nroTarjeta" ><b>Nro. de Tarjeta:</b> &#160;<?php echo $nroTarjeta ?></label>
  </div></div>


<div class="form-row">
  <div class="form-group col-md-12">
    <label for="titular" ><b>Titular:</b> &#160;<?php echo $titular ?></label>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="vencimiento" ><b>Vencimiento:</b> &#160;<?php echo $vencimiento ?></label>

  </div>
  <div class="form-group col-md-4">
    <label for="codSeguridad" ><b>CVV/CVC:</b> &#160;<?php echo $codSeguridad ?></label>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-12">
    <label for="email" ><b>Enviar a:</b> &#160;<?php echo $email ?></label>
  </div>
  </div>
  <br>
      <button type="submit" class="btn btn-danger col-md-4">Confirmar Compra</button>
      <a href="<?php echo FRONT_ROOT ?>Compra/BuyTicket/<?php echo $idFilm ?>" class="btn btn-secondary col-md-3">Cancelar</a>
  </form>
  
      <br>
        </div>
    </div> 
 
<?php
		}
	}
    ?>