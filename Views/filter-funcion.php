    <br>
    <nav aria-label="breadcrumb">
        <ol id="generos" class="breadcrumb" style="background-color: #f1f1f1;">
        <li>GENEROS: &#160;</li>
    <?php
        foreach($genres as $genre){
    ?>
             <li class="breadcrumb-item"><a class="generos" href="<?php echo FRONT_ROOT ?>Funcion/getFilmsByGenres/<?php echo $genre->getId() ?>"><?php echo $genre->getNombre() ?></a></li>
    <?php
        }
    ?>
        </ol>
        <ol id="generos"  class="breadcrumb" style="background-color: #f1f1f1;">
        <form class="form-inline" method="post" action="<?=FRONT_ROOT ?>Funcion/getFilmsByDate">
        <div class="form-group">
            <label class="">FECHA DE FUNCION: &#160;</label>
            <input type="date" name="date" class="form-control" min= <?= $rangoFechas['minimum'] ?>  >
           </div>&#160;
            <button type="submit" class="btn btn-danger">Filtrar</button>
        </form>

        </ol>
    </nav>

    