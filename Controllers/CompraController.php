<?php

namespace Controllers;

use \Exception as Exception;
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
    
        try{
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
            
        }catch(Exception $ex){
        
            HomeController::ShowErrorView("Error al mostrar la pantalla de compra.", $ex->getMessage(), "Funcion/ShowCartelera/");
        }
    }
    

        public function ShowConfirmView($idFilm, $idFuncion, $cantidad, $precioUnitario, $nroTarjeta, $titular, $vencimiento, $codSeguridad, $email){

            try{
                
                if( $nroTarjeta[0] == 4){
                    $empresa = 'Visa';
                }else if( $nroTarjeta[0] == 5){
                    $empresa = 'MasterCard';
                }else{
                    throw new \Exception ("El número de tarjeta no pertenece a Visa o MasterCard");
                }
    
                $descuentoController = new DescuentoController();
                $descuento = $descuentoController->comprobarDescuento($cantidad);
 
                if($descuento){
                    $total = ($precioUnitario * $cantidad) - ((($precioUnitario * $cantidad) * $descuento) / 100);
                }else{
                    $total = $precioUnitario * $cantidad;
                }

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
            

            }catch(Exception $ex){

                HomeController::ShowErrorView("Ocurrio un error y no puede confirmarse la compra.", $ex->getMessage(), "Compra/BuyTicket/" . $idFilm);
            }

            

        }


        public function compraConfirmada($idFilm, $idFuncion, $cantidad, $total, $nroTarjeta, $titular, $vencimiento, $codSeguridad, $email, $empresa){
            
            try{

                $tarjeta = new \Models\TarjetaDeCredito($nroTarjeta, $empresa, $codSeguridad, $vencimiento, $titular, $_SESSION['id']);

                $this->tarjetaDAO->Add($tarjeta);
               
                $compra = new \Models\Compra($$this->tarjetaDAO->getIdByNroTarjeta($nroTarjeta), $cantidad, $total, $_SESSION['id'], $idFuncion);
        
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

            }catch(Exception $ex){

                HomeController::ShowErrorView("Hubo un error y no pudo completarse la compra.", $ex->getMessage(), "Compra/BuyTicket/" . $idFilm);
            }
            
            

        }

        public function enviarMail(){


        }

        public function cantidadEntradasDisponibles($idFuncion){

            try{

                $funcion = $this->funcionDAO->GetOne($idFuncion);
                $room = $this->roomDAO->GetOne($funcion->getIdSala());
    
                return $room->getCapacidad() - $funcion->getEntradasVendidas();

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener la cantidad de entradas disponibles.", $ex->getMessage(), "Home/Index/");
            }
        }


}