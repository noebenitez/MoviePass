

<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>EDITAR CINE</h2>
<br>
      <?php

      ?>

        <form action= "<?= FRONT_ROOT ?>Cinema/Edit" method="post">
  <div class="form-row">
    
    <!-- Un input tipo hidden hace que al usuario no le aparezca el campo, pero al momento de enviar al action también manda
    este valor. Lo uso para buscar el cine que hay que actualizar por id -->

    <input type="hidden" name="id" value=<?= $cinema->getId() ?> > 
    

    <div class="form-group col-md-12">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" name="nombre" value="<?= $cinema->getNombre() ?>" required>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="calle">Calle</label>
    <input type="text" class="form-control" name="calle" value="<?= $cinema->getCalle() ?>" required>
  </div>
  <div class="form-group col-md-6">
    <label for="altura">Altura</label>
    <input type="number" class="form-control" name="altura" value="<?= $cinema->getAltura() ?>" min="0" max="9999" required>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="horaApertura">Hora de Apertura</label>
    <input type="time" class="form-control" name="horaApertura" value="<?= $cinema->getHoraApertura() ?>" required>
    </div>
    <div class="form-group col-md-6">
    <label for="horaCierre">Hora de Cierre</label>
    <input type="time" class="form-control" name="horaCierre" value="<?= $cinema->getHoraCierre() ?>" required>
    </div>

  </div>
  <br>
  <button type="submit" class="btn btn-danger">Editar</button>
</form>
      </div>
    </div>
  </main>
</div>


