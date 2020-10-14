<br>
    <h2>GENEROS</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
    <?php
        foreach($genres as $genre){
    ?>
             <li class="breadcrumb-item"><a href="<?php echo FRONT_ROOT ?>Films/getFilmsByGenres/<?php echo $genre->getId() ?>"><?php echo $genre->getNombre() ?></a></li>
    <?php
        }
    ?>
        </ol>
    </nav>