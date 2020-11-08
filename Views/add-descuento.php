<div>
  <main class="container clear"> 
    <div> 
      <div id="comments" >
        <br>
        <h2>AGREGAR DESCUENTO</h2>
        <br>
        <form action= "<?= FRONT_ROOT ?>Descuento/Add" method="post">

          <div class="form-row">

            <div class="form-group col-md-4">
              <label for="dia">Seleccione el D&iacute;a</label>
              <select class="form-control" name="dia" required>
            
              <option value="Monday">Lunes</option>
              <option value="Tuesday">Martes</option>
              <option value="Wednesday">Mi&eacute;rcoles</option>
              <option value="Thursday">Jueves</option>
              <option value="Friday">Viernes</option>
              <option value="Saturday">S&aacute;bado</option>
              <option value="Sunday">Domingo</option>
              
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="porcentaje">Porcentaje</label>
              <input type="number" class="form-control" name="porcentaje" min="0" required>
            </div>

            <div class="form-group col-md-4">
              <label for="cantidad">Cantidad M&iacute;nima de Entradas</label>
              <input type="number" class="form-control" name="cantidad" min="0" required>
            </div>
          </div>

          <div class="form-row">

            <div class="form-group col-md-12">
              <label for="descripcion">Descripci&oacute;n</label>
              <input type="text" class="form-control" name="descripcion" required>
            </div>
          </div>

          <br>
          <button type="submit" class="btn btn-danger">Agregar</button>
        </form>

      </div>
    </div>
  </main>
</div>