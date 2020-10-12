<?php 
 include('header.php');
 include('nav-bar.php');
?>
<!-- ################################################################################################ -->
<div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/1.png');">
  <div class="overlay">
    <div id="breadcrumb" class="clear"> 
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Add</a></li>
        <li><a href="#">List - Remove</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">

      <form method="post">
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style="width: 15%;">Id</th>
              <th style="width: 30%;">Nombre</th>
              <th style="width: 30%;">Dirección</th>
              <th style="width: 15%;">Hora de apertura</th>
              <th style="width: 10%;">Hora de cierre</th>
              <th style="width: 10%;">Valor de entrada</th>
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
                <button type="submit" name='edit' class="btn" value="<?= $cinema->getId()?>" formaction="<?= FRONT_ROOT ?> Cinema/ShowEditView"> Editar </button>
              </td>
              <td>
                  <button type="submit" name='remove' class="btn" value="<?= $cinema->getId()?>" formaction="<?=FRONT_ROOT ?> Cinema/Remove"> Remove </button> 
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