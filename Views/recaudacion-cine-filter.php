<div>
  <main class="container clear"> 
    <div> 
      <div id="comments" >
<br>
<h2>RECAUDACIÓN POR CINE</h2>
<br>

<form method="post" action="<?=FRONT_ROOT ?>Compra/recaudacionCine">
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
            <!--<button type="submit" class="btn btn-danger">Recaudación entre fechas</button>-->
            <br>
    
 </form>
 </div>
    </div>
  </main>
</div>  
            

    