<div>
  <main class="hoc container clear"> 
    <!-- main body -->
    <div>
<br>
    <h2>LISTADO DE SALAS</h2>
<br>
      <div>

      <form method="post">
      <?php foreach ($cinemaList as $cinema){
        ?>
      <h5><?php echo $cinema->getNombre(); ?></h5><br>
      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Capacidad</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>   
  <?php foreach ($roomList as $room){ 
        if($cinema->getId() == $room->getIdCine()){
    ?>
            <tr>
              <td> <?php echo $room->getNombre(); ?> </td>
              <td> <?php echo $room->getCapacidad(); ?> </td>
              <td>
                <button type="submit" name='edit' class="btn btn-danger" value="<?php echo $room->getId(); ?>" formaction="<?=FRONT_ROOT ?> ../Room/ShowEditView"> Editar </button>
                <button type="submit" name='remove' class="btn btn-secondary" value="<?php echo $room->getId(); ?>" formaction="<?=FRONT_ROOT ?> ../Room/ShowRemoveView"> Eliminar </button> 
              </td>
            </tr>

            <?php } } ?>
  </tbody>
</table>
<hr><br>
<?php } ?><br>
</form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
