<br>
    <h2>EDITAR PERFIL</h2><br> 

<div id="" class="row col-12 d-flex justify-content-center">

<form action="<?php echo FRONT_ROOT.'User/Edit/' ?>" method="post">
<div class="form-row">
    <div class="form-group col-md-4">
    <input type="hidden" name="id" value=<?php echo $user->getId() ?> > 
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" name="nombre" value="<?php echo $user->getNombre() ?>" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="form-group col-md-4">
      <label for="apellido">Apellido</label>
      <input type="text" class="form-control" name="apellido" value="<?php echo $user->getApellido() ?>" pattern="[A-Za-z\s]+" title="Únicamente letras" required>
    </div>
    <div class="form-group col-md-4">
      <label for="dni">DNI</label>
      <input type="number" class="form-control" name="dni" value="<?php echo $user->getDni() ?>" min="0" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" value="<?php if($user->getEmail() != 'undefined'){ echo $user->getEmail(); } ?>" required>
    </div>
    <div class="form-group col-md-4">
      <label for="password">Contrase&ntilde;a</label>
      <input type="password" class="form-control" name="password" value="<?php echo $user->getPassword() ?>" required>
    </div>
  </div>
  <input type="hidden" name="esAdmin" value=<?php echo $user->getAdmin() ?> > 
  <input type="hidden" name="idFB" value=<?php echo $user->getIdFB() ?> > 
  <br>
  <div class="form-group col-md-12 d-flex justify-content-center">
  <button type="submit" class="btn btn-danger col-md-4">Guardar Cambios</button>
  </div>
  <br>
</form>
<br><br>
</div>