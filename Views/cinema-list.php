
<div>
  <main class="hoc container clear"> 
    <!-- main body -->
    <div>
<br>
    <h2>LISTADO DE CINES</h2>
<br>
      <div>

      <form method="post">
      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Direcci&oacute;n</th>
      <th scope="col">Hora de Apertura</th>
      <th scope="col">Hora de Cierre</th>
      <th scope="col">Valor de la Entrada</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cinemaList as $cinema){ ?>
            
            <tr>
            <th scope="row"> <?= $cinema->getId(); ?> </th>
              <td> <?= $cinema->getNombre(); ?> </td>
              <td> <?= $cinema->getDireccion(); ?> </td>
              <td> <?= $cinema->getHoraApertura(); ?> </td>
              <td> <?= $cinema->getHoraCierre(); ?> </td>
              <td> <?= $cinema->getvalorEntrada(); ?> </td>
              <td>
                <button type="submit" name='edit' class="btn btn-danger" value="<?= $cinema->getId()?>" formaction="<?= FRONT_ROOT ?> Cinema/ShowEditView"> Editar </button>
                <button type="submit" name='remove' class="btn btn-secondary" value="<?= $cinema->getId()?>" formaction="<?=FRONT_ROOT ?> Cinema/Remove"> Eliminar </button> 
              </td>
            </tr>

          <?php } ?>
  </tbody>
</table></form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

