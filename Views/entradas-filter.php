<div>
  <main class="container clear"> 
    <div> 
      <div id="comments" >
<br>
<h2>DISPONIBILIDAD DE ENTRADAS</h2>
<br>
<form method="post" action="<?=FRONT_ROOT ?>Funcion/disponibilidadEntradas">
    <div class="form-row">

        <div class="form-group col-md-12"> 
            <label for="cinema">Seleccione un Cine</label>
            <select class="form-control" id="idCine" name="idCine" >
            <option value="null"> </option>
                <?php 
                foreach($cines as $cine) {
                    $cinema = $this->cinemaDAO->GetOne($cine);
                ?>
                <option value="<?php echo $cinema->getId() ?>"><?php echo $cinema->getNombre(); ?></option>
                <?php } ?>
            </select>
        </div>
        </div>
       
        <button type="submit" class="btn btn-danger">Entradas por Cine</button>
        
        <br><br>
    <br>
   
    <div class="form-row">
    
    <div class="form-group col-md-12"> 
            <label for="film">O seleccione una Pel&iacute;cula</label>
            <select class="form-control" id="idFilm" name="idFilm" >
            <option value="null"> </option>
                <?php 
                foreach($peliculas as $pelicula) {
                    $film = $this->filmDAO->GetOne($pelicula);
                ?>
                <option value="<?php echo $film->getId() ?>"><?php echo $film->getTitulo(); ?></option>
                <?php } ?>
            </select>
        </div>
        </div>
            <button type="submit" class="btn btn-danger">Entradas por Pel&iacute;cula</button>
            <!--<button type="submit" class="btn btn-danger">Recaudación entre fechas</button>-->
            <br>

</form>
 </div>
    </div>
  </main>
</div> 




