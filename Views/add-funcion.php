
<div>
  <main class="container clear"> 
    <div> 
      <div id="comments" >
        <br>
        <h2>AGREGAR FUNCION</h2>
        <br>
        <h3><?= $film->getTitulo();?></h3>
        <br>

        <form action= "<?= FRONT_ROOT ?>Funcion/Add" method="post">

          <input type="hidden" name="idFilm" value=<?= $film->getId() ?> > 

          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="room">Seleccionar la Sala</label>
              <select class="form-control" id="idSala" name="idSala" required>
              <?php 
                foreach($rooms as $room) {
                  if($cinemaController->nombrePorId($room->getIdCine()) != ''){ 
              ?>
              <option value="<?php echo $room->getId() ?>"> <?php echo $cinemaController->nombrePorId($room->getIdCine()) . " - " .  $room->getNombre(); ?> </option>
                <?php }} ?>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="fecha">Fecha</label>
              <input type="date" class="form-control" name="fecha" min= <?=date('Y-m-d')?> required>
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-4">
              <label for="hora">Hora</label>
              <input type="time" class="form-control" name="hora" required>
            </div>

            <div class="form-group col-md-4">
              <label for="duracion">Duración en Minutos</label>
              <input type="number" class="form-control" name="duracion" value="<?= $duracionFilm ?>" readonly>
            </div>

            <div class="form-group col-md-4">
              <label for="duracion">Valor Entrada</label>
              <input type="number" class="form-control" name="valorEntrada" min = "0" required>
            </div>

          </div>

          <br>
          <button type="submit" class="btn btn-danger">Agregar</button>

        </form>

      </div>
    </div>
  </main>
</div>