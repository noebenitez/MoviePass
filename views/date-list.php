
<br>
    <h2>FECHA</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
    
        <form method="post" action="<?=FRONT_ROOT ?>Films/getFilmsByDate">

            <input type="date" name="date" min= <?= $rangoFechas['minimum'] ?> max= <?= $rangoFechas['maximum'] ?> >

            <input type="submit" class="btn btn-primary" value="filtrar"> </input>
        </form>

        </ol>
    </nav>