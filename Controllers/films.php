<?php

namespace controllers;

class Films {

    public function getAll() {

        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        $daosGenres = new \daos\Genres();

        $genres = $daosGenres->GetAll();

        require_once(ROOT . '/views/genres-list.php');

       $daosFilms = new \daos\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-list.php');

        require_once(ROOT . '/views/footer.php');

    }

    public function getInfo($id) {

        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        $daosGenres = new \daos\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \daos\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-info.php');

        require_once(ROOT . '/views/footer.php');

    }

    public function getFilmsByGenres($id) {

        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        $daosGenres = new \daos\Genres();

        $genres = $daosGenres->GetAll();

       $daosFilms = new \daos\Films();

       $films = $daosFilms->GetAll();

        require_once(ROOT . '/views/film-by-genre.php');

        require_once(ROOT . '/views/footer.php');

    }

}