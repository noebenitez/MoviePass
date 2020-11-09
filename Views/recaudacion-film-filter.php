<br>
<h2>RECAUDACIÓN POR PELÍCULA</h2>
<br>
<form method="post" action="<?=FRONT_ROOT ?>Compra/recaudacionFilmEntreFechas">
    <div class="form-row">

        <div class="form-group col-md-12"> 
            <label for="film">Seleccione la película:</label>
            <select class="form-control" id="idfilm" name="idfilm" required>
            <?php 
                foreach($filmList as $film) {
                ?>
                <option value="<?php echo $film->getId() ?>"><?php echo $film->getTitulo(); ?></option>
                <?php } ?>
            </select>
        </div>
        
            <a href="<?php echo FRONT_ROOT ?>Compra/recaudacionTotalFilm/ <?php echo $film->getId() ?>" class="btn btn-danger col-2">Recaudación total</a>
        
        </div>
        <br>
        <div class="form-row">

            <div class="form-group col-md-4">
                <label class="">Desde: &#160;</label>
                <input type="date" name="desde" class="form-control" required>
            </div>&#160;

            <div class="form-group col-md-4">
                <label class="">Hasta: &#160;</label>
                <input type="date" name="hasta" class="form-control" required>
            </div>&#160;
            <br>
            
        </div>

            <button type="submit" class="btn btn-danger">Recaudación entre fechas</button>
            

     </div>
 </form>
        
            
