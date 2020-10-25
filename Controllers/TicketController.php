<?php

namespace Controllers;

class TicketController {

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

}