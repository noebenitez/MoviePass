<?php 

namespace Models;

class Genre {

    private $nombre;
    private $id;

    function __construct ($nombre = null, $id = null) {
        $this->nombre = $nombre;
        $this->id = $id;

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