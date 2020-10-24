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
    <select class="form-control" name="funcion">
      <option>Cine - Sala - Fecha - Horario</option>
     
    </select>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="cantidad">Cantidad</label>
    <input type="number" class="form-control" name="cantidad" value="1">
  </div>
  <div class="form-group col-md-4">
    <label for="total">Total</label>
    <input type="number" class="form-control" name="total" placeholder="$ 200.00" readonly>
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
    <input type="text" class="form-control" name="titular" placeholder="" required>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-8">
    <label for="nroTarjeta">Nro. de Tarjeta</label>
    <input type="number" class="form-control" name="nroTarjeta" placeholder="" required>
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

