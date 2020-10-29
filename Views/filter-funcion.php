<br>
    <h2>GENEROS</h2>
    <nav aria-label="breadcrumb">
        <ol id="generos" class="breadcrumb">
    <?php
        foreach($genres as $genre){
    ?>
             <li class="breadcrumb-item"><a class="generos" href="<?php echo FRONT_ROOT ?>Funcion/getFilmsByGenres/<?php echo $genre->getId() ?>"><?php echo $genre->getNombre() ?></a></li>
    <?php
        }
    ?>
        </ol>
    </nav>

    <br>
    <h2>FECHA DE FUNCION</h2>
    <nav aria-label="breadcrumb">
        <ol id="generos"  class="breadcrumb">
    
        <form method="post" action="<?=FRONT_ROOT ?>Funcion/getFilmsByDate">
        <div class="form-row">
    <div class="form-group col-md-9">

            <input type="date" name="date" class="form-control" min= <?= date("Y-m-d") ?> required>
</div>
<div class="form-group col-md-3">

            <button type="submit" class="btn btn-danger" value="">Filtrar</button>
            </div>
            </div>
        </form>

        </ol>
    </nav>