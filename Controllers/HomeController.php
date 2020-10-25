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
    }
?>