<?php

namespace Controllers;

class FilmsController {

    public function getAll() {

        
        $daosFilms = new \DAO\Films();
        $films = $daosFilms->GetAll();


        if($_SESSION['esAdmin'] == false)
    {
        if($_SESSION['log'] == false) {
            require_once(ROOT . '/Views/header-login.php');
            require_once(ROOT . '/Views/nav-principal.php');
        }else{
            require_once(ROOT . '/Views/header.php');
            require_once(ROOT . '/Views/nav-user.php');
        }
    }

    if($_SESSION['esAdmin'] == true)
    {
        require_once(ROOT . '/Views/header.php');
        require_once(ROOT . '/Views/nav-admin.php');

    }

        require_once(ROOT . '/Views/film-list.php');
        require_once(ROOT . '/Views/footer.php');

    }

    public function getInfo($id) {

    

        if($_SESSION['esAdmin'] == false)
    {
        if($_SESSION['log'] == false) {
            require_once(ROOT . '/Views/header-login.php');
            require_once(ROOT . '/Views/nav-principal.php');
        }else{
        require_once(ROOT . '/Views/header.php');
        require_once(ROOT . '/Views/nav-user.php');
        }
    }

    if($_SESSION['esAdmin'] == true)
    {
        require_once(ROOT . '/Views/header.php');
        require_once(ROOT . '/Views/nav-admin.php');

    }

        $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/Views/film-info.php');

        require_once(ROOT . '/Views/footer.php');

    }

    public function getFilmsByGenres($id) {


        if($_SESSION['esAdmin'] == false)
        {
            if($_SESSION['log'] == false) {
                require_once(ROOT . '/Views/header-login.php');
                require_once(ROOT . '/Views/nav-principal.php');
            }else{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-user.php');
            }
        }
    
        if($_SESSION['esAdmin'] == true)
        {
            require_once(ROOT . '/Views/header.php');
            require_once(ROOT . '/Views/nav-admin.php');
    
        }

        $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/Views/film-by-genre.php');

        require_once(ROOT . '/Views/footer.php');

    }

    public function getFilmsByDate($date){


        if($_SESSION['esAdmin'] == false)
        {
            if($_SESSION['log'] == false) {
                require_once(ROOT . '/Views/header-login.php');
                require_once(ROOT . '/Views/nav-principal.php');
            }else{
                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-user.php');
            }
        }
    
        if($_SESSION['esAdmin'] == true)
        {
            require_once(ROOT . '/Views/header.php');
            require_once(ROOT . '/Views/nav-admin.php');
    
        }

        $daosFilms = new \DAO\Films();

        $filmsDate = $daosFilms->getByDate($date);

        require_once(ROOT . '/Views/film-by-date.php');

        require_once(ROOT . '/Views/footer.php');
    }

    public function filter(){


        if($_SESSION['esAdmin'] == false)
    {
        if($_SESSION['log'] == false) {
            require_once(ROOT . '/Views/header-login.php');
            require_once(ROOT . '/Views/nav-principal.php');
        }else{
            require_once(ROOT . '/Views/header.php');
            require_once(ROOT . '/Views/nav-user.php');
        }
    }

    if($_SESSION['esAdmin'] == true)
    {
        require_once(ROOT . '/Views/header.php');
        require_once(ROOT . '/Views/nav-admin.php');

    }

            $daosGenres = new \DAO\Genres();
            $genres = $daosGenres->GetAll();

            $daosFilms = new \DAO\Films();
            $rangoFechas = $daosFilms->getRangoFechas();
    
            require_once(ROOT . '/Views/filter.php');

        require_once(ROOT . '/Views/footer.php');
    }

    public function BuyTicket($idFilm){

        $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

       $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

        $funcionesController = new \Controllers\FuncionController();

        $cinemaController = new \Controllers\CinemaController();

        $roomController = new \Controllers\RoomController();

        $funciones = $funcionesController->GetAll();

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