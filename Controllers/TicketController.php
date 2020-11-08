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

    public function ShowTicketList($idUser){

        try{
            
            if($_SESSION['esAdmin'] == false){
    
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-user.php');
            }else{
            
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
            }
    
            $tickets = $this->ticketDAO->GetAll();
    
            require_once(ROOT . '/Views/ticket-list.php');
            require_once(ROOT . '/Views/footer.php');
        
        }catch (Exception $ex){

            HomeController::ShowErrorView("Error al obtener la información de las entradas.", $ex->getMessage(), "Home/Index/");
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