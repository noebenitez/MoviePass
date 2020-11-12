<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>ELIMINAR FUNCION</h2>
        <br>
        <form> 

        <h6>¿Est&aacute; seguro de que quiere eliminar la funci&oacute;n "<?php echo $film->getTitulo().' - '.$cinema->getNombre().' - '.$room->getNombre().' - '.date("d/m/y", strtotime($funcion->getFecha())).' - '.$funcion->getHora() ?>"?</h6>
    <br>
        <a href="<?= FRONT_ROOT ?>Funcion/Remove/<?php echo $id ?>" class="btn btn-danger">Eliminar</a>
        <a href="<?= FRONT_ROOT ?>Funcion/ShowListView" class="btn btn-secondary">Cancelar</a>
</form>
<br>
      </div>
    </div>
  </main>
</div>