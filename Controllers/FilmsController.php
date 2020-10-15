<?php

namespace Controllers;

class FilmsController {

    public function getAll() {

        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

        require_once(ROOT . '/views/genres-list.php');
        
        $daosFilms = new \DAO\Films();

        $rangoFechas = $daosFilms->getRangoFechas();

        require_once(ROOT . '/views/date-list.php');
        
        $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-list.php');

        require_once(ROOT . '/views/footer.php');

    }

    public function getInfo($id) {

        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-info.php');

        require_once(ROOT . '/views/footer.php');

    }

    public function getFilmsByGenres($id) {

        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        $daosGenres = new \DAO\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \DAO\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-by-genre.php');

        require_once(ROOT . '/views/footer.php');

    }

    public function getFilmsByDate($date){

        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        $daosFilms = new \DAO\Films();

        $filmsDate = $daosFilms->getByDate($date);

        require_once(ROOT . '/views/film-by-date.php');

        require_once(ROOT . '/views/footer.php');
    }

}