<div>
<main class="container clear"> 
    <div> 
      <div id="comments" >
      <br>
        <h2>ELIMINAR DESCUENTO</h2>
        <br>
        <form> 

<?php 
switch($descuento->getDia()){
    case 'Monday':
         $dia = 'Lunes';
         break;
    case 'Tuesday':
         $dia = 'Martes';
         break;
    case 'Wednesday':
         $dia = 'Mi&eacute;rcoles';
         break;
    case 'Thursday':
         $dia = 'Jueves';
         break;
    case 'Friday':
         $dia = 'Viernes';
         break;
    case 'Saturday':
         $dia = 'S&aacute;bado';
         break;
    case 'Sunday':
         $dia = 'Domingo';
         break;
} 
?>

        <h6>¿Est&aacute; seguro de que quiere eliminar el descuento "<?php echo '-'.$descuento->getPorcentaje().'% el d&iacute;a '.$dia.' comprando '.$descuento->getCantidadMinima().' o m&aacute;s entradas';?>"?</h6>
    <br>
        <a href="<?= FRONT_ROOT ?>Descuento/Remove/<?php echo $id ?>" class="btn btn-danger">Eliminar</a>
        <a href="<?= FRONT_ROOT ?>Descuento/ShowListView" class="btn btn-secondary">Cancelar</a>
</form>
<br>
      </div>
    </div>
  </main>
</div>