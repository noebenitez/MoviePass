<div>
  <main class="container clear"> 
    <div> 
      <div id="comments" >
<br>
<?php
    if(isset($desde) && isset($hasta)){
        echo "<h2> Recaudación Período " . date("d/m/y", strtotime($desde)) . " / " . date("d/m/y", strtotime($hasta)) . "</h2>";
    }else{
        echo "<h2> Recaudación Total </h2> ";
    }
?>
<br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Recaudaci&oacute;n</th>
    </tr>
  </thead> 
  <tbody> 
            <tr>
              <td> <?= $film->getTitulo(); ?> </td>
              <td> <?="$ " . $recaudacion ?></td>
            </tr>
  </tbody>
</table> 
</div>
    </div>
  </main>
</div>  
           