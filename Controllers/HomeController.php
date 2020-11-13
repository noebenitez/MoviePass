<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            $_SESSION['log'] = false;
            $_SESSION['esAdmin'] = false;

            $cartelera = new FuncionController();

            $cartelera->ShowCartelera();

            //require_once(VIEWS_PATH."index.php");
        }
        
        public static function ShowErrorView($mensaje, $exMessage, $pathRedirect){ //Parametros: Mensaje para el usuario, mensaje de la excepción, string con Controller/ShowXView
            
            require_once(ROOT . '/Views/header.php');

            if($_SESSION['log'] == true){

                if ($_SESSION['esAdmin'] == true){
                    require_once(ROOT . '/Views/nav-admin.php');
                }else{
                    require_once(ROOT . '/Views/nav-user.php');
                }
                
            }else{
                require_once(ROOT . '/Views/nav-principal.php');
            }

            require_once(ROOT . '/Views/error-view.php');
            require_once(ROOT . '/Views/footer.php');

        }

        public static function validateString($string){

            $string = trim($string);                     //Saca los espacios del comienzo y final del string
        
            if(empty($string)){
        
                return false;                           //Eran solo espacios
            }else{
                
                $array = explode(' ',$string);          //Hago un array separando al string por los espacios
                $array = array_filter($array);          //Se eliminan los elementos del array que están vacios, por si había más de un espacio seguido
                $string = implode(' ', $array);         //Se arma el string de nuevo
        
                return $string;
            }
        }
    }
?>