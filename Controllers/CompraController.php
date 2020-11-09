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
use Controllers\phpmailer\PHPMailer as PHPMailer;
use Controllers\phpmailer\SMTP as SMTP;


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

            $funciones = $this->funcionDAO->getFuncionesFuturas($idFilm);
                
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
    

        public function ShowConfirmView($idFilm, $idFuncion, $cantidad, $nroTarjeta, $titular, $vencimiento, $codSeguridad, $email){

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
                $funcion = $this->funcionDAO->getOne($idFuncion);
                $precioUnitario = $funcion->getValorEntrada();
 
                if($descuento){
                    $total = ($precioUnitario * $cantidad) - ((($precioUnitario * $cantidad) * $descuento) / 100);
                }else{
                    $total = $precioUnitario * $cantidad;
                }
                
                $film = $this->filmsDAO->GetOne($idFilm);
    
    
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

                //conseguir el ultimo id compra
                $idCompra = $this->compraDAO->lastId();

                //var_dump($idCompra);
    
                $this->funcionDAO->actualizarEntradasVendidas($idFuncion, $cantidad);

                for($i=0; $i<$cantidad; $i++){
    
                    $ticket = new Ticket();
    
                    $ticket->setValorUnitario($total/$cantidad);
                    $ticket->setAsiento($this->ticketDAO->nroAsiento($idFuncion));
                    $ticket->setIdUsuario($_SESSION['id']);
                    $ticket->setIdFuncion($compra->getIdFuncion());
                    $ticket->setIdCompra($idCompra);

                    $this->ticketDAO->Add($ticket);
                }
    
                $this->enviarMail($email, $idCompra);
                $ticketController = new TicketController();
                $ticketController->ShowTicketList($_SESSION['id']); 


            }catch(Exception $ex){
                
                HomeController::ShowErrorView("Hubo un error y no pudo completarse la compra." . $_SESSION['id'], $ex->getMessage(), "Compra/BuyTicket/" . $idFilm);
            }
            
            

        }

        public function enviarMail($email, $idCompra){

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                         // Disable verbose debug output
                $mail->isSMTP();                                            // Envia usando SMTP
                $mail->Host       = 'in-v3.mailjet.com';                    //  Host del SMTP server por donde se manda el mail
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = '8ad2921988c640aaf0e8327181f97278';     // SMTP username
                $mail->Password   = 'e205ef69710fee7ef88c1cc2adb55aa9';     // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                
                //Destinatarios
                $mail->setFrom('moviepass@yopmail.com', 'MoviePass');
                $mail->addAddress($email);     // Se pueden agregar más de uno repitiendo esta línea
                
               
                // Content
                $mail->isHTML(true);           // Set email format to HTML
                $mail->Subject = 'Tickets';
                
                $ticketController = new TicketController();

                $ticketList = $ticketController->getTicketsXcompra($idCompra);

                $bodyhtml = '<div style="border: 1px solid #E2E2E2; border-radius: 5px; background-color: #1f1f1f; text-align: center;"><img src="'.IMAGES.'logo.png" width="30%" style="margin: 30px;" /></div><br>';

                $bodyplain = "MOVIEPASS";

                $QRcode = "";

                foreach($ticketList as $ticket){

                    $funcion = $this->funcionDAO->GetOne($ticket->getIdFuncion());
                    $film = $this->filmsDAO->GetOne($funcion->getIdFilm());
                    $room = $this->roomDAO->GetOne($funcion->getIdSala());
                    
                    //Se arma el body con todas las entradas
                    $bodyhtml = $bodyhtml .
                        '
                        <div style="border: 1px solid #E2E2E2; border-radius: 5px; padding: 30px; background-color: #f1f1f1;">
                            <h1 style="color: #B40808;">' . $film->getTitulo() . '</h1>
                            <h3 style="color: grey;"><b>Ticket #'. $ticket->getId() .'</b></h3>
                            <p style="color: grey;"><b>Funci&oacute;n:</b> &#160;' .$this->cinemaDAO->nombrePorId($room->getIdCine()) . ' - ' . $room->getNombre() . ' - ' . $funcion->getFecha() . ' - ' . $funcion->getHora() .'</p>
                            <p style="color: grey;"><b>Asiento:</b> &#160;'. $ticket->getAsiento() .'</p>
                            <p style="color: grey;"><b>Valor:</b> &#160;$'. $ticket->getValorUnitario(). '</p>
                            <small style="color: grey;">* C&oacute;digo QR adjunto.</small><br>
                        </div>
                        <br>';
                        
                        
                    $bodyplain = $bodyplain .
                        "\n -----------------------------------------------------------------------------".
                        "\n Película: ". $film->getTitulo() .
                        "\n #ID ticket: " . $ticket->getId() .
                        "\n Función: ". $this->cinemaDAO->nombrePorId($room->getIdCine()) . " - " . $room->getNombre() . " - " . $funcion->getFecha() . " - " . $funcion->getHora() .
                        "\n Asiento: " . $ticket->getAsiento();
                        "\n Valor: " . $ticket->getValorUnitario();
                        "\n -----------------------------------------------------------------------------";
                       
                        $QRcode = $QRcode. '/ ' . $ticket->getQR() . ' /';
                    
                }

                $bodyhtml = $bodyhtml . '<hr><div style="text-align: center;"><p style="color: grey;">MoviePass 2020 - Grupo 8 - TUP - UTN FRMDP</p></div>';

                //Para adjuntar archivos, se adjunta el código QR
                $mail->addAttachment(ROOT."/Controllers/qrcodes/" . $ticketController->GetQRCode($QRcode));

                $mail->Body = $bodyhtml;            //Body en html 
                
                $mail->AltBody = $bodyplain;        //Body para mails no-html

                $mail->send();
                
            } catch (Exception $e) {
                
                throw $e;
            }

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

        
        public function ShowRecaudacionCinesView(){
            try{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
                
                $cinemaList = $this->cinemaDAO->GetAll();
                
                require_once(VIEWS_PATH."recaudacion-cine-filter.php");
                require_once(ROOT . '/Views/footer.php');
                
            }catch(Exception $ex){
                
                HomeController::ShowErrorView("Error al cargar los cines.", $ex->getMessage(), "Home/Index/");
            }
        }
        
        public function recaudacionTotalCine($idCine){

            try{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');

                $recaudacion = $this->compraDAO->recaudacionTotalCine($idCine);
                $cinema = $this->cinemaDAO->getOne($idCine);
    
                require_once(VIEWS_PATH."recaudacion-cine.php");
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Ocurrió un error al obtener la información del cine.", $ex->getMessage(), "Compra/ShowRecaudacionCinesView/");
            }
        }

        public function recaudacionCineEntreFechas($idCine, $desde, $hasta){

            try{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');

                $recaudacion = $this->compraDAO->recaudacionCineEntreFechas($idCine, $desde, $hasta);
                $cinema = $this->cinemaDAO->getOne($idCine);
    
                require_once(VIEWS_PATH."recaudacion-cine.php");
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Ocurrió un error al obtener la información del cine.", $ex->getMessage(), "Compra/ShowRecaudacionCinesView/");
            }
        }

        public function ShowRecaudacionFilmView(){
            try{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
                
                $filmList = $this->filmsDAO->getFilmsConFunciones();
                
                require_once(VIEWS_PATH."recaudacion-film-filter.php");
                require_once(ROOT . '/Views/footer.php');
                
            }catch(Exception $ex){
                
                HomeController::ShowErrorView("Error al cargar las películas.", $ex->getMessage(), "Home/Index/");
            }
        }

        public function recaudacionTotalFilm($idFilm){

            try{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');

                $recaudacion = $this->compraDAO->recaudacionTotalFilm($idFilm);
                $film = $this->filmsDAO->GetOne($idFilm);
    
                require_once(VIEWS_PATH."recaudacion-film.php");
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Ocurrió un error al obtener la información del cine.", $ex->getMessage(), "Compra/ShowRecaudacionCinesView/");
            }
        }

        public function recaudacionFilmEntreFechas($idFilm, $desde, $hasta){

            try{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');

                $recaudacion = $this->compraDAO->recaudacionFilmEntreFechas($idFilm, $desde, $hasta);
                $film = $this->filmsDAO->GetOne($idFilm);
    
                require_once(VIEWS_PATH."recaudacion-film.php");
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Ocurrió un error al obtener la información de la película.", $ex->getMessage(), "Compra/ShowRecaudacionCinesView/");
            }
        }



}