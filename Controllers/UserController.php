<?php

namespace Controllers;

use \Exception as Exception;
use DAO\UsersDAODB as UsersDAO;
use Models\User as User;

class UserController {

    private $usersDAO;

    public function __construct(){

        $this->usersDAO = new UsersDAO();
    }

    public function perfil($id){

        try{

            require_once(ROOT . '/Views/header.php');
            $user = $this->usersDAO->GetOne($id);
    
            if ($_SESSION['esAdmin'] == true){
    
                require_once(ROOT . '/Views/nav-admin.php');
            
            }else{
    
                require_once(ROOT . '/Views/nav-user.php');
    
            }
    
            require_once(ROOT . '/Views/perfil-user.php');
            require_once(ROOT . '/Views/footer.php');

        }catch(Exception $ex){

            HomeController::ShowErrorView("Error al obtener la información del usuario.", $e->getMessage(), "Home/Index/");
        }
        

    }

    public function ShowEditView($id) {

        try{

            require_once(ROOT . '/Views/header.php');
    
            $user = $this->usersDAO->GetOne($id);
    
            if ($_SESSION['esAdmin'] == true){
    
                require_once(ROOT . '/Views/nav-admin.php');
            
            }else{
    
                require_once(ROOT . '/Views/nav-user.php');
    
            }
    
            require_once(ROOT . '/Views/edit-user.php');
            require_once(ROOT . '/Views/footer.php');

        }catch(Exception $ex){

            HomeController::ShowErrorView("Error al obtener la información del usuario.", $e->getMessage(), "Home/Index/");
        }

    }

    public function Edit($id, $nombre, $apellido, $dni, $email, $pass, $admin, $idFB){

        try{
            $nombre = HomeController::validateString($nombre);
            $apellido = HomeController::validateString($apellido);

            if(!($nombre && $apellido)){

                throw new Exception("El nombre y/o apellido está vacío.");
            }
    
            $user = new User();
            $user->setId($id);
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setDni($dni);
            $user->setEmail($email);
            $user->setPassword($pass);
            $user->setAdmin($admin);
            $user->setIdFB($idFB);
            
            $this->usersDAO->Edit($user);
    
            $_SESSION['log'] = true;
            $_SESSION['id'] = $user->getId();
            $_SESSION['name'] = $user->getNombre();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['esAdmin'] = $user->getAdmin();
    
            $this->perfil($id);

        }catch(Exception $ex){

            HomeController::ShowErrorView("La información del usuario no pudo ser actualizada.", $e->getMessage(), "Home/Index/");
        }

    }
}