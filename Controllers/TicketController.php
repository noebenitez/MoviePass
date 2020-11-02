<?php

namespace Controllers;

use DAO\TicketDAO as TicketDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\FuncionDAO as FuncionDAO;
use DAO\Films as FilmsDAO;
use phpqrcode\qrcode as QRcode;

class TicketController {


        public function ShowTicketList($idUser){

            if($_SESSION['esAdmin'] == false)
        {
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-user.php');
        }

        if($_SESSION['esAdmin'] == true)
        {
            require_once(ROOT . '/Views/header.php');
            require_once(ROOT . '/Views/nav-admin.php');
        }
        
        $ticketDAO = new TicketDAO();
        $tickets = $ticketDAO->GetAll();

        $filmDAO = new FilmsDAO();
        $cinemaDAO = new CinemaDAO();
        $roomDAO = new RoomDAO();
        $funcionDAO = new FuncionDAO();

        require_once(ROOT . '/Views/ticket-list.php');
        require_once(ROOT . '/Views/footer.php');
        
        }
        

        public function ShowTicketDetails($id){

            if($_SESSION['esAdmin'] == false)
            {
                    require_once(ROOT . '/Views/header.php');
                    require_once(ROOT . '/Views/nav-user.php');
            }
    
            if($_SESSION['esAdmin'] == true)
            {
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
            }
            
            $ticketController = new \Controllers\TicketController(); 

            $ticketDAO = new TicketDAO();
            $ticket = $ticketDAO->GetOne($id);

            $filmDAO = new FilmsDAO();
            $cinemaDAO = new CinemaDAO();
            $roomDAO = new RoomDAO();
            $funcionDAO = new FuncionDAO();

            require_once(ROOT . '/Views/ticket.php');
            require_once(ROOT . '/Views/footer.php');

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