<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>AGREGAR SALA</h2>
        <br>
        <form action= "<?= FRONT_ROOT ?>Cinema/EditRoom" method="post">

  <div class="form-row">

  <div class="form-group col-md-12">
  <label for="nombreSala">Cine</label>
    <input type="text" class="form-control" value="<?php ?>" name="cinema" readonly>
  </div>
</div>
  <div class="form-row">
    <div class="form-group col-md-8">
    <label for="nombreSala">Nombre</label>
    <input type="text" class="form-control" value="<?php ?>" name="nombre" required>
    </div>
    <div class="form-group col-md-4">
    <label for="capacidad">Capacidad</label>
    <input type="number" class="form-control" value="<?php ?>" name="capacidad" required>
    </div>
  </div>
  <br>
  <button type="submit" class="btn btn-danger">Editar</button>
</form>

      </div>
    </div>
  </main>
</div>