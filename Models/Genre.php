<?php 

namespace Models;

class Genre {

    private $nombre;
    private $id;

    function __constructor() {
        $this->nombre = '';
        $this->id = 0;

    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($value) {
        $this->nombre = $value;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

}