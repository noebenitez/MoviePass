<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>ELIMINAR SALA</h2>
        <br>
        <form>  

        <h6>¿Est&aacute; seguro de que quiere eliminar la sala "<?php echo $room->getNombre() ?>" del cine "<?php echo $cinema->getNombre() ?>"?</h6>
    <br>
        <a href="<?= FRONT_ROOT ?>Room/Remove/<?php echo $id ?>" class="btn btn-danger">Eliminar</a>
        <a href="<?= FRONT_ROOT ?>Room/ShowListView" class="btn btn-secondary">Cancelar</a>
</form>
<br>
      </div>
    </div>
  </main>
</div>