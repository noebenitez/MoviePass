<?php

namespace Controllers;

class FilmsController {

    public function getAll() {

        
        $daosFilms = new \DAO\Films();
        $films = $daosFilms->GetAll();


        if($_SESSION['esAdmin'] == false)
    {
        if($_SESSION['log'] == false) {
            require_once(ROOT . '/views/header-login.php');
            require_once(ROOT . '/views/nav-principal.php');
        }else{
            require_once(ROOT . '/views/header.php');
            require_once(ROOT . '/views/nav-user.php');
        }
    }

    if($_SESSION['esAdmin'] == true)
    {
        require_once(ROOT . '/views/header.php');
        require_once(ROOT . '/views/nav-admin.php');

    }

        require_once(ROOT . '/views/film-list.php');
        require_once(ROOT . '/views/footer.php');

    }

    public function getInfo($id) {

    

        if($_SESSION['esAdmin'] == false)
    {
        if($_SESSION['log'] == false) {
            require_once(ROOT . '/views/header-login.php');
            require_once(ROOT . '/views/nav-principal.php');
        }else{
        require_once(ROOT . '/views/header.php');
        require_once(ROOT . '/views/nav-user.php');
        }
    }

    if($_SESSION['esAdmin'] == true)
    {
        require_once(ROOT . '/views/header.php');
        require_once(ROOT . '/views/nav-admin.php');

    }

        $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-info.php');

        require_once(ROOT . '/views/footer.php');

    }

    public function getFilmsByGenres($id) {


        if($_SESSION['esAdmin'] == false)
        {
            if($_SESSION['log'] == false) {
                require_once(ROOT . '/views/header-login.php');
                require_once(ROOT . '/views/nav-principal.php');
            }else{
                require_once(ROOT . '/views/header.php');
                require_once(ROOT . '/views/nav-user.php');
            }
        }
    
        if($_SESSION['esAdmin'] == true)
        {
            require_once(ROOT . '/views/header.php');
            require_once(ROOT . '/views/nav-admin.php');
    
        }

        $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-by-genre.php');

        require_once(ROOT . '/views/footer.php');

    }

    public function getFilmsByDate($date){


        if($_SESSION['esAdmin'] == false)
        {
            if($_SESSION['log'] == false) {
                require_once(ROOT . '/views/header-login.php');
                require_once(ROOT . '/views/nav-principal.php');
            }else{
                require_once(ROOT . '/views/header.php');
                require_once(ROOT . '/views/nav-user.php');
            }
        }
    
        if($_SESSION['esAdmin'] == true)
        {
            require_once(ROOT . '/views/header.php');
            require_once(ROOT . '/views/nav-admin.php');
    
        }

        $daosFilms = new \DAO\Films();

        $filmsDate = $daosFilms->getByDate($date);

        require_once(ROOT . '/views/film-by-date.php');

        require_once(ROOT . '/views/footer.php');
    }

    public function filter(){


        if($_SESSION['esAdmin'] == false)
    {
        if($_SESSION['log'] == false) {
            require_once(ROOT . '/views/header-login.php');
            require_once(ROOT . '/views/nav-principal.php');
        }else{
            require_once(ROOT . '/views/header.php');
            require_once(ROOT . '/views/nav-user.php');
        }
    }

    if($_SESSION['esAdmin'] == true)
    {
        require_once(ROOT . '/views/header.php');
        require_once(ROOT . '/views/nav-admin.php');

    }

            $daosGenres = new \DAO\Genres();
            $genres = $daosGenres->GetAll();

            $daosFilms = new \DAO\Films();
            $rangoFechas = $daosFilms->getRangoFechas();
    
            require_once(ROOT . '/views/filter.php');

        require_once(ROOT . '/views/footer.php');
    }

    public function BuyTicket($idFilm){

        $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

       $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

        if($_SESSION['esAdmin'] == false)
        {
            if($_SESSION['log'] == false) {
                require_once(ROOT . '/views/header-login.php');
                require_once(ROOT . '/views/nav-principal.php');
                require_once(ROOT . '/views/login.php');

            }else{
                require_once(ROOT . '/views/header.php');
                require_once(ROOT . '/views/nav-user.php');
                require_once(ROOT . '/views/buy-ticket.php');
            }
        }
    
        if($_SESSION['esAdmin'] == true)
        {
            require_once(ROOT . '/views/header.php');
            require_once(ROOT . '/views/nav-admin.php');
            require_once(ROOT . '/views/buy-ticket.php');
        }
    
            require_once(ROOT . '/views/footer.php');

    }
}