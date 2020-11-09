
<br>
<?php
    if(isset($desde) && isset($hasta)){
        echo "<h2> Recaudación período " . $desde . " / " .$hasta . "</h2>";
    }else{
        echo "<h2> Recaudación total </h2> ";
    }
?>
<br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Direcci&oacute;n</th>
      <th scope="col">Capacidad Total</th>
      <th scope="col">Recaudación</th>
    </tr>
  </thead> 
  <tbody> 
            <tr>
              <td> <?= $cinema->getNombre(); ?> </td>
              <td> <?php echo $cinema->getCalle() . " " . $cinema->getAltura();?> </td>
              <td> <?= $cinema->getCapacidad(); ?> </td>
              <td> <?="$ " . $recaudacion ?></td>
            </tr>
  </tbody>
</table>