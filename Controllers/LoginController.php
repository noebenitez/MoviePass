<?php

namespace Controllers;

class LoginController {

    public function init($username) {

     header('Cache-Control: no cache'); //Evita el error de cache por reenvío de formulario

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
        $films = new FilmsController();
        $films->getAll();
    
    }
    require_once(ROOT . '/Views/footer.php');
    }

    public function logout() {

        session_destroy();

        session_start();

        $_SESSION['log'] = false;
        $_SESSION['esAdmin'] = false;

        $home = new HomeController();
        $home->Index();

    }

    public function signinView() {

        require_once(ROOT . '/Views/header-login.php');

        require_once(ROOT . '/Views/nav-principal.php');

        require_once(ROOT . '/Views/signin.php');
        
        require_once(ROOT . '/Views/footer.php');
    
    }
}