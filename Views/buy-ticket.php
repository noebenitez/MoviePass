<br>
<h2>COMPRAR ENTRADA</h2>
<br>

<?php
        foreach($films as $film){
		if($film->getId() == $idFilm) {
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
<br>


	<form>
    <div class="form-group">
    <label for="funcion">Seleccione una funci&oacute;n</label>
    <select class="form-control" id="funcion" required>
      <option>Cine - Sala - Fecha - Horario</option>
        <?php 

        foreach($funciones as $funcion){
            if ($funcion->getIdFilm() == $idFilm){ 
            $room = $roomController->GetOne($funcion->getIdSala());  ?>
              
        <option value="<?=$funcion->getId();?>"> <?= $cinemaController->nombrePorId($room->getIdCine()) . " - " . $room->getNombre() . " - " . $funcion->getFecha() . " - " . $funcion->getHora() ?><option> 
        
        <?php   }
        }
        ?>
     
    </select>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="cantidad">Cantidad</label>
    <input type="number" class="form-control" id="cantidad" placeholder="1">
  </div>
  <div class="form-group col-md-4">
    <label for="total">Total</label>
    <input type="number" class="form-control" id="total" placeholder="$ 200.00" readonly>
  </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-12">
  <label for="pago">Medios de Pago</label>
  </div>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="visa" value="visa">
  <label class="form-check-label" for="visa"><img src="<?php echo IMAGES.'visa.png' ?>" style="width: 60px;" /></label>&#160;
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="master" value="master">
  <label class="form-check-label" for="master">&#160;<img src="<?php echo IMAGES.'master.png' ?>" style="width: 50px;" /></label>
</div>
</div>
<br>
<div class="form-row">
  <div class="form-group col-md-12">
    <label for="titular">Titular</label>
    <input type="text" class="form-control" id="titular" placeholder="">
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-8">
    <label for="nroTarjeta">Nro. de Tarjeta</label>
    <input type="number" class="form-control" id="nroTarjeta" placeholder="">
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-8">
    <label for="vencimiento">Vencimiento</label>
    <input type="month" class="form-control" id="vencimiento" placeholder="">
  </div>
  <div class="form-group col-md-4">
    <label for="codSeguridad">CVV/CVC</label>
    <input type="number" class="form-control" id="codSeguridad" placeholder="">
  </div>
  </div>
  </form>
        <br>
      <a href="#" class="btn btn-danger col-md-4">Confirmar Compra</a>
      <br><br>
        </div>
    </div> 
 
<?php
		}
	}
    ?>

