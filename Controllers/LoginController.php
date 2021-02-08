<?php

namespace Controllers;

use \Exception as Exception;
use DAO\UsersDAODB as UsersDAO;
use Models\User as User;
use DAO\GenresDAODB as GenresDAO;

class LoginController {

    private $usersDAO;

    public function __construct(){

        $this->usersDAO = new UsersDAO();
    }

    public function init($email, $pass) {

        try{
            $user = $this->usersDAO->read($email, $pass);

            if ($user){
                
                $_SESSION['log'] = true;
                $_SESSION['id'] = $user->getId();
                $_SESSION['name'] = $user->getNombre();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['esAdmin'] = $user->getAdmin();
        
                if( $_SESSION['esAdmin'] == true){
                    $films = new FilmsController();
                    $genres = new GenresDAO();
                    $films->getAll();
                }else{
                    $cartelera = new FuncionController();
                    $cartelera->ShowCartelera();
                }
            }else{
    
                throw new Exception("El usuario y la contraseña no coinciden.");
    
            }
            
        }catch (Exception $ex){

            HomeController::ShowErrorView("Error al iniciar sesión.", $ex->getMessage(), "Home/Index/");
        }
        
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

    public function signin($nombre, $apellido, $dni, $email, $pass){

        try{
            $nombre = HomeController::validateString($nombre);
            $apellido = HomeController::validateString($apellido);

            if (!($nombre && $apellido)){
                
                throw new Exception("El nombre o apellido está vacío.");
            }
            
            $user = new User();
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setDni($dni);
            $user->setEmail($email);
            $user->setPassword($pass);
            $user->setAdmin(false);
            $user->setIdFB(0);

            $this->usersDAO->Add($user);
            
            require_once(ROOT . '/Views/header-login.php');
            require_once(ROOT . '/Views/nav-principal.php');
            require_once(ROOT . '/Views/login.php');

        }catch(Exception $ex){

            HomeController::ShowErrorView("Error al agregar al usuario.", $ex->getMessage(), "Home/Index/");
        }
    }

    public function fbLogin($idFB, $nombre, $apellido, $email) {

        try{
            $userFB = $this->usersDAO->GetOneFB($idFB);
            
             if(!$userFB){

                $user = new User();
                $user->setNombre($nombre);
                $user->setApellido($apellido);
                $user->setDni(null);
                $user->setEmail($email);
                $user->setPassword(null);
                $user->setAdmin(false);
                $user->setIdFB($idFB);


                $idUser = $this->usersDAO->AddFB($user);

                $_SESSION['log'] = true;
                $_SESSION['id'] = $idUser;
                $_SESSION['name'] = $nombre;
                $_SESSION['email'] = $email;
                $_SESSION['esAdmin'] = false;
                
            }else{
                
                $_SESSION['log'] = true;
                $_SESSION['id'] = $userFB->getId();
                $_SESSION['name'] = $userFB->getNombre();
                $_SESSION['email'] = $userFB->getEmail();
                $_SESSION['esAdmin'] = false;
            }
            
            $funciones = new FuncionController();
            $funciones->ShowCartelera();

        }catch(Exception $ex){

            HomeController::ShowErrorView("Error al leer o agregar un usuario de Facebook.", $ex->getMessage(), "Home/Index");
        }
        
    }

}