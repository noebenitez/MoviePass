<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>EDITAR SALA</h2>
        <br>
        <form action= "<?php FRONT_ROOT ?>../Room/Edit" method="post">

  <div class="form-row">

  <input type="hidden" name="id" value=<?php echo $room->getId() ?> > 

  <div class="form-group col-md-12">
  <label for="nombreSala">Cine</label>
    <input type="text" class="form-control" value="<?php echo $cinema->getNombre() ?>" placeholder="" readonly>
    <input type="hidden" name="idCine" value=<?php echo $room->getIdCine() ?> >
  </div>
</div>
  <div class="form-row">
    <div class="form-group col-md-8">
    <label for="nombreSala">Nombre</label>
    <input type="text" class="form-control" value="<?php echo $room->getNombre() ?>" name="nombre" pattern="[A-Za-z0-9\s]+" title="Únicamente letras y números" required>
    </div>
    <div class="form-group col-md-4">
    <label for="capacidad">Capacidad</label>
    <input type="number" class="form-control" value="<?php echo $room->getCapacidad() ?>" name="capacidad" min="0" required>
    </div>
  </div>
  
  </div>
  <br>
  <button type="submit" class="btn btn-danger">Editar</button>
</form>

      </div>
    </div>
  </main>
</div>