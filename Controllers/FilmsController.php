<?php

namespace Controllers;
use DAO\Films as FilmsDAO;
use DAO\Genres as GenresDAO;

class FilmsController {


    public function getAll() {

        $daosFilms = new FilmsDAO();
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
        
            $daosGenres = new GenresDAO();
            $genres = $daosGenres->GetAll();

            $daosFilms = new FilmsDAO();
            $rangoFechas = $daosFilms->getRangoFechas();

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

        $daosGenres = new GenresDAO();

        $genres = $daosGenres->GetAll();

        $filmsDAO = new FilmsDAO();

        $films = $filmsDAO->GetAll();

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

        $daosGenres = new GenresDAO();

        $genres = $daosGenres->GetAll();

       $daosFilms = new FilmsDAO();

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

        $daosFilms = new FilmsDAO();

        $filmsDate = $daosFilms->getByDate($date);

        require_once(ROOT . '/Views/film-by-date.php');

        require_once(ROOT . '/Views/footer.php');
    }

    public function getInfoFuncion($id) {

    
        require_once(ROOT . '/Views/header.php');
        require_once(ROOT . '/Views/nav-admin.php');

        $daosGenres = new GenresDAO();

        $genres = $daosGenres->GetAll();

       $daosFilms = new FilmsDAO();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/Views/film-info-funcion.php');

        require_once(ROOT . '/Views/footer.php');

    }

    public function refresh(){
        $daosFilms = new FilmsDAO();
        $daosFilms->refrescarDB();
        
    }

    public function getGeneros($idFilm){
        $daosFilms = new FilmsDAO();
        $daosFilms->getGeneros($idFilm);
    }
}