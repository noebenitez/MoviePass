<?php

namespace Controllers;

use DAO\UsersDAODB as UsersDAO;
use Models\User as User;

class UserController {

    public function perfil($id){

        require_once(ROOT . '/views/header.php');

        $usersDAO = new UsersDAO();

        $user = $usersDAO->GetOne($id);

        if ($_SESSION['esAdmin'] == true){

        require_once(ROOT . '/views/nav-admin.php');
        
        }else{

        require_once(ROOT . '/views/nav-user.php');

        }

        require_once(ROOT . '/views/perfil-user.php');
        
        require_once(ROOT . '/views/footer.php');
    }

    public function ShowEditView($id) {

        require_once(ROOT . '/views/header.php');

        $usersDAO = new UsersDAO();

        $user = $usersDAO->GetOne($id);

        if ($_SESSION['esAdmin'] == true){

        require_once(ROOT . '/views/nav-admin.php');
        
        }else{

        require_once(ROOT . '/views/nav-user.php');

        }

        require_once(ROOT . '/views/edit-user.php');
        
        require_once(ROOT . '/views/footer.php');
    }

    public function Edit($id, $nombre, $apellido, $dni, $email, $pass, $admin, $idFB){

        $user = new User();
        $user->setId($id);
        $user->setNombre($nombre);
        $user->setApellido($apellido);
        $user->setDni($dni);
        $user->setEmail($email);
        $user->setPassword($pass);
        $user->setAdmin($admin);
        $user->setIdFB($idFB);

        $usersDAO = new UsersDAO();

        $usersDAO->Edit($user);

        $_SESSION['log'] = true;
        $_SESSION['id'] = $user->getId();
        $_SESSION['name'] = $user->getNombre();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['esAdmin'] = $user->getAdmin();

        $this->perfil($id);

    }
}