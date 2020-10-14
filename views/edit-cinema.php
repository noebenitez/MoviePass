<?php 
 include('header.php');
 include('nav-admin.php');
?>

<div class="wrapper row4">
<main class="container clear"> 
    <div class="content"> 
      <div id="comments" >
        <h2>EDITAR CINEMA</h2>

      <?php

      ?>

        <form action= "<?= FRONT_ROOT ?>Cinema/Edit" method="post"  style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Hora de apertura</th>
                <th>Hora de cierre</th>
                <th>Valor de la entrada</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="max-width: 100px;">
                  <input type="number" name="id" min="1" max="999" size="30" value= <?= $cinema->getId() ?> readonly>
                </td>
                <td>
                  <input type="text" name="nombre" size="20" value = "<?= $cinema->getNombre() ?>" required>
                </td>
                <td>
                  <input type="text" name="direccion" size="20" value = "<?= $cinema->getDireccion() ?>" required>
                </td>     
                <td>
                  <input type="time" name="horaApertura" size="10" value = <?= $cinema->getHoraApertura() ?> required>
                </td>         
                <td>
                  <input type="time" name="horaCierre" size="10" value = <?= $cinema->getHoraCierre() ?> required>
                </td>         
                <td>
                  <input type="number" name="valorEntrada" size="10" value = <?= $cinema->getValorEntrada() ?> required>
                </td>         
              </tr>
              </tbody>
          </table>
          <div>
            <input type="submit" class="btn" value="Editar" style="background-color:#DC8E47;color:white;"/>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>


<?php 
  include('footer.php');
?>