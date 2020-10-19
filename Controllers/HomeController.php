<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            $_SESSION['log'] = false;
            $_SESSION['esAdmin'] = false;

		$daosFilms = new \DAO\Films();

		$films = $daosFilms->GetAll();

            require_once(VIEWS_PATH."index.php");
        }        
    }
?>