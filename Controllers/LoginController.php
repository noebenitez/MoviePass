<?php

namespace Controllers;

class LoginController {

    public function init($username) {
        
        /* require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        require_once(ROOT . '/views/login.php');

        require_once(ROOT . '/views/footer.php');
 */

    if($username =="cliente")
    {
    
        /* header("Status: 301 Moved Permanently");
        header("Location: films.php");
        exit;
     */
        $_SESSION['esAdmin'] = false;
        $films = new FilmsController();
        $films->getAll();
    }

    if($username =="admin")
    {
        $_SESSION['esAdmin'] = true;
        $cinema = new CinemaController();
        $cinema->ShowListView();
    
    }

    }

}