
<br>
<h2>INFORMACION</h2>
<br>

<?php
        foreach($films as $film){
		if($film->getId() == $id) {
?>
<table class="table table-sm">
  <tbody>
    <tr>
      <td>Titulo Original</td>
      <td><?php echo $film->getTituloOriginal() ?></td>
    </tr>
    <tr>
      <td>Titulo</td>
      <td><?php echo $film->getTitulo() ?></td>
    </tr>
    <tr>
      <td>Idioma Original</td>
      <td><?php echo $film->getIdiomaOriginal() ?></td>
    </tr>
    <tr>
      <td>Generos</td>
      <td><?php 
      foreach($genres as $genre){
	      foreach($film->getGeneros() as $genreFilm){
		
        if ($genre->getId() == $genreFilm) {
		      echo $genre->getNombre() . "&#160;&#160;";
}}}
 ?></td>
    </tr>
    <tr>
      <td>Estreno</td>
      <td><?php echo $film->getFechaEstreno() ?></td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td><?php echo $film->getDescripcion() ?></td>
    </tr>
    <tr>
      <td>Contenido Adulto</td>
      <td><?php if($film->getAdultos()) { echo "Si"; } else { echo "No"; } ?></td>
    </tr>
  <tr>
      <td>Popularidad</td>
      <td><?php echo $film->getPopularidad() ?></td>
    </tr>
  <tr>
      <td>Cantidad de Votos</td>
      <td><?php echo $film->getCantidadVotos() ?></td>
    </tr>
  <tr>
      <td>Puntuacion</td>
      <td><?php echo $film->getPuntuacion() ?></td>
    </tr>
  <tr>
      <td>Video</td>
      <td><?php if($film->getVideo()) { echo "Si"; } else { echo "No"; } ?></td>
    </tr>
  </tbody>
</table>
<?php
		}
	}
    ?>

 