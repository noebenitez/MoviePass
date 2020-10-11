<?php

namespace controllers;

class Login {

    public function init() {
        
        require_once(ROOT . '/views/header.php');

        require_once(ROOT . '/views/nav.php');

        require_once(ROOT . '/views/login.php');

        require_once(ROOT . '/views/footer.php');

    }

}