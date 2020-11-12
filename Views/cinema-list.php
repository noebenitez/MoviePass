
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
      <th scope="col">Nombre</th>
      <th scope="col">Direcci&oacute;n</th>
      <th scope="col">Hora de Apertura</th>
      <th scope="col">Hora de Cierre</th>
      <!--<th scope="col">Capacidad Total</th>-->
      <th scope="col">Opciones</th>
    </tr>
  </thead> 
  <tbody>
    <?php foreach ($cinemaList as $cinema){ ?>
            
            <tr>
              <td> <?= $cinema->getNombre(); ?> </td>
              <td> <?php echo $cinema->getCalle() . " " . $cinema->getAltura();?> </td>
              <td> <?= date("h:i A", strtotime($cinema->getHoraApertura())); ?> </td>
              <td> <?= date("h:i A", strtotime($cinema->getHoraCierre())); ?> </td>
              <!--<td>  $cinema->getCapacidad();  </td>-->
              <td>
                <button type="submit" name='edit' class="btn btn-danger" value="<?= $cinema->getId()?>" formaction="<?= FRONT_ROOT ?> Cinema/ShowEditView"> Editar </button>
                <button type="submit" name='remove' class="btn btn-secondary" value="<?= $cinema->getId()?>" formaction="<?=FRONT_ROOT ?> Cinema/ShowRemoveView"> Eliminar </button> 
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

