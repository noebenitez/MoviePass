<br>
<h2>ENTRADA</h2>
<br>

 <div class="card flex-row flex-wrap">
        <div class="card-header border-0 col-3">

        <img src="../../Controllers/qrcodes/<?php echo $ticketController->GetQRCode($ticket->getQR()) ?>" width="230px" alt="qr-ticket" />
       
        </div>
        <div class="card-block px-2 col-8"><br>
    <?php
        $funcion = $this->funcionDAO->GetOne($ticket->getIdFuncion());
        $film = $this->filmsDAO->GetOne($funcion->getIdFilm());
        $room = $this->roomDAO->GetOne($funcion->getIdSala());
    ?>
            <h3 class="card-text"><?php echo $film->getTitulo() ?></h3>
            <h5>#<?php echo $ticket->getId() ?></h5>
            <br>
	    <p class="card-text"><b>Funci&oacute;n:</b> &#160;<?php echo $this->cinemaDAO->nombrePorId($room->getIdCine()) . " - " . $room->getNombre() . " - " . $funcion->getFecha() . " - " . $funcion->getHora() ?></p>
        <p class="card-text"><b>Asiento:</b> &#160;<?php echo $ticket->getAsiento() ?></p>
        <p class="card-text"><b>Valor:</b> &#160;$<?php echo $ticket->getValorUnitario() ?></p>
<br>
        </div>
    </div> 
 