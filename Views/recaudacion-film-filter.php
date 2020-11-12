
<div>
  <main class="container clear"> 
    <div> 
      <div id="comments" >
<br>
<h2>RECAUDACIÓN POR PELÍCULA</h2>
<br>
<form method="post" action="<?=FRONT_ROOT ?>Compra/recaudacionFilm">
    <div class="form-row">

        <div class="form-group col-md-12"> 
            <label for="film">Seleccione la Pel&iacute;cula</label>
            <select class="form-control" id="idfilm" name="idfilm" required>
            <?php 
                foreach($filmList as $film) {
                ?>
                <option value="<?php echo $film->getId() ?>"><?php echo $film->getTitulo(); ?></option>
                <?php } ?>
            </select>
        </div>
        </div>

        <input type="hidden" name="desde" value="null">

        <input type="hidden" name="hasta" value="null"> 

        <button type="submit" class="btn btn-danger">Recaudaci&oacute;n Total</button>
        
            <br><br>
        <br>
        <div class="form-row">

            <div class="form-group col-md-5">
                <label class="">Desde: &#160;</label>
                <input type="date" name="desde" class="form-control" >
            </div>&#160;

            <div class="form-group col-md-5">
                <label class="">Hasta: &#160;</label>
                <input type="date" name="hasta" class="form-control" >
            </div>&#160;
            <br>
            
        </div>

            <button type="submit" class="btn btn-danger">Recaudaci&oacute;n entre Fechas</button>
            <br>
            

     
 </form>
 </div>
    </div>
  </main>
</div>
            
