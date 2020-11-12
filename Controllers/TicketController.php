<?php

namespace Controllers;

use DAO\TicketDAODB as TicketDAO;
use DAO\CinemaDAODB as CinemaDAO;
use DAO\RoomDAODB as RoomDAO;
use DAO\FuncionDAODB as FuncionDAO;
use DAO\FilmsDAODB as FilmsDAO;
use phpqrcode\qrcode as QRcode;

class TicketController {

    private $ticketDAO;
    private $cinemaDAO;
    private $roomDAO;
    private $funcionDAO;
    private $filmsDAO;

    public function __construct(){

        $this->ticketDAO = new TicketDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->roomDAO = new RoomDAO();
        $this->funcionDAO = new FuncionDAO();
        $this->filmsDAO = new FilmsDAO();
    }


    public function ShowTicketList($idUser, $value){

        try{
            
            if($_SESSION['esAdmin'] == false){
    
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-user.php');
                
            }else{
            
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
            }
    
            $ticketList = $this->ticketDAO->GetAll();

            echo '<br>
            <h2>MIS ENTRADAS</h2>
            <br>
            <div class="d-flex justify-content-center">
            <div class="btn-group" role="group" aria-label="Basic example">';

            switch ($value){
                    case 'pelicula':
                        echo '<a type="button" href="'.FRONT_ROOT.'Ticket/ShowTicketList/'.$_SESSION['id'].'/pelicula" class="btn btn-secondary">Ordenar por Pel&iacute;cula</a>
                        <a type="button" href="'.FRONT_ROOT.'Ticket/ShowTicketList/'.$_SESSION['id'].'/fecha" class="btn btn-outline-secondary">Ordenar por Fecha</a>';
                    break;
                    case 'fecha':
                        echo '<a type="button" href="'.FRONT_ROOT.'Ticket/ShowTicketList/'.$_SESSION['id'].'/pelicula" class="btn btn-outline-secondary">Ordenar por Pel&iacute;cula</a>
                        <a type="button" href="'.FRONT_ROOT.'Ticket/ShowTicketList/'.$_SESSION['id'].'/fecha" class="btn btn-secondary">Ordenar por Fecha</a>';
                    break;
                 }
                 
            echo '</div>
            </div> 
            <br>
            <div class="col-md-12">';

            $ticketsUsuario = array();

             foreach($ticketList as $ticket){
                if($ticket->getIdUsuario() == $idUser){ 
                    array_push($ticketsUsuario, $ticket);
                }
            }
            
            if($value == 'pelicula'){
                $this->ordenarXpelicula($ticketsUsuario);
            }else if($value == 'fecha'){
                $this->ordenarXfecha($ticketsUsuario);
            }

            echo '</div>';
            require_once(ROOT . '/Views/footer.php');
        
        }catch (Exception $ex){

            HomeController::ShowErrorView("Error al obtener la información de las entradas.", $ex->getMessage(), "Home/Index/");
        }

    }
    

    public function ordenarXpelicula($ticketList){

        $peliculasTickets = array();

        foreach($ticketList as $ticket){

            $funcion = $this->funcionDAO->GetOne($ticket->getIdFuncion());

            array_push($peliculasTickets, $funcion->getIdFilm());
        }

        $idPeliculas = array_unique($peliculasTickets);

        foreach($idPeliculas as $idFilm){

            $film = $this->filmsDAO->GetOne($idFilm);

            echo '<div style="margin-bottom: 20px;"><h5>'.$film->getTitulo().'</h5></div>';

            foreach($ticketList as $ticket){

                $funcion = $this->funcionDAO->GetOne($ticket->getIdFuncion());

                if($idFilm == $funcion->getIdFilm()){

                    require(ROOT . '/Views/simple-ticket.php');
    
                }
            }
            echo '<br>';
        }
    }


    public function ordenarXfecha($ticketList){
        
        setlocale(LC_TIME, "es_ES");

        $fechasTickets = array();

        foreach($ticketList as $ticket){

            $funcion = $this->funcionDAO->GetOne($ticket->getIdFuncion());

            array_push($fechasTickets, $funcion->getFecha());
        }

        $fechas = array_unique($fechasTickets);

        foreach($fechas as $fecha){

            echo '<div style="margin-bottom: 20px;"><h5>'.date("d/m/y", strtotime($fecha)).'</h5></div>';

            foreach($ticketList as $ticket){

                $funcion = $this->funcionDAO->GetOne($ticket->getIdFuncion());

                $film = $this->filmsDAO->GetOne($funcion->getIdFilm());

                if($fecha == $funcion->getFecha()){

                    require(ROOT . '/Views/simple-ticket.php');

                }
            }
            echo '<br>';
        }
    }


    public function ShowTicketDetails($id){

        try{

            if($_SESSION['esAdmin'] == false)
            {
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-user.php');
            }else{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
            }
            
            $ticketController = new \Controllers\TicketController(); 
            $ticket = $this->ticketDAO->GetOne($id);
            
            require_once(ROOT . '/Views/ticket.php');
            require_once(ROOT . '/Views/footer.php');

        }catch (Exception $ex){

            HomeController::ShowErrorView("Error al obtener la información de la entrada.", $ex->getMessage(), "Ticket/ShowTicketList/");
        }


    }

    public function getTicketsXcompra($idCompra){

        try{

        $tickets = $this->ticketDAO->GetAll();

        $ticketsXcompra = array();

        foreach($tickets as $ticket){

            if($ticket->getIdCompra() == $idCompra){
                array_push($ticketsXcompra, $ticket);
            }

        }

        return $ticketsXcompra;

        }catch (Exception $ex){

             HomeController::ShowErrorView("Error al obtener la información de las entradas.", $ex->getMessage(), "Ticket/ShowTicketList/");
        }
    }
    

    public function GetQRCode($value){
        
        //set it to writable location, a place for temp generated PNG files
        $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrcodes'.DIRECTORY_SEPARATOR;

        //html PNG location prefix
        $PNG_WEB_DIR = 'qrcodes/';

        require_once "phpqrcode/qrlib.php";    

        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR)){
            mkdir($PNG_TEMP_DIR);}

        //$filename = $PNG_TEMP_DIR.'qr-ticket.png';

        $matrixPointSize = 10;
        $errorCorrectionLevel = 'L';

        $idTicket = 1;

        $image = 'qr-ticket-'.md5($idTicket.'-'.$errorCorrectionLevel.'-'.$matrixPointSize).'.png';

        $filename = $PNG_TEMP_DIR.$image;

        QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

        //echo '<img src="../Controllers/' . $PNG_WEB_DIR . $filename . '" width="150px" alt="qr-ticket" />'; 

        return $image;
    }

}