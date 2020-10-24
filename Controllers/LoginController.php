<?php

namespace Controllers;

use DAO\UsersDAO as UsersDAO;
use Models\User as User;

class LoginController {

    public function init($email, $pass) {

     header('Cache-Control: no cache'); //Evita el error de cache por reenvío de formulario

        $usersDAO = new UsersDAO();

        $user = $usersDAO->read($email, $pass);

        $_SESSION['log'] = true;
        $_SESSION['id'] = $user->getId();
        $_SESSION['name'] = $user->getNombre();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['esAdmin'] = $user->getAdmin();

        $films = new FilmsController();
        $films->getAll();
    
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

        require_once(ROOT . '/views/header-login.php');

        require_once(ROOT . '/views/nav-principal.php');

        require_once(ROOT . '/views/signin.php');
        
        require_once(ROOT . '/views/footer.php');
    
    }

    public function signin($nombre, $apellido, $dni, $email, $pass){

        $user = new User();
        $user->setNombre($nombre);
        $user->setApellido($apellido);
        $user->setDni($dni);
        $user->setEmail($email);
        $user->setPassword($pass);
        $user->setAdmin(false);
        $user->setIdFB(0);

        $usersDAO = new UsersDAO();

        $idUser = $usersDAO->Add($user);

        $_SESSION['log'] = true;
        $_SESSION['id'] = $idUser;
        $_SESSION['name'] = $nombre;
        $_SESSION['email'] = $email;
        $_SESSION['esAdmin'] = false;

        $films = new FilmsController();
        $films->getAll();
    }

    public function fbLogin($idFB, $nombre, $apellido, $email) {

        $usersDAO = new UsersDAO();

        $userFB = $usersDAO->GetOneFB($idFB);

        if(!$userFB){

            $user = new User();
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setDni(null);
            $user->setEmail($email);
            $user->setPassword(null);
            $user->setAdmin(false);
            $user->setIdFB($idFB);

            $idUser = $usersDAO->Add($user);

        $_SESSION['log'] = true;
        $_SESSION['id'] = $idUser;
        $_SESSION['name'] = $nombre;
        $_SESSION['email'] = $email;
        $_SESSION['esAdmin'] = false;

        }else{

        $_SESSION['log'] = true;
        $_SESSION['id'] = $userFB->getId();
        $_SESSION['name'] = $nombre;
        $_SESSION['email'] = $email;
        $_SESSION['esAdmin'] = false;
        }

        $films = new FilmsController();
        $films->getAll();
        
    }

}