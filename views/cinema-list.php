<?php 
 include('header.php');
 include('nav-admin.php');
?>

<style>

table, th, td {
  border: 1px solid black;
} 

</style>

<div>
  <main class="hoc container clear"> 
    <!-- main body -->
    <div>

    <h2>LISTADO DE CINES</h2>

      <div>

      <form method="post">
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style="width: 10%;">Id</th>
              <th style="width: 25%;">Nombre</th>
              <th style="width: 25%;">Dirección</th>
              <th style="width: 10%;">Hora de apertura</th>
              <th style="width: 10%;">Hora de cierre</th>
              <th style="width: 15%;">Valor de entrada</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($cinemaList as $cinema){ ?>
            
            <tr>
              <td> <?= $cinema->getId(); ?> </td>
              <td> <?= $cinema->getNombre(); ?> </td>
              <td> <?= $cinema->getDireccion(); ?> </td>
              <td> <?= $cinema->getHoraApertura(); ?> </td>
              <td> <?= $cinema->getHoraCierre(); ?> </td>
              <td> <?= $cinema->getvalorEntrada(); ?> </td>
              <td>
                <button type="submit" name='edit' class="btn btn-primary" value="<?= $cinema->getId()?>" formaction="<?= FRONT_ROOT ?> Cinema/ShowEditView"> Editar </button>
              </td>
              <td>
                <button type="submit" name='remove' class="btn btn-primary" value="<?= $cinema->getId()?>" formaction="<?=FRONT_ROOT ?> Cinema/Remove"> Eliminar </button> 
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

<?php 
  include('footer.php');
?>