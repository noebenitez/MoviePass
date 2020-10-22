
<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>AGREGAR CINE</h2>
        <br>
        <form action= "<?= FRONT_ROOT ?>Cinema/Add" method="post">
  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="id">ID</label>
      <input type="number" class="form-control" name="id" min="1" max="999" placeholder="" required>
      
    </div>
    <div class="form-group col-md-10">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" name="nombre" placeholder="" required>
    </div>
  </div>
  <div class="form-row">
<<<<<<< Updated upstream
  <div class="form-group col-md-12">
    <label for="direccion">Direcci&oacute;n</label>
    <input type="text" class="form-control" name="direccion" placeholder="" required>
=======
  <div class="form-group col-md-8">
    <label for="calle">Calle</label>
    <input type="text" class="form-control" name="calle" placeholder="" required>
  </div>
  <div class="form-group col-md-4">
    <label for="altura">Altura</label>
    <input type="number" class="form-control" name="altura" placeholder="" min="0" max="9999" required>
>>>>>>> Stashed changes
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
    <label for="horaApertura">Hora de Apertura</label>
    <input type="time" class="form-control" name="horaApertura" required>
    </div>
    <div class="form-group col-md-4">
    <label for="horaCierre">Hora de Cierre</label>
    <input type="time" class="form-control" name="horaCierre" required>
    </div>
    <div class="form-group col-md-4">
    <label for="valorEntrada">Valor de la Entrada</label>
    <input type="number" class="form-control" name="valorEntrada" required>
    </div>

  </div>
  <br>
 
  <button type="submit" class="btn btn-danger">Agregar</button>
</form>

      </div>
    </div>
  </main>
</div>


