<div>
  <main class="hoc container clear"> 
    <!-- main body -->
    <div>
<br>
    <h2>LISTADO DE DESCUENTOS</h2>
<br>
      <div>

      <form method="post">
      <table  class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Porcentaje</th>
      <th scope="col">D&iacute;a</th>
      <th scope="col">Cantidad M&iacute;nima de Entradas</th>
      <th scope="col" style="max-width: 400px;">Descripci&oacute;n</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>   
  <?php foreach ($descuentosList as $descuento){ 
    ?>
            <tr>
              <td> <?php echo $descuento->getPorcentaje() ?> </td>
              <td> <?php 
               switch($descuento->getDia()){
                   case 'Monday':
                        echo 'Lunes';
                        break;
                   case 'Tuesday':
                        echo 'Martes';
                        break;
                   case 'Wednesday':
                        echo 'Mi&eacute;rcoles';
                        break;
                   case 'Thursday':
                        echo 'Jueves';
                        break;
                   case 'Friday':
                        echo 'Viernes';
                        break;
                   case 'Saturday':
                        echo 'S&aacute;bado';
                        break;
                   case 'Sunday':
                        echo 'Domingo';
                        break;
               } 
              ?> </td>
              <td> <?php echo $descuento->getCantidadMinima(); ?> </td>
              <td style="max-width: 400px;"> <?php echo $descuento->getDescripcion(); ?> </td>
              
              <td>
                <button type="submit" name='edit' class="btn btn-danger" value="<?php echo $descuento->getId(); ?>" formaction="<?php FRONT_ROOT ?>../Descuento/ShowEditView"> Editar </button>
                <button type="submit" name='remove' class="btn btn-secondary" value="<?php echo $descuento->getId(); ?>" formaction="<?php FRONT_ROOT ?>../Descuento/ShowRemoveView"> Eliminar </button> 
              </td>
            </tr>

            <?php } ?>
  </tbody>
</table>


</form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
