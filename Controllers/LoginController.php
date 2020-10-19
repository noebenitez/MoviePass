<?php

namespace Controllers;

class LoginController {

    public function init($username) {
        

    if($username =="cliente")
    {

        $_SESSION['name'] = "Cliente";
        $_SESSION['esAdmin'] = false;
        $_SESSION['log'] = true;
        $films = new FilmsController();
        $films->getAll();
    }

    if($username =="admin")
    {

        $_SESSION['name'] = "Admin";
        $_SESSION['log'] = true;
        $_SESSION['esAdmin'] = true;
        $cinema = new CinemaController();
        $cinema->ShowListView();
    
    }
    require_once(ROOT . '/views/footer.php');
    }

    public function logout() {

        session_destroy();

        session_start();

        $_SESSION['log'] = false;
        $_SESSION['esAdmin'] = false;

        $home = new HomeController();
        $home->Index();

    }
}