<br>
<h2>MIS ENTRADAS</h2>
<br>
<?php foreach($tickets as $ticket){
    
    if($ticket->getIdUsuario() == $idUser){ 
     
        $funcion = $funcionDAO->GetOne($ticket->getIdFuncion());
        $film = $filmDAO->GetOne($funcion->getIdFilm());

                ?>
 <div class="card flex-row flex-wrap">
        <div class="card-header border-0 col-1">
  <?php if (empty($film->getPoster())) { ?>
  <img class="card-img-top" src="<?php echo IMAGES ?>not-available.jpg" alt="Card image cap">

<?php }else{ ?>

<img class="card-img-top" src="<?php echo IMAGENES.$film->getPoster() ?>" alt="Card image cap">

<?php } ?>

        </div>
        <div class="card-block px-2 col-10"><br>
        <div class="d-flex justify-content-between">
            <h5 class="card-text"><?php echo $film->getTitulo() ?></h5>

            <a href="<?php echo FRONT_ROOT ?>Ticket/ShowTicketDetails/<?php echo $ticket->getId() ?>" class="btn btn-danger"><i class="fa fa-qrcode"></i>&#160;&#160;Ver</a>
    </div>
    <?php $room = $roomDAO->GetOne($funcion->getIdSala());  ?>
	    <p class="card-text"><?php echo $cinemaDAO->nombrePorId($room->getIdCine()) . " - " . $room->getNombre() . " - " . $funcion->getFecha() . " - " . $funcion->getHora() ?></p>
<br>
        </div>
    </div> 
    <?php } }  ?>