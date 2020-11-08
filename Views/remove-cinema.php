<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>ELIMINAR CINE</h2>
        <br>
        <form> 

        <h6>¿Est&aacute; seguro de que quiere eliminar el cine "<?php echo $cinema->getNombre() ?>"?</h6>
    <br>
        <a href="<?= FRONT_ROOT ?>Cinema/Remove/<?php echo $id ?>" class="btn btn-danger">Eliminar</a>
        <a href="<?= FRONT_ROOT ?>Cinema/ShowListView" class="btn btn-secondary">Cancelar</a>
</form>
<br>
      </div>
    </div>
  </main>
</div>
