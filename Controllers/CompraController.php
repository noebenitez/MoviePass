<?php

namespace Controllers;

use DAO\CompraDAO as CompraDAO;
use DAO\TarjetaDAO as TarjetaDAO;
use DAO\TicketDAO as TicketDAO;
use Models\Ticket as Ticket;

class CompraController {

    public function BuyTicket($idFilm){

        $daosFilms = new \DAO\Films();
        
        $films = $daosFilms->GetAll();
        
        $daosGenres = new \DAO\Genres();
        
        $genres = $daosGenres->GetAll();
        
        $funcionesController = new \Controllers\FuncionController();

        $funciones = $funcionesController->GetAll();
        
        $cinemaDAO = new \DAO\CinemaDAO();

        $cinemas = $cinemaDAO->GetAll();
        
        $roomDAO = new \DAO\RoomDAO();
        
        
        if($_SESSION['esAdmin'] == false)
        {
            if($_SESSION['log'] == false) {
                require_once(ROOT . '/Views/header-login.php');
                require_once(ROOT . '/Views/nav-principal.php');
                require_once(ROOT . '/Views/login.php');
        
            }else{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-user.php');
                require_once(ROOT . '/Views/buy-ticket.php');
            }
        }
        
        if($_SESSION['esAdmin'] == true)
        {
            require_once(ROOT . '/Views/header.php');
            require_once(ROOT . '/Views/nav-admin.php');
            require_once(ROOT . '/Views/buy-ticket.php');
        }
        
            require_once(ROOT . '/Views/footer.php');
        
        }


        public function ShowConfirmView($idFilm, $idFuncion, $cantidad, $total, $nroTarjeta, $titular, $vencimiento, $codSeguridad, $email){


        if( $nroTarjeta[0] == 4){
            $empresa = 'Visa';
        }else if( $nroTarjeta[0] == 5){
            $empresa = 'MasterCard';
        }else{
            //...
        }

        $daosFilms = new \DAO\Films();
        
        $films = $daosFilms->GetAll();
        
        $funcionesController = new \Controllers\FuncionController();

        $funciones = $funcionesController->GetAll();
        
        $cinemaDAO = new \DAO\CinemaDAO();

        $cinemas = $cinemaDAO->GetAll();
        
        $roomDAO = new \DAO\RoomDAO();

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
            require_once(ROOT . '/Views/confirmar-compra.php');
            require_once(ROOT . '/Views/footer.php');

        }


        public function compraConfirmada($idFilm, $idFuncion, $cantidad, $total, $nroTarjeta, $titular, $vencimiento, $codSeguridad, $email, $empresa){
            
        $compra = new \Models\Compra();

        $compra->setNroTarjeta($nroTarjeta);
        $compra->setCantidadEntradas($cantidad);
        $compra->setValorTotal($total);
        $compra->setIdUsuario($_SESSION['id']);
        $compra->setIdFuncion($idFuncion);

        $tarjeta = new \Models\TarjetaDeCredito();

        $tarjeta->setNroTarjeta($nroTarjeta);
        $tarjeta->setEmpresa($empresa);
        $tarjeta->setCodSeguridad($codSeguridad);
        $tarjeta->setVencimiento($vencimiento);
        $tarjeta->setTitular($titular);
        $tarjeta->setIdUsuario($_SESSION['id']);
            
        $compraDAO = new CompraDAO();

        $compraDAO->Add($compra);

        $tarjetaDAO = new TarjetaDAO();

        $tarjetaDAO->Add($tarjeta);

        $ticketDAO = new TicketDAO();

        for($i=0; $i<$cantidad; $i++){

            $ticket = new Ticket();

            $ticket->setValorUnitario($total/$cantidad);
            $ticket->setAsiento('K10');  //VER
            $ticket->setIdUsuario($_SESSION['id']);
            $ticket->setIdFuncion($compra->getIdFuncion());

            $ticketDAO->Add($ticket);
        }

        $ticketController = new TicketController();

        $ticketController->ShowTicketList($_SESSION['id']);

        }

        public function enviarMail(){


        }


}