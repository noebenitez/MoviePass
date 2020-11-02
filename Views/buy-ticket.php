<br>
<h2>COMPRAR ENTRADAS</h2>
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

	<form method="post" action="<?php echo FRONT_ROOT ?>/Compra/ShowConfirmView">
    <div class="form-group">

    <input type="hidden" class="form-control" name="idFilm" value="<?php echo $film->getId() ?>">

    <label for="funcion">Seleccione una funci&oacute;n</label>

    <select class="form-control" name="idFuncion">
    <?php foreach($funciones as $funcion){ 
              if($funcion->getIdFilm() == $idFilm){
                $room = $roomDAO->GetOne($funcion->getIdSala());      
      ?>
        <option value="<?php echo $funcion->getId();?>"><?php echo $cinemaDAO->nombrePorId($room->getIdCine()) . " - " . $room->getNombre() . " - " . $funcion->getFecha() . " - " . $funcion->getHora() ?></option> 
        
    <?php } } ?>
    </select>

  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="cantidad">Cantidad</label>
    <input type="number" class="form-control" name="cantidad" value="1">
  </div>
  <div class="form-group col-md-4">
    <label for="total">Total</label>
    <input type="number" class="form-control" name="total" value="200" readonly>
  </div>
  </div> 

  <div class="form-row">
  <div class="form-group col-md-4">
  <label for="pago">Medios de Pago</label>
 
  <div class="input-group">
  &#160;&#160;&#160;&#160;
  <input class="form-check-input" type="hidden" id="visa" value="visa">
  <label class="form-check-label" for="visa"><img src="<?php echo IMAGES.'visa.png' ?>" style="width: 60px; margin-top: 8px;" /></label>
  &#160;&#160;&#160;&#160;&#160;
  <input class="form-check-input" type="hidden" id="master" value="master">
  <label class="form-check-label" for="master"><img src="<?php echo IMAGES.'master.png' ?>" style="width: 45px; margin-top: 5px;" /></label>
 </div> </div>

<div class="form-group col-md-8">
    <label for="nroTarjeta">Nro. de Tarjeta</label>
    <input type="number" class="form-control" name="nroTarjeta" placeholder="" required>
  </div>

</div>

<div class="form-row">
  <div class="form-group col-md-12">
    <label for="titular">Titular</label>
    <input type="text" class="form-control" name="titular" placeholder="" required>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-8">
    <label for="vencimiento">Vencimiento</label>
    <input type="month" class="form-control" name="vencimiento" placeholder="" required>
  </div>
  <div class="form-group col-md-4">
    <label for="codSeguridad">CVV/CVC</label>
    <input type="number" class="form-control" name="codSeguridad" placeholder="" required>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-12">
    <label for="email">Enviar a </label>
    <input type="text" class="form-control" name="email" value="<?php if($_SESSION['email'] != 'undefined') {echo $_SESSION['email'];} ?>" required>
  </div>
  </div>
  <br>
      <button type="submit" class="btn btn-danger col-md-4">Comprar Entradas</button>
      <a href="<?php echo FRONT_ROOT ?>Funcion/ShowCartelera" class="btn btn-secondary col-md-3">Cancelar</a>
  </form>
      
      <br>
        </div>
    </div> 
 
<?php
		}
	}
    ?>

   

