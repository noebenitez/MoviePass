<br>
    <h2>REGISTRARSE</h2><br> 

<div id="" class="row col-12 d-flex justify-content-center">

<form action="<?php echo FRONT_ROOT.'Login/signin' ?>" method="post">
<div class="form-row">
    <div class="form-group col-md-4">
      <label for="nombre">Nombre</label>
      <!-- El atributo pattern indica que solo se aceptan letras y espacios -->
      <input type="text" class="form-control" name="nombre" placeholder="" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="form-group col-md-4">
      <label for="apellido">Apellido</label>
      <input type="text" class="form-control" name="apellido" placeholder="" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="form-group col-md-4">
      <label for="dni">DNI</label>
      <input type="number" class="form-control" name="dni" placeholder="" min="0" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" placeholder="" required>
    </div>
    <div class="form-group col-md-4">
      <label for="password">Contrase&ntilde;a</label>
      <input type="password" class="form-control" name="password" placeholder="" required>
    </div>
  </div>
  <br>
  <div class="form-group col-md-12 d-flex justify-content-center">
  <button type="submit" class="btn btn-danger col-md-4">Crear Cuenta</button>
  </div>
  <br>
</form>
<br><br>
</div>