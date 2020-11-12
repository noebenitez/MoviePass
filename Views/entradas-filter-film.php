
<div>
  <main class="hoc container clear"> 
    <!-- main body -->
    <div>
<br>
    <h2>DISPONIBILIDAD DE ENTRADAS</h2>
<br>
<h5><?php echo $pelicula->getTitulo() ?></h5>
<br>
      <div>

      <form method="post">
      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Funci&oacute;n</th>
      <th scope="col">Capacidad Total</th>
      <th scope="col">Entradas Vendidas</th>
      <th scope="col">Entradas Disponibles</th>
     
    </tr>
  </thead> 
  <tbody>
    <?php foreach ($funcionesXpelicula as $funcionCine){ 
            $roomCine = $this->roomDAO->GetOne($funcionCine->getIdSala());
            $nombreCine = $this->cinemaDAO->nombrePorId($roomCine->getIdCine());
            ?>
            <tr>
              <td> <?php echo $nombreCine . " - " . $roomCine->getNombre() . " - " . $funcionCine->getFecha() . " - " . $funcionCine->getHora() ?> </td>
              <td> <?php echo $roomCine->getCapacidad() ?> </td>
              <td> <?php echo $funcionCine->getEntradasVendidas() ?> </td>
              <td> <?php echo $roomCine->getCapacidad()-$funcionCine->getEntradasVendidas() ?> </td>

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

