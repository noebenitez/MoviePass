<br>
<h2>RECAUDACIÓN POR CINE</h2>
<br>
<form method="post" action="<?=FRONT_ROOT ?>Compra/recaudacionCineEntreFechas">
    <div class="form-row">

        <div class="form-group col-md-12"> 
            <label for="cinema">Seleccione el Cine</label>
            <select class="form-control" id="idCine" name="idCine" required>
                <?php 
                foreach($cinemaList as $cinema) {
                ?>
                <option value="<?php echo $cinema->getId() ?>"><?php echo $cinema->getNombre(); ?></option>
                <?php } ?>
            </select>
        </div>
       
        <a href="<?php echo FRONT_ROOT ?>Compra/recaudacionTotalCine/ <?php echo $cinema->getId() ?>" class="btn btn-danger col-2">Recaudación total</a>
        
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
            <button type="submit" class="btn btn-danger">Recaudación entre fechas</button>

     </div>
 </form>
        
            

    