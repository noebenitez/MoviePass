<?php

namespace Controllers;

use DAO\CompraDAODB as CompraDAO;
use DAO\TarjetaDAODB as TarjetaDAO;
use DAO\TicketDAODB as TicketDAO;
use Models\Ticket as Ticket;
use DAO\RoomDAODB as RoomDAO;
use DAO\CinemaDAODB as CinemaDAO;
use DAO\FilmsDAODB as FilmsDAO;
use DAO\FuncionDAODB as FuncionDAO;

class CompraController {

    private $compraDAO;
    private $tarjetaDAO;
    private $ticketDAO;
    private $roomDAO;
    private $cinemaDAO;
    private $filmsDAO;
    private $funcionDAO;

    public function __construct(){

        $this->compraDAO = new CompraDAO();
        $this->tarjetaDAO = new TarjetaDAO();
        $this->ticketDAO = new TicketDAO();
        $this->roomDAO = new RoomDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->filmsDAO = new FilmsDAO();
        $this->funcionDAO = new FuncionDAO();
    }

    public function BuyTicket($idFilm){
    
        $film = $this->filmsDAO->GetOne($idFilm);
        
        $funciones = $this->funcionDAO->getFuncionesPorPelicula($idFilm);
        
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


        public function ShowConfirmView($idFilm, $idFuncion, $cantidad, $precioUnitario, $nroTarjeta, $titular, $vencimiento, $codSeguridad, $email){


            if( $nroTarjeta[0] == 4){
                $empresa = 'Visa';
            }else if( $nroTarjeta[0] == 5){
                $empresa = 'MasterCard';
            }else{
                //...
            }

            $total = $precioUnitario * $cantidad;
            
            $film = $this->filmsDAO->GetOne($idFilm);

            $funcion = $this->funcionDAO->getOne($idFuncion);

            $room = $this->roomDAO->getOne($funcion->getIdSala());

            $cinemaNombre = $this->cinemaDAO->nombrePorId($room->getIdCine());
            
            $entradasDisponibles = $this->cantidadEntradasDisponibles($idFuncion);

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
            
            if($cantidad > $entradasDisponibles){
                require_once(ROOT . '/Views/tickets-insuficientes.php');

            }else{
                require_once(ROOT . '/Views/confirmar-compra.php');
            }   
            require_once(ROOT . '/Views/footer.php');

        }


        public function compraConfirmada($idFilm, $idFuncion, $cantidad, $total, $nroTarjeta, $titular, $vencimiento, $codSeguridad, $email, $empresa){
            
            
            $tarjeta = new \Models\TarjetaDeCredito();
            
            $tarjeta->setNroTarjeta($nroTarjeta);
            $tarjeta->setEmpresa($empresa);
            $tarjeta->setCodSeguridad($codSeguridad);
            $tarjeta->setVencimiento($vencimiento);
            $tarjeta->setTitular($titular);
            $tarjeta->setIdUsuario($_SESSION['id']);
            
            $this->tarjetaDAO->Add($tarjeta);
            
            $compra = new \Models\Compra();
    
            $compra->setIdTarjeta($this->tarjetaDAO->getIdByNroTarjeta($nroTarjeta));
            $compra->setCantidadEntradas($cantidad);
            $compra->setValorTotal($total);
            $compra->setIdUsuario($_SESSION['id']);
            $compra->setIdFuncion($idFuncion);

            $this->compraDAO->Add($compra);
            $this->funcionDAO->actualizarEntradasVendidas($idFuncion, $cantidad);

            for($i=0; $i<$cantidad; $i++){

                $ticket = new Ticket();

                $ticket->setValorUnitario($total/$cantidad);
                $ticket->setAsiento($this->ticketDAO->nroAsiento($idFuncion));
                $ticket->setIdUsuario($_SESSION['id']);
                $ticket->setIdFuncion($compra->getIdFuncion());
                $ticket->setQR('Ticket Nro.: '.$ticket->getId().' - Funcion ID: '.$ticket->getIdFuncion().' - Asiento: '.$ticket->getAsiento());

                $this->ticketDAO->Add($ticket);
            }

            $ticketController = new TicketController();

            $ticketController->ShowTicketList($_SESSION['id']);

        }

        public function enviarMail(){


        }

        public function cantidadEntradasDisponibles($idFuncion){

            $funcion = $this->funcionDAO->GetOne($idFuncion);
            var_dump($funcion);
    
            $room = $this->roomDAO->GetOne($funcion->getIdSala());
            
            var_dump($room);
            return $room->getCapacidad() - $funcion->getEntradasVendidas();
        }


}