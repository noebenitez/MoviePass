
<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>AGREGAR CINE</h2>
        <br>
        <form action= "<?= FRONT_ROOT ?>Cinema/Add" method="post">
  <div class="form-row">
  
    <div class="form-group col-md-12">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" name="nombre" placeholder="" required>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-12">
    <label for="direccion">Direcci&oacute;n</label>
    <input type="text" class="form-control" name="direccion" placeholder="" required>
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
    <input type="number" class="form-control" name="valorEntrada" min="0" required>
    </div>

  </div>
  <br>
  <button type="submit" class="btn btn-danger">Agregar</button>
</form>
      </div>
    </div>
  </main>
</div>


